<?php
    session_start();

    if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
        header("Location: Connexion.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gestion des produits</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page de gestion des produits">
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

            if(isset($_GET["query"])) {
                $action = $_GET["query"];

                switch($action) {
                    case "add":
                        echo "<section>
                            <div class='Global'>
                                <h1>Ajouter un nouvel article</h1>
                    
                                <form name='Form' method='POST' action='Traitement.php' onsubmit='return addProd()'>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='addProdNom'>* Nom :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <input type='text' id='addProdNom' name='addProdNom' size='30'>
                                        </div>
                                    </div>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='addProdDesc'>* Description :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <input type='text' id='addProdDesc' name='addProdDesc' size='30'>
                                        </div>
                                    </div>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='addProdPrix'>* Prix :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <input type='text' id='addProdPrix' name='addProdPrix' size='30'>
                                        </div>
                                    </div>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='addProdQuantite'>* Quantité :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <input type='text' id='addProdQuantite' name='addProdQuantite' size='30'>
                                        </div>
                                    </div>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='addProdImage'>Image :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <input type='text' id='addProdImage' name='addProdImage' size='30'>
                                        </div>
                                    </div>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='addProdSlug'>* Slug (url) :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <input type='text' id='addProdSlug' name='addProdSlug' size='30'>
                                        </div>
                                    </div>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='addProdRef'>* Reference :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <input type='text' id='addProdRef' name='addProdRef' size='30'>
                                        </div>
                                    </div>
                                    <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addProdCat'>* Catégorie :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <select name='addProdCat'>";
                                            $req = "SELECT Id_Category, Titre_Categorie FROM `Categorie`";
                                            $res = $con->query($req);

                                            if($res->num_rows > 0) {
                                                while($row = $res->fetch_assoc()) {
                                                    echo "<option value=" . $row["Id_Category"] . ">" . $row["Titre_Categorie"] . "</option>";
                                                }
                                            } else {
                                                echo "<option value='-1'>Aucune catégorie trouvée</option>";
                                            }
                                            echo "</select>
                                        </div>
                                    </div>

                                    <br>
                                    <input type='submit' id='confirmAdd' name='confirmAdd' value='Ajouter le produit' >
                                    <br>
                                
                                </form>
                
                            </div>
                        </section>";

                        break;
                    case "mod":

                        if(isset($_POST["modProdId"])) {
                            $idProd = $_POST["modProdId"];
                            $req = "SELECT * FROM `Produit` WHERE `Id_Product`='$idProd'";
                            $res = $con->query($req);

                            if(!$res) {
                                echo "<h2>Une erreur est survenue.</h2>";
                            } else {
                                $row = $res->fetch_assoc();

                                $nom = $row["Nom_Produit"];
                                $description = $row["Description_Produit"];
                                $prix = $row["Prix_Produit"];
                                $quantite = $row["Quantite_Produit"];
                                $image = $row["Image_Produit"];
                                $slug = $row["Slug_Produit"];
                                $reference = $row["Reference_Produit"];
                                $categorie = $row["Id_Category"];

                                echo "<section>
                                    <div class='Global'>
                                        <h1>Modification de " . $nom . "</h1>
                            
                                        <form name='Form' method='POST' action='Traitement.php' onsubmit='return modProd()'>
                                            <input type='hidden' id='modProdId' name='modProdId' value='" . $idProd . "'>

                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modProdNom'>* Nom :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modProdNom' name='modProdNom' value='" . $nom . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modProdDesc'>* Description :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modProdDesc' name='modProdDesc' value='" . $description . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modProdPrix'>* Prix :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modProdPrix' name='modProdPrix' value='" . $prix . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modProdQuantite'>* Quantité :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modProdQuantite' name='modProdQuantite' value='" . $quantite . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modProdImage'>Image :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modProdImage' name='modProdImage' value='" . $image . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modProdSlug'>* Slug (url) :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modProdSlug' name='modProdSlug' value='" . $slug . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modProdRef'>* Reference :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modProdRef' name='modProdRef' value='" . $reference . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modProdCat'>* Catégorie :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <select name='modProdCat'>";
                                                    $req = "SELECT Id_Category, Titre_Categorie FROM `Categorie`";
                                                    $res = $con->query($req);

                                                    if($res->num_rows > 0) {
                                                        while($row = $res->fetch_assoc()) {
                                                            if($row["Id_Category"] == $categorie) {
                                                                echo "<option value=" . $row["Id_Category"] . " selected='selected'>" . $row["Titre_Categorie"] . "</option>";
                                                            } else {
                                                                echo "<option value=" . $row["Id_Category"] . ">" . $row["Titre_Categorie"] . "</option>";
                                                            }
                                                        }
                                                    } else {
                                                        echo "<option value='-1'>Aucune catégorie trouvée</option>";
                                                    }
                                                    echo "</select>
                                                </div>
                                            </div>

                                            <br>
                                            <input type='submit' id='confirmSub' name='confirmSub' value='Modifier le produit' >
                                            <br>
                                        
                                        </form>
                        
                                    </div>
                                </section>";
                            }
                        } else {
                            echo "<section>
                                <div class='Global'>
                                    <h1>Modifier un produit</h1>
                        
                                    <form name='Form' method='POST' action='Articles.php?query=mod'>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modProdId'>Article à modifier :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <select name='modProdId'>";
                                                    $req = "SELECT Id_Product, Nom_Produit FROM `Produit`";
                                                    $res = $con->query($req);

                                                    if($res->num_rows > 0) {
                                                        while($row = $res->fetch_assoc()) {
                                                            echo "<option value=" . $row["Id_Product"] . ">" . $row["Nom_Produit"] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value='-1'>Aucun produit trouvé</option>";
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
                                <h1>Supprimer un article</h1>
                    
                                <form name='Form' method='POST' action='Traitement.php'>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='delProdId'>Article à supprimer :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <select name='delProdId'>";
                                                $req = "SELECT Id_Product, Nom_Produit FROM `Produit`";
                                                $res = $con->query($req);

                                                if($res->num_rows > 0) {
                                                    while($row = $res->fetch_assoc()) {
                                                        echo "<option value=" . $row["Id_Product"] . ">" . $row["Nom_Produit"] . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value='-1'>Aucun produit trouvé</option>";
                                                }
                                            echo "</select>
                                        </div>
                                    </div>

                                    <br>
                                    <input type='submit' id='confirmDel' name='confirmDel' value='Supprimer le produit' ><br>
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
            
            include 'footer.php';
        ?>

        <script src="Javascript.js"></script>

    </body>
</html>