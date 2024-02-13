<?php

require_once 'connect.php';

   
    $name = $_POST['name'];
    $ssn = $_POST['ssn'];
    $years_exp = $_POST['years_exp'];
    $specialty = $_POST['specialty'];

    // Insert into database
    $sql = "INSERT INTO doctor (ssn, name, years_exp, specialty) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $ssn, $name, $years_exp, $specialty);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        echo "Registration successful! \n";
	echo "Go back and login to open profile";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();

?>
