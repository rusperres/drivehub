<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $name = $_POST['categoryName'];
    $rate = $_POST['dailyRate'];
    $desc = $_POST['categoryDescription'];

    $sql = "INSERT INTO carcategory (categoryName, dailyRate, categoryDescription) 
            VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sds", $name, $rate, $desc);

    if ($stmt->execute()) {
        header("Location: display_carcategory.php");
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
    <title>DriveHub | Add Car Category</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/forms.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="main-content">
        <div class="form-card">
            <h2>Category Registration</h2>
            <form method="POST">
                <input type="text" name="categoryName" placeholder="Category Name (e.g. SUV)" required>
                <input type="number" step="0.01" name="dailyRate" placeholder="Daily Rate (e.g. 2500.00)" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <textarea name="categoryDescription" placeholder="Description" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; height: 100px;"></textarea>
                <button type="submit" name="btnSave" class="btn-submit">Save Category</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
