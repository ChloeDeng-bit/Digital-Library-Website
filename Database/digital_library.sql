-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:8889
-- 生成日期： 2022-05-27 22:39:45
-- 服务器版本： 5.7.34
-- PHP 版本： 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `digital_library`
--

-- --------------------------------------------------------

--
-- 表的结构 `resource`
--

CREATE TABLE `resource` (
  `bookNo` int(20) NOT NULL,
  `ISBN` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(40) NOT NULL,
  `publisher` varchar(40) NOT NULL,
  `status` varchar(50) NOT NULL,
  `cost_per_day` double(10,2) NOT NULL,
  `borrowerID` varchar(20) DEFAULT NULL,
  `borrower` varchar(50) DEFAULT NULL,
  `borrow_time` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `resource`
--

INSERT INTO `resource` (`bookNo`, `ISBN`, `title`, `author`, `publisher`, `status`, `cost_per_day`, `borrowerID`, `borrower`, `borrow_time`, `expire_date`, `total_cost`) VALUES
(1, 273748, 'godiva', 'belgium', 'cookies', 'avaliable', 1.00, NULL, NULL, NULL, NULL, NULL),
(2, 738597, 'estee lau', 'eclipse', 'cookies', 'in_borrow', 1.00, '15', 'meiyun deng', '2022-05-27', '2022-06-26', '30.00'),
(3, 7389499, 'clinque', 'jk.rolling', 'cookies', 'in_borrow', 2.00, '1', 'jane kate', '2022-05-27', '2022-06-26', '60.00'),
(4, 675937, 'great wall', 'jim.chen', 'cookies', 'avaliable', 2.00, NULL, NULL, NULL, NULL, NULL),
(5, 263485, 'information beauty', 'smith', 'jasmine', 'avaliable', 1.00, NULL, NULL, NULL, NULL, NULL),
(6, 848595, 'fire work', 'david.jones', 'jasmine', 'in_borrow', 0.00, '1', 'jane kate', '2022-05-27', '2022-06-26', '0.00'),
(7, 747585, 'wonder life', 'smith', 'jasmine', 'in_borrow', 0.00, '1', 'jane kate', '2022-05-27', '2022-06-26', '0.00'),
(8, 637485, 'sunny day', 'chloe deng', 'jasmine', 'in_borrow', 0.00, '15', 'meiyun deng', '2022-05-27', '2022-06-26', '0.00'),
(9, 736485, 'good friends', 'meiyun ', 'jasmine', 'in_borrow', 0.50, '15', 'meiyun deng', '2022-05-27', '2022-06-26', '15.00'),
(11, 284959, 'interesting story', 'vivian lan', 'jasmine', 'avaliable', 0.50, NULL, NULL, NULL, NULL, NULL),
(12, 746485, 'another day', 'meiyun deng', 'jasmine', 'in_borrow', 0.50, '18', 'nick chen', '2022-05-27', '2022-06-26', '15.00');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `ID` smallint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `type` varchar(10) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`ID`, `name`, `surname`, `phone`, `email`, `type`, `password`) VALUES
(1, 'jane', 'kate', 497575888, 'ddsdd@oo.com', 'borrower', '839483'),
(10, 'meiyun', 'deng', 497575822, '111@outlook.com', 'librarian', '98a9c12a85dc1dfe303bb0c000855e97'),
(11, 'meiyun', 'deng', 497575822, '222@outlook.com', 'librarian', '935c6c89f623b1c5edfa2d8e3015e37a'),
(12, 'meiyun', 'deng', 497575822, 'meiyundeng@outlook.com', 'librarian', 'bdd5b480b00f703b61c26ffcb7ec5e6b'),
(13, 'meiyun', 'deng', 497575822, 'mg@outlook.com', 'borrower', 'bdd5b480b00f703b61c26ffcb7ec5e6b'),
(14, 'meiyun', 'deng', 497575822, '333@outlook.com', 'librarian', 'bdd5b480b00f703b61c26ffcb7ec5e6b'),
(15, 'meiyun', 'deng', 497575822, '444@outlook.com', 'borrower', 'bdd5b480b00f703b61c26ffcb7ec5e6b'),
(16, 'jonne', 'deep', 744839485, 'jonnedeep@outlook.com', 'librarian', '1bd5d61d89d2115c2ddc88fc5ebcc97f'),
(17, 'happy', 'deng', 497579988, 'haapy@outlook.com', 'librarian', 'bfd59291e825b5f2bbf1eb76569f8fe7'),
(18, 'nick', 'chen', 497123422, 'nickchen@outlook.com', 'librarian', '1bd5d61d89d2115c2ddc88fc5ebcc97f'),
(19, 'karren', 'yang', 497588982, 'karrenyang@outlook.com', 'librarian', 'bdd5b480b00f703b61c26ffcb7ec5e6b'),
(20, 'sharry', 'cook', 491215822, 'sharrycook@outlook.com', 'librarian', 'bdd5b480b00f703b61c26ffcb7ec5e6b'),
(21, 'kate', 'neill', 497571234, 'kateneil@outlook.com', 'librarian', 'bdd5b480b00f703b61c26ffcb7ec5e6b'),
(22, 'ethern ', 'chen', 491225822, 'ethernchen@outlook.com', 'borrower', '1bd5d61d89d2115c2ddc88fc5ebcc97f'),
(23, 'david', 'wu', 497510002, 'davidwu@outlook.com', 'borrower', 'e8331a2528a63316a3382489c1d29e29'),
(24, 'may', 'dida', 497575555, 'meydida@outlook.com', 'borrower', 'e8331a2528a63316a3382489c1d29e29'),
(25, 'yeshu', 'mika', 434565822, 'yeshumika@outlook.com', 'librarian', 'bfd59291e825b5f2bbf1eb76569f8fe7'),
(26, 'nico', 'guo', 497554321, 'nichguo@outlook.com', 'librarian', 'e8331a2528a63316a3382489c1d29e29'),
(27, 'tiantian', 'cui', 497598765, 'tiantiancui@outlook.com', 'borrower', 'bbf970a791b94850ed4ebcb8652569ea');

--
-- 转储表的索引
--

--
-- 表的索引 `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`bookNo`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `resource`
--
ALTER TABLE `resource`
  MODIFY `bookNo` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `ID` smallint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
