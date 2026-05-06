<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $custID = $_POST['customerID'];
    $carID = $_POST['carID'];
    $resDate = date('Y-m-d H:i:s');
    $pickDate = $_POST['pickupDate'];
    $retDate = $_POST['returnDate'];

    $sql = "INSERT INTO reservation (customerID, carID, reservationDate, pickupDate, returnDate) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $custID, $carID, $resDate, $pickDate, $retDate);

    if ($stmt->execute()) {
        header("Location: display_reservation.php");
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
    <title>DriveHub | Add Reservation</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/forms.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="main-content">
        <div class="form-card">
            <h2>Reservation Entry</h2>
            <form method="POST">
                <input type="number" name="customerID" placeholder="Customer ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="number" name="carID" placeholder="Car ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <div class="form-group-label" style="text-align: left; font-size: 0.8rem; color: #888; margin-bottom: 5px;">Pickup Date:</div>
                <input type="datetime-local" name="pickupDate" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <div class="form-group-label" style="text-align: left; font-size: 0.8rem; color: #888; margin-bottom: 5px;">Return Date:</div>
                <input type="datetime-local" name="returnDate" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <button type="submit" name="btnSave" class="btn-submit">Save Reservation</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
