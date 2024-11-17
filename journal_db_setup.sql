DROP DATABASE IF EXISTS journal;

/* Create Database */
CREATE DATABASE journal;
GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON journal.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE journal;

/* Create table for the list of possible moods */
-- prof's versions uses CREATE TABLE IF NOT EXISTS, 
-- once sql is finalized we can remove all the DROP IF's and switch the create statements to that
DROP TABLE IF EXISTS moods;

CREATE TABLE `moods` (
  `mood_id` tinyint(1) NOT NULL,
  `mood` varchar(15) NOT NULL UNIQUE,	
  PRIMARY KEY (`mood_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

/* Insert Mood Values */
INSERT INTO `moods` (`mood_id`, `mood`)
VALUES 
	(1, "Amazing"),
    (2, "Good"),
    (3, "Neutral"),
    (4, "Bad"),
    (5, "Terrible")
    ;

/* Create Users Table */
DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(80) NOT NULL,		
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `users` (`user_id`, `username`, `password`)
VALUES 
	(1, "first_user", "password1"),
    (2, "second_user", "password2"),
    (3, "third_user", "password3")
    ;

/* Create Entries Table */
DROP TABLE IF EXISTS entries;

CREATE TABLE `entries` (
  `entry_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `date` date NOT NULL, -- removed Unique constraint, because diff users can make entries on same day
  `title` varchar(100) NOT NULL,
  `entry_text` varchar(500) NOT NULL,
  `entry_mood` tinyint(1) NOT NULL,
  PRIMARY KEY (`entry_id`),
  FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`),
  FOREIGN KEY(`entry_mood`) REFERENCES `moods`(`mood_id`)
  -- CHECK (1<=`mood`<=5) no need to check if foreign key?
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ; 

/* Insert Test Value into Entries */
INSERT INTO `entries` (`entry_id`, `user_id`, `date`, `title`, `entry_text`, `entry_mood`) 
VALUES
(1, 3, '2024-11-09', 'Test Neutral', 'This is a test entry', 3),
(2, 1, '2024-11-10', 'Test Bad', 'This is a test entry', 4),
(3, 2,'2024-11-11', 'Test Terrible', 'This is a test entry', 5),
(4, 1, '2024-11-12', 'Test Amazing', 'This is a test entry', 1),
(5, 2, '2024-11-13', 'Test Good', 'This is a test entry', 2)
;

