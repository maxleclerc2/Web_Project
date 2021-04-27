<?php
    session_start();

    if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
        header("Location: Connexion.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Traitement de la requête</title>

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
            </nav>
            
            <section>
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
            } else {
                header("Location: Administration.php");
            }
            
            echo "<h3>" . $message . "</h3>
            <h4>" . $info . "</h4>
            </div>
            </section>";
        ?>

        <footer>
            <p>
                Site web créé par Maxence Leclerc<br />
                Tous droits réservés
            </p>
        </footer>
    </body>
</html>