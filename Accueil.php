<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page d'accueil du site perso">
        <meta name="keywords" content="HTML, CSS">
        <meta name="author" content="Maxence Leclerc">

        <link rel="stylesheet" href="Style.css">
    </head>

    <body>
        <header>
            <h1>K-Rouf</h1>
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
            <li class='NavBoutique'>
            <a href='Boutique.php'>Tous nos</br>produits</a>
            </li>";

            if($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo "<li class='NavBoutique'>";
                    echo "<a href='Boutique.php?category=" . $row["Slug_Categorie"] . "'>" . $row["Titre_Categorie"] . "</a>";
                    echo "</li>";
                }
            }

            echo "<li class='NavPanier'>";
            echo "<a href='Panier.php'>Mon panier</a>";
            echo "</li>";

            if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                echo "<li class='NavAdmin'>";
                echo "<a href='Administration.php'>Espace</br>administrateur</a>";
                echo "</li>";
            }

            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                echo "<li class='NavUtilisateur'>";
                echo "<a href='Compte.php'>Mon compte</a>";
                echo "</li>";
                echo "<li class='NavUtilisateur'>";
                echo "<a href='Deconnexion.php'>Déconnexion</a>";
                echo "</li>";
            } else {
                echo "<li class='NavUtilisateur'>";
                echo "<a href='Connexion.php'>Connexion</a>";
                echo "</li>";
            }

            echo "</ul>
            </div>
            </nav>";
        ?>

        <section>
            <h2>Bienvenue sur K-Rouf, supermarché et commerce en ligne</h2>

            <div class="Globale">
                <br>

                <div>
                    <div class="AccueilGauche">
                        <p>Vous souhaitez découvrir notre catalogue ? Alors c'est juste ici !<p>
                    </div>
                    <div class='BoutonDroit'>
                        <a href='Boutique.php' class='btn btn-add'>Tout nos produits</a>
                    </div>
                </div>

                <br>

                <div>
                    <?php
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                            echo "<div class='BoutonGauche'>
                                <a href='Compte.php' class='btn btn-add'>Mon compte</a>
                            </div>
                            <div class='AccueilDroit'>
                                <p>Heureux de vous revoir ! Vous pouvez modifier vos informations sur votre profil.</p>
                            </div>";
                        } else {
                            echo "<div class='BoutonGauche'>
                                <a href='Connexion.php' class='btn btn-add'>Se connecter</a>
                            </div>
                            <div class='AccueilDroit'>
                                <p>Vous avez déjà un compte ? Bon retour parmis nous !</p>
                            </div>";
                        }
                    ?>
                </div>

                <br>
            </div>
        </section>

        <footer>
            <p>
                Site web créé par Maxence Leclerc<br />
                Tous droits réservés
            </p>
        </footer>
    </body>
</html>