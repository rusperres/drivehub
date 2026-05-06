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
    <?php
    include('../../components/navbar.php');
    ?>
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