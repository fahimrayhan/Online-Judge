-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 04, 2020 at 09:33 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coder_oj`
--

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `contestId` int(11) NOT NULL,
  `contestName` text NOT NULL,
  `contestDescription` text NOT NULL,
  `contestVisibility` enum('Public','Protected','Private') NOT NULL DEFAULT 'Public',
  `contestPassword` text DEFAULT NULL,
  `contestFormat` enum('ICPC','IOI') NOT NULL DEFAULT 'ICPC',
  `contestBanner` text DEFAULT NULL,
  `contestStart` datetime NOT NULL,
  `contestDuration` int(11) NOT NULL DEFAULT 300,
  `contestFreeze` enum('true','false') NOT NULL DEFAULT 'false',
  `contestFreezePeriod` int(11) NOT NULL DEFAULT 0,
  `contestUnFreeze` enum('true','false') NOT NULL DEFAULT 'false',
  `registrationClose` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `formId` int(11) NOT NULL,
  `registrationAutoAccept` enum('true','false') NOT NULL DEFAULT 'false',
  `participateMainName` text NOT NULL,
  `participateSubName` text NOT NULL,
  `contestPublish` enum('true','false') NOT NULL DEFAULT 'false',
  `userId` int(11) NOT NULL,
  `contestAddedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `contest`
--
DELIMITER $$
CREATE TRIGGER `TG_InsertContestModerator` AFTER INSERT ON `contest` FOR EACH ROW INSERT INTO contest_moderator (contestId,userId,moderatorRoles)
VALUES (NEW.contestId,new.userId,10)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contest_clearification`
--

CREATE TABLE `contest_clearification` (
  `contestClearificationId` int(11) NOT NULL,
  `contestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `contestClearificationHash` text DEFAULT NULL,
  `contestClearificationType` enum('Resources','Announcement','Clearification') NOT NULL,
  `contestClearificationProblem` text DEFAULT NULL,
  `contestClearificationTitle` text NOT NULL,
  `contestClearificationDescription` text DEFAULT NULL,
  `contestClearificationReply` text DEFAULT NULL,
  `contestClearificationTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contest_comment`
--

CREATE TABLE `contest_comment` (
  `contestCommentId` int(11) NOT NULL,
  `contestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `contestCommentType` enum('Resources','Announcement','Clearification') NOT NULL,
  `contestCommentTitle` text NOT NULL,
  `contestCommentDescription` text NOT NULL,
  `contestCommentReply` text DEFAULT NULL,
  `contestCommentTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contest_moderator`
--

CREATE TABLE `contest_moderator` (
  `contestModeratorId` int(11) NOT NULL,
  `contestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `moderatorRoles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contest_problem_set`
--

CREATE TABLE `contest_problem_set` (
  `contestProblemSetId` int(11) NOT NULL,
  `contestId` int(11) NOT NULL,
  `problemId` int(11) NOT NULL,
  `problemSerial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contest_registration`
--

CREATE TABLE `contest_registration` (
  `contestRegistrationId` int(11) NOT NULL,
  `contestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `registrationInfo` text NOT NULL,
  `registrationStatus` enum('Accepted','Pending') NOT NULL DEFAULT 'Pending',
  `tempUser` enum('Yes','No') NOT NULL DEFAULT 'No',
  `tempUserPassword` text DEFAULT NULL,
  `registrationTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contest_registration_form`
--

CREATE TABLE `contest_registration_form` (
  `contestRegistrationFormId` int(11) NOT NULL,
  `contestId` int(11) NOT NULL,
  `optionName` varchar(20) NOT NULL,
  `formOptionTitle` text NOT NULL,
  `formOptionData` text NOT NULL,
  `formOptionMessage` text NOT NULL,
  `optionSerial` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contest_submission`
--

CREATE TABLE `contest_submission` (
  `contestSubmissionId` int(11) NOT NULL,
  `contestId` int(11) NOT NULL,
  `submissionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `file_upload`
--

CREATE TABLE `file_upload` (
  `fileUploadId` int(11) NOT NULL,
  `fileName` text NOT NULL DEFAULT '',
  `filePath` text DEFAULT NULL,
  `fileType` text DEFAULT NULL,
  `fileSize` float DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `formId` int(11) NOT NULL,
  `formHashId` text NOT NULL,
  `formTitle` text DEFAULT NULL,
  `formDescription` text NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form_question`
--

CREATE TABLE `form_question` (
  `formQuestionId` int(11) NOT NULL,
  `formId` int(11) NOT NULL,
  `formQuestionHashId` text DEFAULT NULL,
  `formQuestionTitle` varchar(40) NOT NULL,
  `formQuestionDescription` text NOT NULL,
  `formQuestionHint` text DEFAULT NULL,
  `formQuestionInputData` text NOT NULL,
  `formQuestionRequired` enum('true','false') NOT NULL DEFAULT 'false',
  `formQuestionSerial` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `judge_problem_list`
--

CREATE TABLE `judge_problem_list` (
  `judgeProblemListId` int(11) NOT NULL,
  `problemId` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `addedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `judge_setting`
--

CREATE TABLE `judge_setting` (
  `judgeSettingId` int(11) NOT NULL,
  `languageList` text DEFAULT NULL,
  `judgeVerdictList` text DEFAULT NULL,
  `judgeSpeed` int(11) NOT NULL DEFAULT 45
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `page_view`
--

CREATE TABLE `page_view` (
  `pageViewId` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT 0,
  `userIp` text NOT NULL,
  `userBrowserName` text NOT NULL,
  `userBrowserVersion` text NOT NULL,
  `userPlatform` text NOT NULL,
  `userAgent` text NOT NULL,
  `visitPageUrl` text NOT NULL,
  `visitTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `problemId` int(11) NOT NULL,
  `problemName` text NOT NULL,
  `problemDescription` text DEFAULT NULL,
  `inputDescription` text DEFAULT NULL,
  `outputDescription` text DEFAULT NULL,
  `constraintDescription` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `timeLimit` float NOT NULL DEFAULT 2,
  `memoryLimit` int(11) NOT NULL DEFAULT 128000,
  `checker` text DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `problemAddedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `submissionJudgeType` enum('binary','partial') NOT NULL DEFAULT 'binary',
  `problemId` int(11) NOT NULL,
  `sourceCode` text NOT NULL,
  `languageId` int(11) NOT NULL,
  `languageName` text DEFAULT NULL,
  `maxTime` float NOT NULL DEFAULT 0,
  `maxMemory` int(11) NOT NULL DEFAULT 0,
  `userId` int(11) NOT NULL,
  `submissionTime` datetime NOT NULL,
  `submissionVerdict` int(11) NOT NULL DEFAULT 1,
  `testCaseReady` int(11) NOT NULL DEFAULT -1,
  `judgeComplete` int(11) NOT NULL DEFAULT 0,
  `runOnTest` int(11) NOT NULL DEFAULT 1,
  `totalPoint` int(11) NOT NULL DEFAULT 0,
  `passedPoint` int(11) NOT NULL DEFAULT 0,
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
  `testCaseId` int(11) DEFAULT NULL,
  `testCaseToken` varchar(100) DEFAULT NULL,
  `judgeStatus` int(11) NOT NULL DEFAULT -1,
  `verdict` int(11) NOT NULL DEFAULT 0,
  `totalTime` float NOT NULL DEFAULT 0,
  `totalMemory` int(11) NOT NULL DEFAULT 0,
  `point` int(11) NOT NULL DEFAULT 0,
  `input` text NOT NULL DEFAULT '',
  `output` text NOT NULL DEFAULT '',
  `answer` text NOT NULL DEFAULT '',
  `checkerLog` text NOT NULL DEFAULT '',
  `responseData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`responseData`))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_case`
--

CREATE TABLE `test_case` (
  `testCaseId` int(11) NOT NULL,
  `testCaseIdHash` varchar(150) DEFAULT NULL,
  `testCasePoint` int(11) NOT NULL DEFAULT 1,
  `problemId` int(11) NOT NULL,
  `testCaseSample` enum('1','0') NOT NULL DEFAULT '0',
  `testCaseAddedDate` datetime NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userFullName` text DEFAULT NULL,
  `userHandle` varchar(40) NOT NULL,
  `userEmail` text NOT NULL,
  `userPhoto` text DEFAULT NULL,
  `instituteName` text DEFAULT NULL,
  `userPassword` varchar(150) NOT NULL,
  `userRoles` int(11) NOT NULL DEFAULT 40,
  `userRegistrationDate` datetime NOT NULL,
  `userLastLoginInfo` text DEFAULT NULL,
  `lastLoginTime` datetime DEFAULT NULL,
  `lastLoginIp` text DEFAULT NULL,
  `lastLoginBrowser` text DEFAULT NULL,
  `lastLoginUrl` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`contestId`),
  ADD KEY `FK_ContestUserId` (`userId`),
  ADD KEY `FK_ContestFormId` (`formId`);

--
-- Indexes for table `contest_clearification`
--
ALTER TABLE `contest_clearification`
  ADD PRIMARY KEY (`contestClearificationId`),
  ADD KEY `FK_ContestClearificationContestId` (`contestId`),
  ADD KEY `FK_ContestClearificationUserId` (`userId`);

--
-- Indexes for table `contest_moderator`
--
ALTER TABLE `contest_moderator`
  ADD PRIMARY KEY (`contestModeratorId`),
  ADD UNIQUE KEY `UC_ContestModerator` (`contestId`,`userId`),
  ADD KEY `FK_ContestModeratorUserId` (`userId`);

--
-- Indexes for table `contest_problem_set`
--
ALTER TABLE `contest_problem_set`
  ADD PRIMARY KEY (`contestProblemSetId`),
  ADD UNIQUE KEY `UC_ContestProblem` (`contestId`,`problemId`),
  ADD KEY `FK_ContestProblemSetProblemId` (`problemId`);

--
-- Indexes for table `contest_registration`
--
ALTER TABLE `contest_registration`
  ADD PRIMARY KEY (`contestRegistrationId`),
  ADD UNIQUE KEY `UC_ContestRegistrationContestUser` (`contestId`,`userId`),
  ADD KEY `FK_ContestRegistrationUserId` (`userId`);

--
-- Indexes for table `contest_registration_form`
--
ALTER TABLE `contest_registration_form`
  ADD PRIMARY KEY (`contestRegistrationFormId`),
  ADD KEY `FK_ContestRegistrationFormContestId` (`contestId`);

--
-- Indexes for table `contest_submission`
--
ALTER TABLE `contest_submission`
  ADD PRIMARY KEY (`contestSubmissionId`),
  ADD UNIQUE KEY `UC_ContestSubmission` (`contestId`,`submissionId`),
  ADD KEY `FK_ContestSubmissionSubmissionId` (`submissionId`);

--
-- Indexes for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD PRIMARY KEY (`fileUploadId`),
  ADD KEY `FK_FileUploadUser` (`userId`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`formId`),
  ADD KEY `FK_FormUserId` (`userId`);

--
-- Indexes for table `form_question`
--
ALTER TABLE `form_question`
  ADD PRIMARY KEY (`formQuestionId`),
  ADD UNIQUE KEY `UC_FormQuestion` (`formId`,`formQuestionTitle`);

--
-- Indexes for table `judge_problem_list`
--
ALTER TABLE `judge_problem_list`
  ADD PRIMARY KEY (`judgeProblemListId`),
  ADD UNIQUE KEY `UC_ProblemId` (`problemId`);

--
-- Indexes for table `judge_setting`
--
ALTER TABLE `judge_setting`
  ADD PRIMARY KEY (`judgeSettingId`);

--
-- Indexes for table `page_view`
--
ALTER TABLE `page_view`
  ADD PRIMARY KEY (`pageViewId`);

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
  ADD KEY `FK_SubmissionId` (`submissionId`),
  ADD KEY `FK_testCaseId` (`testCaseId`);

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
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `contestId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_clearification`
--
ALTER TABLE `contest_clearification`
  MODIFY `contestClearificationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_moderator`
--
ALTER TABLE `contest_moderator`
  MODIFY `contestModeratorId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_problem_set`
--
ALTER TABLE `contest_problem_set`
  MODIFY `contestProblemSetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_registration`
--
ALTER TABLE `contest_registration`
  MODIFY `contestRegistrationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_registration_form`
--
ALTER TABLE `contest_registration_form`
  MODIFY `contestRegistrationFormId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_submission`
--
ALTER TABLE `contest_submission`
  MODIFY `contestSubmissionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_upload`
--
ALTER TABLE `file_upload`
  MODIFY `fileUploadId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `formId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_question`
--
ALTER TABLE `form_question`
  MODIFY `formQuestionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `judge_problem_list`
--
ALTER TABLE `judge_problem_list`
  MODIFY `judgeProblemListId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `judge_setting`
--
ALTER TABLE `judge_setting`
  MODIFY `judgeSettingId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_view`
--
ALTER TABLE `page_view`
  MODIFY `pageViewId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `problemId` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `testCaseId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contest`
--
ALTER TABLE `contest`
  ADD CONSTRAINT `FK_ContestFormId` FOREIGN KEY (`formId`) REFERENCES `form` (`formId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ContestUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `contest_clearification`
--
ALTER TABLE `contest_clearification`
  ADD CONSTRAINT `FK_ContestClearificationContestId` FOREIGN KEY (`contestId`) REFERENCES `contest` (`contestId`),
  ADD CONSTRAINT `FK_ContestClearificationUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `contest_moderator`
--
ALTER TABLE `contest_moderator`
  ADD CONSTRAINT `FK_ContestModeratorContestId` FOREIGN KEY (`contestId`) REFERENCES `contest` (`contestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ContestModeratorUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `contest_problem_set`
--
ALTER TABLE `contest_problem_set`
  ADD CONSTRAINT `FK_ContestProblemSetContestId` FOREIGN KEY (`contestId`) REFERENCES `contest` (`contestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ContestProblemSetProblemId` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`);

--
-- Constraints for table `contest_registration`
--
ALTER TABLE `contest_registration`
  ADD CONSTRAINT `FK_ContestRegistrationContestId` FOREIGN KEY (`contestId`) REFERENCES `contest` (`contestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ContestRegistrationUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `contest_registration_form`
--
ALTER TABLE `contest_registration_form`
  ADD CONSTRAINT `FK_ContestRegistrationFormContestId` FOREIGN KEY (`contestId`) REFERENCES `contest` (`contestId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contest_submission`
--
ALTER TABLE `contest_submission`
  ADD CONSTRAINT `FK_ContestSubmissionContestId` FOREIGN KEY (`contestId`) REFERENCES `contest` (`contestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ContestSubmissionSubmissionId` FOREIGN KEY (`submissionId`) REFERENCES `submissions` (`submissionId`);

--
-- Constraints for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD CONSTRAINT `FK_FileUploadUser` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `FK_FormUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `form_question`
--
ALTER TABLE `form_question`
  ADD CONSTRAINT `FK_FormQuestionFormId` FOREIGN KEY (`formId`) REFERENCES `form` (`formId`);

--
-- Constraints for table `judge_problem_list`
--
ALTER TABLE `judge_problem_list`
  ADD CONSTRAINT `FK_ProblemId` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`);

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `fk_problem_user` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `problem_moderator`
--
ALTER TABLE `problem_moderator`
  ADD CONSTRAINT `FK_ProblemModeratorProblem` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`) ON DELETE CASCADE,
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