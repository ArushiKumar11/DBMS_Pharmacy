<?php

require_once 'connect.php';

if(isset($_POST['select_doctor'])) {
    
    $doctor_ssn = $_POST['doctor_ssn'];

    // Extract other registration details
    $name = $_POST['name'];
    $ssn = $_POST['ssn'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    // Insert into database
    $sql = "INSERT INTO patient (ssn, name, age, address, pri_physician) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $ssn, $name, $age, $address, $doctor_ssn);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
