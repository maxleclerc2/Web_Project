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
        <title>Boutique</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page de la boutique">
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

            echo "<section>";
            echo "<div class='Globale'>";

            if(isset($_GET["category"])) {
                $slug = $_GET["category"];
            
                $req = "SELECT * from produit p, categorie c
                WHERE c.Slug_Categorie = '" . $slug . "' AND p.Id_Category = c.Id_Category
                ORDER BY Nom_Produit;";
                $res = $con->query($req);

                if($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    echo "<h2>" . $row["Description_Categorie"] . "</h2>
                    <table class='table-boutique'>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Ajouter au panier</th>
                        </tr>";

                    echo "<tr>
                        <th><a href='Produit.php?product=" . $row["Slug_Produit"] . "'>" . $row["Nom_Produit"] . "</a></th>
                        <th>" .$row["Prix_Produit"] . " €</th>";

                        if($row["Quantite_Produit"] <= 0) {
                            echo "<th><a href='#' class='btn btn-del'>Produit indisponible</a></th>";
                        } else {
                            echo "<th><a href='Ajout_Panier.php?id=" . $row["Id_Product"] . "' class='btn btn-add'>Ajouter</a></th>";
                        }

                    echo "</tr> ";

                    while($row = $res->fetch_assoc()) {
                        echo "<tr>
                            <th><a href='Produit.php?product=" . $row["Slug_Produit"] . "'>" . $row["Nom_Produit"] . "</a></th>
                            <th>" .$row["Prix_Produit"] . " €</th>";

                            if($row["Quantite_Produit"] <= 0) {
                                echo "<th><a href='#' class='btn btn-del'>Produit indisponible</a></th>";
                            } else {
                                echo "<th><a href='Ajout_Panier.php?id=" . $row["Id_Product"] . "' class='btn btn-add'>Ajouter</a></th>";
                            }

                        echo "</tr> ";
                    }
                } else {
                    echo "<h2>Aucun produit ne correspond à cette catégorie.</h2>";
                }
            } else {
                $req = "SELECT * from produit p ORDER BY Nom_Produit;";
                $res = $con->query($req);

                echo "<h2>Retrouvez tous nos produits au même endroit !</h2>";
                
                if($res->num_rows > 0) {
                    echo "<table class='table-boutique'>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Ajouter au panier</th>
                        </tr>";
                    while($row = $res->fetch_assoc()) {
                        echo "<tr>
                            <th><a href='Produit.php?product=" . $row["Slug_Produit"] . "'>" . $row["Nom_Produit"] . "</a></th>
                            <th>" .$row["Prix_Produit"] . " €</th>";

                            if($row["Quantite_Produit"] <= 0) {
                                echo "<th><a href='#' class='btn btn-del'>Produit indisponible</a></th>";
                            } else {
                                echo "<th><a href='Ajout_Panier.php?id=" . $row["Id_Product"] . "' class='btn btn-add'>Ajouter</a></th>";
                            }

                        echo "</tr> ";
                    }
                } else {
                    echo "<h3>Cependant il n'y a aucun produit... !</h3>";
                }
            }

            echo "</table>
                </div>
            </section>";
            
            include 'footer.php';
        ?>
    </body>
</html>