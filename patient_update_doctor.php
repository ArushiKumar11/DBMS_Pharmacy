<?php
session_start();
require_once 'connect.php'; // Ensure this points to your actual DB connection script

// Check if the patient is logged in
if (!isset($_SESSION['patient_ssn'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

$patient_ssn = $_SESSION['patient_ssn'];

// Handle doctor selection and update patient's primary physician
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['patient_update_doctor'])) {
    $selected_doctor_ssn = $_POST['doctor_ssn'];
    
    // Update the patient's primary physician in the database using prepared statements
    $sql = "UPDATE patient SET pri_physician = ? WHERE ssn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $selected_doctor_ssn, $patient_ssn);
    if ($stmt->execute()) {
         header("Location: patient_dashboard.php");
        exit();
    } else {
        echo "<p>There was an error updating your primary physician.</p>";
    }
    $stmt->close();
    // Optionally, redirect or display a message
}

// Fetch doctors' data from the database
$sql = "SELECT ssn, name, specialty, years_exp FROM doctor";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Doctor</title>
</head>
<body>
    <h2>Select Your New Primary Doctor</h2>
    <?php if ($result->num_rows > 0): ?>
        <form action="patient_update_doctor.php" method="post">
            <?php while($row = $result->fetch_assoc()): ?>
                <input type="radio" id="doctor_<?php echo $row['ssn']; ?>" name="doctor_ssn" value="<?php echo $row['ssn']; ?>" required>
                <label for="doctor_<?php echo $row['ssn']; ?>"><?php echo htmlspecialchars($row['name']) . " - Specialty: " . htmlspecialchars($row['specialty']) . ", Years of Experience: " . htmlspecialchars($row['years_exp']); ?></label><br>
            <?php endwhile; ?>
            <button type="submit" name="patient_update_doctor">Update Doctor</button>
        </form>
    <?php else: ?>
        <p>No doctors available.</p>
    <?php endif; ?>
   
</body>
</html>
