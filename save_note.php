<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
// Include database connection file
include_once "db_connection.php";

$userid = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $body = $_POST['note'];
    $title = $_POST['title'];

    // Insert user data into database
    $sql = "INSERT INTO notes (userid, title, body) VALUES ('$userid', '$title', '$body')";
    if (mysqli_query($conn, $sql)) {
        header("Location: profile.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
