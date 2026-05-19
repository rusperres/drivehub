<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSave'])) {
    $rentID = $_POST['rentalID'];
    $custID = $_POST['customerID'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO review (rentalID, customerID, rating, comment, reviewDate) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiss", $rentID, $custID, $rating, $comment, $date);

    if ($stmt->execute()) {
        header("Location: display_review.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
    $stmt_rentals = $conn->prepare("SELECT r.rentalID, c.brand, c.model, u.username FROM rental r JOIN car c ON r.carID = c.carID JOIN customer cust ON r.customerID = cust.customerID JOIN users u ON cust.userID = u.userID");
    $stmt_rentals->execute();
    $rentals_list = $stmt_rentals->get_result();

    $stmt_customers = $conn->prepare("SELECT c.customerID, u.username FROM customer c JOIN users u ON c.userID = u.userID");
    $stmt_customers->execute();
    $customers_list = $stmt_customers->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveHub | Add Review</title>
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
            <h2>Customer Review</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="rentalID">Rental Agreement</label>
                    <select name="rentalID" id="rentalID" required >
                        <option value="">-- Select Rental --</option>
                        <?php while($rent = $rentals_list->fetch_assoc()): ?>
                            <option value="<?php echo $rent['rentalID']; ?>">
                                Rental #<?php echo $rent['rentalID']; ?> - <?php echo htmlspecialchars($rent['brand'] . " " . $rent['model'] . " (by " . $rent['username'] . ")"); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customerID">Reviewing Customer</label>
                    <select name="customerID" id="customerID" required >
                        <option value="">-- Select Customer --</option>
                        <?php while($cust = $customers_list->fetch_assoc()): ?>
                            <option value="<?php echo $cust['customerID']; ?>">
                                <?php echo htmlspecialchars($cust['username']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <select name="rating" required >
                    <option value="">Select Rating</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
                <textarea name="comment" placeholder="Comment" required ></textarea>
                <button type="submit" name="btnSave" class="btn-submit">Save Review</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html>
<?php
$stmt_rentals->close();
$stmt_customers->close();
?>
