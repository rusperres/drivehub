<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT r.*, u.username 
          FROM review r
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
    <title>DriveHub | Reviews</title>
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
        <h2>Customer Reviews</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rental Agreement</th>
                    <th>Reviewer</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['reviewID']; ?></td>
                    <td>Rental #<?php echo $row['rentalID']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo $row['rating']; ?> / 5</td>
                    <td><?php echo htmlspecialchars($row['reviewDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['comment']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
