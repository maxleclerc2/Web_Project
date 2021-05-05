<?php
    session_start();

	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
 
	unset($_SESSION['qty_array']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Produit</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page d'affichage du produit sélectionné">
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
            <div class='Globale'>";

            if(isset($_GET["product"])) {
                $slug = $_GET["product"];
            
                $req = "SELECT * from produit p
                WHERE p.Slug_Produit = '" . $slug . "';";
                $res = $con->query($req);

                if($res->num_rows > 0) {
                    $row = $res->fetch_assoc();

                    echo "
                    <div class='ProduitGauche'>
                        <h3>" . $row["Nom_Produit"] . "</h3>
                        <br>
                        <p>" . $row["Description_Produit"] . "</p>
                        <br>
                        <p>Prix unitaire : " . $row["Prix_Produit"] . " €</p>
                        <br>
                        <p>Référence " . $row["Reference_Produit"] . "</p>
                        <br>
                    </div>
                    <div class='ProduitDroit'>";
                        if($row["Image_Produit"] != "") {
                            echo "<img src='/Ressources/" . $row["Image_Produit"] . "' alt='" . $row["Reference_Produit"] . "' style='width:300px;height:300px;'>";
                        } else {
                            echo "<img src='/Ressources/default-product.png' alt='placeholder' style='width:300px;height:300px;'>";
                        }
                    echo "</div>
                    <br><br>";
                    
                    if($row["Quantite_Produit"] <= 0) {
                        echo "<a href='#' class='btn btn-del'>Produit indisponible</a>";
                    } else {
                        echo "<a href='Ajout_Panier.php?id=" . $row["Id_Product"] . "' class='btn btn-add'>Ajouter au panier</a>";
                    }
                }
            } else {
                header("Location: Boutique.php");
            }

            echo "</div>
            <br><br>
            </section>";
            
            include 'footer.php';
        ?>
    </body>
</html>