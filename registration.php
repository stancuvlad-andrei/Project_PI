<?php
require 'connection/config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exeption;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $admin = isset($_POST["admin"]) ? 1 : 0; // Check if admin checkbox is checked

    $duplicate = mysqli_query($conn, "SELECT * FROM user where user_username = '$username' OR user_email = '$email'");

    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Username or email already taken')</script>";
    } else {
        if ($password == $confirmpassword) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $query = "INSERT INTO user (user_username, user_email, user_pass, admin) VALUES ('$username', '$email', '$password', '$admin')";
                mysqli_query($conn, $query);
                echo "<script>alert('Registration complete, please verify your email')</script>";

                // Send email confirmation
                $mail = new PHPMailer(true);

                $mail->isSMTP();

                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'pathfinderofficial02@gmail.com';
                $mail->Password = 'anzh qxsk sxow dqhj ';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('pathfinderofficial02@gmail.com');
                $mail->addAddress($_POST["email"]);
                $mail->isHTML(true);

                $mail->Subject = "Email comfirmation";
                $mail->Body = "
                                <!DOCTYPE html>
                                <head>
                                <title>Verify Email</title>
                                <style>
                                    body {
                                    font-family: sans-serif;
                                    text-align: center;
                                    }

                                    .verify-email {
                                    padding: 20px;
                                    border: 1px solid #ccc;
                                    border-radius: 5px;
                                    margin: 0 auto;
                                    width: 300px;
                                    }

                                    .verify-email h1 {
                                    font-size: 24px;
                                    margin: 0 0 10px 0;
                                    }

                                    .verify-email a {
                                    text-decoration: none;
                                    color: #333;
                                    }
                                </style>
                                </head>
                                <body>
                                <div class='verify-email'>
                                    <h1>Please verify your email</h1>
                                    <a href='http://localhost/pathfinder/login.php'>Click here to verify your email</a>
                                </div>
                                </body>
                                </html>
                             ";

                $mail->send();
            } else {
                echo "<script>alert('Invalid email format')</script>";
            }
        } else {
            echo "<script>alert('Password does not match')</script>";
        }
    }
}
?>



<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="style/registerStyle.css">
    </head>
    <body>
        <form action="" method="post" autocomplete="off">

            <label for="username">Username</label>
            <input type="text" name="username" id="username" required value=""> <br>

            <label for="email">Email</label>
            <input type="text" name="email" id="email" required value=""> <br>

            <label for="password">Password</label>
            <input type="text" name="password" id="password" required value=""> <br>

            <label for="confirmpassword">Confirm Password</label>
            <input type="text" name="confirmpassword" id="confirmpassword" required value=""> <br>

            <!-- Checkbox to register as admin -->
            <input type="checkbox" id="admin" name="admin">
            

            <button type="submit" name="submit">Register</button>
            <a href="login.php">Login</a>
        </form>
        <br>
    </body>
</html>
