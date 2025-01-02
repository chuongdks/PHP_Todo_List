<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout page</title>
</head>
<body>
    This is the Logout page<br>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>

<?php
    echo $_SESSION["user_id"] . "<br>";
    echo $_SESSION["username"] . "<br>";
    echo $_SESSION["email"] . "<br>";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        session_destroy();
        header("Location: login.php");
    }
?>