-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 21, 2024 at 12:48 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitale`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int NOT NULL AUTO_INCREMENT,
  `date_rendez_vous` date DEFAULT NULL,
  `evenement` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_agenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cadre_administratif`
--

DROP TABLE IF EXISTS `cadre_administratif`;
CREATE TABLE IF NOT EXISTS `cadre_administratif` (
  `id_cadre_administratif` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  `status` text COLLATE utf8mb4_general_ci,
  `id_directeur` int DEFAULT NULL,
  PRIMARY KEY (`id_cadre_administratif`),
  KEY `directeur_fk` (`id_directeur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cadre_administratif`
--

INSERT INTO `cadre_administratif` (`id_cadre_administratif`, `nom_complet`, `status`, `id_directeur`) VALUES
(1, 'Laarbi Errahmani', 'Responsable du Docteurs', 1),
(2, 'Said Yamal', 'Responsable du Securité', NULL),
(3, 'Aicha Raghib', 'RH', NULL),
(5, 'Ahmed El Amrani', 'Responsable du Stock 2', NULL),
(8, 'Mouad El Hansali', 'Responsable IT', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
(1, 'docteur');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_cmd` int NOT NULL AUTO_INCREMENT,
  `date_commande` date DEFAULT NULL,
  `etat` text COLLATE utf8mb4_general_ci,
  `date_expiration` date DEFAULT NULL,
  `champ` text COLLATE utf8mb4_general_ci,
  `type` text COLLATE utf8mb4_general_ci,
  `id_gerant` int DEFAULT NULL,
  `id_fournisseur` int DEFAULT NULL,
  PRIMARY KEY (`id_cmd`),
  KEY `gerant_fk_2` (`id_gerant`),
  KEY `fournisseur_fk` (`id_fournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` int NOT NULL AUTO_INCREMENT,
  `contenu_demande` text COLLATE utf8mb4_general_ci,
  `type_demande` text COLLATE utf8mb4_general_ci,
  `id_cadre_administratif` int DEFAULT NULL,
  `Status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'En Attente',
  PRIMARY KEY (`id_demande`),
  KEY `id_cadre_administratif` (`id_cadre_administratif`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `demande`
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
-- Table structure for table `directeur`
--

DROP TABLE IF EXISTS `directeur`;
CREATE TABLE IF NOT EXISTS `directeur` (
  `id_directeur` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_directeur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `directeur`
--

INSERT INTO `directeur` (`id_directeur`, `nom_complet`) VALUES
(1, 'Hamid Razouni');

-- --------------------------------------------------------

--
-- Table structure for table `docteur`
--

DROP TABLE IF EXISTS `docteur`;
CREATE TABLE IF NOT EXISTS `docteur` (
  `id_docteur` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci,
  `num_tel` bigint DEFAULT NULL,
  `id_employee` int DEFAULT NULL,
  PRIMARY KEY (`id_docteur`),
  UNIQUE KEY `cni` (`cni`),
  KEY `employee_fk_3` (`id_employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doussier_medical`
--

DROP TABLE IF EXISTS `doussier_medical`;
CREATE TABLE IF NOT EXISTS `doussier_medical` (
  `id_doussier_medical` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_doussier_medical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id_employee` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci,
  `num_tel` bigint DEFAULT NULL,
  `id_categorie` int DEFAULT NULL,
  PRIMARY KEY (`id_employee`),
  UNIQUE KEY `cni` (`cni`),
  KEY `categorie_fk` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id_fournisseur` int NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8mb4_general_ci,
  `salaire` decimal(10,2) DEFAULT NULL,
  `id_gerant` int DEFAULT NULL,
  PRIMARY KEY (`id_fournisseur`),
  KEY `gerant_fk` (`id_gerant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gerant`
--

DROP TABLE IF EXISTS `gerant`;
CREATE TABLE IF NOT EXISTS `gerant` (
  `id_gerant` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci,
  `num_tel` bigint DEFAULT NULL,
  `id_employee` int DEFAULT NULL,
  PRIMARY KEY (`id_gerant`),
  UNIQUE KEY `cni` (`cni`),
  KEY `employee_fk_` (`id_employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infermiere`
--

DROP TABLE IF EXISTS `infermiere`;
CREATE TABLE IF NOT EXISTS `infermiere` (
  `id_infermiere` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci,
  `num_tel` bigint DEFAULT NULL,
  `id_employee` int DEFAULT NULL,
  PRIMARY KEY (`id_infermiere`),
  UNIQUE KEY `cni` (`cni`),
  KEY `employee_fk_2` (`id_employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

DROP TABLE IF EXISTS `operation`;
CREATE TABLE IF NOT EXISTS `operation` (
  `numero_operation` int NOT NULL AUTO_INCREMENT,
  `type` text COLLATE utf8mb4_general_ci,
  `id_docteur` int DEFAULT NULL,
  `id_doussier_medical` int DEFAULT NULL,
  PRIMARY KEY (`numero_operation`),
  KEY `docteur_fk` (`id_docteur`),
  KEY `d_medical_fk` (`id_doussier_medical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operation_infermiere`
--

DROP TABLE IF EXISTS `operation_infermiere`;
CREATE TABLE IF NOT EXISTS `operation_infermiere` (
  `id_infermiere` int DEFAULT NULL,
  `numero_operation` int DEFAULT NULL,
  KEY `infermiere_fk` (`id_infermiere`),
  KEY `n_operation_fk_2` (`numero_operation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id_patient` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  `genre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci,
  `num_tel` bigint DEFAULT NULL,
  `adresse` text COLLATE utf8mb4_general_ci,
  `type_de_sang` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rh`
--

DROP TABLE IF EXISTS `rh`;
CREATE TABLE IF NOT EXISTS `rh` (
  `id_rh` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  `salaire` decimal(10,2) DEFAULT NULL,
  `cni` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci,
  `num_tel` bigint DEFAULT NULL,
  `id_employee` int DEFAULT NULL,
  `id_cadre_administratif` int DEFAULT NULL,
  PRIMARY KEY (`id_rh`),
  UNIQUE KEY `cni` (`cni`),
  KEY `employee_fk` (`id_employee`),
  KEY `cadre_administartif_fk` (`id_cadre_administratif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secraitere`
--

DROP TABLE IF EXISTS `secraitere`;
CREATE TABLE IF NOT EXISTS `secraitere` (
  `id_sec` int NOT NULL AUTO_INCREMENT,
  `nom_complet` text COLLATE utf8mb4_general_ci,
  `genre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci,
  `numero_transaction` int DEFAULT NULL,
  `id_agenda` int DEFAULT NULL,
  `id_docteur` int DEFAULT NULL,
  `id_patient` int DEFAULT NULL,
  PRIMARY KEY (`id_sec`),
  KEY `facture_fk` (`numero_transaction`),
  KEY `docteur_fk_1` (`id_docteur`),
  KEY `patient_fk` (`id_patient`),
  KEY `agenda_fk` (`id_agenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int NOT NULL AUTO_INCREMENT,
  `quantite` int DEFAULT NULL,
  `id_gerant` int DEFAULT NULL,
  PRIMARY KEY (`id_stock`),
  KEY `gerant_fk_` (`id_gerant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_de_facturation`
--

DROP TABLE IF EXISTS `system_de_facturation`;
CREATE TABLE IF NOT EXISTS `system_de_facturation` (
  `numero_transaction` int NOT NULL AUTO_INCREMENT,
  `montant_payer` decimal(10,2) DEFAULT NULL,
  `status_paiement` tinyint(1) DEFAULT NULL,
  `mode_paiement` text COLLATE utf8mb4_general_ci,
  `reference_facture` bigint DEFAULT NULL,
  PRIMARY KEY (`numero_transaction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cadre_administratif`
--
ALTER TABLE `cadre_administratif`
  ADD CONSTRAINT `directeur_fk` FOREIGN KEY (`id_directeur`) REFERENCES `directeur` (`id_directeur`);

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fournisseur_fk` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`),
  ADD CONSTRAINT `gerant_fk_2` FOREIGN KEY (`id_gerant`) REFERENCES `gerant` (`id_gerant`);

--
-- Constraints for table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_cadre_administratif`) REFERENCES `cadre_administratif` (`id_cadre_administratif`);

--
-- Constraints for table `docteur`
--
ALTER TABLE `docteur`
  ADD CONSTRAINT `employee_fk_3` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `categorie_fk` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE;

--
-- Constraints for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD CONSTRAINT `gerant_fk` FOREIGN KEY (`id_gerant`) REFERENCES `gerant` (`id_gerant`);

--
-- Constraints for table `gerant`
--
ALTER TABLE `gerant`
  ADD CONSTRAINT `employee_fk_` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`);

--
-- Constraints for table `infermiere`
--
ALTER TABLE `infermiere`
  ADD CONSTRAINT `employee_fk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE CASCADE;

--
-- Constraints for table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `d_medical_fk` FOREIGN KEY (`id_doussier_medical`) REFERENCES `doussier_medical` (`id_doussier_medical`),
  ADD CONSTRAINT `docteur_fk` FOREIGN KEY (`id_docteur`) REFERENCES `docteur` (`id_docteur`);

--
-- Constraints for table `operation_infermiere`
--
ALTER TABLE `operation_infermiere`
  ADD CONSTRAINT `infermiere_fk` FOREIGN KEY (`id_infermiere`) REFERENCES `infermiere` (`id_infermiere`),
  ADD CONSTRAINT `n_operation_fk_2` FOREIGN KEY (`numero_operation`) REFERENCES `operation` (`numero_operation`);

--
-- Constraints for table `rh`
--
ALTER TABLE `rh`
  ADD CONSTRAINT `cadre_administartif_fk` FOREIGN KEY (`id_cadre_administratif`) REFERENCES `cadre_administratif` (`id_cadre_administratif`),
  ADD CONSTRAINT `employee_fk` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`);

--
-- Constraints for table `secraitere`
--
ALTER TABLE `secraitere`
  ADD CONSTRAINT `agenda_fk` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id_agenda`),
  ADD CONSTRAINT `docteur_fk_1` FOREIGN KEY (`id_docteur`) REFERENCES `docteur` (`id_docteur`),
  ADD CONSTRAINT `facture_fk` FOREIGN KEY (`numero_transaction`) REFERENCES `system_de_facturation` (`numero_transaction`),
  ADD CONSTRAINT `patient_fk` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `gerant_fk_` FOREIGN KEY (`id_gerant`) REFERENCES `gerant` (`id_gerant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
