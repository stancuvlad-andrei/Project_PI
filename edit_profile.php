<!-- edit_profile.php -->
<html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
        <link rel="stylesheet" type="text/css" href="style/editProfileStyle.css">
    </head>
    <body>
        <ul>
            <!-- Navigation links, if needed -->
        </ul>
        <div class="edit-form">
            <h2>Edit Profile</h2>
            <form action="update_profile.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $user['user_username']; ?>" required><br>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $user['user_email']; ?>" required><br>

                <label for="bio">Bio</label>
                <textarea id="bio" name="bio"><?php echo $user['user_bio']; ?></textarea><br>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $user['user_address']; ?>"><br>

                <input type="submit" name="submit" value="Update">
            </form>
        </div>
    </body>
</html>
