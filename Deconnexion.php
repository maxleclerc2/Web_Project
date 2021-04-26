<?php
    session_start();
    unset($_SESSION["loggedin"]);
    unset($_SESSION["admin"]);
    unset($_SESSION["id"]);
    header("Location: Accueil.php");
?>