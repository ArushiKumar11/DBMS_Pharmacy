<?php
session_start();
require_once 'connect.php'; 
if (!isset($_SESSION['patient_ssn'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

$patient_ssn = $_SESSION['patient_ssn'];

// Fetch the patient's prescription history from the patient medical history
$sql = "SELECT 
    d.name AS DoctorName,
    dr.tradename AS DrugName, 
    dr.pharmCoName AS PharmaCoName,
    pr.dateprescribed AS PrescriptionDate, 
    pr.qty AS Quantity
FROM 
    Prescribes pr
JOIN 
    Doctor d ON pr.doctor_ssn = d.ssn
JOIN 
    Drugs dr ON pr.drugtrade_name = dr.tradename AND pr.pharmCoName = dr.pharmCoName
WHERE 
    pr.patient_ssn = ?  
ORDER BY 
    pr.dateprescribed DESC"; 


$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patient_ssn);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Medical History</title>
    <style>
        /* Add CSS styles for table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Patient Medical History</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Doctor Name</th>
                <th>Drug Name</th>
                <th>Pharma Co Name</th>
                <th>Date</th>
                <th>Quantity</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['DoctorName']); ?></td>
                <td><?php echo htmlspecialchars($row['DrugName']); ?></td>
                <td><?php echo htmlspecialchars($row['PharmaCoName']); ?></td>
                <td><?php echo htmlspecialchars($row['PrescriptionDate']); ?></td>
                <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No medical history found.</p>
    <?php endif; ?>
    <a href="patient_dashboard.php">Back to Dashboard</a>
</body>
</html>
