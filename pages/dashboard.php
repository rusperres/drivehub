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
                        <li><a href="people/add_customer.php">+ New Customer</a> | <a href="people/display_customer.php">View All</a></li>
                        <li><a href="people/add_employee.php">+ New Employee</a> | <a href="people/display_employee.php">View All</a></li>
                        <li><a href="people/add_user.php">+ New User</a> | <a href="people/display_user.php">View All</a></li>
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