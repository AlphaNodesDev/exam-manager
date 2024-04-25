```-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 08, 2024 at 06:34 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `chair_conf`
--

DROP TABLE IF EXISTS `chair_conf`;
CREATE TABLE IF NOT EXISTS `chair_conf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eid` int NOT NULL,
  `dt` date NOT NULL,
  `tim` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chair_conf`
--

INSERT INTO `chair_conf` (`id`, `eid`, `dt`, `tim`) VALUES
(1, 1, '2024-03-06', '21:00'),
(3, 1, '2024-03-06', '19:56');

-- --------------------------------------------------------

--
-- Table structure for table `chapter_data`
--

DROP TABLE IF EXISTS `chapter_data`;
CREATE TABLE IF NOT EXISTS `chapter_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subid` varchar(150) NOT NULL,
  `chap_nme` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crs_info`
--

DROP TABLE IF EXISTS `crs_info`;
CREATE TABLE IF NOT EXISTS `crs_info` (
  `crsid` int NOT NULL AUTO_INCREMENT,
  `crs_nme` varchar(75) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`crsid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `crs_info`
--

INSERT INTO `crs_info` (`crsid`, `crs_nme`, `st`) VALUES
(1, 'B-TECH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cxam_ansrkey`
--

DROP TABLE IF EXISTS `cxam_ansrkey`;
CREATE TABLE IF NOT EXISTS `cxam_ansrkey` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qid` int NOT NULL,
  `opt` text NOT NULL,
  `ans` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cxam_qnbank`
--

DROP TABLE IF EXISTS `cxam_qnbank`;
CREATE TABLE IF NOT EXISTS `cxam_qnbank` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cid` int NOT NULL,
  `did` int NOT NULL,
  `subid` varchar(50) NOT NULL,
  `qn` text NOT NULL,
  `qn_by` varchar(100) NOT NULL,
  `sem` int NOT NULL,
  `chap` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dbt_ans`
--

DROP TABLE IF EXISTS `dbt_ans`;
CREATE TABLE IF NOT EXISTS `dbt_ans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dbtid` int NOT NULL,
  `ans` text NOT NULL,
  `dt` date NOT NULL,
  `ansby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dep_info`
--

DROP TABLE IF EXISTS `dep_info`;
CREATE TABLE IF NOT EXISTS `dep_info` (
  `depid` int NOT NULL AUTO_INCREMENT,
  `crsid` int NOT NULL,
  `dep_nme` varchar(150) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`depid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dep_info`
--

INSERT INTO `dep_info` (`depid`, `crsid`, `dep_nme`, `st`) VALUES
(1, 1, 'EEE', 1),
(2, 1, 'CSE', 1),
(3, 1, 'ECE', 1),
(4, 1, 'MECHANICAL', 1),
(5, 1, 'Civil', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_assign`
--

DROP TABLE IF EXISTS `exam_assign`;
CREATE TABLE IF NOT EXISTS `exam_assign` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eid` int NOT NULL,
  `crsid` int NOT NULL,
  `depid` int NOT NULL,
  `acyr` int NOT NULL,
  `sem` int NOT NULL,
  `subjid` varchar(20) NOT NULL,
  `dt` date NOT NULL,
  `tim` varchar(50) NOT NULL,
  `seat_status` int NOT NULL,
  `noticed_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_assign`
--

INSERT INTO `exam_assign` (`id`, `eid`, `crsid`, `depid`, `acyr`, `sem`, `subjid`, `dt`, `tim`, `seat_status`, `noticed_status`) VALUES
(1, 1, 1, 1, 0, 1, 'LEE102', '2024-03-08', '13:03', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_cmplnt`
--

DROP TABLE IF EXISTS `exam_cmplnt`;
CREATE TABLE IF NOT EXISTS `exam_cmplnt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dt` date NOT NULL,
  `tim` varchar(50) NOT NULL,
  `eid` int NOT NULL,
  `rmnum` int NOT NULL,
  `admnum` varchar(100) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `descr` text NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_data`
--

DROP TABLE IF EXISTS `exam_data`;
CREATE TABLE IF NOT EXISTS `exam_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exm_titl` varchar(250) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_data`
--

INSERT INTO `exam_data` (`id`, `exm_titl`, `st`) VALUES
(1, 'Series 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_stud`
--

DROP TABLE IF EXISTS `exam_stud`;
CREATE TABLE IF NOT EXISTS `exam_stud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eassign_id` int NOT NULL,
  `studid` varchar(20) NOT NULL,
  `xamtyp` int NOT NULL COMMENT '1=normal,2=supply',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notice_data`
--

DROP TABLE IF EXISTS `notice_data`;
CREATE TABLE IF NOT EXISTS `notice_data` (
  `nid` int NOT NULL AUTO_INCREMENT,
  `tit` varchar(250) NOT NULL,
  `pdt` date NOT NULL,
  `edt` date NOT NULL,
  `msg` text NOT NULL,
  `pby` varchar(150) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room_assign`
--

DROP TABLE IF EXISTS `room_assign`;
CREATE TABLE IF NOT EXISTS `room_assign` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eid` int NOT NULL,
  `blknme` varchar(25) NOT NULL,
  `rumid` varchar(25) NOT NULL,
  `bnch` int NOT NULL,
  `bnch_num` int NOT NULL,
  `rolnum` varchar(50) NOT NULL,
  `dt` date NOT NULL,
  `tim` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_assign`
--

INSERT INTO `room_assign` (`id`, `eid`, `blknme`, `rumid`, `bnch`, `bnch_num`, `rolnum`, `dt`, `tim`) VALUES
(1, 1, 'SH1', '1', 1, 1, '1', '2024-03-08', '13:03'),
(3, 1, 'SH1', '1', 1, 2, '2', '2024-03-08', '13:03');

-- --------------------------------------------------------

--
-- Table structure for table `room_data`
--

DROP TABLE IF EXISTS `room_data`;
CREATE TABLE IF NOT EXISTS `room_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `blk_nme` varchar(50) NOT NULL,
  `rm_nbr` varchar(50) NOT NULL,
  `bnch` int NOT NULL,
  `nros` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_data`
--

INSERT INTO `room_data` (`id`, `blk_nme`, `rm_nbr`, `bnch`, `nros`) VALUES
(1, 'SH1', '1', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sem_gpa_total`
--

DROP TABLE IF EXISTS `sem_gpa_total`;
CREATE TABLE IF NOT EXISTS `sem_gpa_total` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stud_id` varchar(50) NOT NULL,
  `tgpa` varchar(50) NOT NULL,
  `tbpap` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_allocation`
--

DROP TABLE IF EXISTS `staff_allocation`;
CREATE TABLE IF NOT EXISTS `staff_allocation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stid` varchar(50) NOT NULL,
  `eid` int NOT NULL,
  `dt` date NOT NULL,
  `tim` varchar(50) NOT NULL,
  `blk` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_allocation`
--

INSERT INTO `staff_allocation` (`id`, `stid`, `eid`, `dt`, `tim`, `blk`, `room`) VALUES
(1, '', 1, '2024-03-06', '21:00', 'SH1', '1'),
(3, '', 1, '2024-03-06', '19:56', 'SH1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `staff_data`
--

DROP TABLE IF EXISTS `staff_data`;
CREATE TABLE IF NOT EXISTS `staff_data` (
  `stid` int NOT NULL AUTO_INCREMENT,
  `nme` varchar(150) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `con` varchar(15) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`stid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staf_data`
--

DROP TABLE IF EXISTS `staf_data`;
CREATE TABLE IF NOT EXISTS `staf_data` (
  `stfid` int NOT NULL AUTO_INCREMENT,
  `nme` varchar(100) NOT NULL,
  `stfif` varchar(25) NOT NULL,
  `crs` int NOT NULL,
  `dep` int NOT NULL,
  `desig` varchar(50) NOT NULL COMMENT '1=hod,2=advsr,3=tchr',
  `adr` text NOT NULL,
  `con` varchar(15) NOT NULL,
  `em` varchar(150) NOT NULL,
  `qual` varchar(50) NOT NULL,
  `pic` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `st` int NOT NULL,
  `ealo` int NOT NULL,
  PRIMARY KEY (`stfid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staf_data`
--

INSERT INTO `staf_data` (`stfid`, `nme`, `stfif`, `crs`, `dep`, `desig`, `adr`, `con`, `em`, `qual`, `pic`, `dob`, `st`, `ealo`) VALUES
(1, 'staff', 'staff', 0, 0, '4', 'address', '8129205144', 'shh@gmail.com', 'null', 'staff.png', '1995-01-06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stf_alo_chk`
--

DROP TABLE IF EXISTS `stf_alo_chk`;
CREATE TABLE IF NOT EXISTS `stf_alo_chk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

DROP TABLE IF EXISTS `student_data`;
CREATE TABLE IF NOT EXISTS `student_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `crs` int NOT NULL,
  `dep` int NOT NULL,
  `sem` int NOT NULL,
  `ay` int NOT NULL,
  `active_st` int NOT NULL COMMENT '1=incolege,2=passout,3=removed',
  `nme` varchar(100) NOT NULL,
  `admnum` varchar(25) NOT NULL,
  `regnum` varchar(50) NOT NULL,
  `addr` text NOT NULL,
  `dob` date NOT NULL,
  `con` varchar(15) NOT NULL,
  `fatrnme` varchar(100) NOT NULL,
  `mob` varchar(15) NOT NULL,
  `bldgrp` varchar(5) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `st` int NOT NULL COMMENT '0=not updated, 1=updated, 2=approved',
  `gndr` varchar(10) NOT NULL,
  `sslcmrk` float NOT NULL,
  `plstomrk` float NOT NULL,
  `sem1` float NOT NULL,
  `sem2` float NOT NULL,
  `sem3` float NOT NULL,
  `sem4` float NOT NULL,
  `sem5` float NOT NULL,
  `sem6` float NOT NULL,
  `sem7` float NOT NULL,
  `sem8` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `crs`, `dep`, `sem`, `ay`, `active_st`, `nme`, `admnum`, `regnum`, `addr`, `dob`, `con`, `fatrnme`, `mob`, `bldgrp`, `pic`, `st`, `gndr`, `sslcmrk`, `plstomrk`, `sem1`, `sem2`, `sem3`, `sem4`, `sem5`, `sem6`, `sem7`, `sem8`) VALUES
(1, 1, 1, 1, 2024, 1, 'alpha', '391809', '', 'shyjuss8129@gmail.com', '0000-00-00', '8129205144', 'Shylakumar', '8129205144', 'O+ve', 'nopic.jpg', 1, 'M', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 1, 1, 2024, 1, 'alpha2', '391810', '', 'alphanodes247@gmail.com', '0000-00-00', '8129205144', 'Shylakumar', '8129205144', 'O-ve', 'nopic.jpg', 1, 'M', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stud_doubt`
--

DROP TABLE IF EXISTS `stud_doubt`;
CREATE TABLE IF NOT EXISTS `stud_doubt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stud` varchar(50) NOT NULL,
  `stfid` varchar(50) NOT NULL,
  `dt` date NOT NULL,
  `dbt` text NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjct_assign`
--

DROP TABLE IF EXISTS `subjct_assign`;
CREATE TABLE IF NOT EXISTS `subjct_assign` (
  `assignid` int NOT NULL AUTO_INCREMENT,
  `stf_id` varchar(50) NOT NULL,
  `crs` int NOT NULL,
  `dep` int NOT NULL,
  `sem` int NOT NULL,
  `subnme` varchar(20) NOT NULL,
  `subid` varchar(125) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`assignid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `syllabus_data`
--

DROP TABLE IF EXISTS `syllabus_data`;
CREATE TABLE IF NOT EXISTS `syllabus_data` (
  `sylid` int NOT NULL AUTO_INCREMENT,
  `crsid` int NOT NULL,
  `depid` int NOT NULL,
  `sem` varchar(20) NOT NULL,
  `sub_nme` varchar(200) NOT NULL,
  `sub_id` varchar(50) NOT NULL,
  `syl_file` varchar(50) NOT NULL,
  `sub_mrk` varchar(10) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`sylid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syllabus_data`
--

INSERT INTO `syllabus_data` (`sylid`, `crsid`, `depid`, `sem`, `sub_nme`, `sub_id`, `syl_file`, `sub_mrk`, `st`) VALUES
(1, 1, 1, '1', 'Life Skill', 'LEE102', 'nodata', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `s_material`
--

DROP TABLE IF EXISTS `s_material`;
CREATE TABLE IF NOT EXISTS `s_material` (
  `id` int NOT NULL AUTO_INCREMENT,
  `crs` int NOT NULL,
  `dep` int NOT NULL,
  `sem` int NOT NULL,
  `subid` varchar(50) NOT NULL,
  `titl` varchar(250) NOT NULL,
  `descr` text NOT NULL,
  `fil` varchar(150) NOT NULL,
  `up_by` varchar(50) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload_ttable`
--

DROP TABLE IF EXISTS `upload_ttable`;
CREATE TABLE IF NOT EXISTS `upload_ttable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `etit` varchar(250) NOT NULL,
  `etyp` int NOT NULL,
  `file` varchar(200) NOT NULL,
  `dt` date NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
CREATE TABLE IF NOT EXISTS `user_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `typ` varchar(15) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `uid`, `pwd`, `typ`, `st`) VALUES
(1, 'admin', 'admin', 'admin', 1),
(2, 'staff', 'staff', 'STAF', 1),
(3, '391809', 'Wierless123@#$', 'stud', 1),
(4, '391810', 'Wierless123@#$', 'stud', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wall_post`
--

DROP TABLE IF EXISTS `wall_post`;
CREATE TABLE IF NOT EXISTS `wall_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stud_id` varchar(25) NOT NULL,
  `dt` date NOT NULL,
  `crs` varchar(10) NOT NULL,
  `dep` varchar(10) NOT NULL,
  `sem` varchar(10) NOT NULL,
  `msg` text NOT NULL,
  `tim` varchar(50) NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xam_ans`
--

DROP TABLE IF EXISTS `xam_ans`;
CREATE TABLE IF NOT EXISTS `xam_ans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `xamid` int NOT NULL,
  `sid` int NOT NULL,
  `qid` int NOT NULL,
  `aid` int NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xam_data`
--

DROP TABLE IF EXISTS `xam_data`;
CREATE TABLE IF NOT EXISTS `xam_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cid` int NOT NULL,
  `did` int NOT NULL,
  `semid` int NOT NULL,
  `subid` varchar(150) NOT NULL,
  `xam_tit` varchar(250) NOT NULL,
  `xam_dt` date NOT NULL,
  `tot_qn` int NOT NULL,
  `ad_by` varchar(150) NOT NULL,
  `ad_dt` int NOT NULL,
  `st` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xam_qn`
--

DROP TABLE IF EXISTS `xam_qn`;
CREATE TABLE IF NOT EXISTS `xam_qn` (
  `id` int NOT NULL AUTO_INCREMENT,
  `xamid` int NOT NULL,
  `qid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;


```

##Add Cronjob
type 
```

crontab -e
```
#enter 
```
* * * * * /exam/student/exam.php



