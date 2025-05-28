<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_password = $_POST['new_password'];
    $email = $_SESSION['reset_email'];

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? WHERE user_name = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute();

        echo "<p style='text-align:center;'>Password reset successfully. <a href='login.php'>Login</a></p>";
        session_unset();
        session_destroy();
    } else {
        $error = "Please enter a new password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - Compass</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }
        .container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 10px #999;
        }
        h3 {
            text-align: center;
            color: #333;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
            border: 1px solid #aaa;
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
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Reset Your Password</h3>
    <form method="post">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="submit" value="Reset Password">
    </form>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
</div>

</body>
</html>
