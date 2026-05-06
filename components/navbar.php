
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
        
        <a href="pages/edit_profile.php" style="text-decoration: none; color: #555; font-size: 0.9rem;">Edit Profile</a>
        
        <a href="pages/display_car.php" style="text-decoration: none; color: #555; font-size: 0.9rem;">View Fleet</a>
        
        <a href="pages/logout.php" style="text-decoration: none; color: #c62828; border: 1px solid #c62828; padding: 5px 15px; border-radius: 5px; font-weight: 600;">Logout</a>
    </div>
</nav>