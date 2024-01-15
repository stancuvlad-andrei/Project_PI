<?php
    session_start();
    require 'connection/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id'])) {
        // Retrieve form data
        $jobTitle = $_POST['job_title'];
        $jobDescription = $_POST['description'];
        $company = $_POST['company'];
        $location = $_POST['location'];
        $jobType = $_POST['job_type'];
        $userId = $_SESSION['id']; // Retrieve the user ID from the session

        // Insert new job into the database
        $insertQuery = "INSERT INTO jobs (job_title, job_description, company, location, job_type, user_id) VALUES ('$jobTitle', '$jobDescription', '$company', '$location', '$jobType', '$userId')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            // Redirect back to the admin dashboard after job creation
            header('Location: admin_dashboard.php');
            exit;
        } else {
            echo 'Error creating job: ' . mysqli_error($conn);
        }
    }
?>
