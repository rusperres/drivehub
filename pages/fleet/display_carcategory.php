<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM carcategory";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Car Categories</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="container">
        <a href="../../index.php" class="btn-back">← Back to Home</a>
        <h2>Car Categories</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Daily Rate</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['categoryID']; ?></td>
                    <td><?php echo $row['categoryName']; ?></td>
                    <td><?php echo number_format($row['dailyRate'], 2); ?></td>
                    <td><?php echo $row['categoryDescription']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
