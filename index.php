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
<?php include('components/navbar.php'); ?>
    
    

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