<?php
    session_start();

    if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
        header("Location: Connexion.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Espace administrateur</title>

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
        ?>

        <section>
            <div class="Global">
                <div class="SousGlobale">
                    <h2>Gestion des utilisateurs</h2>

                    </br>

                    <div class="BoutonGauche">
                        <a href="Utilisateurs.php?query=add" class="btn btn-add">Ajouter un utilisateur</a>
                    </div>

                    <div class="BoutonMilieu">
                        <a href="Utilisateurs.php?query=mod" class="btn btn-mod">Modifier un utilisateur</a>
                    </div>
                    
                    <div class="BoutonDroit">
                        <a href="Utilisateurs.php?query=del" class="btn btn-del">Supprimer un utilisateur</a>
                    </div>
                </div>

                <div class="SousGlobale">
                    </br>

                    <h2>Gestion des catégories</h2>

                    </br>

                    <div class="BoutonGauche">
                        <a href="Categories.php?query=add" class="btn btn-add">Ajouter une catégorie</a>
                    </div>

                    <div class="BoutonMilieu">
                        <a href="Categories.php?query=mod" class="btn btn-mod">Modifier une catégorie</a>
                    </div>
                    
                    <div class="BoutonDroit">
                        <a href="Categories.php?query=del" class="btn btn-del">Supprimer une catégorie</a>
                    </div>
                </div>

                <div class="SousGlobale">
                    </br>

                    <h2>Gestion des produits</h2>

                    </br>

                    <div class="BoutonGauche">
                        <a href="Articles.php?query=add" class="btn btn-add">Ajouter un article</a>
                    </div>

                    <div class="BoutonMilieu">
                        <a href="Articles.php?query=mod" class="btn btn-mod">Modifier un article</a>
                    </div>
                    
                    <div class="BoutonDroit">
                        <a href="Articles.php?query=del" class="btn btn-del">Supprimer un article</a>
                    </div>
                </div>
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