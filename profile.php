<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
        <link rel="stylesheet" type="text/css" href="style/profileStyle.css">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="jobs.php">Jobs</a></li>
            <?php
                //session_start();
                require 'connection/config.php';

                if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
                    header('Location: login.php');
                    exit;
                }

                if ($_SESSION['admin'] == 1) {
                    echo '<li><a href="admin_dashboard.php">Dashboard (Admin)</a></li>';
                } else {
                    echo '<li><a href="user_dashboard.php">Dashboard (User)</a></li>';
                }

                echo '<li><a href="logout.php">Logout</a></li>';
                echo '<li><a href="profile.php">Profile</a></li>';

                $userID = $_SESSION['id'];
                $sql = "SELECT * FROM user WHERE id = '$userID'";
                $result = mysqli_query($conn, $sql);
            ?>
        </ul>
        <img class="cover-image" src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
        <?php
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                echo '<div class="profile-information">';
                echo '<h2>Profile Information</h2>';
                echo '<p>Username: <b>' . $user['user_username'] . '</b></p>';
                echo '<p>Email: <b>' . $user['user_email'] . '</b></p>';
                echo '<p>About: <b>' . $user['user_bio'] . '</b></p>';
                echo '<p>Address: <b>' . $user['user_address'] . '</b></p>';
                if ($user['admin'] == 1) {
                    echo '<p>Role: <b>Admin</b></p>';
                } else {
                    echo '<p>Role: <b>User</b></p>';
                }
                echo '</div>';
            } else {
                echo '<div class="profile-information">';
                echo '<h2>Error</h2>';
                echo '<p>Unable to fetch user data.</p>';
                echo '</div>';
            }
        ?>
        <div class="edit-profile">
            <a href="edit_profile.php">Edit Profile</a>
        </div>
        <footer class="footer">
        <div class="footer-content">
            <p>Stancu Vlad-Andrei</p>
            <p>Proiect PI</p>
            <p><a href="linkul_tau_catre_github" target="_blank">GitHub</a></p>
        </div>
    </footer>
    </body>
</html>
