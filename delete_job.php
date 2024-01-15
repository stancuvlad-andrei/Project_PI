<?php
    require 'connection/config.php';

    if (isset($_GET['id'])) {
        $jobID = $_GET['id'];

        // Delete the job based on the provided job ID
        $deleteQuery = "DELETE FROM jobs WHERE id = '$jobID'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            // Redirect back to the admin dashboard after deletion
            header('Location: admin_dashboard.php');
            exit;
        } else {
            echo 'Error deleting job: ' . mysqli_error($conn);
        }
    } else {
        echo 'No job ID specified for deletion';
    }
?>
