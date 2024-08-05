<?php
// Include database connection file
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user data from database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User found, verify password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session and redirect to profile page
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header("Location: profile.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    // Close connection
    mysqli_close($conn);
}
?>
