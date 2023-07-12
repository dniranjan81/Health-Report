<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_reports";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];

// Fetch health report file path from the database
$sql = "SELECT health_report FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $healthReportFilePath = $row['health_report'];

    // Send the health report file as a response
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="health_report.pdf"');
    readfile($healthReportFilePath);
} else {
    echo "No health report found for the given email ID.";
}

$conn->close();
?>
