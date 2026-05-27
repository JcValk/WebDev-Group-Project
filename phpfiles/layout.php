<?php
// Header function
function render_header($active = '', $fromRoot = false) {
    // File path
    $prefix = $fromRoot ? 'phpfiles/' : '';
    // Home link
    $home = $fromRoot ? 'index.php' : '../index.php';
    // Check login
    $loggedIn = isset($_SESSION['username']);
    // Default role
    $role = '';

    // Get role
    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
    }

    // Check if admin
    $isAdmin = $loggedIn && $role === 'Admin';
    // Profile link
    $profileLink = $isAdmin ? $prefix . 'admin_profilepage.php' : $prefix . 'member_profilepage.php';
?>
<!-- Navigation bar -->
<nav class="navbar">
  <!-- Website logo -->
  <div class="logo">
    <span></span>
    UniClub
  </div>

  <!-- Navigation links -->
  <div class="nav-links">
     <!-- Home -->
    <a href="<?= $home ?>" class="<?= $active === 'home' ? 'active' : '' ?>">Home</a>
     <!-- About -->
    <a href="<?= $prefix ?>about.php" class="<?= $active === 'about' ? 'active' : '' ?>">About</a>
     <!-- Membership -->
    <?php if (!$loggedIn): ?>
      <a href="<?= $prefix ?>membership.php" class="<?= $active === 'membership' ? 'active' : '' ?>">Membership</a>
    <?php endif; ?>
    <!-- Announcements -->
    <a href="<?= $prefix ?>announcements.php" class="<?= $active === 'announcements' ? 'active' : '' ?>">Announcements</a>
     <!-- Events -->
    <a href="<?= $prefix ?>events.php" class="<?= $active === 'events' ? 'active' : '' ?>">Events</a>

     <!-- Admin menu -->
    <?php if ($isAdmin): ?>
      <!-- Manage announcements -->
      <a href="<?= $prefix ?>admin_announcements.php" class="<?= $active === 'admin_announcements' ? 'active' : '' ?>">Manage Announcements</a>
      <!-- Manage events -->
      <a href="<?= $prefix ?>event_admin.php" class="<?= $active === 'event_admin' ? 'active' : '' ?>">Manage Events</a>
    <?php endif; ?>

    <!-- Logged in menu -->
    <?php if ($loggedIn): ?>
       <!-- Profile -->
      <a href="<?= $profileLink ?>" class="<?= $active === 'profile' ? 'active' : '' ?>">Profile</a>
       <!-- Logout -->
      <a href="<?= $prefix ?>logout.php">Logout</a>
    <?php else: ?>
      <!-- Login -->
      <a href="<?= $prefix ?>login.php" class="<?= $active === 'login' ? 'active' : '' ?>">Log in</a>
    <?php endif; ?>
  </div>
</nav>
<?php
}

// Footer function
function render_footer($fromRoot = false) {
    // File path
    $prefix = $fromRoot ? 'phpfiles/' : '';
    // Home link
    $home = $fromRoot ? 'index.php' : '../index.php';
?>

<!-- Footer -->
<footer class="footer">
  <!-- Footer logo -->
  <div class="footer-logo">
    <span></span>
    UniClub
  </div>

   <!-- Footer links -->
  <div class="footer-links">
    <a href="<?= $home ?>">Home</a>
    <a href="<?= $prefix ?>about.php">About</a>
    <a href="<?= $prefix ?>membership.php">Membership</a>
    <a href="<?= $prefix ?>announcements.php">Announcements</a>
    <a href="<?= $prefix ?>events.php">Events</a>
  </div>

  <p>© 2026 UniClub. All rights reserved.</p>
</footer>
<?php
}
?>
