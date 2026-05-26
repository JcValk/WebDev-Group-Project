<?php
function render_header($active = '', $fromRoot = false) {
    $prefix = $fromRoot ? 'phpfiles/' : '';
    $home = $fromRoot ? 'index.php' : '../index.php';
    $loggedIn = isset($_SESSION['username']);
    $role = '';

    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
    }

    $isAdmin = $loggedIn && $role === 'Admin';
    $profileLink = $isAdmin ? $prefix . 'admin_profilepage.php' : $prefix . 'member_profilepage.php';
?>
<nav class="navbar">
  <div class="logo">
    <span></span>
    UniClub
  </div>

  <div class="nav-links">
    <a href="<?= $home ?>" class="<?= $active === 'home' ? 'active' : '' ?>">Home</a>
    <a href="<?= $prefix ?>about.php" class="<?= $active === 'about' ? 'active' : '' ?>">About</a>
    <?php if (!$loggedIn): ?>
      <a href="<?= $prefix ?>membership.php" class="<?= $active === 'membership' ? 'active' : '' ?>">Membership</a>
    <?php endif; ?>
    <a href="<?= $prefix ?>announcements.php" class="<?= $active === 'announcements' ? 'active' : '' ?>">Announcements</a>
    <a href="<?= $prefix ?>events.php" class="<?= $active === 'events' ? 'active' : '' ?>">Events</a>

    <?php if ($isAdmin): ?>
      <a href="<?= $prefix ?>admin_announcements.php" class="<?= $active === 'admin_announcements' ? 'active' : '' ?>">Manage Announcements</a>
      <a href="<?= $prefix ?>event_admin.php" class="<?= $active === 'event_admin' ? 'active' : '' ?>">Manage Events</a>
    <?php endif; ?>

    <?php if ($loggedIn): ?>
      <a href="<?= $profileLink ?>" class="<?= $active === 'profile' ? 'active' : '' ?>">Profile</a>
      <a href="<?= $prefix ?>logout.php">Logout</a>
    <?php else: ?>
      <a href="<?= $prefix ?>login.php" class="<?= $active === 'login' ? 'active' : '' ?>">Log in</a>
    <?php endif; ?>
  </div>
</nav>
<?php
}

function render_footer($fromRoot = false) {
    $prefix = $fromRoot ? 'phpfiles/' : '';
    $home = $fromRoot ? 'index.php' : '../index.php';
?>
<footer class="footer">
  <div class="footer-logo">
    <span></span>
    UniClub
  </div>

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
