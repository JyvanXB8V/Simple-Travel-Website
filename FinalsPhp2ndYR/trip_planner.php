<?php
session_start();
include("connection.php");

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get data from form
$user_id = $_SESSION['user_id'];
$destination = $_POST['city'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';
$number_of_people = $_POST['number_of_people'] ?? 1;
$total_cost = $_POST['total_cost'] ?? 0;
$activities = isset($_POST['activities']) ? implode(',', $_POST['activities']) : '';

// Insert data into trips table
$sql = "INSERT INTO trips (user_id, destination, start_date, end_date, number_of_people, total_cost, activities, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssiss", $user_id, $destination, $start_date, $end_date, $number_of_people, $total_cost, $activities);

if ($stmt->execute()) {
    header("Location: profile.php?success=1");
    exit();
} else {
    header("Location: TripPlanner.html?error=1");
    exit();
}

$stmt->close();
?>
