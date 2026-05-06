<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM insurance";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Insurance Records</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="container">
        <a href="../../index.php" class="btn-back">← Back to Home</a>
        <h2>Insurance Records</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car ID</th>
                    <th>Provider</th>
                    <th>Type</th>
                    <th>Start Date</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['insuranceID']; ?></td>
                    <td><?php echo $row['carID']; ?></td>
                    <td><?php echo $row['providerName']; ?></td>
                    <td><?php echo $row['coverageType']; ?></td>
                    <td><?php echo $row['startDate']; ?></td>
                    <td><?php echo $row['expiryDate']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
