<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_sample_db";

// First check if database exists, if not create it
$temp_con = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$temp_con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
if (!mysqli_query($temp_con, "CREATE DATABASE IF NOT EXISTS $dbname")) {
    die("Error creating database: " . mysqli_error($temp_con));
}
mysqli_close($temp_con);

// Now connect to the database
if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("Failed to connect: " . mysqli_connect_error());
}

// Create users table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    user_id VARCHAR(20) PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    user_name VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!mysqli_query($con, $sql)) {
    die("Error creating table: " . mysqli_error($con));
}

// Create trips table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS trips (
    trip_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(20),
    destination VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    number_of_people INT NOT NULL,
    total_cost DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)";

if (!mysqli_query($con, $sql)) {
    die("Error creating trips table: " . mysqli_error($con));
}
