<?php
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        $id = $_SESSION["id"];
    } else {
        $id = 0;
    }
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

            $message = "Votre commande a bien été enregistrée.";
            $info = "Merci de faire confiance à K-Rouf !";
            
            $nom = $_POST["valCommandeNom"];
            $prenom = $_POST["valCommandePrenom"];
            $mail = $_POST["valCommandeMail"];
            $telephone = $_POST["valCommandePortable"];

            $ligne1 = $_POST["valCommandeL1"];
            $ligne2 = $_POST["valCommandeL2"];
            $cp = $_POST["valCommandeCp"];
            $ville = $_POST["valCommandeVille"];
            $pays = $_POST["valCommandePays"];

            $titulaire = $_POST["valCommandeTitulaire"];
            $numero = $_POST["valCommandeNum"];
            $exp = $_POST["valCommandeExp"];

            $total = $_SESSION["total"];

            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                if(isset($_POST["valSaveInfo"]) && $_POST["valSaveInfo"] == "valSaveInfo") {
                    $req = "UPDATE `Utilisateur`
                    SET `Nom` = '$nom', `Prenom` = '$prenom', `Mail` = '$mail', `Telephone` = '$telephone'
                    WHERE `Id_User` = '$id'";
                    $res = $con->query($req);

                    if(!$res) {
                        $message = "Une erreur est survenue...";
                        $info = "Cette adresse mail est peut-être déjà liée à un autre compte.";
                    }
                }

                if(isset($_POST["valSaveAdr"]) && $_POST["valSaveAdr"] == "valSaveAdr") {
                    $req = "UPDATE `Adresse`
                    SET `Adresse_Ligne_1` = '$ligne1', `Adresse_Ligne_2` = '$ligne2', `Code_Postal` = '$cp', `Ville` = '$ville', `Pays` = '$pays'
                    WHERE `Id_User` = '$id'";
                    $res = $con->query($req);

                    if(!$res) {
                        $message = "Une erreur est survenue...";
                        $info = "";
                    }
                }

                if(isset($_POST["valSaveCarte"]) && $_POST["valSaveCarte"] == "valSaveCarte") {
                    $req = "UPDATE `Paiement`
                    SET `Titulaire` = '$titulaire', `Numero` = '$numero', `Expiration` = '$exp'
                    WHERE `Id_User` = '$id'";
                    $res = $con->query($req);

                    if(!$res) {
                        $message = "Une erreur est survenue...";
                        $info = "";
                    }
                }
            }

            $req = "SELECT NOW();";
            $res = $con->query($req);
            $row = $res->fetch_assoc();
            $date = $row["NOW()"];

            $req = "INSERT INTO `Commande`(`Id_User`, `Nom_Commande`, `Prenom_Commande`, `Mail_Commande`, `Telephone_Commande`, `Adresse_Ligne_1_Commande`, `Adresse_Ligne_2_Commande`, `Code_Postal_Commande`, `Ville_Commande`, `Pays_Commande`, `Total_Commande`, `Date_Commande`)
            VALUES ('$id', '$nom', '$prenom', '$mail', '$telephone', '$ligne1', '$ligne2', '$cp', '$ville', '$pays', '$total', '$date');";
            $res = $con->query($req);

            if(!$res) {
                $message = "Une erreur est survenue...";
                $info = "";
            }

            $req = "SELECT Id_Order FROM Commande WHERE Date_Commande = '$date' AND Id_User = '$id';";
            $res = $con->query($req);
            $row = $res->fetch_assoc();
            $idOrder = $row["Id_Order"];

            $index = 0;

            $req = "SELECT * FROM Produit WHERE Id_Product IN (" . implode(",",$_SESSION["cart"]) . ")";
            $res = $con->query($req);

            while($row = $res->fetch_assoc()){
                $idProd = $row["Id_Product"];
                $prixProd = $_SESSION["qty_array"][$index]*$row["Prix_Produit"];
                $quantite = $_SESSION["qty_array"][$index];

                $reqProduit = "INSERT INTO `Commande_Produits`(`Id_Order`, `Id_Product`, `Prix_Commande`, `Quantite_Commande`)
                VALUES ('$idOrder', '$idProd', '$prixProd', '$quantite');";
                $resProduit = $con->query($reqProduit);

                if(!$resProduit) {
                    $message = "Une erreur est survenue...";
                    $info = "";
                }

                $index ++;
            }

            unset($_SESSION['cart']);

            echo "<section>
                <div class='Global'>
                    <h3>" . $message . "</h3>
                    <h4>" . $info . "</h4>
                </div>
            </section>";

            include 'footer.php';
        ?>

    </body>
</html>