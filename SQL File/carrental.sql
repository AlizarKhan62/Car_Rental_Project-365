-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2026 at 09:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4', '2024-05-01 12:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `CustomerName` varchar(150) DEFAULT NULL,
  `CustomerEmail` varchar(150) DEFAULT NULL,
  `CustomerPhone` varchar(30) DEFAULT NULL,
  `CustomerAge` varchar(10) DEFAULT NULL,
  `LicenseType` varchar(50) DEFAULT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `PickupCity` varchar(100) DEFAULT NULL,
  `DropoffCity` varchar(100) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `CustomerName`, `CustomerEmail`, `CustomerPhone`, `CustomerAge`, `LicenseType`, `BookingNumber`, `userEmail`, `VehicleId`, `PickupCity`, `DropoffCity`, `FromDate`, `ToDate`, `message`, `Status`, `PostingDate`, `LastUpdationDate`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 443108139, 'amikt12@gmail.com', 2, NULL, NULL, '2024-06-08', '2024-06-10', 'I want booking', 1, '2024-06-05 05:32:39', '2024-06-05 05:34:08'),
(2, NULL, NULL, NULL, NULL, NULL, 354159336, 'alizarsial1122@gmail.com', 1, NULL, NULL, '2026-08-08', '2026-08-25', '03486750995\r\n', 1, '2026-08-08 18:16:39', '2026-08-08 19:02:49'),
(3, 'khan', 'web@gmail', '34569875621', '23', 'Pakistani Driving License', 474718479, NULL, 9, 'Islamabad', 'Mirpur', '2026-08-02', '2026-08-31', 'Guest enquiry via car detail page', 1, '2026-08-09 18:13:52', '2026-08-09 18:14:53'),
(4, 'kh', 'khan@gmail.com', '+966 548796554123', '23', 'Pakistani Driving License', 217295409, NULL, 12, 'Islamabad', 'Lahore', '2026-08-22', '2026-08-27', 'Guest enquiry via car detail page', 1, '2026-08-22 18:47:20', '2026-08-22 19:21:09'),
(5, 'qasim khan', 'qasimsial51214@gmail.com', '+61 5464565132', '', 'Pakistani Driving License', 844219851, NULL, 26, 'Islamabad', 'Mirpur', '2026-09-02', '2026-09-30', 'Guest enquiry via car detail page', 0, '2026-09-02 07:14:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbrands`
--

CREATE TABLE `tblbrands` (
  `id` int(11) NOT NULL,
  `BrandName` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbrands`
--

INSERT INTO `tblbrands` (`id`, `BrandName`, `CreationDate`, `UpdationDate`) VALUES
(8, 'Honda', '2026-08-09 17:59:15', NULL),
(9, 'Toyota', '2026-08-09 17:59:27', NULL),
(10, 'Daihatsu', '2026-08-09 17:59:51', NULL),
(11, 'Haval', '2026-08-31 07:31:12', NULL),
(12, 'KIA', '2026-08-31 08:32:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategories`
--

CREATE TABLE `tblcategories` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategories`
--

INSERT INTO `tblcategories` (`id`, `CategoryName`, `CreationDate`, `UpdationDate`) VALUES
(13, 'Bike', '2026-08-09 21:03:46', NULL),
(15, 'SUV', '2026-08-31 07:40:06', NULL),
(16, 'Sedan', '2026-08-31 08:05:21', NULL),
(17, 'Hatchback', '2026-09-01 07:11:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcities`
--

CREATE TABLE `tblcities` (
  `id` int(11) NOT NULL,
  `CityName` varchar(120) NOT NULL,
  `Slug` varchar(120) NOT NULL,
  `MetaTitle` varchar(255) DEFAULT NULL,
  `HeroHeading` varchar(255) DEFAULT NULL,
  `HeroDescription` text DEFAULT NULL,
  `DisplayOrder` int(11) NOT NULL DEFAULT 0,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcities`
--

INSERT INTO `tblcities` (`id`, `CityName`, `Slug`, `MetaTitle`, `HeroHeading`, `HeroDescription`, `DisplayOrder`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Islamabad', 'islamabad', 'Rent A Car in Islamabad', 'Rent a Car in Islamabad', 'Looking to rent a car in Islamabad? Choose from our wide range of vehicles with flexible self-drive and with-driver options for short-term and long-term needs alike.', 1, '2026-08-08 17:13:55', '2026-08-30 19:26:27'),
(2, 'Rawalpindi', 'rawalpindi', 'Rent A Car in Rawalpindi', 'Rent a Car in Rawalpindi', 'Looking to rent a car in Rawalpindi? Choose from our wide range of vehicles with flexible self-drive and with-driver options for short-term and long-term needs alike.', 2, '2026-08-08 17:13:55', '2026-08-30 19:26:45'),
(3, 'Lahore', 'lahore', 'Rent A Car in Lahore', 'Rent a Car in Lahore', 'Looking to rent a car in Lahore? Choose from our wide range of vehicles with flexible self-drive and with-driver options for short-term and long-term needs alike.', 3, '2026-08-08 17:13:55', '2026-08-30 19:26:59'),
(4, 'Mirpur', 'mirpur', 'Rent A Car in Mirpur', 'Rent a Car in Mirpur', 'Looking to rent a car in Mirpur? Choose from our wide range of vehicles with flexible self-drive and with-driver options for short-term and long-term needs alike.', 4, '2026-08-08 17:13:55', '2026-08-30 19:27:12'),
(5, 'Faisalabad', 'faisalabad', 'Rent A Car in Faisalabad', 'Rent a Car in Faisalabad', 'Looking to rent a car in Faisalabad? Choose from our wide range of vehicles with flexible self-drive and with-driver options for short-term and long-term needs alike.', 5, '2026-08-08 17:13:55', '2026-08-30 19:27:27'),
(6, 'Peshawar', 'peshawar', 'Rent A Car in Peshawar', 'Rent a Car in Peshawar', 'Looking to rent a car in Peshawar? Choose from our wide range of vehicles with flexible self-drive and with-driver options for short-term and long-term needs alike.', 6, '2026-08-08 17:13:55', '2026-08-30 19:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `WhatsAppNo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`, `WhatsAppNo`) VALUES
(1, 'Islamabad block D I-8 Markaz', 'Website@gmail.com', '54689745612', '+923486750995');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(1, 'Kunal ', 'kunal@gmail.com', '7977779798', 'I want to know you brach in Chandigarh?', '2024-06-04 09:34:51', 1),
(2, 'khan', 'khan@gmail.com', '9548765213', 'i want to connect with u', '2026-08-22 09:53:14', 1),
(3, 'khan', 'khan@gmail.com', '9548765213', 'i want to connect with u', '2026-08-22 10:10:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Terms and Conditions', 'terms', '																				<p align=\"justify\"><font size=\"2\"><strong><font color=\"#990000\">(1) ACCEPTANCE OF TERMS</font></strong></font></p><p align=\"justify\"><span style=\"font-size: 1em;\">Welcome to PakDrive365. PakDrive365 (\"we\" or \"us\" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service (\"TOS\"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: </span><response-element class=\"no-md\" ng-version=\"0.0.0-PLACEHOLDER\" style=\"font-size: 1em;\"><link-block _nghost-ng-c958395829=\"\" class=\"ng-star-inserted\"><a _ngcontent-ng-c958395829=\"\" target=\"_blank\" rel=\"noopener\" externallink=\"\" _nghost-ng-c3366598893=\"\" jslog=\"197247;track:generic_click,impression,attention;BardVeMetadataKey:[[&quot;r_36b6ee49f3f2bdbe&quot;,&quot;c_b862b7a24ff9ad9f&quot;,null,&quot;rc_3c16de53a5b05697&quot;,null,null,&quot;en&quot;,null,1,null,null,1,0]]\" href=\"https://www.google.com/search?q=https://www.pakdrive365.com/info/terms/\" class=\"ng-star-inserted\" data-hveid=\"0\" decode-data-ved=\"1\" data-ved=\"0CAAQ_4QMahgKEwippNKy8tGWAxUAAAAAHQAAAAAQpgM\">https://www.pakdrive365.com/info/terms/</a></link-block></response-element><span style=\"font-size: 1em;\">. In addition, when using particular PakDrive365 services or third party services, you and PakDrive365 shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which may be subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. PakDrive365 also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service.</span></p>\r\n										\r\n										'),
(2, 'Privacy Policy', 'privacy', 'At PakDrive365, we respect your privacy and are committed to protecting your personal data. This privacy policy explains how we collect, use, and safeguard your information when you visit our website or use our car rental services. We collect personal details such as your name, email address, phone number, and driver\'s license information solely to process your vehicle bookings and provide efficient customer support. Your information is never sold, traded, or shared with unauthorized third parties. We implement robust security measures to ensure your data remains safe and confidential at all times. By using our website and services, you consent to the collection and use of your information in accordance with this policy.'),
(3, 'About Us ', 'aboutus', '<div><p data-path-to-node=\"0\">We offer a varied fleet of cars, ranging from compact models to spacious sedans. All our vehicles feature air conditioning, power steering, and electric windows, and are purchased and maintained exclusively at official dealerships. Automatic transmission options are available across every booking class. Because we remain independent of any specific automaker, we provide a diverse variety of vehicle makes and models to suit your exact needs.</p><p data-path-to-node=\"1\"></p></div>\r\n										'),
(11, 'FAQs', 'faqs', '<div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq1\" aria-expanded=\"true\">What types of vehicles do you offer for rent?</a></h4></div><div id=\"faq1\" class=\"panel-collapse collapse in\" role=\"tabpanel\"><div class=\"panel-body\">At PakDrive365, we offer a wide range of vehicles including economy cars, sedans, SUVs, luxury cars, minivans and trucks. Our fleet is updated regularly so you always have access to the latest models.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq2\" aria-expanded=\"false\">What are the age requirements to rent a car?</a></h4></div><div id=\"faq2\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">The minimum age to rent a car is typically 21. Drivers between 21 and 26 may be charged an additional young-driver fee and security deposit. Some vehicles carry higher minimum age requirements, so please confirm with our PakDrive365 team when booking.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq3\" aria-expanded=\"false\">Can I rent a car if I don\'t live locally?</a></h4></div><div id=\"faq3\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Yes. You can rent regardless of where you live, as long as you meet the age and driving-license requirements. International visitors renting with PakDrive365 may need to present an International Driving Permit alongside their home country license.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq4\" aria-expanded=\"false\">Is there a mileage limit?</a></h4></div><div id=\"faq4\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Our rentals come with unlimited mileage unless stated otherwise for a specific deal or long-term rental. Please confirm the terms with PakDrive365 before booking.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq5\" aria-expanded=\"false\">What do I need to rent a car?</a></h4></div><div id=\"faq5\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">You\'ll need a valid driving license held for at least one year, and a government-issued photo ID such as a passport or national ID card.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq6\" aria-expanded=\"false\">Can I return the car after hours?</a></h4></div><div id=\"faq6\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Yes, after-hours returns are available. Please contact us in advance so we can arrange the drop-off outside our regular office hours.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq7\" aria-expanded=\"false\">Can I add an additional driver to my rental?</a></h4></div><div id=\"faq7\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Yes, additional drivers can be added for an extra fee. Every additional driver must meet the same age and license requirements as the primary driver.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq8\" aria-expanded=\"false\">What should I do if the car breaks down or is involved in an accident?</a></h4></div><div id=\"faq8\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Contact the PakDrive365 customer service line immediately. If it\'s an accident, file a police report and exchange information with the other parties involved before contacting us.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq9\" aria-expanded=\"false\">What happens if I return the car late?</a></h4></div><div id=\"faq9\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Late returns incur additional charges based on how long the vehicle is kept beyond the agreed period. If you expect to be late, let us know as early as possible so we can try to extend your rental.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq10\" aria-expanded=\"false\">Do you offer airport pick-up or delivery services?</a></h4></div><div id=\"faq10\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Yes, we offer airport pick-up and drop-off. Please check with us for availability and any additional service fees.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq11\" aria-expanded=\"false\">Can I drive the rental car on unpaved roads?</a></h4></div><div id=\"faq11\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Most of our vehicles are intended for paved roads only. If you\'re planning to drive on unpaved or off-road terrain, check with us first — certain SUVs or trucks may be suitable, subject to restrictions.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq12\" aria-expanded=\"false\">How do I know if a car is available?</a></h4></div><div id=\"faq12\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Check availability directly on the PakDrive365 website or by contacting our customer service team. We recommend booking in advance to guarantee your preferred vehicle.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq13\" aria-expanded=\"false\">What happens if I return the car to a different location?</a></h4></div><div id=\"faq13\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Returning to a different location than pick-up incurs a one-way fee, which depends on the distance between the two locations.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq14\" aria-expanded=\"false\">Is there a cleaning fee for dirty cars?</a></h4></div><div id=\"faq14\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Please return the car in reasonably clean condition. A cleaning fee may apply if the vehicle is returned excessively dirty or damaged.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq15\" aria-expanded=\"false\">What happens if I lose my car key or lock myself out?</a></h4></div><div id=\"faq15\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Contact us immediately. We can help arrange a replacement key or unlock the vehicle, though additional fees may apply depending on the situation.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq16\" aria-expanded=\"false\">Do you offer long-term rentals?</a></h4></div><div id=\"faq16\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">Yes, discounted rates are available for long-term rentals, usually 30 days or more. Contact us for custom pricing and availability.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq17\" aria-expanded=\"false\">Are there any hidden fees I should be aware of?</a></h4></div><div id=\"faq17\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\">At PakDrive365, we keep our pricing transparent. All fees — including optional insurance, additional drivers and fuel policy — are clearly stated at the time of booking, with no surprises at pick-up or return.</div></div></div><div class=\"panel panel-default\" style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\"><div class=\"panel-heading\" role=\"tab\"><h4 class=\"panel-title\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"https://www.claudeusercontent.com/?domain=claude.ai&amp;parentOrigin=https%3A%2F%2Fclaude.ai&amp;errorReportingMode=parent&amp;formattedSpreadsheets=true#faq18\" aria-expanded=\"false\">Are your cars fully insured?</a></h4></div><div id=\"faq18\" class=\"panel-collapse collapse\" role=\"tabpanel\"><div class=\"panel-body\"></div></div></div>'),
(22, 'homehero', 'homehero', '																																								<h1><div _ngcontent-ng-c3035862051=\"\" inline-copy-host=\"\" class=\"markdown markdown-main-panel md-content enable-luminous-fast-follows enable-updated-hr-color tutor-markdown-rendering\" id=\"model-response-message-contentr_9bbbc6f5580c28e9\" aria-busy=\"false\" aria-live=\"polite\" dir=\"ltr\" style=\"--animation-duration: 400ms; --fade-animation-function: ease-out; animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 2.4px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 2.4px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><div style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 2.4px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 2.4px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><div _ngcontent-ng-c3035862051=\"\" inline-copy-host=\"\" class=\"markdown markdown-main-panel md-content enable-luminous-fast-follows enable-updated-hr-color tutor-markdown-rendering\" id=\"model-response-message-contentr_9bbbc6f5580c28e9\" aria-busy=\"false\" aria-live=\"polite\" dir=\"ltr\" style=\"--animation-duration: 400ms; --fade-animation-function: ease-out; animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 2.4px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 2.4px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><div style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 2.4px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 2.4px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><p data-path-to-node=\"2\"><b data-path-to-node=\"2\" data-index-in-node=\"0\">PakDrive365</b></p><p data-path-to-node=\"3\">PakDrive365 offers well-maintained economy cars, luxury vehicles, and SUVs for rent across Islamabad, Rawalpindi, Lahore, Peshawar, Faisalabad, and Mirpur. Enjoy flexible daily, weekly, or monthly packages with easy online booking for business trips, family vacations, or city tours.</p></div></div></div></div></h1>\r\n										\r\n										\r\n										\r\n										'),
(23, 'services', 'services', '<h2 style=\"margin: 0px 0px 30px; font-weight: 900; line-height: 1.2; color: rgb(17, 17, 17); font-size: 36px; overflow-wrap: break-word; padding: 0px; border: 0px; position: relative; font-family: &quot;Fira Sans&quot;, sans-serif; text-align: center; background-color: rgb(252, 251, 251);\">Our Car Rental Services</h2><p style=\"margin: auto; overflow-wrap: break-word; padding: 0px; border: 0px; max-width: 439px; font-size: 16px; color: rgb(120, 120, 120); font-family: &quot;Fira Sans&quot;, sans-serif; text-align: center; background-color: rgb(252, 251, 251);\">We are innovative and passionate about the work we do.</p>										\r\n										');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscribers`
--

CREATE TABLE `tblsubscribers` (
  `id` int(11) NOT NULL,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubscribers`
--

INSERT INTO `tblsubscribers` (`id`, `SubscriberEmail`, `PostingDate`) VALUES
(4, 'harish@gmail.com', '2024-06-01 09:26:21'),
(5, 'kunal@gmail.com', '2024-05-31 09:35:07'),
(6, 'Kahn@gmail.com', '2026-08-09 17:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbltestimonial`
--

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `Testimonial` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(1, 'Test', 'test@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '6465465465', '', 'L-890, Gaur City Ghaziabad', 'Ghaziabad', 'India', '2024-05-01 14:00:49', '2024-06-05 05:27:37'),
(2, 'Amit', 'amikt12@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '1425365214', NULL, NULL, NULL, NULL, '2024-06-05 05:31:05', NULL),
(3, 'Alizar Ali', 'alizarsial1122@gmail.com', '690fc8d88b5f3c9ef2efbf3ab3466f29', '3287388606', NULL, NULL, NULL, NULL, '2026-08-08 17:35:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicleimages`
--

CREATE TABLE `tblvehicleimages` (
  `id` int(11) NOT NULL,
  `VehicleId` int(11) NOT NULL,
  `ImagePath` varchar(255) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblvehicleimages`
--

INSERT INTO `tblvehicleimages` (`id`, `VehicleId`, `ImagePath`, `CreationDate`) VALUES
(1, 10, 'Toyota-Prius-side-2.jpeg', '2026-08-22 17:59:57'),
(2, 11, 'Toyota-Prius-inside.jpeg', '2026-08-22 18:06:42'),
(3, 12, 'Toyota-Prius-Right-side.jpeg', '2026-08-22 18:13:51'),
(4, 12, 'Toyota-Prius-side-2.jpeg', '2026-08-22 18:13:51'),
(5, 15, 'Toyota-Prius-inside.jpeg', '2026-08-31 08:16:01'),
(6, 15, 'Toyota-Prius-Right-side.jfif', '2026-08-31 08:16:01'),
(7, 15, 'Toyota-Prius-side-2.jfif', '2026-08-31 08:16:01'),
(8, 18, 'Honda-Civic-2025-side.jpeg', '2026-08-31 09:15:30'),
(9, 18, 'Honda-Civic-black.jpg', '2026-08-31 09:15:30'),
(10, 23, 'Prado-TXL-7-seater.jpeg', '2026-08-31 09:50:20'),
(11, 24, 'Toyota-Land-Cruiser-V8-White1.jfif', '2026-08-31 09:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicles`
--

CREATE TABLE `tblvehicles` (
  `id` int(11) NOT NULL,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesBrand` int(11) DEFAULT NULL,
  `VehiclesOverview` longtext DEFAULT NULL,
  `PricePerDay` int(11) DEFAULT NULL,
  `FuelType` varchar(100) DEFAULT NULL,
  `ModelYear` int(6) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `GearType` varchar(50) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `AirConditioner` int(11) DEFAULT NULL,
  `PowerDoorLocks` int(11) DEFAULT NULL,
  `AntiLockBrakingSystem` int(11) DEFAULT NULL,
  `BrakeAssist` int(11) DEFAULT NULL,
  `PowerSteering` int(11) DEFAULT NULL,
  `DriverAirbag` int(11) DEFAULT NULL,
  `PassengerAirbag` int(11) DEFAULT NULL,
  `PowerWindows` int(11) DEFAULT NULL,
  `CDPlayer` int(11) DEFAULT NULL,
  `CentralLocking` int(11) DEFAULT NULL,
  `CrashSensor` int(11) DEFAULT NULL,
  `LeatherSeats` int(11) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblvehicles`
--

INSERT INTO `tblvehicles` (`id`, `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `CategoryId`, `GearType`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `AirConditioner`, `PowerDoorLocks`, `AntiLockBrakingSystem`, `BrakeAssist`, `PowerSteering`, `DriverAirbag`, `PassengerAirbag`, `PowerWindows`, `CDPlayer`, `CentralLocking`, `CrashSensor`, `LeatherSeats`, `RegDate`, `UpdationDate`) VALUES
(13, 'Haval H6 Hybrid Elite', 11, 'Experience elite performance and modern comfort with the Haval H6 Hybrid. Designed for executive city commutes and long-distance family travels across Pakistan, this premium crossover features an upscale cabin, advanced hybrid efficiency, smooth automatic handling, and a commanding road presence.', 20000, 'Hybrid', 2026, 5, 15, 'Automatic', 'Haval-Hybrid-2026-front.jfif', 'Haval-Hybrid-2026-Back.jpg', 'Haval-Hybrid-2026-Boot.jpeg', 'Haval-Hybrid-2026-inside.jpeg', '', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 1, '2026-08-31 07:39:57', '2026-08-31 07:55:29'),
(14, 'Toyota Yaris 1.3 Ativ CVT', 9, 'Navigate city streets and highways smoothly with the Toyota Yaris 2021 Automatic. Known for its outstanding fuel efficiency, dependable performance, and spacious cabin layout, this compact sedan delivers a comfortable, stress-free ride for both daily commuting and family trips across Pakistan.', 9000, 'Petrol', 2021, 5, 16, 'Automatic', 'Toyota-Yaris-2021-Front.jfif', 'Toyota-Yaris-2021Right-side.jpg', 'Toyota-Yaris-2021-back.jfif', 'Toyota-Yaris-2021-inside-back.jpeg', 'Toyota-Yaris-2021-inside-front.jpeg', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-08-31 08:05:13', '2026-08-31 08:05:42'),
(15, 'Toyota Prius 2014 Hybrid UK Edition', 9, 'Maximize your fuel economy on every journey with the Toyota Prius 2014 Hybrid UK Model. Combining a reliable petrol engine with advanced electric hybrid technology, this eco-friendly hatchback offers a remarkably smooth drive, quiet cabin, and ample cargo space, making it a smart choice for city cruising and long-distance travel.', 10000, 'Hybrid', 2014, 5, 16, 'Automatic', 'Toyota-Prius-Front.jfif', 'Toyota-Prius-boot.jfif', 'Toyota-Prius-front-seat.jpeg', 'Toyota-Prius-front-seat.jpeg', 'Toyota-Prius-front-dashboard.jpeg', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-08-31 08:16:01', NULL),
(16, 'Honda CG 150 Commuter Bike', 8, 'Navigate urban traffic effortlessly and manage daily commuting with the reliable Honda CG 150. Powered by a dependable 4-stroke air-cooled engine, this motorcycle offers exceptional fuel economy, an upright comfort-focused riding posture, and agile handling, making it an ideal, cost-effective ride for city exploration across Pakistan.', 5000, 'Petrol', 2026, 2, 13, 'Manual', 'Honda-150-CG.jfif', 'Honda-150-CG-back.jfif', 'Honda-150-CG-meter.jpeg', 'Honda-150-CG-rightside.jfif', 'Honda-150-CG-stand.jfif', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-08-31 08:26:29', '2026-09-01 08:51:54'),
(17, 'Kia Stonic EX+ Urban Crossover', 12, 'Command the urban landscape with the stylish and versatile Kia Stonic 2025. Featuring modern design lines, a comfortable high-tech cabin, smooth automatic transmission, and great fuel efficiency, this compact crossover provides an exceptional driving experience for city commuting and weekend getaways across Pakistan.', 14000, 'Petrol', 2025, 5, 15, 'Automatic', 'Kia-stonic-Frontside.jfif', 'Kia-Stonic-Backside.jfif', 'Kia-stonic-inside.jpeg', 'Kia-stonic-right.jfif', 'Kia-stonic-full.jfif', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-08-31 08:32:42', '2026-08-31 08:33:10'),
(18, 'Honda Civic Oriel Black Edition', 8, 'Make a striking impression on every journey with the Honda Civic Oriel Black Model 2025. Finished in a sleek black exterior, this premium executive sedan delivers exceptional driving dynamics, a refined cabin layout, and advanced comfort features. Perfect for corporate travel, elite events, family outings, and long-distance highway cruising across Pakistan.', 16000, 'Petrol', 2025, 5, 16, 'Automatic', 'Honda-Civic-2025-front-right-side.jpg', 'Honda-Civic-2025.jpg', 'Honda-Civic-2025-inside-back.jpeg', 'Honda-Civic-2025-left-side.jfif', 'Honda-Civic-2025-inside-side.jpeg', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, NULL, '2026-08-31 09:15:30', NULL),
(19, 'Honda Civic Oriel Turbo Sedan', 8, 'Elevate your travel experience with the refined Honda Civic VTi Oriel Model 2025. Built to provide exceptional comfort, responsive handling, and advanced safety, this modern sedan features a spacious cabin, premium styling, and a smooth automatic transmission. Ideal for family vacations, corporate events, daily commuting, and long-distance highway travel across Pakistan.', 15000, 'Petrol', 2025, 5, 16, 'Automatic', 'WhatsApp-Image-2025-01-31-at-3.58.37-PM-scaled.jpg', 'Honda-civic-back-2-scaled.jpg', 'Honda-civic-2025-1-scaled.jfif', 'Honda-Civic-2025-side.jpeg', 'Honda-civic-inside-scaled.jpeg', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, NULL, '2026-08-31 09:22:00', NULL),
(20, 'Honda BR-V i-VTEC 7-Seater 2023', 8, 'Accommodate larger families and group travel comfortably with the Honda BR-V 2023. Designed as a versatile urban crossover, it features a spacious multi-row interior with flexible cargo solutions, efficient engine performance, and a stable ride quality, making it an ideal choice for city navigation and long-distance road trips across Pakistan.', 12000, 'Petrol', 2023, 7, 15, 'Automatic', 'Honda-BRV-1.5cc-1.jfif', 'Honda-BRV-7-seater.jpg', 'Honda-BRV-New-2023.jfif', 'New-Honda-BRV-1.5cc.jfif', '', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-08-31 09:32:04', NULL),
(21, 'Honda BR-V 2023 White Crossover', 8, 'Cruise in style with the immaculate white finish of the Honda BR-V 2023. Engineered to support modern group travel and family vacations, this spacious 7-seater compact SUV offers a comfortable riding posture, flexible multi-row configuration, smooth automatic transmission, and steady road command for city driving and long-distance excursions across Pakistan.', 12000, 'Petrol', 2023, 7, 15, 'Automatic', 'New-Honda-BRV-2023.jfif', 'New-Honda-BRV-2.jfif', 'New-Honda-BRV-7-seater.jfif', 'New-Honda-BRV-white.jfif', 'New-Honda-BRV-1.5cc.jfif', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-08-31 09:39:28', NULL),
(22, 'Honda BR-V i-VTEC 2019', 8, 'Tackle everyday group transport and family outings with the practical and dependable Honda BR-V 2019. Featuring a flexible 7-seater cabin arrangement, responsive fuel-efficient engine performance, and a smooth automatic drive, this multi-purpose vehicle offers great value and reliability for city commutes and highway trips across Pakistan.', 10000, 'Petrol', 2019, 7, 15, 'Automatic', 'Honda-BRV-2019.jfif', 'Honda-BRV.jfif', 'Honda-BRV-1.5cc.jfif', 'Honda-BRV-7-seater.jpg', 'New-Honda-BRV-1.5cc.jfif', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-08-31 09:43:08', NULL),
(23, 'Toyota Land Cruiser Prado TXL Black Edition', 9, 'Command any terrain with absolute confidence in the Toyota Prado TXL Automatic Black. Combining majestic road presence with a luxurious leather-appointed interior, robust four-wheel drive capability, and advanced comfort features, this premium SUV is the ultimate choice for elite VIP transport, royal weddings, corporate delegations, and rugged mountain expeditions across Pakistan.', 25000, 'Petrol', 2024, 7, 15, 'Automatic', 'Prado-TXL-Automatic-scaled.jfif', 'Prado-TXL-Automatic-Black.jfif', 'Prado-TXL-2.7cc.jpeg', 'Prado-TXL-Automatic-Black1-scaled.jfif', 'Prado-TXL-Automatic-Black2.jfif', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, '2026-08-31 09:50:20', NULL),
(24, 'Toyota Land Cruiser V8 Luxury Edition', 9, 'Experience unmatched prestige and supreme off-road performance with the Toyota Land Cruiser V8 White. Featuring a spacious, ultra-luxurious cabin, powerful V8 engine performance, advanced safety systems, and striking exterior styling, this flagship SUV delivers an elite driving experience for high-profile weddings, VIP delegations, and luxury tours across Pakistan.', 40000, 'Petrol', 2024, 7, 15, 'Automatic', 'Toyota-Land-Cruiser-V8-White.jfif', 'Toyota-Land-Cruiser.jfif', 'Toyota-Land-Cruiser-V8-White3.jfif', 'Toyota-Land-Cruiser-V8.jfif', 'Toyota-Land-Cruiser-V82.jfif', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, '2026-08-31 09:55:32', NULL),
(25, 'Toyota Land Cruiser ZX Flagship Edition', 9, 'Command attention on every route with the pinnacle of automotive engineering and luxury. The Land Cruiser ZX 2022 delivers legendary off-road mastery, exceptional cabin quietness, and high-end comfort features. Designed for corporate delegations, VIP escorts, high-profile weddings, and executive road travels across Pakistan.', 50000, 'Petrol', 2022, 7, 15, 'Automatic', 'Land-Cruiser-ZX-2022.jfif', 'Land-Cruiser-ZX.jfif', 'Land-Cruiser-ZX-2.jfif', 'Land-Cruiser-ZX-white.jfif', '', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, '2026-08-31 10:00:06', NULL),
(26, 'Toyota Fortuner Sigma 4', 9, 'Conquer rugged mountain terrains and urban highways alike with the robust Toyota Fortuner. Combining aggressive styling, a high seating position, and a spacious 7-seater interior, this powerful SUV delivers dependable four-wheel-drive capability, superior road clearance, and premium comfort for elite family tours and adventures across Pakistan.', 25000, 'Diesel', 2024, 7, 15, 'Automatic', 'Fortuner-front.jpg', 'Fortuner-side-scaled.jpg', 'Fortuner-trunk-scaled.jpeg', 'Fortuner-inside-scaled.jfif', 'Fortuner-inside-front-scaled.jfif', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, '2026-08-31 11:25:33', NULL),
(28, 'Toyota Hilux Revo Rocco 4x4 Black Edition', 9, 'Take on heavy-duty hauling and demanding off-road trails with the rugged Toyota Hilux Revo Rocco Black. Combining a commanding pickup bed utility with a comfortable, feature-packed double-cab interior, this powerhouse truck delivers exceptional torque, 4x4 capability, and bold street styling for construction projects, outdoor expeditions, and adventure trips across Pakistan.', 25000, 'Diesel', 2024, 5, 15, 'Automatic', 'Toyota-Revo-Rocco.jfif', 'Toyota-Hilux-Revo-Rocco-Black.jfif', 'Rocco-side-scaled.jfif', 'Toyota-Hilux-Revo-Rocco-Black1.jpeg', 'Toyota-Hilux-Rocco-Black.jfif', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, '2026-09-01 07:06:58', NULL),
(29, 'Daihatsu Copen X-PLAY Convertible Roadster', 10, 'Turn heads on every scenic drive with the sporty and compact Daihatsu Copen X-PLAY. Featuring a retractable hardtop roof, distinctive crossover styling, nimble agile handling, and an engaging open-air driving experience, this unique micro-roadster is perfect for vibrant city cruising and weekend getaways.', 15000, 'Petrol', 2022, 2, 17, 'Automatic', 'Daihatsu-Copen-X-Play.jpg', 'Daihatsu-Copen-X-Play2.jfif', 'Daihatsu-Copen-X-Play.1.jfif', 'Daihatsu-Copen-X-Play2.jfif', '', 1, 1, 1, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-09-01 07:11:31', '2026-09-01 07:16:20'),
(30, 'Honda Civic 1.5 VTEC Turbo 2022', 8, 'Experience sleek design and powerful performance with the Honda Civic 2022. Equipped with a responsive turbocharged engine, a sharp fastback-inspired exterior, and a tech-forward driver-centric cabin, this sedan delivers high-speed stability and luxury for daily city driving and long-distance highway travel across Pakistan.', 12000, 'Petrol', 2022, 5, 16, 'Automatic', 'Honda-Civic-1.8cc-scaled.jpg', 'Honda-Civic-2022-scaled.jpg', 'Honda-Civic-2022-Automatic-scaled.jpeg', 'Honda-civic-back-scaled.jpg', 'honda-civic-rightside-scaled.jpg', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, NULL, '2026-09-01 07:15:45', NULL),
(31, 'Honda City Aspire 1.5 CVT 2025', 8, 'Drive in absolute comfort and elegance with the Honda City Aspire 2025. Featuring a refined interior layout with premium leatherette accents, advanced infotainment features, a smooth automatic transmission, and exceptional fuel efficiency, this popular sedan is the ultimate choice for daily commuting, family trips, and professional travel across Pakistan.', 10000, 'Petrol', 2025, 5, 16, 'Automatic', 'Honda-City-Aspire-2.jfif', 'Honda-City-Aspire-2025.jfif', 'Honda-City-Aspire-white.jfif', 'Honda-City-Aspire-Automatic.jpeg', '', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, '2026-09-01 07:27:24', NULL),
(33, 'Honda City Aspire 1.5L 2023', 8, 'Enjoy a dependable and comfortable journey with the Honda City Aspire 2023. Known for its remarkable fuel efficiency, spacious cabin legroom, smooth automatic drive, and elegant chrome exterior touches, this trusted sedan is ideal for everyday city commuting, family outings, and professional travel across Pakistan.', 9000, 'Petrol', 2023, 5, 16, 'Automatic', 'Honda-City-Aspire-1.5cc-1.jfif', 'Honda-City-Aspire-1.5cc.jfif', 'Honda-City-Aspire-5-seater-1.jfif', 'Honda-City-Aspire-2023.jfif', '', 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-09-01 08:46:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbrands`
--
ALTER TABLE `tblbrands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategories`
--
ALTER TABLE `tblcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcities`
--
ALTER TABLE `tblcities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Slug` (`Slug`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Indexes for table `tblvehicleimages`
--
ALTER TABLE `tblvehicleimages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `VehicleId` (`VehicleId`);

--
-- Indexes for table `tblvehicles`
--
ALTER TABLE `tblvehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblbrands`
--
ALTER TABLE `tblbrands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblcategories`
--
ALTER TABLE `tblcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblcities`
--
ALTER TABLE `tblcities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblvehicleimages`
--
ALTER TABLE `tblvehicleimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblvehicles`
--
ALTER TABLE `tblvehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
