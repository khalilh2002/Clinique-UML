-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 22 avr. 2024 à 14:16
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lho`
--

-- --------------------------------------------------------

--
-- Structure de la table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `date_rendez_vous` date DEFAULT NULL,
  `evenement` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cadre_administratif`
--

CREATE TABLE `cadre_administratif` (
  `id_cadre_administratif` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `id_directeur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cadre_administratif`
--

INSERT INTO `cadre_administratif` (`id_cadre_administratif`, `nom_complet`, `status`, `id_directeur`) VALUES
(1, 'Laarbi Errahmani', 'Responsable du Docteurs', 1),
(2, 'Said Yamal', 'Responsable du Securité', NULL),
(3, 'aicha', 'RH', NULL),
(5, 'Ahmed El Amrani', 'Responsable du Stock 2', NULL),
(8, 'Mouad El Hansali', 'Responsable IT', NULL),
(10, 'mohamed', 'gerant', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
(1, 'docteur');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_cmd` int(11) NOT NULL,
  `Titre` text NOT NULL,
  `date_commande` date DEFAULT NULL,
  `etat` text DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  `type` text DEFAULT NULL,
  `id_gerant` int(11) DEFAULT NULL,
  `id_fournisseur` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quantité` int(11) DEFAULT NULL,
  `valider` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_cmd`, `Titre`, `date_commande`, `etat`, `date_expiration`, `type`, `id_gerant`, `id_fournisseur`, `description`, `quantité`, `valider`) VALUES
(16, 'DOLIPRANE', '2024-04-21', 'In Progress', '2030-02-02', 'Medicament', NULL, NULL, '200 mg - enfants', 300, 1),
(21, 'FORXIGA', '2024-04-21', 'In Progress', '2027-07-22', 'Medicament', NULL, NULL, 'Forxiga est un médicament utilisé pour traiter le diabète de type 2.', 200, 1),
(22, 'AUGMENTIN', '2024-04-21', 'Non validé', '2030-10-16', 'Medicament', NULL, NULL, 'Augmentin est un antibiotique utilisé pour traiter diverses infections bactériennes, telles que les infections des voies respiratoires', 1000, 0),
(23, 'DOLIPRANE', '2024-04-21', 'Non validé', '2029-10-19', 'Medicament', NULL, NULL, 'Doliprane est un analgésique et antipyrétique couramment utilisé pour soulager la douleur légère à modérée et réduire la fièvre. Son ingrédient actif est le paracétamol', 2000, 0),
(24, 'VOGALENE', '2024-04-21', 'In Progress', '2033-10-21', 'Medicament', NULL, NULL, 'Vogalène est un médicament utilisé pour traiter les troubles gastro-intestinaux, tels que les nausées et les vomissements. Son ingrédient actif est le métoclopramide, qui agit en augmentant la motilité gastrique et en facilitant le vidage de l\'estomac', 1000, 1),
(25, 'SPASFON', '2024-04-21', 'Non validé', '2030-07-18', 'Medicament', NULL, NULL, 'Spasfon est un médicament antispasmodique utilisé pour soulager les spasmes musculaires et les douleurs abdominales associées à des troubles gastro-intestinaux tels que les coliques néphrétiques et les coliques hépatiques', 3000, 0),
(26, 'Stéthoscope', '2024-04-21', 'In Progress', '2024-07-25', 'Matériel', NULL, NULL, 'Un stéthoscope est un instrument médical utilisé pour écouter les sons internes du corps, en particulier les sons du cœur, des poumons et des intestins. Il se compose généralement de deux écouteurs reliés à des tubes flexibles et à un diaphragme ou à une membrane qui capte les sons corporels.', 10, 1),
(27, 'Tensiomètre', '2024-04-21', 'Non validé', '2024-05-02', 'Matériel', NULL, NULL, 'Un tensiomètre est un appareil utilisé pour mesurer la pression artérielle d\'un patient. Il se compose généralement d\'un brassard gonflable qui est enroulé autour du bras du patient, d\'un manomètre pour lire la pression et d\'un système de pompe pour gonfler le brassard.', 20, 0),
(28, 'Otoscope', '2024-04-21', 'In Progress', '2024-06-14', 'Matériel', NULL, NULL, 'Un otoscope est un instrument utilisé pour examiner le canal auditif et le tympan. Il se compose d\'une loupe éclairée avec une lumière intégrée et divers embouts auriculaires pour faciliter l\'inspection de l\'oreille.', 22, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_demande` int(11) NOT NULL,
  `contenu_demande` text DEFAULT NULL,
  `type_demande` text DEFAULT NULL,
  `id_cadre_administratif` int(11) DEFAULT NULL,
  `Status` varchar(100) DEFAULT 'En Attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `contenu_demande`, `type_demande`, `id_cadre_administratif`, `Status`) VALUES
(1, 'Hello this is my Demande hihi', 'Dimission', 3, 'Accepté'),
(3, 'test', 'Modification', 1, 'En Attente'),
(7, 'Hello this is my Demande 2', 'Dimission', 2, 'En Attente'),
(9, 'test allah', 'Dimission', 3, 'Refusé'),
(10, 'Ready', 'Modification', 3, 'En Attente'),
(11, 'Cher Doc Hamid,\r\n\r\nJe vous adresse cette lettre pour vous informer de ma décision de démissionner de mon poste de [Votre Poste] au sein de [Nom de la Clinique]. Ma démission sera effective dans un délai de [Nombre de Semaines ou Mois], conformément aux termes de mon contrat.\r\n\r\nJe tiens à exprimer ma gratitude pour l\'opportunité qui m\'a été offerte de travailler pour [Nom de la Clinique]. Pendant mon séjour ici, j\'ai eu le privilège de travailler avec une équipe dévouée et compétente, et j\'ai beaucoup appris au cours de cette expérience enrichissante.\r\n\r\nCependant, après mûre réflexion, j\'ai décidé qu\'il était temps pour moi de relever de nouveaux défis professionnels et de poursuivre d\'autres opportunités de carrière qui correspondent davantage à mes objectifs personnels et professionnels.\r\n\r\nJe tiens à assurer une transition en douceur de mes responsabilités. Je suis prêt à aider dans le processus de passation des dossiers et à former mon successeur, le cas échéant. Je reste également disponible pour répondre à toute question ou préoccupation que vous pourriez avoir concernant mon départ.\r\n\r\nJe vous remercie pour votre compréhension et votre soutien tout au long de mon parcours au sein de [Nom de la Clinique]. J\'espère que nos chemins se croiseront à nouveau à l\'avenir.\r\n\r\nVeuillez accepter, cher [Nom du Directeur], l\'expression de mes salutations distinguées.\r\n\r\nCordialement,\r\n\r\nAicha Raghib\r\nResponsable RH\r\nClinique Ibéria\r\n+21263545435', 'Dimission', 3, 'En Attente');

-- --------------------------------------------------------

--
-- Structure de la table `directeur`
--

CREATE TABLE `directeur` (
  `id_directeur` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `directeur`
--

INSERT INTO `directeur` (`id_directeur`, `nom_complet`) VALUES
(1, 'Hamid Razouni');

-- --------------------------------------------------------

--
-- Structure de la table `docteur`
--

CREATE TABLE `docteur` (
  `id_docteur` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `num_tel` bigint(20) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doussier_medical`
--

CREATE TABLE `doussier_medical` (
  `id_doussier_medical` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `num_tel` bigint(20) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id_fournisseur` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `id_gerant` int(11) DEFAULT NULL,
  `type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id_fournisseur`, `nom`, `id_gerant`, `type`) VALUES
(1, 'alsa', NULL, NULL),
(2, 'dez', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `gerant`
--

CREATE TABLE `gerant` (
  `id_gerant` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `num_tel` bigint(20) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gerant`
--

INSERT INTO `gerant` (`id_gerant`, `nom_complet`, `salaire`, `cni`, `genre`, `email`, `num_tel`, `id_employee`) VALUES
(1, 'mohamed', 2000.00, 'as1888', 'homme', 'mohamed@gmail.com', 20303040, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `infermiere`
--

CREATE TABLE `infermiere` (
  `id_infermiere` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `num_tel` bigint(20) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `numero_operation` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `id_docteur` int(11) DEFAULT NULL,
  `id_doussier_medical` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `operation_infermiere`
--

CREATE TABLE `operation_infermiere` (
  `id_infermiere` int(11) DEFAULT NULL,
  `numero_operation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email` text DEFAULT NULL,
  `num_tel` bigint(20) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `type_de_sang` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rh`
--

CREATE TABLE `rh` (
  `id_rh` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `num_tel` bigint(20) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `id_cadre_administratif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `secraitere`
--

CREATE TABLE `secraitere` (
  `id_sec` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `numero_transaction` int(11) DEFAULT NULL,
  `id_agenda` int(11) DEFAULT NULL,
  `id_docteur` int(11) DEFAULT NULL,
  `id_patient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `id_gerant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `system_de_facturation`
--

CREATE TABLE `system_de_facturation` (
  `numero_transaction` int(11) NOT NULL,
  `montant_payer` decimal(10,2) DEFAULT NULL,
  `status_paiement` tinyint(1) DEFAULT NULL,
  `mode_paiement` text DEFAULT NULL,
  `reference_facture` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Index pour la table `cadre_administratif`
--
ALTER TABLE `cadre_administratif`
  ADD PRIMARY KEY (`id_cadre_administratif`),
  ADD KEY `directeur_fk` (`id_directeur`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_cmd`),
  ADD KEY `gerant_fk_2` (`id_gerant`),
  ADD KEY `fournisseur_fk` (`id_fournisseur`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `id_cadre_administratif` (`id_cadre_administratif`);

--
-- Index pour la table `directeur`
--
ALTER TABLE `directeur`
  ADD PRIMARY KEY (`id_directeur`);

--
-- Index pour la table `docteur`
--
ALTER TABLE `docteur`
  ADD PRIMARY KEY (`id_docteur`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `employee_fk_3` (`id_employee`);

--
-- Index pour la table `doussier_medical`
--
ALTER TABLE `doussier_medical`
  ADD PRIMARY KEY (`id_doussier_medical`);

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `categorie_fk` (`id_categorie`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id_fournisseur`),
  ADD KEY `gerant_fk` (`id_gerant`);

--
-- Index pour la table `gerant`
--
ALTER TABLE `gerant`
  ADD PRIMARY KEY (`id_gerant`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `employee_fk_` (`id_employee`);

--
-- Index pour la table `infermiere`
--
ALTER TABLE `infermiere`
  ADD PRIMARY KEY (`id_infermiere`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `employee_fk_2` (`id_employee`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`numero_operation`),
  ADD KEY `docteur_fk` (`id_docteur`),
  ADD KEY `d_medical_fk` (`id_doussier_medical`);

--
-- Index pour la table `operation_infermiere`
--
ALTER TABLE `operation_infermiere`
  ADD KEY `infermiere_fk` (`id_infermiere`),
  ADD KEY `n_operation_fk_2` (`numero_operation`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- Index pour la table `rh`
--
ALTER TABLE `rh`
  ADD PRIMARY KEY (`id_rh`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `employee_fk` (`id_employee`),
  ADD KEY `cadre_administartif_fk` (`id_cadre_administratif`);

--
-- Index pour la table `secraitere`
--
ALTER TABLE `secraitere`
  ADD PRIMARY KEY (`id_sec`),
  ADD KEY `facture_fk` (`numero_transaction`),
  ADD KEY `docteur_fk_1` (`id_docteur`),
  ADD KEY `patient_fk` (`id_patient`),
  ADD KEY `agenda_fk` (`id_agenda`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `gerant_fk_` (`id_gerant`);

--
-- Index pour la table `system_de_facturation`
--
ALTER TABLE `system_de_facturation`
  ADD PRIMARY KEY (`numero_transaction`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cadre_administratif`
--
ALTER TABLE `cadre_administratif`
  MODIFY `id_cadre_administratif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `directeur`
--
ALTER TABLE `directeur`
  MODIFY `id_directeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `docteur`
--
ALTER TABLE `docteur`
  MODIFY `id_docteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `doussier_medical`
--
ALTER TABLE `doussier_medical`
  MODIFY `id_doussier_medical` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `gerant`
--
ALTER TABLE `gerant`
  MODIFY `id_gerant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `infermiere`
--
ALTER TABLE `infermiere`
  MODIFY `id_infermiere` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `numero_operation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rh`
--
ALTER TABLE `rh`
  MODIFY `id_rh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `secraitere`
--
ALTER TABLE `secraitere`
  MODIFY `id_sec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `system_de_facturation`
--
ALTER TABLE `system_de_facturation`
  MODIFY `numero_transaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cadre_administratif`
--
ALTER TABLE `cadre_administratif`
  ADD CONSTRAINT `directeur_fk` FOREIGN KEY (`id_directeur`) REFERENCES `directeur` (`id_directeur`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fournisseur_fk` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`),
  ADD CONSTRAINT `gerant_fk_2` FOREIGN KEY (`id_gerant`) REFERENCES `gerant` (`id_gerant`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_cadre_administratif`) REFERENCES `cadre_administratif` (`id_cadre_administratif`);

--
-- Contraintes pour la table `docteur`
--
ALTER TABLE `docteur`
  ADD CONSTRAINT `employee_fk_3` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE CASCADE;

--
-- Contraintes pour la table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `categorie_fk` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD CONSTRAINT `gerant_fk` FOREIGN KEY (`id_gerant`) REFERENCES `gerant` (`id_gerant`);

--
-- Contraintes pour la table `gerant`
--
ALTER TABLE `gerant`
  ADD CONSTRAINT `employee_fk_` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`);

--
-- Contraintes pour la table `infermiere`
--
ALTER TABLE `infermiere`
  ADD CONSTRAINT `employee_fk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE CASCADE;

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `d_medical_fk` FOREIGN KEY (`id_doussier_medical`) REFERENCES `doussier_medical` (`id_doussier_medical`),
  ADD CONSTRAINT `docteur_fk` FOREIGN KEY (`id_docteur`) REFERENCES `docteur` (`id_docteur`);

--
-- Contraintes pour la table `operation_infermiere`
--
ALTER TABLE `operation_infermiere`
  ADD CONSTRAINT `infermiere_fk` FOREIGN KEY (`id_infermiere`) REFERENCES `infermiere` (`id_infermiere`),
  ADD CONSTRAINT `n_operation_fk_2` FOREIGN KEY (`numero_operation`) REFERENCES `operation` (`numero_operation`);

--
-- Contraintes pour la table `rh`
--
ALTER TABLE `rh`
  ADD CONSTRAINT `cadre_administartif_fk` FOREIGN KEY (`id_cadre_administratif`) REFERENCES `cadre_administratif` (`id_cadre_administratif`),
  ADD CONSTRAINT `employee_fk` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`);

--
-- Contraintes pour la table `secraitere`
--
ALTER TABLE `secraitere`
  ADD CONSTRAINT `agenda_fk` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id_agenda`),
  ADD CONSTRAINT `docteur_fk_1` FOREIGN KEY (`id_docteur`) REFERENCES `docteur` (`id_docteur`),
  ADD CONSTRAINT `facture_fk` FOREIGN KEY (`numero_transaction`) REFERENCES `system_de_facturation` (`numero_transaction`),
  ADD CONSTRAINT `patient_fk` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `gerant_fk_` FOREIGN KEY (`id_gerant`) REFERENCES `gerant` (`id_gerant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
