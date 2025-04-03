<?php
include 'SQLConnect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "DELETE FROM tbl_users WHERE id=$user_id";

if (mysqli_query($conn, $sql)) {
    session_destroy();
    header("Location: register.php");
    exit();
}
?>
<a href="delete.php">Delete My Account</a>
