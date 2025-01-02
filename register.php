<?php
    include 'includes/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h1>To-Do List</h1>
        <h2>Sign up</h2>

        Username: <br>
        <input type="text" name="username" required> <br>

        E-mail: <br>
        <input type="email" name="email" required> <br>

        Password: <br>
        <input type="password" name="password" required> <br>

        <input type="submit" name="submit" value="Register"> <br>
    </form>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        # Filter user name and password
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        # Check for empty fields
        if (empty($username)) {
            echo "Please enter username";
        }
        elseif (empty($email)) {
            echo "Please enter email";
        }
        elseif (empty($password)) {
            echo "Please enter Password";
        }
        # SQL for username, password register
        else 
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user, email, password) VALUES ('$username', '$email', '$hash')";
            
            # Place any code that might cause exception in the try block and catch that exception error
            try {
                mysqli_query($conn, $sql);
                echo "You are registered";
            }
            catch (mysqli_sql_exception) {
                echo "User name or Email is taken already <br>";
            }
        }
    }

    # Closing sql connection
    mysqli_close($conn);
?>