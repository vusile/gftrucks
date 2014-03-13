-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2014 at 07:12 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gftrucks`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `BrandID` int(11) NOT NULL AUTO_INCREMENT,
  `BrandTitle` varchar(255) NOT NULL,
  `BrandTagLine` varchar(255) NOT NULL,
  `BrandLogo` varchar(255) NOT NULL,
  `BrandDescription` text NOT NULL,
  `Active` tinyint(4) NOT NULL,
  `Featured` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`BrandID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`BrandID`, `BrandTitle`, `BrandTagLine`, `BrandLogo`, `BrandDescription`, `Active`, `Featured`) VALUES
(2, 'Terex', 'Terex Tag Line', 'logo-terex2.png', 'Terex Description', 1, 2),
(3, 'FAW', 'FAW Tag Line', 'logo-FAW2.png', 'FAW Description', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catalogues`
--

CREATE TABLE IF NOT EXISTS `catalogues` (
  `CatalogueID` int(11) NOT NULL AUTO_INCREMENT,
  `CatalogueTitle` varchar(255) NOT NULL,
  `FileName` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`CatalogueID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `catalogues`
--

INSERT INTO `catalogues` (`CatalogueID`, `CatalogueTitle`, `FileName`, `Active`) VALUES
(1, 'Terex Catalogue', '090114025752JOB_DESCRIPTION__SLOTS_ATTENDANT.pdf', 1),
(4, 'FAW Catalogues', 'actors.doc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryTitle` varchar(50) NOT NULL,
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryTitle`, `Active`) VALUES
(1, 'Tractor Heads', 1),
(2, 'Test Category', 1),
(3, 'Test Category 2', 1),
(4, 'In Active Category', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categorysubsections`
--

CREATE TABLE IF NOT EXISTS `categorysubsections` (
  `CategorySectionID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(11) NOT NULL,
  `SubSectionID` int(11) NOT NULL,
  `OrderNum` int(11) NOT NULL,
  PRIMARY KEY (`CategorySectionID`),
  KEY `fk_categorysections_categories` (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `categorysubsections`
--

INSERT INTO `categorysubsections` (`CategorySectionID`, `CategoryID`, `SubSectionID`, `OrderNum`) VALUES
(4, 3, 3, 0),
(5, 3, 4, 0),
(6, 4, 3, 0),
(11, 1, 4, 0),
(12, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `homepageslides`
--

CREATE TABLE IF NOT EXISTS `homepageslides` (
  `SlideID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `SubTitle` varchar(500) NOT NULL,
  `FileName` varchar(255) NOT NULL,
  `Link` varchar(255) NOT NULL,
  PRIMARY KEY (`SlideID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE IF NOT EXISTS `productimages` (
  `ProductImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `ImageName` varchar(255) NOT NULL,
  PRIMARY KEY (`ProductImageID`),
  KEY `fk_products_images` (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductTitle` varchar(255) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `Features` text NOT NULL,
  `Description` text NOT NULL,
  `CatalogueID` int(11) NOT NULL,
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `fk_products_brans` (`BrandID`),
  KEY `fk_products_catalogues` (`CatalogueID`),
  KEY `fk_products_categories` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `productspecifications`
--

CREATE TABLE IF NOT EXISTS `productspecifications` (
  `ProductSpecificationID` int(11) NOT NULL AUTO_INCREMENT,
  `SpecificationID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Specification` text NOT NULL,
  `OtherSpecificationTitle` varchar(255) NOT NULL,
  PRIMARY KEY (`ProductSpecificationID`),
  KEY `fk_productspecifications_products` (`ProductID`),
  KEY `fk_productspecifications_specifications` (`SpecificationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `SectionID` int(11) NOT NULL AUTO_INCREMENT,
  `SectionTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`SectionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`SectionID`, `SectionTitle`) VALUES
(1, 'Commercial Trucks'),
(2, 'Construction Equipment'),
(3, 'Mining Equipment');

-- --------------------------------------------------------

--
-- Table structure for table `sectionsubsections`
--

CREATE TABLE IF NOT EXISTS `sectionsubsections` (
  `SectionID` int(11) NOT NULL,
  `SubSectionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sectionsubsections`
--

INSERT INTO `sectionsubsections` (`SectionID`, `SubSectionID`) VALUES
(3, 3),
(3, 4),
(1, 0),
(2, 0),
(2, 0),
(3, 0),
(2, 2),
(3, 2),
(1, 5),
(3, 5),
(1, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE IF NOT EXISTS `specifications` (
  `SpecificationID` int(11) NOT NULL AUTO_INCREMENT,
  `SpecificationTitle` varchar(255) NOT NULL,
  `OrderID` int(11) NOT NULL,
  PRIMARY KEY (`SpecificationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subsections`
--

CREATE TABLE IF NOT EXISTS `subsections` (
  `SubSectionID` int(11) NOT NULL AUTO_INCREMENT,
  `SubSectionTitle` varchar(255) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`SubSectionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `subsections`
--

INSERT INTO `subsections` (`SubSectionID`, `SubSectionTitle`, `Active`) VALUES
(1, 'fafaf', 1),
(2, 'Test Sub Section Edits', 2),
(3, 'Active In-Active', 2),
(4, 'Test Active', 1),
(5, 'Testing.', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorysubsections`
--
ALTER TABLE `categorysubsections`
  ADD CONSTRAINT `categorysubsections_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `productimages`
--
ALTER TABLE `productimages`
  ADD CONSTRAINT `productimages_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`BrandID`) REFERENCES `brands` (`BrandID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`CatalogueID`) REFERENCES `catalogues` (`CatalogueID`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`CatalogueID`) REFERENCES `catalogues` (`CatalogueID`),
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `productspecifications`
--
ALTER TABLE `productspecifications`
  ADD CONSTRAINT `productspecifications_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `productspecifications_ibfk_2` FOREIGN KEY (`SpecificationID`) REFERENCES `specifications` (`SpecificationID`),
  ADD CONSTRAINT `productspecifications_ibfk_3` FOREIGN KEY (`SpecificationID`) REFERENCES `specifications` (`SpecificationID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
