<?php
include 'connection.php';
session_start();

if ($_SESSION['urole'] !== 2) {
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
<form action="logout.php" method="post">
        <div class="flex justify-end">
            <button type="submit" name="logout" class="absolute top-4 right-4 px-4 py-2 text-white bg-red-500 border border-gray-600 rounded-md shadow-sm cursor-pointer hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Logout</button>
        </div>
    </form>
    <h1 class="text-5xl  text-gray-800 font-bold mb-8 text-center">Welcome to H-CRM</h1>
    <ul class="flex flex-col items-center space-y-4">
        <li>
            <a href="users/customeruserview.php" class="text-2xl md:text-3xl text-purple-600 hover:text-purple-800 transition-colors duration-200">#customers</a>
        </li>
    </ul>
</body>
</html>
