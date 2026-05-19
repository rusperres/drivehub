<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $carID = $_POST['carID'];
    $provider = $_POST['providerName'];
    $type = $_POST['coverageType'];
    $start = $_POST['startDate'];
    $expiry = $_POST['expiryDate'];

    $sql = "INSERT INTO insurance (carID, providerName, coverageType, startDate, expiryDate) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $carID, $provider, $type, $start, $expiry);

    if ($stmt->execute()) {
        header("Location: display_insurance.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
    $stmt_cars = $conn->prepare("SELECT carID, brand, model, plateNumber FROM car");
    $stmt_cars->execute();
    $cars_list = $stmt_cars->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveHub | Add Insurance</title>
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
            <h2>Insurance Registration</h2>
            <form method="POST">
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
                <input type="text" name="providerName" placeholder="Provider Name" required>
                <input type="text" name="coverageType" placeholder="Coverage Type" required>
                <div class="form-group">
                    <label for="startDate">Start Date</label>
                    <input type="date" name="startDate" id="startDate" required >
                </div>
                <div class="form-group">
                    <label for="expiryDate">Expiry Date</label>
                    <input type="date" name="expiryDate" id="expiryDate" required >
                </div>
                <button type="submit" name="btnSave" class="btn-submit">Save Insurance</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
