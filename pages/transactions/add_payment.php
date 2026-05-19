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
    $stmt_rentals = $conn->prepare("SELECT r.rentalID, c.brand, c.model, u.username, r.totalCost FROM rental r JOIN car c ON r.carID = c.carID JOIN customer cust ON r.customerID = cust.customerID JOIN users u ON cust.userID = u.userID");
    $stmt_rentals->execute();
    $rentals_list = $stmt_rentals->get_result();
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
    <div class="main-content">
        <div class="form-card">
            <h2>Payment Entry</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="rentalID">Rental Agreement</label>
                    <select name="rentalID" id="rentalID" required >
                        <option value="">-- Select Rental --</option>
                        <?php while($rent = $rentals_list->fetch_assoc()): ?>
                            <option value="<?php echo $rent['rentalID']; ?>">
                                Rental #<?php echo $rent['rentalID']; ?> - <?php echo htmlspecialchars($rent['brand'] . " " . $rent['model'] . " (for " . $rent['username'] . ")"); ?> - $<?php echo $rent['totalCost']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="paymentDate">Payment Date</label>
                    <input type="datetime-local" name="paymentDate" id="paymentDate" required >
                </div>
                <input type="text" name="paymentMethod" placeholder="Payment Method (e.g. Cash, Card)" required>
                <input type="number" step="0.01" name="amountPaid" placeholder="Amount Paid" required >
                <button type="submit" name="btnSave" class="btn-submit">Save Payment</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
<?php
$stmt_rentals->close();
?>
