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
    <li class='NavBoutique'>
    <a href='Boutique.php'>Tous nos</br>produits</a>
    </li>";

    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            echo "<li class='NavBoutique'>";
            echo "<a href='Boutique.php?category=" . $row["Slug_Categorie"] . "'>" . $row["Titre_Categorie"] . "</a>";
            echo "</li>";
        }
    }

    echo "<li class='NavPanier'>";
    echo "<a href='Panier.php'>Mon panier</a>";
    echo "</li>";

    if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
        echo "<li class='NavAdmin'>";
        echo "<a href='Administration.php'>Espace</br>administrateur</a>";
        echo "</li>";
    }

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        echo "<li class='NavUtilisateur'>";
        echo "<a href='Compte.php'>Mon compte</a>";
        echo "</li>";
        echo "<li class='NavUtilisateur'>";
        echo "<a href='Deconnexion.php'>Déconnexion</a>";
        echo "</li>";
    } else {
        echo "<li class='NavUtilisateur'>";
        echo "<a href='Connexion.php'>Connexion</a>";
        echo "</li>";
    }

    echo "</ul>
    </div>
    </nav>";
?>