-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2020 at 06:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_judge`
--

-- --------------------------------------------------------

--
-- Table structure for table `judge_setting`
--

CREATE TABLE `judge_setting` (
  `languageList` text DEFAULT NULL,
  `judgeSpeed` int(11) NOT NULL DEFAULT 45
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `problemId` int(11) NOT NULL,
  `problemName` text NOT NULL,
  `problemDescription` text NOT NULL,
  `inputDescription` text NOT NULL,
  `outputDescription` text NOT NULL,
  `constraintDescription` text NOT NULL,
  `inputExample` text NOT NULL,
  `outputExample` text NOT NULL,
  `notes` text NOT NULL,
  `cpuTimeLimit` float NOT NULL DEFAULT 2,
  `memoryLimit` int(11) NOT NULL DEFAULT 128000,
  `userId` int(11) NOT NULL,
  `problemAddedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`problemId`, `problemName`, `problemDescription`, `inputDescription`, `outputDescription`, `constraintDescription`, `inputExample`, `outputExample`, `notes`, `cpuTimeLimit`, `memoryLimit`, `userId`, `problemAddedDate`) VALUES
(1, 'Hello', '<p><span class=\"equation\">\\(a\\bigoplus b\\)</span>&nbsp;You are given an unweighted tree with&nbsp;nn&nbsp;vertices. Recall that a tree is a connected undirected graph without cycles.</p>\n\n<p>Your task is to choose&nbsp;three distinct&nbsp;vertices&nbsp;a,b,ca,b,c&nbsp;on this tree such that the number of edges which belong to&nbsp;at least&nbsp;one of the simple paths between&nbsp;aa&nbsp;and&nbsp;bb,&nbsp;bb&nbsp;and&nbsp;cc, or&nbsp;aa&nbsp;and&nbsp;cc&nbsp;is the maximum possible. See the notes section for a better understanding.</p>\n\n<p>The simple path is the path that visits each vertex at most once. <strong>DSAFf</strong></p>\n', '<em><strong><span class=\"equation\">\\(x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}\\)</span>Input starts with an integer </strong>T denoting the number of test cases.Each case contains two integers: N, K.and tetere</em>', 'For each test case, print the&nbsp;<strong>number of trailing zeroes</strong>&nbsp;in your result.', '<span class=\"equation\">\\(x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}\\)</span><br />\n<span class=\"equation\">\\(x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}\\)</span>', '6<br />\nLRU<br />\nDURLDRUDRULRDURDDL<br />\nLRUDDLRUDRUL<br />\nLLLLRRRR<br />\nURDUR<br />\nLLL', '2<br />\nLR<br />\n14<br />\nRUURDDDDLLLUUR<br />\n12<br />\nULDDDRRRUULL<br />\n2<br />\nLR<br />\n2<br />\nUD<br />\n7', '<p>There are only two possible answers in the first test case: &quot;LR&quot; and &quot;RL&quot;.</p>\n\n<p>The picture corresponding to the second test case:</p>\n<img src=\"https://espresso.codeforces.com/b8d040c328a3c50a5e36b8d6da86a6e5f2b67b52.png\" /><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Note that the direction of traverse does not matter\n<p>Another correct answer to the third test case: &quot;URDDLLLUURDR&quot;.</p>\n', 2, 128000, 1, '2020-01-24 00:00:00');

--
-- Triggers `problems`
--
DELIMITER $$
CREATE TRIGGER `TG_InsertProblemModerator` AFTER INSERT ON `problems` FOR EACH ROW BEGIN
    INSERT INTO problem_moderator(problemId, userId,moderatorRoles)
        VALUES(new.problemId,new.userId,10);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `problem_moderator`
--

CREATE TABLE `problem_moderator` (
  `problemModeratorId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `problemId` int(11) NOT NULL,
  `moderatorRoles` int(11) NOT NULL DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `submissionId` int(11) NOT NULL,
  `submissionType` int(11) NOT NULL DEFAULT 1,
  `problemId` int(11) NOT NULL,
  `sourceCode` text NOT NULL,
  `languageId` int(11) NOT NULL,
  `languageName` text DEFAULT NULL,
  `maxTimeLimit` float NOT NULL DEFAULT 0,
  `maxMemoryLimit` int(11) NOT NULL DEFAULT 0,
  `runOnMaxTime` float NOT NULL DEFAULT 0,
  `runOnMaxMemory` int(11) NOT NULL DEFAULT 0,
  `userId` int(11) NOT NULL,
  `submissionTime` datetime NOT NULL,
  `submissionVerdict` int(11) NOT NULL DEFAULT 1,
  `testCaseReady` int(11) NOT NULL DEFAULT -1,
  `judgeComplete` int(11) NOT NULL DEFAULT 0,
  `runOnTest` int(11) NOT NULL DEFAULT 1,
  `totalTestCase` int(11) NOT NULL DEFAULT 0,
  `threadId` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submissions_on_test_case`
--

CREATE TABLE `submissions_on_test_case` (
  `submissionTestCaseId` int(11) NOT NULL,
  `submissionId` int(11) NOT NULL,
  `testCaseSerialNo` int(11) NOT NULL,
  `testCaseToken` varchar(100) NOT NULL,
  `judgeStatus` int(11) NOT NULL DEFAULT -1,
  `verdict` int(11) NOT NULL DEFAULT 0,
  `totalTime` float NOT NULL DEFAULT 0,
  `totalMemory` int(11) NOT NULL DEFAULT 0,
  `responseData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`responseData`))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_case`
--

CREATE TABLE `test_case` (
  `testCaseId` int(11) NOT NULL,
  `testCaseIdHash` varchar(150) DEFAULT NULL,
  `problemId` int(11) NOT NULL,
  `testCaseAddedDate` datetime NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_case`
--

INSERT INTO `test_case` (`testCaseId`, `testCaseIdHash`, `problemId`, `testCaseAddedDate`, `userId`) VALUES
(69, 'a45b378258d9cd864b25f93c904a70357d3a5f024569effc25733ecea247be29', 1, '2020-02-03 21:32:58', 1),
(83, '0fb7a9fa61c9b54baaceae39e4fe6f652a236514000fa29614b37135f5b76661', 1, '2020-02-12 22:26:11', 1),
(84, '79ecc72e7d9773fc62f0f48d89aa1f7cb0a71f1bfc7fd35ea381e2b4bd5d3da8', 1, '2020-02-12 22:26:20', 1),
(85, '247eafc164565458cefcf652a7e21f64ed6d10e39e4e67e39a7c877a10f35709', 1, '2020-02-12 22:26:31', 1),
(86, '08933d55d8301b7ec4ac302f9da3b8c343c8e3da2cfe15d1f91f13200ad99ee3', 1, '2020-02-12 22:26:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userFullName` text NOT NULL,
  `userHandle` varchar(15) NOT NULL,
  `userEmail` text NOT NULL,
  `userPhoto` text DEFAULT NULL,
  `userEwuId` text DEFAULT NULL,
  `userPassword` varchar(150) NOT NULL,
  `userRoles` int(11) NOT NULL DEFAULT 40,
  `userRegistrationDate` datetime NOT NULL,
  `userLastLoginInfo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userFullName`, `userHandle`, `userEmail`, `userPhoto`, `userEwuId`, `userPassword`, `userRoles`, `userRegistrationDate`, `userLastLoginInfo`) VALUES
(1, '', 'hamza05', 'sk.amirhamza@gmail.com', '', '', 'OTg4NDVhYzc5MWFhYWYxYWMyMDU5YjQ2YTg4MjcyOTAwZWU1YjNjMTA3NTZkYzg1ODU4NzU5ZjU2ODgyNmVhZA==', 40, '2020-01-18 00:00:00', '{\"ip\":\"::1\",\"url\":\"\\/project\\/EWUOJ\\/site_action.php\",\"time\":\"2020-02-13 23:19:29\"}'),
(5, 'test', 'test', 'test@gmail.com', NULL, '', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', 40, '2020-01-20 23:08:00', NULL),
(6, 'test', 'test1', 'test1@gmail.com', NULL, '2017-1-60-0', 'NWJlMTBiMDFjNGIzMWRkNDNlYmExNzc0NGNkOTNmYzY3NDk2ZGZlYWUyMGRmYzQ3ODBlN2MyZWNiZTdmNGI2Zg==', 40, '2020-01-20 23:10:48', NULL),
(7, 'hamza', 'hamza051', 'hamza@gmail.com', NULL, '2017-1-60-091', 'NWJlMTBiMDFjNGIzMWRkNDNlYmExNzc0NGNkOTNmYzY3NDk2ZGZlYWUyMGRmYzQ3ODBlN2MyZWNiZTdmNGI2Zg==', 40, '2020-01-20 23:14:34', NULL),
(8, 'test2', 'test2', 'test2@gmail.com', NULL, '2017-1-60-091', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', 40, '2020-01-20 23:20:14', NULL),
(9, 'user1', 'user1', 'user1@gmail.com', NULL, '2017-1-60-091', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', 40, '2020-01-20 23:23:10', NULL),
(10, 'user4', 'user4', 'user4@gmaiil.com', NULL, '', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', 40, '2020-01-20 23:36:10', NULL),
(11, 'user5', 'user5', 'user5@gmail.com', NULL, '{\"year\":2017,\"semister\":1,\"department\":60,\"id\":91}', 'NWJlMTBiMDFjNGIzMWRkNDNlYmExNzc0NGNkOTNmYzY3NDk2ZGZlYWUyMGRmYzQ3ODBlN2MyZWNiZTdmNGI2Zg==', 40, '2020-01-20 23:59:22', NULL),
(12, 'user6', 'user6', 'user6@gmail.com', NULL, '{\"year\":2017,\"semister\":1,\"department\":60,\"serial\":92}', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', 40, '2020-01-21 00:01:24', NULL),
(13, 'dsf', 'asdf', 'a@gmail.com', NULL, '', 'NWJlMTBiMDFjNGIzMWRkNDNlYmExNzc0NGNkOTNmYzY3NDk2ZGZlYWUyMGRmYzQ3ODBlN2MyZWNiZTdmNGI2Zg==', 40, '2020-01-31 00:17:08', NULL),
(14, 'asdf', 'sadf', 'abc@gmail.com', NULL, '{\"year\":2017,\"semister\":1,\"department\":60,\"serial\":91}', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', 40, '2020-01-31 00:18:12', NULL),
(15, 'Ruhul Amin', 'ruhulaminrul', 'ruhul.ok@gmail.com', NULL, '', 'Y2MwN2E2YmYzMmYzODQyNWRlYjRhYTMwYjZkYTFkMTdjYWYzYWVhNGE3NjQzZmMwZjQyMjlkYWIzYjIwYTFlNQ==', 40, '2020-02-08 08:14:38', '{\"ip\":\"192.168.0.109\",\"url\":\"\\/project\\/EWUOJ\\/site_action.php\",\"time\":\"2020-02-08 09:07:52\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`problemId`),
  ADD KEY `fk_problem_user` (`userId`);

--
-- Indexes for table `problem_moderator`
--
ALTER TABLE `problem_moderator`
  ADD PRIMARY KEY (`problemModeratorId`),
  ADD UNIQUE KEY `UC_UserProblem` (`userId`,`problemId`),
  ADD KEY `FK_ProblemModeratorProblem` (`problemId`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submissionId`),
  ADD KEY `FK_SubmissionUser` (`userId`),
  ADD KEY `FK_SubmissionProblem` (`problemId`);

--
-- Indexes for table `submissions_on_test_case`
--
ALTER TABLE `submissions_on_test_case`
  ADD PRIMARY KEY (`submissionTestCaseId`),
  ADD KEY `FK_SubmissionId` (`submissionId`);

--
-- Indexes for table `test_case`
--
ALTER TABLE `test_case`
  ADD PRIMARY KEY (`testCaseId`),
  ADD KEY `fk_test_case_add_by` (`userId`) USING BTREE,
  ADD KEY `fk_test_case_problem_id` (`problemId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `uc_user_handle` (`userHandle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `problemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `problem_moderator`
--
ALTER TABLE `problem_moderator`
  MODIFY `problemModeratorId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submissionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions_on_test_case`
--
ALTER TABLE `submissions_on_test_case`
  MODIFY `submissionTestCaseId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_case`
--
ALTER TABLE `test_case`
  MODIFY `testCaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `fk_problem_user` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `problem_moderator`
--
ALTER TABLE `problem_moderator`
  ADD CONSTRAINT `FK_ProblemModeratorProblem` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`),
  ADD CONSTRAINT `FK_ProblemModeratorUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `FK_SubmissionProblem` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`),
  ADD CONSTRAINT `FK_SubmissionUser` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `submissions_on_test_case`
--
ALTER TABLE `submissions_on_test_case`
  ADD CONSTRAINT `FK_SubmissionId` FOREIGN KEY (`submissionId`) REFERENCES `submissions` (`submissionId`);

--
-- Constraints for table `test_case`
--
ALTER TABLE `test_case`
  ADD CONSTRAINT `fk_test_case_add_by` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `fk_test_case_problem_id` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;