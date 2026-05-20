<?php
$page_title = "Login - University Club";
include '../header.php';
include '../connection/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        // Placeholder for actual authentication logic
        // In production, use password_hash() and password_verify()
        $_SESSION['user_id'] = 1;
        $_SESSION['email'] = $email;
        header('Location: /WebDev-Group-Project/index.php');
        exit;
    }
}
?>

<section class="page-content">
    <div class="container">
        <div class="login-container">
            <h1>Login</h1>
            
            <form method="POST" class="login-form">
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <p class="login-footer">
                Don't have an account? <a href="/WebDev-Group-Project/phpfiles/membership.php">Join Us</a>
            </p>
        </div>
    </div>
</section>

<?php include '../footer.php'; ?>
