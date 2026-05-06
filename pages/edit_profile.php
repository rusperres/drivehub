<?php
session_start();
include('../utils/db.php');
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }



if (isset($_POST['btnUpdate'])) {
    $newName = $_POST['username'];
    
    $query = "UPDATE users SET username = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $newName, $_SESSION['username']);
    if ($stmt->execute()) {
        $_SESSION['username'] = $newName; 
        header("Location: ../index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveHub | Edit Profile</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/forms.css">
</head>
<body>
    <nav><h1>DriveHub</h1></nav>
    <div class="main-content">
        <div class="form-card">
            <h2>Edit Your Profile</h2>
            <form method="POST">
                <p class="form-group-label">Full Name</p>
                <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" required>
                <button type="submit" name="btnUpdate" class="btn-submit">Update Profile</button>
            </form>
            <a href="../index.php" class="back-link">Cancel</a>
        </div>
    </div>
</body>
</html>