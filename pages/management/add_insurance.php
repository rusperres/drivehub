<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $carID = $_POST['carID'];
    $provider = $_POST['providerName'];
    $type = $_POST['coverageType'];
    $start = $_POST['startDate'];
    $expiry = $_POST['expiryDate'];

    $sql = "INSERT INTO insurance (carID, providerName, coverageType, startDate, expiryDate) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $carID, $provider, $type, $start, $expiry);

    if ($stmt->execute()) {
        header("Location: display_insurance.php");
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
    <title>DriveHub | Add Insurance</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/forms.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="main-content">
        <div class="form-card">
            <h2>Insurance Registration</h2>
            <form method="POST">
                <input type="number" name="carID" placeholder="Car ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="text" name="providerName" placeholder="Provider Name" required>
                <input type="text" name="coverageType" placeholder="Coverage Type" required>
                <div class="form-group-label" style="text-align: left; font-size: 0.8rem; color: #888; margin-bottom: 5px;">Start Date:</div>
                <input type="date" name="startDate" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <div class="form-group-label" style="text-align: left; font-size: 0.8rem; color: #888; margin-bottom: 5px;">Expiry Date:</div>
                <input type="date" name="expiryDate" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <button type="submit" name="btnSave" class="btn-submit">Save Insurance</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
