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
    <nav style="background: white; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div class="logo-area">
            <a href="../../index.php">
                <h1 style="color: #c62828; margin: 0; font-size: 1.5rem;">DriveHub</h1>
            </a>
        </div>
        <div class="user-area" style="display: flex; align-items: center; gap: 20px;">
            <span style="color: #555; font-weight: 600;">
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            </span>
            <a href="../edit_profile.php" style="text-decoration: none; color: #555; font-size: 0.9rem;">Edit Profile</a>
            <a href="../fleet/display_car.php" style="text-decoration: none; color: #555; font-size: 0.9rem;">View Fleet</a>
            <a href="../logout.php" style="text-decoration: none; color: #c62828; border: 1px solid #c62828; padding: 5px 15px; border-radius: 5px; font-weight: 600;">Logout</a>
        </div>
    </nav>
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
