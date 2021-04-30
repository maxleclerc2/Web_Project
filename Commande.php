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
                <div class='Global'>";

            if(isset($_GET["id"])) {
                $id = $_GET["id"];
                $req = "SELECT * FROM Commande_Produits WHERE Id_Order = '$id'";
                $res = $con->query($req);

                if($res->num_rows > 0) {
                    echo "<h2>Récapitulatif de la commande " . $id . "</h2>
                    
                    <table class='table-panier'>
                        <tr>
                            <th>Produit</th>
                            <th>Référence</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Prix total produit</th>
                        </tr>";

                    while($row = $res->fetch_assoc()) {
                        $idProd = $row["Id_Product"];
                        $reqProd = "SELECT * FROM Produit WHERE Id_Product = '$idProd'";
                        $resProd = $con->query($reqProd);
                        $rowProd = $resProd->fetch_assoc();

                        echo "<tr>
                            <th>" . $rowProd["Nom_Produit"] . "</th>
                            <th>" . $rowProd["Reference_Produit"] . "</th>
                            <th>" . $rowProd["Prix_Produit"] . "€</th>
                            <th>" . $row["Quantite_Commande"] . "</th>
                            <th>" . $row["Prix_Commande"] . "€</th>
                        </tr>";
                    }

                    echo "</table>";

                    $req = "SELECT * FROM Commande WHERE Id_Order = '$id'";
                    $res = $con->query($req);
                    $row = $res->fetch_assoc();

                    echo "<h2>Informations de contact et de livraison</h2>
                    <br>
                    <p>" . $row["Prenom_Commande"] . " " . $row["Nom_Commande"] . "</p>
                    <p>E-Mail : " . $row["Mail_Commande"] . "</p>
                    <p>Numéro de téléphone : " . $row["Telephone_Commande"] . "</p>
                    <p>Adresse ligne 1 : " . $row["Adresse_Ligne_1_Commande"] . "</p>
                    <p>Adresse ligne 2 : " . $row["Adresse_Ligne_2_Commande"] . "</p>
                    <p>Code postal : " . $row["Code_Postal_Commande"] . "</p>
                    <p>Ville : " . $row["Ville_Commande"] . "</p>
                    <p>Pays : " . $row["Pays_Commande"] . "</p>
                    <p>Total commande : " . $row["Total_Commande"] . "€</p>
                    <p>Date de la commande : " . $row["Date_Commande"] . "</p>";
                } else {
                    echo "<h2>Une erreur est survenue.</h2>";
                }

            } else {
                header("Location: Compte.php?query=commandes");
            }

            echo "</div>
            </section>";
            
            include "footer.php";
        ?>
    </body>
</html>