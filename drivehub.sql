-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2026 at 11:37 AM
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
-- Database: `drivehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `carID` int(11) NOT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `plateNumber` varchar(50) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`carID`, `categoryID`, `plateNumber`, `brand`, `model`, `status`) VALUES
(1, 1, 'AAA-1111', 'Toyota', 'Vios', 'available'),
(2, 1, 'BBB-2222', 'Honda', 'City', 'available'),
(3, 2, 'CCC-3333', 'Hyundai', 'Elantra', 'available'),
(4, 2, 'DDD-4444', 'Toyota', 'Corolla Altis', 'available'),
(5, 3, 'EEE-5555', 'Mitsubishi', 'Montero Sport', 'available'),
(6, 4, 'FFF-6666', 'BMW', '5 Series', 'available'),
(7, 1, 'ABC987', 'Suzuki', 'Swift', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `carcategory`
--

CREATE TABLE `carcategory` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `dailyRate` decimal(10,2) NOT NULL,
  `categoryDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carcategory`
--

INSERT INTO `carcategory` (`categoryID`, `categoryName`, `dailyRate`, `categoryDescription`) VALUES
(1, 'Economy', 1200.00, 'Fuel-efficient small cars'),
(2, 'Sedan', 1800.00, 'Comfortable city cars'),
(3, 'SUV', 2500.00, 'Family vehicles'),
(4, 'Luxury', 5000.00, 'Premium vehicles');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `phonePrimary` varchar(20) DEFAULT NULL,
  `phoneAlternative` varchar(20) DEFAULT NULL,
  `licenseNumberImg` blob DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `phonePrimary`, `phoneAlternative`, `licenseNumberImg`, `dateOfBirth`, `registrationDate`, `userID`) VALUES
(3, '09171234567', '09170000000', NULL, '2003-05-10', '2026-04-17', 1),
(4, '09178889999', NULL, NULL, '2002-11-20', '2026-04-17', 4);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `position`, `phoneNumber`, `userID`) VALUES
(1, 'Admin', '09171112222', 2),
(2, 'Staff', '09173334444', 3);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `insuranceID` int(11) NOT NULL,
  `carID` int(11) DEFAULT NULL,
  `providerName` varchar(255) DEFAULT NULL,
  `coverageType` varchar(100) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `expiryDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`insuranceID`, `carID`, `providerName`, `coverageType`, `startDate`, `expiryDate`) VALUES
(1, 1, 'AXA Philippines', 'Full Coverage', '2026-01-01', '2026-12-31'),
(2, 2, 'Malayan Insurance', 'Third Party', '2026-02-01', '2027-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `maintenancerecord`
--

CREATE TABLE `maintenancerecord` (
  `maintenanceID` int(11) NOT NULL,
  `carID` int(11) DEFAULT NULL,
  `maintenanceDate` date DEFAULT NULL,
  `maintenanceDescription` text DEFAULT NULL,
  `maintenanceType` varchar(100) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenancerecord`
--

INSERT INTO `maintenancerecord` (`maintenanceID`, `carID`, `maintenanceDate`, `maintenanceDescription`, `maintenanceType`, `cost`) VALUES
(1, 5, '2026-04-10', 'Oil change and inspection', 'Routine', 3000.00),
(2, 3, '2026-04-12', 'Brake pad replacement', 'Repair', 4500.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `rentalID` int(11) DEFAULT NULL,
  `paymentDate` datetime DEFAULT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `amountPaid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `rentalID`, `paymentDate`, `paymentMethod`, `amountPaid`) VALUES
(1, 1, '2026-04-17 23:41:45', 'Cash', 2400.00),
(2, 2, '2026-04-17 23:41:45', 'GCash', 3600.00),
(3, 1, '2026-04-17 23:46:03', 'Cash', 2400.00),
(4, 2, '2026-04-17 23:46:03', 'GCash', 3600.00);

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `rentalID` int(11) NOT NULL,
  `reservationID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `carID` int(11) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `totalCost` decimal(10,2) DEFAULT NULL,
  `rentalStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`rentalID`, `reservationID`, `customerID`, `carID`, `employeeID`, `startDate`, `endDate`, `totalCost`, `rentalStatus`) VALUES
(1, 1, 3, 1, 1, '2026-04-18 10:00:00', '2026-04-20 10:00:00', 2400.00, 'completed'),
(2, 2, 4, 2, 2, '2026-04-19 09:00:00', '2026-04-21 09:00:00', 3600.00, 'ongoing'),
(3, 1, 3, 1, 1, '2026-04-18 09:00:00', '2026-04-20 09:00:00', 2400.00, 'completed'),
(4, 2, 3, 2, 2, '2026-04-21 09:00:00', '2026-04-23 09:00:00', 3600.00, 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservationID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `carID` int(11) DEFAULT NULL,
  `reservationDate` datetime DEFAULT NULL,
  `pickupDate` datetime DEFAULT NULL,
  `returnDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationID`, `customerID`, `carID`, `reservationDate`, `pickupDate`, `returnDate`) VALUES
(1, 3, 1, '2026-04-17 23:41:45', '2026-04-18 10:00:00', '2026-04-20 10:00:00'),
(2, 4, 2, '2026-04-17 23:41:45', '2026-04-19 09:00:00', '2026-04-21 09:00:00'),
(5, 3, 1, '2026-04-17 23:46:03', '2026-04-18 09:00:00', '2026-04-20 09:00:00'),
(6, 3, 2, '2026-04-17 23:46:03', '2026-04-21 09:00:00', '2026-04-23 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(11) NOT NULL,
  `rentalID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `reviewDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `rentalID`, `customerID`, `rating`, `comment`, `reviewDate`) VALUES
(1, 1, 3, 5, 'Very smooth experience and clean car!', '2026-04-17'),
(2, 2, 4, 4, 'Good service, slight delay on pickup.', '2026-04-17'),
(3, 1, 3, 5, 'Very smooth experience. Clean car and easy booking.', '2026-04-17'),
(4, 2, 3, 4, 'Good service overall.', '2026-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','employee') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `role`) VALUES
(1, 'Jairus Jasper V. Colindres', 'colindresjairus@gmail.com', '123456', 'customer'),
(2, 'anna_emp', 'anna@gmail.com', '1234', 'employee'),
(3, 'mark_emp', 'mark@gmail.com', '1234', 'employee'),
(4, 'lisa', 'lisa@gmail.com', '1234', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`carID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `carcategory`
--
ALTER TABLE `carcategory`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`insuranceID`),
  ADD KEY `carID` (`carID`);

--
-- Indexes for table `maintenancerecord`
--
ALTER TABLE `maintenancerecord`
  ADD PRIMARY KEY (`maintenanceID`),
  ADD KEY `carID` (`carID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `rentalID` (`rentalID`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rentalID`),
  ADD KEY `reservationID` (`reservationID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `carID` (`carID`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `carID` (`carID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `rentalID` (`rentalID`),
  ADD KEY `customer_id` (`customerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `carID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carcategory`
--
ALTER TABLE `carcategory`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `insuranceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maintenancerecord`
--
ALTER TABLE `maintenancerecord`
  MODIFY `maintenanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `rentalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `carcategory` (`categoryID`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_employee_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insurance`
--
ALTER TABLE `insurance`
  ADD CONSTRAINT `insurance_ibfk_1` FOREIGN KEY (`carID`) REFERENCES `car` (`carID`);

--
-- Constraints for table `maintenancerecord`
--
ALTER TABLE `maintenancerecord`
  ADD CONSTRAINT `maintenancerecord_ibfk_1` FOREIGN KEY (`carID`) REFERENCES `car` (`carID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`rentalID`) REFERENCES `rental` (`rentalID`);

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`reservationID`) REFERENCES `reservation` (`reservationID`),
  ADD CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `rental_ibfk_3` FOREIGN KEY (`carID`) REFERENCES `car` (`carID`),
  ADD CONSTRAINT `rental_ibfk_4` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`carID`) REFERENCES `car` (`carID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`rentalID`) REFERENCES `rental` (`rentalID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
