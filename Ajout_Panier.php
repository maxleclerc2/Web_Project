<?php
    	session_start();

        // Source : https://www.sourcecodester.com/php/12137/simple-shopping-cart-using-session-php.html
     
    	//check if product is already in the cart
    	if(!in_array($_GET['id'], $_SESSION['cart'])){
    		array_push($_SESSION['cart'], $_GET['id']);
    		$_SESSION['message'] = "Produit ajouté au panier";
    	}
    	else{
    		$_SESSION['message'] = "Article déjà dans le panier";
    	}
     
    	header('location: Panier.php');
    ?>