<?php
session_start();
require_once 'connect.php'; 

if (!isset($_SESSION['patient_ssn'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

$ssn = $_SESSION['patient_ssn'];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['patient_update_address'])) {
    $newAddress = $_POST['new_address'];
    $sql = "UPDATE patient SET address = ? WHERE ssn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newAddress, $ssn);
    if ($stmt->execute()) {
        
        header("Location: patient_dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Update Address</title>
    
</head>
<body>
    <h2>Update Address</h2>
    <form method="POST" action="patient_update_address.php">
        <label for="new_address">New Address:</label>
        <input type="text" id="new_address" name="new_address" required>
        <button type="submit" name="patient_update_address">Update Address</button>
    </form>
</body>
</html>
