<?php
session_start();
if(isset($_SESSION["username"])) {
    // 3
    session_destroy();
    header("Location: ../view/login.html");
}
?>
