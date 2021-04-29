<?php
    session_start();

    // Source : https://www.sourcecodester.com/php/12137/simple-shopping-cart-using-session-php.html
    
    if(isset($_POST['save'])){
        foreach($_POST['indexes'] as $key){
            $_SESSION['qty_array'][$key] = $_POST['qty_'.$key];
        }
    
        $_SESSION['message'] = "Quantités mises à jour avec succès";
        header('location: Panier.php');
    }
?>