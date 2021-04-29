<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mon panier</title>

        <meta charset="UTF-8">
        <meta name="description" content="SANDBOX">
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
        <meta name="author" content="Maxence Leclerc">

        <link rel="stylesheet" href="Style.css">
    </head>

    <body>
        <header>
            <h1>K-Rouf</h1>
        </header>

        <?php
            include 'navbar.php';
        ?>

<div id="content_area">	
	  
	  <div class="panier_container">
	  
	  
	  <div id="panier" align="right" style="padding:15px">
	  <?php 
	    if(isset($_SESSION['email_client'])){
		
		  echo "<b>Your Email:</b>" . $_SESSION['email_client'];
		
		}else{
		
		  echo "";
		}
	  
	  ?>
	  
	   <b style="color:navy">Votre Panier - </b> Total : <?php total();?> Total prix: <?php total_prix(); ?>
	   
	   </div><!-- /.panier --> 
	   
	   <form action="" method="post" enctype="multipart/form-data">
	   <table align="center" width="100%">
	   
	     <tr align="center">
		   <th>Supprimer</th>
		   <th>Produit</th>
		   <th>Quantité</th>
		   <th>prix</th>
		 </tr>
		 
	<?php 
		 $total = 0;
   
   $ip = get_ip();
   
   $acceder_pannier = mysqli_query($con, "select * from panier where adresse_ip='$ip' ");
   
   while($fetch_panier = mysqli_fetch_array($acceder_panier)){
       
	   $id_produit = $fetch_array['id_produit'];
	   
	   $resultat_produit = mysqli_query($con, "select * from produits where id_produit = '$id_produit'");
	   
       while($fetch_product = mysqli_fetch_array($resultat_produit)){
                
		$prix_produit = array($fetch_product['prix_produit']);

        $titre_produit = $fetch_product['titre_produit'];

        $image_produit = $fetch_product['image_produit'];
        
        $prix_produit = $fetch_product['prix_produit'];
        
		$valeurs = array_sum($prix_produit);
		
		
		$acc_qte = mysqli_query($con, "select * from panier where id_produit = '$id_produit'");
		
		$row_qte = mysqli_fetch_array($acceder_quantité);
		
		$qte = $row_qte['quantité'];
		
		$valures_qte = $valeurs * $qte;
		
		$total += $valeurs_qte;
				
   
   ?>
		 <tr align="center">
		   <td><input type="checkbox" name="supprimer[]" value="<?php echo $id_produit;?>" /></td>
		   <td>
		   <?php echo $titre_produit;?>
		   <br />
		   <img src="              " />
		   </td>
		   <td><input type="text" size="4" name="qte" valeur="<?php echo $qte; ?>" /></td>
		   <td><?php echo "$" . $prix_produit; ?></td>
		 </tr>
	   
	<?php } } // End While  ?> 
         
		<tr>
		   <td colspan="4" align="right"><b>Sub Total:</b></td>
		   <td><?php echo  prix_total(); ?> </td>
		</tr>
	
	    <tr align="center">
		   <td colspan="2"><input type="submit" name="mettreajour_panier" value="MettreAJour Panier" /></td>
		   <td><input type="submit" name="continuer" value="Continure Achats" /></td>
		   <td><button><a href="checkout.php">Checkout</a></td>
		</tr>
	   </table>
	   </form>
	   
	   <?php 
	   if(isset($_POST['supprimer'])){
	     
		 foreach($_POST['supprimer'] as $id_supprimer){
		   
		  $executer_suppression = mysqli_query($con,"delete from panier where id_produit = '$id_supprimer' AND adresse_ip='$ip' ");
		 
		 if($executer_suppression){
		    echo "<script>window.open('panier.php','_self')</script>";
		 }
		 }
		 
	   }
	   
	   if(isset($_POST['continuer'])){
	     echo "<script>window.open('index.php','_self')</script>";
	   }
	   
	   ?>
	   
	   </div><!-- /.pannier_container-->
	  
	  <div id="produits_box">   

        <?php
            include 'footer.php';
        ?>
    </body>
</html>