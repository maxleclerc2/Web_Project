<?php
    session_start();

    if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
        header("Location: Connexion.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gestion des catégories</title>

        <meta charset="UTF-8">
        <meta name="description" content="Page de gestion des catégories">
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
                            <h1>Ajouter une nouvelle catégorie</h1>
                
                            <form name='Form' method='POST' action='Traitement.php' onsubmit='return addCat()'>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addCatTitre'>* Titre :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addCatTitre' name='addCatTitre' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addCatDesc'>* Description :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addCatDesc' name='addCatDesc' size='30'>
                                    </div>
                                </div>
                                <div>
                                    <div class='FormulaireGauche'>
                                        <label for='addCatSlug'>* Slug (url) :</label>
                                    </div>
                                    <div class='FormulaireDroit'>
                                        <input type='text' id='addCatSlug' name='addCatSlug' size='30'>
                                    </div>
                                </div>

                                <br>
                                <input type='submit' id='confirmSub' name='confirmSub' value='Ajouter la nouvelle catégorie' >
                                <br>
                            
                            </form>
                
                            </div>
                        </section>";

                        break;
                    case "mod":
                        if(isset($_POST["modCatId"])) {
                            $idCat = $_POST["modCatId"];
                            $req = "SELECT * FROM `Categorie` WHERE `Id_Category`='$idCat'";
                            $res = $con->query($req);

                            if(!$res) {
                                echo "<h2>Une erreur est survenue.</h2>";
                            } else {
                                $row = $res->fetch_assoc();

                                $titre = $row["Titre_Categorie"];
                                $description = $row["Description_Categorie"];
                                $slug = $row["Slug_Categorie"];

                                echo "<section>
                                    <div class='Global'>
                                        <h1>Modification de " . $titre . "</h1>
                            
                                        <form name='Form' method='POST' action='Traitement.php' onsubmit='return modCat()'>
                                            <input type='hidden' id='modCatId' name='modCatId' value='" . $idCat . "'>

                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modCatTitre'>* Titre :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modCatTitre' name='modCatTitre' value='" . $titre . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modCatDesc'>* Description :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modCatDesc' name='modCatDesc' value='" . $description . "' size='30'>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='FormulaireGauche'>
                                                    <label for='modCatSlug'>* Slug (url) :</label>
                                                </div>
                                                <div class='FormulaireDroit'>
                                                    <input type='text' id='modCatSlug' name='modCatSlug' value='" . $slug . "' size='30'>
                                                </div>
                                            </div>

                                            <br>
                                            <input type='submit' id='confirmSub' name='confirmSub' value='Modifier la catégorie' >
                                            <br>
                                        
                                        </form>
                        
                                    </div>
                                </section>";
                            }
                        } else {
                            echo "<section>
                                <div class='Global'>
                                    <h1>Modifier une catégorie</h1>
                        
                                    <form name='Form' method='POST' action='Categories.php?query=mod'>
                                        <div>
                                            <div class='FormulaireGauche'>
                                                <label for='modCatId'>Catégorie à modifier :</label>
                                            </div>
                                            <div class='FormulaireDroit'>
                                                <select name='modCatId'>";
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
                                        <input type='submit' id='confirmMod' name='confirmMod' value='Modifier' ><br>
                                    </form>
                                </div> 
                            </section>";
                        }

                        break;
                    case "del":
                        echo "<section>
                            <div class='Global'>
                                <h1>Supprimer une catégorie</h1>

                                <h3>Les produits appartenant à la catégorie supprimée ne seront pas supprimés.</h3>
                                <h4>Pensez à assigner une nouvelle catégorie aux produits.</h4>
                    
                                <form name='Form' method='POST' action='Traitement.php'>
                                    <div>
                                        <div class='FormulaireGauche'>
                                            <label for='delCatId'>Catégorie à supprimer :</label>
                                        </div>
                                        <div class='FormulaireDroit'>
                                            <select name='delCatId'>";
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
            
            include 'footer.php';
        ?>

        <script src="Javascript.js"></script>

    </body>
</html>