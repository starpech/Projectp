-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 10:58 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kms_web_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `cart_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `mem_id`, `product_price`, `cart_date`) VALUES
(10, 3, 1, 750, '2020-07-01 10:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `comp`
--

CREATE TABLE `comp` (
  `comp_id` int(11) NOT NULL COMMENT 'ลำดับบริษัทที่เกี่ยวข้อง',
  `comp_code` varchar(2) NOT NULL COMMENT 'รหัสบริษัท',
  `comp_name` varchar(50) NOT NULL COMMENT 'ชื่อบริษัท',
  `comp_nickname` varchar(3) DEFAULT NULL COMMENT 'ชื่อย่อบริษัท 3 ตัวอักษร',
  `comp_addr` varchar(500) NOT NULL COMMENT 'ที่อยู่บริษัท',
  `comp_tel` varchar(20) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `comp_fax` varchar(20) DEFAULT NULL COMMENT 'เบอร์แฟกซ์',
  `comp_email` varchar(50) DEFAULT NULL COMMENT 'อีเมลบริษัท',
  `comp_type` enum('บริษัท','ผู้ซื้อ','ผู้ขาย') NOT NULL COMMENT 'ชนิดบริษัท 1:ผู้ซื้อ 2:ผู้ขาย 3:KMS',
  `comp_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่ทำรายการ',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag=0:use 1:notuse'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางบริษัท';

--
-- Dumping data for table `comp`
--

INSERT INTO `comp` (`comp_id`, `comp_code`, `comp_name`, `comp_nickname`, `comp_addr`, `comp_tel`, `comp_fax`, `comp_email`, `comp_type`, `comp_date`, `flag`) VALUES
(1, '01', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', 'KMS', '     503 อาคาร เคเอสแอล ทาวเวอร์ ชั้น 16 ถนนศรีอยุธยา แขวงถนนพญาไท เขตราชเทวี กรุงเทพมหานคร 10400\r\n', '026426191-9', '026426097', 'kms_admin@klgroup.com', 'บริษัท', '2020-06-25 00:00:00', '0'),
(2, '02', 'บริษัท น้ำตาลขอนแก่น จำกัด (สาขาน้ำพอง)', 'KKS', '     43 หมู่ 10 ถ.น้ำพอง-กระนวน  ตำบลน้ำพอง อำเภอน้ำพอง จังหวัดขอนแก่น ', '0434329026', '043432907', 'kslnp@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:08:09', '0'),
(3, '03', 'บริษัท น้ำตาลขอนแก่น จำกัด(สาขาวังสะพุง)', 'WSP', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', '0428109313', '0428109313', 'kslwp@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:13:26', '0'),
(4, '04', 'บริษัท น้ำตาลนิวกรุงไทย จำกัด (สาขาบ่อพลอย)', 'NKT', '  99 ม.6 ต.หลุมรัง อ.บ่อพลอย จ.กาญจนบุรี ', '034615350', '034615399', 'kslbp@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:21:32', '0'),
(5, '05', 'บริษัท น้ำตาลท่ามะกา จำกัด', 'TMK', '14/1 ม.10 ต.ท่ามะกา อ.ท่ามะกา จ.กาญจนบุรี 71120', '034543201', '034640208', 'ksltk@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:25:27', '0'),
(6, '06', 'บริษัท น้ำตาลนิวกว้างสุ้นหลี จำกัด', 'NKS', ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', '038788203', '038462431', 'kslpn@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:36:09', '0'),
(7, '07', 'บริษัท ปุ๋ยศักดิ์สยาม จำกัด', 'SSI', ' 17/2 ม.2 ถ.ลาดหลุมแก้ว-บางเลน ต.ขุนศรี อ.ไทรน้อย จ.นนทบุรี ', '029219221', '029219517', 'ssi@kslgroup.com', 'ผู้ขาย', '2020-07-01 14:38:34', '0'),
(8, '08', 'บริษัท คชา เคมีการเกษตร จำกัด', 'KAC', '15/20 ซ.33 ถ.ลาดพร้าว จันทร์เกษม จตุจักร กทมฯ 10900', '025136892', '025136893', 'kacha@kslgroup.com', 'ผู้ขาย', '2020-07-01 14:41:05', '0'),
(11, '09', 'ทดสอบ จำกัด', 'TOD', ' qqqqqqqqqqqqqqqqqqqqq', '1111111111', '987654321', 'tod@mail.com', 'ผู้ซื้อ', '2020-07-08 00:00:00', '1'),
(12, '11', 'บริษัท A จำกัด', 'A', ' 888', '022222222', '022233333', 'A@kslgroup.com', 'ผู้ขาย', '2020-07-08 00:00:00', '1'),
(13, '09', 'hjggjhgfg', 'XXX', ' 7908908', '0264261910', '0988999', 'hjgjhgjh@jhkhl', 'ผู้ซื้อ', '2020-07-09 00:00:00', '0'),
(14, '10', 'บริษัท เพรสซิเดนท์ กรีนไบโอเทค จำกัด', '', ' ', '', '', '', 'ผู้ซื้อ', '2020-07-10 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mem_id` int(11) NOT NULL COMMENT 'รหัสลำดับผู้ใช้งาน',
  `mem_code` varchar(2) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
  `mem_fname` varchar(40) NOT NULL COMMENT 'ชื่อ',
  `mem_lname` varchar(40) NOT NULL COMMENT 'นามสกุล',
  `comp_code` varchar(2) NOT NULL COMMENT 'รหัสบริษัทที่สังกัด',
  `mem_email` varchar(80) NOT NULL COMMENT 'อีเมลล์',
  `mem_tel` varchar(10) NOT NULL COMMENT 'เบอร์',
  `mem_address` varchar(100) NOT NULL COMMENT 'ที่อยู่',
  `mem_username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `mem_password` varchar(60) NOT NULL COMMENT 'รหัสผ่าน',
  `mem_create_at` varchar(15) NOT NULL,
  `mem_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่ทำรายการ',
  `mem_status` enum('admin','personnel','user','operator','approver') NOT NULL DEFAULT 'user' COMMENT 'สถานะ',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag=0:use 1:notuse'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_id`, `mem_code`, `mem_fname`, `mem_lname`, `comp_code`, `mem_email`, `mem_tel`, `mem_address`, `mem_username`, `mem_password`, `mem_create_at`, `mem_date`, `mem_status`, `flag`) VALUES
(6, '01', 'จิรายุส', 'แก้วสระแสน', '01', 'jirayut@kslgroup.com', '0869316956', '     ', 'jirayut', 'jirayut', '', '0000-00-00 00:00:00', 'admin', '0'),
(7, '02', 'พีรวิชญ์', 'เครือเนตร', '01', 'phirawit@kslgroup.com', '', '  ', 'phirawit', 'phirawit', '', '0000-00-00 00:00:00', 'admin', '0'),
(8, '03', 'ธนินณัฐ', 'ชาวกล้า', '01', 'Thaninnat@kslgroup.com', '', '  ', 'thaninnat', 'thaninnat', '', '0000-00-00 00:00:00', 'admin', '0'),
(9, '04', 'สมบัติ', 'วงษ์พล', '02', 'sombat@kslgroup.com', '', '   ', 'sombat', 'sombat', '', '0000-00-00 00:00:00', 'user', '0'),
(10, '05', 'จิราภรณ์', 'พัฒนมณี', '03', 'jiraporn@kslgroup.com', '', '  ', 'jiraporn', 'jiraporn', '', '0000-00-00 00:00:00', 'user', '0'),
(11, '06', 'จิตติมา', 'กลับแสง', '04', 'jittama@kslgroup.com', '', '  ', 'jittama', 'jittama', '', '0000-00-00 00:00:00', 'user', '0'),
(12, '', 'admin', 'admin', '01', 'admin@mail.com', '0902349988', '  ', 'admin', 'admin', '', '0000-00-00 00:00:00', 'admin', '0'),
(13, '', '', '', '01', '', '', '  ', 'demo', 'demo', '', '0000-00-00 00:00:00', 'user', '0'),
(14, '07', 'วิรัตน์', 'ดำขำ', '05', 'wirat@kslgroup.com', '', ' ', 'wirat', 'wirat', '', '0000-00-00 00:00:00', 'user', '0'),
(15, '08', 'รัชดาพร', 'ลิ้วเจริญ', '06', 'ratchadaporn@kslgroup.com', '', ' ', 'ratchadaporn', 'ratchadaporn', '', '0000-00-00 00:00:00', 'user', '0'),
(16, '09', 'พรพิมล', 'เจริญศิลป์', '08', '', '', ' ', 'pornpimon', 'pornpimon', '', '0000-00-00 00:00:00', 'user', '0'),
(18, '10', 'เสาวภา', 'โพธิ์เมือง', '08', '', '', '  ', 'saowapa', 'saowapa', '', '0000-00-00 00:00:00', 'user', '0'),
(19, '11', 'คฑาธร', 'น้ำวิวัฒน์', '08', '', '', ' ', 'katathon', 'katathon', '', '0000-00-00 00:00:00', 'user', '0'),
(20, '13', 'ปัฐวี', 'บัวสะอาด', '08', '', '', ' ', 'phatawee', 'phatawee', '', '0000-00-00 00:00:00', 'user', '0'),
(21, '14', 'ศุภชัย', 'เถื่อนรัศมี', '07', '', '', ' ', 'supachai', 'supachai', '', '0000-00-00 00:00:00', 'user', '0'),
(22, '15', 'วรัตนันท์', 'กรภพสัณหภณ', '07', '', '', ' ', 'warattanan', 'warattanan', '', '0000-00-00 00:00:00', 'user', '0'),
(23, '16', 'นิรุต', 'พืชพันธ์', '07', '', '', ' ', 'niroot', 'niroot', '', '0000-00-00 00:00:00', 'user', '0'),
(24, '17', 'ทวีวัฒน์', 'ทองบุญ', '07', '', '', ' ', 'thawiwat', 'thawiwat', '', '0000-00-00 00:00:00', 'user', '0');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `new_id` int(11) NOT NULL COMMENT 'รหัสข่าว',
  `new_title` varchar(30) NOT NULL COMMENT 'หัวข้อข่าว',
  `new_image` varchar(100) NOT NULL COMMENT 'รูปข่าว',
  `new_date` date NOT NULL COMMENT 'วันที่ลงข่าว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`new_id`, `new_title`, `new_image`, `new_date`) VALUES
(3, 'KMS888', '15923958929608.jpg', '2020-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `order_shipping` varchar(2) NOT NULL,
  `price_total` int(8) NOT NULL,
  `order_status` int(1) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `mem_id`, `address`, `order_shipping`, `price_total`, `order_status`, `order_date`) VALUES
(1, '170620064420', 1, '1001/32 Thailand', '50', 6580, 4, '2020-06-17 06:44:20'),
(2, '210620080050', 1, '1001/32 Thailand', '80', 1950, 4, '2020-06-21 08:00:50'),
(3, '220620034920', 1, '1001/32 Thailand', '50', 1600, 0, '2020-06-22 03:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_number`, `product_id`, `product_price`) VALUES
(1, '170620064420', 5, 3290),
(2, '170620064420', 5, 3290),
(3, '210620080050', 20, 750),
(4, '210620080050', 16, 850),
(5, '210620080050', 17, 350),
(6, '220620034920', 20, 750),
(7, '220620034920', 16, 850);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `payment_file` varchar(100) NOT NULL,
  `payment_price` varchar(10) NOT NULL,
  `payment_bank` varchar(50) NOT NULL,
  `payment_Detail` text NOT NULL,
  `payment_date` date NOT NULL,
  `payment_time` time NOT NULL,
  `payment_status` enum('ตรวจสอบ','ชำระเรียบร้อย') NOT NULL DEFAULT 'ตรวจสอบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL COMMENT 'เลขประจำตัวสินค้า',
  `product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `product_detail` varchar(500) DEFAULT NULL COMMENT 'รายละเอียดสินค้า',
  `product_image` varchar(50) DEFAULT NULL COMMENT 'ภาพสินค้า',
  `product_code` varchar(10) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `product_price1` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `product_price2` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย2',
  `product_price3` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย3',
  `product_price4` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย4',
  `product_price5` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย5',
  `product_cost1` double(10,2) DEFAULT NULL COMMENT 'ราคาซื้อต่อหน่วย1',
  `product_cost2` double(10,2) DEFAULT NULL COMMENT 'ราคาซื้อต่อหน่วย2',
  `product_cost3` double(10,2) DEFAULT NULL COMMENT 'ราคาซื้อต่อหน่วย3',
  `product_cost4` double(10,2) DEFAULT NULL COMMENT 'ราคาซื้อต่อหน่วย4',
  `product_cost5` double(10,2) DEFAULT NULL COMMENT 'ราคาซื้อต่อหน่วย5',
  `product_unit` varchar(20) DEFAULT NULL COMMENT 'หน่วยนับสินค้า',
  `product_tag` varchar(30) DEFAULT NULL COMMENT 'หมวดสินค้า',
  `product_date` date DEFAULT NULL COMMENT 'วันที่สร้างรายการ',
  `create_by` int(11) DEFAULT NULL COMMENT 'รหัสพนักงาน',
  `flag` varchar(1) NOT NULL COMMENT 'flag=0:use 1:notuse'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_detail`, `product_image`, `product_code`, `product_price1`, `product_price2`, `product_price3`, `product_price4`, `product_price5`, `product_cost1`, `product_cost2`, `product_cost3`, `product_cost4`, `product_cost5`, `product_unit`, `product_tag`, `product_date`, `create_by`, `flag`) VALUES
(1, 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 'เป็นปุ๋ยอินทรีย์คุณภาพสูง มีสารอาหารครบถ้วน เหมาะสมสำหรับพืชไร่ โดยเฉพาะสำหรับอ้อย', '15923962135875.png', '5021000032', 330.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยอินทรีย์', '2020-06-19', 0, '0'),
(2, 'ปุ๋ยน้ำ KSL888 (500 CC.)', 'ปุ๋ยน้ำ KSL888 ใส่เพื่อบำรุงให้ต้นอ้อยแข็งแรง  ความหวานมากขึ้น  แตกกอดี  ', '15923964999677.jpg', '5021000035', 225.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'ปุ๋ยอินทรีย์', '2020-06-19', 0, '0'),
(3, 'ปุ๋ยน้ำ KSL888 (1000 CC.)', 'ปุ๋ยน้ำ KSL888 ใส่เพื่อบำรุงให้ต้นอ้อยแข็งแรง  ความหวานมากขึ้น  แตกกอดี  ', '15923974673361.jpg', '5021000034', 450.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'ปุ๋ยอินทรีย์', '2020-06-19', 0, '0'),
(4, 'ปุ๋ย ตรา Leadership 15-15-15', 'ปุ๋ย ตรา Leadership 15-15-15', '15923976469732.jpg', '5123458882', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(5, 'ปุ๋ย ตรา Leadership 1ุ6-8-8', 'ปุ๋ย ตรา Leadership 1ุ6-8-8', '15923978303812.jpg', '5123458883', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(6, 'ปุ๋ย ตรา Leadership 1ุ6-10-16', 'ปุ๋ย ตรา Leadership 1ุ6-10-16', '15923979198499.jpg', '5123458884', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(7, 'ปุ๋ย ตรา Leadership 1ุ6-16-8', 'ปุ๋ย ตรา Leadership 1ุ6-16-8', '15923981849004.jpg', '5123458885', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(8, 'ปุ๋ย ตรา Leadership 20-6-25', 'ปุ๋ย ตรา Leadership 20-6-25', '15923982973840.jpg', '5123458886', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(9, 'ปุ๋ย ตรา Leadership 21-0-0', 'ปุ๋ย ตรา Leadership 21-0-0', '15923984015146.jpg', '5123458887', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(10, 'ปุ๋ย ตรา Leadership 21-3-27', 'ปุ๋ย ตรา Leadership 21-3-27', '15923985247624.jpg', '5123458888', 900.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-07-08', 0, '0'),
(11, 'ปุ๋ย ตรา Leadership 21-7-18', 'ปุ๋ย ตรา Leadership 21-7-18', '15923986206647.jpg', '5123458889', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(12, 'ปุ๋ย ตรา Leadership 28-3-20', 'ปุ๋ย ตรา Leadership 28-3-20', '15923988824105.jpg', '5123458890', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(13, 'ปุ๋ยยูเรีย ตรา Leadership 46-0', 'ปุ๋ยยูเรีย ตรา Leadership 46-0-0', '15923989932800.jpg', '5123458891', 999.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0'),
(14, 'ไกลโฟเสท', 'ไกลโฟเสท48', '15924184577878.jpg', '5121000080', 520.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0'),
(15, 'ไซแอม คอมบี', 'ไซแอม คอมบี', '15924185800820.jpg', '5121000079', 260.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0'),
(16, 'ไซแอมกรูโฟ-เอ็กซ์', 'ไซแอมกรูโฟ-เอ็กซ์', '15924187695892.jpg', '5121000088', 410.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0'),
(17, 'ไซแอมคลอเพอร์', 'ไซแอมคลอเพอร์', '15924189420050.jpg', '5121000064', 420.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(18, 'ไซแอมฟิฟ-เอสซี', 'ไซแอมฟิฟ-เอสซี', '15924191188033.jpg', '5121000063', 430.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(19, 'คชาเพนดิ', 'คชาเพนดิ', '15924192110252.jpg', '5121000065', 225.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0'),
(20, 'คชาเอมีน-84-SL', 'คชาเอมีน-84-SL', '15924193381455.jpg', '5121000078', 150.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0'),
(21, 'คชาซิโนน', 'คชาซิโนน', '15924194405068.jpg', '5121000070', 685.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0'),
(22, 'คชาซีน80-ดับบลิวพี', 'คชาซีน80-ดับบลิวพี', '15924196447100.jpg', '5121000073', 175.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAG', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(23, 'คชาบูสเตอร์ 100 ML', 'คชาบูสเตอร์ 100 ML', '15924197294238.jpg', '5121000090', 275.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(24, 'คชายูรอน 80 SC', 'คชายูรอน 80 SC', '15924198835082.jpg', '5121000072', 300.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0'),
(25, 'คชายูรอน-80-ดับบลิวพี', 'คชายูรอน-80-ดับบลิวพี', '15924200111301.jpg', '5121000087', 285.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BOX', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(41, 'คชาสติ๊ก', 'คชาสติ๊ก', '15924201530532.jpg', '5121000091', 290.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(42, 'อะซีโทคลอร์', 'อะซีโทคลอร์', '15924202910333.jpg', '5121000071', 150.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0'),
(43, 'อะทราซีน90WDG', 'อะทราซีน90WDG', '15924204233244.jpg', '5121000074', 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BOX', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(44, 'อะทราซีนSC', 'อะทราซีนSC', '15924205472813.jpg', '5121000075', 175.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(45, 'อะมีทรีน50SC', 'อะมีทรีน50SC', '15924206569662.jpg', '5121000077', 240.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(46, 'อะมีทรีน80WDG', 'อะมีทรีน80WDG', '15924207523853.jpg', '5121000076', 280.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BOX', 'สารบำรุงดิน', '2020-06-19', 0, '0'),
(47, 'kms', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(48, 'KSL', NULL, NULL, '23233443', 888.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_tag_id` int(11) NOT NULL,
  `product_tag_name` varchar(50) NOT NULL,
  `product_tag_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`product_tag_id`, `product_tag_name`, `product_tag_date`) VALUES
(1, 'ปุ๋ยอินทรีย์', '2020-06-19'),
(2, 'ปุ๋ยเคมี', '2020-06-19'),
(3, 'สารกำจัดศัตรูพืช', '2020-06-19'),
(4, 'สารบำรุงดิน', '2020-06-19'),
(5, 'เครื่องมือการเกษตร', '2020-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `pr_detail`
--

CREATE TABLE `pr_detail` (
  `id_no` int(10) NOT NULL COMMENT 'เลขประจำตัวรายการขอซื้อ',
  `pr_detail_id` varchar(10) NOT NULL COMMENT 'หมายเลขรายการขอซื้อ',
  `pr_id` int(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `input_date` date DEFAULT NULL COMMENT 'วันที่กรอกรายการขอซื้อ',
  `input_by` int(11) DEFAULT NULL COMMENT 'รหัสผู้ทำรายการ',
  `approve_date` date DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_by` int(11) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `Quota_id` varchar(7) DEFAULT NULL COMMENT 'โค้วต้าชาวไร่/เขต',
  `Quota_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อนามสกุลโควต้า/เขต',
  `Quota_ket` varchar(3) DEFAULT NULL COMMENT 'เขตชาวไร่',
  `Quota_place` varchar(50) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `Product_code` varchar(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `Product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `Product_amount` int(10) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `Product_price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `Product_total` double(10,2) DEFAULT NULL COMMENT 'ราคาสินค้า',
  `recieve_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ส่งแล้ว',
  `remain_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ยังไม่ส่ง',
  `Invoice_date` date DEFAULT NULL COMMENT 'วันที่ใบส่งของ',
  `weightdoc_no` varchar(20) DEFAULT NULL COMMENT 'เลขที่ใบชั่ง',
  `invoice_no` varchar(20) DEFAULT NULL COMMENT 'เลขที่ใบส่งของ',
  `remark` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` varchar(1) DEFAULT NULL COMMENT 'สถานะรายการขอซื้อ',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag 0:use 1:notuse',
  `modify_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไขรายการ',
  `modify_by` int(11) DEFAULT NULL COMMENT 'แก้ไขรายการโดย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `comp`
--
ALTER TABLE `comp`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`new_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`product_tag_id`);

--
-- Indexes for table `pr_detail`
--
ALTER TABLE `pr_detail`
  ADD PRIMARY KEY (`id_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comp`
--
ALTER TABLE `comp`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับบริษัทที่เกี่ยวข้อง', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลำดับผู้ใช้งาน', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสข่าว', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวสินค้า', AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `product_tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pr_detail`
--
ALTER TABLE `pr_detail`
  MODIFY `id_no` int(10) NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวรายการขอซื้อ';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;