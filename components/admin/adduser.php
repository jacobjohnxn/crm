<?php
include '../connection.php';
session_start();

if ($_SESSION['urole'] !== 1) {
    header("Location: .../index.php");
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'] ?? null;
    $uemail = $_POST['uemail'] ?? null;
    $upassword = $_POST['upassword'] ?? null;
    $urole = $_POST['urole'] ?? null;
    $ustatus = $_POST['ustatus'] ?? 'active';

    $stmt = $conn->prepare("SELECT uemail FROM user WHERE uemail = ?");
    $stmt->bind_param("s", $uemail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errors['uemail'] = 'Email already exists';
    } else {
        $hashedPassword = password_hash($upassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO user (uname, uemail, upassword, urole, ustatus) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $uname, $uemail, $hashedPassword, $urole, $ustatus);

        if ($stmt->execute()) {
            header("Location: staffs.php");
            exit();
        } else {
            $errors['db'] = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
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
    <button onclick="window.location.href='staffs.php'" class="absolute top-4 left-4 px-4 py-2 text-white bg-gray-600 border border-gray-600 rounded-md shadow-sm cursor-pointer hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
        Back
    </button>
    <div class="bg-white p-6 md:p-8 rounded-lg  w-full max-w-3xl">
        <h2 class="text-2xl md:text-3xl text-purple-500 font-semibold mb-6">Add New Staff</h2>

        <form action="adduser.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="uname" class="block font-medium">Name of staff:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" pattern="[^0-9]*" id="uname" name="uname" required>
            </div>
            
            <div>
                <label for="uemail" class="block font-medium">Email:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500 " type="email" id="uemail" name="uemail"  required>
                <?php if (isset($errors['uemail'])): ?>
                <p class="text-red-500 text-sm mt-1"><?php echo htmlspecialchars("email already exist"); ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="upassword" class="block font-medium">password:</label>
                <input class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500 " type="password" id="upassword" name="upassword"  required>
                <?php if (isset($errors['upassword'])): ?>
                <p class="text-red-500 text-sm mt-1"><?php echo htmlspecialchars("email already exist"); ?></p>
                <?php endif; ?>
            </div>
            
            
            
            <div>
                <label for="addedby" class="block font-medium">urole:</label>
                <input placeholder="1=admin,2=staff" class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500" type="text" id="urole" name="urole" required>
            </div>
            
           
            <div>
                <label for="ustatus" class="block font-medium">Status:</label>
                <select id="ustatus" name="ustatus" class="border border-gray-300 w-full rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-span-1 md:col-span-2 flex justify-center">
                <input class="px-6 py-2 text-white bg-purple-600 border border-purple-600 rounded-md shadow-sm cursor-pointer hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50" type="submit" value="Add Staff">
            </div>
        </form>
    </div>
</body>

</html>
