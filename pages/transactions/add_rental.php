<?php
session_start();
include('../../utils/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$resID = isset($_POST['reservationID']) ? (int)$_POST['reservationID'] : 0;
$custID = isset($_POST['customerID']) ? (int)$_POST['customerID'] : '';
$carID = isset($_POST['carID']) ? (int)$_POST['carID'] : '';
$empID = isset($_POST['employeeID']) ? (int)$_POST['employeeID'] : '';
$start = isset($_POST['startDate']) ? $_POST['startDate'] : '';
$end = isset($_POST['endDate']) ? $_POST['endDate'] : '';
$cost = isset($_POST['totalCost']) ? $_POST['totalCost'] : '';

if (isset($_POST['btnLoad'])) {
    if ($resID > 0) {
        $stmt_load = $conn->prepare("SELECT customerID, carID, pickupDate, returnDate FROM reservation WHERE reservationID = ?");
        $stmt_load->bind_param("i", $resID);
        $stmt_load->execute();
        $res_lookup = $stmt_load->get_result();
        
        if ($row = $res_lookup->fetch_assoc()) {
            $custID = $row['customerID'];
            $carID = $row['carID'];
            $start = str_replace(' ', 'T', $row['pickupDate']);
            $end = str_replace(' ', 'T', $row['returnDate']);
            
            $stmt_rate = $conn->prepare("SELECT dailyRate FROM car JOIN carcategory ON car.categoryID = carcategory.categoryID WHERE carID = ?");
            $stmt_rate->bind_param("i", $carID);
            $stmt_rate->execute();
            $rate_res = $stmt_rate->get_result();
            
            if ($row_rate = $rate_res->fetch_assoc()) {
                $rate = $row_rate['dailyRate'];
                $startTime = strtotime($start);
                $endTime = strtotime($end);
                $days = ceil(($endTime - $startTime) / (60 * 60 * 24));
                if ($days <= 0) $days = 1;
                $cost = number_format($days * $rate, 2, '.', '');
            }
            $stmt_rate->close();
        }
        $stmt_load->close();
    }
}

if (isset($_POST['btnCalculate'])) {
    if ($carID > 0 && $start != '' && $end != '') {
        $stmt_rate = $conn->prepare("SELECT dailyRate FROM car JOIN carcategory ON car.categoryID = carcategory.categoryID WHERE carID = ?");
        $stmt_rate->bind_param("i", $carID);
        $stmt_rate->execute();
        $rate_res = $stmt_rate->get_result();
        
        if ($row_rate = $rate_res->fetch_assoc()) {
            $rate = $row_rate['dailyRate'];
            $startTime = strtotime($start);
            $endTime = strtotime($end);
            $days = ceil(($endTime - $startTime) / (60 * 60 * 24));
            if ($days <= 0) $days = 1;
            $cost = number_format($days * $rate, 2, '.', '');
        }
        $stmt_rate->close();
    }
}

if (isset($_POST['btnSave'])) {
    if ($custID != '' && $carID != '' && $empID != '' && $start != '' && $end != '' && $cost != '') {
        $status = 'Active';
        $stmt_save = $conn->prepare("INSERT INTO rental (reservationID, customerID, carID, employeeID, startDate, endDate, totalCost, rentalStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_save->bind_param("iiiissds", $resID, $custID, $carID, $empID, $start, $end, $cost, $status);

        if ($stmt_save->execute()) {
            $stmt_save->close();
            header("Location: display_rental.php");
            exit();
        } else {
            echo "<script>alert('Error: " . $stmt_save->error . "');</script>";
        }
        $stmt_save->close();
    } else {
        echo "<script>alert('Please fill all fields and calculate the cost first.');</script>";
    }
}

$stmt_res = $conn->prepare("SELECT r.reservationID, u.username FROM reservation r JOIN customer c ON r.customerID = c.customerID JOIN users u ON c.userID = u.userID");
$stmt_res->execute();
$reservations = $stmt_res->get_result();

$stmt_cust = $conn->prepare("SELECT c.customerID, u.username FROM customer c JOIN users u ON c.userID = u.userID");
$stmt_cust->execute();
$customers = $stmt_cust->get_result();

$stmt_car = $conn->prepare("SELECT c.carID, c.brand, c.model, cat.dailyRate FROM car c JOIN carcategory cat ON c.categoryID = cat.categoryID");
$stmt_car->execute();
$cars = $stmt_car->get_result();

$stmt_emp = $conn->prepare("SELECT e.employeeID, u.username FROM employee e JOIN users u ON e.userID = u.userID");
$stmt_emp->execute();
$employees = $stmt_emp->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveHub | Add Rental (Secure Mode)</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/forms.css">
</head>
<body>
    <?php include('../../components/navbar.php'); ?>
    <div class="main-content">
        <div class="form-card rental-card">
            <h2>Rental Agreement</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="input-group">
                        <label for="reservationID">Reservation (Optional)</label>
                        <select name="reservationID" id="reservationID">
                            <option value="0">--- No Reservation ---</option>
                            <?php while($row = $reservations->fetch_assoc()): ?>
                                <option value="<?php echo $row['reservationID']; ?>" <?php echo ($resID == $row['reservationID']) ? 'selected' : ''; ?>>
                                    Res #<?php echo $row['reservationID']; ?> - <?php echo $row['username']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="btnLoad" class="btn-action" formnovalidate>Load Details</button>
                </div>

                <div class="form-group">
                    <label for="customerID">Customer</label>
                    <select name="customerID" id="customerID" required>
                        <option value="">Select Customer</option>
                        <?php while($row = $customers->fetch_assoc()): ?>
                            <option value="<?php echo $row['customerID']; ?>" <?php echo ($custID == $row['customerID']) ? 'selected' : ''; ?>>
                                <?php echo $row['username']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="carID">Car</label>
                    <select name="carID" id="carID" required>
                        <option value="">Select Car</option>
                        <?php while($row = $cars->fetch_assoc()): ?>
                            <option value="<?php echo $row['carID']; ?>" <?php echo ($carID == $row['carID']) ? 'selected' : ''; ?>>
                                <?php echo $row['brand'] . " " . $row['model']; ?> ($<?php echo $row['dailyRate']; ?>/day)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="employeeID">Assigned Employee</label>
                    <select name="employeeID" id="employeeID" required>
                        <option value="">Select Employee</option>
                        <?php while($row = $employees->fetch_assoc()): ?>
                            <option value="<?php echo $row['employeeID']; ?>" <?php echo ($empID == $row['employeeID']) ? 'selected' : ''; ?>>
                                <?php echo $row['username']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="startDate">Start Date</label>
                    <input type="datetime-local" name="startDate" id="startDate" required value="<?php echo $start; ?>">
                </div>

                <div class="form-group">
                    <label for="endDate">End Date</label>
                    <input type="datetime-local" name="endDate" id="endDate" required value="<?php echo $end; ?>">
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label for="totalCost">Total Cost ($)</label>
                        <input type="number" step="0.01" name="totalCost" id="totalCost" readonly required value="<?php echo $cost; ?>">
                    </div>
                    <button type="submit" name="btnCalculate" class="btn-action" formnovalidate>Calculate Cost</button>
                </div>

                <div class="form-actions">
                    <button type="submit" name="btnSave" class="btn-submit">Save Rental Agreement</button>
                </div>
            </form>
            <a href="../../index.php" class="back-link">← Cancel and Back</a>
        </div>
    </div>
</body>
</html><?php
$stmt_res->close();
$stmt_cust->close();
$stmt_car->close();
$stmt_emp->close();
?>
