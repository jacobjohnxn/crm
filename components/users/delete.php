<?php
include '../connection.php';
session_start();

if ($_SESSION['urole'] !== 2) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $Cust_id = $_GET['id'];
    $sql = "DELETE FROM customer WHERE Cust_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Cust_id);
    
    if ($stmt->execute()) {
        echo "Product deleted successfully";
        header("Location: customeruserview.php");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
    $stmt->close();
}



$conn->close();
?>