<?php
session_start();
include("connection.php");

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user information
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
$user_data = mysqli_fetch_assoc($result);

// Get user's trips
$trips_query = "SELECT * FROM trips WHERE user_id = '$user_id' ORDER BY created_at DESC";
$trips_result = mysqli_query($con, $trips_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile - Compass</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        .trips-section {
            margin-top: 30px;
        }
        h1, h2 {
            color: #333;
            border-bottom: 2px solid orange;
            padding-bottom: 10px;
        }
        .user-info {
            margin: 20px 0;
        }
        .user-info p {
            margin: 10px 0;
            font-size: 16px;
        }
        .user-info strong {
            color: #666;
            width: 150px;
            display: inline-block;
        }
        .trip-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .trip-card h3 {
            color: #333;
            margin-top: 0;
        }
        .trip-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .trip-details p {
            margin: 5px 0;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: bold;
        }
        .status.pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status.confirmed {
            background-color: #d4edda;
            color: #155724;
        }
        .status.cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
        .nav-links {
            margin-top: 20px;
        }
        .nav-links a {
            color: #333366;
            text-decoration: none;
            margin-right: 20px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Profile</h1>
        
        <div class="profile-section">
            <h2>Personal Information</h2>
            <div class="user-info">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user_data['FirstName'] . ' ' . $user_data['LastName']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['user_name']); ?></p>
                <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user_data['created_at'])); ?></p>
            </div>
        </div>

        <div class="trips-section">
            <h2>My Trips</h2>
            <a href="view_trips.php">View Trip Plans</a>
        </div>

        <div class="nav-links">
            <a href="CompassHome.htm">Back to Home</a>
            <a href="TripPlanner.html">Book a New Trip</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>