<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
} else {
    // Redirect users who are not logged in to the login page or display a message
    header("Location: login.php");
    exit(); // Ensure script stops execution after redirection
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="style3.css">   
</head>
<body>
    
</body><?php if (isset($user)): ?>
        
        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
        <p><a href="file:///C:/xampp/htdocs/dynamicfullcalender/hamsini/MSTLAB/Mhome.html">Click Here to go to Home</a></p>
        <p><a href="logout.php">Log out</a></p>
        
    <?php else: ?>
        
        <p><a href="login.php">Log in</a> or <a href="Signup.html">sign up</a></p>
        
    <?php endif; ?>
</html>
