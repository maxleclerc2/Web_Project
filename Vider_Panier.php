<?php
    session_start();

    // Source : https://www.sourcecodester.com/php/12137/simple-shopping-cart-using-session-php.html

    unset($_SESSION['cart']);
    $_SESSION['message'] = 'Panier vidé avec succès';
    header('location: Panier.php');
?>