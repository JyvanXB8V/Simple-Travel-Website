<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM users WHERE user_name = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['FirstName'] = $user_data['FirstName'];
                $_SESSION['LastName'] = $user_data['LastName'];
                $_SESSION['email'] = $user_data['user_name'];
                
                header("Location: CompassHome.htm");
                die;
            }
        }
        echo "<p style='color:red; text-align:center;'>Wrong email or password!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Please enter valid login details!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Compass</title>
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
            border: 1px solid #ccc;
            background-color: #f4f4f4;
            box-shadow: 2px 2px 10px #999;
        }

        h2 {
            text-align: center;
            color: #333333;
            font-size: 24px;
            border-bottom: 2px solid orange;
            padding-bottom: 10px;
        }

        input[type="email"], input[type="password"] {
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
        <h2>Login</h2>
        <form method="post">
            <input type="email" name="user_name" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>

        <div class="links">
            <a href="signup.php">Click to Signup</a><br>
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </div>

</body>
</html>
