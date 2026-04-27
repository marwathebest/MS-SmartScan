-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 02:06 PM
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
-- Database: `ms_smartscan`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `full_name`, `birth_date`, `gender`, `phone_number`) VALUES
(80432, '', '0000-00-00', '', ''),
(665877, 'فهد شاهر الحربي', '2006-02-08', 'ذكر', '0846746783'),
(3423227, 'محمد العتيبي', '0000-00-00', 'ذكر', '0838329'),
(6476476, 'وتين شاهر الحربي', '2026-03-04', 'انثى', '0437346563'),
(6476477, '', '0000-00-00', '', ''),
(6476478, 'محمد صالح الحربي', '0000-00-00', 'ذكر', '0837654766'),
(6476479, 'محمد صالح الحربي', '0000-00-00', 'ذكر', '0837654766'),
(6476480, 'محمد صالح الحربي', '0000-00-00', 'ذكر', '0837654766'),
(6476481, 'محمد صالح الحربي', '0000-00-00', 'ذكر', '0837654766'),
(6476482, 'محمد صالح الحربي', '0000-00-00', 'ذكر', '0837654766'),
(6476483, 'محمد العتيبي', '0000-00-00', 'ذكر', '0838329');

-- --------------------------------------------------------

--
-- Table structure for table `scans`
--

CREATE TABLE `scans` (
  `scan_id` int(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `scan_date` datetime(6) NOT NULL,
  `symptoms` text NOT NULL,
  `result` varchar(100) NOT NULL,
  `accuracy` int(100) NOT NULL,
  `image_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scans`
--

INSERT INTO `scans` (`scan_id`, `patient_id`, `scan_date`, `symptoms`, `result`, `accuracy`, `image_path`) VALUES
(1, 6476476, '2026-04-02 17:58:13.000000', 'No symptoms', '', 0, 'uploads/1775141892.png'),
(2, 6476476, '2026-04-02 18:01:32.000000', 'No symptoms', '', 0, 'uploads/1775142092.png'),
(3, 6476476, '2026-04-02 18:08:43.000000', 'No symptoms recorded', 'Python was not found; run without arguments to install from the Microsoft Store, or disable this sho', 0, 'uploads/1775142523.png'),
(4, 6476476, '2026-04-02 18:10:40.000000', 'No symptoms recorded', '\'py$\' is not recognized as an internal or external command,\noperable program or batch file.', 0, 'uploads/1775142640.png'),
(5, 6476476, '2026-04-02 18:11:01.000000', 'No symptoms recorded', '\'py\' is not recognized as an internal or external command,\noperable program or batch file.', 0, 'uploads/1775142661.png'),
(6, 6476476, '2026-04-02 18:11:16.000000', 'No symptoms recorded', '\'py\' is not recognized as an internal or external command,\noperable program or batch file.', 0, 'uploads/1775142676.png'),
(7, 6476476, '2026-04-02 18:17:12.000000', 'No symptoms recorded', 'Traceback (most recent call last):\n  File \"C:\\xampp\\htdocs\\ms_smartscan\\predict.py\", line 3, in <mod', 0, 'uploads/1775143031.png'),
(8, 6476476, '2026-04-02 18:17:24.000000', 'No symptoms recorded', 'Traceback (most recent call last):\n  File \"C:\\xampp\\htdocs\\ms_smartscan\\predict.py\", line 3, in <mod', 0, 'uploads/1775143044.png'),
(9, 6476476, '2026-04-02 18:37:00.000000', 'No symptoms recorded', 'Infected', 74, 'uploads/1775144185.png'),
(10, 6476476, '2026-04-02 18:37:48.000000', 'No symptoms recorded', 'Infected', 71, 'uploads/1775144259.png'),
(11, 6476476, '2026-04-02 18:40:20.000000', 'No symptoms recorded', 'Healthy', 100, 'uploads/1775144383.png'),
(12, 6476476, '2026-04-02 18:43:37.000000', 'No symptoms recorded', 'Infected', 83, 'uploads/1775144606.png'),
(13, 6476476, '2026-04-02 18:44:17.000000', 'No symptoms recorded', 'Infected', 80, 'uploads/1775144640.png'),
(14, 6476476, '2026-04-02 19:15:00.000000', 'No symptoms recorded', 'Infected', 75, 'uploads/1775146493.png'),
(15, 6476476, '2026-04-02 19:15:01.000000', 'No symptoms recorded', 'Infected', 75, 'uploads/1775146492.png'),
(16, 6476476, '2026-04-02 19:16:59.000000', 'No symptoms recorded', 'Infected', 82, 'uploads/1775146613.png'),
(17, 6476476, '2026-04-02 19:17:01.000000', 'No symptoms recorded', 'Infected', 82, 'uploads/1775146616.png'),
(18, 6476476, '2026-04-05 11:15:11.000000', 'No symptoms recorded', 'Traceback (most recent call last):\n  File \"C:\\Users\\MAMAX\\AppData\\Local\\Programs\\Python\\Python312\\Li', 0, 'uploads/1775376907.png'),
(19, 6476476, '2026-04-05 11:21:05.000000', 'No symptoms recorded', 'Traceback (most recent call last):\n  File \"C:\\xampp\\htdocs\\ms_smartscan\\predict.py\", line 42, in <mo', 0, 'uploads/1775377259.png'),
(20, 6476476, '2026-04-05 11:23:04.000000', 'No symptoms recorded', 'خطأ تقني: HTTPCallErrorError(description=\'500 Server Error: Internal Server Error for url: https://d', 0, 'uploads/1775377380.png'),
(21, 6476476, '2026-04-05 11:29:32.000000', 'No symptoms recorded', 'حدث خطأ أثناء التحليل: HTTPCallErrorError(description=\'500 Server Error: Internal Server Error for u', 0, 'uploads/1775377766.png'),
(22, 6476476, '2026-04-05 11:32:24.000000', 'No symptoms recorded', 'حدث خطأ أثناء التحليل: HTTPCallErrorError(description=\'500 Server Error: Internal Server Error for u', 0, 'uploads/1775377938.png'),
(23, 6476476, '2026-04-05 13:28:48.000000', 'No symptoms recorded', 'النتيجة: الدماغ سليم (Normal) ✅', 0, 'uploads/1775384919.png'),
(24, 6476476, '2026-04-05 13:29:17.000000', 'No symptoms recorded', 'تنبيه: تم اكتشاف 2 إصابة (lesion) ⚠️', 0, 'uploads/1775384951.png'),
(25, 6476476, '2026-04-05 13:30:35.000000', 'No symptoms recorded', 'تنبيه: تم اكتشاف 2 مصاب (lesion) ⚠️', 0, 'uploads/1775385029.png'),
(26, 6476476, '2026-04-05 13:31:20.000000', 'No symptoms recorded', '2 مصاب (lesion) ⚠️', 0, 'uploads/1775385074.png'),
(27, 6476476, '2026-04-05 13:33:32.000000', 'No symptoms recorded', 'File \"C:\\xampp\\htdocs\\ms_smartscan\\predict.py\", line 25\n    return f\"\\u062a\\u062d\\u0644\\u064a\\u0644 ', 0, 'uploads/1775385212.png'),
(28, 6476476, '2026-04-05 13:34:15.000000', 'No symptoms recorded', 'تحليل AI: تم اكتشاف 2 بؤرة مرضية (lesion) ⚠️', 0, 'uploads/1775385248.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `scans`
--
ALTER TABLE `scans`
  ADD PRIMARY KEY (`scan_id`),
  ADD KEY `رقم _المريض` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6476484;

--
-- AUTO_INCREMENT for table `scans`
--
ALTER TABLE `scans`
  MODIFY `scan_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
