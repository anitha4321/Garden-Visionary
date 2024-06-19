<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        body
        {
            background:url("loginImg.webp") no-repeat fixed;
            background-size: 100% 100%;
        }
        form{
            width:400px;
            height:300px;
            background: transparent;
            backdrop-filter:blur(50px);
            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            padding-left:20px;
            box-shadow:2px 2px 5px grey;
            padding-top:40px;
            color:#033;
        }
        input[type="email"],input[type="password"]
        {
            width:90%;
            background:transparent;
            border:1px solid #033;
        }
        
    </style>
</head>
<body>
    
    <h1 style="text-align:center;color:#033;">Login</h1>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <button style="background:transparent;border:1px solid #033;color:#033;">Log in</button>
        
    </form>
    <p style="text-align:center;"><a href="forgot-password.php">Forgot password?</a></p>
</body>
</html>
