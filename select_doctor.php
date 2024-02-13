<?php
// Include your database connection file
require_once 'connect.php';

// Fetch doctors' data from the database
$sql = "SELECT ssn, name, specialty, years_exp FROM doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Select Your Doctor</h2>";
    echo "<form action='patient_register.php' method='post'>";
    
    // Fetching patient registration details from POST data
    $name = $_POST['name'] ?? '';
    $ssn = $_POST['ssn'] ?? '';
    $age = $_POST['age'] ?? '';
    $address = $_POST['address'] ?? '';

    // Displaying hidden fields to pass patient registration details to patient_register.php
    echo "<input type='hidden' name='name' value='" . $name . "'>";
    echo "<input type='hidden' name='ssn' value='" . $ssn . "'>";
    echo "<input type='hidden' name='age' value='" . $age . "'>";
    echo "<input type='hidden' name='address' value='" . $address . "'>";
    
    while($row = $result->fetch_assoc()) {
        // Display doctor's name, speciality, and experience
        echo "<input type='radio' name='doctor_ssn' value='" . $row['ssn'] . "' required>";
        echo "<label>" . $row['name'] . " - " . $row['specialty'] . " (Experience: " . $row['years_exp'] . " years)</label><br>";
    }
    echo "<button type='submit' name='select_doctor'>Select Doctor</button>";
    echo "</form>";
} else {
    echo "No doctors available.";
}
$conn->close();
?>
