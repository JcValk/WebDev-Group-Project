<?php
$page_title = "Events - University Club";
include 'header.php';
include 'connection/db.php';
?>

<section class="page-content">
    <div class="container">
        <h1>Club Events</h1>
        
        <div class="filter-section">
            <input 
                type="text" 
                id="eventSearch" 
                placeholder="Search events..." 
                class="search-box"
            >
            <select id="eventFilter" class="filter-dropdown">
                <option value="">All Categories</option>
                <option value="workshop">Workshop</option>
                <option value="meeting">Meeting</option>
                <option value="social">Social</option>
                <option value="competition">Competition</option>
            </select>
        </div>

        <div class="events-grid">
            <div class="event-card">
                <h3>Web Development Workshop</h3>
                <p class="event-date">Date: June 10, 2026</p>
                <p class="event-category">Category: Workshop</p>
                <p>Learn the latest web development frameworks and best practices.</p>
                <button class="btn btn-secondary">Learn More</button>
            </div>

            <div class="event-card">
                <h3>Monthly Networking Meetup</h3>
                <p class="event-date">Date: June 15, 2026</p>
                <p class="event-category">Category: Social</p>
                <p>Connect with fellow club members and industry professionals.</p>
                <button class="btn btn-secondary">Learn More</button>
            </div>

            <div class="event-card">
                <h3>Hackathon 2026</h3>
                <p class="event-date">Date: June 20-22, 2026</p>
                <p class="event-category">Category: Competition</p>
                <p>Showcase your skills in our annual hackathon competition.</p>
                <button class="btn btn-secondary">Learn More</button>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
