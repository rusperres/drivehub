<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: pages/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/hero.css">
</head>
<body>
<nav class="navbar">
    <div class="logo-area">
        <a href="index.php">
            <h1 class="navbar-logo">DriveHub</h1>
        </a>
    </div>
    <div class="user-area">
        <span class="user-welcome">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </span>
        <a href="pages/edit_profile.php" class="nav-link">Edit Profile</a>
        <a href="pages/fleet/display_car.php" class="nav-link">View Fleet</a>
        <a href="pages/logout.php" class="btn-logout">Logout</a>
    </div>
</nav>
    
    

    <div class="hero">
        <h2>Premium Car Rentals</h2>
        <p>Your complete fleet management dashboard.</p>
        <div class="hero-actions">
            <a href="pages/fleet/display_car.php" class="btn-add">View Fleet</a>
            <a href="pages/dashboard.php" class="btn-add btn-view">Admin Dashboard</a>
        </div>
    </div>

    <div class="quick-access">
        <div class="access-card">
            <h3>Fleet</h3>
            <a href="pages/fleet/display_car.php">View Fleet</a>
            <a href="pages/fleet/add_car.php">Add New Car</a>
            <a href="pages/fleet/display_carcategory.php">View Categories</a>
            <a href="pages/fleet/add_carcategory.php">Add New Category</a>
        </div>
        <div class="access-card">
            <h3>Booking & Payments</h3>
            <a href="pages/transactions/display_reservation.php">View Reservations</a>
            <a href="pages/transactions/add_reservation.php">New Reservation</a>
            <a href="pages/transactions/display_rental.php">View Rentals</a>
            <a href="pages/transactions/add_rental.php">New Rental Agreement</a>
            <a href="pages/transactions/display_payment.php">View Payments</a>
            <a href="pages/transactions/add_payment.php">Record New Payment</a>
        </div>
        <div class="access-card">
            <h3>People</h3>
            <a href="pages/people/display_customer.php">View Customers</a>
            <a href="pages/people/display_employee.php">View Employees</a>
            <a href="pages/people/display_user.php">View System Users</a>
            <a href="pages/people/add_user.php">Create New Account</a>
        </div>
        <div class="access-card">
            <h3>Maintenance & Feedback</h3>
            <a href="pages/management/display_maintenancerecord.php">View Maintenance</a>
            <a href="pages/management/add_maintenancerecord.php">New Maintenance Entry</a>
            <a href="pages/management/display_insurance.php">View Insurances</a>
            <a href="pages/management/add_insurance.php">New Insurance Policy</a>
            <a href="pages/management/display_review.php">View Reviews</a>
            <a href="pages/management/add_review.php">Post New Review</a>
        </div>
    </div>

</body>
</html>