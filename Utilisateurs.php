<?php
    session_start();

    if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
        header("Location: Connexion.php");
    }
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

            if(isset($_GET["query"])) {
                $action = $_GET["query"];

                switch($action) {
                    case "add":
                        echo "<section>
                            <div class='Global'>
                            <h1>Ajouter un nouvel utilisateur</h1>
                
                            <form name='Form' method='POST' action='Traitement.php'>

                                <h2>Informations générales</h3>
                                <br>
                
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrNom'>* Nom :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrNom' name='addUsrNom' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrPrenom'>* Prénom :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrPrenom' name='addUsrPrenom' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrMail'>* E-mail :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrMail' name='addUsrMail' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrPortable'>Portable :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrPortable' name='addUsrPortable' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrMdp'>* Mot de passe :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrMdp' name='addUsrMdp' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label>Rôle administrateur :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='radio' id='adminOui' name='radioAdmin' value='1'>
                                        <label for='adminOui'>Oui</label>
                                        <input type='radio' id='adminNon' name='radioAdmin' value='0' checked='checked'>
                                        <label for='adminNon'>Non</label>
                                    </div>
                                </div>
                                
                                <br>
                                <h2>Adresse</h3>
                                <br>

                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrL1'>Ligne 1 :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrL1' name='addUsrL1' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrL2'>Ligne 2 :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrL2' name='addUsrL2' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrCp'>Code postal :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrCp' name='addUsrCp' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrVille'>Ville :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrVille' name='addUsrVille' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrPays'>Pays :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrPays' name='addUsrPays' size='30'>
                                    </div>
                                </div>

                                <br>
                                <h2>Coordonnées bancaires</h3>
                                <br>

                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrTitulaire'>Titulaire :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrTitulaire' name='addUsrTitulaire' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrNum'>Numéro :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrNum' name='addUsrNum' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addUsrExp'>Date d'expiration :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addUsrExp' name='addUsrExp' size='30'>
                                    </div>
                                </div>

                                <br>
                                <input type='submit' id='confirmSub' name='confirmSub' value='Ajouter le nouvel utilisateur' ><br>
                            
                            </form>
                
                            </div>
                        </section>";

                        break;
                    case "mod":

                        break;
                    case "del":

                        break;
                    default:
                        header("Location: Administration.php");
                        break;
                }
            } else {
                header("Location: Administration.php");
            }
        ?>

        <footer>
            <p>
                Site web créé par Maxence Leclerc<br />
                Tous droits réservés
            </p>
        </footer>
    </body>
</html>