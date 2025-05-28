<?php
$conn = new mysqli("localhost", "root", "", "trip_planner_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM trips ORDER BY submitted_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Submitted Trip Plans</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f9f9f9;
      color: #333;
      margin: 0;
      padding: 40px 20px;
      display: flex;
      justify-content: center;
      min-height: 100vh;
    }
    .container {
      max-width: 1200px;
      width: 100%;
      background: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
      color: #1a237e;
      font-weight: 700;
      margin-bottom: 30px;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 16px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px 15px;
      text-align: left;
      vertical-align: middle;
    }
    th {
      background: #ffd700;
      color: #23247e;
      font-weight: 700;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
    tr:hover {
      background: #fff3b0;
    }
    a.back-link {
      display: inline-block;
      margin-top: 25px;
      text-decoration: none;
      background-color: #23247e;
      color: #ffd700;
      padding: 12px 25px;
      border-radius: 8px;
      font-weight: 700;
      transition: background-color 0.3s ease;
    }
    a.back-link:hover {
      background-color: #1a1f6e;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Submitted Trip Plans</h2>
    <table>
      <thead>
        <tr>
          <th>City</th>
          <th>Region</th>
          <th>Activities</th>
          <th>Info Wanted</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
      <?php
      while ($row = $result->fetch_assoc()) {
          $city = ucwords(strtolower($row['city']));
          $region = ucwords(strtolower($row['region']));
          $activities = ucwords(strtolower($row['activities']));
          $info = ucwords(strtolower($row['info']));
          $date = $row['submitted_at'];

          echo "<tr>
              <td>{$city}</td>
              <td>{$region}</td>
              <td>{$activities}</td>
              <td>{$info}</td>
              <td>{$date}</td>
          </tr>";
      }
      ?>
      </tbody>
    </table>
    <a class="back-link" href="TripPlanner.html">Back to Trip Planner</a>
  </div>
</body>
</html>
<?php
$conn->close();
?>
