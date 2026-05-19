<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT p.*, r.rentalID, u.username
          FROM payment p
          LEFT JOIN rental r ON p.rentalID = r.rentalID
          LEFT JOIN customer c ON r.customerID = c.customerID
          LEFT JOIN users u ON c.userID = u.userID";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Payments</title>
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
        <h2>Payment Records</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rental Agreement</th>
                    <th>Date</th>
                    <th>Method</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['paymentID']; ?></td>
                    <td>Rental #<?php echo $row['rentalID']; ?> (<?php echo htmlspecialchars($row['username']); ?>)</td>
                    <td><?php echo htmlspecialchars($row['paymentDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['paymentMethod']); ?></td>
                    <td><?php echo number_format($row['amountPaid'], 2); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
