<?php
session_start();
include('../utils/db.php');

if (isset($_POST['btnLogin'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    
    $query = "SELECT * FROM users WHERE email=? AND password=?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveHub | Premium Login</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body class="login-layout">

    <div class="login-card">
        <h1>DriveHub</h1>
        <p>Sign in to manage your premium fleet.</p>
        
        <form method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="btnLogin" class="btn-submit">Sign In</button>
        </form>
        <?php
        
    if ($row == 1) {
        $val = mysqli_fetch_array($result);

	    $_SESSION['username'] = $val['username'];
        header("Location: ../index.php");
        exit();
    }
    else {
        $str = "<script>alert('Invalid credentials');";
    }
        ?>
        <div class="footer-text">
            &copy; 2026 DriveHub | CIT-U Lab Submission
        </div>
    </div>

</body>
</html>