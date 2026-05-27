<?php
// Start session
session_start();
// Connect database
require 'db.php';
// Connect layout file
require_once 'layout.php';

// Check login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get role
$role = '';
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

// Redirect admin
if ($role === 'Admin') {
    header("Location: admin_profilepage.php");
    exit();
}

// Get student ID
$studentId = $_SESSION['username'];
// Get member details
$stmt = $conn->prepare(
    "SELECT student_id, first_name, last_name, course, batch, email, contact_no, interests, member_status, date_joined
     FROM member
     WHERE student_id = ?"
);
// Add student ID
$stmt->bind_param("s", $studentId);
// Run query
$stmt->execute();
// Get member data
$member = $stmt->get_result()->fetch_assoc();
// Close query
$stmt->close();
// Close database
$conn->close();

// Default first name
$memberFirstName = 'Member';
// Get first name
if ($member && isset($member['first_name'])) {
    $memberFirstName = $member['first_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Page settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Page title -->
  <title>UniClub | Member Profile</title>
  <!-- Connect CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- Custom cursor circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php 
// Show header
render_header('profile'); ?>

<main>
  <!-- Profile heading -->
  <section class="page-header profile-header">
    <p class="eyebrow">MEMBER PROFILE</p>
    <h1>
      Welcome back,
      <span><?= htmlspecialchars($memberFirstName) ?>.</span>
    </h1>
    <p>Your UniClub membership details are collected here so you can quickly check your profile, status, and contact information.</p>
  </section>

    <!-- Profile content -->
  <section class="profile-layout">
    <?php if ($member): ?>
      <!-- Profile summary -->
      <div class="profile-summary">
         <!-- Member initials -->
        <p class="profile-initials">
          <?= htmlspecialchars(strtoupper(substr($member['first_name'], 0, 1) . substr($member['last_name'], 0, 1))) ?>
        </p>
        <!-- Member name -->
        <h2><?= htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) ?></h2>
        <!-- Course -->
        <p><?= htmlspecialchars($member['course']) ?></p>
        <!-- Status -->
        <span><?= htmlspecialchars($member['member_status']) ?></span>
      </div>

      <!-- Member details -->
      <div class="profile-details">
        <h2>Membership Details</h2>
        <dl>
          <!-- Student ID -->
          <div>
            <dt>Student ID</dt>
            <dd><?= htmlspecialchars($member['student_id']) ?></dd>
          </div>
          <!-- Batch -->
          <div>
            <dt>Batch</dt>
            <dd><?= htmlspecialchars($member['batch']) ?></dd>
          </div>
          <!-- Email -->
          <div>
            <dt>Email</dt>
            <dd><?= htmlspecialchars($member['email']) ?></dd>
          </div>
          <!-- Contact number -->
          <div>
            <dt>Contact No</dt>
            <dd><?= htmlspecialchars($member['contact_no']) ?></dd>
          </div>
          <!-- Interests -->
          <div>
            <dt>Interests</dt>
            <dd><?= htmlspecialchars($member['interests']) ?></dd>
          </div>
          <!-- Date joined -->
          <div>
            <dt>Date Joined</dt>
            <dd><?= htmlspecialchars($member['date_joined']) ?></dd>
          </div>
        </dl>
      </div>
    <?php else: ?>
      <!-- No profile found -->
      <div class="profile-details full-width">
        <h2>Profile Not Found</h2>
        <p>Your account is logged in, but no member record could be found.</p>
      </div>
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
