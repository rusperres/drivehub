<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>DriveHub | Dashboard</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<nav class="navbar">
    <div class="logo-area">
        <a href="../index.php">
            <h1 class="navbar-logo">DriveHub</h1>
        </a>
    </div>
    <div class="user-area">
        <span class="user-welcome">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </span>
        <a href="edit_profile.php" class="nav-link">Edit Profile</a>
        <a href="fleet/display_car.php" class="nav-link">View Fleet</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</nav>
    <div class="container">
        <div class="dashboard-card">
            <h2>Dashboard Overview</h2>
            <p>You are now logged into the Premium Car Rental System.</p>
            <hr class="dashboard-hr">
            
            <div class="dashboard-grid">
                <div class="dashboard-section">
                    <h3>Fleet & Categories</h3>
                    <ul>
                        <li><a href="fleet/add_car.php">+ New Car</a> | <a href="fleet/display_car.php">View All</a></li>
                        <li><a href="fleet/add_carcategory.php">+ New Category</a> | <a href="fleet/display_carcategory.php">View All</a></li>
                    </ul>
                </div>
                <div class="dashboard-section">
                    <h3>Personnel & Customers</h3>
                    <ul>
                        <li><a href="people/display_customer.php">View Customers</a></li>
                        <li><a href="people/display_employee.php">View Employees</a></li>
                        <li><a href="people/add_user.php">+ Create Account</a> | <a href="people/display_user.php">View All Users</a></li>
                    </ul>
                </div>
                <div class="dashboard-section">
                    <h3>Operations</h3>
                    <ul>
                        <li><a href="transactions/add_reservation.php">+ New Reservation</a> | <a href="transactions/display_reservation.php">View All</a></li>
                        <li><a href="transactions/add_rental.php">+ New Rental</a> | <a href="transactions/display_rental.php">View All</a></li>
                        <li><a href="transactions/add_payment.php">+ New Payment</a> | <a href="transactions/display_payment.php">View All</a></li>
                    </ul>
                </div>
                <div class="dashboard-section">
                    <h3>Maintenance & Quality</h3>
                    <ul>
                        <li><a href="management/add_maintenancerecord.php">+ New Maintenance</a> | <a href="management/display_maintenancerecord.php">View All</a></li>
                        <li><a href="management/add_insurance.php">+ New Insurance</a> | <a href="management/display_insurance.php">View All</a></li>
                        <li><a href="management/add_review.php">+ New Review</a> | <a href="management/display_review.php">View All</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>
</html>