<?php
    session_start();

	// Source : https://www.sourcecodester.com/php/12137/simple-shopping-cart-using-session-php.html
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
		
			echo "<section>
				<div class='Global'>
					<h1>Mon panier</h1>";

					if(isset($_SESSION["message"])) {
						echo "<h3>" . $_SESSION["message"] . "</h3>";
						unset($_SESSION["message"]);
					}

					echo "<form method='POST' action='Update_Panier.php'>
						<table class='table-panier'>
							<tr>
								<th>Supprimer</th>
								<th>Nom</th>
								<th>Prix</th>
								<th>Quantité</th>
								<th>Total produit</th>
							</tr>";
						
							$_SESSION["total"] = 0;
							if(!empty($_SESSION['cart'])){
								//create array of initial qty which is 1
								$index = 0;

								if(!isset($_SESSION["qty_array"])){
									$_SESSION["qty_array"] = array_fill(0, count($_SESSION["cart"]), 1);
								}

								$req = "SELECT * FROM Produit WHERE Id_Product IN (" . implode(",",$_SESSION["cart"]) . ")";
								$res = $con->query($req);

								while($row = $res->fetch_assoc()){
									echo "<tr>
										<th>
											<a href='Supprimer_Produit.php?id=" . $row["Id_Product"] . "&index=" . $index ."' class='btn btn-del'><span></span></a>
										</th>
										<th>" . $row["Nom_Produit"] . "</th>
										<th>" . number_format($row["Prix_Produit"], 2) . "</th>
										<input type='hidden' name='indexes[]' value='" . $index . "'>
										<th><input type='text' value='" . $_SESSION["qty_array"][$index] . "' name='qty_" . $index . "'></th>
										<th>" . number_format($_SESSION["qty_array"][$index]*$row["Prix_Produit"], 2) . "</th>
									</tr>";

									$_SESSION["total"] += $_SESSION["qty_array"][$index]*$row["Prix_Produit"];
									$index ++;
								}
							} else{
								echo "<tr>
									<td colspan='4'>Aucun produit dans le panier</td>
								</tr>";
							}
							echo "<tr>
								<td colspan='4' align='right'><b>Total</b></td>
								<td><b>" . number_format($_SESSION["total"], 2) . "</b></td>
							</tr>
						</table>

						<br>

						<div>
							<a href='Vider_Panier.php' class='btn btn-del' style='vertical-align: middle'><span></span>Vider le panier</a>
							<button type='submit' class='btn btn-mod' name='save' style='font-family: Times New Roman, Times, serif; vertical-align: middle'>Mettre à jour<br>les quantités</button>
							<a href='Validation.php' class='btn btn-add' style='vertical-align: middle'><span></span>Passer commande</a>
						</div>

					</form>
				
				</div>
			</section>";

            include 'footer.php';
        ?>
    </body>
</html>