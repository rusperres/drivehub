<?php
session_start();
include('../../utils/db.php');
if (!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit(); 
}

$query = "SELECT c.plateNumber, c.brand, c.model, c.status, cc.categoryName 
          FROM car c
          LEFT JOIN carcategory cc ON c.categoryID = cc.categoryID";
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
    <nav class="navbar">
        <div class="logo-area">
            <a href="../../index.php">
                <h1 class="navbar-logo">DriveHub</h1>
            </a>
        </div>
        <div class="user-area">
            <span class="user-welcome">
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            </span>
            <a href="../edit_profile.php" class="nav-link">Edit Profile</a>
            <a href="../fleet/display_car.php" class="nav-link">View Fleet</a>
            <a href="../logout.php" class="btn-logout">Logout</a>
        </div>
    </nav>
    <div class="container">
        <a href="../../index.php" class="btn-back">← Back to Home</a>
        <h2>Vehicle Inventory</h2>
        <table>
            <thead>
                <tr><th>Plate No.</th><th>Category</th><th>Brand</th><th>Model</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['plateNumber']); ?></td>
                    <td><?php echo htmlspecialchars($row['categoryName']); ?></td>
                    <td><?php echo htmlspecialchars($row['brand']); ?></td>
                    <td><?php echo htmlspecialchars($row['model']); ?></td>
                    <td><span class="status-available"><?php echo htmlspecialchars($row['status']); ?></span></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>