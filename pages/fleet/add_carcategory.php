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
            <h2>Category Registration</h2>
            <form method="POST">
                <input type="text" name="categoryName" placeholder="Category Name (e.g. SUV)" required>
                <input type="number" step="0.01" name="dailyRate" placeholder="Daily Rate (e.g. 2500.00)" required >
                <textarea name="categoryDescription" placeholder="Description" required ></textarea>
                <button type="submit" name="btnSave" class="btn-submit">Save Category</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
