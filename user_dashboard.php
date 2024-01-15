<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
        <link rel="stylesheet" type="text/css" href="style/userDashboardStyle.css">
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
        <div class="card-container">
    <?php
        // Fetch and display user's applied jobs in cards
        $userId = $_SESSION['id'];
        $query = "SELECT * FROM jobs INNER JOIN job_applications ON jobs.id = job_applications.job_id WHERE job_applications.user_id = '$userId'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">';
                echo '<h3>' . $row['job_title'] . '</h3>';
                echo '<p>Company: ' . $row['company'] . '</p>';
                echo '<p>Location: ' . $row['location'] . '</p>';
                echo '<p>Type: ' . $row['job_type'] . '</p>';
                echo '<p>Status: ' . $row['status'] . '</p>'; // Assuming there's a field 'application_status'
                // Add more job details or application status as needed
                echo '</div>';
            }
        } else {
            echo '<p>No jobs applied yet</p>';
        }
    ?>
</div>

    </body>
</html>
