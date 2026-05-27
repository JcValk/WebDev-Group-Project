-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2026 at 11:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uniclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(6) NOT NULL,
  `announcement_subject` varchar(100) NOT NULL,
  `announcement_detail` varchar(500) NOT NULL,
  `announcement_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `announcement_subject`, `announcement_detail`, `announcement_date`) VALUES
(1, 'Careers Fair Registration Open', 'Students can now register for the Annual Careers Fair happening this semester.', '2026-05-20'),
(2, 'Membership Registration Reminder', 'Students are encouraged to complete membership registration before the end of the month.', '2026-05-24'),
(3, 'Club Meeting This Friday', 'Members are invited to attend the monthly planning and activity meeting.', '2026-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(6) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `venue` varchar(100) NOT NULL,
  `event_details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `venue`, `event_details`) VALUES
(1, 'Annual Careers Fair', '2026-05-31', 'University Basketball Court', 'Come and meet top employers from New South Wales seeking new talent. Prepare your CV and think happy thoughts!\r\n\r\nIf you are not in the graduating class, internships may also be available, so come along!');

-- --------------------------------------------------------

--
-- Table structure for table `event_registration`
--

CREATE TABLE `event_registration` (
  `registration_no` int(12) NOT NULL,
  `student_id` int(12) NOT NULL,
  `event_id` int(6) NOT NULL,
  `attendee_type` enum('Event Staff','Guest','Volunteer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `student_id` int(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Member') NOT NULL DEFAULT 'Member',
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `course` text NOT NULL,
  `batch` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` int(12) NOT NULL,
  `interests` varchar(250) NOT NULL,
  `member_status` enum('New','Active','Inactive','Graduated') NOT NULL DEFAULT 'New',
  `date_joined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`student_id`, `password`, `role`, `first_name`, `last_name`, `course`, `batch`, `email`, `contact_no`, `interests`, `member_status`, `date_joined`) VALUES
(2016384013, 'Uniclub123!', 'Member', 'Stanley', 'Tucci', 'Marketing and Media', 'S22013', 'stan_the_man@yahoo.com', 421957302, 'antiques, music, fashion, reading books, belt enthusiast', 'Graduated', '2016-03-07'),
(2022840173, 'Uniclub123!', 'Member', 'Miranda', 'Priestly', 'Fine Arts and Design', 'S22026', 'miranda.priestly@gmail.com', 458294027, 'Fashion, interior design, color theory, photography, mycology', 'Active', '2022-02-14'),
(2022948103, 'Uniclub123!', 'Member', 'David', 'Frankel', 'Film Studies', 'S22026', 'd.frankel.films@yahoo.com', 428594857, 'film history, FRIENDS, fashion, fitness, orology', 'Active', '2022-02-11'),
(2023947294, 'Uniclub123!', 'Member', 'Irv', 'Ravitz', 'Finance', 'S22027', 'irvtheperv@gmail.com', 459273840, 'marketing campaigns, commercials, good food, couture, investments', 'Active', '2024-02-29'),
(2023948204, 'Uniclub123!', 'Member', 'Mary', 'Mutter', 'Ancient World Studies', 'S22027', 'mutter_mary@gmail.com', 478926486, 'theory of evolution, world history, FRIENDS, mixology', 'Active', '2023-04-20'),
(2024859304, 'Uniclub123!', 'Member', 'Emily', 'Charlton', 'Art History', 'S22028', 'em.the.boss@gmail.com', 429582740, 'fitness, diets, fashion, media, calceology, vexillology', 'Active', '2024-06-05'),
(2024984028, 'Uniclub123!', 'Admin', 'Andrea', 'Sachs', 'Journalism', 'S22028', 'andy.sachs@yahoo.com', 498365920, 'newspapers, murder mysteries, sweaters, feminism, bioluminescence', 'Active', '2025-05-05'),
(2026849305, 'Uniclub123!', 'Admin', 'Amari', 'Smyth', 'Interior Design', 'S22030', 'smyth.amari@gmail.com', 429574018, 'Taylor Swift, Shakespeare, Bridgerton, Pilates', 'New', '2026-05-18'),
(2026851243, 'Uniclub123!', 'Member', 'Denise', 'Flowervale', 'Botany', 'S22030', 'deniflow@yahoo.com', 429742068, 'turf enthusiast, perennials, pet rescue, taxidermy', 'New', '2026-05-18'),
(2026961948, 'Uniclub123!', 'Member', 'Amelia Mignonette', 'Thermopolis Renaldi', 'Political Science', 'S22030', 'mia@genovia.org', 458672932, 'world history, watching TV series, awards season, fruits', 'New', '2026-01-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_registration`
--
ALTER TABLE `event_registration`
  ADD PRIMARY KEY (`registration_no`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_registration`
--
ALTER TABLE `event_registration`
  MODIFY `registration_no` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
