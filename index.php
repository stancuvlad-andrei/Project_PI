<html>
    <head>
        <title>Index</title>
        <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
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
        <div class="cover-container">
        <img class="cover-image" src="https://images.unsplash.com/photo-1455849318743-b2233052fcff?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
        <div class="cover-text">
            <h1>Path Finder</h1>
        </div>
    </div>
        <!-- "Let's Begin" Button -->
    <div class="button-container">
        <a href="jobs.php" class="big-button">Let's Begin</a>
    </div>

    <!-- About Us Section -->
    <section class="about-us">
        <div class="about-text">
            <h2>About Us</h2>
            <p>[Company Name]

                We are dedicated to [briefly state your mission or purpose], providing [describe your product/service] that [highlight what sets your offering apart]. Our team is committed to [mention core values or customer focus].
                Our Mission

                At [Company Name], we aim to [briefly describe your overarching mission].
                What We Offer

                    Quality Service/Product: [Explain what makes your offering stand out]
                    Customer Satisfaction: [Emphasize your commitment to customer needs]
                    Innovation: [Highlight any unique or innovative aspects]

                Get In Touch

                To learn more about us or explore our offerings, reach out to us at [contact information].</p>
        </div>
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="About Us Image">
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <p>Stancu Vlad-Andrei</p>
            <p>Proiect PI</p>
            <p><a href="linkul_tau_catre_github" target="_blank">GitHub</a></p>
        </div>
    </footer>
    </body>
</html>
