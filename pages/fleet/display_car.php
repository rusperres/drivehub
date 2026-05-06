<?php
session_start();
include('../../utils/db.php');
if (!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit(); 
}

$query = "SELECT * FROM car";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Fleet List</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
    <?php
        include('../../components/navbar.php');
    ?>
    <div class="container">
        <a href="../../index.php" class="btn-back">← Back to Home</a>
        <h2>Vehicle Inventory</h2>
        <table>
            <thead>
                <tr><th>Plate No.</th><th>Brand</th><th>Model</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['plateNumber']; ?></td>
                    <td><?php echo $row['brand']; ?></td>
                    <td><?php echo $row['model']; ?></td>
                    <td><span class="status-available"><?php echo $row['status']; ?></span></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>