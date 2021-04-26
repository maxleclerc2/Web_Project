<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Produit</title>

        <meta charset="UTF-8">
        <meta name="description" content="SANDBOX">
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
        <meta name="author" content="Maxence Leclerc">

        <link rel="stylesheet" href="Style.css">
    </head>

    <body>
        <header>
            <h1>Maxence Leclerc</h1>
        </header>

        <?php
            $servername = "127.0.0.1";
            $username = "root";
            $password = null;
            $dbname = "db_web_project";
            $con = new mysqli($servername, $username, $password, $dbname);

            $req = "SELECT * from categorie;";
            $res = $con->query($req);

            echo "<nav>
            <div class='Centre'>
            <ul>
            <li class='NavAccueil'>
            <a href='Accueil.php'>Accueil</a>
            </li>
            <li class='NavAccueil'>
            <a href='Boutique.php'>Tous nos</br>produits</a>
            </li>";

            if($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo "<li class='NavParcours'>";
                    echo "<a href='Boutique.php?category=" . $row["Slug_Categorie"] . "'>" . $row["Titre_Categorie"] . "</a>";
                    echo "</li>";
                }
            }

            echo "<li class='NavAccueil'>";
            echo "<a href='Panier.php'>Mon panier</a>";
            echo "</li>";

            if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                echo "<li class='NavParcours'>";
                echo "<a href='Administration.php'>Espace</br>administrateur</a>";
                echo "</li>";
            }

            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                echo "<li class='NavParcours'>";
                echo "<a href='Compte.php'>Mon compte</a>";
                echo "</li>";
                echo "<li class='NavParcours'>";
                echo "<a href='Deconnexion.php'>Déconnexion</a>";
                echo "</li>";
            } else {
                echo "<li class='NavParcours'>";
                echo "<a href='Connexion.php'>Connexion</a>";
                echo "</li>";
            }

            echo "</ul>
            </div>
            </nav>";

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
                    <br><br>
                    <a href='#' class='btn btn-add'>Ajouter au panier</a>";
                }
            } else {
                header("Location: Boutique.php");
            }

            echo "</div>
            <br><br>
            </section>";
        ?>

        <footer>
            <p>
                Site web créé par Maxence Leclerc<br />
                Tous droits réservés
            </p>
        </footer>
    </body>
</html>