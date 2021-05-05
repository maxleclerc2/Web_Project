<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Traitement de la requête</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page de traitement des requêtes">
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

            $message = "Opération terminée avec succès.";
            $info = "";

            if(isset($_POST["addUsrNom"])) {
                $nom = $_POST["addUsrNom"];
                $prenom = $_POST["addUsrPrenom"];
                $mail = $_POST["addUsrMail"];
                $telephone = $_POST["addUsrPortable"];
                $mdp = $_POST["addUsrMdp"];
                $adm = $_POST["radioAdmin"];

                $req = "INSERT INTO `Utilisateur`(`Admin`, `Nom`, `Prenom`, `Mail`, `Telephone`, `Mot_De_Passe`)
                VALUES ('$adm', '$nom', '$prenom', '$mail', '$telephone', '$mdp');";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "Veuillez vérifier que le mail n'est pas déjà utilisé.";
                }

                $req = "SELECT Id_User FROM utilisateur WHERE Mail = '$mail'";
                $res = $con->query($req);

                if($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    $idUsr = $row["Id_User"];
                } else {
                    $message = "Une erreur est survenue.";
                }

                $ligne1 = $_POST["addUsrL1"];
                $ligne2 = $_POST["addUsrL2"];
                $cp = $_POST["addUsrCp"];
                $ville = $_POST["addUsrVille"];
                $pays = $_POST["addUsrPays"];

                $req = "INSERT INTO `Adresse`(`Id_User`, `Adresse_Ligne_1`, `Adresse_Ligne_2`, `Code_Postal`, `Ville`, `Pays`)
                VALUES ('$idUsr', '$ligne1', '$ligne2', '$cp', '$ville', '$pays');";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }

                $titulaire = $_POST["addUsrTitulaire"];
                $num = $_POST["addUsrNum"];
                $exp = $_POST["addUsrExp"];

                $req = "INSERT INTO `Paiement`(`Id_User`, `Titulaire`, `Numero`, `Expiration`)
                VALUES ('$idUsr', '$titulaire', '$num', '$exp');";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }
            } elseif(isset($_POST["modUsrNom"])) {
                $idUser = $_POST["modUsrId"];
                $nom = $_POST["modUsrNom"];
                $prenom = $_POST["modUsrPrenom"];
                $mail = $_POST["modUsrMail"];
                $telephone = $_POST["modUsrPortable"];
                $mdp = $_POST["modUsrMdp"];
                $adm = $_POST["radioAdmin"];

                $req = "UPDATE `Utilisateur`
                SET `Admin` = '$adm', `Nom` = '$nom', `Prenom` = '$prenom', `Mail` = '$mail', `Telephone` = '$telephone', `Mot_De_Passe` = '$mdp'
                WHERE `Id_User` = '$idUser'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "Veuillez vérifier que le mail n'est pas déjà utilisé.";
                }

                $ligne1 = $_POST["modUsrL1"];
                $ligne2 = $_POST["modUsrL2"];
                $cp = $_POST["modUsrCp"];
                $ville = $_POST["modUsrVille"];
                $pays = $_POST["modUsrPays"];

                $req = "UPDATE `Adresse`
                SET `Adresse_Ligne_1` = '$ligne1', `Adresse_Ligne_2` = '$ligne2', `Code_Postal` = '$cp', `Ville` = '$ville', `Pays` = '$pays'
                WHERE `Id_User` = '$idUser'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }

                $titulaire = $_POST["modUsrTitulaire"];
                $num = $_POST["modUsrNum"];
                $exp = $_POST["modUsrExp"];

                $req = "UPDATE `Paiement`
                SET `Titulaire` = '$titulaire', `Numero` = '$num', `Expiration` = '$exp'
                WHERE `Id_User` = '$idUser'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }
            } elseif(isset($_POST["delUsrId"])) {
                $idUsr = $_POST["delUsrId"];
                $req = "DELETE FROM `Utilisateur` WHERE `Id_User`='$idUsr'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }

                $req = "DELETE FROM `Adresse` WHERE `Id_User`='$idUsr'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }

                $req = "DELETE FROM `Paiement` WHERE `Id_User`='$idUsr'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }

                if($idUsr == $_SESSION["id"]) {
                    header("Location: Deconnexion.php");
                }
            } elseif(isset($_POST["addCatTitre"])) {
                $titre = $_POST["addCatTitre"];
                $description = $_POST["addCatDesc"];
                $slug = $_POST["addCatSlug"];

                $req = "INSERT INTO `Categorie`(`Titre_Categorie`, `Description_Categorie`, `Slug_Categorie`)
                VALUES ('$titre', '$description', '$slug');";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "Veuillez vérifier que le slug n'est pas déjà utilisé.";
                }
            } elseif(isset($_POST["modCatId"])) {
                $idCat = $_POST["modCatId"];
                $titre = $_POST["modCatTitre"];
                $description = $_POST["modCatDesc"];
                $slug = $_POST["modCatSlug"];

                $req = "UPDATE `Categorie`
                SET `Titre_Categorie` = '$titre', `Description_Categorie` = '$description', `Slug_Categorie` = '$slug'
                WHERE `Id_Category` = '$idCat'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "Veuillez vérifier que le slug n'est pas déjà utilisé.";
                }
            } elseif(isset($_POST["delCatId"])) {
                $idCat = $_POST["delCatId"];
                $req = "DELETE FROM `Categorie` WHERE `Id_Category`='$idCat'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }

                $req = "SELECT Nom_Produit FROM `Produit` WHERE `Id_Category`='$idCat'";
                $res = $con->query($req);

                if($res->num_rows > 0) {
                    echo "<h3>Attention, ces produits n'ont plus de catégorie :</h3>";
                    while($row = $res->fetch_assoc()) {
                        echo "<p>" . $row["Nom_Produit"] . "</p>";
                    }
                } else {
                    echo "<h3>Aucun produit n'a été affecté par la suppresion.</h3>";
                }

                $req = "UPDATE `Produit`
                SET `Id_Category` = 0
                WHERE `Id_Category` = '$idCat'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }


            } elseif(isset($_POST["addProdNom"])) {
                $nom = $_POST["addProdNom"];
                $description = $_POST["addProdDesc"];
                $prix = $_POST["addProdPrix"];
                $quantite = $_POST["addProdQuantite"];
                $image = $_POST["addProdImage"];
                $slug = $_POST["addProdSlug"];
                $reference = $_POST["addProdRef"];
                $idCat = $_POST["addProdCat"];

                $req = "INSERT INTO `Produit`(`Id_Category`, `Reference_Produit`, `Slug_Produit`, `Nom_Produit`, `Prix_Produit`, `Quantite_Produit`,  `Description_Produit`, `Image_Produit`)
                VALUES ('$idCat', '$reference', '$slug', '$nom', '$prix', '$quantite', '$description', '$image');";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "Veuillez vérifier que le slug et la référence ne sont pas déjà utilisés.";
                }
            } elseif(isset($_POST["modProdId"])) {
                $idProd = $_POST["modProdId"];
                $nom = $_POST["modProdNom"];
                $description = $_POST["modProdDesc"];
                $prix = $_POST["modProdPrix"];
                $quantite = $_POST["modProdQuantite"];
                $image = $_POST["modProdImage"];
                $slug = $_POST["modProdSlug"];
                $reference = $_POST["modProdRef"];
                $idCat = $_POST["modProdCat"];

                $req = "UPDATE `Produit`
                SET `Nom_Produit` = '$nom', `Description_Produit` = '$description', `Prix_Produit` = '$prix',
                `Quantite_Produit` = '$quantite', `Image_Produit` = '$image', `Slug_Produit` = '$slug',
                `Reference_Produit` = '$reference', `Id_Category` = '$idCat'
                WHERE `Id_Product` = '$idProd'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "Veuillez vérifier que le slug et la référence ne sont pas déjà utilisés.";
                }
            } elseif(isset($_POST["delProdId"])) {
                $idProd = $_POST["delProdId"];
                $req = "DELETE FROM `Produit` WHERE `Id_Product`='$idProd'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                }
            } elseif(isset($_POST["modCompteNom"])) {
                $_SESSION["message"] = "Vos informations ont été modifiées avec succès.";

                $idUser = $_SESSION["id"];
                $nom = $_POST["modCompteNom"];
                $prenom = $_POST["modComptePrenom"];
                $mail = $_POST["modCompteMail"];
                $telephone = $_POST["modComptePortable"];
                $mdp = $_POST["modCompteMdp"];

                $req = "UPDATE `Utilisateur`
                SET `Nom` = '$nom', `Prenom` = '$prenom', `Mail` = '$mail', `Telephone` = '$telephone', `Mot_De_Passe` = '$mdp'
                WHERE `Id_User` = '$idUser'";
                $res = $con->query($req);

                if(!$res) {
                    $_SESSION["message"] = "Une erreur est survenue...<br>Cette adresse mail est peut-être déjà liée à un autre compte.";
                }

                header('location: Compte.php');
            } elseif(isset($_POST["modAdresseL1"])) {
                $_SESSION["message"] = "Vos informations ont été modifiées avec succès.";

                $idUser = $_SESSION["id"];
                $ligne1 = $_POST["modAdresseL1"];
                $ligne2 = $_POST["modAdresseL2"];
                $cp = $_POST["modAdresseCp"];
                $ville = $_POST["modAdresseVille"];
                $pays = $_POST["modAdressePays"];

                $req = "UPDATE `Adresse`
                SET `Adresse_Ligne_1` = '$ligne1', `Adresse_Ligne_2` = '$ligne2', `Code_Postal` = '$cp', `Ville` = '$ville', `Pays` = '$pays'
                WHERE `Id_User` = '$idUser'";
                $res = $con->query($req);

                if(!$res) {
                    $_SESSION["message"] = "Une erreur est survenue...";
                }

                header('location: Compte.php?query=adresse');
            } elseif(isset($_POST["modCarteTitulaire"])) {
                $_SESSION["message"] = "Vos informations ont été modifiées avec succès.";

                $idUser = $_SESSION["id"];
                $titulaire = $_POST["modCarteTitulaire"];
                $num = $_POST["modCarteNum"];
                $exp = $_POST["modCarteExp"];

                $req = "UPDATE `Paiement`
                SET `Titulaire` = '$titulaire', `Numero` = '$num', `Expiration` = '$exp'
                WHERE `Id_User` = '$idUser'";
                $res = $con->query($req);

                if(!$res) {
                    $_SESSION["message"] = "Une erreur est survenue...";
                }

                header('location: Compte.php?query=carte');
            } elseif(isset($_POST["delCompte"])) {
                $message = "Votre compte a bien été supprimé.";
                $info = "A bientôt sur K-Rouf !";

                $idUsr = $_SESSION["id"];
                $req = "DELETE FROM `Utilisateur` WHERE `Id_User`='$idUsr'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "";
                }

                $req = "DELETE FROM `Adresse` WHERE `Id_User`='$idUsr'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "";
                }

                $req = "DELETE FROM `Paiement` WHERE `Id_User`='$idUsr'";
                $res = $con->query($req);

                if(!$res) {
                    $message = "Une erreur est survenue.";
                    $info = "";
                }

                unset($_SESSION["loggedin"]);
                unset($_SESSION["admin"]);
                unset($_SESSION["id"]);
            } else {
                header("Location: Administration.php");
            }
            
            echo "<h3>" . $message . "</h3>
            <h4>" . $info . "</h4>
            </div>
            </section>";
            
            include 'footer.php';
        ?>
    </body>
</html>