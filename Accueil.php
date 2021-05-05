<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page d'accueil de K-Rouf">
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
            <h2>Bienvenue sur K-Rouf, supermarché et commerce en ligne</h2>

            <div class="Globale">
                <br>

                <div>
                    <div class="AccueilGauche">
                        <p>Vous souhaitez découvrir notre catalogue ? Alors c'est juste ici !<p>
                    </div>
                    <div class='BoutonDroit'>
                        <a href='Boutique.php' class='btn btn-add'>Tous nos produits</a>
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

        <?php
            include 'footer.php';
        ?>
    </body>
</html>