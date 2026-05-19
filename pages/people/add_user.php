<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$uname = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$role = $_POST['role'] ?? '';

if (isset($_POST['btnSave'])) {
    $pass = $_POST['password'];

    $sql = "INSERT INTO users (username, email, password, role) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $uname, $email, $pass, $role);

    if ($stmt->execute()) {
        $userID = $conn->insert_id;

        if ($role === 'customer') {
            $phone = trim($_POST['phonePrimary']);
            $dob = $_POST['dateOfBirth'];
            $regDate = date('Y-m-d');
            $sqlCust = "INSERT INTO customer (userID, phonePrimary, dateOfBirth, registrationDate) VALUES (?, ?, ?, ?)";
            $stmtCust = $conn->prepare($sqlCust);
            $stmtCust->bind_param("isss", $userID, $phone, $dob, $regDate);
            $stmtCust->execute();
        } else if ($role === 'employee') {
            $pos = trim($_POST['position']);
            $phone = trim($_POST['phoneNumber']);
            $sqlEmp = "INSERT INTO employee (userID, position, phoneNumber) VALUES (?, ?, ?)";
            $stmtEmp = $conn->prepare($sqlEmp);
            $stmtEmp->bind_param("iss", $userID, $pos, $phone);
            $stmtEmp->execute();
        }

        header("Location: display_user.php");
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
    <title>DriveHub | Add User</title>
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
            <h2>User Registration</h2>
            <form method="POST">
                <input type="text" name="username" value="<?php echo htmlspecialchars($uname); ?>" placeholder="Username" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" <?php echo ($role === '' ? 'disabled' : 'required'); ?>>
                
                <div class="form-row">
                    <div class="input-group">
                        <select name="role" required>
                            <option value="">Select Role</option>
                            <option value="customer" <?php echo ($role === 'customer' ? 'selected' : ''); ?>>Customer</option>
                            <option value="employee" <?php echo ($role === 'employee' ? 'selected' : ''); ?>>Employee</option>
                        </select>
                    </div>
                    <?php if ($role === ''): ?>
                        <button type="submit" name="btnLoadRole" class="btn-action">Next</button>
                    <?php endif; ?>
                </div>

                <?php if ($role === 'customer'): ?>
                    <div class="role-fields">
                        <input type="text" name="phonePrimary" placeholder="Phone Number (e.g. 09123456789)" required>
                        <label>Date of Birth</label>
                        <input type="date" name="dateOfBirth" required>
                    </div>
                    <button type="submit" name="btnSave" class="btn-submit">Register User</button>
                <?php endif; ?>
                
                <?php if ($role === 'employee'): ?>
                    <div class="role-fields">
                        <input type="text" name="position" placeholder="Position (e.g. Sales Agent)" required>
                        <input type="text" name="phoneNumber" placeholder="Phone Number (e.g. 09123456789)" required>
                    </div>
                    <button type="submit" name="btnSave" class="btn-submit">Register User</button>
                <?php endif; ?>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
