<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}


// BULK DEACTIVATE
if (!empty($_POST['user_ids'])) {

    $ids = array_map('intval', $_POST['user_ids']);
    $idList = implode(',', $ids);

    $conn->query("UPDATE users SET status='inactive' WHERE id IN ($idList)");

    header("Location: ../admin/admin_dashboard.php?deactivated=1");
    exit();
}

//single deactivate
if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $conn->query("UPDATE users SET status='inactive' WHERE id = $id");

    header("Location: ../admin/admin_dashboard.php?deactivated=1");
    exit();
}

/* =========================
   FALLBACK
========================= */
header("Location: ../admin/admin_dashboard.php");
exit();