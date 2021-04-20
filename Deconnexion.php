<?php
    session_start();
    unset($_SESSION["loggedin"]);
    unset($_SESSION["admin"]);
    header("Location: Accueil.php");
?>