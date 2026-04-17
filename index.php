
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>ITMS Inventech</title>

  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
  <!-- NAVBAR -->
  <div class="navbar">
    <div class="nav-left">
      <img src="assets/img/ITMSLOGO.jpg" alt="ITMS Logo" class="logo">
      <span class="title">ITMS INVENTECH</span>
    </div>

    <div class="nav-right">
      <button onclick="openModal()">LOGIN</button>
    </div>
  </div>
  <!-- LANDING CONTENT -->
  <div class="landing">
    <div class="content-wrapper">
      <!-- Logo Section -->
      <div class="logo-section">
        <img src="assets/img/ITMSLOGO.jpg" alt="ITSD Logo" class="seal-logo">
      </div>

      <!-- Text Section -->
      <div class="text-section">
        <h1 class="main-title">INVENTORY MANAGEMENT SYSTEM</h1>
      </div>
    </div>
  </div>

  <!-- USER LOGIN MODAL -->
  <div id="userModal" class="modal">
    <div class="login-card">
      <span class="close-btn" onclick="closeModal('userModal')">&times;</span>
      <h2>USER LOGIN</h2>

      <form method="POST" action="auth/login.php">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="user_login">Login</button>
      </form>

      <p class="or">or</p>

      <button class="admin-btn" onclick="openAdminModal()">
        Admin Login
      </button>

    </div>
  </div>


  <!-- ADMIN LOGIN MODAL -->
  <div id="adminModal" class="modal">
    <div class="login-card">
      <span class="close-btn" onclick="closeModal('adminModal')">&times;</span>
      <h2>ADMIN LOGIN</h2>

      <form method="POST" action="auth/login.php">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="admin_login" class="admin-btn">
          Login as Admin
        </button>
      </form>

      <p class="or">or</p>

      <button onclick="backToUser()">← Go to User Login</button>

    </div>
  </div>

  <script src="assets/js/script.js"></script>

</body>

</html>