<?php session_start();

    $_SESSION["thisWeek"] = $_POST['id'];
    echo "<script>setTimeout('location.reload()', 200)</script>";