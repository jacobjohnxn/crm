<?php
include 'connection.php';
session_start();

if ($_SESSION['urole'] !== 2) {
    header("Location: ../index.php");
    exit();
}
$staffid = $_SESSION['uid'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Cust_email'] ?? null;
    $phone = $_POST['Cust_phone'] ?? null;
    $business = $_POST['Cust_business'] ?? null;
    $b_address = $_POST['B_address'] ?? null;
    $b_phone = $_POST['B_phone'] ?? null;
    $b_email = $_POST['B_email'] ?? null;

    $stmt = $conn->prepare("SELECT * FROM customer WHERE Cust_email = ? OR Cust_phone = ? OR Cust_business = ? OR B_address = ? OR B_phone = ? OR B_email = ?");
    $stmt->bind_param("ssssss", $email, $phone, $business, $b_address, $b_phone, $b_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['Cust_email'] === $email) {
                $errors['Cust_email'] = "Email already exists.";
            }
            if ($row['Cust_phone'] === $phone) {
                $errors['Cust_phone'] = "Phone number already exists.";
            }
            if ($row['Cust_business'] === $business) {
                $errors['Cust_business'] = "Business name already exists.";
            }
            if ($row['B_address'] === $b_address) {
                $errors['B_address'] = "Business address already exists.";
            }
            if ($row['B_phone'] === $b_phone) {
                $errors['B_phone'] = "Business phone number already exists.";
            }
            if ($row['B_email'] === $b_email) {
                $errors['B_email'] = "Business email already exists.";
            }
        }
    }

    $stmt->close();

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO customer (Cust_fname, Cust_lname, Cust_email, Cust_phone, Cust_address, Cust_business, B_address, B_industry, state, country, zipcode, B_phone, B_email, addedby, updatedby, Cust_status, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssssssssssssss", $Cust_fname, $Cust_lname, $Cust_email, $Cust_phone, $Cust_address, $Cust_business, $B_address, $B_industry, $state, $country, $zipcode, $B_phone, $B_email, $addedby, $updatedby, $Cust_status, $status);

        $Cust_fname = $_POST['Cust_fname'] ?? null;
        $Cust_lname = $_POST['Cust_lname'] ?? null;
        $Cust_email = $_POST['Cust_email'] ?? null;
        $Cust_phone = $_POST['Cust_phone'] ?? null;
        $Cust_address = $_POST['Cust_address'] ?? null;
        $Cust_business = $_POST['Cust_business'] ?? null;
        $B_address = $_POST['B_address'] ?? null;
        $B_industry = $_POST['B_industry'] ?? null;
        $state = $_POST['state'] ?? null;
        $country = $_POST['country'] ?? null;
        $zipcode = $_POST['zipcode'] ?? null;
        $B_phone = $_POST['B_phone'] ?? null;
        $B_email = $_POST['B_email'] ?? null;
        $addedby = $staffid;
        $updatedby = $staffid;
        $Cust_status = $_POST['Cust_status'] ?? 'added';
        $status = $_POST['status'] ?? 'active';

        if ($stmt->execute()) {
            header("Location: home1.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <button onclick="window.history.back()" class="absolute top-4 left-4 px-4 py-2 text-white bg-gray-600 border border-gray-600 rounded-md shadow-sm cursor-pointer hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
        Back
    </button>
    <div class="bg-white p-6 md:p-8 rounded-lg  w-full max-w-3xl">
        <div class="flex flex-row">
            <h2 class="text-2xl md:text-3xl text-purple-500 font-semibold pt-16">Add New Customer</h2>
            <!-- <div class=" ml-8 mb-2 ">
                <div class="max-w-md mx-auto p-6 bg-white  rounded-md shadow-lg">
                    <div class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-md px-6 py-8 text-center">
                        <input type="file" class="hidden" id="fileInput">

                        <p class="text-sm text-gray-600 dark:text-gray-400">Download the
                            <a href="sample.csv" download="sample.csv" class="text-blue-500 hover:underline">sample.csv</a> and <label for="fileInput" class="cursor-pointer text-blue-500 hover:underline">upload</label> the data.
                        </p>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-md w-full mt-6 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:focus:ring-opacity-50">Upload</button>
                </div>
            </div> -->
        </div>
        <form action="customer.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="Cust_fname" class="block font-medium">First Name:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="Cust_fname" name="Cust_fname" required>
            </div>
            <div>
                <label for="Cust_lname" class="block font-medium">Last Name:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="Cust_lname" name="Cust_lname" required>
            </div>
            <div>
                <label for="Cust_email" class="block font-medium">Email:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500 " type="email" id="Cust_email" name="Cust_email" required>
                <?php if (isset($errors['Cust_email'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo htmlspecialchars("email already exist"); ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="Cust_phone" class="block font-medium">Phone:</label>
                <input placeholder="" class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="tel" pattern="[^a-zA-Z]*" id="Cust_phone" name="Cust_phone" required>
                <?php if (isset($errors['Cust_phone'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo htmlspecialchars("phone number already exist"); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-span-1 md:col-span-2">
                <label for="Cust_address" class="block font-medium">Address:</label>
                <textarea class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" id="Cust_address" name="Cust_address" required></textarea>
            </div>
            <div>
                <label for="Cust_business" class="block font-medium">Business:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="Cust_business" name="Cust_business" required>
                <?php if (isset($errors['Cust_business'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo htmlspecialchars("business already exist"); ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="B_address" class="block font-medium">Business Address:</label>
                <textarea class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" id="B_address" name="B_address" required></textarea>
                <?php if (isset($errors['B_address'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo htmlspecialchars("Business Address already exist"); ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="B_industry" class="block font-medium">Business Industry:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="B_industry" name="B_industry" required>
            </div>
            <div>
                <label for="state" class="block font-medium">State:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="state" name="state" required>
            </div>
            <div>
                <label for="country" class="block font-medium">Country:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="country" name="country" required>
            </div>
            <div>
                <label for="zipcode" class="block font-medium">Zipcode:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="number" id="zipcode" name="zipcode" required>
            </div>
            <div>
                <label for="B_phone" class="block font-medium">Business Phone:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="tel" pattern="[^a-zA-Z]*" id="B_phone" name="B_phone" required>
                <?php if (isset($errors['B_phone'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo htmlspecialchars("phone number already exist"); ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="B_email" class="block font-medium">Business Email:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="email" id="B_email" name="B_email">
                <?php if (isset($errors['B_email'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo htmlspecialchars("Business email already exist"); ?></p>
                <?php endif; ?>
            </div>
            <!-- <div>
                <label for="addedby" class="block font-medium">Added By:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="addedby" name="addedby" required>
            </div>
            <div>
                <label for="updatedby" class="block font-medium">Updated By:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="updatedby" name="updatedby">
            </div>-->
            <div>
                <label for="Cust_status" class="block font-medium">Customer Status:</label>
                <select id="Cust_status" name="Cust_status" class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="added">Added</option>
                    <option value="call not answered">Call Not Answered</option>
                </select>
            </div>
            <div>
                <label for="status" class="block font-medium">Status:</label>
                <select id="status" name="status" class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-span-1 md:col-span-2 flex justify-center">
                <input class="px-6 py-2 text-white bg-purple-600 border border-purple-600 rounded-md shadow-sm cursor-pointer hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50" type="submit" value="Add Customer">
            </div>
        </form>
    </div>
</body>

</html>