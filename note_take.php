<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pofile | SoulScript</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h1>SoulScript</h1>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Login</a></li>
        </ul>
        

   

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

// Retrieve user data from database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<div id="profile">
            <P>'. $row['name'][0] .'</P>
        </div>
    </nav>';//close nav

    echo ' <div id="dropdown">
    <div id="profilelarge">
        <P>'. $row['name'][0] .'</P>
    </div>
    <div id="borderforname">
        <h2> ' . $row['name'] . '</h2>
    </div>
    <p>'. $row['email'] .'</p>
    <button id="logoutbutton">Logout</button>
    </div>';

} else {
    echo "User not found";
}

// Close connection
mysqli_close($conn);

?>
     <footer>
        <div id="info">
            <h1>SoulScript</h1>
            <div>
                <p>gurnish@soulscript.com</p>
                <p>IIIT Kota</p>
                <p>123-456-7890</p>
            </div>
            <p>&copy; 2024 SoulScript. All rights reserved.</p>
        </div>
    </footer>
    <script src="dropdown.js"></script>
</body>
</html>