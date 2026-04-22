<?php
session_start();
include("../config/db.php");

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {

    // USER LOGIN
    if (isset($_POST['user_login'])) {

        if ($user['role'] == 'user') {
            $_SESSION['user'] = $user;
            header("Location: ../pages/user_dashboard.php");
            exit();
        } else {
            header("Location: ../index.php?error=not_user");
            exit();
        }
    }

    // ADMIN LOGIN
    if (isset($_POST['admin_login'])) {

        if ($user['role'] == 'admin') {
            $_SESSION['user'] = $user;
            header("Location: ../admin/admin_dashboard.php");
            exit();
        } elseif ($user['role'] == 'superadmin') {
            $_SESSION['user'] = $user;
            header("Location: ../superadmin/superadmin_dashboard.php");
            exit();
        } else {
            header("Location: ../index.php?error=not_admin");
            exit();
        }
    }

} else {
    header("Location: ../index.php?error=invalid");
    exit();
}