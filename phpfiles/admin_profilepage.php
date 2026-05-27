<?php
// Start session
session_start();
// Connect database
require 'db.php';
// Connect layout file
require_once 'layout.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get user role
$role = '';
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

// Allow admin only
if ($role !== 'Admin') {
    header("Location: member_profilepage.php");
    exit();
}

// Get logged in student ID
$studentId = $_SESSION['username'];
// Get admin information
$stmt = $conn->prepare(
    "SELECT student_id, first_name, last_name, course, batch, email, contact_no, interests, member_status, date_joined
     FROM member
     WHERE student_id = ?"
);
// Bind student ID
$stmt->bind_param("s", $studentId);
// Run query
$stmt->execute();
// Get admin data
$admin = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Default admin name
$adminFirstName = 'Admin';
// Get first name
if ($admin && isset($admin['first_name'])) {
    $adminFirstName = $admin['first_name'];
}

// Default statistics
$totalMembers = 0;
$newMembers = 0;
$activeMembers = 0;
// Get member statistics
$statsResult = $conn->query(
    "SELECT
        COUNT(*) AS total_members,
        SUM(member_status = 'New') AS new_members,
        SUM(member_status = 'Active') AS active_members
     FROM member"
);

// Check if query works
if ($statsResult) {
  // Get statistics data
    $stats = $statsResult->fetch_assoc();

    // Total members
    if (isset($stats['total_members'])) {
        $totalMembers = (int) $stats['total_members'];
    }
    // New members
    if (isset($stats['new_members'])) {
        $newMembers = (int) $stats['new_members'];
    }
    // Active members
    if (isset($stats['active_members'])) {
        $activeMembers = (int) $stats['active_members'];
    }
}

// Get recent members
$recentMembers = $conn->query(
    "SELECT student_id, first_name, last_name, course, member_status, date_joined
     FROM member
     ORDER BY date_joined DESC, student_id DESC
     LIMIT 5"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Page settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Page title --> 
  <title>UniClub | Admin Profile</title>
  <!-- Connect CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- Custom Cursor circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php 
// Show header
render_header('profile'); ?>

<main>
  <!-- Admin header -->
  <section class="page-header profile-header">
    <p class="eyebrow">ADMIN PROFILE</p>
    <!-- Welcome title -->
    <h1>
      Club dashboard,
      <span><?= htmlspecialchars($adminFirstName) ?>.</span>
    </h1>
    <!-- Short description -->
    <p>Review your profile details and keep an eye on recent membership activity from one place.</p>
  </section>

  <!-- Profile layout -->
  <section class="profile-layout admin-layout">
    <?php if ($admin): ?>

      <!-- Profile summary -->
      <div class="profile-summary">
        <!-- Admin initials -->
        <p class="profile-initials">
          <?= htmlspecialchars(strtoupper(substr($admin['first_name'], 0, 1) . substr($admin['last_name'], 0, 1))) ?>
        </p>
        <!-- Admin name -->
        <h2><?= htmlspecialchars($admin['first_name'] . ' ' . $admin['last_name']) ?></h2>
        <!-- Course -->
        <p><?= htmlspecialchars($admin['course']) ?></p>
        <!-- Role -->
        <span>Admin</span>
      </div>

      <!-- Admin details -->
      <div class="profile-details">
        <h2>Admin Details</h2>
        <dl>
          <!-- Student ID -->
          <div>
            <dt>Student ID</dt>
            <dd><?= htmlspecialchars($admin['student_id']) ?></dd>
          </div>
          <!-- Email -->
          <div>
            <dt>Email</dt>
            <dd><?= htmlspecialchars($admin['email']) ?></dd>
          </div>
          <!-- Contact number -->
          <div>
            <dt>Contact No</dt>
            <dd><?= htmlspecialchars($admin['contact_no']) ?></dd>
          </div>
          <!-- Batch -->
          <div>
            <dt>Batch</dt>
            <dd><?= htmlspecialchars($admin['batch']) ?></dd>
          </div>
          <!-- Date joined -->
          <div>
            <dt>Date Joined</dt>
            <dd><?= htmlspecialchars($admin['date_joined']) ?></dd>
          </div>
        </dl>
      </div>
    <?php endif; ?>
  </section>

   <!-- Statistics section -->
  <section class="admin-stats">
    <!-- Total members -->
    <div>
      <h2><?= htmlspecialchars($totalMembers) ?></h2>
      <p>Total Members</p>
    </div>
    <!-- New members -->
    <div>
      <h2><?= htmlspecialchars($newMembers) ?></h2>
      <p>New Members</p>
    </div>
    <!-- Active members -->
    <div>
      <h2><?= htmlspecialchars($activeMembers) ?></h2>
      <p>Active Members</p>
    </div>
  </section>

  <!-- Recent members table --> 
  <section class="recent-members">
    <h2>Recent Members</h2>
    <?php if ($recentMembers && $recentMembers->num_rows > 0): ?>
      <table>
        <!-- Table heading -->
        <tr>
          <th>Student ID</th>
          <th>Name</th>
          <th>Course</th>
          <th>Status</th>
          <th>Date Joined</th>
        </tr>

        <!-- Show member list -->
        <?php while ($member = $recentMembers->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($member['student_id']) ?></td>
            <td><?= htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) ?></td>
            <td><?= htmlspecialchars($member['course']) ?></td>
            <td><?= htmlspecialchars($member['member_status']) ?></td>
            <td><?= htmlspecialchars($member['date_joined']) ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <!-- No members message -->
      <p>No member records found.</p>
    <?php endif; ?>
  </section>
</main>

<?php 
// Show footer
render_footer(); ?>

<!-- Connect JavaScript -->
<script src="../backend/java.js"></script>

</body>
</html>
<?php 
// Close database
$conn->close(); ?>
