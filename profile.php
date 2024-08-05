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
    $naam=$row['name'];
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

    echo "<div class='separated'><h2>Welcome, " . $row['name'] . "!</h2><button class='add-button' onclick=\"document.getElementById('id03').style.display='block';reset_form();\">+</button></div>";
    $sql = "SELECT * FROM notes WHERE userid='$user_id'";
    $result2 = mysqli_query($conn, $sql);

    if ($result2) {
        // Existing code here
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }
    echo "<h3 class='centerise'>Your Notes</h3>";
    if (mysqli_num_rows($result2) > 0) {
        echo "<div class='menu'>";
        while ($row = mysqli_fetch_assoc($result2)) {
            echo "<div class='card'>";
            echo "<div class='note-body'>";
            echo "" . $row['body'] . "";
            echo "</div>";
            echo "<div class='container'>";
            echo "<h4><b>" . $row['title'] . "</b></h4>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<h4 style='text-align:center;'>No notes found<h4>";
        echo "<br>";
        echo "<img src='images/nothing.png' alt='empty' style='display:block;margin:auto;width:20%'>";
        echo "<br>";
    }
} else {
    echo "User not found";
}

// Close connection
mysqli_close($conn);

?>
<div id="id03" class="modal">
          <div class="modal-content animate" action="login.php" method="post">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
        
            <div class="container">
            <form method="POST" action="save_note.php" id="note-editor">
        <style>
            body {
                margin: 20px;
            }
            textarea {
                width: 100%;
                height: 200px;
            }
            input[type="text"] {
                width: 100%;
                padding: 5px;
                margin-bottom: 10px;
            }
            #save {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
                margin-left:75%;
            }
        </style>
        <input id="inp-title" type="text" name="title" placeholder="Note Title" required><br><br>
        <textarea id="inp-body" name="note" rows="10" cols="50"></textarea><br><br>
        <input type="text" name="hide" style="display:none;">
        
        <br>
        <input id="deletebutton" class="cancelbtn" type="submit" onclick="document.getElementById('note-editor').action = 'note_delete.php';" value="Delete">
        <input id ="save" type="submit" value="Save Note">
    </form>
            </div>
              
        </div>
        </div>
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


