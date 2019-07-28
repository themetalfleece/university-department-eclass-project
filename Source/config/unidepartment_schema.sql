-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2017 at 11:28 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 5.6.30-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unidepartment`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `authors` varchar(200) NOT NULL,
  `publish_year` int(4) NOT NULL,
  `publish_number` int(2) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `ISBN` int(10) NOT NULL,
  `description` text,
  `cover` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` text,
  `type` varchar(10) NOT NULL,
  `level` varchar(20) NOT NULL,
  `semester` int(2) NOT NULL,
  `official_url` text,
  `eclass_url` text,
  `ects` int(3) NOT NULL,
  `exam_means` varchar(50) DEFAULT NULL,
  `gravity` float(2,1) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `students_count` int(11) NOT NULL DEFAULT '0',
  `attending_students_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses_courses`
--

CREATE TABLE `courses_courses` (
  `id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `relationship_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses_recommended_books`
--

CREATE TABLE `courses_recommended_books` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses_semesters`
--

CREATE TABLE `courses_semesters` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `rating` float(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses_students`
--

CREATE TABLE `courses_students` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses_study_guides`
--

CREATE TABLE `courses_study_guides` (
  `id` int(11) NOT NULL,
  `study_guide_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `curriculum` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_announcements`
--

CREATE TABLE `course_announcements` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_links`
--

CREATE TABLE `course_links` (
  `id` int(11) NOT NULL,
  `course_links_category_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_links_categories`
--

CREATE TABLE `course_links_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_semester_classrooms`
--

CREATE TABLE `course_semester_classrooms` (
  `id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `course_semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_semester_professors`
--

CREATE TABLE `course_semester_professors` (
  `id` int(11) NOT NULL,
  `course_semester_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_semester_projects`
--

CREATE TABLE `course_semester_projects` (
  `id` int(11) NOT NULL,
  `course_semester_id` int(11) NOT NULL,
  `assign_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_semester_reviews`
--

CREATE TABLE `course_semester_reviews` (
  `id` int(11) NOT NULL,
  `course_semester_id` int(11) NOT NULL,
  `rating_stars` int(1) NOT NULL,
  `rating_text` text,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ects_semester`
--

CREATE TABLE `ects_semester` (
  `id` int(11) NOT NULL,
  `semester` int(2) NOT NULL,
  `ects` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` int(11) NOT NULL,
  `title` varchar(10) NOT NULL,
  `bio` text,
  `user_id` int(11) NOT NULL,
  `office_location` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `professor_publications`
--

CREATE TABLE `professor_publications` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `url` text NOT NULL,
  `reference_count` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `professor_visit_hours`
--

CREATE TABLE `professor_visit_hours` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `day` int(1) NOT NULL,
  `hour_start` time NOT NULL,
  `hour_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `course_semester_id` int(11) NOT NULL,
  `day` int(1) NOT NULL,
  `hour_start` time NOT NULL,
  `hour_end` time NOT NULL,
  `professor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_overrides`
--

CREATE TABLE `schedule_overrides` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `hour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `sector` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `era` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `AM` int(10) NOT NULL,
  `level` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `study_guides`
--

CREATE TABLE `study_guides` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `level` varchar(20) NOT NULL,
  `info` text NOT NULL,
  `ruling` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `picture` text,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_link` varchar(38) NOT NULL,
  `restore_link` varchar(38) DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(20) NOT NULL,
  `timezone` varchar(100) DEFAULT 'Europe/Athens',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `identifier` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_emails`
--

CREATE TABLE `user_emails` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_phones`
--

CREATE TABLE `user_phones` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_uk0` (`code`),
  ADD KEY `courses_fk0` (`sector_id`),
  ADD KEY `courses_code` (`code`),
  ADD KEY `courses_level` (`level`),
  ADD KEY `courses_semester` (`semester`);

--
-- Indexes for table `courses_courses`
--
ALTER TABLE `courses_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_courses_fk0` (`source_id`),
  ADD KEY `courses_courses_fk1` (`target_id`);

--
-- Indexes for table `courses_recommended_books`
--
ALTER TABLE `courses_recommended_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_recommended_books_fk0` (`course_id`),
  ADD KEY `courses_recommended_books_fk1` (`book_id`);

--
-- Indexes for table `courses_semesters`
--
ALTER TABLE `courses_semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_semesters_uk0` (`semester_id`,`course_id`),
  ADD KEY `courses_semesters_fk0` (`semester_id`),
  ADD KEY `courses_semesters_fk1` (`course_id`);

--
-- Indexes for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_students_fk0` (`course_id`),
  ADD KEY `courses_students_fk1` (`student_id`);

--
-- Indexes for table `courses_study_guides`
--
ALTER TABLE `courses_study_guides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_study_guides_fk0` (`study_guide_id`),
  ADD KEY `courses_study_guides_fk1` (`course_id`);

--
-- Indexes for table `course_announcements`
--
ALTER TABLE `course_announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_semester_announcements_fk0` (`course_id`);

--
-- Indexes for table `course_links`
--
ALTER TABLE `course_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_links_fk0` (`course_links_category_id`),
  ADD KEY `course_links_fk1` (`course_id`);

--
-- Indexes for table `course_links_categories`
--
ALTER TABLE `course_links_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_semester_classrooms`
--
ALTER TABLE `course_semester_classrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_semester_classrooms_fk0` (`classroom_id`),
  ADD KEY `course_semester_classrooms_fk1` (`course_semester_id`);

--
-- Indexes for table `course_semester_professors`
--
ALTER TABLE `course_semester_professors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_semester_professors_fk0` (`course_semester_id`),
  ADD KEY `course_semester_professors_fk1` (`professor_id`);

--
-- Indexes for table `course_semester_projects`
--
ALTER TABLE `course_semester_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_semester_projects_fk0` (`course_semester_id`),
  ADD KEY `course_semester_projects_due_date` (`due_date`);

--
-- Indexes for table `course_semester_reviews`
--
ALTER TABLE `course_semester_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_semester_reviews_fk0` (`course_semester_id`),
  ADD KEY `course_semester_reviews_approved` (`approved`);

--
-- Indexes for table `ects_semester`
--
ALTER TABLE `ects_semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professors_fk0` (`user_id`),
  ADD KEY `professors_active` (`active`);

--
-- Indexes for table `professor_publications`
--
ALTER TABLE `professor_publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_publications_fk0` (`professor_id`);

--
-- Indexes for table `professor_visit_hours`
--
ALTER TABLE `professor_visit_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_visit_hours_fk0` (`professor_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_fk0` (`classroom_id`),
  ADD KEY `schedules_fk1` (`course_semester_id`),
  ADD KEY `schedules_fk2` (`professor_id`);

--
-- Indexes for table `schedule_overrides`
--
ALTER TABLE `schedule_overrides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_overrides_fk0` (`schedule_id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `AM` (`AM`),
  ADD KEY `students_fk0` (`user_id`),
  ADD KEY `students` (`AM`);

--
-- Indexes for table `study_guides`
--
ALTER TABLE `study_guides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `study_guides_fk0` (`semester_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_uk0` (`email`),
  ADD KEY `users_email` (`email`);

--
-- Indexes for table `user_emails`
--
ALTER TABLE `user_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_emails_fk0` (`user_id`);

--
-- Indexes for table `user_phones`
--
ALTER TABLE `user_phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_phones_fk0` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16016;
--
-- AUTO_INCREMENT for table `courses_courses`
--
ALTER TABLE `courses_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses_recommended_books`
--
ALTER TABLE `courses_recommended_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses_semesters`
--
ALTER TABLE `courses_semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `courses_students`
--
ALTER TABLE `courses_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `courses_study_guides`
--
ALTER TABLE `courses_study_guides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course_announcements`
--
ALTER TABLE `course_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course_links`
--
ALTER TABLE `course_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `course_links_categories`
--
ALTER TABLE `course_links_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course_semester_classrooms`
--
ALTER TABLE `course_semester_classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course_semester_professors`
--
ALTER TABLE `course_semester_professors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course_semester_projects`
--
ALTER TABLE `course_semester_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_semester_reviews`
--
ALTER TABLE `course_semester_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ects_semester`
--
ALTER TABLE `ects_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `professor_publications`
--
ALTER TABLE `professor_publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `professor_visit_hours`
--
ALTER TABLE `professor_visit_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `schedule_overrides`
--
ALTER TABLE `schedule_overrides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `study_guides`
--
ALTER TABLE `study_guides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_emails`
--
ALTER TABLE `user_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user_phones`
--
ALTER TABLE `user_phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_fk0` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`);

--
-- Constraints for table `courses_courses`
--
ALTER TABLE `courses_courses`
  ADD CONSTRAINT `courses_courses_fk0` FOREIGN KEY (`source_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `courses_courses_fk1` FOREIGN KEY (`target_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `courses_recommended_books`
--
ALTER TABLE `courses_recommended_books`
  ADD CONSTRAINT `courses_recommended_books_fk0` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `courses_recommended_books_fk1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `courses_semesters`
--
ALTER TABLE `courses_semesters`
  ADD CONSTRAINT `courses_semesters_fk0` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `courses_semesters_fk1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD CONSTRAINT `courses_students_fk0` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `courses_students_fk1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `courses_study_guides`
--
ALTER TABLE `courses_study_guides`
  ADD CONSTRAINT `courses_study_guides_fk0` FOREIGN KEY (`study_guide_id`) REFERENCES `study_guides` (`id`),
  ADD CONSTRAINT `courses_study_guides_fk1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `course_announcements`
--
ALTER TABLE `course_announcements`
  ADD CONSTRAINT `course_announcements_fk0` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `course_links`
--
ALTER TABLE `course_links`
  ADD CONSTRAINT `course_links_fk0` FOREIGN KEY (`course_links_category_id`) REFERENCES `course_links_categories` (`id`),
  ADD CONSTRAINT `course_links_fk1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `course_semester_classrooms`
--
ALTER TABLE `course_semester_classrooms`
  ADD CONSTRAINT `course_semester_classrooms_fk0` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`),
  ADD CONSTRAINT `course_semester_classrooms_fk1` FOREIGN KEY (`course_semester_id`) REFERENCES `courses_semesters` (`id`);

--
-- Constraints for table `course_semester_professors`
--
ALTER TABLE `course_semester_professors`
  ADD CONSTRAINT `course_semester_professors_fk0` FOREIGN KEY (`course_semester_id`) REFERENCES `courses_semesters` (`id`),
  ADD CONSTRAINT `course_semester_professors_fk1` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`id`);

--
-- Constraints for table `course_semester_projects`
--
ALTER TABLE `course_semester_projects`
  ADD CONSTRAINT `course_semester_projects_fk0` FOREIGN KEY (`course_semester_id`) REFERENCES `courses_semesters` (`semester_id`);

--
-- Constraints for table `course_semester_reviews`
--
ALTER TABLE `course_semester_reviews`
  ADD CONSTRAINT `course_semester_reviews_fk0` FOREIGN KEY (`course_semester_id`) REFERENCES `courses_semesters` (`id`);

--
-- Constraints for table `professors`
--
ALTER TABLE `professors`
  ADD CONSTRAINT `professors_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `professor_publications`
--
ALTER TABLE `professor_publications`
  ADD CONSTRAINT `professor_publications_fk0` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`id`);

--
-- Constraints for table `professor_visit_hours`
--
ALTER TABLE `professor_visit_hours`
  ADD CONSTRAINT `professor_visit_hours_fk0` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_fk0` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`),
  ADD CONSTRAINT `schedules_fk1` FOREIGN KEY (`course_semester_id`) REFERENCES `courses_semesters` (`id`),
  ADD CONSTRAINT `schedules_fk2` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`id`);

--
-- Constraints for table `schedule_overrides`
--
ALTER TABLE `schedule_overrides`
  ADD CONSTRAINT `schedule_overrides_fk0` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `study_guides`
--
ALTER TABLE `study_guides`
  ADD CONSTRAINT `study_guides_fk0` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `user_emails`
--
ALTER TABLE `user_emails`
  ADD CONSTRAINT `user_emails_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_phones`
--
ALTER TABLE `user_phones`
  ADD CONSTRAINT `user_phones_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
