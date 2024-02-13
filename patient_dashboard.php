<?php
session_start();
require_once 'connect.php'; // Ensure this points to your actual DB connection script

if (!isset($_SESSION['patient_ssn'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

$ssn = $_SESSION['patient_ssn'];

// Fetch patient information
$sql = "SELECT p.name, p.age, p.address, p.ssn, d.name as doctor_name FROM patient p LEFT JOIN doctor d ON p.pri_physician = d.ssn WHERE p.ssn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ssn);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    $patient = $result->fetch_assoc();
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .navbar { background-color: #008cba; overflow: hidden; }
        .navbar a { float: left; display: block; color: black; text-align: center; padding: 14px 20px; text-decoration: none; }
        .navbar a:hover { background-color:#005f73 ; color: white; }
        .container { padding: 20px; }
        form { margin-top: 20px; }
        label, p { display: block; margin: 10px 0; }
        input[type="text"], button { padding: 10px; margin: 5px 0; }
        button { background-color: #008cba; color: white; cursor: pointer; border: none; border-radius: 5px; }
        button:hover { background-color: #005f73; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="patient_dashboard.php">My Profile</a>
        <a href="patient_medical_history.php">My Medical History</a>
        <a href="explore_doctor.php">Explore Doctors</a>
        <a href="drug_details.php">Search for Medicines</a>
    </div>

    <div class="container">
        <h2>My Profile</h2>
        <p>Name: <?php echo htmlspecialchars($patient['name']); ?></p>
        <p>Age: <?php echo htmlspecialchars($patient['age']); ?></p>
        <p>Address: <?php echo htmlspecialchars($patient['address']); ?> <button onclick="window.location.href='patient_update_address.php';">Update Address</button></p>
        <p>Primary Physician: <?php echo htmlspecialchars($patient['doctor_name']); ?> <button onclick="window.location.href='patient_update_doctor.php';">Update Doctor</button></p>
        <p>SSN: <?php echo htmlspecialchars($patient['ssn']); ?></p>
    </div>
</body>
</html>
