car
carID, categoryID, plateNumber, brand, model, status

carcategory
categoryID, categoryName, dailyRate, categoryDescription

customer
customerID, phonePrimary, phoneAlternative, licenseNumberImg, dateOfBirth, registrationDate, userID

employee
employeeID, position, phoneNumber, userID

insurance
insuranceID, carID, providerName, coverageType, startDate, expiryDate

maintenancerecord
maintenanceID, carID, maintenanceDate, maintenanceDescription, maintenanceType, cost

payment
paymentID, rentalID, paymentDate, paymentMethod, amountPaid

rental
rentalID, reservationID, customerID, carID, employeeID, startDate, endDate, totalCost, rentalStatus

reservation
reservationID, customerID, carID, reservationDate, pickupDate, returnDate

review
reviewID, rentalID, customerID, rating, comment, reviewDate

users
userID, username, email, password, role

