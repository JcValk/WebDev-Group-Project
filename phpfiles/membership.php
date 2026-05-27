<?php 
// Start session
session_start();
// Connect database
require_once 'db.php';
// Connect layout file
require_once 'layout.php';

// Default messages
$formMessage = '';
$formMessageClass = '';
// Default form values
$firstName = '';
$lastName = '';
$email = '';
$studentId = '';
$contactNo = '';
$course = '';
$batch = '';
$interests = '';
$password = '';

// Check form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get student ID
    if (isset($_POST['studentId'])) {
        $studentId = trim($_POST['studentId']);
    }

    // Get first name
    if (isset($_POST['firstName'])) {
        $firstName = trim($_POST['firstName']);
    }

    // Get last name
    if (isset($_POST['lastName'])) {
        $lastName = trim($_POST['lastName']);
    }

    // Get email
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
    }

    // Get password
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
    }

    // Get course
    if (isset($_POST['course'])) {
        $course = trim($_POST['course']);
    }

    // Get batch
    if (isset($_POST['batch'])) {
        $batch = trim($_POST['batch']);
    }

    //Get contact number
    if (isset($_POST['contactNo'])) {
        $contactNo = trim($_POST['contactNo']);
    }

    // Get interests
    if (isset($_POST['interests'])) {
        $interests = trim($_POST['interests']);
    }

    // Check empty fields
    if ($studentId === '' || $firstName === '' || $lastName === '' || $email === '' || $password === '' || $course === '' || $batch === '' || $contactNo === '') {
        $formMessage = 'Please complete all required fields.';
        $formMessageClass = 'error';
     // Check numbers only
    } elseif (!ctype_digit($studentId) || !ctype_digit($contactNo)) {
        $formMessage = 'Student ID and contact number must contain numbers only.';
        $formMessageClass = 'error';
    } else {
      // Check existing member
        $checkStmt = $conn->prepare("SELECT student_id FROM member WHERE student_id = ?");
        $checkStmt->bind_param("s", $studentId);
        $checkStmt->execute();
        $checkStmt->store_result();

        // Student ID already exists

        if ($checkStmt->num_rows > 0) {
            $formMessage = 'A member with this Student ID already exists.';
            $formMessageClass = 'error';
        } else {
          // Default role
            $role = 'Member';
            // Default member status
            $memberStatus = 'New';
            // Current date
            $dateJoined = date('Y-m-d');
            // Encrypt password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert member
            $stmt = $conn->prepare(
                "INSERT INTO member
                (student_id, password, role, first_name, last_name, course, batch, email, contact_no, interests, member_status, date_joined)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            // Add values
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

            // Save member
            if ($stmt->execute()) {
                $formMessage = 'Registration submitted. You can now log in with your Student ID and password.';
                $formMessageClass = 'success';
                // Clear form
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
            // Close insert query
            $stmt->close();
        }
        // Close check query
        $checkStmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Page settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Page title -->
  <title>UniClub | Membership</title>
   <!-- Connect CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- Custom cursor circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php 
// Show header
render_header('membership'); ?>

<main>

  <!-- Membership heading -->
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

  <!-- Membership plans -->
  <section class="plan-grid">

    <!-- Explorer plan -->
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
    <!-- Member plan -->
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

     <!-- Committee plan -->
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

  <!-- Registration form -->
  <section class="form-section">
    <form id="joinForm" method="POST" class="join-form">
      <h2>Register as Member</h2>

      <!-- Form message -->
      <?php if ($formMessage !== ''): ?>
        <p class="form-message <?= htmlspecialchars($formMessageClass) ?>"><?= htmlspecialchars($formMessage) ?></p>
      <?php endif; ?>

      <!-- Name inputs -->
      <div class="form-row">
        <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?= htmlspecialchars($firstName) ?>" required>
        <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?= htmlspecialchars($lastName) ?>" required>
      </div>

      <!-- Email and password -->
      <div class="form-row">
        <input type="email" id="email" name="email" placeholder="Email Address" value="<?= htmlspecialchars($email) ?>" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>

      <!-- Student ID and contact -->
      <div class="form-row">
        <input type="text" id="studentId" name="studentId" placeholder="Student ID" value="<?= htmlspecialchars($studentId) ?>" required>
        <input type="text" id="contactNo" name="contactNo" placeholder="Contact Number" value="<?= htmlspecialchars($contactNo) ?>" required>
      </div>

      <!-- Course and batch -->
      <div class="form-row">
        <input type="text" id="course" name="course" placeholder="Course" value="<?= htmlspecialchars($course) ?>" required>
        <input type="text" id="batch" name="batch" placeholder="Batch" value="<?= htmlspecialchars($batch) ?>" required>
      </div>

      <!-- Interests -->
      <input type="text" id="interests" name="interests" placeholder="Interests" value="<?= htmlspecialchars($interests) ?>">

      <!-- Submit button -->
      <button type="submit">Submit Registration</button>

    </form>
  </section>

</main>

<?php 
// Show footer
render_footer(); ?>

<!-- Connect JavaScript -->
<script src="../backend/java.js"></script>

</body>
</html>
