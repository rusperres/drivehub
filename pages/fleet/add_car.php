<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if (isset($_POST['btnSave'])) {
    $plate = $_POST['plate'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];

    $sql = "INSERT INTO car (plateNumber, brand, model, status, categoryID) 
            VALUES (?, ?, ?, 'Available', 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $plate, $brand, $model);

    if ($stmt->execute()) {
        header("Location: display_car.php");
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
    <title>DriveHub | Add New Vehicle</title>
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
            <h2>Vehicle Registration</h2>
            <form method="POST">
                <input type="text" name="plate" placeholder="Plate Number (e.g. ABC-1234)" required>
                <input type="text" name="brand" placeholder="Vehicle Brand (e.g. Toyota)" required>
                <input type="text" name="model" placeholder="Vehicle Model (e.g. Vios)" required>
                <button type="submit" name="btnSave" class="btn-submit">Save Vehicle Record</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back to Dashboard</a>
        </div>
    </div>

</body>

</html>