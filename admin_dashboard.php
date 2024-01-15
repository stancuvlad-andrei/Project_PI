<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
    <link rel="stylesheet" type="text/css" href="style/adminDashboardStyle.css">
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="jobs.php">Jobs</a></li>
        <?php
            //session_start();
            require 'connection/config.php';

            if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['admin'] != 1) {
                header('Location: login.php');
                exit;
            }

            echo '<li><a href="admin_dashboard.php">Dashboard (Admin)</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>';
            echo '<li><a href="profile.php">Profile</a></li>';
        ?>
    </ul>

    <div>
        <h2>Jobs List</h2>
        <table>
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Job Type</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
    // Fetch jobs data
    $adminId = $_SESSION['id'];
    $query = "SELECT j.*, ja.id as application_id, ja.user_id as applicant_id FROM jobs j LEFT JOIN job_applications ja ON j.id = ja.job_id WHERE j.user_id = '$adminId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['job_title'] . '</td>';
            echo '<td>' . $row['company'] . '</td>';
            echo '<td>' . $row['location'] . '</td>';
            echo '<td>' . $row['job_type'] . '</td>';
            echo '<td>';
            if ($row['application_id']) {
                echo '<a href="view_profile.php?user_id=' . $row['applicant_id'] . '">View Profile</a>';
                echo '<a href="accept_application.php?id=' . $row['application_id'] . '">Accept Application</a>';
                echo '<a href="refuse_application.php?id=' . $row['application_id'] . '">Refuse Application</a>';

            }
            echo '</td>';
            echo '<td><a href="delete_job.php?id=' . $row['id'] . '">Delete</a></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">No jobs available</td></tr>';
    }
?>

            </tbody>
        </table>
        <div>
            <h2>Create Job</h2>
            <form action="create_job.php" method="POST">
                <label for="job_title">Job Title:</label>
                <input type="text" id="job_title" name="job_title"><br><br>
                <label for="job_title">Description:</label>
                <input type="text" id="description" name="description"><br><br>
                <label for="company">Company:</label>
                <input type="text" id="company" name="company"><br><br>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location"><br><br>
                <label for="job_type">Job Type:</label>
                <select id="job_type" name="job_type">
                    <option value="full time">Full Time</option>
                    <option value="part time">Part Time</option>
                </select><br><br>
                <input type="submit" value="Create Job">
            </form>
        </div>
    </div>
</body>
</html>
