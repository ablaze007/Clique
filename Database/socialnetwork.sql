-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2018 at 01:56 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Post_ID` int(11) NOT NULL,
  `Profile_ID` int(11) NOT NULL,
  `Content` varchar(100) NOT NULL,
  `Comment_ID` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entertainment`
--

CREATE TABLE `entertainment` (
  `Page_ID` int(11) NOT NULL,
  `Field` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entertainment`
--

INSERT INTO `entertainment` (`Page_ID`, `Field`) VALUES
(2002, 'Wrestling'),
(2003, 'Music'),
(2007, 'Sports'),
(2008, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `Page_ID` int(11) NOT NULL,
  `Profile_ID` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`Page_ID`, `Profile_ID`, `Date`) VALUES
(2001, 1002, '2018-11-27'),
(2002, 1001, '2018-11-27'),
(2002, 1003, '2018-11-27'),
(2004, 1001, '2018-11-27'),
(2004, 1008, '2018-11-27'),
(2004, 1016, '2018-11-28'),
(2006, 1009, '2018-11-28'),
(2007, 1021, '2018-11-28'),
(2007, 1022, '2018-11-28'),
(2007, 1023, '2018-11-28'),
(2008, 1021, '2018-11-28'),
(2008, 1022, '2018-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `informative`
--

CREATE TABLE `informative` (
  `Page_ID` int(11) NOT NULL,
  `Subject` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `informative`
--

INSERT INTO `informative` (`Page_ID`, `Subject`) VALUES
(2001, 'Software Engineering'),
(2004, 'Science'),
(2005, 'Computer Science'),
(2006, 'University'),
(2009, 'Science'),
(2010, 'Politics');

-- --------------------------------------------------------

--
-- Table structure for table `manages`
--

CREATE TABLE `manages` (
  `Page_ID` int(11) NOT NULL,
  `Profile_ID` int(11) NOT NULL,
  `Level` varchar(20) NOT NULL,
  `Date_started` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manages`
--

INSERT INTO `manages` (`Page_ID`, `Profile_ID`, `Level`, `Date_started`) VALUES
(2001, 1001, 'Owner', '2018-11-27'),
(2002, 1002, 'Owner', '2018-11-27'),
(2003, 1005, 'Owner', '2018-11-27'),
(2004, 1007, 'Owner', '2018-11-27'),
(2005, 1010, 'Owner', '2018-11-28'),
(2006, 1010, 'Owner', '2018-11-28'),
(2007, 1013, 'Owner', '2018-11-28'),
(2008, 1013, 'Owner', '2018-11-28'),
(2009, 1011, 'Owner', '2018-11-28'),
(2010, 1012, 'Owner', '2018-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `Message_ID` int(11) NOT NULL,
  `Sender_ID` int(11) NOT NULL,
  `Receiver_ID` int(11) NOT NULL,
  `Content` varchar(100) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`Message_ID`, `Sender_ID`, `Receiver_ID`, `Content`, `Date`) VALUES
(5001, 1001, 1002, 'kxa Cena?', '2018-11-27'),
(5002, 1001, 1002, 'reply garr mula!', '2018-11-27'),
(5003, 1002, 1001, 'sorry dai busy thiye!', '2018-11-27'),
(5004, 1001, 1003, 'Lets meet up this weekend and hit the bar', '2018-11-27'),
(5005, 1008, 1007, 'How\'s your research on radioactive materials going?', '2018-11-27'),
(5006, 1007, 1008, 'Good! But I have a bad feeling about doing this.', '2018-11-27'),
(5007, 1001, 1003, 'What\'s up?', '2018-11-28'),
(5008, 1009, 1010, 'Hi! How are you?', '2018-11-28'),
(5009, 1010, 1009, 'Hi Ali, I am good! How about you?', '2018-11-28'),
(5010, 1012, 1011, 'What\'s up dude?', '2018-11-28'),
(5011, 1005, 1012, 'Hi Bruh! Wanna hang out?', '2018-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `Page_ID` int(11) NOT NULL,
  `Page_name` varchar(20) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `View_count` int(11) NOT NULL,
  `Image` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`Page_ID`, `Page_name`, `Description`, `View_count`, `Image`) VALUES
(2001, 'Software Engineers', 'A page for software engineering students', 6, NULL),
(2002, 'John Cena', 'A fan page', 12, NULL),
(2003, '24K Magic', 'Album by Bruno Mars', 0, NULL),
(2004, 'Science', 'A page for scientist', 8, NULL),
(2005, 'Algorithms', 'Algorithms and Data Structures in Computer Science', 0, NULL),
(2006, 'UT Arlington', 'The University of Texas at Arlington', 4, NULL),
(2007, 'Football', 'A community page for every football supporter and player', 6, NULL),
(2008, 'Manchester City', 'An official page for Man City Football Club', 5, NULL),
(2009, 'Computer Science', '\"Making world a better place\"', 1, NULL),
(2010, 'Politics', 'Politics for People', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `Post_ID` int(11) NOT NULL,
  `Profile_ID` int(11) NOT NULL,
  `Page_ID` int(11) NOT NULL,
  `Date_created` date NOT NULL,
  `Content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`Post_ID`, `Profile_ID`, `Page_ID`, `Date_created`, `Content`) VALUES
(3002, 1001, 2001, '2018-11-27', 'Please follow our page for informative stuffs on software engineering!'),
(3004, 1002, 2001, '2018-11-27', 'After retiring from wrestling, I really want to be a software engineer. '),
(3005, 1002, 2002, '2018-11-27', 'You can\'t see me!!'),
(3006, 1001, 2004, '2018-11-27', 'I always have been a big fan of Albert Einstein.'),
(3007, 1010, 2005, '2018-11-28', 'I am a professor for CSE2320-Algorithms at UT Arlington.'),
(3008, 1001, 2002, '2018-11-28', 'I can see you bruh!'),
(3009, 1009, 2006, '2018-11-28', 'Professor at UTA - Database'),
(3010, 1021, 2008, '2018-11-28', 'Proud to be part of Man City family <3'),
(3011, 1012, 2010, '2018-11-28', 'Politics is not a game. ');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `Profile_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `DOB` varchar(12) DEFAULT NULL,
  `Phone` varchar(13) DEFAULT NULL,
  `Email` varchar(20) NOT NULL,
  `Date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`Profile_ID`, `Username`, `Password`, `Fname`, `Lname`, `DOB`, `Phone`, `Email`, `Date_created`) VALUES
(1001, 'RHamal', '12345', 'Rajesh', 'Hamal', '1990-01-01', '12345', 'rxh@gmail.com', '2018-11-18'),
(1002, 'JCena', '12345', 'John', 'Cena', '1992-01-05', '10020', 'jxc@gmail.com', '2018-11-18'),
(1003, 'SKhan', '12345', 'Shahrukh', 'Khan', '1985-05-05', '10030', 'sxk@gmail.com', '2018-11-18'),
(1004, 'LDicaprio', '12345', 'Leonardo', 'DiCaprio', '1988-06-10', '10040', 'lxd@gmail.com', '2018-11-18'),
(1005, 'BMars', '12345', 'Bruno', 'Mars', '1992-12-12', '10050', 'bxm@gmail.com', '2018-11-18'),
(1006, 'KHart', '12345', 'Kevin', 'Hart', '1988-12-16', '46910002000', 'kxh@gmail.com', '2018-11-27'),
(1007, 'MCurie', '12345', 'Marie', 'Curie', '1945-12-05', '46910002000', 'mxc@gmail.com', '2018-11-27'),
(1008, 'SHawking', '12345', 'Stephen', 'Hawking', '1955-06-02', '46910003000', 'sxh@gmail.com', '2018-11-27'),
(1009, 'ASharifara', '12345', 'Ali', 'Sharifara', '1988-01-01', '10012341234', 'axs@gmail.com', '2018-11-28'),
(1010, 'AStefan', '12345', 'Alexandra', 'Stefan', '1980-05-05', '10010002000', 'astefan@gmail.com', '2018-11-28'),
(1011, 'BGates', '12345', 'Bill ', 'Gates', '1960-05-25', '1234123412', 'bxg@gmail.com', '2018-11-28'),
(1012, 'BObama', '12345', 'Barack', 'Obama', '1978-07-18', '1234512345', 'bxo@gmail.com', '2018-11-28'),
(1013, 'KDeBruyne', '12345', 'Kevin', 'De Bruyne', '1992-05-01', '1001001001', 'kdb@gmail.com', '2018-11-28'),
(1014, 'THanks', '12345', 'Tom', 'Hanks', '1968-02-05', '1001001002', 'txhanks@gmail.com', '2018-11-28'),
(1015, 'KPerry', '12345', 'Katy', 'Perry', '1990-12-12', '1001001004', 'kperry@gmail.com', '2018-11-28'),
(1016, 'NTesla', '12345', 'Nikola', 'Tesla', '1780-01-01', '1001001111', 'tesla@gmail.com', '2018-11-28'),
(1017, 'TEdison', '12345', 'Thomas', 'Edison', '1777-02-02', '1001002222', 'txe@gmail.com', '2018-11-28'),
(1018, 'ATuring', '12345', 'Alan', 'Turing', '1925-05-05', '1001001005', 'turing@gmail.com', '2018-11-28'),
(1019, 'DRitchie', '12345', 'Dennis', 'Ritchie', '1945-08-08', '1001001006', 'C@gmail.com', '2018-11-28'),
(1020, 'JGosling', '12345', 'James', 'Gosling', '1955-05-05', '1001003333', 'java@gmail.com', '2018-11-28'),
(1021, 'DSilva', '12345', 'David', 'Silva', '1985-05-05', '1002001001', 'dsilva@gmail.com', '2018-11-28'),
(1022, 'LMessi', '12345', 'Lionel', 'Messi', '1986-12-12', '1003001001', 'messi@gmail.com', '2018-11-28'),
(1023, 'CRonaldo', '12345', 'Cristiano', 'Ronaldo', '1984-12-12', '1003001002', 'cristiano@gmail.com', '2018-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `reaction`
--

CREATE TABLE `reaction` (
  `Post_ID` int(11) NOT NULL,
  `Profile_ID` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `Profile_ID` (`Profile_ID`),
  ADD KEY `Post_ID` (`Post_ID`);

--
-- Indexes for table `entertainment`
--
ALTER TABLE `entertainment`
  ADD PRIMARY KEY (`Page_ID`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`Page_ID`,`Profile_ID`),
  ADD KEY `Profile_ID` (`Profile_ID`);

--
-- Indexes for table `informative`
--
ALTER TABLE `informative`
  ADD PRIMARY KEY (`Page_ID`);

--
-- Indexes for table `manages`
--
ALTER TABLE `manages`
  ADD PRIMARY KEY (`Page_ID`,`Profile_ID`),
  ADD KEY `Profile_ID` (`Profile_ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Message_ID`),
  ADD KEY `Sender_ID` (`Sender_ID`),
  ADD KEY `Receiver_ID` (`Receiver_ID`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`Page_ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Post_ID`),
  ADD KEY `Page_ID` (`Page_ID`),
  ADD KEY `Profile_ID` (`Profile_ID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`Profile_ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`Profile_ID`,`Post_ID`),
  ADD KEY `Post_ID` (`Post_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`Post_ID`) REFERENCES `post` (`Post_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `entertainment`
--
ALTER TABLE `entertainment`
  ADD CONSTRAINT `entertainment_ibfk_1` FOREIGN KEY (`Page_ID`) REFERENCES `page` (`Page_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`Page_ID`) REFERENCES `page` (`Page_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `informative`
--
ALTER TABLE `informative`
  ADD CONSTRAINT `informative_ibfk_1` FOREIGN KEY (`Page_ID`) REFERENCES `page` (`Page_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manages`
--
ALTER TABLE `manages`
  ADD CONSTRAINT `manages_ibfk_1` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manages_ibfk_2` FOREIGN KEY (`Page_ID`) REFERENCES `page` (`Page_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`Sender_ID`) REFERENCES `profile` (`Profile_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`Receiver_ID`) REFERENCES `profile` (`Profile_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`Page_ID`) REFERENCES `page` (`Page_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reaction`
--
ALTER TABLE `reaction`
  ADD CONSTRAINT `reaction_ibfk_1` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reaction_ibfk_2` FOREIGN KEY (`Post_ID`) REFERENCES `post` (`Post_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
