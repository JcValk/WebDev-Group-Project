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

if ($role !== 'Admin') {
    header("Location: member_profilepage.php");
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
$admin = $stmt->get_result()->fetch_assoc();
$stmt->close();

$adminFirstName = 'Admin';
if ($admin && isset($admin['first_name'])) {
    $adminFirstName = $admin['first_name'];
}

$totalMembers = 0;
$newMembers = 0;
$activeMembers = 0;
$statsResult = $conn->query(
    "SELECT
        COUNT(*) AS total_members,
        SUM(member_status = 'New') AS new_members,
        SUM(member_status = 'Active') AS active_members
     FROM member"
);

if ($statsResult) {
    $stats = $statsResult->fetch_assoc();

    if (isset($stats['total_members'])) {
        $totalMembers = (int) $stats['total_members'];
    }

    if (isset($stats['new_members'])) {
        $newMembers = (int) $stats['new_members'];
    }

    if (isset($stats['active_members'])) {
        $activeMembers = (int) $stats['active_members'];
    }
}

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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Admin Profile</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="cursor-circle" id="cursorCircle"></div>

<?php render_header('profile'); ?>

<main>
  <section class="page-header profile-header">
    <p class="eyebrow">ADMIN PROFILE</p>
    <h1>
      Club dashboard,
      <span><?= htmlspecialchars($adminFirstName) ?>.</span>
    </h1>
    <p>Review your profile details and keep an eye on recent membership activity from one place.</p>
  </section>

  <section class="profile-layout admin-layout">
    <?php if ($admin): ?>
      <div class="profile-summary">
        <p class="profile-initials">
          <?= htmlspecialchars(strtoupper(substr($admin['first_name'], 0, 1) . substr($admin['last_name'], 0, 1))) ?>
        </p>
        <h2><?= htmlspecialchars($admin['first_name'] . ' ' . $admin['last_name']) ?></h2>
        <p><?= htmlspecialchars($admin['course']) ?></p>
        <span>Admin</span>
      </div>

      <div class="profile-details">
        <h2>Admin Details</h2>
        <dl>
          <div>
            <dt>Student ID</dt>
            <dd><?= htmlspecialchars($admin['student_id']) ?></dd>
          </div>
          <div>
            <dt>Email</dt>
            <dd><?= htmlspecialchars($admin['email']) ?></dd>
          </div>
          <div>
            <dt>Contact No</dt>
            <dd><?= htmlspecialchars($admin['contact_no']) ?></dd>
          </div>
          <div>
            <dt>Batch</dt>
            <dd><?= htmlspecialchars($admin['batch']) ?></dd>
          </div>
          <div>
            <dt>Date Joined</dt>
            <dd><?= htmlspecialchars($admin['date_joined']) ?></dd>
          </div>
        </dl>
      </div>
    <?php endif; ?>
  </section>

  <section class="admin-stats">
    <div>
      <h2><?= htmlspecialchars($totalMembers) ?></h2>
      <p>Total Members</p>
    </div>
    <div>
      <h2><?= htmlspecialchars($newMembers) ?></h2>
      <p>New Members</p>
    </div>
    <div>
      <h2><?= htmlspecialchars($activeMembers) ?></h2>
      <p>Active Members</p>
    </div>
  </section>

  <section class="recent-members">
    <h2>Recent Members</h2>
    <?php if ($recentMembers && $recentMembers->num_rows > 0): ?>
      <table>
        <tr>
          <th>Student ID</th>
          <th>Name</th>
          <th>Course</th>
          <th>Status</th>
          <th>Date Joined</th>
        </tr>
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
      <p>No member records found.</p>
    <?php endif; ?>
  </section>
</main>

<?php render_footer(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
<?php $conn->close(); ?>
