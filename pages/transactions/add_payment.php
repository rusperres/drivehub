<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $rentalID = $_POST['rentalID'];
    $date = $_POST['paymentDate'];
    $method = $_POST['paymentMethod'];
    $amount = $_POST['amountPaid'];

    $sql = "INSERT INTO payment (rentalID, paymentDate, paymentMethod, amountPaid) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issd", $rentalID, $date, $method, $amount);

    if ($stmt->execute()) {
        header("Location: display_payment.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveHub | Add Payment</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/forms.css">
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
    <div class="main-content">
        <div class="form-card">
            <h2>Payment Entry</h2>
            <form method="POST">
                <input type="number" name="rentalID" placeholder="Rental ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="datetime-local" name="paymentDate" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="text" name="paymentMethod" placeholder="Payment Method (e.g. Cash, Card)" required>
                <input type="number" step="0.01" name="amountPaid" placeholder="Amount Paid" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <button type="submit" name="btnSave" class="btn-submit">Save Payment</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
