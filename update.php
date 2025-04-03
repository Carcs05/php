<!DOCTYPE html>
<html>
<head>
    <title>Update Profile | CMC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="update-container">
        <h2>Update Profile</h2>
        
        <?php
        include 'SQLConnect.php';
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        // Get current user data
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM tbl_users WHERE id=$user_id";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];

            $sql = "UPDATE tbl_users SET username='$username', email='$email' WHERE id=$user_id";
            
            if (mysqli_query($conn, $sql)) {
                $_SESSION['username'] = $username; // Update session
                echo "<p class='success'>Profile updated successfully!</p>";
            } else {
                echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
            }
        }
        ?>

        <form action="" method="post" class="update-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            
            <div class="button-group">
                <button type="submit" class="update-btn">Update Profile</button>
                <a href="home.php" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
