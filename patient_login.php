<?php
require_once 'connect.php'; // DB connection

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $ssn = $_POST['ssn'];
    $name = $_POST['name'];


    $sql = "SELECT * FROM patient WHERE ssn = ? AND name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ssn, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1) {
       
        session_start();
        $_SESSION['patient_ssn'] = $ssn;
        header("Location: patient_dashboard.php"); // Adjust the target page as needed
    } else {
        // Invalid credentials
        echo "Invalid login credentials.";
    }

    $stmt->close();
    $conn->close();
}
?>
