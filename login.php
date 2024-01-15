<?php
    require 'connection/config.php';
    //session_start();

    if(isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE user_email='$email'");
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if($password === $row["user_pass"]) { // Direct comparison for simplicity (NOT secure)
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
                $_SESSION["admin"] = $row["admin"]; // Set admin status in session
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Wrong password')</script>";
            }
        } else {
            echo "<script>alert('User not found')</script>";
        }
    }
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style/loginStyle.css">
    </head>
    <body>
        <form action="" method="post" autocomplete="off">

            <label for="email">Email</label>
            <input type="text" name="email" id="email" required value=""> <br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required value=""> <br>

            <button type="submit" name="submit">Login</button>
            <a href="registration.php">Register</a>
        </form>
        <br>
    </body>
</html>
