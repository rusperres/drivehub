<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $custID = $_POST['customerID'];
    $carID = $_POST['carID'];
    $resDate = date('Y-m-d H:i:s');
    $pickDate = $_POST['pickupDate'];
    $retDate = $_POST['returnDate'];

    $sql = "INSERT INTO reservation (customerID, carID, reservationDate, pickupDate, returnDate) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $custID, $carID, $resDate, $pickDate, $retDate);

    if ($stmt->execute()) {
        header("Location: display_reservation.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
    $stmt_customers = $conn->prepare("SELECT c.customerID, u.username FROM customer c JOIN users u ON c.userID = u.userID");
    $stmt_customers->execute();
    $customers_list = $stmt_customers->get_result();

    $stmt_cars = $conn->prepare("SELECT carID, brand, model, plateNumber FROM car");
    $stmt_cars->execute();
    $cars_list = $stmt_cars->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveHub | Add Reservation</title>
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
            <h2>Reservation Entry</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="customerID">Customer</label>
                    <select name="customerID" id="customerID" required >
                        <option value="">-- Select Customer --</option>
                        <?php while($cust = $customers_list->fetch_assoc()): ?>
                            <option value="<?php echo $cust['customerID']; ?>">
                                <?php echo htmlspecialchars($cust['username']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="carID">Vehicle</label>
                    <select name="carID" id="carID" required >
                        <option value="">-- Select Vehicle --</option>
                        <?php while($car = $cars_list->fetch_assoc()): ?>
                            <option value="<?php echo $car['carID']; ?>">
                                <?php echo htmlspecialchars($car['brand'] . " " . $car['model'] . " (" . $car['plateNumber'] . ")"); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pickupDate">Pickup Date</label>
                    <input type="datetime-local" name="pickupDate" id="pickupDate" required >
                </div>
                <div class="form-group">
                    <label for="returnDate">Return Date</label>
                    <input type="datetime-local" name="returnDate" id="returnDate" required >
                </div>
                <button type="submit" name="btnSave" class="btn-submit">Save Reservation</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
<?php
$stmt_customers->close();
$stmt_cars->close();
?>
