<?php
session_start();
include("../config/db.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND status='active'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {

    //USER LOGIN BUTTON
    if (isset($_POST['user_login'])) {
        if ($user['role'] == 'user') {
            $_SESSION['user'] = $user;
            header("Location: ../pages/user_dashboard.php");
        } else {
            echo "Only users can login here!";
        }
    }

    //ADMIN LOGIN BUTTON
    if (isset($_POST['admin_login'])) {
        if ($user['role'] == 'admin') {
            $_SESSION['user'] = $user;
            header("Location: ../admin/admin_dashboard.php");
            echo "admin";
        } elseif ($user['role'] == 'superadmin') {
            $_SESSION['user'] = $user;
            header("Location: ../superadmin/superadmin_dashboard.php");
            echo "user";

        } else {
            echo "Access denied! Not an admin.";
        }
    }

} else {
    echo "Invalid login credentials!";
}
?>