<?php
session_start();
require 'db.php';
require_once 'layout.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$role = '';
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

if ($role === 'Admin') {
    header("Location: admin_profilepage.php");
    exit();
}

$studentId = $_SESSION['username'];
$stmt = $conn->prepare(
    "SELECT student_id, first_name, last_name, course, batch, email, contact_no, interests, member_status, date_joined
     FROM member
     WHERE student_id = ?"
);
$stmt->bind_param("s", $studentId);
$stmt->execute();
$member = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

$memberFirstName = 'Member';
if ($member && isset($member['first_name'])) {
    $memberFirstName = $member['first_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Member Profile</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="cursor-circle" id="cursorCircle"></div>

<?php render_header('profile'); ?>

<main>
  <section class="page-header profile-header">
    <p class="eyebrow">MEMBER PROFILE</p>
    <h1>
      Welcome back,
      <span><?= htmlspecialchars($memberFirstName) ?>.</span>
    </h1>
    <p>Your UniClub membership details are collected here so you can quickly check your profile, status, and contact information.</p>
  </section>

  <section class="profile-layout">
    <?php if ($member): ?>
      <div class="profile-summary">
        <p class="profile-initials">
          <?= htmlspecialchars(strtoupper(substr($member['first_name'], 0, 1) . substr($member['last_name'], 0, 1))) ?>
        </p>
        <h2><?= htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) ?></h2>
        <p><?= htmlspecialchars($member['course']) ?></p>
        <span><?= htmlspecialchars($member['member_status']) ?></span>
      </div>

      <div class="profile-details">
        <h2>Membership Details</h2>
        <dl>
          <div>
            <dt>Student ID</dt>
            <dd><?= htmlspecialchars($member['student_id']) ?></dd>
          </div>
          <div>
            <dt>Batch</dt>
            <dd><?= htmlspecialchars($member['batch']) ?></dd>
          </div>
          <div>
            <dt>Email</dt>
            <dd><?= htmlspecialchars($member['email']) ?></dd>
          </div>
          <div>
            <dt>Contact No</dt>
            <dd><?= htmlspecialchars($member['contact_no']) ?></dd>
          </div>
          <div>
            <dt>Interests</dt>
            <dd><?= htmlspecialchars($member['interests']) ?></dd>
          </div>
          <div>
            <dt>Date Joined</dt>
            <dd><?= htmlspecialchars($member['date_joined']) ?></dd>
          </div>
        </dl>
      </div>
    <?php else: ?>
      <div class="profile-details full-width">
        <h2>Profile Not Found</h2>
        <p>Your account is logged in, but no member record could be found.</p>
      </div>
    <?php endif; ?>
  </section>
</main>

<?php render_footer(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
