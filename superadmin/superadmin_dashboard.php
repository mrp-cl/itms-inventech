<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="super_admin.css">
    <title>Super Admin Dashboard</title>
</head>

<body>

    <div class="sidebar">
        <img src="logo.png" alt="Logo">
        <h2>ITMS InvenTech</h2>
        <a href="super_admin.php" class="active">Dashboard</a>
        <a href="modify_admin.php">Modify Admin</a>
        <a href="analytics.php">Analytics</a>
        <a href="add_reports.php">Add Reports</a>
    </div>

    <div class="main">
        <div class="topnav">
            <div></div> <!-- for spacing if needed -->
            <div class="profile">
                <img src="avatar.png" alt="avatar">
                <!-- <div> NAME
                    <?php echo htmlspecialchars($admin['fullname']); ?>
                </div> -->
            </div>
        </div>

        <div class="content">
            <h1>ITMS Division / Office's</h1>
            <div class="grid">
                <?php foreach ($divisions as $div): ?>
                    <div class="card" onclick="location.href='<?php echo $div['link']; ?>'">
                        <?php echo htmlspecialchars($div['name']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>