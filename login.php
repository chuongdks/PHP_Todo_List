<?php
include 'includes/database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Page</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        Email:
        <input type="email" name="email" required><br>

        Password:
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result)  > 0) // mysqli_num_rows($result) or $result->num_rows 
        { 
            $row = $result->fetch_assoc(); // $row = mysqli_fetch_assoc($result)
            if (password_verify($password, $row['password'])) 
            {
                $_SESSION['user_id'] = $row['id']; // Change the session id to the user id
                $_SESSION['username'] = $row['user']; // Change the session id to the user id
                $_SESSION['email'] = $row['email']; // Change the session id to the user id

                echo "Login successful!";
                header("Location: logout.php");
            } 
            else 
            {
                echo "Invalid password.";
            }
        } 
        else
        {
            echo "No user found.";
        }
    }

    # Closing sql connection
    mysqli_close($conn);
?>