<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM review";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Reviews</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="container">
        <a href="../../index.php" class="btn-back">← Back to Home</a>
        <h2>Customer Reviews</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rent ID</th>
                    <th>Cust ID</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['reviewID']; ?></td>
                    <td><?php echo $row['rentalID']; ?></td>
                    <td><?php echo $row['customerID']; ?></td>
                    <td><?php echo $row['rating']; ?> / 5</td>
                    <td><?php echo $row['reviewDate']; ?></td>
                    <td><?php echo $row['comment']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
