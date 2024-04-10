<?php
$servername = "localhost:3310";
$username = "root";
$password = "";
$dbname = "bistro";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE cake (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
addr VARCHAR(50) NOT NULL,
city VARCHAR(15) NOT NULL,
zip INT NOT NULL,
serve_now VARCHAR(5) NOT NULL,
table_num INT NOT NULL,
cake_opt ENUM('Wild Berry Cake', 'Chocolate, Vanilla, and Caramel Cake', 'Tiramisu', 'Carrot and Pumpkin Cake', 'Cheesecake with Raspberry', 'Amandina Cake') NOT NULL,
phone_num VARCHAR(12) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();