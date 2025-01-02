<?php
include 'includes/database.php';
session_start();

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);

echo "<h1>Your Tasks</h1>";
while ($row = mysqli_fetch_assoc($result)) {
    echo $_SESSION["user_id"] . "<br>";
    echo $_SESSION["username"] . "<br>";
    echo "<h1>{$row['title']}</h1>";
    echo "<p>{$row['description']} - {$row['status']} - Due: {$row['due_date']}</p>";
}
?>
