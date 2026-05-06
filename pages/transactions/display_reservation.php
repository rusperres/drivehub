<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM reservation";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Reservations</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="container">
        <a href="../../index.php" class="btn-back">← Back to Home</a>
        <h2>Reservation List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cust ID</th>
                    <th>Car ID</th>
                    <th>Res. Date</th>
                    <th>Pickup</th>
                    <th>Return</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['reservationID']; ?></td>
                    <td><?php echo $row['customerID']; ?></td>
                    <td><?php echo $row['carID']; ?></td>
                    <td><?php echo $row['reservationDate']; ?></td>
                    <td><?php echo $row['pickupDate']; ?></td>
                    <td><?php echo $row['returnDate']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
