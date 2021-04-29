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
            <h1>K-Rouf</h1>
        </header>

        <?php
            include 'navbar.php';
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

        <?php
            include 'footer.php';
        ?>
    </body>
</html>