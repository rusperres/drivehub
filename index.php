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
<nav style="background: white; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div class="logo-area">
        <a href="index.php">
            <h1 style="color: #c62828; margin: 0; font-size: 1.5rem;">DriveHub</h1>
        </a>
    </div>
    <div class="user-area" style="display: flex; align-items: center; gap: 20px;">
        <span style="color: #555; font-weight: 600;">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </span>
        <a href="pages/edit_profile.php" style="text-decoration: none; color: #555; font-size: 0.9rem;">Edit Profile</a>
        <a href="pages/fleet/display_car.php" style="text-decoration: none; color: #555; font-size: 0.9rem;">View Fleet</a>
        <a href="pages/logout.php" style="text-decoration: none; color: #c62828; border: 1px solid #c62828; padding: 5px 15px; border-radius: 5px; font-weight: 600;">Logout</a>
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
            <a href="pages/fleet/add_car.php">Add Car</a>
            <a href="pages/fleet/display_carcategory.php">Categories</a>
        </div>
        <div class="access-card">
            <h3>Booking</h3>
            <a href="pages/transactions/add_reservation.php">New Reservation</a>
            <a href="pages/transactions/add_rental.php">Add Rental</a>
            <a href="pages/transactions/display_rental.php">Active Rentals</a>
        </div>
        <div class="access-card">
            <h3>People</h3>
            <a href="pages/people/display_customer.php">Customers</a>
            <a href="pages/people/display_user.php">System Users</a>
        </div>
        <div class="access-card">
            <h3>Support</h3>
            <a href="pages/management/display_maintenancerecord.php">Maintenance</a>
            <a href="pages/management/display_review.php">Reviews</a>
        </div>
    </div>

</body>
</html>