<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "trip_planner_db";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$city = $_POST['city'] ?? '';
$region = $_POST['region2'] ?? '';

// Fix: activities and info are arrays from multiple checkboxes, so implode to save as comma-separated strings
$activities = isset($_POST['activities']) ? implode(", ", $_POST['activities']) : '';
$info = isset($_POST['info']) ? implode(", ", $_POST['info']) : '';

$stmt = $conn->prepare("INSERT INTO trips (city, region, activities, info) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $city, $region, $activities, $info);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Trip Submission Result</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f9f9f9;
      color: #333;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .result-container {
      background-color: #ffd700;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 400px;
      text-align: center;
    }
    .result-container h2 {
      color: #1a237e;
      margin-bottom: 20px;
      font-weight: 700;
    }
    .result-message {
      font-size: 18px;
      margin-bottom: 25px;
    }
    a {
      color: #23247e;
      font-weight: bold;
      text-decoration: none;
      background-color: white;
      padding: 10px 20px;
      border-radius: 8px;
      display: inline-block;
      transition: background-color 0.3s ease;
    }
    a:hover {
      background-color: #23247e;
      color: #ffd700;
    }
  </style>
</head>
<body>
  <div class="result-container">
    <h2>Trip Planner</h2>
    <div class="result-message">
    <?php
      if ($stmt->execute()) {
          echo "Trip plan saved successfully!";
      } else {
          echo "Error: " . htmlspecialchars($stmt->error);
      }
      $stmt->close();
      $conn->close();
    ?>
    </div>
    <a href="view_trips.php">View all trips</a>
  </div>
</body>
</html>
