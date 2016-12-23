-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 13 Décembre 2016 à 17:15
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `le_bon_sandwich`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(1, 'salades', 'Nos bonnes salades, fraichement livrées par nos producteurs bios et locaux'),
(2, 'crudités', 'Nos crudités variées  et préparées avec soin, issues de producteurs locaux et bio pour la plupart.'),
(3, 'viandes', 'Nos viandes finement découpées et cuites comme vous le préférez. Viande issue d''élevages certifiés et locaux.'),
(4, 'Fromages', 'Nos fromages bios et au lait cru. En majorité des AOC.'),
(5, 'Sauces', 'Toutes les sauces du monde !');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` float NOT NULL,
  `date_de_livraison` date NOT NULL,
  `etat` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `description` text,
  `fournisseur` varchar(128) DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `nom`, `cat_id`, `description`, `fournisseur`, `img`) VALUES
(1, 'laitue', 1, 'belle laitue verte', 'ferme "la bonne salade"', NULL),
(2, 'roquette', 1, 'la roquette qui pète ! bio, bien sur, et sauvage', 'ferme "la bonne salade"', NULL),
(3, 'mâche', 1, 'une mâche toute jeune et croquante', 'ferme "la bonne salade"', NULL),
(4, 'carottes', 2, 'belles carottes bio, rapées avec amour', 'au jardin sauvage', NULL),
(5, 'concombre', 2, 'concombre de jardin, bio et bien frais', 'au jardin sauvage', NULL),
(6, 'avocat', 2, 'avocats en direct du Mexique !', 'la huerta bonita, Puebla', NULL),
(7, 'blanc de poulet', 3, 'blanc de poulet émincé, et grillé comme il faut', 'élevage "le poulet volant"', NULL),
(8, 'magret de canard', 3, 'magret de canard grillé, puis émincé', 'le colvert malin', NULL),
(9, 'steack haché', 3, 'notre steack haché saveur, 5% MG., préparé juste avant cuisson.\r\nViande de notre producteur local.', 'ferme "la vache qui plane"', NULL),
(10, 'munster', 4, 'Du munster de Munster, en direct. Pour amateurs avertis !', 'fromagerie "le bon munster de toujours"', NULL),
(11, 'chèvre frais', 4, 'un chèvre frais onctueux et goutu !', 'A la chèvre rieuse', NULL),
(12, 'comté AOC 18mois', 4, 'le meilleur comté du monde !', 'fromagerie du jura', NULL),
(13, 'vinaigrette huile d''olive', 5, 'la vinaigrette éternelle, à l''huile d''olive et moutarde à l''ancienne.', 'Le Bon Sandwich', NULL),
(14, 'salsa jalapeña', 5, 'sauce très légérement pimentée :-)', 'El Yucateco', NULL),
(15, 'salsa habanera', 5, 'Pour initiés uniquement, dangereux sinon !', 'EL yucateco', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ingredients_commande`
--

CREATE TABLE IF NOT EXISTS `ingredients_commande` (
  `id_ingredient` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
