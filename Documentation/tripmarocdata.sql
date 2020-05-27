-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 27 mai 2020 à 08:33
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tripmarocdata`
--

-- --------------------------------------------------------

--
-- Structure de la table `description_excursion`
--

CREATE TABLE `description_excursion` (
  `id` int(11) NOT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail_excursion`
--

CREATE TABLE `detail_excursion` (
  `id` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `excursion_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail_visite`
--

CREATE TABLE `detail_visite` (
  `id` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `visite_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `excursion`
--

CREATE TABLE `excursion` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree_recommandee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `excursion`
--

INSERT INTO `excursion` (`id`, `nom`, `description`, `photo`, `duree_recommandee`) VALUES
(3, 'Ouarzazate', 'connue comme étant la porte du désert du Sahara', '20b6f7e72b03261c44f27d2f95068e4b.png', 4),
(4, 'Essaouira', 'Charmante ville portuaire', '70fe77332a50ad84d3655b75f5018ddc.jpeg', 3),
(5, 'Qbor saadiine', 'monument historique', '04658afc762857feeea51af79d501dcb.jpeg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200421082741', '2020-04-21 08:29:06'),
('20200423000540', '2020-04-23 00:05:57'),
('20200423001823', '2020-04-23 00:18:37'),
('20200423004336', '2020-04-23 00:44:07'),
('20200423005025', '2020-04-23 00:50:32'),
('20200423010642', '2020-04-23 01:06:58');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nb_personne` int(11) NOT NULL,
  `categorie_hebergement` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(5,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `pseudo`, `pays`) VALUES
(3, 'nom2@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$V2ljNUMzenRoaDYuYkpGLg$8TpU70QpdxeY7rPf9CL5m+GWAsWGTZ1cJ6PlWS+1w/Y', 'nom2', 'prenom2', 'pseudo2', 'Belgique'),
(4, 'nom3@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Z3JHQkIzWkpyWExFcnNnbw$V+MhdLf8RUti9HM08YsfNP0iycyYa9CJDQUHcay7hXg', 'nom3', 'prenom3', 'pseudo3', 'Belgique'),
(6, 'amina@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$M2NRLjdKUWpnYjhwYTRvdQ$8eYAZJ3w2XZkd0yhgXNvQ36DsAsYDATjBoifao4EsCU', 'amina', 'amina', 'amina', 'Maroc'),
(8, 'kawthar@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Q2I5M205NVEvdk9FOXkxZg$1K6kT9728AB955QpVnYdtsMY2gs0E/UabKDLEI2IOtk', 'kawthar', 'kawthar', 'kawthar', 'Maroc'),
(9, 'khalid@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$ZmFVa3FhMUUydHNTb2Mwdg$81jikkY9hO0OGE9ITGgPPjR270r48UMhLwkyBShFay4', 'khalid', 'khalid', 'khalid', 'Maroc'),
(10, 'nom6@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$OEhGajNhVnN3WXZnTzNOWA$oGyWttdtMav5MhTbluTRQAJl28JprosT0t12Uq1ZxQc', 'nom6', 'nom6', 'nom6', 'Belgique'),
(11, 'nom7@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$cHZlSGVQVG5PVklXWUZjOA$3Oqji6TwNUF/grFqwgPK1zvbOxQnKyghVnuhGzeZa18', 'nom7', 'nom7', 'nom7', 'Belgique'),
(12, 'zaineb@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$OEdOMjg1OEpOUkxWSVhkWA$WRp27y67uXI/4BPpl4k1/j6fk6esBL5vkdCXZbBQXiM', 'zaineb', 'zaineb', 'zaineb', 'Maroc'),
(13, 'mouna@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$eVZ0ejBPaE5YYnhkOUZjVw$kdt/U8MNjkYLlmdeOuhMKkdv8PVZA2w22u6a9ucwSIc', 'Mouna', 'Mouna', 'Mouna', 'Espagne'),
(14, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZGFIZmlqbnVjMTZrY3dRWg$gkv1YhiH6d49USfUR7BcRHi2EAdSQHtk+C4cMKQ87t0', 'admin', 'admin', 'admin', 'Maroc'),
(15, 'khalid1@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Ni5rUDlyMjl0Ri9NL1VZbA$a917rdGVnqy6g2FEM3f9hrNG1hmml8KB3SDPdiFk7Bw', 'khalid', 'khalid', 'khalid', 'Belgique');

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

CREATE TABLE `visite` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree_recommandee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `visite`
--

INSERT INTO `visite` (`id`, `nom`, `description`, `photo`, `duree_recommandee`) VALUES
(2, 'Jamae Fna', 'Place historique', 'dbedd28b83ff6d5eed5495fa84019554.jpeg', 3),
(3, 'Jardin Majorelle', 'Jardin extraordinaire', 'fcfc0f63773feefe5387a421de0821ac.jpeg', 3),
(4, 'Menara', 'Jardin fantastique', 'e3c27a1075486eb2a4ed4fa5880728b8.jpeg', 4),
(5, 'Souk', 'Senteur et enivrement garantie', 'b21449ae7c751ec84842834c6151cc1e.jpeg', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `description_excursion`
--
ALTER TABLE `description_excursion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A7BE301CC54C8C93` (`type_id`);

--
-- Index pour la table `detail_excursion`
--
ALTER TABLE `detail_excursion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8AFF329AB83297E7` (`reservation_id`),
  ADD KEY `IDX_8AFF329A4AB4296F` (`excursion_id`);

--
-- Index pour la table `detail_visite`
--
ALTER TABLE `detail_visite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A2569520B83297E7` (`reservation_id`),
  ADD KEY `IDX_A2569520C1C5DC59` (`visite_id`);

--
-- Index pour la table `excursion`
--
ALTER TABLE `excursion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C84955A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `description_excursion`
--
ALTER TABLE `description_excursion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detail_excursion`
--
ALTER TABLE `detail_excursion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detail_visite`
--
ALTER TABLE `detail_visite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `excursion`
--
ALTER TABLE `excursion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `visite`
--
ALTER TABLE `visite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `description_excursion`
--
ALTER TABLE `description_excursion`
  ADD CONSTRAINT `FK_A7BE301CC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `excursion` (`id`);

--
-- Contraintes pour la table `detail_excursion`
--
ALTER TABLE `detail_excursion`
  ADD CONSTRAINT `FK_8AFF329A4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`),
  ADD CONSTRAINT `FK_8AFF329AB83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);

--
-- Contraintes pour la table `detail_visite`
--
ALTER TABLE `detail_visite`
  ADD CONSTRAINT `FK_A2569520B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`),
  ADD CONSTRAINT `FK_A2569520C1C5DC59` FOREIGN KEY (`visite_id`) REFERENCES `visite` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
