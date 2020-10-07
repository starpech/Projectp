-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2020 at 05:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `bo_detail`
--

CREATE TABLE `bo_detail` (
  `bo_detail_no` int(11) NOT NULL COMMENT 'ลำดับรายการส่งของ',
  `bo_main_id` varchar(5) DEFAULT NULL COMMENT 'หมายเลขใบส่งของ',
  `bo_detail_order` varchar(4) DEFAULT NULL COMMENT 'ลำดับรายการใบส่งของ',
  `product_id` varchar(10) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `product_name` varchar(50) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `quantity` int(4) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `unit_price` decimal(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `unit` varchar(25) DEFAULT NULL COMMENT 'หน่วยนับ',
  `amount` decimal(10,2) DEFAULT NULL COMMENT 'จำนวนเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bo_detail`
--

INSERT INTO `bo_detail` (`bo_detail_no`, `bo_main_id`, `bo_detail_order`, `product_id`, `product_name`, `quantity`, `unit_price`, `unit`, `amount`) VALUES
(1, '1', NULL, '5121000076', 'อะมีทรีน80WDG', 20, '30.00', 'Bottle', '600.00'),
(2, '2', NULL, '5121000076', 'อะมีทรีน80WDG', 20, '30.00', 'BOX', '600.00'),
(3, '2', NULL, '5121000090', 'คชาบูสเตอร์ 100 ML', 50, '40.00', 'BAG', '2000.00'),
(4, '3', NULL, '5121000090', 'คชาบูสเตอร์ 100 ML', 10, '10.00', 'Bottle', '100.00'),
(5, '3', NULL, '5123458886', 'ปุ๋ย ตรา Leadership 20-6-25', 5, '10.00', 'BAG', '50.00'),
(6, '4', NULL, '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 400, '300.00', 'BAG', '120000.00');

-- --------------------------------------------------------

--
-- Table structure for table `bo_main`
--

CREATE TABLE `bo_main` (
  `bo_no` int(6) NOT NULL COMMENT 'เลขลำดับรายการใบวางบิล',
  `bo_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบวางบิล',
  `bo_date` date DEFAULT current_timestamp() COMMENT 'วันที่ใบวางบิล',
  `bo_SupplierID` varchar(5) DEFAULT NULL COMMENT 'รหัสบริษัทผู้วางบิล',
  `bo_SupplierName` varchar(50) DEFAULT NULL COMMENT 'ชื่อบริษัทผู้วางบิล',
  `bo_detail_no` varchar(200) NOT NULL,
  `bo_detail_add` tinyint(4) NOT NULL DEFAULT 0,
  `remark_inv` varchar(255) DEFAULT NULL COMMENT 'กรอกหมายเลขใบส่งของ',
  `site_no` varchar(2) NOT NULL,
  `flag_delete` tinyint(4) NOT NULL DEFAULT 0,
  `bo_DeliveryTo` varchar(50) NOT NULL,
  `bo_RecieveName` varchar(10) NOT NULL,
  `bo_RecieveID` varchar(100) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bo_main`
--

INSERT INTO `bo_main` (`bo_no`, `bo_id`, `bo_date`, `bo_SupplierID`, `bo_SupplierName`, `bo_detail_no`, `bo_detail_add`, `remark_inv`, `site_no`, `flag_delete`, `bo_DeliveryTo`, `bo_RecieveName`, `bo_RecieveID`, `approved`) VALUES
(1, 'PN63640001', '2020-10-04', '06', 'บริษัท น้ำตาลขอนแก่น จำกัด(สาขาวังสะพุง)', '', 1, NULL, '06', 1, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', '', '', 0),
(2, 'PN63640002', '2020-10-04', '06', 'บริษัท น้ำตาลนิวกว้างสุ้นหลี จำกัด', '', 1, '12345', '06', 0, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', 'บริษัท น้ำ', '02', 1),
(3, 'PN63640003', '2020-10-04', '06', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', '', 1, '99999', '06', 0, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', 'บริษัท น้ำ', '04', 1),
(4, 'PN63640004', '2020-10-05', '06', 'บริษัท ปุ๋ยศักดิ์สยาม จำกัด', '', 1, '889988', '06', 0, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', 'บริษัท เคเ', '01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bo_main_uploads`
--

CREATE TABLE `bo_main_uploads` (
  `id` int(11) NOT NULL,
  `bo_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bo_image_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bo_image_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bo_main_uploads`
--

INSERT INTO `bo_main_uploads` (`id`, `bo_id`, `bo_image_path`, `bo_image_title`) VALUES
(0, 'PN63640002', 'upload_doc_img/18828212385f797b1a0e035.jpg', 'ปปป');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `cart_date` datetime NOT NULL DEFAULT current_timestamp()
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
  `comp_date` datetime DEFAULT current_timestamp() COMMENT 'วันที่ทำรายการ',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag=0:use 1:notuse'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางบริษัท';

--
-- Dumping data for table `comp`
--

INSERT INTO `comp` (`comp_id`, `comp_code`, `comp_name`, `comp_nickname`, `comp_addr`, `comp_tel`, `comp_fax`, `comp_email`, `comp_type`, `comp_date`, `flag`) VALUES
(1, '01', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', 'KMS', '     503 อาคาร เคเอสแอล ทาวเวอร์ ชั้น 16 ถนนศรีอยุธยา แขวงถนนพญาไท เขตราชเทวี กรุงเทพมหานคร 10400\r\n', '026426191-9', '026426097', 'kms_admin@klgroup.com', 'บริษัท', '2020-06-25 00:00:00', '0'),
(2, '02', 'บริษัท น้ำตาลขอนแก่น จำกัด (สาขาน้ำพอง)', 'NP', '     43 หมู่ 10 ถ.น้ำพอง-กระนวน  ตำบลน้ำพอง อำเภอน้ำพอง จังหวัดขอนแก่น ', '0434329026', '043432907', 'kslnp@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:08:09', '0'),
(3, '03', 'บริษัท น้ำตาลขอนแก่น จำกัด(สาขาวังสะพุง)', 'WP', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', '0428109313', '0428109313', 'kslwp@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:13:26', '0'),
(4, '04', 'บริษัท น้ำตาลนิวกรุงไทย จำกัด (สาขาบ่อพลอย)', 'BP', '  99 ม.6 ต.หลุมรัง อ.บ่อพลอย จ.กาญจนบุรี ', '034615350', '034615399', 'kslbp@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:21:32', '0'),
(5, '05', 'บริษัท น้ำตาลท่ามะกา จำกัด', 'TK', '14/1 ม.10 ต.ท่ามะกา อ.ท่ามะกา จ.กาญจนบุรี 71120', '034543201', '034640208', 'ksltk@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:25:27', '0'),
(6, '06', 'บริษัท น้ำตาลนิวกว้างสุ้นหลี จำกัด', 'PN', ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', '038788203', '038462431', 'kslpn@kslgroup.com', 'ผู้ซื้อ', '2020-07-01 14:36:09', '0'),
(7, '07', 'บริษัท ปุ๋ยศักดิ์สยาม จำกัด', 'SS', ' 17/2 ม.2 ถ.ลาดหลุมแก้ว-บางเลน ต.ขุนศรี อ.ไทรน้อย จ.นนทบุรี ', '029219221', '029219517', 'ssi@kslgroup.com', 'ผู้ขาย', '2020-07-01 14:38:34', '0'),
(8, '08', 'บริษัท คชา เคมีการเกษตร จำกัด', 'KC', '15/20 ซ.33 ถ.ลาดพร้าว จันทร์เกษม จตุจักร กทมฯ 10900', '025136892', '025136893', 'kacha@kslgroup.com', 'ผู้ขาย', '2020-07-01 14:41:05', '0'),
(11, '09', 'ทดสอบ จำกัด', 'TOD', ' qqqqqqqqqqqqqqqqqqqqq', '1111111111', '987654321', 'tod@mail.com', 'ผู้ซื้อ', '2020-07-08 00:00:00', '1'),
(12, '11', 'บริษัท A จำกัด', 'A', ' 888', '022222222', '022233333', 'A@kslgroup.com', 'ผู้ขาย', '2020-07-08 00:00:00', '1'),
(13, '09', 'hjggjhgfg', 'XXX', ' 7908908', '0264261910', '0988999', 'hjgjhgjh@jhkhl', 'ผู้ซื้อ', '2020-07-09 00:00:00', '0'),
(14, '10', 'บริษัท เพรสซิเดนท์ กรีนไบโอเทค จำกัด', '', ' ', '', '', '', 'ผู้ซื้อ', '2020-07-10 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `inv_detail`
--

CREATE TABLE `inv_detail` (
  `inv_detail_no` int(11) NOT NULL COMMENT 'ลำดับรายการส่งของ',
  `inv_main_id` varchar(5) DEFAULT NULL COMMENT 'หมายเลขใบส่งของ',
  `inv_detail_order` varchar(4) DEFAULT NULL COMMENT 'ลำดับรายการใบส่งของ',
  `product_id` varchar(10) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `product_name` varchar(50) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `quantity` int(4) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `unit_price` decimal(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `unit` varchar(25) DEFAULT NULL COMMENT 'หน่วยนับ',
  `amount` decimal(10,2) DEFAULT NULL COMMENT 'จำนวนเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inv_detail`
--

INSERT INTO `inv_detail` (`inv_detail_no`, `inv_main_id`, `inv_detail_order`, `product_id`, `product_name`, `quantity`, `unit_price`, `unit`, `amount`) VALUES
(1, '1', NULL, '5121000080', 'ไกลโฟเสท', 10, '10.00', 'Bottle', '100.00'),
(2, '2', NULL, '5121000080', 'ไกลโฟเสท', 120, '100.00', 'Bottle', '12000.00'),
(3, '2', NULL, '5121000080', 'ไกลโฟเสท', 50, '30.00', 'Bottle', '1500.00'),
(4, '3', NULL, '5121000080', 'ไกลโฟเสท', 120, '100.00', 'Bottle', '12000.00'),
(5, '3', NULL, '5121000080', 'ไกลโฟเสท', 50, '30.00', 'Bottle', '1500.00'),
(6, '4', NULL, '5121000087', 'คชายูรอน-80-ดับบลิวพี', 10, '20.00', 'BOX', '200.00'),
(7, '4', NULL, '5121000065', 'คชาเพนดิ', 50, '5.00', 'Bottle', '250.00'),
(8, '5', NULL, '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 100, '300.00', 'BAG', '30000.00'),
(9, '5', NULL, '5123458884', 'ปุ๋ย ตรา Leadership 1ุ6-10-16', 50, '300.00', 'BAG', '15000.00'),
(10, '7', NULL, '5121000080', 'ไกลโฟเสท', 100, '50.00', 'Bottle', '5000.00'),
(11, '8', NULL, '5121000079', 'ไซแอม คอมบี', 10, '11.00', 'BAG', '110.00'),
(12, '8', NULL, '5121000080', 'ไกลโฟเสท', 1, '100.00', 'Bottle', '100.00'),
(13, '9', NULL, '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 150, '300.00', 'BAG', '45000.00');

-- --------------------------------------------------------

--
-- Table structure for table `inv_main`
--

CREATE TABLE `inv_main` (
  `inv_no` int(6) NOT NULL COMMENT 'เลขลำดับรายการ',
  `inv_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบส่งของ',
  `inv_date` date DEFAULT current_timestamp() COMMENT 'วันที่ใบส่งของ',
  `inv_SupplierID` varchar(5) DEFAULT NULL COMMENT 'รหัสบริษัทผู้ส่งของ',
  `inv_SupplierName` varchar(50) DEFAULT NULL COMMENT 'ชื่อบริษัทผู้ส่งของ',
  `inv_RecieveID` varchar(5) DEFAULT NULL COMMENT 'รหัสบริษัทผู้รับของ',
  `inv_RecieveName` varchar(50) DEFAULT NULL COMMENT 'ชื่อบริษัทผู้รับของ',
  `inv_DeliveryTo` varchar(50) DEFAULT NULL COMMENT 'ส่งมอบที่',
  `inv_TermPayment` varchar(15) DEFAULT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `inv_DeliveryDate` varchar(15) DEFAULT NULL COMMENT 'กำหนดส่งของ',
  `inv_detail_no` varchar(200) NOT NULL,
  `inv_detail_add` tinyint(4) NOT NULL DEFAULT 0,
  `site_no` varchar(2) NOT NULL,
  `remark_po` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุกรอกหมายเลขpr/po',
  `flag_delete` tinyint(4) NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inv_main`
--

INSERT INTO `inv_main` (`inv_no`, `inv_id`, `inv_date`, `inv_SupplierID`, `inv_SupplierName`, `inv_RecieveID`, `inv_RecieveName`, `inv_DeliveryTo`, `inv_TermPayment`, `inv_DeliveryDate`, `inv_detail_no`, `inv_detail_add`, `site_no`, `remark_po`, `flag_delete`, `approved`) VALUES
(1, 'PN63640001', '2020-10-02', '06', 'บริษัท น้ำตาลนิวกว้างสุ้นหลี จำกัด', NULL, NULL, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '', 1, '06', NULL, 1, 0),
(2, 'PN63640002', '2020-10-02', '06', 'บริษัท น้ำตาลนิวกว้างสุ้นหลี จำกัด', NULL, NULL, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '', 1, '06', NULL, 1, 0),
(3, 'PN63640003', '2020-10-02', '06', 'บริษัท น้ำตาลนิวกว้างสุ้นหลี จำกัด', NULL, NULL, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '', 1, '06', NULL, 1, 0),
(4, 'PN63640004', '2020-10-20', '06', 'บริษัท น้ำตาลนิวกว้างสุ้นหลี จำกัด', NULL, NULL, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '', 1, '06', NULL, 0, 1),
(5, 'PN63640005', '2020-10-02', '06', 'บริษัท น้ำตาลขอนแก่น จำกัด (สาขาน้ำพอง)', NULL, NULL, ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '', 1, '06', NULL, 0, 1),
(7, 'PN63640006', '2020-10-04', '06', 'บริษัท น้ำตาลนิวกว้างสุ้นหลี จำกัด', '04', 'บริษัท น้ำตาลนิวกรุงไทย จำกัด (สาขาบ่อพลอย)', ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '', 1, '06', '1234xxxxx', 0, 1),
(8, 'PN63640007', '2020-10-04', '06', 'บริษัท น้ำตาลขอนแก่น จำกัด(สาขาวังสะพุง)', '04', 'บริษัท น้ำตาลนิวกรุงไทย จำกัด (สาขาบ่อพลอย)', ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '', 1, '06', '12345555', 0, 1),
(9, 'PN63640008', '2020-10-04', '06', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', '03', 'บริษัท น้ำตาลขอนแก่น จำกัด(สาขาวังสะพุง)', ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '', 1, '06', '98765', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_main_uploads`
--

CREATE TABLE `inv_main_uploads` (
  `id` int(11) NOT NULL,
  `inv_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `inv_image_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inv_image_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inv_main_uploads`
--

INSERT INTO `inv_main_uploads` (`id`, `inv_id`, `inv_image_path`, `inv_image_title`) VALUES
(1, 'PN63640004', 'upload_doc_img/21417256515f76ebbc33e6a.jpg', 'ทดสอบ'),
(3, 'PN63640004', 'upload_doc_img/18791663865f76f4055cac3.jpg', 'dddd'),
(4, 'PN63640004', 'upload_doc_img/9589533765f76f5229c65c.jpg', ''),
(5, 'PN63640005', 'upload_doc_img/6561613895f76fd8952dc6.jpg', '');

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
  `mem_email` varchar(50) NOT NULL COMMENT 'อีเมลล์',
  `mem_tel` varchar(10) NOT NULL COMMENT 'เบอร์',
  `mem_address` varchar(100) NOT NULL COMMENT 'ที่อยู่',
  `mem_username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `mem_password` varchar(60) NOT NULL COMMENT 'รหัสผ่าน',
  `mem_create_at` varchar(15) NOT NULL,
  `mem_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่ทำรายการ',
  `mem_status` enum('admin','operator','approver','officer','sale','acc','plant') NOT NULL DEFAULT 'operator' COMMENT 'สถานะ',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag=0:use 1:notuse'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_id`, `mem_code`, `mem_fname`, `mem_lname`, `comp_code`, `mem_email`, `mem_tel`, `mem_address`, `mem_username`, `mem_password`, `mem_create_at`, `mem_date`, `mem_status`, `flag`) VALUES
(6, '01', 'จิรายุส', 'แก้วสระแสน', '01', 'jirayut@kslgroup.com', '0869316956', '     ', 'jirayut', 'jirayut', '', '0000-00-00 00:00:00', 'admin', '0'),
(7, '02', 'พีรวิชญ์', 'เครือเนตร', '01', 'phirawit@kslgroup.com', '', '   ', 'phirawit', 'phirawit', '', '0000-00-00 00:00:00', 'officer', '0'),
(8, '03', 'ธนินณัฐ', 'ชาวกล้า', '01', 'Thaninnat@kslgroup.com', '', '  ', 'thaninnat', 'thaninnat', '', '0000-00-00 00:00:00', 'officer', '0'),
(9, '04', 'สมบัติ', 'วงษ์พล', '06', 'sombat@kslgroup.com', '', '   ', 'sombat', 'sombat', '', '0000-00-00 00:00:00', 'approver', '0'),
(10, '05', 'จิราภรณ์', 'พัฒนมณี', '03', 'jiraporn@kslgroup.com', '', '  ', 'jiraporn', 'jiraporn', '', '0000-00-00 00:00:00', 'operator', '0'),
(11, '06', 'จิตติมา', 'กลับแสง', '04', 'jittama@kslgroup.com', '', '  ', 'jittama', 'jittama', '', '0000-00-00 00:00:00', 'approver', '0'),
(12, '07', 'จิรายุส', 'แก้วสระแสน', '01', 'jirayut@kslgroup.com', '0902349988', '  ', 'admin', 'admin', '', '0000-00-00 00:00:00', 'admin', '0'),
(13, '08', 'สารัช', 'ชุณหโรจน์ฤทธิ์', '06', 'sarat@kslgroup.com', '', '    ', 'demo', 'demo', '', '0000-00-00 00:00:00', 'operator', '0'),
(14, '09', 'วิรัตน์', 'ดำขำ', '05', 'wirat@kslgroup.com', '', ' ', 'wirat', 'wirat', '', '0000-00-00 00:00:00', 'approver', '0'),
(15, '10', 'รัชดาพร', 'ลิ้วเจริญ', '06', 'ratchadaporn@kslgroup.com', '', '   ', 'ratchadaporn', 'ratchadaporn', '', '0000-00-00 00:00:00', 'approver', '0'),
(16, '11', 'พรพิมล', 'เจริญศิลป์', '02', '', '', '  ', 'pornpimon', 'pornpimon', '', '0000-00-00 00:00:00', 'acc', '0'),
(18, '12', 'เสาวภา', 'โพธิ์เมือง', '02', '', '', '   ', 'saowapa', 'saowapa', '', '0000-00-00 00:00:00', 'sale', '0'),
(19, '13', 'คฑาธร', 'น้ำวิวัฒน์', '08', '', '', ' ', 'katathon', 'katathon', '', '0000-00-00 00:00:00', 'operator', '0'),
(20, '14', 'ปัฐวี', 'บัวสะอาด', '08', '', '', ' ', 'phatawee', 'phatawee', '', '0000-00-00 00:00:00', 'operator', '0'),
(21, '15', 'ศุภชัย', 'เถื่อนรัศมี', '07', '', '', ' ', 'supachai', 'supachai', '', '0000-00-00 00:00:00', 'operator', '0'),
(22, '16', 'วรัตนันท์', 'กรภพสัณหภณ', '07', '', '', ' ', 'warattanan', 'warattanan', '', '0000-00-00 00:00:00', 'operator', '0'),
(23, '17', 'นิรุต', 'พืชพันธ์', '07', '', '', ' ', 'niroot', 'niroot', '', '0000-00-00 00:00:00', 'operator', '0'),
(24, '18', 'ทวีวัฒน์', 'ทองบุญ', '07', '', '', ' ', 'thawiwat', 'thawiwat', '', '0000-00-00 00:00:00', 'operator', '0');

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
  `comp_code` varchar(2) DEFAULT NULL COMMENT 'เป็นสินค้าของบริษัท',
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
  `flag` varchar(1) NOT NULL COMMENT 'flag=0:use 1:notuse',
  `product_price6` double NOT NULL,
  `product_cost6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `comp_code`, `product_name`, `product_detail`, `product_image`, `product_code`, `product_price1`, `product_price2`, `product_price3`, `product_price4`, `product_price5`, `product_cost1`, `product_cost2`, `product_cost3`, `product_cost4`, `product_cost5`, `product_unit`, `product_tag`, `product_date`, `create_by`, `flag`, `product_price6`, `product_cost6`) VALUES
(1, '01', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 'เป็นปุ๋ยอินทรีย์คุณภาพสูง มีสารอาหารครบถ้วน เหมาะสมสำหรับพืชไร่ โดยเฉพาะสำหรับอ้อย', '15923962135875.png', '5021000032', 50.00, 0.00, 30.00, 0.00, 0.00, 100.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยอินทรีย์', '2020-06-19', 0, '0', 0, 0),
(2, '01', 'ปุ๋ยน้ำ KSL888 (500 CC.)', 'ปุ๋ยน้ำ KSL888 ใส่เพื่อบำรุงให้ต้นอ้อยแข็งแรง  ความหวานมากขึ้น  แตกกอดี  ', '15923964999677.jpg', '5021000035', 225.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'ปุ๋ยอินทรีย์', '2020-06-19', 0, '0', 0, 0),
(3, '01', 'ปุ๋ยน้ำ KSL888 (1000 CC.)', 'ปุ๋ยน้ำ KSL888 ใส่เพื่อบำรุงให้ต้นอ้อยแข็งแรง  ความหวานมากขึ้น  แตกกอดี  ', '15923974673361.jpg', '5021000034', 450.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'ปุ๋ยอินทรีย์', '2020-06-19', 0, '0', 0, 0),
(4, '07', 'ปุ๋ย ตรา Leadership 15-15-15', 'ปุ๋ย ตรา Leadership 15-15-15', '15923976469732.jpg', '5123458882', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(5, '07', 'ปุ๋ย ตรา Leadership 1ุ6-8-8', 'ปุ๋ย ตรา Leadership 1ุ6-8-8', '15923978303812.jpg', '5123458883', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(6, '07', 'ปุ๋ย ตรา Leadership 1ุ6-10-16', 'ปุ๋ย ตรา Leadership 1ุ6-10-16', '15923979198499.jpg', '5123458884', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(7, '07', 'ปุ๋ย ตรา Leadership 1ุ6-16-8', 'ปุ๋ย ตรา Leadership 1ุ6-16-8', '15923981849004.jpg', '5123458885', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(8, '07', 'ปุ๋ย ตรา Leadership 20-6-25', 'ปุ๋ย ตรา Leadership 20-6-25', '15923982973840.jpg', '5123458886', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(9, '07', 'ปุ๋ย ตรา Leadership 21-0-0', 'ปุ๋ย ตรา Leadership 21-0-0', '15923984015146.jpg', '5123458887', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(11, '07', 'ปุ๋ย ตรา Leadership 21-7-18', 'ปุ๋ย ตรา Leadership 21-7-18', '15923986206647.jpg', '5123458889', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(12, '07', 'ปุ๋ย ตรา Leadership 28-3-20', 'ปุ๋ย ตรา Leadership 28-3-20', '15923988824105.jpg', '5123458890', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(13, '07', 'ปุ๋ยยูเรีย ตรา Leadership 46-0', 'ปุ๋ยยูเรีย ตรา Leadership 46-0-0', '15923989932800.jpg', '5123458891', 999.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'ปุ๋ยเคมี', '2020-06-19', 0, '0', 0, 0),
(14, '08', 'ไกลโฟเสท', 'ไกลโฟเสท48', '15924184577878.jpg', '5121000080', 520.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0', 0, 0),
(15, '08', 'ไซแอม คอมบี', 'ไซแอม คอมบี', '15924185800820.jpg', '5121000079', 260.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0', 0, 0),
(16, '08', 'ไซแอมกรูโฟ-เอ็กซ์', 'ไซแอมกรูโฟ-เอ็กซ์', '15924187695892.jpg', '5121000088', 410.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0', 0, 0),
(17, '08', 'ไซแอมคลอเพอร์', 'ไซแอมคลอเพอร์', '15924189420050.jpg', '5121000064', 420.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(18, '08', 'ไซแอมฟิฟ-เอสซี', 'ไซแอมฟิฟ-เอสซี', '15924191188033.jpg', '5121000063', 430.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(19, '08', 'คชาเพนดิ', 'คชาเพนดิ', '15924192110252.jpg', '5121000065', 225.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0', 0, 0),
(20, '08', 'คชาเอมีน-84-SL', 'คชาเอมีน-84-SL', '15924193381455.jpg', '5121000078', 150.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0', 0, 0),
(21, '08', 'คชาซิโนน', 'คชาซิโนน', '15924194405068.jpg', '5121000070', 685.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0', 0, 0),
(22, '08', 'คชาซีน80-ดับบลิวพี', 'คชาซีน80-ดับบลิวพี', '15924196447100.jpg', '5121000073', 175.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BAG', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(23, '08', 'คชาบูสเตอร์ 100 ML', 'คชาบูสเตอร์ 100 ML', '15924197294238.jpg', '5121000090', 275.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(24, '08', 'คชายูรอน 80 SC', 'คชายูรอน 80 SC', '15924198835082.jpg', '5121000072', 300.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0', 0, 0),
(25, '08', 'คชายูรอน-80-ดับบลิวพี', 'คชายูรอน-80-ดับบลิวพี', '15924200111301.jpg', '5121000087', 285.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BOX', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(41, '08', 'คชาสติ๊ก', 'คชาสติ๊ก', '15924201530532.jpg', '5121000091', 290.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(42, '08', 'อะซีโทคลอร์', 'อะซีโทคลอร์', '15924202910333.jpg', '5121000071', 150.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารกำจัดศัตรูพืช', '2020-06-19', 0, '0', 0, 0),
(43, '08', 'อะทราซีน90WDG', 'อะทราซีน90WDG', '15924204233244.jpg', '5121000074', 200.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BOX', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(44, '08', 'อะทราซีนSC', 'อะทราซีนSC', '15924205472813.jpg', '5121000075', 175.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(45, '08', 'อะมีทรีน50SC', 'อะมีทรีน50SC', '15924206569662.jpg', '5121000077', 240.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'Bottle', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(46, '08', 'อะมีทรีน80WDG', 'อะมีทรีน80WDG', '15924207523853.jpg', '5121000076', 280.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, 'BOX', 'สารบำรุงดิน', '2020-06-19', 0, '0', 0, 0),
(49, NULL, 'logo', 'logo', '16011234833948.png', '999999', 10.00, 20.00, 30.00, 40.00, 50.00, 60.00, 70.00, 80.00, 90.00, 100.00, NULL, 'เครื่องมือการเกษตร', '2020-09-28', NULL, '', 0, 0);

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
  `pr_detail_no` int(11) NOT NULL COMMENT 'ลำดับรายการขอซื้อ',
  `pr_main_id` varchar(5) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `pr_detail_order` varchar(4) DEFAULT NULL COMMENT 'ลำดับรายการใบขอซื้อ',
  `product_id` varchar(10) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `product_name` varchar(50) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `quantity` int(4) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `unit_price` decimal(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `unit` varchar(25) DEFAULT NULL COMMENT 'หน่วยนับ',
  `amount` decimal(10,2) DEFAULT NULL COMMENT 'จำนวนเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pr_detail`
--

INSERT INTO `pr_detail` (`pr_detail_no`, `pr_main_id`, `pr_detail_order`, `product_id`, `product_name`, `quantity`, `unit_price`, `unit`, `amount`) VALUES
(1, '1', NULL, '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 60, '330.00', 'BAG', '19800.00'),
(2, '2', NULL, '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 10, '999.00', 'BAG', '9990.00'),
(3, '2', NULL, '5123458886', 'ปุ๋ย ตรา Leadership 20-6-25', 5, '999.00', 'BAG', '4995.00'),
(5, '3', NULL, '5121000078', 'คชาเอมีน-84-SL', 10, '150.00', 'Bottle', '1500.00'),
(6, '3', NULL, '5121000080', 'ไกลโฟเสท', 30, '520.00', 'Bottle', '15600.00'),
(11, '8', NULL, '5121000076', 'อะมีทรีน80WDG', 22, '30.00', 'BOX', '660.00'),
(12, '8', NULL, '5121000087', 'คชายูรอน-80-ดับบลิวพี', 10, '30.00', 'BOX', '300.00'),
(13, '9', NULL, '5121000088', 'ไซแอมกรูโฟ-เอ็กซ์', 30, '30.00', 'Bottle', '900.00'),
(14, '9', NULL, '5121000087', 'คชายูรอน-80-ดับบลิวพี', 10, '30.00', 'BOX', '300.00'),
(15, '10', NULL, '5121000080', 'ไกลโฟเสท', 66, '30.00', 'Bottle', '1980.00'),
(16, '11', NULL, '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 100, '20.00', 'BAG', '2000.00'),
(17, '12', NULL, '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 50, '20.00', 'BAG', '1000.00'),
(18, '13', NULL, '5121000087', 'คชายูรอน-80-ดับบลิวพี', 20, '20.00', 'BOX', '400.00'),
(19, '14', NULL, '5121000072', 'คชายูรอน 80 SC', 300, '30.00', 'Bottle', '9000.00'),
(20, '14', NULL, '5121000080', 'ไกลโฟเสท', 10, '30.00', 'Bottle', '300.00'),
(21, '15', NULL, '5121000063', 'ไซแอมฟิฟ-เอสซี', 30, '30.00', 'Bottle', '900.00'),
(22, '15', NULL, '5121000065', 'คชาเพนดิ', 40, '30.00', 'Bottle', '1200.00'),
(23, '16', NULL, '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 500, '30.00', 'BAG', '15000.00'),
(24, '16', NULL, '5021000034', 'ปุ๋ยน้ำ KSL888 (1000 CC.)', 200, '30.00', 'Bottle', '6000.00'),
(25, '17', NULL, '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 50, '0.00', 'BAG', '0.00'),
(26, '18', NULL, '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 50, '20.00', 'BAG', '1000.00'),
(27, '18', NULL, '5123458884', 'ปุ๋ย ตรา Leadership 1ุ6-10-16', 30, '20.00', 'BAG', '600.00'),
(28, '18', NULL, '5123458886', 'ปุ๋ย ตรา Leadership 20-6-25', 20, '20.00', 'BAG', '400.00'),
(29, '20', NULL, '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 250, '0.00', 'BAG', '0.00'),
(30, '21', NULL, '5123458884', 'ปุ๋ย ตรา Leadership 1ุ6-10-16', 100, '50.00', 'BAG', '5000.00'),
(31, '22', NULL, '5121000071', 'อะซีโทคลอร์', 190, '50.00', 'Bottle', '9500.00'),
(32, '22', NULL, '5121000079', 'ไซแอม คอมบี', 50, '50.00', 'BAG', '2500.00');

-- --------------------------------------------------------

--
-- Table structure for table `pr_main`
--

CREATE TABLE `pr_main` (
  `pr_no` int(6) NOT NULL COMMENT 'เลขลำดับรายการ',
  `pr_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `pr_date` date DEFAULT current_timestamp() COMMENT 'วันที่ใบขอซื้อ',
  `pr_SupplierID` varchar(5) DEFAULT NULL COMMENT 'รหัสผู้จำหน่าย',
  `pr_SupplierName` varchar(50) DEFAULT NULL COMMENT 'ชื่อผู้จำหน่าย',
  `pr_DeliveryTo` varchar(50) DEFAULT NULL COMMENT 'ส่งมอบที่',
  `pr_TermPayment` varchar(15) DEFAULT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `pr_DeliveryDate` varchar(15) DEFAULT NULL COMMENT 'กำหนดส่งของ',
  `pr_detail_no` varchar(200) NOT NULL,
  `pr_detail_add` tinyint(4) NOT NULL DEFAULT 0,
  `site_no` varchar(2) NOT NULL,
  `pr_approveto_po` varchar(1) DEFAULT NULL,
  `flag_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pr_main`
--

INSERT INTO `pr_main` (`pr_no`, `pr_id`, `pr_date`, `pr_SupplierID`, `pr_SupplierName`, `pr_DeliveryTo`, `pr_TermPayment`, `pr_DeliveryDate`, `pr_detail_no`, `pr_detail_add`, `site_no`, `pr_approveto_po`, `flag_delete`) VALUES
(1, 'NP63640001', '2020-09-22', '01', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', '     43 หมู่ 10 ถ.น้ำพอง-กระนวน  ตำบลน้ำพอง อำเภอน', NULL, NULL, '0000001,0000007', 1, '02', NULL, 0),
(2, 'NP63640002', '2020-09-21', '08', 'บริษัท คชา เคมีการเกษตร จำกัด', '     43 หมู่ 10 ถ.น้ำพอง-กระนวน  ตำบลน้ำพอง อำเภอน', NULL, NULL, '0000002,0000004,0000006', 1, '02', NULL, 0),
(3, 'NP63640003', '2020-09-27', '08', 'บริษัท คชา เคมีการเกษตร จำกัด', '     43 หมู่ 10 ถ.น้ำพอง-กระนวน  ตำบลน้ำพอง อำเภอน', NULL, NULL, '0000003,0000005', 1, '02', NULL, 0),
(8, 'WP63640001', '2020-09-27', '03', 'บริษัท น้ำตาลนิวกรุงไทย จำกัด (สาขาบ่อพลอย)', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '', 1, '03', NULL, 0),
(9, 'WP63640002', '2020-09-27', '03', 'บริษัท น้ำตาลขอนแก่น จำกัด(สาขาวังสะพุง)', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '', 1, '03', NULL, 0),
(10, 'WP63640003', '2020-09-27', '03', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '', 1, '03', NULL, 0),
(11, 'WP63640004', '2020-09-28', '01', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '0000004,0000005', 1, '03', NULL, 0),
(12, 'WP63640005', '2020-09-28', '07', 'บริษัท ปุ๋ยศักดิ์สยาม จำกัด', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '0000006', 1, '03', NULL, 0),
(13, 'WP63640006', '2020-09-28', '08', 'บริษัท คชา เคมีการเกษตร จำกัด', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '0000007', 1, '03', NULL, 0),
(14, 'WP63640007', '2020-09-28', '03', 'บริษัท น้ำตาลขอนแก่น จำกัด(สาขาวังสะพุง)', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '', 1, '03', NULL, 0),
(15, 'WP63640008', '2020-09-30', '03', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '', 1, '03', NULL, 0),
(16, 'WP63640009', '2020-10-01', '03', 'บริษัท น้ำตาลขอนแก่น จำกัด (สาขาน้ำพอง)', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '', 1, '03', NULL, 0),
(17, 'WP63640010', '2020-10-01', '01', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '0000013', 1, '03', NULL, 0),
(18, 'WP63640011', '2020-10-01', '07', 'บริษัท ปุ๋ยศักดิ์สยาม จำกัด', ' 225 ม.4 ต.หนองหญ้าปล้อง วังสะพุง เลย', NULL, NULL, '0000009,0000010,0000011', 1, '03', NULL, 0),
(20, 'PN63640001', '2020-10-01', '01', 'บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด', ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '0000001,0000002,0000004', 1, '06', NULL, 0),
(21, 'PN63640002', '2020-10-01', '07', 'บริษัท ปุ๋ยศักดิ์สยาม จำกัด', ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '0000003', 1, '06', NULL, 1),
(22, 'PN63640003', '2020-10-01', '08', 'บริษัท คชา เคมีการเกษตร จำกัด', ' 24 ม.1 ถ.บ้านหนองบัว ต.หมอนนาง อ.พนัสนิคม ชลบุรี', NULL, NULL, '0000005,0000006', 1, '06', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pr_main_uploads`
--

CREATE TABLE `pr_main_uploads` (
  `id` int(11) NOT NULL,
  `pr_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pr_image_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pr_image_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pr_main_uploads`
--

INSERT INTO `pr_main_uploads` (`id`, `pr_id`, `pr_image_path`, `pr_image_title`) VALUES
(1, 'NP63640001', 'upload_doc_img/233921375f74355a0f0d4.jpg', 'ทดสอบ'),
(4, 'NP63640001', 'upload_doc_img/2186707065f7442803273a.jpg', 'ทดสอบ 001'),
(5, 'NP63640002', 'upload_doc_img/18876137445f7454ea0660a.jpg', 'fffgsdfgs'),
(7, 'NP63640002', 'upload_doc_img/3017709645f7456b0afa04.jpg', 'ฟกฟกฟกฟ'),
(8, 'NP63640003', 'upload_doc_img/164228855f74576c1d4e3.jpg', ''),
(9, 'NP63640003', 'upload_doc_img/20644141185f7457a0a6919.jpg', 'beauty'),
(10, 'NP63640003', 'upload_doc_img/14038010835f7457d832dc1.jpg', ''),
(12, 'WP63640004', 'upload_doc_img/15792436145f745d3b33e3f.jpg', 'beauty01'),
(13, 'WP63640004', 'upload_doc_img/5698667415f745d51e4240.jpg', 'beauty02'),
(15, 'WP63640009', 'upload_doc_img/8095564915f754d9908da8.jpg', ''),
(16, 'NP63640001', 'upload_doc_img/21412869985f769942c09e1.jpg', ''),
(17, 'NP63640001', 'upload_doc_img/12298178625f76997662df2.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `req_detail`
--

CREATE TABLE `req_detail` (
  `id_no` int(10) NOT NULL COMMENT 'เลขประจำตัวรายการขอซื้อ',
  `req_detail_id` varchar(10) NOT NULL COMMENT 'หมายเลขรายการขอซื้อ',
  `req_id` int(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `req_comp_code` varchar(2) DEFAULT NULL COMMENT 'รหัสบริษัทที่ออกรายการขอซื้อ',
  `input_date` date DEFAULT NULL COMMENT 'วันที่ทำรายการ',
  `input_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้ทำรายการ',
  `approve` varchar(1) DEFAULT NULL COMMENT 'อนุมัติหรือยัง',
  `approve_date` date DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `Quota_id` varchar(7) DEFAULT NULL COMMENT 'โค้วต้าชาวไร่/เขต',
  `Quota_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อนามสกุลโควต้า/เขต',
  `Quota_ket` varchar(3) DEFAULT NULL COMMENT 'เขตชาวไร่',
  `Quota_place` varchar(50) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `comp_code` varchar(2) DEFAULT NULL COMMENT 'เป็นสินค้าของบริษัท',
  `Product_code` varchar(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `Product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `Product_amount` int(10) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `Product_price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `Product_total` double(10,2) DEFAULT NULL COMMENT 'ราคาสินค้า',
  `recieve_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ส่งแล้ว',
  `remain_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ยังไม่ส่ง',
  `remark` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` varchar(1) DEFAULT NULL COMMENT 'สถานะรายการขอซื้อ NULL:ยังไม่ทำอะไร 1:สร้างใบขอซื้อแล้ว 2:สร้างใบสั่งซื้อแล้ว',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag 0:use 1:notuse',
  `pr_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `modify_date` date DEFAULT NULL COMMENT 'วันที่แก้ไขรายการ',
  `modify_by` int(11) DEFAULT NULL COMMENT 'แก้ไขรายการโดย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `req_detail01`
--

CREATE TABLE `req_detail01` (
  `id_no` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขประจำตัวรายการขอซื้อ',
  `req_detail_id` varchar(10) NOT NULL COMMENT 'หมายเลขรายการขอซื้อ',
  `req_id` int(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `req_comp_code` varchar(2) DEFAULT NULL COMMENT 'รหัสบริษัทที่ออกรายการขอซื้อ',
  `input_date` date DEFAULT NULL COMMENT 'วันที่ทำรายการ',
  `input_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้ทำรายการ',
  `approve` varchar(1) DEFAULT NULL COMMENT 'อนุมัติหรือยัง',
  `approve_date` date DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `Quota_id` varchar(7) DEFAULT NULL COMMENT 'โค้วต้าชาวไร่/เขต',
  `Quota_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อนามสกุลโควต้า/เขต',
  `Quota_ket` varchar(3) DEFAULT NULL COMMENT 'เขตชาวไร่',
  `Quota_place` varchar(50) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `comp_code` varchar(2) DEFAULT NULL COMMENT 'เป็นสินค้าของบริษัท',
  `Product_code` varchar(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `Product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `Product_amount` int(10) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `Product_price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `Product_total` double(10,2) DEFAULT NULL COMMENT 'ราคาสินค้า',
  `recieve_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ส่งแล้ว',
  `remain_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ยังไม่ส่ง',
  `remark` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` varchar(1) DEFAULT NULL COMMENT 'สถานะรายการขอซื้อ NULL:ยังไม่ทำอะไร 1:สร้างใบขอซื้อแล้ว 2:สร้างใบสั่งซื้อแล้ว',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag 0:use 1:notuse',
  `pr_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `modify_date` date DEFAULT NULL COMMENT 'วันที่แก้ไขรายการ',
  `modify_by` int(11) DEFAULT NULL COMMENT 'แก้ไขรายการโดย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `req_detail02`
--

CREATE TABLE `req_detail02` (
  `id_no` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขประจำตัวรายการขอซื้อ',
  `req_detail_id` varchar(10) NOT NULL COMMENT 'หมายเลขรายการขอซื้อ',
  `req_id` int(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `req_comp_code` varchar(2) DEFAULT NULL COMMENT 'รหัสบริษัทที่ออกรายการขอซื้อ',
  `input_date` date DEFAULT NULL COMMENT 'วันที่ทำรายการ',
  `input_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้ทำรายการ',
  `approve` varchar(1) DEFAULT NULL COMMENT 'อนุมัติหรือยัง',
  `approve_date` date DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `Quota_id` varchar(7) DEFAULT NULL COMMENT 'โค้วต้าชาวไร่/เขต',
  `Quota_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อนามสกุลโควต้า/เขต',
  `Quota_ket` varchar(3) DEFAULT NULL COMMENT 'เขตชาวไร่',
  `Quota_place` varchar(50) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `comp_code` varchar(2) DEFAULT NULL COMMENT 'เป็นสินค้าของบริษัท',
  `Product_code` varchar(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `Product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `Product_amount` int(10) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `Product_price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `Product_total` double(10,2) DEFAULT NULL COMMENT 'ราคาสินค้า',
  `recieve_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ส่งแล้ว',
  `remain_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ยังไม่ส่ง',
  `remark` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` varchar(1) DEFAULT NULL COMMENT 'สถานะรายการขอซื้อ NULL:ยังไม่ทำอะไร 1:สร้างใบขอซื้อแล้ว 2:สร้างใบสั่งซื้อแล้ว',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag 0:use 1:notuse',
  `pr_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `modify_date` date DEFAULT NULL COMMENT 'วันที่แก้ไขรายการ',
  `modify_by` int(11) DEFAULT NULL COMMENT 'แก้ไขรายการโดย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `req_detail02`
--

INSERT INTO `req_detail02` (`id_no`, `req_detail_id`, `req_id`, `req_comp_code`, `input_date`, `input_by`, `approve`, `approve_date`, `approve_by`, `Quota_id`, `Quota_name`, `Quota_ket`, `Quota_place`, `comp_code`, `Product_code`, `Product_name`, `Product_amount`, `Product_price`, `Product_total`, `recieve_amount`, `remain_amount`, `remark`, `status`, `flag`, `pr_id`, `modify_date`, `modify_by`) VALUES
(0000001, 'NP0000001', NULL, NULL, '2020-09-27', '13', 'Y', '2020-09-27', '9', '0131029', 'วิชัย', '401', 'โนนสะอาด', '01', '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 10, 330.00, 3300.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000002, 'NP0000002', NULL, NULL, '2020-09-27', '13', 'Y', '2020-09-27', '9', '0131029', 'วิชัย', '401', 'โนนสะอาด', '07', '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 20, 999.00, 19980.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000003, 'NP0000003', NULL, NULL, '2020-09-27', '13', 'Y', '2020-09-27', '9', '0100312', 'ทองศรี', '302', 'เขาสวนกวาง', '08', '5121000080', 'ไกลโฟเสท', 30, 520.00, 15600.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000004, 'NP0000004', NULL, NULL, '2020-09-27', '13', 'Y', '2020-09-27', '9', '0100312', 'ทองศรี', '302', 'เขาสวนกวาง', '07', '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 10, 999.00, 9990.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000005, 'NP0000005', NULL, NULL, '2020-09-27', '13', 'Y', '2020-09-27', '9', '0103980', 'กิตติ', '205', 'กระนวน', '08', '5121000078', 'คชาเอมีน-84-SL', 10, 150.00, 1500.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000006, 'NP0000006', NULL, NULL, '2020-09-27', '13', 'Y', '2020-09-27', '9', '0103980', 'กิตติ', '205', 'กระนวน', '07', '5123458886', 'ปุ๋ย ตรา Leadership 20-6-25', 10, 999.00, 9990.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000007, 'NP0000007', NULL, NULL, '2020-09-27', '13', 'Y', '2020-09-27', '9', '0103980', 'กิตติ', '205', 'กระนวน', '01', '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 50, 330.00, 16500.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `req_detail03`
--

CREATE TABLE `req_detail03` (
  `id_no` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขประจำตัวรายการขอซื้อ',
  `req_detail_id` varchar(10) NOT NULL COMMENT 'หมายเลขรายการขอซื้อ',
  `req_id` int(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `req_comp_code` varchar(2) DEFAULT NULL COMMENT 'รหัสบริษัทที่ออกรายการขอซื้อ',
  `input_date` date DEFAULT NULL COMMENT 'วันที่ทำรายการ',
  `input_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้ทำรายการ',
  `approve` varchar(1) DEFAULT NULL COMMENT 'อนุมัติหรือยัง',
  `approve_date` date DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `Quota_id` varchar(7) DEFAULT NULL COMMENT 'โค้วต้าชาวไร่/เขต',
  `Quota_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อนามสกุลโควต้า/เขต',
  `Quota_ket` varchar(3) DEFAULT NULL COMMENT 'เขตชาวไร่',
  `Quota_place` varchar(50) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `comp_code` varchar(2) DEFAULT NULL COMMENT 'เป็นสินค้าของบริษัท',
  `Product_code` varchar(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `Product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `Product_amount` int(10) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `Product_price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `Product_total` double(10,2) DEFAULT NULL COMMENT 'ราคาสินค้า',
  `recieve_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ส่งแล้ว',
  `remain_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ยังไม่ส่ง',
  `remark` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` varchar(1) DEFAULT NULL COMMENT 'สถานะรายการขอซื้อ NULL:ยังไม่ทำอะไร 1:สร้างใบขอซื้อแล้ว 2:สร้างใบสั่งซื้อแล้ว',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag 0:use 1:notuse',
  `pr_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `modify_date` date DEFAULT NULL COMMENT 'วันที่แก้ไขรายการ',
  `modify_by` int(11) DEFAULT NULL COMMENT 'แก้ไขรายการโดย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `req_detail03`
--

INSERT INTO `req_detail03` (`id_no`, `req_detail_id`, `req_id`, `req_comp_code`, `input_date`, `input_by`, `approve`, `approve_date`, `approve_by`, `Quota_id`, `Quota_name`, `Quota_ket`, `Quota_place`, `comp_code`, `Product_code`, `Product_name`, `Product_amount`, `Product_price`, `Product_total`, `recieve_amount`, `remain_amount`, `remark`, `status`, `flag`, `pr_id`, `modify_date`, `modify_by`) VALUES
(0000004, 'WP0000004', NULL, NULL, '2020-09-28', '13', 'Y', '2020-09-28', '9', '0202337', 'ทองย้อย', '301', 'วังไห', '01', '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 50, 20.00, 1000.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000005, 'WP0000005', NULL, NULL, '2020-09-28', '13', 'Y', '2020-09-28', '9', '0201483', 'สมศรี', '204', 'ศรีชมพู', '01', '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 50, 20.00, 1000.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000006, 'WP0000006', NULL, NULL, '2020-09-28', '13', 'Y', '2020-09-28', '9', '0201483', 'สมศรี', '204', 'ศรีชมพู', '07', '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 50, 20.00, 1000.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000007, 'WP0000007', NULL, NULL, '2020-09-28', '13', 'Y', '2020-09-28', '9', '0201483', 'สมศรี', '204', 'ศรีชมพู', '08', '5121000087', 'คชายูรอน-80-ดับบลิวพี', 20, 20.00, 400.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000009, 'WP0000009', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0903452', 'ทองแดง', '401', 'โคกสูง', '07', '5123458882', 'ปุ๋ย ตรา Leadership 15-15-15', 50, 20.00, 1000.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000010, 'WP0000010', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0903552', 'ทองคำ', '401', 'นากว้าง', '07', '5123458884', 'ปุ๋ย ตรา Leadership 1ุ6-10-16', 30, 20.00, 600.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000011, 'WP0000011', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0903216', 'ทองดี', '401', 'วังไห', '07', '5123458886', 'ปุ๋ย ตรา Leadership 20-6-25', 20, 20.00, 400.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000013, 'WP0000013', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0902188', 'วรรณา', '401', 'โคกกลาง', '01', '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 50, 0.00, 0.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `req_detail04`
--

CREATE TABLE `req_detail04` (
  `id_no` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขประจำตัวรายการขอซื้อ',
  `req_detail_id` varchar(10) NOT NULL COMMENT 'หมายเลขรายการขอซื้อ',
  `req_id` int(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `req_comp_code` varchar(2) DEFAULT NULL COMMENT 'รหัสบริษัทที่ออกรายการขอซื้อ',
  `input_date` date DEFAULT NULL COMMENT 'วันที่ทำรายการ',
  `input_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้ทำรายการ',
  `approve` varchar(1) DEFAULT NULL COMMENT 'อนุมัติหรือยัง',
  `approve_date` date DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `Quota_id` varchar(7) DEFAULT NULL COMMENT 'โค้วต้าชาวไร่/เขต',
  `Quota_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อนามสกุลโควต้า/เขต',
  `Quota_ket` varchar(3) DEFAULT NULL COMMENT 'เขตชาวไร่',
  `Quota_place` varchar(50) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `comp_code` varchar(2) DEFAULT NULL COMMENT 'เป็นสินค้าของบริษัท',
  `Product_code` varchar(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `Product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `Product_amount` int(10) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `Product_price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `Product_total` double(10,2) DEFAULT NULL COMMENT 'ราคาสินค้า',
  `recieve_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ส่งแล้ว',
  `remain_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ยังไม่ส่ง',
  `remark` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` varchar(1) DEFAULT NULL COMMENT 'สถานะรายการขอซื้อ NULL:ยังไม่ทำอะไร 1:สร้างใบขอซื้อแล้ว 2:สร้างใบสั่งซื้อแล้ว',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag 0:use 1:notuse',
  `pr_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `modify_date` date DEFAULT NULL COMMENT 'วันที่แก้ไขรายการ',
  `modify_by` int(11) DEFAULT NULL COMMENT 'แก้ไขรายการโดย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `req_detail05`
--

CREATE TABLE `req_detail05` (
  `id_no` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขประจำตัวรายการขอซื้อ',
  `req_detail_id` varchar(10) NOT NULL COMMENT 'หมายเลขรายการขอซื้อ',
  `req_id` int(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `req_comp_code` varchar(2) DEFAULT NULL COMMENT 'รหัสบริษัทที่ออกรายการขอซื้อ',
  `input_date` date DEFAULT NULL COMMENT 'วันที่ทำรายการ',
  `input_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้ทำรายการ',
  `approve` varchar(1) DEFAULT NULL COMMENT 'อนุมัติหรือยัง',
  `approve_date` date DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `Quota_id` varchar(7) DEFAULT NULL COMMENT 'โค้วต้าชาวไร่/เขต',
  `Quota_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อนามสกุลโควต้า/เขต',
  `Quota_ket` varchar(3) DEFAULT NULL COMMENT 'เขตชาวไร่',
  `Quota_place` varchar(50) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `comp_code` varchar(2) DEFAULT NULL COMMENT 'เป็นสินค้าของบริษัท',
  `Product_code` varchar(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `Product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `Product_amount` int(10) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `Product_price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `Product_total` double(10,2) DEFAULT NULL COMMENT 'ราคาสินค้า',
  `recieve_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ส่งแล้ว',
  `remain_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ยังไม่ส่ง',
  `remark` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` varchar(1) DEFAULT NULL COMMENT 'สถานะรายการขอซื้อ NULL:ยังไม่ทำอะไร 1:สร้างใบขอซื้อแล้ว 2:สร้างใบสั่งซื้อแล้ว',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag 0:use 1:notuse',
  `pr_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `modify_date` date DEFAULT NULL COMMENT 'วันที่แก้ไขรายการ',
  `modify_by` int(11) DEFAULT NULL COMMENT 'แก้ไขรายการโดย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `req_detail06`
--

CREATE TABLE `req_detail06` (
  `id_no` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขประจำตัวรายการขอซื้อ',
  `req_detail_id` varchar(10) NOT NULL COMMENT 'หมายเลขรายการขอซื้อ',
  `req_id` int(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `req_comp_code` varchar(2) DEFAULT NULL COMMENT 'รหัสบริษัทที่ออกรายการขอซื้อ',
  `input_date` date DEFAULT NULL COMMENT 'วันที่ทำรายการ',
  `input_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้ทำรายการ',
  `approve` varchar(1) DEFAULT NULL COMMENT 'อนุมัติหรือยัง',
  `approve_date` date DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_by` varchar(2) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `Quota_id` varchar(7) DEFAULT NULL COMMENT 'โค้วต้าชาวไร่/เขต',
  `Quota_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อนามสกุลโควต้า/เขต',
  `Quota_ket` varchar(3) DEFAULT NULL COMMENT 'เขตชาวไร่',
  `Quota_place` varchar(50) DEFAULT NULL COMMENT 'สถานที่จัดส่ง',
  `comp_code` varchar(2) DEFAULT NULL COMMENT 'เป็นสินค้าของบริษัท',
  `Product_code` varchar(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `Product_name` varchar(30) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `Product_amount` int(10) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `Product_price` double(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `Product_total` double(10,2) DEFAULT NULL COMMENT 'ราคาสินค้า',
  `recieve_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ส่งแล้ว',
  `remain_amount` int(11) DEFAULT NULL COMMENT 'จำนวนที่ยังไม่ส่ง',
  `remark` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` varchar(1) DEFAULT NULL COMMENT 'สถานะรายการขอซื้อ NULL:ยังไม่ทำอะไร 1:สร้างใบขอซื้อแล้ว 2:สร้างใบสั่งซื้อแล้ว',
  `flag` varchar(1) NOT NULL DEFAULT '0' COMMENT 'flag 0:use 1:notuse',
  `pr_id` varchar(10) DEFAULT NULL COMMENT 'หมายเลขใบขอซื้อ',
  `modify_date` date DEFAULT NULL COMMENT 'วันที่แก้ไขรายการ',
  `modify_by` int(11) DEFAULT NULL COMMENT 'แก้ไขรายการโดย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `req_detail06`
--

INSERT INTO `req_detail06` (`id_no`, `req_detail_id`, `req_id`, `req_comp_code`, `input_date`, `input_by`, `approve`, `approve_date`, `approve_by`, `Quota_id`, `Quota_name`, `Quota_ket`, `Quota_place`, `comp_code`, `Product_code`, `Product_name`, `Product_amount`, `Product_price`, `Product_total`, `recieve_amount`, `remain_amount`, `remark`, `status`, `flag`, `pr_id`, `modify_date`, `modify_by`) VALUES
(0000001, 'PN0000001', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0600341', 'มงคล', '705', 'พัทยา', '01', '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 100, 0.00, 0.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000002, 'PN0000002', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0601849', 'บังเอิญ', '806', 'สระแก้ว', '01', '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 50, 0.00, 0.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000003, 'PN0000003', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0605381', 'วิภา', '704', 'คลองหาด', '07', '5123458884', 'ปุ๋ย ตรา Leadership 1ุ6-10-16', 100, 50.00, 5000.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000004, 'PN0000004', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0605381', 'วิภา', '704', 'คลองหาด', '01', '5021000032', 'ปุ๋ย KMS 888 (50 Kg.ต่อ กส.)', 100, 0.00, 0.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000005, 'PN0000005', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0613944', 'วิบูลย์', '803', 'ปราจีนบุรี', '08', '5121000079', 'ไซแอม คอมบี', 50, 50.00, 2500.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(0000006, 'PN0000006', NULL, NULL, '2020-10-01', '13', 'Y', '2020-10-01', '9', '0605488', 'เสนา', '304', 'สัตหีบ', '08', '5121000071', 'อะซีโทคลอร์', 190, 50.00, 9500.00, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bo_detail`
--
ALTER TABLE `bo_detail`
  ADD PRIMARY KEY (`bo_detail_no`);

--
-- Indexes for table `bo_main`
--
ALTER TABLE `bo_main`
  ADD PRIMARY KEY (`bo_no`,`site_no`) USING BTREE;

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
-- Indexes for table `inv_detail`
--
ALTER TABLE `inv_detail`
  ADD PRIMARY KEY (`inv_detail_no`);

--
-- Indexes for table `inv_main`
--
ALTER TABLE `inv_main`
  ADD PRIMARY KEY (`inv_no`,`site_no`) USING BTREE;

--
-- Indexes for table `inv_main_uploads`
--
ALTER TABLE `inv_main_uploads`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`pr_detail_no`);

--
-- Indexes for table `pr_main`
--
ALTER TABLE `pr_main`
  ADD PRIMARY KEY (`pr_no`,`site_no`) USING BTREE;

--
-- Indexes for table `pr_main_uploads`
--
ALTER TABLE `pr_main_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_detail`
--
ALTER TABLE `req_detail`
  ADD PRIMARY KEY (`id_no`);

--
-- Indexes for table `req_detail01`
--
ALTER TABLE `req_detail01`
  ADD PRIMARY KEY (`id_no`);

--
-- Indexes for table `req_detail02`
--
ALTER TABLE `req_detail02`
  ADD PRIMARY KEY (`id_no`);

--
-- Indexes for table `req_detail03`
--
ALTER TABLE `req_detail03`
  ADD PRIMARY KEY (`id_no`);

--
-- Indexes for table `req_detail04`
--
ALTER TABLE `req_detail04`
  ADD PRIMARY KEY (`id_no`);

--
-- Indexes for table `req_detail05`
--
ALTER TABLE `req_detail05`
  ADD PRIMARY KEY (`id_no`);

--
-- Indexes for table `req_detail06`
--
ALTER TABLE `req_detail06`
  ADD PRIMARY KEY (`id_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bo_detail`
--
ALTER TABLE `bo_detail`
  MODIFY `bo_detail_no` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับรายการส่งของ', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bo_main`
--
ALTER TABLE `bo_main`
  MODIFY `bo_no` int(6) NOT NULL AUTO_INCREMENT COMMENT 'เลขลำดับรายการใบวางบิล', AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `inv_detail`
--
ALTER TABLE `inv_detail`
  MODIFY `inv_detail_no` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับรายการส่งของ', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inv_main`
--
ALTER TABLE `inv_main`
  MODIFY `inv_no` int(6) NOT NULL AUTO_INCREMENT COMMENT 'เลขลำดับรายการ', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inv_main_uploads`
--
ALTER TABLE `inv_main_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลำดับผู้ใช้งาน', AUTO_INCREMENT=26;

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวสินค้า', AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `product_tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pr_detail`
--
ALTER TABLE `pr_detail`
  MODIFY `pr_detail_no` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับรายการขอซื้อ', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pr_main`
--
ALTER TABLE `pr_main`
  MODIFY `pr_no` int(6) NOT NULL AUTO_INCREMENT COMMENT 'เลขลำดับรายการ', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pr_main_uploads`
--
ALTER TABLE `pr_main_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `req_detail`
--
ALTER TABLE `req_detail`
  MODIFY `id_no` int(10) NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวรายการขอซื้อ';

--
-- AUTO_INCREMENT for table `req_detail01`
--
ALTER TABLE `req_detail01`
  MODIFY `id_no` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวรายการขอซื้อ';

--
-- AUTO_INCREMENT for table `req_detail02`
--
ALTER TABLE `req_detail02`
  MODIFY `id_no` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวรายการขอซื้อ', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `req_detail03`
--
ALTER TABLE `req_detail03`
  MODIFY `id_no` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวรายการขอซื้อ', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `req_detail04`
--
ALTER TABLE `req_detail04`
  MODIFY `id_no` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวรายการขอซื้อ';

--
-- AUTO_INCREMENT for table `req_detail05`
--
ALTER TABLE `req_detail05`
  MODIFY `id_no` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวรายการขอซื้อ';

--
-- AUTO_INCREMENT for table `req_detail06`
--
ALTER TABLE `req_detail06`
  MODIFY `id_no` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'เลขประจำตัวรายการขอซื้อ', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
