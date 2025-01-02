<?php
include 'includes/database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Adding Page</title>
</head>
<body>
    <form method="POST" action="task_add.php">
        Title: <br>
        <input type="text" name="title" required><br>

        Description: <br>
        <textarea name="description"></textarea><br>

        Due Date: <br>
        <input type="date" name="due_date" required><br>

        <button type="submit">Add Task</button>
    </form>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        #
        $user_id = $_SESSION['user_id'];

        #
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        
        $sql = "INSERT INTO tasks (user_id, title, description, due_date) VALUES ('$user_id', '$title', '$description', '$due_date')";

        # Place any code that might cause exception in the try block and catch that exception error
        try {
            mysqli_query($conn, $sql);
            echo "Task added!";
        }
        catch (mysqli_sql_exception) {
            echo "Task is not added <br>";
        }
    }

    # Closing sql connection
    mysqli_close($conn);
?>