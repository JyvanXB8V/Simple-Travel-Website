<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_otp = $_POST['otp'];
    if ($user_otp == $_SESSION['otp']) {
        header("Location: reset_password.php");
        die;
    } else {
        $error = "Incorrect OTP!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP - Compass</title>
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
        input[type="text"] {
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
    <h3>Verify OTP</h3>
    <form method="post">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <input type="submit" value="Verify OTP">
    </form>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
</div>

</body>
</html>
