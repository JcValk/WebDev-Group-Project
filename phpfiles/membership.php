<?php session_start();
require_once 'db.php';
require_once 'layout.php';

$formMessage = '';
$formMessageClass = '';
$firstName = '';
$lastName = '';
$email = '';
$studentId = '';
$contactNo = '';
$course = '';
$batch = '';
$interests = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['studentId'])) {
        $studentId = trim($_POST['studentId']);
    }

    if (isset($_POST['firstName'])) {
        $firstName = trim($_POST['firstName']);
    }

    if (isset($_POST['lastName'])) {
        $lastName = trim($_POST['lastName']);
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
    }

    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
    }

    if (isset($_POST['course'])) {
        $course = trim($_POST['course']);
    }

    if (isset($_POST['batch'])) {
        $batch = trim($_POST['batch']);
    }

    if (isset($_POST['contactNo'])) {
        $contactNo = trim($_POST['contactNo']);
    }

    if (isset($_POST['interests'])) {
        $interests = trim($_POST['interests']);
    }

    if ($studentId === '' || $firstName === '' || $lastName === '' || $email === '' || $password === '' || $course === '' || $batch === '' || $contactNo === '') {
        $formMessage = 'Please complete all required fields.';
        $formMessageClass = 'error';
    } elseif (!ctype_digit($studentId) || !ctype_digit($contactNo)) {
        $formMessage = 'Student ID and contact number must contain numbers only.';
        $formMessageClass = 'error';
    } else {
        $checkStmt = $conn->prepare("SELECT student_id FROM member WHERE student_id = ?");
        $checkStmt->bind_param("s", $studentId);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $formMessage = 'A member with this Student ID already exists.';
            $formMessageClass = 'error';
        } else {
            $role = 'Member';
            $memberStatus = 'New';
            $dateJoined = date('Y-m-d');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO member
                (student_id, password, role, first_name, last_name, course, batch, email, contact_no, interests, member_status, date_joined)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssssssssssss",
                $studentId,
                $hashedPassword,
                $role,
                $firstName,
                $lastName,
                $course,
                $batch,
                $email,
                $contactNo,
                $interests,
                $memberStatus,
                $dateJoined
            );

            if ($stmt->execute()) {
                $formMessage = 'Registration submitted. You can now log in with your Student ID and password.';
                $formMessageClass = 'success';
                $firstName = '';
                $lastName = '';
                $email = '';
                $studentId = '';
                $contactNo = '';
                $course = '';
                $batch = '';
                $interests = '';
            } else {
                $formMessage = 'Registration could not be saved. Please try again.';
                $formMessageClass = 'error';
            }

            $stmt->close();
        }

        $checkStmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Membership</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="cursor-circle" id="cursorCircle"></div>

<?php render_header('membership'); ?>
<main>

  <section class="page-header">
    <p class="eyebrow">MEMBERSHIP</p>

    <h1>
      Join the club and start
      <span>building connections.</span>
    </h1>

    <p>
      Register as a member to receive club updates, join events, and become part
      of the student community.
    </p>
  </section>

  <section class="plan-grid">

    <div class="plan-card">
      <h2>Explorer</h2>
      <h3>Free</h3>
      <ul>
        <li>Club event access</li>
        <li>Community updates</li>
        <li>Student activities</li>
      </ul>
      <a href="#joinForm" class="plan-button">Get Started</a>
    </div>

    <div class="plan-card featured-plan">
      <p class="plan-tag">MOST POPULAR</p>
      <h2>Member</h2>
      <h3>Free</h3>
      <ul>
        <li>Workshops access</li>
        <li>Networking events</li>
        <li>Career support</li>
        <li>Leadership activities</li>
      </ul>
      <a href="#joinForm" class="plan-button">Join Now</a>
    </div>

    <div class="plan-card">
      <h2>Committee</h2>
      <h3>Selected</h3>
      <ul>
        <li>Event planning</li>
        <li>Team leadership</li>
        <li>Club operations</li>
      </ul>
      <a href="#joinForm" class="plan-button">Apply</a>
    </div>

  </section>

  <section class="form-section">
    <form id="joinForm" method="POST" class="join-form">
      <h2>Register as Member</h2>

      <?php if ($formMessage !== ''): ?>
        <p class="form-message <?= htmlspecialchars($formMessageClass) ?>"><?= htmlspecialchars($formMessage) ?></p>
      <?php endif; ?>

      <div class="form-row">
        <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?= htmlspecialchars($firstName) ?>" required>
        <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?= htmlspecialchars($lastName) ?>" required>
      </div>

      <div class="form-row">
        <input type="email" id="email" name="email" placeholder="Email Address" value="<?= htmlspecialchars($email) ?>" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>

      <div class="form-row">
        <input type="text" id="studentId" name="studentId" placeholder="Student ID" value="<?= htmlspecialchars($studentId) ?>" required>
        <input type="text" id="contactNo" name="contactNo" placeholder="Contact Number" value="<?= htmlspecialchars($contactNo) ?>" required>
      </div>

      <div class="form-row">
        <input type="text" id="course" name="course" placeholder="Course" value="<?= htmlspecialchars($course) ?>" required>
        <input type="text" id="batch" name="batch" placeholder="Batch" value="<?= htmlspecialchars($batch) ?>" required>
      </div>

      <input type="text" id="interests" name="interests" placeholder="Interests" value="<?= htmlspecialchars($interests) ?>">

      <button type="submit">Submit Registration</button>

    </form>
  </section>

</main>

<?php render_footer(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
