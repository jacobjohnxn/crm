<?php
include '../connection.php';
session_start();

if ($_SESSION['urole'] !== 1) {
    header("Location: .../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $uid = $_GET['id'];
    $sql = "DELETE FROM user WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uid);
    
    if ($stmt->execute()) {
        echo "user deleted successfully";
        header("Location: staffs.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
    $stmt->close();
}



$conn->close();
?>