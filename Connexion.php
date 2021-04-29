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

        $req = "SELECT Id_User, Admin from utilisateur
        WHERE Mail = '" . $_POST["formMail"] . "'
        AND Mot_De_Passe = '" . $_POST["formPsw"] . "';";
        $res = $con->query($req);

        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $_SESSION['loggedin'] = true;
            $_SESSION["id"] = $row["Id_User"];
            $_SESSION["admin"] = $row["Admin"];
            header("Location: Accueil.php");
        } else {
            $message = "Identifiant ou mot de passe invalide !";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Se connecter</title>

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
        ?>

        <section>
            <div class="Global">
                <div class="message">
                    <?php 
                        if($message!="") {
                            echo $message;
                        } 
                    ?>
                </div>

                <form name="Form" method="POST" action="">
                    <div>
                        <div class="FormulaireGauche">
                            <label for="formMail">E-Mail :</label>
                        </div>
                        <div class="FormulaireDroit">
                            <input type="text" id="formMail" name="formMail">
                        </div>
                    </div>
                    <div>
                        <div class="FormulaireGauche">
                            <label for="formPsw">Mot de passe :</label>
                        </div>
                        <div class="FormulaireDroit">
                            <input type="text" id="formPsw" name="formPsw">
                        </div>
                    </div>
                    <br>
                    <input type="submit" id="confirmSub" name="confirmSub" value="Confirmer">
                </form>
            </div>
        </section>
        
        <?php
            include 'footer.php';
        ?>
    </body>
</html>