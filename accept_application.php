<?php
session_start();
require 'connection/config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $applicationId = $_GET['id'];

    // Update status to 'accepted' in job_applications table
    $query = "UPDATE job_applications SET status = 'accepted' WHERE id = '$applicationId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect to admin dashboard or any desired page
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo 'Error accepting application.';
    }
}
?>
