<?php
// 1
session_start();
include('./koneksi.php');

$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // 2
    $_SESSION['username'] = $username;
    header("Location: ../view/index.php");
} else {
    echo "<p>Username or password incorrect</p>";
}
$conn->close();
?>
