-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 06:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `date_rendez_vous` date DEFAULT NULL,
  `evenement` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cadre_administratif`
--

CREATE TABLE `cadre_administratif` (
  `id_cadre_administratif` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `id_directeur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cadre_administratif`
--

INSERT INTO `cadre_administratif` (`id_cadre_administratif`, `nom_complet`, `status`, `id_directeur`) VALUES
(1, 'Laarbi Errahmani', 'Responsable du Docteurs', 1),
(2, 'Said Yamal', 'Responsable du Securité', NULL),
(3, 'Aicha Raghib', 'RH', NULL),
(5, 'Ahmed El Amrani', 'Responsable du Stock ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_cmd` int(11) NOT NULL,
  `date_commande` date DEFAULT NULL,
  `etat` text DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  `champ` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `id_gerant` int(11) DEFAULT NULL,
  `id_fournisseur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

CREATE TABLE `demande` (
  `id_demande` int(11) NOT NULL,
  `contenu_demande` text DEFAULT NULL,
  `type_demande` text DEFAULT NULL,
  `id_cadre_administratif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directeur`
--

CREATE TABLE `directeur` (
  `id_directeur` int(11) NOT NULL,
  `nom_complet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `directeur`
--

INSERT INTO `directeur` (`id_directeur`, `nom_complet`) VALUES
(1, 'Hamid Razouni');

-- --------------------------------------------------------

--
-- Table structure for table `docteur`
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
-- Table structure for table `doussier_medical`
--

CREATE TABLE `doussier_medical` (
  `id_doussier_medical` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
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
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id_fournisseur` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `id_gerant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gerant`
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

-- --------------------------------------------------------

--
-- Table structure for table `infermiere`
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
-- Table structure for table `operation`
--

CREATE TABLE `operation` (
  `numero_operation` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `id_docteur` int(11) DEFAULT NULL,
  `id_doussier_medical` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operation_infermiere`
--

CREATE TABLE `operation_infermiere` (
  `id_infermiere` int(11) DEFAULT NULL,
  `numero_operation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
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
-- Table structure for table `rh`
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
-- Table structure for table `secraitere`
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
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `id_gerant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_de_facturation`
--

CREATE TABLE `system_de_facturation` (
  `numero_transaction` int(11) NOT NULL,
  `montant_payer` decimal(10,2) DEFAULT NULL,
  `status_paiement` tinyint(1) DEFAULT NULL,
  `mode_paiement` text DEFAULT NULL,
  `reference_facture` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `cadre_administratif`
--
ALTER TABLE `cadre_administratif`
  ADD PRIMARY KEY (`id_cadre_administratif`),
  ADD KEY `directeur_fk` (`id_directeur`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_cmd`),
  ADD KEY `gerant_fk_2` (`id_gerant`),
  ADD KEY `fournisseur_fk` (`id_fournisseur`);

--
-- Indexes for table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `id_cadre_administratif` (`id_cadre_administratif`);

--
-- Indexes for table `directeur`
--
ALTER TABLE `directeur`
  ADD PRIMARY KEY (`id_directeur`);

--
-- Indexes for table `docteur`
--
ALTER TABLE `docteur`
  ADD PRIMARY KEY (`id_docteur`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `employee_fk_3` (`id_employee`);

--
-- Indexes for table `doussier_medical`
--
ALTER TABLE `doussier_medical`
  ADD PRIMARY KEY (`id_doussier_medical`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `categorie_fk` (`id_categorie`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id_fournisseur`),
  ADD KEY `gerant_fk` (`id_gerant`);

--
-- Indexes for table `gerant`
--
ALTER TABLE `gerant`
  ADD PRIMARY KEY (`id_gerant`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `employee_fk_` (`id_employee`);

--
-- Indexes for table `infermiere`
--
ALTER TABLE `infermiere`
  ADD PRIMARY KEY (`id_infermiere`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `employee_fk_2` (`id_employee`);

--
-- Indexes for table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`numero_operation`),
  ADD KEY `docteur_fk` (`id_docteur`),
  ADD KEY `d_medical_fk` (`id_doussier_medical`);

--
-- Indexes for table `operation_infermiere`
--
ALTER TABLE `operation_infermiere`
  ADD KEY `infermiere_fk` (`id_infermiere`),
  ADD KEY `n_operation_fk_2` (`numero_operation`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- Indexes for table `rh`
--
ALTER TABLE `rh`
  ADD PRIMARY KEY (`id_rh`),
  ADD UNIQUE KEY `cni` (`cni`),
  ADD KEY `employee_fk` (`id_employee`),
  ADD KEY `cadre_administartif_fk` (`id_cadre_administratif`);

--
-- Indexes for table `secraitere`
--
ALTER TABLE `secraitere`
  ADD PRIMARY KEY (`id_sec`),
  ADD KEY `facture_fk` (`numero_transaction`),
  ADD KEY `docteur_fk_1` (`id_docteur`),
  ADD KEY `patient_fk` (`id_patient`),
  ADD KEY `agenda_fk` (`id_agenda`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `gerant_fk_` (`id_gerant`);

--
-- Indexes for table `system_de_facturation`
--
ALTER TABLE `system_de_facturation`
  ADD PRIMARY KEY (`numero_transaction`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cadre_administratif`
--
ALTER TABLE `cadre_administratif`
  MODIFY `id_cadre_administratif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directeur`
--
ALTER TABLE `directeur`
  MODIFY `id_directeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `docteur`
--
ALTER TABLE `docteur`
  MODIFY `id_docteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doussier_medical`
--
ALTER TABLE `doussier_medical`
  MODIFY `id_doussier_medical` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gerant`
--
ALTER TABLE `gerant`
  MODIFY `id_gerant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infermiere`
--
ALTER TABLE `infermiere`
  MODIFY `id_infermiere` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operation`
--
ALTER TABLE `operation`
  MODIFY `numero_operation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rh`
--
ALTER TABLE `rh`
  MODIFY `id_rh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secraitere`
--
ALTER TABLE `secraitere`
  MODIFY `id_sec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_de_facturation`
--
ALTER TABLE `system_de_facturation`
  MODIFY `numero_transaction` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `employee_fk_3` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `categorie_fk` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`);

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
  ADD CONSTRAINT `employee_fk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`);

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







