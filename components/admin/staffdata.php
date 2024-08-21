<?php
include '../connection.php';
session_start();

if ($_SESSION['urole'] !== 1) {
    header("Location: .../index.php");
    exit();
}
$uid = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM user WHERE uid = ?");
$stmt->bind_param("i", $uid); 
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $custdata = $result->fetch_assoc();
}

    

   
?>

<!DOCTYPE html>
<html>
<head>
    <title>user data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex text-black justify-center items-center min-h-screen">
    <button onclick="window.history.back()" class="absolute top-4 left-4 px-4 py-2 text-white bg-gray-600 border border-gray-600 rounded-md shadow-sm cursor-pointer hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
        Back
    </button>
    <div class="bg-white p-6 md:p-8 rounded-lg  w-full max-w-3xl">
        <h2 class="text-2xl md:text-3xl text-purple-500 font-semibold mb-6">user data</h2>

        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="uname" class="block font-medium">user Name:</label>
                <input value="<?php echo ($custdata['uname']); ?>" class="border bg-white text-black border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="uname" name="uname" readonly>
            </div>
            
            <div>
                <label for="uemail" class="block font-medium">Email:</label>
                <input value="<?php echo ($custdata['uemail']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="email" id="uemail" name="uemail" readonly>
            </div>
           

            <div>
                <label for="urole" class="block font-medium">user role:</label>
                <input value="<?php echo ($custdata['urole']); ?>" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="urole" name="urole" readonly>
            </div>
            <div>
                <label for="status" class="block font-medium">Status:</label>
                <select id="ustatus" name="ustatus" class="bg-white text-black border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" disabled="true">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            
        </form>
    </div>
</body>
</html>
