<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
    <link rel="stylesheet" type="text/css" href="style/viewProfileStyle.css">
    <!-- Add other CSS stylesheets if needed -->
</head>
<body>
    <ul>
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        <!-- Add other navigation links if needed -->
    </ul>

    <div>
        <h2>User Profile</h2>
        <?php
            //session_start();
            require 'connection/config.php';

            if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
                header('Location: login.php');
                exit;
            }

            // Check if user_id is provided in URL
            if (isset($_GET['user_id'])) {
                $userId = $_GET['user_id'];
                
                // Fetch user details based on user_id from job_applications table
                $query = "SELECT u.* FROM user u INNER JOIN job_applications ja ON u.id = ja.user_id WHERE ja.user_id = '$userId'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $userDetails = mysqli_fetch_assoc($result);
                    // Display user details
                    echo '<p>Username: ' . $userDetails['user_username'] . '</p>';
                    echo '<p>Email: ' . $userDetails['user_email'] . '</p>';
                    echo '<p>Bio: ' . $userDetails['user_bio'] . '</p>';
                    echo '<p>Address: ' . $userDetails['user_address'] . '</p>';
                    // Add more user details as needed
                } else {
                    echo '<p>No user details available.</p>';
                }
            } else {
                echo '<p>User ID not specified.</p>';
            }

            // Close the database connection
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
