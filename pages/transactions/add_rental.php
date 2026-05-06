<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $resID = $_POST['reservationID'];
    $custID = $_POST['customerID'];
    $carID = $_POST['carID'];
    $empID = $_POST['employeeID'];
    $start = $_POST['startDate'];
    $end = $_POST['endDate'];
    $cost = $_POST['totalCost'];
    $status = $_POST['rentalStatus'];

    $sql = "INSERT INTO rental (reservationID, customerID, carID, employeeID, startDate, endDate, totalCost, rentalStatus) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiissds", $resID, $custID, $carID, $empID, $start, $end, $cost, $status);

    if ($stmt->execute()) {
        header("Location: display_rental.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveHub | Add Rental</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/forms.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="main-content">
        <div class="form-card">
            <h2>Rental Agreement</h2>
            <form method="POST">
                <input type="number" name="reservationID" placeholder="Reservation ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="number" name="customerID" placeholder="Customer ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="number" name="carID" placeholder="Car ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="number" name="employeeID" placeholder="Employee ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="datetime-local" name="startDate" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="datetime-local" name="endDate" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="number" step="0.01" name="totalCost" placeholder="Total Cost" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="text" name="rentalStatus" placeholder="Status (e.g. Active, Closed)" required>
                <button type="submit" name="btnSave" class="btn-submit">Save Rental</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
