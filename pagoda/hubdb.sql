-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2012 at 09:04 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `youtube`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE IF NOT EXISTS `actor` (
  `Actor_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Actor_Name` varchar(100) DEFAULT NULL,
  `Actor_DOB` datetime DEFAULT NULL,
  `Actor_Death_Date` datetime DEFAULT NULL,
  `Actor_Avatar` varchar(500) DEFAULT NULL,
  `Actor_Description` text,
  `Gender` varchar(1) DEFAULT NULL,
  `Actor_Birth_Place` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Actor_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`Actor_Id`, `Actor_Name`, `Actor_DOB`, `Actor_Death_Date`, `Actor_Avatar`, `Actor_Description`, `Gender`, `Actor_Birth_Place`) VALUES
(7, 'Jean Smart', '0000-00-00 00:00:00', NULL, 'ec5bf2e2146e11818781ef3a59fbf975.jpg', NULL, '0', 'Seattle, Washington, USA'),
(8, 'salman', '2012-09-24 00:00:00', NULL, 'cf4e2803d0c560ed821c4312ee5823cf.jpg', NULL, '1', 'mumbai'),
(9, 'Ben Savage ', '1980-09-13 00:00:00', NULL, '3a11f5978b6382b207e3b67a9d1507fb.jpg', NULL, '1', ' Chicago, Illinois, USA'),
(10, 'Amitabh Bachchan ', '1942-10-11 00:00:00', NULL, '562cc2d33a90a906fae207c154deec2d.jpg', NULL, '1', ' Allahabad, Uttar Pradesh, India'),
(11, 'Aamir Khan ', '1965-05-04 00:00:00', '1970-01-01 00:00:00', '47c90b6a2b836eb7e3d38b079d3333a8.jpg', NULL, '1', ' Mumbai, India'),
(12, 'Abhishek Bachchan', '1976-02-05 00:00:00', '1970-01-01 00:00:00', '81321d17b31222a9f6dec0e2f82eac2e.jpg', NULL, '1', ' Bombay, Maharashtra, India'),
(13, 'Vidya Balan ', '1978-01-01 00:00:00', NULL, '44bf6b145555c0aa9423cc2b2b72c1f1.jpg', NULL, '0', ' Palakkad, Kerala, India'),
(14, 'Sonakshi Sinha ', '1987-05-02 00:00:00', '1970-01-01 00:00:00', 'ac1a210efdc6909c5a35586821774d80.jpg', NULL, '0', 'Bombay, Maharashtra, India'),
(15, 'Vinod Khanna ', '1946-10-06 00:00:00', '2012-10-06 00:00:00', '4685154d27bd8e01977411739fd60a15.jpg', NULL, '1', 'Peshawar, British India (now Pakistan)'),
(16, 'Dimple Kapadia ', '1975-06-08 00:00:00', NULL, 'fa905f22f82500f49e3ee0c7625e0569.jpg', NULL, '0', 'Gujarat'),
(17, 'Arbaaz Khan', '1967-08-04 00:00:00', NULL, '32a6bc13fa044abe900a8f76f14418d6.jpg', NULL, '1', 'Bombay, Maharashtra, India'),
(18, 'Sonu Sood ', '1974-07-30 00:00:00', NULL, '307032c7442f06a4898af6c71713f1cb.jpg', NULL, '1', 'Moga,Punjab '),
(20, 'Mahie Gill', '1975-12-19 00:00:00', '1970-01-01 00:00:00', '98a9e09a309cd4364f63694e4db2d972.jpg', NULL, '0', 'Chandigarh, Punjab'),
(21, 'Kareena Kapoor', '1980-09-21 00:00:00', '1970-01-01 00:00:00', '10a6768125996c1ce0e878232b3895ef.jpg', NULL, '0', 'Mumbai, Maharahstra, India'),
(22, 'Boman Irani ', '1959-12-02 00:00:00', NULL, '3feeed5aa6e90a00c81eeb2be0f73a35.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(23, 'Madhavan', '1970-06-01 00:00:00', NULL, 'f0c0b0f65d2a3bd1b79538bd21f0c2a0.jpg', NULL, '1', 'Jamshedpur, Jharkhand, India'),
(24, 'Sharman Joshi ', '1979-03-17 00:00:00', '1970-01-01 00:00:00', '54931adab520d8d0795bb2e51b06d2d9.jpg', NULL, '1', ''),
(25, 'Ranbir Kapoor ', '1982-09-28 00:00:00', '1970-01-01 00:00:00', '3697b33a84c2d39cb1b28717fb5aed81.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(26, 'Bipasha Basu 	', '1979-01-07 00:00:00', '1970-01-01 00:00:00', '3a1690481db2c70dda6daef18878009a.jpg', NULL, '1', 'delhi'),
(27, 'Minissha Lamba ', '1985-01-18 00:00:00', '1970-01-01 00:00:00', '8037d436af3ccb6e0c8152b57277ab7f.jpg', NULL, '0', 'delhi'),
(28, 'Deepika Padukone ', '1986-01-05 00:00:00', '1970-01-01 00:00:00', '4bfcc255dacb92b4e15850550d5298f7.jpg', NULL, '0', 'Copenhagen, Denmark'),
(29, 'Shah Rukh Khan ', '1965-11-02 00:00:00', NULL, '345e9ef4a7057c6b41e810969dd5560d.jpg', NULL, '1', 'delhi,india'),
(30, 'Hrithik Roshan ', '1974-01-10 00:00:00', NULL, '1fe90cc3bc1755b44e8b881a8d6c19b1.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(31, 'Lara Dutta ', '1978-04-16 00:00:00', '1970-01-01 00:00:00', '053935d706aa74390c7318035e1f2077.jpg', NULL, '0', ' Ghaziabad, Uttar Pradesh, India'),
(32, 'Priyanka Chopra ', '1982-07-18 00:00:00', '1970-01-01 00:00:00', 'f543db4d5da82ae0e9214b2bb4cd2926.jpg', NULL, '0', 'Jamshedpur, Bihar, India'),
(33, 'Katrina Kaif ', '1984-07-16 00:00:00', '1970-01-01 00:00:00', 'f2ea4309c4fbf46725aea6079033a81c.jpg', NULL, '0', 'hongkong'),
(34, 'Naseeruddin Shah ', '1950-07-20 00:00:00', NULL, 'd275e9a33b64d4f736c5822e35889abc.jpg', NULL, '1', 'Barabanki, Uttar Pradesh, India'),
(35, 'Abhay Deol ', '1976-03-15 00:00:00', NULL, 'c49de5c257435360b33a534b04651386.jpg', NULL, '1', ' Chandigarh, Punjab, India'),
(36, 'Farhan Akhtar ', '1974-01-09 00:00:00', NULL, '73df9a26f449bec28727395f9b0ab5f1.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(37, 'Kalki Koechlin', '1983-01-09 00:00:00', NULL, 'd244c9189541c18ebbc4c874da90236c.jpg', NULL, '0', 'Pondicherry, India'),
(38, 'Ajay Devgn ', '1969-04-02 00:00:00', NULL, '21c04403378a560f85bd20366bb575eb.jpg', NULL, '1', 'delhi,india'),
(39, 'Sushant Singh ', '1971-10-17 00:00:00', NULL, '32c969e479e0e442c554f5abbe88a9cb.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(40, 'Raj Babbar ', '1952-06-23 00:00:00', NULL, '0ee4351dedf70a41fef9a082ff6a2b13.jpg', NULL, '1', 'Agra, Uttar Pradesh, India'),
(41, 'Amrita Rao ', '1981-06-07 00:00:00', NULL, 'db3fc6d199ae0992cce538362ca94d13.jpg', NULL, '0', 'Mumbai, Maharahstra, India'),
(42, 'Farida Jalal ', '1949-03-14 00:00:00', NULL, 'db24cef7a2dfbd29094f9762dcd361db.jpg', NULL, '0', 'delhi'),
(43, 'Saif Ali Khan ', '1970-08-16 00:00:00', NULL, '4f857f457bac807184a6f2561f86f6c1.jpg', NULL, '1', 'delhi'),
(44, 'Karisma Kapoor ', '1974-06-25 00:00:00', NULL, '6afd843691675d459dc71a1f0ffdd608.jpg', NULL, '0', 'Mumbai, Maharahstra, India'),
(45, 'Tabu', '1970-11-04 00:00:00', '1970-01-01 00:00:00', '5b14cf876a1fb68e21a283cc001d07d5.jpg', NULL, '0', 'Hyderabad, India'),
(46, 'Sonali Bendre ', '1975-01-01 00:00:00', NULL, 'fc4bb48679d735edf25bee56f9343d2b.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(47, 'Mohnish Bahl ', '1963-02-14 00:00:00', NULL, '76dfdc5b32351f1229a5d33d0e250dc6.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(48, 'Ileana ', '1987-11-01 00:00:00', NULL, '5ec5dc432a3a8791e94586ee086b22a6.jpg', NULL, '0', 'Mumbai, Maharahstra, India'),
(49, 'Vidya Malvade ', '1972-03-02 00:00:00', NULL, '5eede4b1b9391e28e980d5566d2fcbc6.jpg', NULL, '0', 'Mumbai, Maharahstra, India'),
(50, 'Rakhee Gulzar', '1947-08-15 00:00:00', NULL, '42365e5455832f08d6f7ddf10fd3a959.jpg', NULL, '0', 'Ranaghat, West Bengal, India'),
(51, 'Sunny Deol', '1956-10-19 00:00:00', NULL, 'db5173f76834cb777011cccb11f8ca5d.jpg', NULL, '1', 'delhi'),
(52, 'Jackie Shroff ', '1957-02-01 00:00:00', NULL, '92861c6216f862f8b2c27e56d49db9a9.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(53, 'Sunil Shetty', '1961-08-11 00:00:00', NULL, '006470ba137d7f112a09ac12b924f802.jpg', NULL, '1', 'Bangalore, Karnataka, India'),
(54, 'Akshaye Khanna ', '1997-03-28 00:00:00', NULL, '9e567893647d7619d25ea5234f4c5b9b.jpg', NULL, '1', 'Bombay, Maharashtra, India'),
(55, 'Pooja Bhatt', '1972-02-24 00:00:00', NULL, 'd9ec5cf95cb3d06fe7b4b3b6bb1b85f1.jpg', NULL, '0', 'Mumbai, Maharahstra, India'),
(56, 'Emraan Hashmi ', '1979-03-24 00:00:00', NULL, '94acbb2b781cf1a6034b8740be0b4d1d.jpg', NULL, '1', 'Bombay, Maharashtra, India'),
(57, 'Kangana Ranaut ', '1987-03-20 00:00:00', NULL, '3e297b2000cde0f1d3ff07b7847cefa2.jpg', NULL, '0', 'Bhambla, Himachal Pradesh, India'),
(58, 'Adhyayan Suman ', '1988-01-13 00:00:00', NULL, '75d63d69f612f157e2d4b05141407f65.jpg', NULL, '1', 'Bombay, Maharashtra, India'),
(59, 'Esha Gupta ', '1988-11-28 00:00:00', NULL, '665314889f54ffb3028a192603c41eae.jpg', NULL, '0', 'delhi'),
(60, 'Randeep Hooda ', '1976-08-20 00:00:00', NULL, '5a3fe9b0acff7d85d7f9ef29decf5026.jpg', NULL, '1', 'Rohtak'),
(61, 'Himesh Reshammiya', '1973-07-23 00:00:00', '1970-01-01 00:00:00', '3c42d10d9e9203e26e7703ac9432ce68.jpg', NULL, '1', 'Bhavnagar,Gujarat'),
(62, 'Sonal Sehgal', '1981-07-13 00:00:00', NULL, '566eb2caae3ed3b70a93241f3625d837.jpg', NULL, '0', 'Chandigarh, Punjab'),
(63, 'Shenaz Treasurywala', '1981-06-29 00:00:00', NULL, '30da320a3ba50517cc368a1a20763337.jpg', NULL, '0', 'Mumbai, Maharahstra, India'),
(64, 'Akshaye Kumar', '1967-09-09 00:00:00', NULL, '9d60ac016d1da93ad64645643721aea6.jpg', NULL, '1', 'Amritsar, Punjab, India'),
(65, 'Rajpal Yadav ', '1971-03-16 00:00:00', NULL, 'cbf5cc62a09eab1594cd7bd56ae21933.jpg', NULL, '1', 'Shahjahanpur'),
(66, 'Paresh Rawal', '1950-03-30 00:00:00', NULL, 'bd4969e0f72b9b3568dcdd72febd8797.jpg', NULL, '1', 'Ahmedabad'),
(67, 'Mithun Chakraborty', '1950-06-16 00:00:00', NULL, 'ddef718c167c57ce95736ab5e9381ab3.jpg', NULL, '1', 'Kolkata'),
(68, 'Mahesh Manjrekar ', '1958-08-16 00:00:00', NULL, '32b0099116d103471ced9e63cca9c4a2.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(69, 'Arjun Rampal ', '1972-11-26 00:00:00', NULL, '6c146ea7fdbff658501d1d3c89918633.jpg', NULL, '1', ' Jabalpur, Madhya Pradesh, '),
(70, 'Sanjay Dutt ', '1959-07-29 00:00:00', NULL, 'b647f7dbd0c6c5beee3d34c1268fd410.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(71, 'Arjan Bajwa ', '1977-09-03 00:00:00', NULL, '07fea8292c9c1e08211b2421477afc9c.jpg', NULL, '1', 'delhi,india'),
(72, 'Mallika Sherawat ', '1974-10-24 00:00:00', NULL, '512abf237e627b45670c108c764ef242.jpg', NULL, '0', 'Rohtak'),
(73, 'Vivek Oberoi ', '1976-09-03 00:00:00', NULL, 'a070cb6faf88dadce033e7b7b06c0ba5.jpg', NULL, '1', 'Hyderabad, Andhra Pradesh, India'),
(74, 'Ashutosh Rana ', '1964-11-10 00:00:00', NULL, '8d10bb2a4bb84ef493617aea49e7c079.jpg', NULL, '1', 'Mumbai, Maharahstra, India'),
(75, 'te', '2012-09-19 00:00:00', NULL, '6ddeb2db6591f387061c7be7d9b57978.jpg', NULL, '1', 'ftyg');

-- --------------------------------------------------------

--
-- Table structure for table `choreographer`
--

CREATE TABLE IF NOT EXISTS `choreographer` (
  `Choreographer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Choreographer_Name` varchar(100) DEFAULT NULL,
  `Choreographer_Avatar` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Choreographer_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `choreographer`
--

INSERT INTO `choreographer` (`Choreographer_Id`, `Choreographer_Name`, `Choreographer_Avatar`) VALUES
(3, 'Rajeev Soorti', '835647c18a8a49310e2f9525fa4c9f3e.jpg'),
(4, 'Remo', '510a9cf403618a2145c0135afc4dce26.jpg'),
(5, 'Avit Dias ', 'c8b08aef46c30bee2319ccc5d9df9361.jpg'),
(6, ' Ahmed Khan ', '7f0812f6e3b302dc17ff9b4696175aba.jpg'),
(7, 'Vaibhavi Merchant', 'fce2d0e4c78f84b02b3d352fcf6ddc00.jpg'),
(8, 'Bosco', '90353ce21e0dc2a9d9f5d7cf13b179e5.jpg'),
(9, 'Ganesh Acharya ', '21e0ff6cacae3fbe0464d6120c15a8b1.jpg'),
(10, 'Jay Borade', '0ac293da9fc6576eaef9784180e3a2e3.jpg'),
(11, 'farah khan', '579efd4b9b2c8198748e35d02eef4a45.jpg'),
(12, 'Javed Eijaz', 'default_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `critic_review`
--

CREATE TABLE IF NOT EXISTS `critic_review` (
  `Creview_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(11) NOT NULL,
  `Creview_Title` varchar(255) NOT NULL,
  `Creview_Desc` text NOT NULL,
  `Creview_Time` date NOT NULL,
  PRIMARY KEY (`Creview_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `critic_review`
--

INSERT INTO `critic_review` (`Creview_Id`, `Movie_Id`, `Creview_Title`, `Creview_Desc`, `Creview_Time`) VALUES
(1, 4, 'Title 4', 'Description 4 Description 4 Description 4 Description 4 Description 4 Description 4\r\nDescription 4 Description 4 Description 4\r\nDescription 4 Description 4 Description 4 Description 4 Description 4 Description 4\r\nDescription 4 Description 4 Description 4\r\nDescription 4 Description 4 Description 4 Description 4 Description 4 Description 4\r\nDescription 4 Description 4 Description 4\r\nDescription 4 Description 4 Description 4 Description 4 Description 4 Description 4\r\nDescription 4 Description 4 Description 4', '2012-10-09'),
(2, 6, 'bachna ae haseen', 'jodar movie 6e bhai log', '0000-00-00'),
(3, 9, 'jakaash', 'very very nice movie for adventure..\r\nvery very nice movie for adventure..\r\nvery very nice movie for adventure..\r\nvery very nice movie for adventure..\r\nvery very nice movie for adventure..\r\nvery very nice movie for adventure..', '2012-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE IF NOT EXISTS `director` (
  `Director_id` int(11) NOT NULL AUTO_INCREMENT,
  `Director_Name` varchar(100) DEFAULT NULL,
  `Director_DOB` datetime DEFAULT NULL,
  `Director_Death_Date` datetime DEFAULT NULL,
  `Director_Avatar` varchar(500) DEFAULT NULL,
  `Director_Description` text,
  PRIMARY KEY (`Director_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`Director_id`, `Director_Name`, `Director_DOB`, `Director_Death_Date`, `Director_Avatar`, `Director_Description`) VALUES
(6, 'Abhinav Kashyap', '1974-09-06 00:00:00', NULL, '4763bc8b4b9830b102e848f923695d71.jpg', NULL),
(8, 'Rajkumar Hirani', '0000-00-00 00:00:00', NULL, 'f5e4cf61fac50d97d48f96d82805ad93.jpg', NULL),
(9, 'R.Balki', NULL, NULL, '596ae3e4ddd752dc7bc4e7648125cd0e.jpg', NULL),
(10, 'Siddharth Anand ', NULL, NULL, '40c99a45cc2b516aae50a60585acbc9d.jpg', NULL),
(11, 'Farhan Akhtar', '1974-01-09 00:00:00', NULL, 'b13a913b2a8752341a3f8636d376486e.jpg', NULL),
(12, 'Sujoy Ghosh	 	', NULL, NULL, '51fc95965e6de9352c1e4f38c1cbbf27.jpg', NULL),
(13, 'Zoya Akhtar ', '1974-01-09 00:00:00', NULL, 'b62242c555a47c8845d58171a17a3689.jpg', NULL),
(14, 'Rajkumar Santoshi ', NULL, NULL, '801c5726ff4a690e475211b67ea20a5b.jpg', NULL),
(15, 'Sooraj R. Barjatya ', '1965-05-22 00:00:00', NULL, '844d4df15b24a45c948b5d40b1c9deb2.jpg', NULL),
(16, 'Anurag Basu ', NULL, NULL, '983a0a611947ba158d06625828a873f5.jpg', NULL),
(17, 'Shimit Amin ', NULL, NULL, 'bc553d53f38de7e4053b82f6ae5dcb49.jpg', NULL),
(18, 'J.P. Dutta ', '1949-10-03 00:00:00', NULL, '3038d6d150cc7754e94baee4d767ce15.jpg', NULL),
(19, 'Mohit Suri ', '1981-04-11 00:00:00', NULL, '97f6fa21d8b31468d7b48d0c8ef98d83.jpg', NULL),
(20, 'Kunal Deshmukh ', '1982-03-04 00:00:00', NULL, 'b52708255371d7e788e19c072635c1ea.jpg', NULL),
(21, 'Ishan Trivedi', NULL, NULL, 'default_image.jpg', NULL),
(22, 'Kompin Kemgumnird ', NULL, NULL, '0d718679a7828a14441abc9d9e788210.jpg', NULL),
(23, 'Umesh Shukla ', NULL, NULL, '44841834d07242f102ce540d82abcf84.jpg', NULL),
(24, 'Madhur Bhandarkar ', '1966-08-26 00:00:00', NULL, 'cc6eedcec580458345ef190b62fe095f.jpg', NULL),
(25, 'Ashwani Dhir ', NULL, NULL, 'c6aab506e3699a46c510c7678b70c1dd.jpg', NULL),
(26, 'Sanjay M. Khanduri ', '1979-06-13 00:00:00', NULL, '68607f93a065f27daf5126a2b7fd2654.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `lyrics`
--

CREATE TABLE IF NOT EXISTS `lyrics` (
  `Lyrics_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Lyrics_Name` varchar(100) DEFAULT NULL,
  `Lyrics_Avatar` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Lyrics_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `lyrics`
--

INSERT INTO `lyrics` (`Lyrics_Id`, `Lyrics_Name`, `Lyrics_Avatar`) VALUES
(8, 'Lalit Pandit', '4554c3c789f36137de1f9043b10d1a9e.jpg'),
(9, 'Anvita Dutt Guptan ', 'e9efee303885e62927fdda56e2797f6a.jpg'),
(10, 'Swanand Kirkire', 'ed90922017e43c4a07ad482364481da6.jpg'),
(11, 'Faaiz Anwar', '4d9859e74bdfcaa335a8a5b5d0652b99.jpg'),
(12, 'Jalees Sherwani	 ', '946e3feb731556bc9a1c41b1a5e2dede.jpg'),
(13, 'Javed Akhtar', '5d2ae28a915ae6f26d7d26ecdbf0d25a.jpg'),
(14, 'Vishal Dadlani ', '57ac151df0b199903ed8f709035d9f33.jpg'),
(15, 'A.R. Rahman	 	', 'e5fb0ee600c6034e7e23d50e8c5ce522.jpg'),
(16, 'Sooraj R. Barjatya ', 'c5d1552e088e5186b9e09757155825b4.jpg'),
(17, 'pritam', '81c919a442e2924bbba0cf66e6051e3d.jpg'),
(18, 'Jaideep Sahni', '8b15af9b7cc0110cc9b426dec3fd6b7e.jpg'),
(19, 'Kumaar ', '66c01dd79205dddd7231e2cd4d0f95da.jpg'),
(20, 'Sayeed Qadri ', 'f5dca7f8a331e98969883017509fb77e.jpg'),
(21, 'Himesh Reshammiya', '5b5400c6ebd6a3e987f8286d41c43ca4.jpg'),
(22, 'Ram Sampath ', '2eb843e02fd5741984931a98ad36f58f.jpg'),
(23, 'Salim Suleiman  ', '5c1fe916ef7795222fa9daf56bd48ed8.jpg'),
(24, 'sajid wajid', 'f3a00841e7604ab22195b646f5f9ac73.jpg'),
(25, 'Amjad Nadeem ', 'default_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE IF NOT EXISTS `meta` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `user_id`, `first_name`, `last_name`, `company`, `phone`) VALUES
(27, 24, 'etygd', 'cdfgd', NULL, '4564564646'),
(28, 25, 'jay', 'kareliya', NULL, '123456789'),
(29, 26, 'hardik', 'dave', NULL, '123456789'),
(30, 27, 'jay', 'kareliya', NULL, '123456'),
(31, 28, 'jay', 'kareliya', NULL, '4254325'),
(32, 29, 'kk', 'vora', NULL, '4578698788'),
(33, 30, 'hh', 'karelia', NULL, '4127543653'),
(34, 31, 'jay', 'kareliya', NULL, '4254325'),
(35, 32, 'hardik', 'dsfsdf', NULL, '4254325'),
(36, 33, 'jay', 'xdgdsfg', NULL, '4254325'),
(37, 34, 'hardik', 'karelia', NULL, '425432'),
(38, 35, 'hh', 'jj', NULL, '536789'),
(39, 36, 'vishal', 'tarkar', NULL, '8460799101'),
(40, 37, 'vishal', 'tarkar', NULL, '8460799101'),
(41, 38, 'vishal', 'tarkar', NULL, '8460799101'),
(42, 39, 'vishal', 'tarkar', NULL, '8460799101'),
(43, 40, 'vishal', 'tarkar', NULL, '4254325'),
(44, 41, NULL, NULL, NULL, NULL),
(45, 42, NULL, NULL, NULL, NULL),
(46, 43, NULL, NULL, NULL, NULL),
(47, 44, NULL, NULL, NULL, NULL),
(48, 45, NULL, NULL, NULL, NULL),
(49, 46, NULL, NULL, NULL, NULL),
(50, 47, NULL, NULL, NULL, NULL),
(51, 48, 'vishal', 'xdgdsfg', NULL, NULL),
(52, 49, NULL, NULL, NULL, NULL),
(53, 50, NULL, NULL, NULL, NULL),
(54, 51, NULL, NULL, NULL, NULL),
(55, 52, NULL, NULL, NULL, NULL),
(56, 53, NULL, NULL, NULL, NULL),
(57, 54, NULL, NULL, NULL, NULL),
(58, 55, NULL, NULL, NULL, NULL),
(59, 56, NULL, NULL, NULL, NULL),
(60, 57, NULL, NULL, NULL, NULL),
(61, 58, NULL, NULL, NULL, NULL),
(62, 59, NULL, NULL, NULL, NULL),
(63, 60, NULL, NULL, NULL, NULL),
(64, 61, NULL, NULL, NULL, NULL),
(65, 62, NULL, NULL, NULL, NULL),
(66, 63, NULL, NULL, NULL, NULL),
(67, 64, NULL, NULL, NULL, NULL),
(68, 65, NULL, NULL, NULL, NULL),
(69, 66, NULL, NULL, NULL, NULL),
(70, 67, NULL, NULL, NULL, NULL),
(71, 68, NULL, NULL, NULL, NULL),
(72, 69, NULL, NULL, NULL, NULL),
(73, 70, NULL, NULL, NULL, NULL),
(74, 71, NULL, NULL, NULL, NULL),
(75, 72, NULL, NULL, NULL, NULL),
(76, 73, NULL, NULL, NULL, NULL),
(77, 74, NULL, NULL, NULL, NULL),
(78, 75, NULL, NULL, NULL, NULL),
(79, 76, NULL, NULL, NULL, NULL),
(80, 77, NULL, NULL, NULL, NULL),
(81, 78, NULL, NULL, NULL, NULL),
(82, 79, NULL, NULL, NULL, NULL),
(83, 80, NULL, NULL, NULL, NULL),
(84, 81, NULL, NULL, NULL, NULL),
(85, 82, NULL, NULL, NULL, NULL),
(86, 83, NULL, NULL, NULL, NULL),
(87, 84, NULL, NULL, NULL, NULL),
(88, 85, NULL, NULL, NULL, NULL),
(89, 86, 'faf', 'asdfsdf', NULL, '9199898935'),
(90, 87, NULL, NULL, NULL, NULL),
(91, 88, NULL, NULL, NULL, NULL),
(92, 89, NULL, NULL, NULL, NULL),
(93, 90, NULL, NULL, NULL, NULL),
(94, 91, NULL, NULL, NULL, NULL),
(95, 92, NULL, NULL, NULL, 'fff'),
(96, 93, NULL, NULL, NULL, NULL),
(97, 94, NULL, NULL, NULL, NULL),
(98, 95, NULL, NULL, NULL, NULL),
(99, 96, NULL, NULL, NULL, NULL),
(100, 97, NULL, NULL, NULL, NULL),
(101, 98, NULL, NULL, NULL, NULL),
(102, 99, NULL, NULL, NULL, NULL),
(103, 100, 'vishal', 'tarkar', NULL, '9737696969'),
(104, 101, 'adi', 'xyz', NULL, '4554575854'),
(105, 102, 'vishal', 'tarkar', NULL, '9898246666'),
(106, 103, 'vishal', 'tarkar', NULL, '9737696969'),
(107, 104, 'jay', 'kareliya', NULL, '536789');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `Movie_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Name` varchar(100) DEFAULT NULL,
  `Movie_Release_Date` timestamp NULL DEFAULT NULL,
  `Movie_Type` int(11) DEFAULT NULL,
  `Movie_Rating` float NOT NULL DEFAULT '0',
  `Movie_Url` varchar(3000) DEFAULT NULL,
  `Movie_Image` varchar(500) DEFAULT NULL,
  `Movie_Description` text,
  `Movie_Duration` varchar(50) DEFAULT NULL,
  `Movie_In_Theater` int(1) DEFAULT NULL,
  PRIMARY KEY (`Movie_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`Movie_Id`, `Movie_Name`, `Movie_Release_Date`, `Movie_Type`, `Movie_Rating`, `Movie_Url`, `Movie_Image`, `Movie_Description`, `Movie_Duration`, `Movie_In_Theater`) VALUES
(2, 'dabangg', '2010-09-12 18:30:00', 3, 0, 'http://youtu.be/3-nkGYGX_tY', '983e3c526f98cc80d5d6af6008a2fdbe.jpg', 'Set in Uttar Pradesh, Chulbul Pandey is a young boy who lives with his mother Naini, stepfather Praj', '2 min & 3 sec.', 1),
(4, '3-idiots', '2009-12-24 18:30:00', 4, 0, 'http://youtu.be/2lK31lpyrkU', '3285310cd69e9228bba22240c7d1caeb.jpg', '3-idiots', '2 min & 45 sec.', 1),
(5, 'Paa ', '0000-00-00 00:00:00', 4, 5, 'http://youtu.be/LVJAip8ybRU', 'e6e073fd8421eefe562199489ea5e6e9.jpg', '', '30sec', 1),
(6, 'Bachna Ae Haseeno', '2008-08-14 18:30:00', 5, 0, 'http://youtu.be/GKyMgyNsRKI', '0598a251a2890dee40c25c430955750f.jpg', 'During 1996 Raj Sharma, while in Switzerland, meets with Amritsar-based Mahi Pasricha, successfully ', '2 min & 45 sec.', 1),
(7, 'Don 2', '2011-12-22 18:30:00', 10, 0, 'http://youtu.be/1at8wo8TnEM', 'fd6be28ce12ea5259d8eadb34500d9a7.jpg', 'DoN-2', '2 min & 45 sec.', 1),
(8, 'Kahaani', '2012-03-08 18:30:00', 14, 0, 'http://youtu.be/agaBErK_ncI', 'e174074c7dab4cc757bbcbf6aa9d65c6.jpg', '', '2 min & 45 sec.', 0),
(9, 'Zindagi Na Milegi Dobara', '2011-07-14 18:30:00', 18, 3.66667, 'http://youtu.be/JAfXjINRYO4', 'c2fecf1ff5f7865b4040ace8d9ede73b.jpg', 'Mumbai-based Kabir Dhiman, who comes from a wealthy building construction family, proposes to his lo', '4 min & 45 sec.', 1),
(11, 'The Legend of Bhagat Singh', '2002-06-06 18:30:00', 12, 6, 'http://youtu.be/uZyVxfypnV0', 'dc6c9b7e76f8391b753348d9e9c80c99.jpg', '', '4 min & 45 sec.', 0),
(12, 'Hum Saath-Saath Hain', '1999-11-04 18:30:00', 6, 0, 'http://youtu.be/RpCFCkw1mO0', '37faf71e9a40cd48916507e5ee937575.jpg', 'The trials and challenges of a joint family in India, whose parents are Ramkishen and second wife Ma', '4 min & 35 sec.', 0),
(13, 'Barfi', '2012-09-13 18:30:00', 16, 0, 'http://youtu.be/wqQ6BF50AT4', '081aff46494bb2160da7eda31d05743a.jpg', '', '4 min & 45 sec.', 1),
(14, 'Chak De India', '2007-08-09 18:30:00', 9, 0, 'http://youtu.be/NpfHXCSY92Y', '6acd46d8f702bf8053959a17bc7d067d.jpg', 'Kabir Khan lives a middle-class lifestyle along with his widowed mom in Delhi, India, and is the Cap', '2 min & 3 sec.', 0),
(15, 'Border ', '1997-10-09 18:30:00', 17, 5, 'http://youtu.be/pjxhnco4J5A', '595cdf6f08f5410544229d9d731d6b72.jpg', 'The year is 1971 when the Pakistani Army is at war with the Indian Soldiers. The Indian battalion is', '4 min & 35 sec.', 0),
(16, 'Raaz Mystery Continues', '2009-01-22 18:30:00', 8, 0, 'http://youtu.be/cZWq4zFfL9I', '0ecd75945f764cbd96271f30f01a1a46.jpg', '', '4 min & 35 sec.', 0),
(17, 'Jannat 2', '2012-05-03 18:30:00', 7, 0, 'http://youtu.be/Xd95bTbUMJk', 'cb23f16e459f91a60537d40f04cf9fba.jpg', 'Jannat 2 revolves around a smuggler Sonu Delhi KKC who deals in illegal guns. ACP Pratap Raghuvanshi', '2 min & 45 sec.', 1),
(18, 'Radio', '2009-12-02 18:30:00', 13, 0, 'http://youtu.be/6EW-FEOn4wA', '55c2094214a159f5ccd3e431759fc640.jpg', 'Radio is a 2009 Hindi language Bollywood film starring Himesh Reshammiya, Shenaz Treasurywala and So', '2 min & 45 sec.', 0),
(19, 'Jumbo', '2008-12-24 18:30:00', 11, 0, 'http://youtu.be/l_1YZp_OXq0', '55497e5ab1c6301b6bc2e5680ade8ac5.jpg', 'Jumbo, a young elephant, embarks on a journey to find his father. ', '5 minutes', 0),
(20, 'OMG Oh My God!', '2012-09-27 18:30:00', 4, 0, 'http://youtu.be/eSfJ9NTE0OE', 'b72c81952d94f5a1a76168cbe4a94ef7.jpg', 'An antique shopkeeper takes god to court when his shop is destroyed by a tornado. ', '2 min & 3 sec.', 1),
(21, 'Heroine', '2012-09-20 18:30:00', 14, 6, 'http://youtu.be/C-KMqIThhLg', 'c380f7c213168cc47b21df788004ac37.jpg', '', '3 min & 15 sec.', 0),
(22, 'Son of Sardaar', '2012-11-11 18:30:00', 5, 0, 'http://youtu.be/LOlcpr7qEv4', '36e4b0f6b199131c1b6fa37987ef855c.jpg', 'Returning to his parents'' village, a man becomes the latest target in a long-standing family feud. ', '2 min & 3 sec.', 0),
(23, 'Kismet Love Paisa Dilli', '2012-10-04 18:30:00', 4, 2, 'http://youtu.be/2g1ruP77al4', 'f171af4d16e6ef6a65cd6f17fd71d20a.jpg', 'Kismet Love Paisa Dilli', '2 min & 3 sec.', 0),
(24, 'ek tha tiger', '2012-08-14 18:30:00', 3, 0, 'http://youtu.be/bVC2Tn3GbvE', 'b514b1717afaf39972f2d9409a4e72a4.jpg', '', '2 min & 45 sec.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie_actor`
--

CREATE TABLE IF NOT EXISTS `movie_actor` (
  `Movie_Actor_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(11) DEFAULT NULL,
  `Actor_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Movie_Actor_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `movie_actor`
--

INSERT INTO `movie_actor` (`Movie_Actor_Id`, `Movie_Id`, `Actor_Id`) VALUES
(11, 2, 8),
(12, 3, 10),
(13, 5, 10),
(14, 5, 12),
(15, 5, 13),
(16, 2, 14),
(17, 4, 11),
(18, 2, 15),
(19, 2, 16),
(20, 2, 17),
(21, 2, 18),
(22, 2, 20),
(23, 4, 21),
(24, 4, 22),
(25, 4, 23),
(26, 4, 24),
(27, 6, 25),
(28, 6, 26),
(29, 6, 27),
(30, 6, 28),
(31, 7, 29),
(32, 7, 31),
(33, 7, 32),
(34, 7, 22),
(35, 8, 13),
(36, 9, 30),
(37, 9, 33),
(38, 9, 34),
(39, 9, 35),
(40, 9, 36),
(41, 9, 37),
(42, 11, 38),
(43, 11, 39),
(44, 11, 40),
(45, 11, 41),
(46, 11, 42),
(47, 12, 8),
(48, 12, 43),
(49, 12, 44),
(50, 12, 45),
(51, 12, 46),
(52, 12, 47),
(53, 13, 25),
(54, 13, 32),
(55, 13, 48),
(56, 14, 29),
(57, 14, 49),
(58, 15, 45),
(59, 15, 50),
(60, 15, 51),
(61, 15, 52),
(62, 15, 53),
(63, 15, 54),
(64, 15, 55),
(65, 16, 56),
(66, 16, 57),
(67, 16, 58),
(68, 16, 52),
(69, 17, 56),
(70, 17, 59),
(71, 17, 60),
(72, 18, 61),
(73, 18, 62),
(74, 18, 63),
(75, 19, 64),
(76, 19, 31),
(77, 19, 16),
(78, 19, 65),
(79, 20, 64),
(80, 20, 14),
(81, 20, 66),
(82, 20, 67),
(83, 20, 68),
(84, 21, 21),
(85, 21, 60),
(86, 21, 69),
(87, 22, 38),
(88, 22, 70),
(89, 22, 71),
(90, 23, 72),
(91, 23, 73),
(92, 23, 74),
(93, 24, 8);

-- --------------------------------------------------------

--
-- Table structure for table `movie_choreographer`
--

CREATE TABLE IF NOT EXISTS `movie_choreographer` (
  `Movie_Choreographer_Id` int(10) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(10) DEFAULT NULL,
  `Choreographer_Id` int(10) DEFAULT NULL,
  PRIMARY KEY (`Movie_Choreographer_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `movie_choreographer`
--

INSERT INTO `movie_choreographer` (`Movie_Choreographer_Id`, `Movie_Id`, `Choreographer_Id`) VALUES
(2, 2, 3),
(3, 3, 4),
(4, 4, 5),
(5, 6, 6),
(6, 7, 7),
(7, 9, 8),
(8, 11, 9),
(9, 12, 10),
(10, 15, 11),
(11, 17, 0),
(12, 17, 12),
(13, 21, 9),
(14, 22, 9),
(15, 24, 3),
(16, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `movie_comment`
--

CREATE TABLE IF NOT EXISTS `movie_comment` (
  `Movie_Comment_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(11) DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Comment` varchar(1000) DEFAULT NULL,
  `Time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Movie_Comment_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `movie_comment`
--

INSERT INTO `movie_comment` (`Movie_Comment_Id`, `Movie_Id`, `User_Id`, `Comment`, `Time`) VALUES
(1, 5, 33, 'pl[ok', '2012-09-14 13:22:57'),
(2, 14, 33, 'Chak DE .......', '2012-09-17 13:08:12'),
(3, 23, 33, 'hii hello', '2012-09-22 10:25:01'),
(4, 9, 33, 'tytfy', '2012-09-22 11:13:16'),
(5, 9, 33, 'hj', '2012-09-22 11:13:20'),
(6, 9, 33, 'bhfbhjbhj', '2012-09-22 11:13:30'),
(7, 13, 33, 'hjhj', '2012-09-22 11:15:39'),
(26, 0, 33, 'hiii', '2012-09-27 07:32:43'),
(27, 21, 33, 'hhiiii', '2012-09-27 07:38:03'),
(28, 21, 33, 'dfgdfgdf', '2012-09-27 08:03:34'),
(29, 5, 33, 'nice', '2012-10-04 09:05:24'),
(30, 5, 33, 'nice', '2012-10-04 09:05:31'),
(31, 21, 33, 'bakwash..', '2012-10-05 12:02:27'),
(32, 4, 33, 'nice movie', '2012-10-05 12:53:27'),
(33, 23, 100, 'hhhhhh', '2012-10-06 05:55:31'),
(34, 23, 100, 'nice', '2012-10-06 05:56:08'),
(35, 23, 100, 'very nice', '2012-10-06 05:56:21'),
(36, 21, 33, 'jakashh', '2012-10-06 06:58:38'),
(37, 23, 33, 'dfgdf', '2012-10-06 07:53:17'),
(38, 23, 33, 'hi', '2012-10-06 07:53:31'),
(39, 9, 33, 'hiii', '2012-10-22 07:34:01'),
(40, 9, 33, 'very nice', '2012-10-22 07:34:10'),
(41, 11, 33, 'THE LEGAND', '2012-10-25 05:18:40'),
(42, 11, 33, 'legand', '2012-10-25 06:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `movie_director`
--

CREATE TABLE IF NOT EXISTS `movie_director` (
  `Movie_Director_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(11) DEFAULT NULL,
  `Director_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Movie_Director_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `movie_director`
--

INSERT INTO `movie_director` (`Movie_Director_Id`, `Movie_Id`, `Director_Id`) VALUES
(12, 2, 6),
(13, 3, 7),
(14, 4, 8),
(15, 5, 9),
(16, 6, 10),
(17, 7, 11),
(18, 8, 12),
(19, 9, 13),
(20, 11, 14),
(21, 12, 15),
(22, 13, 16),
(23, 14, 17),
(24, 15, 18),
(25, 16, 19),
(26, 17, 20),
(27, 18, 21),
(28, 19, 22),
(29, 20, 23),
(30, 21, 24),
(31, 22, 25),
(32, 22, 26),
(33, 23, 26),
(34, 24, 6);

-- --------------------------------------------------------

--
-- Table structure for table `movie_lyrics`
--

CREATE TABLE IF NOT EXISTS `movie_lyrics` (
  `Movie_Lyrics_Id` int(10) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(10) DEFAULT NULL,
  `Lyrics_Id` int(10) DEFAULT NULL,
  PRIMARY KEY (`Movie_Lyrics_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `movie_lyrics`
--

INSERT INTO `movie_lyrics` (`Movie_Lyrics_Id`, `Movie_Id`, `Lyrics_Id`) VALUES
(8, 2, 8),
(9, 3, 9),
(10, 5, 10),
(11, 2, 11),
(12, 2, 12),
(13, 4, 10),
(14, 6, 9),
(15, 7, 13),
(16, 8, 9),
(17, 8, 14),
(18, 9, 13),
(19, 11, 15),
(20, 12, 16),
(21, 13, 17),
(22, 14, 18),
(23, 15, 13),
(24, 16, 20),
(25, 16, 19),
(26, 17, 17),
(27, 18, 21),
(28, 19, 22),
(29, 20, 21),
(30, 21, 23),
(31, 22, 24),
(32, 22, 21),
(33, 23, 25),
(34, 24, 16);

-- --------------------------------------------------------

--
-- Table structure for table `movie_news`
--

CREATE TABLE IF NOT EXISTS `movie_news` (
  `Movie_News_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_News_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Movie_News_Type` int(10) DEFAULT NULL,
  `Movie_News_Title` varchar(30) DEFAULT NULL,
  `Movie_News_Image` varchar(100) DEFAULT NULL,
  `Movie_News_Description` text,
  PRIMARY KEY (`Movie_News_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `movie_news`
--

INSERT INTO `movie_news` (`Movie_News_Id`, `Movie_News_Date`, `Movie_News_Type`, `Movie_News_Title`, `Movie_News_Image`, `Movie_News_Description`) VALUES
(3, '2012-09-13 13:15:24', 2, 'Dannii Minogue has a great fal', '61975f67f239d601c649a7aa7cbceb73.jpg', 'London, Sep 13: Singer Dannii Minogue tumbled at an event here after she lost balance on some steps. She dazzled in a floor-length gown and sported a stunning hairdo, but the former "X Factor" judge''s humiliating fall at the launch of her Project D fashion range, took a'),
(4, '2012-09-13 14:25:16', 1, 'Farah Khans cameo in Soty', '031a6f2f2b1245a6e6894dcee5b84ae2.jpg', 'Celebrities doing cameos in films that are either directed or produced by their industry friends, is common in Bollywood. Now joining the bandwagon is choreographer turned director turned actress Farah Khan who will be seen doing a cameo in Karan Johar''s Student Of The Year (Soty). Karan and Farah''s friendship dates back several years, and it was for this very reason that the latter agreed to choreograph a couple of songs in Soty. In fact taking it one step ahead, Farah has also done a special appearance in the film. The said scene will feature Farah in her TV show image, as a dance competition judge, in one of the songs. What''s more, the same track will feature Karan''s lucky mascot Kajol as well making her special appearance. Watch Song Promo:');

-- --------------------------------------------------------

--
-- Table structure for table `movie_producer`
--

CREATE TABLE IF NOT EXISTS `movie_producer` (
  `Movie_Producer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(11) DEFAULT NULL,
  `Producer_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Movie_Producer_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `movie_producer`
--

INSERT INTO `movie_producer` (`Movie_Producer_Id`, `Movie_Id`, `Producer_Id`) VALUES
(4, 2, 2),
(7, 5, 5),
(10, 5, 8),
(11, 2, 9),
(12, 2, 10),
(13, 4, 11),
(14, 6, 12),
(15, 6, 13),
(16, 7, 15),
(17, 7, 14),
(18, 8, 16),
(19, 8, 17),
(20, 9, 15),
(21, 9, 18),
(22, 11, 19),
(23, 11, 20),
(24, 12, 21),
(25, 12, 22),
(26, 12, 23),
(27, 13, 24),
(28, 14, 12),
(29, 14, 13),
(30, 15, 25),
(31, 16, 26),
(32, 17, 26),
(33, 17, 27),
(34, 18, 29),
(35, 20, 30),
(36, 20, 31),
(37, 21, 32),
(38, 21, 33),
(39, 22, 34),
(40, 22, 35),
(41, 23, 36),
(42, 23, 37),
(44, 24, 12);

-- --------------------------------------------------------

--
-- Table structure for table `movie_rating`
--

CREATE TABLE IF NOT EXISTS `movie_rating` (
  `Movie_Rating_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) DEFAULT NULL,
  `Rating` float DEFAULT '0',
  `Movie_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Movie_Rating_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `movie_rating`
--

INSERT INTO `movie_rating` (`Movie_Rating_Id`, `User_Id`, `Rating`, `Movie_Id`) VALUES
(9, 40, 2, 9),
(10, 33, 4, 9),
(11, 33, 2, 23),
(12, 33, 6, 11),
(13, 33, 6, 21),
(14, 101, 5, 9),
(15, 102, 5, 15),
(16, 102, 6, 21),
(17, 103, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `movie_review`
--

CREATE TABLE IF NOT EXISTS `movie_review` (
  `Movie_Review_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Review_Type` varchar(1) NOT NULL DEFAULT '0',
  `Review_desc` text NOT NULL,
  `Review_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Movie_Review_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `movie_review`
--

INSERT INTO `movie_review` (`Movie_Review_Id`, `Movie_Id`, `User_Id`, `Review_Type`, `Review_desc`, `Review_Time`) VALUES
(19, 9, 33, '0', 'hii', '2012-09-27 09:19:27'),
(20, 9, 33, '0', 'hii', '2012-09-27 09:20:02'),
(21, 9, 33, '0', 'hii', '2012-09-27 09:25:20'),
(22, 9, 33, '0', 'hiii', '2012-09-27 09:29:25'),
(23, 21, 33, '0', 'hioi', '2012-09-27 09:34:13'),
(24, 9, 33, '0', 'helo', '2012-10-05 12:51:50'),
(25, 9, 100, '0', 'hhh', '2012-10-06 05:53:52'),
(26, 9, 100, '0', '111', '2012-10-06 05:54:27'),
(27, 23, 100, '0', 'very nice', '2012-10-06 05:58:27'),
(28, 23, 100, '0', 'very nice', '2012-10-06 05:58:28'),
(29, 9, 33, '0', 'hii', '2012-10-06 06:52:34'),
(30, 21, 33, '0', 'jakashh', '2012-10-06 06:59:13'),
(31, 23, 33, '0', 'dfg', '2012-10-06 07:45:40'),
(32, 23, 33, '0', 'gfhgfh', '2012-10-06 07:45:57'),
(33, 23, 33, '0', 'dfghdgf', '2012-10-06 07:46:32'),
(34, 23, 33, '0', 'dgfhdfg', '2012-10-06 07:46:56'),
(35, 23, 33, '0', 'xdfgdfg', '2012-10-06 07:47:58'),
(36, 23, 33, '0', 'dfgdfg', '2012-10-06 07:48:27'),
(37, 23, 33, '0', 'dfgdfg', '2012-10-06 07:50:31'),
(38, 23, 33, '0', 'dfgdfg', '2012-10-06 07:50:53'),
(39, 23, 33, '0', 'dfgdf', '2012-10-06 07:51:01'),
(40, 23, 33, '0', 'dfsg', '2012-10-06 07:52:00'),
(41, 23, 33, '0', 'dfgf', '2012-10-06 07:56:07'),
(42, 23, 33, '0', 'dfgdf', '2012-10-06 07:56:49'),
(43, 23, 33, '0', 'dfgdfg', '2012-10-06 07:57:56'),
(44, 23, 33, '0', 'dfgdfg', '2012-10-06 07:58:06'),
(45, 23, 33, '0', 'dfgdfg', '2012-10-06 07:58:07'),
(46, 9, 33, '0', 'hii', '2012-10-06 08:11:22'),
(47, 9, 33, '0', 'hiii hw', '2012-10-06 08:11:36'),
(48, 9, 33, '0', 'hiiiii', '2012-10-06 08:11:43'),
(49, 9, 33, '0', 'hiii', '2012-10-06 08:12:12'),
(50, 9, 33, '0', 'hiii', '2012-10-06 08:12:36'),
(51, 9, 33, '0', 'hinmh', '2012-10-06 08:12:54'),
(52, 9, 33, '0', 'hiiii', '2012-10-06 08:33:14'),
(53, 9, 33, '0', 'nive', '2012-10-06 08:34:58'),
(54, 9, 33, '0', 'hiii', '2012-10-06 08:48:15'),
(55, 9, 33, '0', 'niverdfg', '2012-10-06 08:48:54'),
(56, 21, 33, '0', 'nice', '2012-10-08 06:21:37'),
(57, 9, 101, '0', 'hilll', '2012-10-08 08:14:42'),
(58, 9, 102, '0', 'hello', '2012-10-08 08:32:11'),
(59, 9, 33, '0', 'very nice', '2012-10-09 12:04:39'),
(60, 9, 33, '0', 'good to watch', '2012-10-09 12:05:15'),
(61, 9, 103, '0', 'goood movie', '2012-10-18 07:34:46'),
(62, 5, 103, '0', 'veryyyy nice', '2012-10-18 07:40:04'),
(63, 9, 33, '0', 'wow', '2012-10-22 07:34:22'),
(64, 11, 33, '0', 'the legand of BS', '2012-10-25 06:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `movie_script_writer`
--

CREATE TABLE IF NOT EXISTS `movie_script_writer` (
  `Movie_Script_Writer_Id` int(10) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(10) DEFAULT NULL,
  `Script_Writer_Id` int(10) DEFAULT NULL,
  PRIMARY KEY (`Movie_Script_Writer_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `movie_script_writer`
--

INSERT INTO `movie_script_writer` (`Movie_Script_Writer_Id`, `Movie_Id`, `Script_Writer_Id`) VALUES
(9, 2, 2),
(10, 3, 3),
(11, 5, 4),
(12, 4, 5),
(13, 4, 6),
(14, 6, 7),
(15, 7, 8),
(16, 8, 9),
(17, 9, 8),
(18, 11, 12),
(19, 11, 11),
(20, 12, 13),
(21, 13, 14),
(22, 14, 15),
(23, 15, 16),
(24, 15, 17),
(25, 16, 18),
(26, 17, 19),
(27, 18, 20),
(28, 19, 21),
(29, 20, 22),
(30, 21, 23),
(31, 21, 24),
(32, 22, 25),
(33, 23, 26),
(34, 24, 6);

-- --------------------------------------------------------

--
-- Table structure for table `movie_singer`
--

CREATE TABLE IF NOT EXISTS `movie_singer` (
  `Movie_Singer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(11) DEFAULT NULL,
  `Singer_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Movie_Singer_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `movie_singer`
--

INSERT INTO `movie_singer` (`Movie_Singer_Id`, `Movie_Id`, `Singer_Id`) VALUES
(3, 2, 6),
(4, 3, 7),
(5, 5, 7),
(6, 5, 9),
(7, 5, 8),
(8, 5, 10),
(9, 2, 11),
(10, 2, 12),
(11, 2, 13),
(12, 2, 14),
(13, 2, 15),
(14, 4, 13),
(15, 4, 8),
(16, 4, 12),
(17, 4, 16),
(18, 6, 17),
(19, 6, 18),
(20, 6, 7),
(21, 6, 14),
(22, 6, 12),
(23, 6, 8),
(24, 6, 19),
(25, 7, 20),
(26, 8, 21),
(27, 8, 9),
(28, 8, 14),
(29, 8, 22),
(30, 8, 23),
(31, 9, 20),
(32, 9, 24),
(33, 9, 25),
(34, 9, 26),
(35, 9, 27),
(36, 9, 22),
(37, 11, 28),
(38, 11, 13),
(39, 11, 14),
(40, 12, 29),
(41, 12, 30),
(42, 12, 31),
(43, 12, 32),
(44, 12, 20),
(45, 12, 33),
(46, 12, 34),
(47, 12, 35),
(48, 13, 24),
(49, 13, 12),
(50, 13, 7),
(51, 14, 19),
(52, 14, 14),
(53, 15, 13),
(54, 15, 20),
(55, 15, 34),
(56, 15, 35),
(57, 15, 29),
(58, 16, 23),
(59, 16, 12),
(60, 16, 13),
(61, 17, 6),
(62, 17, 23),
(63, 17, 24),
(64, 17, 18),
(65, 18, 36),
(66, 18, 12),
(67, 19, 13),
(68, 19, 14),
(69, 20, 36),
(70, 21, 37),
(71, 22, 38),
(72, 22, 36),
(73, 23, 39),
(74, 24, 20),
(75, 0, 0),
(76, 0, 0),
(77, 0, 0),
(78, 0, 0),
(79, 0, 0),
(80, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `movie_special_appereance`
--

CREATE TABLE IF NOT EXISTS `movie_special_appereance` (
  `Movie_Special_Appereance_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Id` int(11) DEFAULT NULL,
  `Special_Appereance_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Movie_Special_Appereance_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `movie_special_appereance`
--

INSERT INTO `movie_special_appereance` (`Movie_Special_Appereance_Id`, `Movie_Id`, `Special_Appereance_Id`) VALUES
(4, 7, 30),
(5, 24, 11);

-- --------------------------------------------------------

--
-- Table structure for table `movie_type`
--

CREATE TABLE IF NOT EXISTS `movie_type` (
  `Movie_Type_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Movie_Type_Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Movie_Type_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `movie_type`
--

INSERT INTO `movie_type` (`Movie_Type_Id`, `Movie_Type_Name`) VALUES
(3, 'action'),
(4, 'comedy'),
(5, 'romance'),
(6, 'Family'),
(7, 'Crime'),
(8, 'Horror'),
(9, 'Sport'),
(10, 'Thriller'),
(11, 'Animation'),
(12, 'History'),
(13, 'Music'),
(14, 'Drama'),
(15, 'Documentary'),
(16, 'Mystery'),
(17, 'War'),
(18, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `producer`
--

CREATE TABLE IF NOT EXISTS `producer` (
  `Producer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Producer_Name` varchar(100) DEFAULT NULL,
  `Producer_DOB` datetime DEFAULT NULL,
  `Producer_Death_Date` datetime DEFAULT NULL,
  `Producer_Avatar` varchar(500) DEFAULT NULL,
  `Producer_Description` text,
  PRIMARY KEY (`Producer_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `producer`
--

INSERT INTO `producer` (`Producer_Id`, `Producer_Name`, `Producer_DOB`, `Producer_Death_Date`, `Producer_Avatar`, `Producer_Description`) VALUES
(2, 'Arbaaz Khan', '0000-00-00 00:00:00', NULL, '46724c72db7f4208c53ad77e31f2553f.jpg', NULL),
(5, 'Sunil Manchanda', NULL, NULL, '32297b6731b1a79c10be1c4125e9c74b.jpg', NULL),
(8, 'Amitabh Bachchan', '0000-00-00 00:00:00', NULL, '2c6a79fa23e8c2c62ae994b6d700e20a.jpg', NULL),
(9, 'Malaika Arora', '1973-08-23 00:00:00', '1970-01-01 00:00:00', 'd9bca89108f32b30fd974c1235b1c91a.jpg', NULL),
(10, 'Dhilin Mehta ', NULL, NULL, 'd2bc3ad2cc8ed0165d0bbbdd3134136e.jpg', NULL),
(11, 'Vidhu Vinod Chopra ', '1956-09-05 00:00:00', '1970-01-01 00:00:00', '026a01a147dd39445f8d19accb6223ea.jpg', NULL),
(12, 'Aditya Chopra ', '1971-05-21 00:00:00', NULL, '6f13d7deff783797b9464d02ee14c9ca.jpg', NULL),
(13, 'Yash Chopra ', '1932-09-27 00:00:00', NULL, '470bca9b77f73f4b825730e8063f7cbd.jpg', NULL),
(14, 'Shah Rukh Khan ', '1965-11-02 00:00:00', NULL, '2535839780dc8a3bd5f1150e8fc50e92.jpg', NULL),
(15, 'Farhan Akhtar ', '1974-01-09 00:00:00', NULL, '75bd45141cb29b9012e6b2cd9fae7d81.jpg', NULL),
(16, 'sanjay Ghosh', NULL, NULL, '2b465a8b36e98ab3c340b6097e57a6d8.jpg', NULL),
(17, 'Kushal Gada ', NULL, NULL, 'default_image.jpg', NULL),
(18, 'Ritesh Sidhwani ', '1971-09-19 00:00:00', NULL, '1f1ede944dcfbd4c4b55e6f96c60aab3.jpg', NULL),
(19, 'Kumar Sadhuram Taurani ', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'ec8a7d14002b5b1f148aa1a086f1fe6d.jpg', NULL),
(20, 'Ramesh Sadhuram Taurani ', NULL, NULL, 'bc9177ae717885b826db3f684389b914.jpg', NULL),
(21, 'Sooraj R. Barjatya ', '1965-05-22 00:00:00', NULL, '5d2864968f277ac540cbb5b2f6d1df39.jpg', NULL),
(22, 'Ajit Kumar Barjatya ', NULL, NULL, '27eef75d82d903c101ede2928affe544.jpg', NULL),
(23, 'Rajat A. Barjatya', NULL, NULL, '90b3204974a5b3f67525becd9e8f2164.jpg', NULL),
(24, 'Siddharth Roy Kapur ', '1974-08-02 00:00:00', NULL, 'd017c1f0159acc6cfbe72825e0a59dd7.jpg', NULL),
(25, 'J.P. Dutta', NULL, NULL, '13d47120bc9e8f206ad76fc0f1f21e10.jpg', NULL),
(26, 'Mukesh Bhatt', '1952-06-05 00:00:00', NULL, '4fcdca4bdb409edfb493d9da0298821f.jpg', NULL),
(27, 'Mahesh Bhatt', '1949-09-20 00:00:00', NULL, '2f7244a2e29428449123c0679968711e.jpg', NULL),
(28, 'Ravi Agarwal', NULL, NULL, 'default_image.jpg', NULL),
(29, 'Shailendra Singh', '1952-10-04 00:00:00', NULL, 'bd12729bbef099bef92ea1bef8065852.jpg', NULL),
(30, 'paresh rawal', '1950-05-30 00:00:00', NULL, 'b49272b425196225397b439de0cd46c4.jpg', NULL),
(31, 'akshay kumar', '1967-09-09 00:00:00', NULL, 'b32a77556c1d79b678acc088518ff699.jpg', NULL),
(32, 'Madhur Bhandarkar', '1966-08-26 00:00:00', NULL, '9e0f87543b02396a4d2f2adaeb1a6288.jpg', NULL),
(33, 'Ronnie Screwvala', '1956-06-08 00:00:00', NULL, 'dd2c70603a43c2b201bfe2adad596755.jpg', NULL),
(34, 'Ajay Devgn', '1969-04-02 00:00:00', NULL, '787eafac9af2267bd6ef09371596f907.jpg', NULL),
(35, 'N.R. Pachisia ', NULL, NULL, 'c57f7bc86161585da97f8eddc471b3ac.jpg', NULL),
(36, 'Amit Chandrra ', NULL, NULL, 'default_image.jpg', NULL),
(37, 'Reshma Chandrra ', NULL, NULL, 'default_image.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `script_writer`
--

CREATE TABLE IF NOT EXISTS `script_writer` (
  `Script_Writer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Script_Writer_Name` varchar(100) DEFAULT NULL,
  `Script_Writer_Avatar` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Script_Writer_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `script_writer`
--

INSERT INTO `script_writer` (`Script_Writer_Id`, `Script_Writer_Name`, `Script_Writer_Avatar`) VALUES
(2, 'Dilip Shukla', 'f216bef8d918092938e6f130eeaa1858.jpg'),
(3, 'Puri Jagannath', '9dd7b2dae94b757145ec05963db0a855.jpg'),
(4, 'R.Balki', '3ee122de9b0cdb681c036f80c92d1dc4.jpg'),
(5, 'Vidhu Vinod Chopra', '37d1b3cff51d34dc2ac7f30697492158.jpg'),
(6, 'Rajkumar Hirani ', 'f6b9e5cee7f90ef7bfa10f6790150fab.jpg'),
(7, 'Aditya Chopra', '60abb583f9f4d6445edb23974e8bea84.jpg'),
(8, 'Farhan Akhtar ', 'e61ed6eddf5f15d6b77a32af3005b40c.jpg'),
(9, 'sanjay Ghosh', 'f918476e419b7add1604f4c7c8094521.jpg'),
(10, 'zoya Akhter', 'ad9954bca422a7808501b17d98af92ad.jpg'),
(11, 'Ranjit Kapoor ', '178abeff6e8c08cd17c1c0a050e15fe3.jpg'),
(12, 'Piyush Mishra ', '220b3829dee59b671605455364dacc1f.jpg'),
(13, 'Sooraj R.Barjatya', '02b9d3a6fc4a7cccfc28dfe9efcbb742.jpg'),
(14, 'Anurag Basu ', '0964cd3c0b7ed2f96394876aae7b5cbc.jpg'),
(15, 'Jaideep Sahni ', '1f4db125389cb3117bb3201a067ac7f8.jpg'),
(16, 'J.P. Dutta', 'c0ee38dd66bc85eb7014ed1e32656852.jpg'),
(17, 'O.P. Dutta', '7d16c2d40a7388a0b0d7331a6de59613.jpg'),
(18, 'Mohit Suri', 'd0cb0296b107f3075e705b1e78b3e6c4.jpg'),
(19, 'Shagufta Rafique ', 'ebff739cd10f59f1cea14ddc56d174e8.jpg'),
(20, 'Ishan Trivedi', 'default_image.jpg'),
(21, 'Kompin Kemgumnird', '4113eb2de4a97b2b68bd5600a54f86f4.jpg'),
(22, 'Umesh Shukla ', '120c5952c59d72af3ab7acf55d5ae4bb.jpg'),
(23, 'Madhur Bhandarkar	 	', '8c43bcd32f780eddf2c09764987bfdfa.jpg'),
(24, 'Niranjan Iyengar ', 'c363b6fa9593e069dc54aa2291afa6b2.jpg'),
(25, 'Ashwani Dhir ', '3812011ceff436c61f6972fe6e79da2b.jpg'),
(26, 'Sanjay M. Khanduri ', '9642b3fbbf85a4e6abcfe97bf0bc4142.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `singer`
--

CREATE TABLE IF NOT EXISTS `singer` (
  `Singer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Singer_Name` varchar(100) DEFAULT NULL,
  `Singer_DOB` datetime DEFAULT NULL,
  `Singer_Death_Date` datetime DEFAULT NULL,
  `Singer_Avatar` varchar(500) DEFAULT NULL,
  `Singer_Description` text,
  PRIMARY KEY (`Singer_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `singer`
--

INSERT INTO `singer` (`Singer_Id`, `Singer_Name`, `Singer_DOB`, `Singer_Death_Date`, `Singer_Avatar`, `Singer_Description`) VALUES
(6, 'Rahat Fateh Ali Khan	', '1974-01-01 00:00:00', NULL, '36dcc7db34fdccd7a7a0cb3008a06f65.jpg', NULL),
(7, 'Sunidhi Chauhan', '1983-08-14 00:00:00', '1970-01-01 00:00:00', '93110970ae080a932fe2e66741be51eb.jpg', NULL),
(8, 'Shaan', '1972-09-30 00:00:00', '1970-01-01 00:00:00', 'ab2b25c515c7f6cb174b4e2ce19e39af.jpg', NULL),
(9, 'Amitabh Bachchan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '8320b9560f9da106f02c081418cf41bf.jpg', NULL),
(10, 'Shilpa Rao', '0000-00-00 00:00:00', '1970-01-01 00:00:00', '52afbdbfc26339815f9f48607791b849.jpg', NULL),
(11, 'Wajid Ali', NULL, NULL, '6c6856d529177539bd8f295e437383eb.jpg', NULL),
(12, 'Shreya Ghoshal ', '1984-03-12 00:00:00', NULL, '5ddd064735f0d433f3411a42a500031a.jpg', NULL),
(13, 'Sonu Nigam ', '1973-07-30 00:00:00', NULL, 'd1df8eb9f61db70c6b4f8c849ec0e028.jpg', NULL),
(14, 'Sukhwinder Singh ', '1971-07-18 00:00:00', NULL, '29e37ad43abd7e401c5823244970c684.jpg', NULL),
(15, 'Master Saleem', '1980-07-13 00:00:00', '1970-01-01 00:00:00', '092a7093f9862f4cc729eec0792f2713.jpg', NULL),
(16, 'Swanand Kirkire', '1970-06-01 00:00:00', NULL, 'da5665887eca44b7d1a2b5fe8cb3ccb0.jpg', NULL),
(17, 'Lucky Ali ', '1958-09-19 00:00:00', NULL, '7e73f4a94cb326e468f3a29d1148df49.jpg', NULL),
(18, 'Javed Ali ', NULL, NULL, '8233e3e919ceacdbf41f7c99dfac3bcd.jpg', NULL),
(19, 'Salim Merchant', NULL, NULL, '2f1c9e64905e26c5516f63d8ccb9e821.jpg', NULL),
(20, 'Shankar-Ehsaan-Loy', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'a7fde3d53733c218a69ef3395e2a5cec.jpg', NULL),
(21, 'Usha Uthup ', '1947-11-08 00:00:00', NULL, 'baff077e0be7d7fac8af86294bdf9e90.jpg', NULL),
(22, 'Vishal Dadlani ', NULL, NULL, 'ff3ba601492b247dbe2b32313aa51e3a.jpg', NULL),
(23, 'Kay Kay ', '1968-08-23 00:00:00', NULL, '6630dfcc20a3038fdf53513067948e51.jpg', NULL),
(24, 'Mohit Chauhan', '1966-03-11 00:00:00', NULL, '85faa3e6d8326cbb2e24fa0f335b0f3c.jpg', NULL),
(25, 'Farhan Akhtar ', NULL, '1974-01-09 00:00:00', '336a9d311d653d3f8fedd5b8ba043b70.jpg', NULL),
(26, 'Hrithik Roshan ', '1974-01-10 00:00:00', NULL, '9dfab32b59884d4255cb5023ef26ba7b.jpg', NULL),
(27, 'Abhay Deol ', '1976-03-15 00:00:00', NULL, '3b17aabeb0fbeccc3172053c3eddc731.jpg', NULL),
(28, 'A.R. Rahman ', '1966-01-06 00:00:00', NULL, 'f932553c421f2729c66203d3acba051d.jpg', NULL),
(29, 'Hariharan ', '1955-04-03 00:00:00', NULL, 'fa507ec9955b5dece9bdf14e3fc5b916.jpg', NULL),
(30, 'Saif Ali Khan ', '1970-08-16 00:00:00', NULL, '6b9bb5fc0a36801a4124e894cf4efa90.jpg', NULL),
(31, 'Udit Narayan ', '1960-12-01 00:00:00', NULL, '00f01bffb73d9876cfc2f5ff07720299.jpg', NULL),
(32, 'Kavita Krishnamurthy ', '1958-01-25 00:00:00', NULL, '6b908ff7318d6c67ae46a675b4c885ad.jpg', NULL),
(33, 'Anuradha Paudwal ', '1954-10-27 00:00:00', NULL, '67a34168f2800795ccc5ab5a0b757d13.jpg', NULL),
(34, 'Roop Kumar Rathod ', '1973-09-19 00:00:00', NULL, '6dc3a9395447896dbc251a29e4a57796.jpg', NULL),
(35, 'Alka Yagnik ', '1966-03-20 00:00:00', NULL, '5255b98aa866016a4ca8f32c9a9a500d.jpg', NULL),
(36, 'Himesh Reshammiya', '1973-07-23 00:00:00', NULL, '70fcec67787e580eb7b2dabb67696fc3.jpg', NULL),
(37, 'Lata Mangeshkar', '1929-09-28 00:00:00', NULL, 'a6147a7881b766ba847438dc4b33e6ed.jpg', NULL),
(38, 'Sajid-Wajid', NULL, NULL, 'fd5188deae11675cb1c87153dfe61aeb.jpg', NULL),
(39, 'Amjad Nadeem ', NULL, NULL, 'default_image.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `facebook_id` varchar(200) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `date_of_birth` varchar(100) DEFAULT NULL,
  `country` int(10) unsigned DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `Last_Name` varchar(100) DEFAULT NULL,
  `user_image` varchar(1000) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `ip_address`, `username`, `password`, `salt`, `facebook_id`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `name`, `first_name`, `gender`, `date_of_birth`, `country`, `zip`, `Last_Name`, `user_image`, `phone`) VALUES
(33, 1, '127.0.0.1', 'jay xdgdsfg', '6b86383d4a44b52e5eb59f243a99fde4fde5a285', '', NULL, 'jaykareliya23@gmail.com', NULL, NULL, '', 1347264380, 1352182283, 1, 'jay', 'jay', '1', '03-09-2012', 1, '537568', 'xdgdsfg', 'a1ccf168a543a01844771d7af265e08d.jpg', '4254325'),
(34, 2, '127.0.0.1', 'hardik karelia', '206506a5bdf0c260976589db6f433fceced7c0f5', NULL, NULL, 'hardik@gmail.com', NULL, NULL, NULL, 1347265060, 1347265060, 1, 'hardik', 'hardik', '1', '03-09-2012', 2, '4536', 'karelia', NULL, '425432'),
(35, 2, '127.0.0.1', 'hh jj', '04711bc82d1c8c2a0a7605c04efd8f4fce180bf1', NULL, NULL, 'kk@gmail.com', NULL, NULL, NULL, 1347266655, 1347266655, 1, 'hh', 'hh', '1', '25-09-2012', 1, '536545', 'jj', NULL, '536789'),
(86, 2, '127.0.0.1', 'faf asdfsdf', 'aadc8d10dec5d370d3b27151ea08220670d870f3', NULL, NULL, 'jaykareliya23@1gmail.com', NULL, NULL, NULL, 1349075475, 1349075475, 1, 'faf', 'faf', '1', '16-10-2012', 10, '111', 'asdfsdf', '', '9199898935'),
(103, 2, '127.0.0.1', 'vishal tarkar', '2db5364d622f0d3fdcbd051a5653b7d8ec67d7df', NULL, NULL, 'vishal@pinatech.biz', NULL, NULL, NULL, 1350545578, 1350558958, 1, 'vishal', 'vishal', '1', '26-11-1991', 102, '380001', 'tarkar', 'f3141bebcf037132665e62f509e4b35a.jpg', '9737696969'),
(104, 2, '127.0.0.1', 'jay kareliya', 'af52943e2dd3d3533af158cb34d52459d6328133', NULL, NULL, 'jay@pinatech.biz', NULL, NULL, NULL, 1352099427, 1352099427, 1, 'jay', 'jay', '1', '07-11-2012', 2, '454345', 'kareliya', '7e4642a99ecdf230a37cd90fe8558728.jpg', '53678956');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
