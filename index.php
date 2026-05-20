<?php
$page_title = "Home - University Club";
include 'phpfiles/header.php';
?>

    <section class="hero">
        <div class="hero-content">
            <h2>Welcome to Our University Club</h2>
            <p>Connect with members and participate in club activities</p>
            <a href="/WebDev-Group-Project/phpfiles/membership.php" class="btn btn-primary">Join Our Community</a>
        </div>
    </section>

    <section class="announcements">
        <div class="container">
            <h2>Latest Announcements</h2>
            <div class="announcements-preview">
                <div class="announcement-card">
                    <h3>Welcome to the University Club!</h3>
                    <p>We're excited to welcome all new members to our community. Check out our events and join us!</p>
                    <a href="/WebDev-Group-Project/phpfiles/announcement.php" class="btn btn-secondary">View All</a>
                </div>
            </div>
        </div>
    </section>

    <section class="events">
        <div class="container">
            <h2>Upcoming Events</h2>
            <div class="events-grid">
                <div class="event-card">
                    <h3>Web Development Workshop</h3>
                    <p class="event-date">Date: June 10, 2026</p>
                    <p>Learn the latest web development frameworks and best practices.</p>
                    <a href="/WebDev-Group-Project/phpfiles/events.php" class="btn btn-secondary">View More Events</a>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Why Join Us?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <h3>Learn & Grow</h3>
                    <p>Access to workshops and training from industry experts</p>
                </div>
                <div class="feature-card">
                    <h3>Network</h3>
                    <p>Connect with like-minded students and professionals</p>
                </div>
                <div class="feature-card">
                    <h3>Collaborate</h3>
                    <p>Work on exciting projects with talented team members</p>
                </div>
                <div class="feature-card">
                    <h3>Grow Your Career</h3>
                    <p>Gain valuable experience and career development resources</p>
                </div>
            </div>
        </div>
    </section>

    <section class="quick-links">
        <div class="container">
            <h2>Quick Access</h2>
            <div class="links-grid">
                <a href="/WebDev-Group-Project/phpfiles/about.php" class="quick-link-card">
                    <h3>About Us</h3>
                    <p>Learn more about our club's mission and history</p>
                </a>
                <a href="/WebDev-Group-Project/phpfiles/gallery.php" class="quick-link-card">
                    <h3>Gallery</h3>
                    <p>Check out photos from our past events</p>
                </a>
                <a href="/WebDev-Group-Project/phpfiles/membership.php" class="quick-link-card">
                    <h3>Membership</h3>
                    <p>Join our community today</p>
                </a>
                <a href="/WebDev-Group-Project/phpfiles/announcement.php" class="quick-link-card">
                    <h3>Announcements</h3>
                    <p>Stay updated with latest news</p>
                </a>
            </div>
        </div>
    </section>

<?php include 'phpfiles/footer.php'; ?>
