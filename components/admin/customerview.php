<?php
include '../connection.php';
session_start();

if ($_SESSION['urole'] !== 1) {
    header("Location: .../index.php");
    exit();
}
$staffid = $_SESSION['uid'];

$query = "SELECT * FROM customer";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="bg-white h-lvh">
    <!-- <button onclick="window.location.href='../adminhome.php'" class="absolute top-4 left-4 px-4 py-2 text-white bg-gray-600 border border-gray-600 rounded-md shadow-sm cursor-pointer hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
        Back
    </button> -->
    <div class="bg-gray-800 border-b-2 border-black">
        <h1 class="text-white ml-8 p-2 text-5xl">Dashbord</h1>
    </div>
    <div class="flex h-screen">
    <?php include'adminside.php' ?>

        <div class="flex-1 p-6 h-screen bg-white">

            <h1 class="text-3xl text-black font-semibold p-16">Customer Data</h1>

            <table class="w-full text-black ">
                <tr class="border-b border-gray-300">
                    <th class="border-r border-gray-300 px-4 py-2">Customer Name</th>
                    <th class="border-r border-gray-300 px-4 py-2">Email</th>
                    <th class="border-r border-gray-300 px-4 py-2">Phone</th>
                    <th class="border-r border-gray-300 px-4 py-2">Address</th>
                    <th class="border-r border-gray-300 px-4 py-2">Business</th>
                    <th class="border-r border-gray-300 px-4 py-2">Active</th>
                    <th class="border-r border-gray-300 px-4 py-2">staff id </th>
                    <th class="border-r border-gray-300 px-4 py-2"><span class="ml-8">Actions</span></th>

                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['Cust_fname']) . " " . htmlspecialchars($row['Cust_lname']) . "</td>";
                        echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['Cust_email']) . "</td>";
                        echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['Cust_phone']) . "</td>";
                        echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['Cust_address']) . "</td>";
                        echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['Cust_business']) . "</td>";
                        echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['addedby']) . "</td>";


                        echo "<td>
                        <a href='../data.php?id=" . $row['Cust_id'] . "' class='ml-4 btn bg-purple-500 text-white hover:bg-green-700'>View</a>
                      </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No customers found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>