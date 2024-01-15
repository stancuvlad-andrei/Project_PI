<!DOCTYPE html>
<html>
<head>
    <title>Jobs</title>
    <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
    <link rel="stylesheet" type="text/css" href="style/jobsStyle.css">
</head>
<body>
    <ul>
        <!-- Navigation Links -->
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
    <div class="cover-container">
    <img class="cover-image" src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fVufDB8fHx8fA%3D%3D" alt="">
    <div class="cover-text">
        <h2 class="heading">All Jobs</h2>
    </div>
</div>
    <!-- Filter Options -->
    <div class="filters">
        <form method="GET" action="jobs.php">
            <label for="jobType">Job Type:</label>
            <select name="jobType" id="jobType">
                <option value="all">All</option>
                <option value="full time">Full Time</option>
                <option value="part time">Part Time</option>
            </select>

            <label for="location">Location:</label>
            <select name="location" id="location">
                <option value="all">All</option>
                <option value="Timisoara">Timisoara</option>
                <option value="Cluj">Cluj</option>
                <!-- Add other locations -->
            </select>

            <input type="submit" value="Apply Filters">
        </form>
    </div>

    <div class="job-listing">
        <div class="job-cards-container">
            <div class="job-cards">
                <?php
                //require 'connection/config.php';

                // Initialize the base query
                $query = "SELECT * FROM jobs WHERE 1";

                // Check if filters are applied
                if (isset($_GET['jobType']) && $_GET['jobType'] !== 'all') {
                    $jobTypeFilter = $_GET['jobType'];
                    $query .= " AND job_type = '$jobTypeFilter'";
                }

                if (isset($_GET['location']) && $_GET['location'] !== 'all') {
                    $locationFilter = $_GET['location'];
                    $query .= " AND location = '$locationFilter'";
                }

                // Execute the query
                $result = mysqli_query($conn, $query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a href="job_details.php?id=' . $row['id'] . '" class="job-link">';
                            echo '<div class="job-card">';
                            echo '<h3>' . $row['job_title'] . '</h3>';
                            echo '<p>Company: ' . $row['company'] . '</p>';
                            echo '<p>Type: ' . $row['job_type'] . '</p>';
                            echo '<p>Location: ' . $row['location'] . '</p>';
                            echo '</div>';
                            echo '</a>';
                        }
                    } else {
                        echo '<p>No jobs available.</p>';
                    }
                } else {
                    echo '<p>Error fetching jobs.</p>';
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>

    <!-- Arrows for cycling through rows -->
    <div class="arrows">
        <button onclick="scrollCards(-1)">Previous</button>
        <button onclick="scrollCards(1)">Next</button>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            <p>Stancu Vlad-Andrei</p>
            <p>Proiect PI</p>
            <p><a href="linkul_tau_catre_github" target="_blank">GitHub</a></p>
        </div>
    </footer>

    <script>
        // Script for card scrolling
        const jobCards = document.querySelector('.job-cards');
        const cardWidth = document.querySelector('.job-card').offsetWidth + 20; // Width + margin
        const cardsPerRow = 3;
        let currentIndex = 0;

        function scrollCards(direction) {
            const totalCards = document.querySelectorAll('.job-card').length;
            const maxIndex = Math.ceil(totalCards / cardsPerRow) - 1;

            if (direction === -1 && currentIndex > 0) {
                currentIndex--;
            } else if (direction === 1 && currentIndex < maxIndex) {
                currentIndex++;
            }

            jobCards.style.transform = `translateX(${-currentIndex * (cardWidth * cardsPerRow)}px)`;
        }
    </script>
</body>
</html>
