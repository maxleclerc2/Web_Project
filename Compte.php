<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != 1) {
        header("Location: Connexion.php");
    }

    $id = $_SESSION["id"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mon compte</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page de gestion du compte">
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

            echo "<section>
                <div class='Global'>";
                
                $req = "SELECT * from Utilisateur
                WHERE Id_User = '$id'";
                $res = $con->query($req);
                $row = $res->fetch_assoc();

                echo "<h1>Bienvenue " . $row["Prenom"] . " !</h1>
                <div class='CompteGauche'>
                    <nav style='height: 380px;'>
                        <div class='Centre'>
                            <ul>
                                <li class='NavUtilisateur'>
                                <a href='Compte.php'>Mes informations</a>
                                </li>
                            </ul>
                        </div>
                        <div class='Centre'>
                            <ul>
                                <li class='NavUtilisateur'>
                                <a href='Compte.php?query=adresse'>Mon adresse</a>
                                </li>
                            </ul>
                        </div>
                        <div class='Centre'>
                            <ul>
                                <li class='NavUtilisateur'>
                                <a href='Compte.php?query=carte'>Mes coordonnées<br>bancaires</a>
                                </li>
                            </ul>
                        </div>
                        <div class='Centre'>
                            <ul>
                                <li class='NavPanier'>
                                <a href='Compte.php?query=commandes'>Mes anciennes<br>commandes</a>
                                </li>
                            </ul>
                        </div>
                        <div class='Centre'>
                            <ul>
                                <li class='NavBoutique'>
                                <a href='Compte.php?query=suppression'>Supprimer mon<br>compte</a>
                                </li>
                            </ul>
                        </div>
                        <div class='Centre'>
                            <ul>
                                <li class='NavAccueil'>
                                <a href='Deconnexion.php'>Me déconnecter</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class='CompteDroit'>";

                if(isset($_SESSION["message"])) {
                    echo "<h3>" . $_SESSION["message"] . "</h3>";
                    unset($_SESSION["message"]);
                }

                if(isset($_GET["query"])) {
                    $action = $_GET["query"];
    
                    switch($action) {
                        case "adresse":
                            $req = "SELECT * FROM `Adresse` WHERE `Id_User`='$id'";
                            $res = $con->query($req);
                            $row = $res->fetch_assoc();

                            $ligne1 = $row["Adresse_Ligne_1"];
                            $ligne2 = $row["Adresse_Ligne_2"];
                            $cp = $row["Code_Postal"];
                            $ville = $row["Ville"];
                            $pays = $row["Pays"];

                            echo "<form name='Form' method='POST' onsubmit='return modAdresse()' action='Traitement.php'>
                                <h2>Modifier mon adresse</h3>
                                <br>

                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='modAdresseL1'>Ligne 1 :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='modAdresseL1' name='modAdresseL1' value='" . $ligne1 . "' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='modAdresseL2'>Ligne 2 :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='modAdresseL2' name='modAdresseL2' value='" . $ligne2 . "' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='modAdresseCp'>Code postal :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='modAdresseCp' name='modAdresseCp' value='" . $cp . "' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='modAdresseVille'>Ville :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='modAdresseVille' name='modAdresseVille' value='" . $ville . "' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='modAdressePays'>Pays :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='modAdressePays' name='modAdressePays' value='" . $pays . "' size='30'>
                                    </div>
                                </div>
                                
                                <br>
                                <input type='submit' id='confirmSub' name='confirmSub' value='Modifier mes informations'><br>
                            
                            </form>";

                            break;
                        case "carte":
                            $req = "SELECT * FROM `Paiement` WHERE `Id_User`='$id'";
                            $res = $con->query($req);
                            $row = $res->fetch_assoc();

                            $titulaire = $row["Titulaire"];
                            $numero = $row["Numero"];
                            $exp = $row["Expiration"];

                            echo "<form name='Form' method='POST' onsubmit='return modCarte()' action='Traitement.php'>
                                <h2>Modifier ma carte bancaire</h3>
                                <br>

                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='modCarteTitulaire'>Titulaire :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='modCarteTitulaire' name='modCarteTitulaire' value='" . $titulaire . "' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='modCarteNum'>Numéro :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='modCarteNum' name='modCarteNum' value='" . $numero . "' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='modCarteExp'>Date d'expiration :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='modCarteExp' name='modCarteExp' value='" . $exp . "' size='30'>
                                    </div>
                                </div>

                                <br>
                                <input type='submit' id='confirmSub' name='confirmSub' value='Modifier mes informations' ><br>
                            
                            </form>";

                            break;
                        case "commandes":
                            $req = "SELECT `Id_Order`, `Total_Commande`, `Date_Commande` FROM `Commande` WHERE `Id_User`='$id'";
                            $res = $con->query($req);

                            if($res->num_rows > 0) {
                                echo "<table class='table-panier'>
                                    <tr>
                                        <th>Numéro de<br>commande</th>
                                        <th>Total<br>commande</th>
                                        <th>Date</th>
                                    </tr>";
            
                                    while($row = $res->fetch_assoc()) {
                                        echo "<tr>
                                                <th><a href='Commande.php?id=" . $row["Id_Order"] . "' style='margin-left:5em'>" . $row["Id_Order"] . "</a></th>
                                                <th>" . $row["Total_Commande"] . "€</th>
                                                <th>" . $row["Date_Commande"] . "</th>
                                        </tr>";
                                    }

                                echo "</table>";
                            } else {
                                echo "<h2>Aucune commande disponible</h2>";
                            }

                            break;
                        case "suppression":
                            echo "<h2>Êtes-vous sûr de vouloir supprimer votre compte ?</h2>
                            <h3>Toutes les informations liées à votre compte seront supprimées.<br>
                            Les reçus de vos anciennes commandes ne seront plus disponibles</h3>
                            
                            <form name='Form' method='POST' action='Traitement.php'>
                                <input type='hidden' id='delCompte' name='delCompte' value='" . $id . "'>

                                <input type='submit' id='confirmSub' name='confirmSub' value='Supprimer mon compte' ><br>
                            </form>";

                            break;
                    }
                } else {
                    $req = "SELECT * FROM `Utilisateur` WHERE `Id_User`='$id'";
                    $res = $con->query($req);
                    $row = $res->fetch_assoc();

                    $nom = $row["Nom"];
                    $prenom = $row["Prenom"];
                    $mail = $row["Mail"];
                    $telephone = $row["Telephone"];
                    $mdp = $row["Mot_De_Passe"];

                    echo "<form name='Form' method='POST' onsubmit='return modCompte()' action='Traitement.php'>

                        <h2>Modifier les informations relatives à mon compte</h3>
                        <br>
        
                        <div>
                            <div class='FormulaireGauche'>
                                <label for='modCompteNom'>* Nom :</label>
                            </div>
                            <div class='FormulaireDroit'>
                                <input type='text' id='modCompteNom' name='modCompteNom' value='" . $nom . "' size='30'>
                            </div>
                        </div>
                        <div>
                            <div class='FormulaireGauche'>
                                <label for='modComptePrenom'>* Prénom :</label>
                            </div>
                            <div class='FormulaireDroit'>
                                <input type='text' id='modComptePrenom' name='modComptePrenom' value='" . $prenom . "' size='30'>
                            </div>
                        </div>
                        <div>
                            <div class='FormulaireGauche'>
                                <label for='modCompteMail'>* E-mail :</label>
                            </div>
                            <div class='FormulaireDroit'>
                                <input type='text' id='modCompteMail' name='modCompteMail' value='" . $mail . "' size='30'>
                            </div>
                        </div>
                        <div>
                            <div class='FormulaireGauche'>
                                <label for='modComptePortable'>Portable :</label>
                            </div>
                            <div class='FormulaireDroit'>
                                <input type='text' id='modComptePortable' name='modComptePortable' value='" . $telephone . "' size='30'>
                            </div>
                        </div>
                        <div>
                            <div class='FormulaireGauche'>
                                <label for='modCompteMdp'>* Mot de passe :</label>
                            </div>
                            <div class='FormulaireDroit'>
                                <input type='text' id='modCompteMdp' name='modCompteMdp' value='" . $mdp . "' size='30'>
                            </div>
                        </div>

                        <br>
                        <input type='submit' id='confirmSub' name='confirmSub' value='Modifier mes informations'><br>
                    
                    </form>";
                }

                echo "</div>
                </div>
            </section>";
            
            include 'footer.php';
        ?>

        <script src="Javascript.js"></script>

    </body>
</html>