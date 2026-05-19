<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if (isset($_POST['btnSave'])) {
    $plate = $_POST['plate'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $categoryID = $_POST['categoryID'];

    $sql = "INSERT INTO car (plateNumber, brand, model, status, categoryID) 
            VALUES (?, ?, ?, 'Available', ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $plate, $brand, $model, $categoryID);

    if ($stmt->execute()) {
        header("Location: display_car.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}

$stmt_cats = $conn->prepare("SELECT categoryID, categoryName, dailyRate FROM carcategory");
$stmt_cats->execute();
$categories_list = $stmt_cats->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveHub | Add New Vehicle</title>
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
            <h2>Vehicle Registration</h2>
            <form method="POST">
                <input type="text" name="plate" placeholder="Plate Number (e.g. ABC-1234)" required>
                <input type="text" name="brand" placeholder="Vehicle Brand (e.g. Toyota)" required>
                <input type="text" name="model" placeholder="Vehicle Model (e.g. Vios)" required>
                <div class="form-group">
                    <label for="categoryID">Vehicle Category</label>
                    <select name="categoryID" id="categoryID" required >
                        <option value="">-- Select Category --</option>
                        <?php while($cat = $categories_list->fetch_assoc()): ?>
                            <option value="<?php echo $cat['categoryID']; ?>">
                                <?php echo htmlspecialchars($cat['categoryName']); ?> ($<?php echo $cat['dailyRate']; ?>/day)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" name="btnSave" class="btn-submit">Save Vehicle Record</button>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back to Dashboard</a>
        </div>
    </div>

</body>
</html>
<?php
$stmt_cats->close();
?>
