-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2018 at 05:42 PM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.6.32-1+ubuntu14.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sugar71020ent`
--

-- --------------------------------------------------------

--
-- Table structure for table `tm_telemarketers`
--

CREATE TABLE IF NOT EXISTS `tm_telemarketers` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `noagent` varchar(255) DEFAULT '',
  `nocallgen` varchar(255) DEFAULT '',
  `notp` varchar(255) DEFAULT '',
  `nom` varchar(255) DEFAULT '',
  `prenom` varchar(255) DEFAULT '',
  `team` varchar(255) DEFAULT '',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tm_telemarketers_date_modfied` (`date_modified`),
  KEY `idx_tm_telemarketers_id_del` (`id`,`deleted`),
  KEY `idx_tm_telemarketers_date_entered` (`date_entered`),
  KEY `idx_tm_telemarketers_name_del` (`name`,`deleted`),
  KEY `idx_tm_telemarketers_tmst_id` (`team_set_id`),
  KEY `idx_tm_telemarketers_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_telemarketers`
--

REPLACE INTO `tm_telemarketers` (`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `description`, `deleted`, `noagent`, `nocallgen`, `notp`, `nom`, `prenom`, `team`, `team_id`, `team_set_id`, `acl_team_set_id`, `assigned_user_id`, `password`) VALUES
('0de66228-0b14-11e8-8d00-2c56dc94b8c8', 'Nicolas Bélanger (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '212', '800111', 'K1', 'Bélanger (N)', 'Nicolas', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0def9c58-0b14-11e8-a018-2c56dc94b8c8', 'Internet  Internet', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '337', 'A3', NULL, 'Internet', 'Internet', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0df36f54-0b14-11e8-820f-2c56dc94b8c8', 'Carole Kingsley (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '803', '800106', NULL, 'Kingsley (N)', 'Carole', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0df732b0-0b14-11e8-95e4-2c56dc94b8c8', 'Marlène Chouloute (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '804', '800042', NULL, 'Chouloute (N)', 'Marlène', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0dfa1a3e-0b14-11e8-b4c2-2c56dc94b8c8', 'Anne-Marie Arsenault (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '805', '800027', NULL, 'Arsenault (N)', 'Anne-Marie', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0dfcffd8-0b14-11e8-8e05-2c56dc94b8c8', 'Diane Provost (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '806', '800038', NULL, 'Provost (N)', 'Diane', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0dff08aa-0b14-11e8-a4c8-2c56dc94b8c8', 'Carmella Vitelli (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '807', '800048', NULL, 'Vitelli (N)', 'Carmella', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e014dfe-0b14-11e8-b8e9-2c56dc94b8c8', 'Diane Drolet (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '808', '800049', NULL, 'Drolet (N)', 'Diane', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e0367ec-0b14-11e8-93ef-2c56dc94b8c8', 'Michel Carroll (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '813', '800013', NULL, 'Carroll (N)', 'Michel', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e088a88-0b14-11e8-8c77-2c56dc94b8c8', 'Khaled Djebbab (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '814', '800183', NULL, 'Djebbab (N)', 'Khaled', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e0a7fa0-0b14-11e8-8372-2c56dc94b8c8', 'Michel Labbe (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '815', '800190', NULL, 'Labbe (N)', 'Michel', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e0c9484-0b14-11e8-9b2d-2c56dc94b8c8', 'Khalil Karam (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '816', '800212', NULL, 'Karam (N)', 'Khalil', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e0fd6c6-0b14-11e8-9968-2c56dc94b8c8', 'Abdelhamid Hacib (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '824', '800373', NULL, 'Hacib (N)', 'Abdelhamid', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e12db3c-0b14-11e8-b9bd-2c56dc94b8c8', 'Tekfa Maidi (N)', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '826', '800380', NULL, 'Maidi (N)', 'Tekfa', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e15ddaa-0b14-11e8-8186-2c56dc94b8c8', 'Impartiteur Gexel', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '850', 'ZZZZZ', NULL, 'Gexel', 'Impartiteur', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e18dd52-0b14-11e8-8e30-2c56dc94b8c8', 'Jacques Tchabarian', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '852', '800441', NULL, 'Tchabarian', 'Jacques', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e1bae88-0b14-11e8-bff4-2c56dc94b8c8', 'Lucie Cloutier', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '863', NULL, '800011', 'Cloutier', 'Lucie', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e1df5e4-0b14-11e8-b88a-2c56dc94b8c8', 'Richard Verdieu', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '865', '800465', NULL, 'Verdieu', 'Richard', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e1ffbe6-0b14-11e8-b183-2c56dc94b8c8', 'Laila Fechtali', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '866', '800455', NULL, 'Fechtali', 'Laila', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e2246ee-0b14-11e8-b0ca-2c56dc94b8c8', 'Noura Ait_Braham', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '869', '800457', NULL, 'Ait_Braham', 'Noura', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e243288-0b14-11e8-b91e-2c56dc94b8c8', 'Yessica_Patricia Ungo', '2018-02-06 08:02:19', '2018-02-06 08:02:34', '1', '1', NULL, 0, '873', '800462', NULL, 'Ungo', 'Yessica_Patricia', '100', '1', '1', NULL, '1', NULL),
('0e26334e-0b14-11e8-a1ff-2c56dc94b8c8', 'Samir Larbi', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '876', '800464', NULL, 'Larbi', 'Samir', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e283cc0-0b14-11e8-bcb7-2c56dc94b8c8', 'Wahiba Filali', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '883', '800475', NULL, 'Filali', 'Wahiba', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL),
('0e2afffa-0b14-11e8-901d-2c56dc94b8c8', 'Dior Kane', '2018-02-06 08:02:19', '2018-02-06 08:02:19', '1', '1', NULL, 0, '888', '800486', NULL, 'Kane', 'Dior', '100', '1', '1', '8e7f0fda-04dd-11e8-9ebd-2c56dc94b8c8', '1', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
