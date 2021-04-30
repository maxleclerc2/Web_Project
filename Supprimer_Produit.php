<?php
	session_start();

	// Source : https://www.sourcecodester.com/php/12137/simple-shopping-cart-using-session-php.html
	
	//remove the id from our cart array
	$key = array_search($_GET['id'], $_SESSION['cart']);	
	unset($_SESSION['cart'][$key]);
	
	unset($_SESSION['qty_array'][$_GET['index']]);
	//rearrange array after unset
	$_SESSION['qty_array'] = array_values($_SESSION['qty_array']);
	
	$_SESSION['message'] = "Produit supprimé du panier";
	header('location: Panier.php');
?>