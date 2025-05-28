<?php 
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $email = $_POST['Email'];
    $password = $_POST['password'];

    if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email already exists
        $check_query = "SELECT * FROM users WHERE user_name = '$email' LIMIT 1";
        $result = mysqli_query($con, $check_query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<p style='color:red; text-align:center;'>Email already exists!</p>";
        } else {
            $user_id = random_num(20);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (user_id, FirstName, LastName, user_name, password) 
                     VALUES ('$user_id', '$firstname', '$lastname', '$email', '$hashed_password')";

            if (mysqli_query($con, $query)) {
                header("Location: login.php");
                die;
            } else {
                echo "<p style='color:red; text-align:center;'>Error saving to database: " . mysqli_error($con) . "</p>";
            }
        }
    } else {
        echo "<p style='color:red; text-align:center;'>Please fill in all fields correctly!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup - Compass</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            background-image: url('Compass_Site/Assets/images/compassbg.jpg');
            background-size: cover;
        }
        .container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 10px #999;
        }
        h2 {
            text-align: center;
            color: #333333;
            font-size: 24px;
            border-bottom: 2px solid orange;
            padding-bottom: 10px;
        }
        input[type="email"], input[type="password"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            margin-bottom: 20px;
            border: 1px solid #aaa;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #e69500;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a {
            color: #333366;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .compass-header {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color:rgb(255, 255, 255);
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="compass-header">C O M P A S S</div>

<div class="container">
    <h2>Signup</h2>
    <form method="post">
        <input type="text" name="FirstName" placeholder="First Name" required>
        <input type="text" name="LastName" placeholder="Last Name" required>
        <input type="email" name="Email" placeholder="Email" required>
        <div style="display: flex; gap: 10px; align-items: center;">
            <input type="password" name="password" id="password" placeholder="Password" required style="flex: 1;">
            <button type="button" onclick="togglePassword()" style="padding: 12px; background: #eee; border: 1px solid #aaa; border-radius: 4px; cursor: pointer;">Show</button>
        </div>
        <script>
            function togglePassword() {
                var x = document.getElementById("password");
                var button = event.target;
                if (x.type === "password") {
                    x.type = "text";
                    button.textContent = "Hide";
                } else {
                    x.type = "password";
                    button.textContent = "Show";
                }
            }
        </script>
        <input type="submit" value="Signup">
    </form>
    <div class="links">
        <a href="login.php">Click to Login</a>
    </div>
</div>
</body>
</html>
