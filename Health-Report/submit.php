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


$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];
$healthReport = $_FILES['health_report'];


// Move uploaded file to a directory
$targetDir = "/upload";
$targetFile = $targetDir . basename($healthReport['name']);
move_uploaded_file($healthReport['tmp_name'], $targetFile);

// Insert data into database
$sql = "INSERT INTO users (name, age, weight, email, health_report) VALUES ('$name', '$age', '$weight', '$email', '$targetFile')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
