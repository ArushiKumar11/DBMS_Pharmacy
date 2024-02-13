<?php

require_once 'connect.php';

   
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    

    // Insert into database
    $sql = "INSERT INTO pharmacy (name,phone_number,address) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $phone_number, $address);
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
