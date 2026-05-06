<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $phone1 = $_POST['phonePrimary'];
    $phone2 = $_POST['phoneAlternative'];
    $dob = $_POST['dateOfBirth'];
    $regDate = date('Y-m-d');
    $userID = $_POST['userID'];

    $sql = "INSERT INTO customer (phonePrimary, phoneAlternative, dateOfBirth, registrationDate, userID) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $phone1, $phone2, $dob, $regDate, $userID);

    if ($stmt->execute()) {
        header("Location: display_customer.php");
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
    <title>DriveHub | Add Customer</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/forms.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="main-content">
        <div class="form-card">
            <h2>Customer Registration</h2>
            <form method="POST">
                <input type="text" name="phonePrimary" placeholder="Primary Phone" required>
                <input type="text" name="phoneAlternative" placeholder="Alternative Phone">
                <input type="date" name="dateOfBirth" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <input type="number" name="userID" placeholder="User ID" required style="width: 100%; padding: 12px 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
                <button type="submit" name="btnSave" class="btn-submit">Save Customer</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
