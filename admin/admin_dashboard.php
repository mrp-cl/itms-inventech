<?php
session_start();

// Check if logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

include("../config/db.php");

$division = $_SESSION['user']['division'];

/* =========================
   PAGINATION LOGIC
========================= */
$limit = 3;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1)
    $page = 1;

$offset = ($page - 1) * $limit;

// Count total users
$count_sql = "SELECT COUNT(*) as total FROM users 
              WHERE division='$division' 
              AND role='user' 
              AND status='active'";
$count_result = $conn->query($count_sql);
$total_rows = $count_result->fetch_assoc()['total'];

$total_pages = ceil($total_rows / $limit);
if ($page > $total_pages && $total_pages > 0) {
    $page = $total_pages;
}

// Fetch users
$sql = "SELECT * FROM users 
        WHERE division='$division' 
        AND role='user' 
        AND status='active'
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="./assets/admin_dashboard.css">
    <link rel="stylesheet" href="./assets/add_user_modal.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php include("./modals/add_user_modal.php"); ?>

    <!-- HEADER -->
    <header class="header">
        <div class="navbar">
            <div class="nav-left">
                <img src="../assets/img/ITMSLOGO.jpg" class="logo">
                <span class="title">ITMS INVENTECH</span>
            </div>

            <div class="admin-profile" id="adminProfile">
                <span>Admin</span>
                <div class="profile-avatar">A</div>

                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="../auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <div class="main-container">

        <!-- CONTENT -->
        <div class="content">
            <form method="POST" action="../admin/deactivate_user.php" id="bulkForm">
                <div class="content-header">
                    <h2>
                        <?= htmlspecialchars($division) ?>
                    </h2>

                    <!-- SEARCH -->
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search users...">
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="action-buttons">
                        <button class="btn btn-primary" onclick="openModal('addUserModal')">
                            Add User
                        </button>

                        <button type="button" class="btn btn-danger" onclick="submitDeactivate()">
                            Deactivate Selected
                        </button>
                    </div>
                </div>
                <div class="table-section">
                    <div class="table-header">
                        <input type="checkbox" id="selectAll">
                        <label>ENCODERS</label>
                    </div>

                    <?php if ($result && $result->num_rows > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="row-checkbox" name="user_ids[]"
                                                value="<?= $row['id'] ?>">
                                        </td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deactivateUser(<?= $row['id'] ?>)">
                                                Deactivate
                                            </button>
                                        </td>

                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>


                        <!-- PAGINATION -->
                        <?php if ($total_pages > 1): ?>
                            <div class="pagination">


                                <?php if ($page > 1): ?>
                                    <a href="?page=<?= $page - 1 ?>">Prev</a>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
                                        <?= $i ?>
                                    </a>
                                <?php endfor; ?>

                                <?php if ($page < $total_pages): ?>
                                    <a href="?page=<?= $page + 1 ?>">Next</a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <p class="empty-message">No data available.</p>
                    <?php endif; ?>

                </div>
            </form>
        </div>

        <h2 class="h2"><?= htmlspecialchars($division) ?></h2>
        <div class="table-section" style="margin-top: 30px;">
            <div class="table-header">
                <input type="checkbox" disabled>
                <label>EMPLOYEE</label>
            </div>

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="3" class="empty-message">
                            No data available.
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        // SEARCH
        document.getElementById('searchInput')?.addEventListener('keyup', function (e) {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
            });
        });

        // SELECT ALL
        document.getElementById('selectAll')?.addEventListener('change', function () {
            document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this.checked);
        });

        // DROPDOWN
        const adminProfile = document.getElementById("adminProfile");
        const dropdownMenu = document.getElementById("dropdownMenu");

        adminProfile.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function (e) {
            if (!adminProfile.contains(e.target)) {
                dropdownMenu.style.display = "none";
            }
        });

        // MODAL
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        // BULK DEACTIVATE
        function submitDeactivate() {
            const checked = document.querySelectorAll('.row-checkbox:checked');

            if (checked.length === 0) {
                Swal.fire({
                    title: 'No selection',
                    text: 'Please select at least one user.',
                    icon: 'warning'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'Selected users will be deactivated!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Yes, deactivate!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('bulkForm').submit();
                }
            });
        }

        // SINGLE DEACTIVATE
        function deactivateUser(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This user will be deactivated!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Yes, deactivate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../admin/deactivate_user.php?id=" + userId;
                }
            });
        }
    </script>

    <!-- ALERTS -->
    <?php if (isset($_GET['created'])): ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'User successfully created.',
                icon: 'success'
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['deactivated'])): ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'User(s) successfully deactivated.',
                icon: 'success'
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'email_exists'): ?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Email already exists.',
                icon: 'error'
            });
        </script>
    <?php endif; ?>

</body>

</html>