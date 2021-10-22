-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 20 oct. 2021 à 07:45
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `plantshop`
--

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `client_id`, `telephone`, `numero`, `rue`, `cp`, `ville`, `nom`, `prenom`, `date_creation`) VALUES
(1, 2, 303030303, 3, 'Main Street', 49000, 'Angers', 'Titi', 'titi', '2021-10-11'),
(2, 2, 123456789, 12, 'rue de Londres', 75000, 'Paris', 'Lulu', 'tutu', '2021-10-12'),
(3, 4, 241000000, NULL, 'Chateau de Poudlard', 42150, 'Londres', 'Potter', 'Harry', '2021-10-14'),
(4, 6, 235000000, 2, 'rue du Chat', 41250, 'Loudo', 'Testounet', 'Li', '2021-10-15'),
(5, 7, 606060606, NULL, 'rue du vaisseau', 15015, 'Mars', 'Dark', 'Vador', '2021-10-15'),
(7, 8, 123456789, 12, 'Boulevard Street', 45621, 'New York', 'Hendrix', 'Jimmy', '2021-10-18'),
(8, 11, 512356202, 654, 'Main street', 456879, 'Miami', 'Weasley', 'Ron', '2021-10-19'),
(9, 12, 202020202, 2, 'rue de la paix', 49000, 'Angers', 'Amour', 'Mon', '2021-10-19');

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `categorie_id`, `nom`, `description`, `images`, `prix`, `sous_categorie_id`) VALUES
(1, 1, 'Pied déléphant', '', 'pied_d_elephant.jpg', 5.55, 1),
(2, 1, 'Rosier Josephs Coat', 'Donec consectetur massa id varius pharetra. Nullam at tincidunt nulla, eu dapibus eros.', 'rosier_josephs_coat.jpg', 18.35, 4),
(3, 1, 'Rosier Mysterieux', 'Donec molestie porttitor elit fringilla hendrerit. Aenean quis dolor enim. Etiam molestie libero maximus venenatis tincidunt.', 'rosier_mysterieuse.jpg', 22.5, 4),
(4, 1, 'Rosier Prince Jardinier', 'Nullam arcu dui, porta et rhoncus sed, ultricies eget dui.', 'rosier_prince_jardinier.jpg', 35.99, 4),
(5, 1, 'Scille de Siberie', 'Mauris at tortor efficitur, elementum lorem sit amet, consequat diam. Integer scelerisque dolor mauris, vel porttitor purus congue vel.Nullam arcu dui, porta et rhoncus sed, ultricies eget dui.', 'scille_de_siberie.jpg', 10, 6),
(6, 1, 'Yucca', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis tortor id mi ultricies accumsan. Nullam arcu dui, porta et rhoncus sed, ultricies eget dui.', 'yucca.jpg', 25.99, 1),
(7, 1, 'Chataigner de Guyane', 'Nam at massa tristique ligula dapibus varius eu ut nunc. Nulla facilisi. Duis id accumsan lacus. Mauris posuere lacus eget felis venenatis tempor.', 'chataignier_de_guyane.jpg', 15.99, 1),
(8, 1, 'Dalhia Sylvia', 'Nullam arcu dui, porta et rhoncus sed, ultricies eget dui.', 'dalhia_sylvia.jpg', 19.99, 7),
(9, 1, 'Jacinthes bleues', 'Donec elementum massa sapien, at dapibus nulla fermentum sed.', 'jacinthe_bleu.jpg', 13, 6),
(10, 1, 'Areca', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis tortor id mi ultricies accumsan. Nullam arcu dui, porta et rhoncus sed, ultricies eget dui.', 'areca.jpg', 19.99, 1),
(21, 1, 'Lys', 'Donec tempor, elit et aliquam sodales, tellus tortor aliquet nisl, gravida porta tellus odio a nisl.', 'lys.jpg', 5, 6),
(22, 1, 'Monstera', 'In sodales erat ac orci volutpat faucibus. Proin tristique est nunc, ullamcorper ultricies metus consectetur ut.', 'monstera.jpg', 45.01, 1),
(23, 1, 'Muguet', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'muguet.jpg', 12.99, 6),
(24, 1, 'Palmier hawaien', 'Curabitur dapibus magna turpis, sed ultricies diam semper in.', 'palmier_hawaien.jpg', 19.99, 1),
(25, 3, 'Arrosoir', 'Donec tempor, elit et aliquam sodales, tellus tortor aliquet nisl, gravida porta tellus odio a nisl.', 'arrosoir.jpg', 5.5, 11),
(26, 3, 'Brouette', 'In sodales erat ac orci volutpat faucibus. Proin tristique est nunc, ullamcorper ultricies metus consectetur ut.', 'brouette.jpg', 42, 13),
(27, 3, 'Pelle', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'pelle.jpg', 12.99, 12),
(28, 3, 'Sécateur', 'Curabitur dapibus magna turpis, sed ultricies diam semper in.', 'secateur.jpg', 19.99, 12),
(29, 2, 'Lot de canard décoratif', 'Nullam arcu dui, porta et rhoncus sed, ultricies eget dui.', 'canard_decoration.jpg', 25.99, 10),
(30, 2, 'Pot en terre cuite', 'Donec elementum massa sapien, at dapibus nulla fermentum sed.', 'pot_terre_cuite.jpg', 13, 8),
(31, 2, 'Pot bleu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis tortor id mi ultricies accumsan. Nullam arcu dui, porta et rhoncus sed, ultricies eget dui.', 'pot_bleu.jpg', 19.99, 8),
(32, 2, 'Pot en céramique', 'Donec tempor, elit et aliquam sodales, tellus tortor aliquet nisl, gravida porta tellus odio a nisl.', 'pot_ceramique.jpg', 8, 8),
(33, 2, 'Cache-pot en osier', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'pot_osier.jpg', 12.99, 9),
(34, 2, 'Pot gris', 'In sodales erat ac orci volutpat faucibus. Proin tristique est nunc, ullamcorper ultricies metus consectetur ut.', 'pot_gris.jpg', 32.1, 8),
(35, 2, 'Tête de mort décorative', 'Curabitur dapibus magna turpis, sed ultricies diam semper in.', 'tete_mort_decoration.jpg', 19.99, 10);

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Plante'),
(2, 'Decoration'),
(3, 'Outils');

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `client_id`, `valider`, `date`, `reference`, `commande`) VALUES
(2, 4, 1, '2021-10-15 07:11:16', 1, 'a:5:{s:7:\"produit\";a:1:{i:1;a:5:{s:9:\"reference\";s:16:\"Pied déléphant\";s:8:\"quantite\";i:2;s:4:\"prix\";d:5.55;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:19:\"pied_d_elephant.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:5:\"Harry\";s:3:\"nom\";s:6:\"Potter\";s:9:\"telephone\";i:241000000;s:6:\"numero\";N;s:3:\"rue\";s:19:\"Chateau de Poudlard\";s:2:\"cp\";i:42150;s:5:\"ville\";s:7:\"Londres\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:5:\"Harry\";s:3:\"nom\";s:6:\"Potter\";s:9:\"telephone\";i:241000000;s:6:\"numero\";N;s:3:\"rue\";s:19:\"Chateau de Poudlard\";s:2:\"cp\";i:42150;s:5:\"ville\";s:7:\"Londres\";}s:4:\"prix\";d:11.1;s:5:\"token\";s:40:\"f7608adb603bc010bf4673f980221fb2152f5c14\";}'),
(3, 4, 1, '2021-10-15 07:35:27', 2, 'a:5:{s:7:\"produit\";a:1:{i:2;a:5:{s:9:\"reference\";s:19:\"Rosier Josephs Coat\";s:8:\"quantite\";i:1;s:4:\"prix\";d:18.35;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:23:\"rosier_josephs_coat.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:5:\"Harry\";s:3:\"nom\";s:6:\"Potter\";s:9:\"telephone\";i:241000000;s:6:\"numero\";N;s:3:\"rue\";s:19:\"Chateau de Poudlard\";s:2:\"cp\";i:42150;s:5:\"ville\";s:7:\"Londres\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:5:\"Harry\";s:3:\"nom\";s:6:\"Potter\";s:9:\"telephone\";i:241000000;s:6:\"numero\";N;s:3:\"rue\";s:19:\"Chateau de Poudlard\";s:2:\"cp\";i:42150;s:5:\"ville\";s:7:\"Londres\";}s:4:\"prix\";d:18.35;s:5:\"token\";s:40:\"291092328274f31b3fb4f0710a28cad6f740558c\";}'),
(4, 4, 1, '2021-10-15 07:36:11', 3, 'a:5:{s:7:\"produit\";a:1:{i:30;a:5:{s:9:\"reference\";s:18:\"Pot en terre cuite\";s:8:\"quantite\";i:1;s:4:\"prix\";d:13;s:9:\"categorie\";s:10:\"Decoration\";s:6:\"images\";s:19:\"pot_terre_cuite.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:5:\"Harry\";s:3:\"nom\";s:6:\"Potter\";s:9:\"telephone\";i:241000000;s:6:\"numero\";N;s:3:\"rue\";s:19:\"Chateau de Poudlard\";s:2:\"cp\";i:42150;s:5:\"ville\";s:7:\"Londres\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:5:\"Harry\";s:3:\"nom\";s:6:\"Potter\";s:9:\"telephone\";i:241000000;s:6:\"numero\";N;s:3:\"rue\";s:19:\"Chateau de Poudlard\";s:2:\"cp\";i:42150;s:5:\"ville\";s:7:\"Londres\";}s:4:\"prix\";d:13;s:5:\"token\";s:40:\"6e14936309b083e4f7bf9989093049d7914b29af\";}'),
(5, 4, 1, '2021-10-15 07:50:03', 4, 'a:5:{s:7:\"produit\";a:1:{i:3;a:5:{s:9:\"reference\";s:17:\"Rosier Mysterieux\";s:8:\"quantite\";i:1;s:4:\"prix\";d:22.5;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:22:\"rosier_mysterieuse.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:5:\"Harry\";s:3:\"nom\";s:6:\"Potter\";s:9:\"telephone\";i:241000000;s:6:\"numero\";N;s:3:\"rue\";s:19:\"Chateau de Poudlard\";s:2:\"cp\";i:42150;s:5:\"ville\";s:7:\"Londres\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:5:\"Harry\";s:3:\"nom\";s:6:\"Potter\";s:9:\"telephone\";i:241000000;s:6:\"numero\";N;s:3:\"rue\";s:19:\"Chateau de Poudlard\";s:2:\"cp\";i:42150;s:5:\"ville\";s:7:\"Londres\";}s:4:\"prix\";d:22.5;s:5:\"token\";s:40:\"02da6a7eaadc52c599556190971a0c09977b6fc0\";}'),
(6, 2, 1, '2021-10-15 10:00:48', 5, 'a:5:{s:7:\"produit\";a:1:{i:1;a:5:{s:9:\"reference\";s:16:\"Pied déléphant\";s:8:\"quantite\";i:1;s:4:\"prix\";d:5.55;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:19:\"pied_d_elephant.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:4:\"tutu\";s:3:\"nom\";s:4:\"Lulu\";s:9:\"telephone\";i:123456789;s:6:\"numero\";i:12;s:3:\"rue\";s:14:\"rue de Londres\";s:2:\"cp\";i:75000;s:5:\"ville\";s:5:\"Paris\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:4:\"tutu\";s:3:\"nom\";s:4:\"Lulu\";s:9:\"telephone\";i:123456789;s:6:\"numero\";i:12;s:3:\"rue\";s:14:\"rue de Londres\";s:2:\"cp\";i:75000;s:5:\"ville\";s:5:\"Paris\";}s:4:\"prix\";d:5.55;s:5:\"token\";s:40:\"09692c1605789c8a510b2f31c9edc99d621d6e62\";}'),
(7, 6, 1, '2021-10-15 12:54:01', 6, 'a:5:{s:7:\"produit\";a:1:{i:1;a:5:{s:9:\"reference\";s:16:\"Pied déléphant\";s:8:\"quantite\";i:1;s:4:\"prix\";d:5.55;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:19:\"pied_d_elephant.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:2:\"Li\";s:3:\"nom\";s:9:\"Testounet\";s:9:\"telephone\";i:235000000;s:6:\"numero\";i:2;s:3:\"rue\";s:11:\"rue du Chat\";s:2:\"cp\";i:41250;s:5:\"ville\";s:5:\"Loudo\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:2:\"Li\";s:3:\"nom\";s:9:\"Testounet\";s:9:\"telephone\";i:235000000;s:6:\"numero\";i:2;s:3:\"rue\";s:11:\"rue du Chat\";s:2:\"cp\";i:41250;s:5:\"ville\";s:5:\"Loudo\";}s:4:\"prix\";d:5.55;s:5:\"token\";s:40:\"4d0769ced15295e055f2da1cfe2c7fe9d6f934f4\";}'),
(8, 7, 1, '2021-10-15 13:07:33', 7, 'a:5:{s:7:\"produit\";a:1:{i:1;a:5:{s:9:\"reference\";s:16:\"Pied déléphant\";s:8:\"quantite\";i:1;s:4:\"prix\";d:5.55;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:19:\"pied_d_elephant.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:5:\"Vador\";s:3:\"nom\";s:4:\"Dark\";s:9:\"telephone\";i:606060606;s:6:\"numero\";N;s:3:\"rue\";s:15:\"rue du vaisseau\";s:2:\"cp\";i:15015;s:5:\"ville\";s:4:\"Mars\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:5:\"Vador\";s:3:\"nom\";s:4:\"Dark\";s:9:\"telephone\";i:606060606;s:6:\"numero\";N;s:3:\"rue\";s:15:\"rue du vaisseau\";s:2:\"cp\";i:15015;s:5:\"ville\";s:4:\"Mars\";}s:4:\"prix\";d:5.55;s:5:\"token\";s:40:\"a8086f75bd4ef0afc2df6879b9cb8ea32f25ac81\";}'),
(9, 7, 1, '2021-10-15 14:55:40', 8, 'a:5:{s:7:\"produit\";a:3:{i:29;a:5:{s:9:\"reference\";s:24:\"Lot de canard décoratif\";s:8:\"quantite\";i:2;s:4:\"prix\";d:25.99;s:9:\"categorie\";s:10:\"Decoration\";s:6:\"images\";s:21:\"canard_decoration.jpg\";}i:4;a:5:{s:9:\"reference\";s:23:\"Rosier Prince Jardinier\";s:8:\"quantite\";i:1;s:4:\"prix\";d:35.99;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:27:\"rosier_prince_jardinier.jpg\";}i:28;a:5:{s:9:\"reference\";s:9:\"Sécateur\";s:8:\"quantite\";i:3;s:4:\"prix\";d:19.99;s:9:\"categorie\";s:6:\"Outils\";s:6:\"images\";s:12:\"secateur.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:5:\"Vador\";s:3:\"nom\";s:4:\"Dark\";s:9:\"telephone\";i:606060606;s:6:\"numero\";N;s:3:\"rue\";s:15:\"rue du vaisseau\";s:2:\"cp\";i:15015;s:5:\"ville\";s:4:\"Mars\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:5:\"Vador\";s:3:\"nom\";s:4:\"Dark\";s:9:\"telephone\";i:606060606;s:6:\"numero\";N;s:3:\"rue\";s:15:\"rue du vaisseau\";s:2:\"cp\";i:15015;s:5:\"ville\";s:4:\"Mars\";}s:4:\"prix\";d:147.94;s:5:\"token\";s:40:\"5beea1092b50ffd9b4e90ea332b62ef50233d146\";}'),
(10, 8, 1, '2021-10-18 07:23:47', 9, 'a:5:{s:7:\"produit\";a:1:{i:1;a:5:{s:9:\"reference\";s:16:\"Pied déléphant\";s:8:\"quantite\";i:2;s:4:\"prix\";d:5.55;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:19:\"pied_d_elephant.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:5:\"Jimmy\";s:3:\"nom\";s:7:\"Hendrix\";s:9:\"telephone\";i:236000000;s:6:\"numero\";i:5;s:3:\"rue\";s:13:\"rue du Soleil\";s:2:\"cp\";i:49560;s:5:\"ville\";s:3:\"L.A\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:5:\"Jimmy\";s:3:\"nom\";s:7:\"Hendrix\";s:9:\"telephone\";i:236000000;s:6:\"numero\";i:5;s:3:\"rue\";s:13:\"rue du Soleil\";s:2:\"cp\";i:49560;s:5:\"ville\";s:3:\"L.A\";}s:4:\"prix\";d:11.1;s:5:\"token\";s:40:\"4f4aef9d74ed369c0738ae883b657b680e57a760\";}'),
(11, 11, 1, '2021-10-19 07:27:35', 10, 'a:5:{s:7:\"produit\";a:3:{i:1;a:5:{s:9:\"reference\";s:16:\"Pied déléphant\";s:8:\"quantite\";i:2;s:4:\"prix\";d:5.55;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:19:\"pied_d_elephant.jpg\";}i:30;a:5:{s:9:\"reference\";s:18:\"Pot en terre cuite\";s:8:\"quantite\";i:1;s:4:\"prix\";d:13;s:9:\"categorie\";s:10:\"Decoration\";s:6:\"images\";s:19:\"pot_terre_cuite.jpg\";}i:26;a:5:{s:9:\"reference\";s:8:\"Brouette\";s:8:\"quantite\";i:3;s:4:\"prix\";d:42;s:9:\"categorie\";s:6:\"Outils\";s:6:\"images\";s:12:\"brouette.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:3:\"Ron\";s:3:\"nom\";s:7:\"Weasley\";s:9:\"telephone\";i:512356202;s:6:\"numero\";i:654;s:3:\"rue\";s:11:\"Main street\";s:2:\"cp\";i:456879;s:5:\"ville\";s:5:\"Miami\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:3:\"Ron\";s:3:\"nom\";s:7:\"Weasley\";s:9:\"telephone\";i:512356202;s:6:\"numero\";i:654;s:3:\"rue\";s:11:\"Main street\";s:2:\"cp\";i:456879;s:5:\"ville\";s:5:\"Miami\";}s:4:\"prix\";d:150.1;s:5:\"token\";s:40:\"340659aa7ab8bcec91964350daddad48bdff63bc\";}'),
(12, 12, 1, '2021-10-19 17:04:21', 11, 'a:5:{s:7:\"produit\";a:2:{i:6;a:5:{s:9:\"reference\";s:5:\"Yucca\";s:8:\"quantite\";i:3;s:4:\"prix\";d:25.99;s:9:\"categorie\";s:6:\"Plante\";s:6:\"images\";s:9:\"yucca.jpg\";}i:30;a:5:{s:9:\"reference\";s:18:\"Pot en terre cuite\";s:8:\"quantite\";i:1;s:4:\"prix\";d:13;s:9:\"categorie\";s:10:\"Decoration\";s:6:\"images\";s:19:\"pot_terre_cuite.jpg\";}}s:9:\"livraison\";a:7:{s:6:\"prenom\";s:3:\"Mon\";s:3:\"nom\";s:5:\"Amour\";s:9:\"telephone\";i:202020202;s:6:\"numero\";i:2;s:3:\"rue\";s:14:\"rue de la paix\";s:2:\"cp\";i:49000;s:5:\"ville\";s:6:\"Angers\";}s:11:\"facturation\";a:7:{s:6:\"prenom\";s:3:\"Mon\";s:3:\"nom\";s:5:\"Amour\";s:9:\"telephone\";i:202020202;s:6:\"numero\";i:2;s:3:\"rue\";s:14:\"rue de la paix\";s:2:\"cp\";i:49000;s:5:\"ville\";s:6:\"Angers\";}s:4:\"prix\";d:90.97;s:5:\"token\";s:40:\"f2513022ff9e848633d82e05c407c54cbec0750d\";}');

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `categorie_id`, `nom`) VALUES
(1, 1, 'Plante verte'),
(2, 1, 'Plante vivace'),
(3, 1, 'Bambou'),
(4, 1, 'Plante à massif'),
(5, 1, 'Potager'),
(6, 1, 'Bulbes'),
(7, 1, 'Graines'),
(8, 2, 'Pot'),
(9, 2, 'Cache-pot'),
(10, 2, 'Objets decoratif'),
(11, 3, 'Arrosage'),
(12, 3, 'Entretien'),
(13, 3, 'Divers'),
(14, 1, 'Graminées');

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`) VALUES
(1, 'toto@toto.fr', '[]', '$2y$13$XBo9qMFBJEewHq7s1AIYsOe6GnbFu2xi6HJTG0dGnEZXEDywcBF7S', 'toto', 'toto'),
(2, 'titi@titi.fr', '[\"ROLE_USER\"]', '$2y$13$gKGVfRbMVj0ma/pw199xXOznPJkfafpnlgOU6tFgustAgJ.E77106', 'titi', 'titi'),
(3, 'harry@potter.com', '[]', '$2y$13$z2PMyWhnd90RFboOlIrv5eHTbM0VDBwfESIymVlfBIGUaksrh6fqC', 'Potter', 'Harry'),
(4, 'harry@potter.fr', '[]', '$2y$13$8C/LgJUXkUgyBM/LMRy/Jee2GTfnnsofKvScX7yzAoybpzMljcIm6', 'Potter', 'Harry'),
(5, 'h@g.fr', '[\"ROLE_ADMIN\"]', '$2y$13$A78NvE/U4N.NPsaTL8G4K.tbhs8MgxUIHuaYsD.dHXx3P28WrbU6C', 'Granger', 'hermione'),
(6, 'test@test.fr', '[\"ROLE_USER\"]', '$2y$13$Uo4RCydVanM3l3SupyH9muZdSk.CivsLO4WrmJTAoLlY31p/ZZ1f.', 'Tsetounet', 'Li'),
(7, 'dark@vador.fr', '[\"ROLE_USER\"]', '$2y$13$76kuS.Y9QW50.tJWX6x3SO6K562rQZV1sEqH18oFiqbYXDZKJxLGq', 'Vador', 'Dark'),
(8, 'j@hendrix.fr', '[\"ROLE_USER\"]', 'jimmy123', 'Hendrix', 'Jimmy'),
(10, 'admin@admin.fr', '[\"ROLE_ADMIN\"]', '$2y$13$TgIqOxB6VOTfyidOXBTfuulRiSMnzMnpaxCmXhWvEW08b.0LJC.xS', 'Jesudor', 'Tom'),
(11, 'ron@weasley.fr', '[\"ROLE_USER\"]', '$2y$13$sdbChJSE9i1lzNoDOTIzf.FlbXK0WaOhK6FErru1FSrQKwIjgSOcK', 'Weasley', 'Ron'),
(12, 'mon@amour.fr', '[\"ROLE_USER\"]', '$2y$13$JgDwWa9gqQAqOm4iWYY99.1Y6lR.W6aNKLmRVIT01pYdt1PX5D/DS', 'Amour', 'Mon');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
