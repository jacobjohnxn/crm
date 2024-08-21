<?php
include 'connection.php';
session_start();

// if ($_SESSION['urole'] !== 2) {
//     header("Location: ../index.php");
//     exit();
// }
$Cust_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM customer WHERE Cust_id = ?");
$stmt->bind_param("i", $Cust_id); 

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $custdata = $result->fetch_assoc();
}

   
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex text-black justify-center items-center min-h-screen">
    <button onclick="window.history.back()" class="absolute top-4 left-4 px-4 py-2 text-white bg-gray-600 border border-gray-600 rounded-md shadow-sm cursor-pointer hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
        Back
    </button>
    <div class="bg-white p-6 md:p-8 rounded-lg  w-full max-w-3xl">
        <h2 class="text-2xl md:text-3xl text-purple-500 font-semibold mb-6">Customer Full Data:</h2>

        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="Cust_fname" class="block font-medium">First Name:</label>
                <input value="<?php echo ($custdata['Cust_fname']); ?>" class="border bg-white text-black border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="Cust_fname" name="Cust_fname" readonly>
            </div>
            <div>
                <label for="Cust_lname" class="block font-medium">Last Name:</label>
                <input value="<?php echo ($custdata['Cust_lname']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="Cust_lname" name="Cust_lname" readonly>
            </div>
            <div>
                <label for="Cust_email" class="block font-medium">Email:</label>
                <input value="<?php echo ($custdata['Cust_email']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="email" id="Cust_email" name="Cust_email" readonly>
            </div>
            <div>
                <label for="Cust_phone" class="block font-medium">Phone:</label>
                <input value="<?php echo ($custdata['Cust_phone']); ?>" placeholder="" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="tel" id="Cust_phone" name="Cust_phone" readonly>
            </div>
            <div class="col-span-1 md:col-span-2">
                <label for="Cust_address" class="block font-medium">Address:</label>
                <textarea  class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" id="Cust_address" name="Cust_address" readonly><?php echo ($custdata['Cust_address']); ?></textarea>
            </div>
            <div>
                <label for="Cust_business" class="block font-medium">Business:</label>
                <input value="<?php echo ($custdata['Cust_business']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="Cust_business" name="Cust_business" readonly>
            </div>
            <div>
                <label for="B_address" class="block font-medium">Business Address:</label>
                <textarea  class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" id="B_address" name="B_address" readonly><?php echo ($custdata['B_address']); ?></textarea>
            </div>
            <div>
                <label for="B_industry" class="block font-medium">Business Industry:</label>
                <input value="<?php echo ($custdata['B_industry']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="B_industry" name="B_industry" readonly>
            </div>
            <div>
                <label for="state" class="block font-medium">State:</label>
                <input value="<?php echo ($custdata['state']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="state" name="state" readonly>
            </div>
            <div>
                <label for="country" class="block font-medium">Country:</label>
                <input value="<?php echo ($custdata['country']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="country" name="country" readonly>
            </div>
            <div>
                <label for="zipcode" class="block font-medium">Zipcode:</label>
                <input value="<?php echo ($custdata['zipcode']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="number" id="zipcode" name="zipcode" readonly>
            </div>
            <div>
                <label for="B_phone" class="block font-medium">Business Phone:</label>
                <input value="<?php echo ($custdata['B_phone']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="tel" id="B_phone" name="B_phone" readonly>
            </div>
            <div>
                <label for="B_email" class="block font-medium">Business Email:</label>
                <input value="<?php echo ($custdata['B_email']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="email" id="B_email" name="B_email">
            </div>
            <div>
                <label for="addedby" class="block font-medium">Added By:</label>
                <input value="<?php echo ($custdata['addedby']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="addedby" name="addedby" readonly>
            </div>
            <div>
                <label for="updatedby" class="block font-medium">Updated By:</label>
                <input value="<?php echo ($custdata['updatedby']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="updatedby" name="updatedby" readonly>
            </div>
            <div>
                <label for="Cust_status" class="block font-medium">Customer Status:</label>
                <select id="Cust_status" name="Cust_status" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" disabled="true">
                    <option value="added">Added</option>
                    <option value="call not answered">Call Not Answered</option>
                </select>
            </div>
            <div>
                <label for="status" class="block font-medium">Status:</label>
                <select id="status" name="status" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" disabled="true">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
          
        </form>
    </div>
</body>
</html>
