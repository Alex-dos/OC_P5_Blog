-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 03 juil. 2023 à 11:48
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `authors`
--

INSERT INTO `authors` (`id`, `author`) VALUES
(1, 'Alex');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `comment` mediumtext,
  `comment_date` date DEFAULT NULL,
  `valid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_posts1_idx` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `id_user`, `author`, `comment`, `comment_date`, `valid`) VALUES
(1, 1, 1, 'alex', 'super', '2019-01-14', 1),
(3, 8, 5, NULL, 'Super !!!', '2023-07-03', 1),
(4, 8, 6, NULL, 'Merci à toi !', '2023-07-03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `chapo` text,
  `creation_date` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_author` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_users1_idx` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `chapo`, `creation_date`, `id_user`, `id_author`) VALUES
(8, 'Bonjour à tous !', 'Voici le contenu de l\'article', 'Introduction', '2023-07-03', 6, 1),
(9, 'Les bienfaits de la méditation : retrouver le calme intérieur', 'Dans notre société moderne où le stress et l\'anxiété sont omniprésents, il est essentiel de trouver des moyens de se recentrer et de retrouver le calme intérieur. La méditation est une pratique millénaire qui peut nous aider dans cette quête. En se concentrant sur notre respiration et en observant nos pensées sans jugement, nous pouvons atteindre un état de relaxation profonde et de clarté mentale. Dans cet article, nous explorerons les bienfaits de la méditation sur notre bien-être physique et émotionnel, ainsi que des conseils pratiques pour commencer à méditer dès aujourd\'hui.', 'Découvrez comment la méditation peut vous aider à retrouver le calme intérieur et à faire face au stress quotidien. Explorez les bienfaits de cette pratique ancestrale et apprenez des astuces pour intégrer la méditation dans votre routine quotidienne.', '2023-07-03', 6, 1),
(10, '&quot;Les avantages d\'une alimentation équilibrée : nourrir votre corps et votre esprit', 'Une alimentation équilibrée est la clé pour maintenir une bonne santé physique et mentale. Les aliments que nous consommons ont un impact direct sur notre énergie, notre humeur et notre concentration. Dans cet article, nous examinerons les avantages d\'une alimentation équilibrée, y compris la réduction du risque de maladies, l\'amélioration de la digestion, et le renforcement du système immunitaire. Nous partagerons également des conseils pour adopter une alimentation saine et équilibrée au quotidien.', 'Découvrez pourquoi une alimentation équilibrée est essentielle pour votre bien-être global. Apprenez comment choisir les bons aliments, équilibrer vos repas et adopter de saines habitudes alimentaires pour nourrir votre corps et votre esprit.', '2023-07-03', 6, 1),
(11, '5 exercices de yoga pour une meilleure posture et flexibilité', 'La pratique du yoga peut contribuer à améliorer votre posture et votre flexibilité, tout en renforçant votre corps de manière globale. Dans cet article, nous vous présenterons cinq exercices de yoga simples et efficaces pour vous aider à maintenir une bonne posture, à augmenter votre souplesse et à réduire les tensions musculaires. Que vous soyez débutant ou pratiquant expérimenté, ces exercices peuvent être facilement intégrés à votre routine quotidienne pour obtenir des résultats tangibles.', 'Découvrez cinq exercices de yoga qui vous aideront à améliorer votre posture, à augmenter votre flexibilité et à renforcer votre corps. Ajoutez ces mouvements simples à votre pratique quotidienne pour ressentir les bienfaits du yoga sur votre santé physique et mentale.', '2023-07-03', 6, 1),
(12, 'Les avantages de la lecture : une fenêtre ouverte vers le monde', 'La lecture est une activité enrichissante qui nous permet de nous évader, d\'apprendre et de nourrir notre esprit. Dans cet article, nous explorerons les nombreux avantages de la lecture, tels que le développement du vocabulaire, l\'amélioration de la concentration et de la mémoire, ainsi que la stimulation de l\'imagination et de la créativité. Nous partagerons également des recommandations de livres dans différents genres pour inspirer votre prochaine lecture.', 'Découvrez pourquoi la lecture est une activité précieuse pour votre développement personnel. Explorez les avantages de la lecture et trouvez des recommandations de livres captivants dans divers genres littéraires.', '2023-07-03', 6, 1),
(13, 'Les bienfaits de la marche : une activité simple pour une meilleure santé', 'La marche est une activité simple et accessible à tous, mais ses bienfaits sur la santé sont nombreux. Dans cet article, nous examinerons les avantages de la marche régulière, tels que l\'amélioration du système cardiovasculaire, la réduction du stress, la stimulation de la créativité et la promotion de la santé mentale. Nous partagerons également des conseils pour intégrer davantage de marches dans votre quotidien, que ce soit pendant votre pause déjeuner ou en vous promenant dans la nature.', 'Découvrez les bienfaits insoupçonnés de la marche sur votre santé physique et mentale. Apprenez comment intégrer cette activité simple mais puissante dans votre routine quotidienne pour profiter de ses avantages à long terme.', '2023-07-03', 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `status`) VALUES
(1, 'Alex', '$2y$10$tjXyORUg4t8xKrBUZJkY1u.15ve.o.XuTt8Gw1YqDoHSKoRekrY/S', 'test@gmail.com', 1),
(5, 'Alexandre', '$2y$10$nyDNNUtRFbNLva6GikSBhOIY6YieD6kG0q8aKiYUwCwT8.3dRgRXy', 'alexandre@rinverse.io', 2),
(6, 'Admin', '$2y$10$ZILv2OQnKN21OIwT1iv.6ulkvT3g9wq0lffGClcK7/3jsrUwgzDc.', 'Admin@gmail.com', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
