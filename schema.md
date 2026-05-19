
CREATE TABLE `car` (
 `carID` int(11) NOT NULL AUTO_INCREMENT,
 `categoryID` int(11) DEFAULT NULL,
 `plateNumber` varchar(50) NOT NULL,
 `brand` varchar(100) DEFAULT NULL,
 `model` varchar(100) DEFAULT NULL,
 `status` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`carID`),
 KEY `categoryID` (`categoryID`),
 CONSTRAINT `car_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `carcategory` (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `carcategory` (
 `categoryID` int(11) NOT NULL AUTO_INCREMENT,
 `categoryName` varchar(100) NOT NULL,
 `dailyRate` decimal(10,2) NOT NULL,
 `categoryDescription` text DEFAULT NULL,
 PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `customer` (
 `customerID` int(11) NOT NULL AUTO_INCREMENT,
 `phonePrimary` varchar(20) DEFAULT NULL,
 `phoneAlternative` varchar(20) DEFAULT NULL,
 `licenseNumberImg` blob DEFAULT NULL,
 `dateOfBirth` date DEFAULT NULL,
 `registrationDate` date DEFAULT NULL,
 `userID` int(11) DEFAULT NULL,
 PRIMARY KEY (`customerID`),
 UNIQUE KEY `userID` (`userID`),
 CONSTRAINT `fk_customer_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `employee` (
 `employeeID` int(11) NOT NULL AUTO_INCREMENT,
 `position` varchar(100) DEFAULT NULL,
 `phoneNumber` varchar(20) DEFAULT NULL,
 `userID` int(11) DEFAULT NULL,
 PRIMARY KEY (`employeeID`),
 UNIQUE KEY `userID` (`userID`),
 CONSTRAINT `fk_employee_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `insurance` (
 `insuranceID` int(11) NOT NULL AUTO_INCREMENT,
 `carID` int(11) DEFAULT NULL,
 `providerName` varchar(255) DEFAULT NULL,
 `coverageType` varchar(100) DEFAULT NULL,
 `startDate` date DEFAULT NULL,
 `expiryDate` date DEFAULT NULL,
 PRIMARY KEY (`insuranceID`),
 KEY `carID` (`carID`),
 CONSTRAINT `insurance_ibfk_1` FOREIGN KEY (`carID`) REFERENCES `car` (`carID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `maintenancerecord` (
 `maintenanceID` int(11) NOT NULL AUTO_INCREMENT,
 `carID` int(11) DEFAULT NULL,
 `maintenanceDate` date DEFAULT NULL,
 `maintenanceDescription` text DEFAULT NULL,
 `maintenanceType` varchar(100) DEFAULT NULL,
 `cost` decimal(10,2) DEFAULT NULL,
 PRIMARY KEY (`maintenanceID`),
 KEY `carID` (`carID`),
 CONSTRAINT `maintenancerecord_ibfk_1` FOREIGN KEY (`carID`) REFERENCES `car` (`carID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `payment` (
 `paymentID` int(11) NOT NULL AUTO_INCREMENT,
 `rentalID` int(11) DEFAULT NULL,
 `paymentDate` datetime DEFAULT NULL,
 `paymentMethod` varchar(50) DEFAULT NULL,
 `amountPaid` decimal(10,2) DEFAULT NULL,
 PRIMARY KEY (`paymentID`),
 KEY `rentalID` (`rentalID`),
 CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`rentalID`) REFERENCES `rental` (`rentalID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `rental` (
 `rentalID` int(11) NOT NULL AUTO_INCREMENT,
 `reservationID` int(11) DEFAULT NULL,
 `customerID` int(11) DEFAULT NULL,
 `carID` int(11) DEFAULT NULL,
 `employeeID` int(11) DEFAULT NULL,
 `startDate` datetime DEFAULT NULL,
 `endDate` datetime DEFAULT NULL,
 `totalCost` decimal(10,2) DEFAULT NULL,
 `rentalStatus` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`rentalID`),
 KEY `reservationID` (`reservationID`),
 KEY `customerID` (`customerID`),
 KEY `carID` (`carID`),
 KEY `employeeID` (`employeeID`),
 CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`reservationID`) REFERENCES `reservation` (`reservationID`),
 CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
 CONSTRAINT `rental_ibfk_3` FOREIGN KEY (`carID`) REFERENCES `car` (`carID`),
 CONSTRAINT `rental_ibfk_4` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `reservation` (
 `reservationID` int(11) NOT NULL AUTO_INCREMENT,
 `customerID` int(11) DEFAULT NULL,
 `carID` int(11) DEFAULT NULL,
 `reservationDate` datetime DEFAULT NULL,
 `pickupDate` datetime DEFAULT NULL,
 `returnDate` datetime DEFAULT NULL,
 PRIMARY KEY (`reservationID`),
 KEY `customerID` (`customerID`),
 KEY `carID` (`carID`),
 CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
 CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`carID`) REFERENCES `car` (`carID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `review` (
 `reviewID` int(11) NOT NULL AUTO_INCREMENT,
 `rentalID` int(11) DEFAULT NULL,
 `customerID` int(11) DEFAULT NULL,
 `rating` int(11) DEFAULT NULL,
 `comment` text DEFAULT NULL,
 `reviewDate` date DEFAULT NULL,
 PRIMARY KEY (`reviewID`),
 KEY `rentalID` (`rentalID`),
 KEY `customer_id` (`customerID`),
 CONSTRAINT `review_ibfk_1` FOREIGN KEY (`rentalID`) REFERENCES `rental` (`rentalID`),
 CONSTRAINT `review_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `users` (
 `userID` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(100) NOT NULL,
 `email` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 `role` enum('customer','employee') DEFAULT 'customer',
 PRIMARY KEY (`userID`),
 UNIQUE KEY `username` (`username`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci