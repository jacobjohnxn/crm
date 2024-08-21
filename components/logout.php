<?php
session_start();

// if ($_SESSION['urole'] !== 1) {
//     header("Location: ../index.php");
//     exit();
// }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit();
}
?>
