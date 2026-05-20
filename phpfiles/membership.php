<?php
$page_title = "Membership - University Club";
include 'header.php';
include 'connection/db.php';
?>

<section class="page-content">
    <div class="container">
        <h1>Become a Member</h1>
        
        <div class="membership-content">
            <div class="membership-info">
                <h2>Membership Benefits</h2>
                <ul>
                    <li>Access to exclusive events and workshops</li>
                    <li>Network with tech enthusiasts</li>
                    <li>Learn new skills from industry experts</li>
                    <li>Project collaboration opportunities</li>
                    <li>Career development resources</li>
                    <li>Priority registration for events</li>
                </ul>
            </div>

            <div class="membership-form-wrapper">
                <form id="joinForm" class="membership-form">
                    <h2>Register Here</h2>
                    
                    <div class="form-group">
                        <label for="fullName">Full Name *</label>
                        <input type="text" id="fullName" name="fullName" required>
                        <span class="error" id="fullNameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                        <span class="error" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label for="studentId">Student ID *</label>
                        <input type="text" id="studentId" name="studentId" required>
                        <span class="error" id="studentIdError"></span>
                    </div>

                    <div class="form-group">
                        <label for="department">Department *</label>
                        <input type="text" id="department" name="department" required>
                        <span class="error" id="departmentError"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="interests">Interests (comma-separated)</label>
                        <input type="text" id="interests" name="interests" placeholder="e.g., Web Dev, AI, Networking">
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="terms" name="terms" required>
                            I agree to the membership terms and conditions *
                        </label>
                        <span class="error" id="termsError"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Join Now</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
