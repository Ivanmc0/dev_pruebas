<?php session_start();

    $_SESSION["thisProject"] = $_POST['id'];
    echo "<script>setTimeout('location.href = \"".$_SESSION["_DOMINION"]."proyecto/balance/"."\"', 200)</script>";