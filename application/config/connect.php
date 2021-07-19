<?php
$servername = "182.50.133.79";
$username = "test_followzer";
$password = "0f46hN~c";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>