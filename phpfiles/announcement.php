<?php
$page_title = "Announcements - University Club";
include 'header.php';
include 'connection/db.php';
?>

<section class="page-content">
    <div class="container">
        <h1>Club Announcements</h1>
        
        <div class="announcements-list">
            <div class="announcement-item">
                <h3>Welcome to the University Club!</h3>
                <p class="announcement-date">Posted on: June 1, 2026</p>
                <p>We're excited to welcome all new members to our community. Check out our events and join us!</p>
            </div>

            <div class="announcement-item">
                <h3>Upcoming Workshop: Web Development</h3>
                <p class="announcement-date">Posted on: May 20, 2026</p>
                <p>Join us for an exciting workshop on modern web development techniques. Register now!</p>
            </div>

            <div class="announcement-item">
                <h3>Summer Events Scheduled</h3>
                <p class="announcement-date">Posted on: May 15, 2026</p>
                <p>Our summer events calendar is now live. Explore new activities and networking opportunities.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
