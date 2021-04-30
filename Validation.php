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
            include 'navbar.php';
            
            echo "<section>
                <div class='Global'>
                    <h2>Récapitulatif de la commande</h2>

                </div>
            </section>";

            include 'footer.php';
        ?>
    </body>
</html>