<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT r.*, u.username, c.brand, c.model, c.plateNumber 
          FROM rental r
          LEFT JOIN customer cu ON r.customerID = cu.customerID
          LEFT JOIN users u ON cu.userID = u.userID
          LEFT JOIN car c ON r.carID = c.carID";
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
        <h2>Rental Records</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Res ID</th>
                    <th>Customer</th>
                    <th>Vehicle</th>
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
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['brand'] . ' ' . $row['model'] . ' (' . $row['plateNumber'] . ')'); ?></td>
                    <td><?php echo htmlspecialchars($row['startDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['endDate']); ?></td>
                    <td><?php echo number_format($row['totalCost'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['rentalStatus']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
