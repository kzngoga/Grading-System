-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2019 at 09:37 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grading_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_ID` int(20) NOT NULL,
  `course_Name` varchar(200) NOT NULL,
  `dep_ID` int(20) NOT NULL,
  `total_Marks` int(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_ID`, `course_Name`, `dep_ID`, `total_Marks`, `status`) VALUES
(3, 'Virtual Dj8', 4, 100, 'On'),
(4, 'Python', 2, 100, 'On'),
(5, 'Java', 2, 100, 'On'),
(6, 'Photoshop ', 7, 100, 'On'),
(7, 'Camera Parts', 3, 50, 'On'),
(8, 'Photo Editing', 3, 30, 'On'),
(9, 'Picture Formats & Types', 3, 70, 'On'),
(11, 'Php', 1, 100, 'On'),
(12, 'Html', 1, 100, 'On'),
(13, 'Javascript', 1, 100, 'On'),
(14, 'Android Studio', 2, 100, 'On');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_ID` int(20) NOT NULL,
  `dep_Name` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_ID`, `dep_Name`, `status`) VALUES
(1, 'Web Design', 'On'),
(2, 'Software Development', 'On'),
(3, 'Photography', 'On'),
(6, 'Video Production', 'On'),
(7, 'Graphic Design', 'On'),
(8, 'Creative Art', 'On'),
(9, 'Deejaying', 'Off'),
(10, 'Serigraphy', 'On');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `marks_ID` int(20) NOT NULL,
  `student_ID` int(20) NOT NULL,
  `course_ID` int(20) NOT NULL,
  `marks_Test` varchar(200) NOT NULL,
  `marks_Exam` varchar(200) NOT NULL,
  `total` varchar(200) NOT NULL,
  `verdict` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`marks_ID`, `student_ID`, `course_ID`, `marks_Test`, `marks_Exam`, `total`, `verdict`) VALUES
(1, 12, 11, '67', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_ID` int(20) NOT NULL,
  `reg_Num` varchar(200) NOT NULL,
  `student_Fname` varchar(200) NOT NULL,
  `student_Lname` varchar(200) NOT NULL,
  `student_Mail` varchar(200) NOT NULL,
  `student_Gender` varchar(200) NOT NULL,
  `student_Address` varchar(200) NOT NULL,
  `student_Phone` varchar(200) NOT NULL,
  `parent_Phone` varchar(200) NOT NULL,
  `student_Intake` varchar(200) NOT NULL,
  `dep_ID` int(20) NOT NULL,
  `student_Shift` varchar(200) NOT NULL,
  `start_Date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_ID`, `reg_Num`, `student_Fname`, `student_Lname`, `student_Mail`, `student_Gender`, `student_Address`, `student_Phone`, `parent_Phone`, `student_Intake`, `dep_ID`, `student_Shift`, `start_Date`, `status`) VALUES
(1, 'KIAC0001IV/SEP2019', 'Berhan', 'Manzi', 'berhan@gmail.com', 'Male', 'Bigogwe', '0789967890', '0783046909', 'September Intake/2019', 2, '15h-17h', '9', 'On'),
(2, 'KIAC0002IV/SEP2019', 'hiro', 'Muhire', 'mailto1@gmail.com', 'Male', 'Musambira', '0784534566', '0734050880', 'September Intake/2019', 2, '18h-20h', '9', 'On'),
(3, 'KIAC0003IV/SEP2019', 'Innocente', 'Gashugi', 'mailto1@gmail.com', 'Female', 'Gakinjiro', '0789966619', '0783046945', 'September Intake/2019', 2, '18h-20h', '9', 'On'),
(4, 'KIAC0004IV/SEP2019', 'Gaspard', 'Mwenedata', 'mailto1@gmail.com', 'Male', 'Nyakaliro', '0789954546', '0723046945', 'September Intake/2019', 3, '11h-13h', '9', 'On'),
(5, 'KIAC0005IV/SEP2019', 'Jean De Dieu', 'Rukundo', 'mailto1@gmail.com', 'Male', 'Huye', '0789956789', '0783046945', 'September Intake/2019', 3, '11h-13h', '9', 'On'),
(6, 'KIAC0006IV/SEP2019', 'Branco', 'Gakire', 'mailto1@gmail.com', 'Male', 'Bigogwe', '0734050880', '0783046909', 'September Intake/2019', 3, '15h-17h', '9', 'On'),
(7, 'KIAC0007IV/MAR2019', 'Virginie', 'Niyongira', 'mailto1@gmail.com', 'Female', 'Musanze', '0784534566', '0723046945', 'March Intake/2019', 3, 'Weekend', '3', 'On'),
(8, 'KIAC0008IV/SEP2019', 'Filote', 'Mutesi', 'mailto1@gmail.com', 'Female', 'Nyakaliro', '0789966666', '0783046945', 'September Intake/2019', 3, '11h-13h', '9', 'On'),
(9, 'KIAC009IV/MAR2019', 'Billy', 'Musoni', 'mailto1@gmail.com', 'Male', 'Musambira', '0789966619', '0783046909', 'September Intake/2019/2019', 6, '11h-13h', '9', 'On'),
(10, 'KIAC0010IV/SEP2019', 'Jovite', 'Ngoga', 'kzngoga19@gmail.com', 'Male', 'Kamonyi', '0734050880', '0783046909', 'September Intake/2019', 1, '15h-17h', '9', 'On'),
(11, 'KIAC0011IV/MAR2019', 'Carine', 'Umubyeyi', 'kzngoga19@gmail.com', 'Female', 'Gatsata', '0784534566', '0783046909', 'March Intake /2019', 1, '18h-20h', '3', 'On'),
(12, 'KIAC0012IV/MAR2019', 'Charity', 'Neza ', 'kzngoga19@gmail.com', 'Female', 'Musambira', '0734050880', '0783046909', 'March Intake /2019', 1, '8h-10h', '3', 'On'),
(13, 'KIAC0013IV/MAR2019', 'Nazifa', 'Umutoni', 'nazbella399@gmail.com', 'Female', 'Nyamirambo', '0781983547', '0734050880', 'March Intake /2019', 1, 'Weekend', '3', 'On'),
(14, 'KIAC0014II/MAR2018', 'Alpha', 'Ishimwe', 'kzngoga19@gmail.com', 'Male', 'Gatsata', '0784534566', '0783046945', 'March Intake /2018', 3, '11h-13h', '3', 'Off'),
(15, 'KIAC0015IV/MAR2019', 'Bernard', 'Basengimana', 'kzngoga19@gmail.com', 'Male', 'Kicukiro', '0784534566', '0734050880', 'March Intake /2019', 1, '11h-13h', '3', 'On');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_ID` int(20) NOT NULL,
  `teacher_Fname` varchar(200) NOT NULL,
  `teacher_Lname` varchar(200) NOT NULL,
  `teacher_Mail` varchar(200) NOT NULL,
  `teacher_Gen` varchar(20) NOT NULL,
  `teacher_Address` varchar(200) NOT NULL,
  `teacher_Phone` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dep_ID` int(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_ID`, `teacher_Fname`, `teacher_Lname`, `teacher_Mail`, `teacher_Gen`, `teacher_Address`, `teacher_Phone`, `password`, `dep_ID`, `status`) VALUES
(1, 'Jean Claude', 'Ntabanganyimana', 'kzngoga19@gmail.com', 'Male', 'Gasabo', '0783197602', '0ff187a0db47a9e7461e91c00dc0af4d', 1, 'On'),
(2, 'Janvier', 'Dushimimana', 'kzngoga19@gmail.com', 'Male', 'Gasabo', '0783197456', 'd930d42ca84a618c5b8a937fba8a4765', 2, 'On'),
(3, 'Jean De Dieu', 'Muhire', 'kzngoga19@gmail.com', 'Male', 'Gicumbi', '0734050880', '4db7f4ceac1bd5a39eee53067110c2a9', 8, 'On');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(20) NOT NULL,
  `user_Fname` varchar(200) NOT NULL,
  `user_Lname` varchar(200) NOT NULL,
  `user_Mail` varchar(200) NOT NULL,
  `user_Gen` varchar(20) NOT NULL,
  `user_Address` varchar(200) NOT NULL,
  `user_Phone` varchar(200) NOT NULL,
  `user_Role` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `user_Fname`, `user_Lname`, `user_Mail`, `user_Gen`, `user_Address`, `user_Phone`, `user_Role`, `password`, `status`) VALUES
(5, 'Cedric', 'Ishimwe', 'kzngoga19@gmail.com', 'Male', 'Kamonyi', '0784534566', 'Administrator', '889530c619c89c5a7fe067266d433740', 'On'),
(16, 'Floris', 'Gatera', 'info.gsystem1@gmail.com', 'Male', 'Musambira', '0734050880', 'Dos', 'f26651a03995b153d96dd92da980ee81', 'On'),
(17, 'Pierre', 'Muhire', 'kzngoga19@gmail.com', 'Male', 'Musanze', '0734050880', 'Administrator', 'f8fc47e6e2256f90df8ba72c6b248c91', 'On'),
(18, 'Miguel', 'Mugema', 'kzngoga19@gmail.com', 'Male', 'Gakenke', '0784534566', 'Administrator', '704e5564f2a9fa34f8c2fa6c1b6f3425', 'On');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_ID`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`marks_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `marks_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
