<?php
session_start();
include("connection.php");

$otp_display = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM users WHERE user_name = ? LIMIT 1";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $otp = rand(100000, 999999);
            $_SESSION['reset_email'] = $email;
            $_SESSION['otp'] = $otp;
            $otp_display = "Your OTP is: <strong>" . $otp . "</strong>. Use this OTP on the next page to reset your password.";
        } else {
            $otp_display = "Email not found!";
        }
    } else {
        $otp_display = "Please enter a valid email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Compass</title>
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
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
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
        .message {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff3cd;
            color: #856404;
            border-radius: 5px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #003366;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Forgot Your Password?</h3>
    <form method="post">
        <input type="email" name="email" placeholder="Your registered email" required>
        <input type="submit" value="Generate OTP">
    </form>
    <?php if ($otp_display): ?>
        <div class="message"><?php echo $otp_display; ?></div>
        <?php if (strpos($otp_display, 'Your OTP is:') === 0): ?>
            <a href="verify_otp.php">Go to OTP Verification</a>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
