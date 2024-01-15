<?php
// apply_job.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'connection/config.php';
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['admin'] != 1) {
        $userId = $_SESSION['id'];
        
        // Retrieve job ID from the form
        if (isset($_POST['job_id'])) {
            $jobId = $_POST['job_id'];

            // Insert the job application into the database
            $query = "INSERT INTO job_applications (job_id, user_id, application_message, application_date, status) VALUES ('$jobId', '$userId', 'Your application message goes here', current_timestamp(), 'pending')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Job application successfully added
                header("Location: user_dashboard.php");
                // Redirect to a page or display a message as needed
            } else {
                // Error inserting the job application
                echo 'Error submitting job application.';
            }
        } else {
            echo 'Job ID not specified.';
        }
    } else {
        // User not logged in or is an admin
        echo 'You do not have permission to apply.';
    }
} else {
    // If the form is not submitted via POST method
    echo 'Invalid request.';
}
?>
