<?php
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        $id = $_SESSION["id"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page de validation de la commande">
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
            
            if(!empty($_SESSION['cart'])) {
                echo "<section>
                    <div class='Global'>";
                        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) {
                            echo "<h2>Vous souhaitez garder une trace de votre commande ?<br>Connectez-vous dès maintenant !</h2>
                            <a href='Connexion.php' class='btn btn-add'>Me connecter</a>";
                        }

                        echo "<h2>Récapitulatif de la commande</h2>

                        <table class='table-panier'>
							<tr>
								<th>Nom</th>
								<th>Prix</th>
								<th>Quantité</th>
								<th>Total produit</th>
							</tr>";

                            $_SESSION["total"] = 0;
                            //create array of initial qty which is 1
                            $index = 0;

                            if(!isset($_SESSION["qty_array"])){
                                $_SESSION["qty_array"] = array_fill(0, count($_SESSION["cart"]), 1);
                            }

                            $req = "SELECT * FROM Produit WHERE Id_Product IN (" . implode(",",$_SESSION["cart"]) . ")";
                            $res = $con->query($req);

                            while($row = $res->fetch_assoc()){
                                echo "<tr>
                                    <th>" . $row["Nom_Produit"] . "</th>
                                    <th>" . number_format($row["Prix_Produit"], 2) . "€</th>
                                    <th>" . $_SESSION["qty_array"][$index] . "</th>
                                    <th>" . number_format($_SESSION["qty_array"][$index]*$row["Prix_Produit"], 2) . "€</th>
                                </tr>";

                                $_SESSION["total"] += $_SESSION["qty_array"][$index]*$row["Prix_Produit"];
                                $index ++;
                            }

							echo "<tr>
								<td colspan='3' align='right'><b>Total</b></td>
								<td><b>" . number_format($_SESSION["total"], 2) . "€</b></td>
							</tr>
						</table>";

                        echo "<h2>Merci de compléter les champs marqués d'une étoile.</h2>
                        <br>
                        <h2>Informations de contact</h2>";

                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                            $req = "SELECT * FROM `Utilisateur` WHERE `Id_User`='$id'";
                            $res = $con->query($req);
                            $row = $res->fetch_assoc();

                            $nom = $row["Nom"];
                            $prenom = $row["Prenom"];
                            $mail = $row["Mail"];
                            $telephone = $row["Telephone"];
                        } else {
                            $nom = "";
                            $prenom = "";
                            $mail = "";
                            $telephone = "";
                        }

                        echo "<form name='Form' method='POST' onsubmit='return valCommande()' action='Traitement_Commande.php'>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeNom'>* Nom :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeNom' name='valCommandeNom' value='" . $nom . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandePrenom'>* Prénom :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandePrenom' name='valCommandePrenom' value='" . $prenom . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeMail'>* E-mail :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeMail' name='valCommandeMail' value='" . $mail . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandePortable'>Portable :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandePortable' name='valCommandePortable' value='" . $telephone . "' size='30'>
                                </div>
                            </div>";
                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                                echo "<div>
                                    <div class='FormulaireGauche'>
                                        <p>Enregistrer ces informations ?</p>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='checkbox' id='valSaveInfo' name='valSaveInfo' value='valSaveInfo'>
                                        <label for='valSaveInfo'>Oui</label>
                                    </div>
                                </div>";
                            }

                        echo "<h2>Adresse de livraison</h2>";

                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                            $req = "SELECT * FROM `Adresse` WHERE `Id_User`='$id'";
                            $res = $con->query($req);
                            $row = $res->fetch_assoc();

                            $ligne1 = $row["Adresse_Ligne_1"];
                            $ligne2 = $row["Adresse_Ligne_2"];
                            $cp = $row["Code_Postal"];
                            $ville = $row["Ville"];
                            $pays = $row["Pays"];
                        } else {
                            $ligne1 = "";
                            $ligne2 = "";
                            $cp = "";
                            $ville = "";
                            $pays = "";
                        }

                            echo "<div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeL1'>* Ligne 1 :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeL1' name='valCommandeL1' value='" . $ligne1 . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeL2'>Ligne 2 :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeL2' name='valCommandeL2' value='" . $ligne2 . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeCp'>* Code postal :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeCp' name='valCommandeCp' value='" . $cp . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeVille'>* Ville :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeVille' name='valCommandeVille' value='" . $ville . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandePays'>* Pays :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandePays' name='valCommandePays' value='" . $pays . "' size='30'>
                                </div>
                            </div>";

                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                                echo "<div>
                                    <div class='FormulaireGauche'>
                                        <p>Enregistrer cette adresse ?</p>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='checkbox' id='valSaveAdr' name='valSaveAdr' value='valSaveAdr'>
                                        <label for='valSaveAdr'>Oui</label>
                                    </div>
                                </div>";
                            }

                        echo "<h2>Informations de paiement</h2>";

                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                            $req = "SELECT * FROM `Paiement` WHERE `Id_User`='$id'";
                            $res = $con->query($req);
                            $row = $res->fetch_assoc();

                            $titulaire = $row["Titulaire"];
                            $numero = $row["Numero"];
                            $exp = $row["Expiration"];
                        } else {
                            $titulaire = "";
                            $numero = "";
                            $exp = "";
                        }
                            echo "<div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeTitulaire'>* Titulaire :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeTitulaire' name='valCommandeTitulaire' value='" . $titulaire . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeNum'>* Numéro :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeNum' name='valCommandeNum' value='" . $numero . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeExp'>* Date d'expiration :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeExp' name='valCommandeExp' value='" . $exp . "' size='30'>
                                </div>
                            </div>
                            <div>
                                <div class='FormulaireGauche'>
                                    <label for='valCommandeSecret'>* Code secret à 3 chiffres :</label>
                                </div>
                                <div class='FormulaireDroit'>
                                    <input type='text' id='valCommandeSecret' name='valCommandeSecret' size='30'>
                                </div>
                            </div>";

                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                                echo "<div>
                                    <div class='FormulaireGauche'>
                                        <p>Enregistrer cette carte ?</p>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='checkbox' id='valSaveCarte' name='valSaveCarte' value='valSaveCarte'>
                                        <label for='valSaveCarte'>Oui</label>
                                    </div>
                                </div>";
                            }

                            echo "<br>
                            <input type='submit' id='confirmSub' name='confirmSub' value='Valider la commande' ><br>
                        
                        </form>";

                    echo "</div>
                </section>";
            } else {
                $_SESSION['message'] = "Votre panier ne contient aucun produit";
                header('location: Panier.php');
            }

            include 'footer.php';
        ?>

        <script src="Javascript.js"></script>

    </body>
</html>