<html>
    <head>
        <title>Index</title>
        <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
        <link rel="stylesheet" type="text/css" href="style/jobDetailsStyle.css">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="jobs.php">Jobs</a></li>
            <li>
                <?php
                    require 'connection/config.php';
                    //session_start();
                    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                        if ($_SESSION['admin'] == 1) {
                            echo '<a href="admin_dashboard.php">Dashboard (Admin)</a>';
                        } else {
                            echo '<a href="user_dashboard.php">Dashboard (User)</a>';
                        }
                        echo '</li>';
                        echo '<li><a href="logout.php">Logout</a></li>';
                        echo '<li><a href="profile.php">Profile</a></li>';
                    } else {
                        echo '<a href="login.php">Login</a></li>';
                        echo '<li><a href="registration.php">Register</a></li>';
                    }
                ?>
        </ul>
        <div class="job-details-container">
        <?php
        //require 'connection/config.php';

        // Check if job ID is provided in the URL
        if (isset($_GET['id'])) {
            $jobId = $_GET['id'];

            // Retrieve job details based on ID
            $query = "SELECT * FROM jobs WHERE id = '$jobId'";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $jobDetails = mysqli_fetch_assoc($result);
                // Display job details
                echo '<h2>' . $jobDetails['job_title'] . '</h2>';
                echo '<p>Company: ' . $jobDetails['company'] . '</p>';
                echo '<p>Details: ' . $jobDetails['job_description'] . '</p>';
                echo '<p>Type: ' . $jobDetails['job_type'] . '</p>';
                echo '<p>Date: ' . $jobDetails['post_date'] . '</p>';
                echo '<p>Location: ' . $jobDetails['location'] . '</p>';
                // Add more job details as needed

                //session_start();
                if (isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['admin'] != 1) {
                    // Display the apply button for regular users
                    echo '<form method="POST" action="apply_job.php">';
                    echo '<input type="hidden" name="job_id" value="' . $jobId . '">';
                    echo '<input type="submit" value="Apply">';
                    echo '</form>';
                }
            } else {
                echo '<p>No job details available.</p>';
            }
        } else {
            echo '<p>No job ID specified.</p>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
    </body>
</html>
