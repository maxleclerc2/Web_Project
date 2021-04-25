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
                        if(isset($_POST["modUsrId"])) {
                            $idUsr = $_POST["modUsrId"];
                            $req = "SELECT * FROM `Utilisateur` WHERE `Id_User`='$idUsr'";
                            $res = $con->query($req);

                            if(!$res) {
                                echo "<h2>Une erreur est survenue.</h2>";
                            } else {
                                $row = $res->fetch_assoc();

                                $nom = $row["Nom"];
                                $prenom = $row["Prenom"];
                                $mail = $row["Mail"];
                                $telephone = $row["Telephone"];
                                $mdp = $row["Mot_De_Passe"];
                                $adm = $row["Admin"];

                                echo "<section>
                                    <div class='Global'>
                                    <h1>Modification de " . $prenom . " " . $nom . "</h1>
                        
                                    <form name='Form' method='POST' action='Traitement.php'>
                                        <input type='hidden' id='modUsrId' name='modUsrId' value='" . $idUsr . "'>

                                        <h2>Informations générales</h3>
                                        <br>
                        
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrNom'>* Nom :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrNom' name='modUsrNom' value='" . $nom . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrPrenom'>* Prénom :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrPrenom' name='modUsrPrenom' value='" . $prenom . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrMail'>* E-mail :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrMail' name='modUsrMail' value='" . $mail . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrPortable'>Portable :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrPortable' name='modUsrPortable' value='" . $telephone . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrMdp'>* Mot de passe :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrMdp' name='modUsrMdp' value='" . $mdp . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label>Rôle administrateur :</label>
                                            </div>
                                            <div class='FormulaireDroit'>";
                                                if($adm == 1) {
                                                    echo "<input type='radio' id='adminOui' name='radioAdmin' value='1' checked='checked'>
                                                    <label for='adminOui'>Oui</label>
                                                    <input type='radio' id='adminNon' name='radioAdmin' value='0'>
                                                    <label for='adminNon'>Non</label>";
                                                } else {
                                                    echo "<input type='radio' id='adminOui' name='radioAdmin' value='1'>
                                                    <label for='adminOui'>Oui</label>
                                                    <input type='radio' id='adminNon' name='radioAdmin' value='0' checked='checked'>
                                                    <label for='adminNon'>Non</label>";
                                                }
                                            echo "</div>
                                        </div>";
                            }
                                    
                            $req = "SELECT * FROM `Adresse` WHERE `Id_User`='$idUsr'";
                            $res = $con->query($req);

                            if(!$res) {
                                echo "<h2>Une erreur est survenue.</h2>";
                            } else {
                                $row = $res->fetch_assoc();

                                $ligne1 = $row["Adresse_Ligne_1"];
                                $ligne2 = $row["Adresse_Ligne_2"];
                                $cp = $row["Code_Postal"];
                                $ville = $row["Ville"];
                                $pays = $row["Pays"];

                                        echo "<br>
                                        <h2>Adresse</h3>
                                        <br>

                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrL1'>Ligne 1 :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrL1' name='modUsrL1' value='" . $ligne1 . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrL2'>Ligne 2 :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrL2' name='modUsrL2' value='" . $ligne2 . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrCp'>Code postal :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrCp' name='modUsrCp' value='" . $cp . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrVille'>Ville :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrVille' name='modUsrVille' value='" . $ville . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrPays'>Pays :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrPays' name='modUsrPays' value='" . $pays . "' size='30'>
                                            </div>
                                        </div>";
                            }
                            
                            $req = "SELECT * FROM `Paiement` WHERE `Id_User`='$idUsr'";
                            $res = $con->query($req);

                            if(!$res) {
                                echo "<h2>Une erreur est survenue.</h2>";
                            } else {
                                $row = $res->fetch_assoc();

                                $titulaire = $row["Titulaire"];
                                $numero = $row["Numero"];
                                $exp = $row["Expiration"];

                                        echo "<br>
                                        <h2>Coordonnées bancaires</h3>
                                        <br>

                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrTitulaire'>Titulaire :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrTitulaire' name='modUsrTitulaire' value='" . $titulaire . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrNum'>Numéro :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrNum' name='modUsrNum' value='" . $numero . "' size='30'>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrExp'>Date d'expiration :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <input type='text' id='modUsrExp' name='modUsrExp' value='" . $exp . "' size='30'>
                                            </div>
                                        </div>

                                        <br>
                                        <input type='submit' id='confirmSub' name='confirmSub' value='Confirmer les modifications' ><br>
                                    
                                    </form>
                        
                                    </div>
                                </section>";
                            }
                        } else {
                            echo "<section>
                                <div class='Global'>
                                    <h1>Modifier un utilisateur</h1>
                        
                                    <form name='Form' method='POST' action='Utilisateurs.php?query=mod'>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modUsrId'>Utilisateur à supprimer :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <select name='modUsrId'>";
                                                    $req = "SELECT Id_User, Nom, Prenom, Mail FROM `Utilisateur`";
                                                    $res = $con->query($req);

                                                    if($res->num_rows > 0) {
                                                        while($row = $res->fetch_assoc()) {
                                                            echo "<option value=" . $row["Id_User"] . ">" . $row["Nom"] . " "  . $row["Prenom"] . " (" . $row["Mail"] . ")</option>";
                                                        }
                                                    } else {
                                                        echo "<option value='-1'>Aucun utilisateur trouvé</option>";
                                                    }
                                                echo "</select>
                                            </div>
                                        </div>

                                        <br>
                                        <input type='submit' id='confirmMod' name='confirmMod' value='Modifier' ><br>
                                    </form>
                                </div> 
                            </section>";
                        }

                        break;
                    case "del":
                        echo "<section>
                            <div class='Global'>
                                <h1>Supprimer un utilisateur</h1>
                    
                                <form name='Form' method='POST' action='Traitement.php'>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='delUsrId'>Utilisateur à supprimer :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <select name='delUsrId'>";
                                                $req = "SELECT Id_User, Nom, Prenom, Mail FROM `Utilisateur`";
                                                $res = $con->query($req);

                                                if($res->num_rows > 0) {
                                                    while($row = $res->fetch_assoc()) {
                                                        echo "<option value=" . $row["Id_User"] . ">" . $row["Nom"] . " "  . $row["Prenom"] . " (" . $row["Mail"] . ")</option>";
                                                    }
                                                } else {
                                                    echo "<option value='-1'>Aucun utilisateur trouvé</option>";
                                                }
                                            echo "</select>
                                        </div>
                                    </div>

                                    <br>
                                    <input type='submit' id='confirmDel' name='confirmDel' value='Supprimer' ><br>
                                </form>
                            </div> 
                        </section>";

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