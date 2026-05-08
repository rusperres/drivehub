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
    <nav style="background: white; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div class="logo-area">
            <a href="../index.php">
                <h1 style="color: #c62828; margin: 0; font-size: 1.5rem;">DriveHub</h1>
            </a>
        </div>
        <div class="user-area" style="display: flex; align-items: center; gap: 20px;">
            <span style="color: #555; font-weight: 600;">
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            </span>
            <a href="edit_profile.php" style="text-decoration: none; color: #555; font-size: 0.9rem;">Edit Profile</a>
            <a href="fleet/display_car.php" style="text-decoration: none; color: #555; font-size: 0.9rem;">View Fleet</a>
            <a href="logout.php" style="text-decoration: none; color: #c62828; border: 1px solid #c62828; padding: 5px 15px; border-radius: 5px; font-weight: 600;">Logout</a>
        </div>
    </nav>
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
