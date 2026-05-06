<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM rental";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Rentals</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="container">
        <a href="../../index.php" class="btn-back">← Back to Home</a>
        <h2>Rental Records</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Res ID</th>
                    <th>Cust ID</th>
                    <th>Car ID</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Cost</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['rentalID']; ?></td>
                    <td><?php echo $row['reservationID']; ?></td>
                    <td><?php echo $row['customerID']; ?></td>
                    <td><?php echo $row['carID']; ?></td>
                    <td><?php echo $row['startDate']; ?></td>
                    <td><?php echo $row['endDate']; ?></td>
                    <td><?php echo number_format($row['totalCost'], 2); ?></td>
                    <td><?php echo $row['rentalStatus']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
