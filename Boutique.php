<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Boutique</title>

        <meta charset="UTF-8">
        <meta name="description" content="SANDBOX">
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

            echo "<section>";
            echo "<div class='Globale'>";

            if(isset($_GET["category"])) {
                $slug = $_GET["category"];
            
                $req = "SELECT * from produit p, categorie c
                WHERE c.Slug_Categorie = '" . $slug . "' AND p.Id_Category = c.Id_Category
                ORDER BY Nom_Produit;";
                $res = $con->query($req);

                if($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    echo "<h2>" . $row["Description_Categorie"] . "</h2>
                    <div>
                        <div class='Gauche'>
                            <h4>Nom du produit</h4>
                        </div>
                        <div class='Droite'>
                            <h4>Prix du produit</h4>
                        </div>
                    </div>";

                    echo "<div>
                        <div class='Gauche'>
                            <p>
                            <a href='Produit.php?product=" . $row["Slug_Produit"] . "'>" . $row["Nom_Produit"] . "</a>
                            </p>
                        </div>
                        <div class='Droite'>
                            <p>" .$row["Prix_Produit"] . " €</p>
                        </div>
                    </div>";

                    while($row = $res->fetch_assoc()) {
                        echo "<div>
                            <div class='Gauche'>
                                <p>
                                <a href='Produit.php?product=" . $row["Slug_Produit"] . "'>" . $row["Nom_Produit"] . "</a>
                                </p>
                            </div>
                            <div class='Droite'>
                                <p>" .$row["Prix_Produit"] . " €</p>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<h2>Aucun produit ne correspond à cette catégorie.</h2>";
                }
            } else {
                $req = "SELECT Slug_Produit, Nom_Produit, Prix_Produit from produit p ORDER BY Nom_Produit;";
                $res = $con->query($req);

                echo "<h2>Retrouvez tous nos produits au même endroit !</h2>";
                
                if($res->num_rows > 0) {
                    echo "<div>
                        <div class='Gauche'>
                            <h4>Nom du produit</h4>
                        </div>
                        <div class='Droite'>
                            <h4>Prix du produit</h4>
                        </div>
                    </div>";

                    while($row = $res->fetch_assoc()) {
                        echo "<div>
                            <div class='Gauche'>
                                <p>
                                <a href='Produit.php?product=" . $row["Slug_Produit"] . "'>" . $row["Nom_Produit"] . "</a>
                                </p>
                            </div>
                            <div class='Droite'>
                                <p>" .$row["Prix_Produit"] . " €</p>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<h3>Cependant il n'y a aucun produit... !</h3>";
                }
            }

            echo "</div>";
            echo "</section>";
            
            include 'footer.php';
        ?>
    </body>
</html>