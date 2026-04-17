<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_POST) {
    $user_id = $_POST['user_id'];
    $type = $_POST['device_type'];
    $desc = $_POST['device_desc'];

    $conn->query("INSERT INTO devices(user_id,type,description) VALUES('$user_id','$type','$desc')");
    $msg = "Device Added!";
}

// Fetch all users in this admin division
$division = $_SESSION['user']['division'];
$users = $conn->query("SELECT * FROM users WHERE division='$division' AND role='user'");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Device</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <h2>Add Device</h2>
    <?php if (isset($msg))
        echo "<p style='color:green;'>$msg</p>"; ?>

    <form method="POST">
        <select name="user_id" required>
            <option value="">Select User</option>
            <?php while ($u = $users->fetch_assoc()): ?>
                <option value="<?= $u['id'] ?>">
                    <?= $u['email'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input name="device_type" placeholder="Device Type" required>
        <input name="device_desc" placeholder="Description" required>
        <button type="submit">Add Device</button>
    </form>

</body>

</html>