-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 mai 2021 à 14:44
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_web_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `Id_Adress` bigint NOT NULL AUTO_INCREMENT,
  `Id_User` bigint NOT NULL,
  `Adresse_Ligne_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Adresse_Ligne_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Code_Postal` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ville` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pays` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id_Adress`),
  KEY `fk_user` (`Id_User`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`Id_Adress`, `Id_User`, `Adresse_Ligne_1`, `Adresse_Ligne_2`, `Code_Postal`, `Ville`, `Pays`) VALUES
(1, 1, 'ici', 'ici2', '75002', 'Paris', 'France'),
(2, 2, 'là', 'là2', '75001', 'Paris', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `Id_Category` bigint NOT NULL AUTO_INCREMENT,
  `Titre_Categorie` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Slug_Categorie` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description_Categorie` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id_Category`),
  UNIQUE KEY `Slug_Categorie` (`Slug_Categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`Id_Category`, `Titre_Categorie`, `Slug_Categorie`, `Description_Categorie`) VALUES
(1, 'Fruits et légumes', 'fruits-legumes', '5 fruits et légumes par jour, c’est pas compliqué !'),
(2, 'Frais', 'frais', 'Toujours aussi bon, même plusieurs jour après achat !'),
(3, 'Surgelés', 'surgeles', 'Pour des glaces plus froides qu’en hiver !'),
(4, 'Traiteur', 'traiteur', 'De bons petits plats fraichement préparés rien que pour vous !');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Id_Order` bigint NOT NULL AUTO_INCREMENT,
  `Id_User` bigint NOT NULL,
  `Nom_Commande` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenom_Commande` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mail_Commande` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Telephone_Commande` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Adresse_Ligne_1_Commande` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Adresse_Ligne_2_Commande` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Code_Postal_Commande` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ville_Commande` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pays_Commande` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Total_Commande` float DEFAULT NULL,
  `Date_Commande` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Order`),
  KEY `fk4_user` (`Id_User`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`Id_Order`, `Id_User`, `Nom_Commande`, `Prenom_Commande`, `Mail_Commande`, `Telephone_Commande`, `Adresse_Ligne_1_Commande`, `Adresse_Ligne_2_Commande`, `Code_Postal_Commande`, `Ville_Commande`, `Pays_Commande`, `Total_Commande`, `Date_Commande`) VALUES
(1, 2, 'Legacy', 'Trace', 'legacy@gmail.com', '0970821773', 'là', 'là2', '75001', 'Paris', 'France', 100, '2021-05-05 14:46:40'),
(2, 1, 'Leclerc', 'Maxence', 'leclerc@gmail.com', '0625009094', 'ici', 'ici2', '75002', 'Paris', 'France', 500, '2021-05-05 15:57:30');

-- --------------------------------------------------------

--
-- Structure de la table `commande_produits`
--

DROP TABLE IF EXISTS `commande_produits`;
CREATE TABLE IF NOT EXISTS `commande_produits` (
  `Id_Order_Items` bigint NOT NULL AUTO_INCREMENT,
  `Id_Order` bigint NOT NULL,
  `Id_Product` bigint NOT NULL,
  `Prix_Commande` float DEFAULT NULL,
  `Quantite_Commande` smallint DEFAULT NULL,
  PRIMARY KEY (`Id_Order_Items`),
  KEY `fk_order` (`Id_Order`),
  KEY `fk2_product` (`Id_Product`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande_produits`
--

INSERT INTO `commande_produits` (`Id_Order_Items`, `Id_Order`, `Id_Product`, `Prix_Commande`, `Quantite_Commande`) VALUES
(1, 1, 6, 100, 10),
(2, 2, 3, 500, 5);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `Id_Card` bigint NOT NULL AUTO_INCREMENT,
  `Id_User` bigint NOT NULL,
  `Titulaire` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Numero` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Expiration` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id_Card`),
  KEY `fk2_user` (`Id_User`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`Id_Card`, `Id_User`, `Titulaire`, `Numero`, `Expiration`) VALUES
(1, 1, 'Maxence Leclerc', '12345678', '11/11'),
(2, 2, 'Trace Legacy', '90123456', '12/12');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `Id_Product` bigint NOT NULL AUTO_INCREMENT,
  `Id_Category` bigint DEFAULT '0',
  `Reference_Produit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Slug_Produit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nom_Produit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description_Produit` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prix_Produit` float DEFAULT NULL,
  `Quantite_Produit` smallint DEFAULT NULL,
  `Image_Produit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id_Product`),
  UNIQUE KEY `Reference_Produit` (`Reference_Produit`),
  UNIQUE KEY `Slug_Produit` (`Slug_Produit`),
  KEY `fk_category` (`Id_Category`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`Id_Product`, `Id_Category`, `Reference_Produit`, `Slug_Produit`, `Nom_Produit`, `Description_Produit`, `Prix_Produit`, `Quantite_Produit`, `Image_Produit`) VALUES
(1, 1, 'POM-1', 'pomme-1', 'Pomme', 'Ceci est une pomme.', 1, 100, 'pomme1.webp'),
(2, 1, 'POM-2', 'pomme-2', 'Pomme dorée', 'Malgré les apparences, ceci est aussi une pomme.', 10, 10, 'pomme2.webp'),
(3, 1, 'POM-3', 'pomme-3', 'Pomme dorée enchantée', 'Une pomme rare et convoitée que seuls les chanceux trouveront.', 100, 0, 'pomme3.webp'),
(4, 2, 'BEURRE', 'beurre', 'Beurre', 'Du simple beurre.', 2, 100, 'beurre.jpg'),
(5, 2, 'FROM-1', 'from-1', 'Emmental', 'Origine Suisse garantie !', 4, 20, 'from1.jpg'),
(6, 2, 'FROM-2', 'from-2', 'Babybel', 'C\'est pas du vrai fromage mais on va faire avec.', 10, 0, 'from2.png'),
(7, 3, 'PIZ-1', 'piz-1', 'Pizza Fraich\'Up', 'Pratique lorsque l\'on a oublié de faire les courses !', 3, 100, 'piz1.jpg'),
(8, 3, 'BROCOLIS', 'brocolis', 'Brocolis', 'Les enfants adorent !', 2, 100, 'bro.jpg'),
(9, 4, 'PIZ-2', 'piz-2', 'Pizza 4 Fromages', 'Pizza fraichement sortie du four !<br><br>* Suggestion de présentation', 4, 50, 'piz2.gif'),
(10, 4, 'FLAM', 'tarte-flambee', 'Flammekueche', 'Seuls les alsaciens savent écrire \'Flammekueche\', nous autres mortels sommes obligés d\'écrire \'Tarte Flambée\'.', 4, 50, 'flam.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Id_User` bigint NOT NULL AUTO_INCREMENT,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  `Nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Telephone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mot_De_Passe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_User`),
  UNIQUE KEY `Mail` (`Mail`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Id_User`, `Admin`, `Nom`, `Prenom`, `Mail`, `Telephone`, `Mot_De_Passe`) VALUES
(1, 1, 'Leclerc', 'Maxence', 'leclerc@gmail.com', '0625009094', 'max'),
(2, 0, 'Legacy', 'Trace', 'legacy@gmail.com', '0970821773', 'flora');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
