<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM maintenancerecord";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Maintenance Records</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="container">
        <a href="../../index.php" class="btn-back">← Back to Home</a>
        <h2>Maintenance History</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car ID</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Cost</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['maintenanceID']; ?></td>
                    <td><?php echo $row['carID']; ?></td>
                    <td><?php echo $row['maintenanceDate']; ?></td>
                    <td><?php echo $row['maintenanceType']; ?></td>
                    <td><?php echo number_format($row['cost'], 2); ?></td>
                    <td><?php echo $row['maintenanceDescription']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
