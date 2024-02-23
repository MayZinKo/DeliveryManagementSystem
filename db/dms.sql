-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 25, 2016 at 01:40 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `dms`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `price`, `deleted`) VALUES
(1, 'Area 1', '2000', 0),
(2, 'Area 2', '3000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`id`, `courier_id`, `customer_id`, `timestamp`, `deleted`) VALUES
(1, 2, 1, '2016-04-12 01:38:18', 0),
(2, 2, 2, '2016-04-12 03:24:05', 0),
(3, 1, 4, '2016-04-14 08:57:13', 0),
(4, 1, 3, '2016-04-14 08:52:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `township_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `theme_color` varchar(50) NOT NULL,
  `marker_img` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`id`, `code`, `township_id`, `user_id`, `theme_color`, `marker_img`, `deleted`) VALUES
(1, 'C-0001', 21, 5, '#ff0000', 'red.png', 0),
(2, 'C-0004', 21, 8, '#0066cc', 'blue.png', 0),
(3, 'C-0002', 10, 6, '#cc00cc', 'pink.png', 0),
(4, 'C-0006', 10, 10, '#66ff66', 'green.png', 0),
(5, 'C-0003', 20, 7, '#9999ff', 'violet.png', 0),
(6, 'C-0005', 8, 9, '#993399', 'sviolet.png', 0),
(7, 'C-0007', 1, 11, '#FF6633', 'orange.png', 0),
(8, 'C-0008', 2, 12, '#996633', '996633.png', 0),
(9, 'C-0009', 3, 13, '#FF6666', 'FF6666.png', 0),
(10, 'C-0010', 4, 14, '#FFCC66', 'FFCC66.png', 0),
(11, 'C-0011', 5, 15, '#FFFF66', 'FFFF66.png', 0),
(12, 'C-0012', 6, 16, '#00FFFF', '00FFFF.png', 0),
(13, 'C-0013', 7, 17, '#66CCFF', '66CCFF.png', 0),
(14, 'C-0014', 9, 18, '#CC66FF', 'CC66FF.png', 0),
(15, 'C-0015', 11, 19, '#FF0080', 'FF0080.png', 0),
(16, 'C-0016', 12, 20, '#8000FF', '8000FF.png', 0),
(17, 'C-0017', 13, 21, '#800000', '800000.png', 0),
(18, 'C-0018', 14, 22, '#808000', '808000.png', 0),
(19, 'C-0019', 15, 23, '#408000', '408000.png', 0),
(20, 'C-0020', 16, 24, '#008080', '008080.png', 0),
(21, 'C-0021', 17, 25, '#000080', '000080.png', 0),
(22, 'C-0022', 18, 26, '#800080', '800080.png', 0),
(23, 'C-0023', 19, 27, '#800040', '800040.png', 0),
(24, 'C-0024', 22, 28, '#CCCCCC', 'CCCCCC.png', 0),
(25, 'C-0025', 23, 29, '#999999', '999999.png', 0),
(26, 'C-0026', 24, 30, '#666666', '666666.png', 0),
(27, 'C-0027', 25, 31, '#333333', '333333.png', 0),
(28, 'C-0028', 26, 32, '#EF1653', 'EF1653.png', 0),
(29, 'C-0029', 27, 33, '#00B11E', '00B11E.png', 0),
(30, 'C-0030', 28, 34, '#8C00B1', '8C00B1.png', 0),
(31, 'C-0031', 29, 35, '#B10032', 'B10032.png', 0),
(32, 'C-0032', 16, 36, '#E35838', 'E35838.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `township_id` int(11) NOT NULL,
  `home_no` varchar(20) NOT NULL,
  `street` varchar(50) NOT NULL,
  `road` varchar(50) NOT NULL,
  `quarter` varchar(50) NOT NULL,
  `drop_point_id` int(11) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `customer_type` char(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `done_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `township_id`, `home_no`, `street`, `road`, `quarter`, `drop_point_id`, `timestamp`, `phone`, `description`, `customer_type`, `deleted`, `done_status`) VALUES
(1, 'Ei Ei Khaing', 21, '128', 'Phyar Pone St', 'Kyun Taw Rd', '', 1, '2016-04-09 02:21:18 PM', '09328168219', '', 's', 0, 0),
(2, 'Wut Yee Myo Myint', 21, '456', 'Sanchaung St', 'Pyay Rd', '', 2, '2016-04-09 02:23:56 PM', '098743256', '', 's', 0, 0),
(3, 'Khin Lay Nwe', 21, '544', 'Gandamar St', 'Boho Rd', '', 3, '2016-04-09 02:26:52 PM', '0932133532', '', 's', 0, 0),
(4, 'Hnin Thiri Aung', 21, '212', 'Bagaya St', 'Pyay Rd', '', 4, '2016-04-09 02:34:54 PM', '0921345212', '', 's', 0, 0),
(5, 'Zin Mi Mi Lay', 10, '43', 'Htan Tapin St', 'Hledan Rd', '', 5, '2016-04-09 02:38:00 PM', '094201233432', '', 's', 0, 0),
(6, 'Tharaphi Maung', 10, '43', 'Moe Sandar St', 'Insein', '', 6, '2016-04-09 02:40:02 PM', '09329123455', '', 's', 0, 0),
(7, 'Shwe Yi Win', 10, '32', 'Awayer St', 'Baho Rd', '', 7, '2016-04-09 02:42:01 PM', '09732143567', '', 's', 0, 0),
(8, 'Yu Ri Ko Ko', 10, '54', '50ft St', 'Hledan Rd', '', 8, '2016-04-09 02:43:59 PM', '09420123456', '', 's', 0, 0),
(9, 'Ya Min Aung', 20, '43', '51st St', 'Bo Gyoke Rd', '', 9, '2016-04-09 02:46:46 PM', '0973145623', '', 's', 0, 0),
(10, 'Poe Ei Phyu', 20, '321', '49th St', 'Anawrahta Rd', '', 10, '2016-04-09 02:48:13 PM', '09820123456', '', 's', 0, 0),
(11, 'Soe Sandar Lwin', 20, '543', 'Nyaung Tan St', 'Lower Pazundaung Road', '', 11, '2016-04-09 02:49:45 PM', '0951234512', '', 's', 0, 0),
(12, 'Aye Thiri Aung', 8, '33', 'Aung Zay Ya St', 'Hlaing River Rd', '', 12, '2016-04-09 03:05:13 PM', '0987124341', '', 's', 0, 0),
(13, 'Swe Zin Soe', 8, '87', 'Ka Naung Min Thar Gyi St', 'Yaw Atwin Wun U Poe Hlaing Rd', '', 13, '2016-04-09 03:06:57 PM', '094326178', '', 's', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `drop_point`
--

CREATE TABLE `drop_point` (
  `id` int(11) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drop_point`
--

INSERT INTO `drop_point` (`id`, `latitude`, `longitude`) VALUES
(1, '16.80648222462087', '96.13154768965614'),
(2, '16.80217777856184', '96.13413333898279'),
(3, '16.810271001429022', '96.12934827826393'),
(4, '16.803904293270097', '96.13456249242518'),
(5, '16.82790440269026', '96.12699866316689'),
(6, '16.829578309842113', '96.12967014318201'),
(7, '16.825517262908015', '96.12570226203388'),
(8, '16.827103900484243', '96.12922132017957'),
(9, '16.77814257091732', '96.17195248625649'),
(10, '16.776190860723002', '96.1704611780442'),
(11, '16.77848155011862', '96.17630839353296'),
(12, '16.886288300335856', '96.10139071944104'),
(13, '16.90509409206606', '96.072088480214');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoice_num` int(11) NOT NULL,
  `start_customer_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_num`, `start_customer_id`) VALUES
(1, 5708, 1),
(2, 5708, 2),
(3, 5708, 3),
(4, 5708, 4),
(5, 5708, 5),
(6, 5708, 6),
(7, 5708, 7),
(8, 5708, 8),
(9, 5708, 9),
(10, 5708, 10),
(11, 5708, 11),
(12, 5708, 12),
(13, 5708, 13);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `type`, `description`) VALUES
(1, 'Clothes', ''),
(2, 'Shoes', ''),
(3, 'Cosmetic', ''),
(4, 'Bag', ''),
(5, 'Electronic', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_itemcategory`
--

CREATE TABLE `order_itemcategory` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_category_id` int(11) NOT NULL,
  `item_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'Main Admin'),
(2, 'Sub Admin'),
(3, 'Courier');

-- --------------------------------------------------------

--
-- Table structure for table `township`
--

CREATE TABLE `township` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `township` varchar(50) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `township`
--

INSERT INTO `township` (`id`, `code`, `township`, `latitude`, `longitude`) VALUES
(1, 'AHLN', 'Ahlon', '16.7849833', '96.1192453'),
(2, 'BHN', 'Bahan', '16.8112384', '96.1397882'),
(3, 'BTHG', 'Botataung', '16.7733461', '96.1718594'),
(4, 'DBN', 'Dawbon', '16.790129', '96.1724171'),
(5, 'DGN', 'Dagon', '16.7928573', '96.1364731'),
(6, 'HLG', 'Hlaing', '16.8461385', '96.1031035'),
(7, 'HLTA', 'Hlaingthaya', '16.8800164', '95.9837693'),
(8, 'ISN', 'Insein', '16.9022753', '96.0694844'),
(9, 'KMDN', 'Kyimyindaing', '16.8078779', '96.1019931'),
(10, 'KMYT', 'Kamayut', '16.8230873', '96.1244539'),
(11, 'KTDA', 'Kyauktada', '16.7742041', '96.1569464'),
(12, 'LMDW', 'Lanmadaw', '16.779512', '96.1322406'),
(13, 'LTA', 'Latha', '16.7767259', '96.1459977'),
(14, 'MGDN', 'Mingaladon', '16.9870347', '96.0646648'),
(15, 'MTNT', 'Mingala Taungnyunt', '16.7940634', '96.1559699'),
(16, 'MYGN', 'Mayangon', '16.8658965', '96.1020623'),
(17, 'NDGN', 'North Dagon', '16.8863331', '96.1565916'),
(18, 'NOKA', 'North Okkalapa', '16.901217', '96.1245553'),
(19, 'PBDN', 'Pabedan', '16.7760326', '96.1516571'),
(20, 'PZDG', 'Pazundaung', '16.7777994', '96.1725515'),
(21, 'SCHG', 'Sanchaung', '16.80556', '96.1274053'),
(22, 'SDGN', 'South Dagon', '16.8911462', '96.2084741'),
(23, 'SOKA', 'South Okkalapa', '16.8491092', '96.1655186'),
(24, 'SPTA', 'Shwepyitha', '16.9786009', '96.0417931'),
(25, 'TGGN', 'Thingangyun', '16.8299778', '96.1797987'),
(26, 'THLN', 'Thanlyin', '16.7587757', '96.2223807'),
(27, 'TKA', 'Thaketa', '16.7973445', '96.1957632'),
(28, 'TMWE', 'Tamwe', '16.8094105', '96.1594032'),
(29, 'YKN', 'Yankin', '16.8374391', '96.1488513');

-- --------------------------------------------------------

--
-- Table structure for table `township_area`
--

CREATE TABLE `township_area` (
  `id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `township_area`
--

INSERT INTO `township_area` (`id`, `township_id`, `area_id`) VALUES
(1, 21, 1),
(2, 10, 1),
(3, 8, 2),
(4, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `image`, `deleted`) VALUES
(1, 'ADMIN', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'img01.png', 0),
(2, 'Tin Moe Moe Aye', 'substaff.001@dms.com', 'dc5c7986daef50c1e02ab09b442ee34f', 2, 'img14.png', 0),
(3, 'Hsu Lynn Htet', 'substaff.002@dms.com', '93dd4de5cddba2c733c65f233097f05a', 2, 'img03.png', 0),
(4, 'Ngwe Yee Shoon', 'substaff.003@dms.com', 'e88a49bccde359f0cabb40db83ba6080', 2, 'img08.png', 0),
(5, 'Myat Thu', 'courier.0001@dms.com', '25bbdcd06c32d477f7fa1c3e4a91b032', 3, 'img10.png', 0),
(6, 'Htet Phyo', 'courier.0002@dms.com', 'fcd04e26e900e94b9ed6dd604fed2b64', 3, 'img09.png', 0),
(7, 'Nyein Chan', 'courier.0003@dms.com', '7cd86ecb09aa48c6e620b340f6a74592', 3, 'img12.png', 0),
(8, 'Soe Lwin Oo', 'courier.0004@dms.com', 'bc02c9e9817b572076973d4a3a08ab97', 3, 'img04.png', 0),
(9, 'Wai Yan', 'courier.0005@dms.com', 'd39934ce111a864abf40391f3da9cdf5', 3, 'img06.png', 0),
(10, 'Aung Pyae Hein', 'courier.0006@dms.com', '7f8bb0fe8b33780a08fe6b60ced14529', 3, 'img05.png', 0),
(11, 'Min Oo Lwin', 'courier.0007@dms.com', '6950aac2d7932e1f1a4c3cf6ada1316e', 3, 'profile.png', 0),
(12, 'Aung Ko Ko Thet', 'courier.0008@dms.com', '926abae84a4bd33c834bc6b981b8cf30', 3, 'profile.png', 0),
(13, 'Sai Khom Kham', 'courier.0009@dms.com', '29549a71a57f587d88209b9c1f1b7999', 3, 'profile.png', 0),
(14, 'Bo Bo', 'courier.0010@dms.com', 'fc1198178c3594bfdda3ca2996eb65cb', 3, 'profile.png', 0),
(15, 'Htun Htun Zaw', 'courier.0011@dms.com', 'ae2bac2e4b4da805d01b2952d7e35ba4', 3, 'profile.png', 0),
(16, 'Myo Min Oo', 'courier.0012@dms.com', '29150bb2319c182c944841c74d2f8d75', 3, 'profile.png', 0),
(17, 'Htin Lynn', 'courier.0013@dms.com', 'c0279f73075a52e1a7dea35065bc8c80', 3, 'profile.png', 0),
(18, 'Aung Phyo Thein', 'courier.0014@dms.com', 'b6fb522815d06fed82b0140be4c74680', 3, 'profile.png', 0),
(19, 'Htut Aung Lynn', 'courier.0015@dms.com', '0e7e3cf0ded4d9db8b376b317c007f99', 3, 'img07.png', 0),
(20, 'Aung Ko', 'courier.0016@dms.com', 'c3f484315c27d75d5449e9e0963949da', 3, 'profile.png', 0),
(21, 'Htet Wai Phyo', 'courier.0017@dms.com', '6858fb45a3d3aef7c29322d3b68dffd1', 3, 'profile.png', 0),
(22, 'Annt Phyo Twin', 'courier.0018@dms.com', '857778a20b9a41d4ca0d687a36e4bfa8', 3, 'profile.png', 0),
(23, 'Aung Sett Paing', 'courier.0019@dms.com', '540bd55a2cf295b8ea9cd78650e89d03', 3, 'profile.png', 0),
(24, 'Pyae Sone Win', 'courier.0020@dms.com', 'ecee596a242de13b779391cdaa2c528d', 3, 'img13.png', 0),
(25, 'Phyo Myat Kyaw', 'courier.0021@dms.com', 'd9f5e405a7f74ed652a8f0b31a87f636', 3, 'profile.png', 0),
(26, 'Aung Ko Min', 'courier.0022@dms.com', '147768d3955e38c4e662c0a95d807abc', 3, 'img02.png', 0),
(27, 'Ko Ko Lwin', 'courier.0023@dms.com', 'b26747fc8cb2170baa866b315cf58b7c', 3, 'profile.png', 0),
(28, 'Kaung Gyi', 'courier.0024@dms.com', '096ec814d2392f379695f30ca7041977', 3, 'profile.png', 0),
(29, 'Nay Htoo Zaw', 'courier.0025@dms.com', 'ed0a75eeb69b34ddc14beed2678bee12', 3, 'profile.png', 0),
(30, 'Ye Mhan Oo', 'courier.0026@dms.com', '2ebe25dd3a566f36f80d55440d3c3834', 3, 'profile.png', 0),
(31, 'Htoo Lin Kyaw', 'courier.0027@dms.com', 'f865c5e07958ad70ef989e905390f6d0', 3, 'profile.png', 0),
(32, 'Nay Myo Hlaing', 'courier.0028@dms.com', '6cb9669ff7bbb140212081ccb0f68543', 3, 'profile.png', 0),
(33, 'Yan Paing Oo', 'courier.0029@dms.com', '0e0b24fc303d2b384be5a2464654a5d2', 3, 'profile.png', 0),
(34, 'Min Thet Khine', 'courier.0030@dms.com', '1d0d2cade49078f9d43bbdfab67abbc0', 3, 'profile.png', 0),
(35, 'Kyaw Thu Oo', 'courier.0031@dms.com', '0780f11aa0422b8466bce734d1a730ab', 3, 'profile.png', 0),
(36, 'Swen Htet', 'courier.0032@dms.com', 'c90070ff096dd6858022784617b2f383', 3, 'profile.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drop_point`
--
ALTER TABLE `drop_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_itemcategory`
--
ALTER TABLE `order_itemcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `township`
--
ALTER TABLE `township`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `township_area`
--
ALTER TABLE `township_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `drop_point`
--
ALTER TABLE `drop_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_itemcategory`
--
ALTER TABLE `order_itemcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `township`
--
ALTER TABLE `township`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `township_area`
--
ALTER TABLE `township_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;