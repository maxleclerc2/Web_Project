<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>SANDBOX</title>

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
            <a href='Boutique.php'>Tous nos produits</a>
            </li>";

            if($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo "<li class='NavParcours'>";
                    echo "<a href='Boutique.php?category=" . $row["Slug"] . "'>" . $row["Titre"] . "</a>";
                    echo "</li>";
                }
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

            if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                echo "<li class='NavParcours'>";
                echo "<a href='Administration.php'>Espace administrateur</a>";
                echo "</li>";
            }

            echo "</ul>
            </div>
            </nav>";

            echo "<div class='Globale'>";

            if(isset($_GET["category"])) {
                $slug = $_GET["category"];
            
                $req = "SELECT * from produit p, categorie c
                WHERE c.Slug = '" . $slug . "' AND p.Id_Category = c.Id_Category
                ;";
                $res = $con->query($req);

                if($res->num_rows > 0) {
                    while($row = $res->fetch_assoc()) {
                        //echo "<p>" . $row["Nom"] . "</p>";
                        echo "<a href='Produit.php?product=" . $row["Slug"] . "'>" . $row["Nom"] . "</a>";
                        echo "</br>";
                    }
                }
            } else {
                $req = "SELECT * from produit p;";
                $res = $con->query($req);

                if($res->num_rows > 0) {
                    while($row = $res->fetch_assoc()) {
                        //echo "<p>" . $row["Nom"] . "</p>";
                        echo "<a href='Produit.php?product=" . $row["Slug"] . "'>" . $row["Nom"] . "</a>";
                        echo "</br>";
                    }
                }
            }

            echo "</div>";
        ?>

        <footer>
            <p>
                Site web créé par Maxence Leclerc<br />
                Tous droits réservés
            </p>
        </footer>
    </body>
</html>