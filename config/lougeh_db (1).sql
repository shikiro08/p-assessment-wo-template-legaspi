-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2024 at 03:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lougeh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `component_id` int(11) NOT NULL,
  `component_name` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`component_id`, `component_name`, `description`) VALUES
(1, 'Microcontroller IC', 'The main ESP32 chip (ESP32-WROOM-32)'),
(2, 'PCB', 'Printed Circuit Board used for creating circuit design of the components'),
(3, 'Resistor', 'use to control the flow of current'),
(4, 'Diode', 'use to control the flow of current in a particular direction'),
(5, 'Relay', 'use to control high current equipment from low voltage source'),
(10, 'Breadboard', 'use for testing circuit connection before using PCB'),
(11, 'jumper wires', 'connectors'),
(12, 'jumper wires', 'connectors');

-- --------------------------------------------------------

--
-- Table structure for table `component_suppliers`
--

CREATE TABLE `component_suppliers` (
  `component_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `component_suppliers`
--

INSERT INTO `component_suppliers` (`component_id`, `supplier_id`) VALUES
(1, 1),
(2, 2),
(10, 2),
(12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `description`, `quantity`) VALUES
(1, 'ESP32', 'A type of microcontroller use for IOT and embedded system', 5),
(2, 'ESP32', 'A type of microcontroller use for IOT and embedded system', 5),
(3, 'Arduino', 'Use for IOT and embedded systems', 50),
(4, 'Raspberry Pi', 'Portable computer and a powerful microcontroller that is used for embedded systems and many other things', 5),
(5, 'Raspberry Pi', 'Portable computer and a powerful microcontroller that is used for embedded systems and many other things', 5),
(6, 'Orange Pi', 'Popular Microcontroller used for vendos such as Wifi vendo and water dispenser vendos which can also be used in embedded system and IOT', 45),
(7, 'Sim900', 'use for data cellular communication ', 5),
(8, 'Copper Wires', 'connectors', 60);

-- --------------------------------------------------------

--
-- Table structure for table `product_components`
--

CREATE TABLE `product_components` (
  `product_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_components`
--

INSERT INTO `product_components` (`product_id`, `component_id`) VALUES
(1, 1),
(3, 2),
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(200) NOT NULL,
  `c_number` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sup_id`, `sup_name`, `c_number`, `address`) VALUES
(1, 'Lleined', '09933255921', 'P.I 166 Brgy City Heights G.S.C'),
(2, 'esspressif', '09635962804', 'Sample st. Brgy guide same place'),
(3, 'shapee', '09093489561', 'Avenue of Stars, Tsim Sha Tsui, Hong Kong');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`component_id`);

--
-- Indexes for table `component_suppliers`
--
ALTER TABLE `component_suppliers`
  ADD PRIMARY KEY (`component_id`,`supplier_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product_components`
--
ALTER TABLE `product_components`
  ADD PRIMARY KEY (`product_id`,`component_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `component_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `component_suppliers`
--
ALTER TABLE `component_suppliers`
  ADD CONSTRAINT `component_suppliers_ibfk_1` FOREIGN KEY (`component_id`) REFERENCES `components` (`component_id`),
  ADD CONSTRAINT `component_suppliers_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`sup_id`);

--
-- Constraints for table `product_components`
--
ALTER TABLE `product_components`
  ADD CONSTRAINT `product_components_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`p_id`),
  ADD CONSTRAINT `product_components_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `components` (`component_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
