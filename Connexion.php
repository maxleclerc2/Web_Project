<?php
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        header("Location: Accueil.php");
    }

    $message="";
    if(count($_POST)>0) {
        $servername = "127.0.0.1";
        $username = "root";
        $password = null;
        $dbname = "db_web_project";
        $con = new mysqli($servername, $username, $password, $dbname);

        $req = "SELECT Mail, Mot_De_Passe, Admin from utilisateur
        WHERE Mail = '" . $_POST["formMail"] . "'
        AND Mot_De_Passe = '" . $_POST["formPsw"] . "'
        ;";
        $res = $con->query($req);

        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $_SESSION['loggedin'] = true;
            // $_SESSION["mail"] = $row["Mail"];
            // $_SESSION["mdp"] = $row["Mot_De_Passe"];
            $_SESSION["admin"] = $row["Admin"];
            header("Location: Accueil.php");
        } else {
            $message = "Invalid Username or Password!";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bienvenue sur ma page d'accueil !</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page d'accueil du site perso">
        <meta name="keywords" content="HTML, CSS">
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

        <div class="message">
            <?php 
                if($message!="") {
                    echo $message;
                } 
            ?>
        </div>

        <div>
            <form name="Form" method="POST" action="">
                <label for="formMail">E-Mail :</label>
                <input type="text" id="formMail" name="formMail"><br>
                <label for="formPsw">Mot de passe :</label>
                <input type="text" id="formPsw" name="formPsw"><br>
                <input type="submit" id="confirmSub" name="confirmSub" value="Confirmer">
            </form>
        </div>
        
        <footer>
            <p>
                Site web créé par Maxence Leclerc<br />
                Tous droits réservés
            </p>
        </footer>
    </body>
</html>