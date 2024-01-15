<?php
    // update_profile.php
    require 'connection/config.php';
    //session_start();

    if (isset($_POST['submit'])) {
        $userID = $_SESSION['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $address = $_POST['address'];

        // Perform update query to update user details in the database
        $sql = "UPDATE user SET user_username='$username', user_email='$email', user_bio='$bio', user_address='$address' WHERE id='$userID'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Redirect to the profile page after successful update
            header('Location: profile.php');
            exit;
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }
?>
