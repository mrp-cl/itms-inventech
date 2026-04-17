<?php
session_start();
include("../config/db.php");

// 🔒 Security
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

// ✅ HEADER USER DATA
$name = $_SESSION['user']['name'] ?? 'User';
$role = $_SESSION['user']['role'] ?? 'User';
$initial = strtoupper(substr($name, 0, 1));

/* ===== FILTER & SEARCH ===== */
$type = $_GET['type'] ?? '';
$search = $_GET['search'] ?? '';

$where = "WHERE user_id='$user_id'";

if ($type != '') {
    $where .= " AND type='$type'";
}

if ($search != '') {
    $where .= " AND description LIKE '%$search%'";
}

/* ===== PAGINATION ===== */
$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1)
    $page = 1;

$offset = ($page - 1) * $limit;

$count = $conn->query("SELECT COUNT(*) as total FROM devices $where");
$total_rows = $count->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

/* ===== FETCH ===== */
$sql = "SELECT * FROM devices $where LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/user.css">
</head>

<body>

    <!-- ✅ HEADER -->
    <header class="header">
        <div class="navbar">
            <div class="nav-left">
                <img src="../assets/img/ITMSLOGO.jpg" class="logo">
                <span class="title">ITMS INVENTECH</span>
            </div>

            <div class="admin-profile" id="adminProfile">
                <span><?= htmlspecialchars($role) ?></span>
                <div class="profile-avatar"><?= $initial ?></div>

                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="../auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <h1 class="title">ARMD</h1>

    <!-- SEARCH -->
    <div class="top-bar">
        <form method="GET">
            <div class="search-box">
                <input type="text" name="search" placeholder="Search" value="<?= htmlspecialchars($search) ?>">
            </div>
        </form>

        <button class="add-btn">Add user</button>
    </div>

    <!-- FILTERS -->
    <div class="filters">
        <button onclick="filterType('desktop')">Desktop</button>
        <button onclick="filterType('laptop')">Laptop</button>
        <button onclick="filterType('printer')">Printer</button>
        <button onclick="filterType('router')">Router</button>
        <button onclick="filterType('')">All</button>
    </div>

    <!-- TABLE -->
    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Device Type</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td><?= ucfirst($row['type']) ?></td>
                            <td>
                                <!-- PREVIEW -->
                                <button class="icon-btn view"
                                    onclick="openPreview('<?= $row['id'] ?>','<?= htmlspecialchars($row['description']) ?>','<?= $row['type'] ?>')">
                                    👁️
                                </button>

                                <!-- EDIT -->
                                <a href="edit_device.php?id=<?= $row['id'] ?>">
                                    <button class="icon-btn edit">✏️</button>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No devices assigned</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&type=<?= $type ?>&search=<?= $search ?>">Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>&type=<?= $type ?>&search=<?= $search ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>&type=<?= $type ?>&search=<?= $search ?>">Next</a>
        <?php endif; ?>
    </div>

    <!-- FILTER SCRIPT -->
    <script>
        function filterType(type) {
            const search = "<?= $search ?>";
            window.location.href = "?type=" + type + "&search=" + search;
        }
    </script>

    <!-- MODAL -->
    <div id="previewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePreview()">&times;</span>

            <h2>Device Details</h2>
            <p><strong>Username:</strong> <span id="previewName"></span></p>
            <p><strong>Device Type:</strong> <span id="previewType"></span></p>
        </div>
    </div>

    <!-- MODAL + DROPDOWN SCRIPT -->
    <script>
        function openPreview(id, name, type) {
            document.getElementById("previewName").innerText = name;
            document.getElementById("previewType").innerText = type;
            document.getElementById("previewModal").style.display = "block";
        }

        function closePreview() {
            document.getElementById("previewModal").style.display = "none";
        }

        window.onclick = function (event) {
            let modal = document.getElementById("previewModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        // ✅ DROPDOWN FIX
        const adminProfile = document.getEl entById("adminProfile");
        const dropdownMenu = document.getElementById("dropdownMenu");

        adminProfile.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function () {
            dropdownMenu.style.display = "none";
        });
    </script>

</body>

</html>