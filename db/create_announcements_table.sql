USE `uniclub`;

CREATE TABLE IF NOT EXISTS `announcements` (
  `announcement_id` int(6) NOT NULL AUTO_INCREMENT,
  `announcement_subject` varchar(100) NOT NULL,
  `announcement_detail` varchar(500) NOT NULL,
  `announcement_date` date NOT NULL,
  PRIMARY KEY (`announcement_id`)
)

INSERT INTO `announcements` (`announcement_subject`, `announcement_detail`, `announcement_date`)
SELECT 'Careers Fair Registration Open', 'Students can now register for the Annual Careers Fair happening this semester.', '2026-05-20'

INSERT INTO `announcements` (`announcement_subject`, `announcement_detail`, `announcement_date`)
SELECT 'Membership Registration Reminder', 'Students are encouraged to complete membership registration before the end of the month.', '2026-05-24'

INSERT INTO `announcements` (`announcement_subject`, `announcement_detail`, `announcement_date`)
SELECT 'Club Meeting This Friday', 'Members are invited to attend the monthly planning and activity meeting.', '2026-05-28'