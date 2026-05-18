let announcements = [];
let events = [];
let members = [];

let currentPage = 1;
const itemsPerPage = 3;
let filteredEvents = [...events];

document.addEventListener('DOMContentLoaded', function() {
    displayAnnouncements();
    displayEvents();
    displayMembers();
    setupEventListeners();
    setupFormValidation();
});

function setupEventListeners() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    navToggle.addEventListener('click', function() {
        navMenu.classList.toggle('active');
    });

    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
        });
    });

    const eventSearch = document.getElementById('eventSearch');
    const eventFilter = document.getElementById('eventFilter');

    eventSearch.addEventListener('keyup', filterEvents);
    eventFilter.addEventListener('change', filterEvents);
}

function displayAnnouncements() {
    const announcementsGrid = document.getElementById('announcementsGrid');
    announcementsGrid.innerHTML = '';

    announcements.forEach(announcement => {
        const card = document.createElement('div');
        card.className = 'announcement-card';
        
        const formattedDate = new Date(announcement.date).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        card.innerHTML = `
            <h3>${announcement.title}</h3>
            <p class="announcement-date">${formattedDate} • By ${announcement.author}</p>
            <p>${announcement.content}</p>
        `;

        announcementsGrid.appendChild(card);
    });
}

function displayEvents() {
    currentPage = 1;
    renderEventPage();
}

function renderEventPage() {
    const eventsGrid = document.getElementById('eventsGrid');
    eventsGrid.innerHTML = '';


    const totalPages = Math.ceil(filteredEvents.length / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedEvents = filteredEvents.slice(startIndex, endIndex);

    if (paginatedEvents.length === 0) {
        eventsGrid.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #999;">No events found.</p>';
    } else {
        paginatedEvents.forEach(event => {
            const card = document.createElement('div');
            card.className = 'event-card';

            const eventDate = new Date(event.date).toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });

            card.innerHTML = `
                <div class="event-header">
                    <span class="event-category">${capitalizeFirst(event.category)}</span>
                    <h3>${event.title}</h3>
                </div>
                <div class="event-body">
                    <div class="event-details">
                        <div><strong>📅 Date:</strong> ${eventDate}</div>
                        <div><strong>🕒 Time:</strong> ${event.time}</div>
                        <div><strong>📍 Location:</strong> ${event.location}</div>
                        <div><strong>👥 Attendees:</strong> ${event.attendees}/${event.capacity}</div>
                    </div>
                    <p class="event-description">${event.description}</p>
                    <button class="btn btn-primary" onclick="registerForEvent(${event.id})">Register</button>
                </div>
            `;

            eventsGrid.appendChild(card);
        });
    }

    renderPagination(totalPages);
}

function filterEvents() {
    const searchText = document.getElementById('eventSearch').value.toLowerCase();
    const categoryFilter = document.getElementById('eventFilter').value;

    filteredEvents = events.filter(event => {
        const matchesSearch = 
            event.title.toLowerCase().includes(searchText) ||
            event.description.toLowerCase().includes(searchText) ||
            event.location.toLowerCase().includes(searchText);

        const matchesCategory = categoryFilter === '' || event.category === categoryFilter;

        return matchesSearch && matchesCategory;
    });

    renderEventPage();
}

function renderPagination(totalPages) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    if (totalPages <= 1) return;

    const prevBtn = document.createElement('button');
    prevBtn.textContent = '← Previous';
    prevBtn.disabled = currentPage === 1;
    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderEventPage();
            scrollToEvents();
        }
    });
    pagination.appendChild(prevBtn);

    for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.textContent = i;
        pageBtn.className = currentPage === i ? 'active' : '';
        pageBtn.addEventListener('click', () => {
            currentPage = i;
            renderEventPage();
            scrollToEvents();
        });
        pagination.appendChild(pageBtn);
    }

    const nextBtn = document.createElement('button');
    nextBtn.textContent = 'Next →';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            renderEventPage();
            scrollToEvents();
        }
    });
    pagination.appendChild(nextBtn);
}

function scrollToEvents() {
    const eventsSection = document.getElementById('events');
    eventsSection.scrollIntoView({ behavior: 'smooth' });
}

function registerForEvent(eventId) {
    const event = events.find(e => e.id === eventId);
    if (event) {
        alert(`Thank you for registering for: ${event.title}\n\nA confirmation email will be sent shortly.`);
    }
}

function displayMembers() {
    const membersList = document.getElementById('membersList');
    const memberCount = document.getElementById('memberCount');

    membersList.innerHTML = '';

    members.forEach(member => {
        const card = document.createElement('div');
        card.className = 'member-card';
        card.innerHTML = `
            <h4>${member.name}</h4>
            <p><strong>${member.role}</strong></p>
            <p>${member.department}</p>
        `;
        membersList.appendChild(card);
    });

    memberCount.textContent = `Total Members: ${members.length}`;
}

function setupFormValidation() {
    const joinForm = document.getElementById('joinForm');
    joinForm.addEventListener('submit', handleJoinSubmit);

    const contactForm = document.getElementById('contactForm');
    contactForm.addEventListener('submit', handleContactSubmit);

    const fullName = document.getElementById('fullName');
    const email = document.getElementById('email');
    const studentId = document.getElementById('studentId');

    fullName.addEventListener('blur', validateFullName);
    email.addEventListener('blur', validateEmail);
    studentId.addEventListener('blur', validateStudentId);
}

function validateFullName() {
    const fullName = document.getElementById('fullName');
    const error = document.getElementById('fullNameError');
    const value = fullName.value.trim();

    if (value.length < 3) {
        error.textContent = 'Name must be at least 3 characters long';
        fullName.style.borderColor = '#e74c3c';
    } else {
        error.textContent = '';
        fullName.style.borderColor = '#ddd';
    }
}

function validateEmail() {
    const email = document.getElementById('email');
    const error = document.getElementById('emailError');
    const value = email.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(value)) {
        error.textContent = 'Please enter a valid email address';
        email.style.borderColor = '#e74c3c';
    } else {
        error.textContent = '';
        email.style.borderColor = '#ddd';
    }
}

function validateStudentId() {
    const studentId = document.getElementById('studentId');
    const error = document.getElementById('studentIdError');
    const value = studentId.value.trim();

    if (value.length < 5) {
        error.textContent = 'Student ID must be at least 5 characters';
        studentId.style.borderColor = '#e74c3c';
    } else {
        error.textContent = '';
        studentId.style.borderColor = '#ddd';
    }
}

function handleJoinSubmit(e) {
    e.preventDefault();

    validateFullName();
    validateEmail();
    validateStudentId();

    const fullNameError = document.getElementById('fullNameError');
    const emailError = document.getElementById('emailError');
    const studentIdError = document.getElementById('studentIdError');

    if (fullNameError.textContent || emailError.textContent || studentIdError.textContent) {
        alert('Please fix the errors in the form');
        return;
    }

    const formData = {
        fullName: document.getElementById('fullName').value.trim(),
        email: document.getElementById('email').value.trim(),
        studentId: document.getElementById('studentId').value.trim(),
        department: document.getElementById('department').value,
        interests: document.getElementById('interests').value.trim(),
        joinedDate: new Date().toISOString()
    };

    let membersList = JSON.parse(localStorage.getItem('newMembers')) || [];
    membersList.push(formData);
    localStorage.setItem('newMembers', JSON.stringify(membersList));

    const successMessage = document.getElementById('successMessage');
    successMessage.textContent = `✓ Welcome ${formData.fullName}! You've been successfully registered as a member.`;
    successMessage.style.display = 'block';

    document.getElementById('joinForm').reset();

    setTimeout(() => {
        successMessage.textContent = '';
        successMessage.style.display = 'none';
    }, 5000);
}

function handleContactSubmit(e) {
    e.preventDefault();

    const contactName = document.getElementById('contactName').value.trim();
    const contactEmail = document.getElementById('contactEmail').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();

    // Validate
    if (!contactName || !contactEmail || !subject || !message) {
        alert('Please fill in all fields');
        return;
    }

    const contactData = {
        name: contactName,
        email: contactEmail,
        subject: subject,
        message: message,
        timestamp: new Date().toISOString()
    };

    let contactMessages = JSON.parse(localStorage.getItem('contactMessages')) || [];
    contactMessages.push(contactData);
    localStorage.setItem('contactMessages', JSON.stringify(contactMessages));

    alert(`Thank you ${contactName}! Your message has been received. We'll get back to you at ${contactEmail} soon.`);
    document.getElementById('contactForm').reset();
}

function capitalizeFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
