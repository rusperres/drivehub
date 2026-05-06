<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $position = $_POST['position'];
    $phone = $_POST['phoneNumber'];
    $userID = $_POST['userID'];

    $sql = "INSERT INTO employee (position, phoneNumber, userID) 
            VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $position, $phone, $userID);

    if ($stmt->execute()) {
        header("Location: display_employee.php");
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
    <title>DriveHub | Add Employee</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/forms.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="main-content">
        <div class="form-card">
            <h2>Employee Registration</h2>
            <form method="POST">
                <input type="text" name="position" placeholder="Position (e.g. Manager)" required>
                <input type="text" name="phoneNumber" placeholder="Phone Number" required>
                <input type="number" name="userID" placeholder="User ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <button type="submit" name="btnSave" class="btn-submit">Save Employee</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
