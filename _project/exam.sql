-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2014 at 05:21 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exam`
--

--
-- Functions
--
CREATE FUNCTION `getSubject`(subid VARCHAR(8)) RETURNS varchar(50) CHARSET utf8
RETURN (Select Sub_name from subject where Sub_id = subid);

CREATE FUNCTION `getTopic`(topid INT) RETURNS varchar(50) CHARSET utf8
RETURN (Select Top_name from topics where Top_id = topid);


-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `Q_id` int(11) NOT NULL AUTO_INCREMENT,
  `Question` varchar(100) NOT NULL,
  `Choice1` varchar(70) NOT NULL,
  `Choice2` varchar(70) NOT NULL,
  `Choice3` varchar(70) DEFAULT NULL,
  `Choice4` varchar(70) DEFAULT NULL,
  `Choice5` varchar(70) DEFAULT NULL,
  `Correct` char(1) NOT NULL,
  `Top_id` int(11) NOT NULL,
  PRIMARY KEY (`Q_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Q_id`, `Question`, `Choice1`, `Choice2`, `Choice3`, `Choice4`, `Choice5`, `Correct`, `Top_id`) VALUES
(1, 'ถ้าฝนตกแล้วแดดออก  แต่วันนี้แดดไม่ออก พังนั้นสรุปได้ว่า', 'วันนี้ฝนไม่ตก', 'วันนี้ฝนตกโดยไม่มีแดด', 'วันนี้ฝนอาจจะตก', 'ยังสรุปแน่นอนไม่ได้', NULL, '2', 1),
(2, 'ประโยคในข้อใดต่อไปนี้เป็นประพจน์', 'ประชาชนผู้มีเงินได้ทุกคนต้องเสียภาษี', 'นักเรียนที่ดีต้องตั้งใจเรียน', 'สมการ 3x + 4y + 5 = 0 มีกราฟเป็นเส้นตรง', '5 + 3 มีค่าเท่าใด', NULL, '3', 1),
(3, 'อีก 10 ปี น้องพีอายุ 22 ปี ถามว่า 10 ปีที่แล้วเขาอายุเท่าใด', '0', '2', '12', '22', NULL, '2', 1),
(4, '"4, 5, 7, 10, 14, แล้วเท่าใด"', '18', '19', '20', '21', NULL, '2', 1),
(5, 'เลขจำนวนเต็มบวกคี่ 3 จำนวนเรียงกัน รวมกันได้ 15 เลขที่น้อยสุดคือเลขอะไร', '1', '3', '5', '7', NULL, '2', 1),
(6, 'ซื้อดินสอโหลละ 24 บาท ขายไปแท่งละ 3 บาท จะได้กำไรเท่าใด', '3', '6', '12', '18', NULL, '3', 1),
(7, 'จำนวนใดเป็นเลขคู่', '287', '356', '555', '987', NULL, '2', 1),
(8, 'การบัญชี หมายถึง', 'การจัดทําบัญชีรับจ่ายเงินสด', 'การจัดหาข้อมูลทางการเงินของกิจการค้า', 'การจดบันทึก รวบรวม และสรุปผลข้อมูลทางการเงิน', 'การจดบันทึก การจําแนก การสรุปผล และการรายงานเกี่\r\nยวกับการเงิน', 'ถูกทุกข้อ', '4', 2),
(9, 'งบดุลของกิจการค้าจะแสดงถึง', 'ผลการดําเนินงานในงวดหนึ่ง ๆ ของกิจการค้า', 'ฐานะการเงินของกิจการค้า ณ วันใดวันหนึ่ง', 'สินทรัพย์ หนี้สิน และทุนในรอบระยะเวลาหนึ่ง ๆ ของกิจการค้า', 'ส่วนของเจ้าของ ณ วันใดวันหนึ่ง', 'ถูกทุกข้อ', '2', 2),
(10, 'งบกําไรขาดทุนของกิจการค้า แสดงถึง', 'ผลการดําเนินงานในรอบระยะเวลาการดําเนินงานหนึ่ง ๆ ของกิจการค้า', 'ฐานะการเงินของกิจการค้า ณ วันใดวันหนึ่ง', 'ผลการดําเนินงานกําไรสุทธิหรือขาดทุนสุทธิ ณ วันสิ้นปี', 'การเปรียบเทียบระหว่างรายได้กับค่าใช้จ่ายในแต่ละปี', 'ถูกทุกข้อ', '1', 2),
(11, 'กิจการหนึ่งมีสินทรัพย์ 100,000 บาท และมีส่วนของเจ้าของ 60,000 บาท กิจการมีหนี้สินเท่าใด \r\n', '160,000 บาท', '100,000 บาท', '60,000 บาท', '40,000 บาท', 'ผิดทุกข้อ', '4', 2),
(12, 'สมการบัญชีที่ถูกต้อง คือ', 'สินทรัพย์ = หนี้สิน + ส่วนของเจ้าของ', 'สินทรัพย์ – ค่าใช้จ่าย = หนี้สิน + ส่วนของเจ้าของ + รายได้', 'สินทรัพย์ + หนี้สิน = ส่วนของเจ้าของ', 'ถูกทั้งข้อ 1 และข้อ 3', 'ถูกทุกข้อ', '1', 2),
(13, 'The Eiffel Tower is in ................', 'French', 'France', 'Franch', 'U.S.A.', NULL, '2', 3),
(14, 'You are in China, so you can speak ............', 'Chinese', 'Chinaware', 'Chinian', 'Chinaman', NULL, '1', 3),
(15, 'Natacha is from Sweden, so she has..........nationality', 'Swedian', 'Sweden', 'Swedese', 'Swedish', NULL, '4', 3),
(16, '........is a language, but Portugal is a country', 'Portugese', 'Portugs', 'Portuguese', 'portugulese', NULL, '3', 3),
(17, '................is the language of Germany', 'German', 'Germans', 'Germanese', 'Germanase', NULL, '1', 3),
(18, 'I have.........else to do, so I want to go home.', 'nothing', 'no', 'none', 'no one', NULL, '1', 4),
(19, 'If the telephone .........while I am out , please answer it.', 'will ring', 'rings', 'is ringing', 'is going to ring', NULL, '2', 4),
(20, 'If you ever........the Queen, what.....you do?', 'will meet, will', 'met, will', 'meet, would', 'met, would', NULL, '4', 4),
(21, 'He was drunk. He drank...........alcohol last night', 'too much', 'too many', 'too', 'much', NULL, '1', 4),
(22, 'I have ............cigarettes left.', 'a little', 'a one', 'a few', 'much', NULL, '3', 4),
(23, 'Elephant แปลว่า', 'กระบือ', 'กระทิง', 'ช้าง', 'ชะนี', '', '3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `question_detail`
--

CREATE TABLE IF NOT EXISTS `question_detail` (
  `Stu_id` varchar(8) NOT NULL,
  `Q_id` int(11) NOT NULL,
  `Answer` char(1) NOT NULL,
  PRIMARY KEY (`Stu_id`,`Q_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_detail`
--

INSERT INTO `question_detail` (`Stu_id`, `Q_id`, `Answer`) VALUES
('54310409', 5, '2'),
('54310409', 1, '2'),
('54310409', 3, '2'),
('54310409', 6, '3'),
('54310409', 2, '3'),
('54310104', 8, '1'),
('54310104', 6, '2'),
('54310104', 5, '3'),
('54310104', 4, '2'),
('54310104', 3, '3'),
('54310104', 2, '2'),
('54310104', 1, '4'),
('54310104', 9, '2'),
('54310104', 10, '3'),
('54310104', 11, '4'),
('54310104', 12, '3'),
('54310104', 16, '1'),
('54310104', 22, '1'),
('54310104', 21, '4'),
('54310104', 18, '3'),
('54310104', 20, '2'),
('54310104', 19, '1'),
('54310104', 17, '2'),
('54310104', 23, '3'),
('54310104', 13, '4'),
('54310104', 15, '1'),
('54310104', 14, '1');

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard`
--

CREATE TABLE IF NOT EXISTS `scoreboard` (
  `Sco_id` int(4) NOT NULL AUTO_INCREMENT,
  `Stu_id` varchar(8) NOT NULL,
  `Sub_id` varchar(8) NOT NULL,
  `Top_id` int(11) NOT NULL,
  `Sco_time` datetime NOT NULL,
  `Score` double NOT NULL,
  PRIMARY KEY (`Stu_id`,`Top_id`,`Sub_id`,`Sco_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `scoreboard`
--

INSERT INTO `scoreboard` (`Sco_id`, `Stu_id`, `Sub_id`, `Top_id`, `Sco_time`, `Score`) VALUES
(1, '54310409', '290123', 1, '0000-00-00 00:00:00', 5),
(2, '54310104', '290123', 1, '2014-02-21 10:30:28', 1),
(3, '54310104', '290123', 2, '0000-00-00 00:00:00', 2),
(1, '54310104', '290456', 4, '0000-00-00 00:00:00', 0),
(1, '54310104', '290456', 3, '0000-00-00 00:00:00', 1),
(2, '54310104', '290456', 3, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `Stu_id` varchar(8) NOT NULL,
  `Stu_name` varchar(30) NOT NULL,
  `Stu_pwd` varchar(64) NOT NULL,
  `Stu_major` varchar(40) NOT NULL,
  `Stu_gender` varchar(6) NOT NULL,
  `Stu_email` varchar(40) DEFAULT NULL,
  `Stu_pic` varchar(67) DEFAULT NULL,
  PRIMARY KEY (`Stu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Stu_id`, `Stu_name`, `Stu_pwd`, `Stu_major`, `Stu_gender`, `Stu_email`, `Stu_pic`) VALUES
('54310104', 'นรภัทร  นิ่มมณี', '1234', 'IS', 'male', 'charge_n@hotmail.com', NULL),
('54310409', 'วรพงษ์  คงประเสริฐ', '12345', 'IS', 'male', 'penguin_poat@hotmail.com', NULL),
('54310854', 'ณัฐพล ประสานเชื้อ', '12345', 'IS', 'male', 'aichondam@gmail.com', NULL),
('54310342', 'กฤตภาส บวรทวีปัญญา', '12345', 'IS', 'male', '', NULL),
('50310123', 'อรวรรณ จิตการ', '123456', 'IS', 'female', 'aorwa@hotmail.com', NULL),
('54310856', 'ธนภาค จิระวิทิตชัย', '12345', 'IS', 'male', 'thanapak_08@hotmail.com', NULL),
('53310123', 'ประสบลาภ ดวงดี', 'pp', 'CIS', 'male', 'pp@hotmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `Sub_id` varchar(8) NOT NULL,
  `Sub_name` varchar(50) NOT NULL,
  `Tea_id` varchar(8) NOT NULL,
  PRIMARY KEY (`Sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Sub_id`, `Sub_name`, `Tea_id`) VALUES
('290123', 'คณิตศาสตร์', 'T01'),
('290456', 'ภาษาอังกฤษ', 'T02');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `Tea_id` varchar(8) NOT NULL,
  `Tea_name` varchar(30) NOT NULL,
  `Tea_pwd` varchar(40) NOT NULL,
  `Tea_gender` varchar(6) NOT NULL,
  `Tea_email` varchar(40) DEFAULT NULL,
  `Tea_pic` varchar(67) DEFAULT NULL,
  PRIMARY KEY (`Tea_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`Tea_id`, `Tea_name`, `Tea_pwd`, `Tea_gender`, `Tea_email`, `Tea_pic`) VALUES
('ajakaras', 'อัครา  โสภารักษ์', '098765', 'female', 'Akara@hotmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `Top_id` int(11) NOT NULL AUTO_INCREMENT,
  `Top_name` varchar(50) NOT NULL,
  `Sub_id` varchar(8) NOT NULL,
  PRIMARY KEY (`Top_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`Top_id`, `Top_name`, `Sub_id`) VALUES
(1, 'ตรรกศาสตร์', '290123'),
(2, 'การเงิน', '290123'),
(3, 'ศัพท์ Vocabulary', '290456'),
(4, 'ไวยากรณ์ Grammar', '290456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
