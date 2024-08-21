<?php
include 'connection.php';
session_start();

if ($_SESSION['urole'] !== 1) {
    header("Location: ../index.php");
    exit();
}

$query = "SELECT * FROM user where urole=2";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-white h-screen">
    <div class="bg-gray-800 border-b-2 border-black">
        <h1 class="text-white ml-8 p-2 text-5xl">Dashbord</h1>
    </div>
    <div class="flex h-full">
        <div class="bg-gray-800 text-white w-64 p-6">
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="adminhome.php" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 hover:text-white">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="usermanage.php" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 hover:text-white">
                            Staffs
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 hover:text-white">
                            Services
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 hover:text-white">
                            Reports
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 hover:text-white">
                            Support
                        </a>
                    </li>
                </ul>
                <div class="absolute bottom-0 px-6 py-2 min-w-[120px] text-center text-white bg-red-600 border border-red-600 rounded active:text-red-500 hover:bg-transparent hover:text-red-600 focus:outline-none focus:ring">
                    <form method="POST" action="logout.php">
                        <button type="submit" name="logout" class="">Logout</button>
                    </form>
                </div>
            </nav>

        </div>

        <div class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl text-black font-bold">Staffs:</h1>
                <a href="adduser.php" class="btn bg-purple-500 text-white hover:bg-purple-800 hover:text-white">Add User</a>
            </div>

            <div class="bg-white text-black shadow-lg rounded-lg p-6">
                <table class=" w-full">
                    <thead>
                        <tr class="border-b border-gray-300">
                            <th class="border-r border-gray-300 px-4 py-2">Staff ID</th>
                            <th class="border-r border-gray-300 px-4 py-2">Staff Name</th>
                            <th class="border-r border-gray-300 px-4 py-2">Email</th>
                            <th class="border-r border-gray-300 px-4 py-2">Role</th>
                            <th class="border-r border-gray-300 px-4 py-2">Active</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['uid']) . "</td>";
                                echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['uname']) . "</td>";
                                echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['uemail']) . "</td>";
                                echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['urole']) . "</td>";
                                echo "<td class='border-r border-gray-300 px-4 py-2'>" . htmlspecialchars($row['ustatus']) . "</td>";
                                echo "<td class='px-4 py-2'>
                        <a href='staffdata.php?id=" . $row['uid'] . "' class='btn bg-purple-500 text-white hover:bg-purple-700'>View</a>
                        <a href='staffedit.php?id=" . $row['uid'] . "' class='btn bg-blue-500 text-white hover:bg-blue-700'>Edit</a>
                        <a href='staffdelete.php?id=" . $row['uid'] . "' class='btn bg-red-500 text-white hover:bg-red-700' onclick='return confirm(\"Are you sure you want to delete this customer?\");'>Delete</a>
                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No customers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>

</html>