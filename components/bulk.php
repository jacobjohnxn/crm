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
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
        $fileName = $_FILES['csv_file']['name'];
        $fileSize = $_FILES['csv_file']['size'];
        $fileType = $_FILES['csv_file']['type'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        if ($fileExtension === 'csv') {
            if (($handle = fopen($fileTmpPath, 'r')) !== FALSE) {
                fgetcsv($handle); 
                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    list($Cust_fname, $Cust_lname, $Cust_email, $Cust_phone, $Cust_address, $Cust_business, $B_address, $B_industry, $state, $country, $zipcode, $B_phone, $B_email) = $data;

                    $stmt = $conn->prepare("SELECT * FROM customer WHERE Cust_email = ? OR Cust_phone = ? OR Cust_business = ? OR B_address = ? OR B_phone = ? OR B_email = ?");
                    $stmt->bind_param("ssssss", $Cust_email, $Cust_phone, $Cust_business, $B_address, $B_phone, $B_email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row['Cust_email'] === $Cust_email) {
                                $errors['Cust_email'] = "Email already exists.";
                            }
                            if ($row['Cust_phone'] === $Cust_phone) {
                                $errors['Cust_phone'] = "Phone number already exists.";
                            }
                            if ($row['Cust_business'] === $Cust_business) {
                                $errors['Cust_business'] = "Business name already exists.";
                            }
                            if ($row['B_address'] === $B_address) {
                                $errors['B_address'] = "Business address already exists.";
                            }
                            if ($row['B_phone'] === $B_phone) {
                                $errors['B_phone'] = "Business phone number already exists.";
                            }
                            if ($row['B_email'] === $B_email) {
                                $errors['B_email'] = "Business email already exists.";
                            }
                        }
                    }
                    $stmt->close();

                    if (empty($errors)) {
                        $stmt = $conn->prepare("INSERT INTO customer (Cust_fname, Cust_lname, Cust_email, Cust_phone, Cust_address, Cust_business, B_address, B_industry, state, country, zipcode, B_phone, B_email, addedby, updatedby, Cust_status, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                        $stmt->bind_param("sssssssssssssssss", $Cust_fname, $Cust_lname, $Cust_email, $Cust_phone, $Cust_address, $Cust_business, $B_address, $B_industry, $state, $country, $zipcode, $B_phone, $B_email, $addedby, $updatedby, $Cust_status, $status);

                        $addedby = $staffid;
                        $updatedby = $staffid;
                        $Cust_status = 'added';
                        $status = 'active';

                        $stmt->execute();
                        $stmt->close();
                    }
                }
                fclose($handle);

                if (empty($errors)) {
                    header("Location: users/customeruserview.php");
                    exit();
                } else {
                    foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                }
            } else {
                echo "Error reading the CSV file.";
            }
        } else {
            echo "Please upload a valid CSV file.";
        }
    } else {
        echo "Error uploading file.";
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
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="bg-white p-6 md:p-8 rounded-lg w-full max-w-3xl">
        <div class="flex flex-row">
            <h2 class="text-2xl md:text-3xl text-purple-500 font-semibold pt-16">Add New Customer</h2>
            <div class="ml-8 mb-2">
                <div class="max-w-md mx-auto p-6 bg-white rounded-md shadow-lg">
                    <div class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-md px-6 py-8 text-center">
                        <input type="file" name="csv_file" class="hidden" id="fileInput">

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Download the 
                            <a href="sample.csv" download="sample.csv" class="text-blue-500 hover:underline">sample.csv</a> and 
                            <label for="fileInput" class="cursor-pointer text-blue-500 hover:underline">upload</label> the data.
                        </p>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-md w-full mt-6 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:focus:ring-opacity-50">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

</body>

</html>