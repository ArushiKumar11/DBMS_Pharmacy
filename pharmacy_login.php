<?php
require_once 'connect.php'; // DB connection

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];


    $sql = "SELECT * FROM pharmacy WHERE name = ? AND phone_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $phone_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1) {
       
        session_start();
        $_SESSION['pharmacy'] = $ssn;
        header("Location: pharmacy_dashboard.php"); // Adjust the target page as needed
    } else {
        // Invalid credentials
        echo "Invalid login credentials.";
    }

    $stmt->close();
    $conn->close();
}
?>
