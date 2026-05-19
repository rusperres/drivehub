<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $carID = $_POST['carID'];
    $date = $_POST['maintenanceDate'];
    $desc = $_POST['maintenanceDescription'];
    $type = $_POST['maintenanceType'];
    $cost = $_POST['cost'];

    $sql = "INSERT INTO maintenancerecord (carID, maintenanceDate, maintenanceDescription, maintenanceType, cost) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssd", $carID, $date, $desc, $type, $cost);

    if ($stmt->execute()) {
        header("Location: display_maintenancerecord.php");
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
    <title>DriveHub | Add Maintenance</title>
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
            <h2>Maintenance Record</h2>
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
                <div class="form-group">
                    <label for="maintenanceDate">Maintenance Date</label>
                    <input type="date" name="maintenanceDate" id="maintenanceDate" required >
                </div>
                <input type="text" name="maintenanceType" placeholder="Maintenance Type (e.g. Oil Change)" required>
                <input type="number" step="0.01" name="cost" placeholder="Cost" required >
                <textarea name="maintenanceDescription" placeholder="Description" required ></textarea>
                <button type="submit" name="btnSave" class="btn-submit">Save Record</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
<?php
$stmt_cars->close();
?>
