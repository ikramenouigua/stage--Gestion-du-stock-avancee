-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 juin 2021 à 00:17
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionstocke`
--

-- --------------------------------------------------------

--
-- Structure de la table `bonde_livraisons`
--

CREATE TABLE `bonde_livraisons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_bl` date NOT NULL,
  `etat_facture` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conditionnement` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qte_commandee` int(20) NOT NULL,
  `qte_livree` int(20) NOT NULL,
  `prix_total` double NOT NULL DEFAULT 0,
  `total_ttc` double NOT NULL DEFAULT 0,
  `total_tva` double NOT NULL DEFAULT 0,
  `id_client` bigint(20) UNSIGNED NOT NULL,
  `numero_commande` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mode_payement` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bonde_livraisons`
--

INSERT INTO `bonde_livraisons` (`id`, `date_bl`, `etat_facture`, `conditionnement`, `qte_commandee`, `qte_livree`, `prix_total`, `total_ttc`, `total_tva`, `id_client`, `numero_commande`, `created_at`, `updated_at`, `mode_payement`) VALUES
(1, '2021-06-06', 'non payé', 'sac', 2, 5, 900, 396, 216, 1, 2, '2021-06-06 11:52:53', '2021-06-06 11:52:53', 'Carte'),
(2, '2021-06-02', 'payé', 'sac', 5, 2, 480, 528, 288, 2, 1, '2021-06-06 11:53:30', '2021-06-06 11:53:30', 'Carte'),
(3, '2021-06-06', 'payé', 'sac', 5, 1, 240, 528, 288, 1, 1, '2021-06-06 11:56:47', '2021-06-06 11:56:47', 'Carte');

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques`
--

CREATE TABLE `caracteristiques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_produit` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `caracteristiques`
--

INSERT INTO `caracteristiques` (`id`, `reference`, `couleur`, `taille`, `ref_produit`, `created_at`, `updated_at`) VALUES
(1, 'ref1', 'blue', '35', 1, '2021-06-06 07:40:41', '2021-06-06 07:40:41'),
(2, 'ref1', 'blanc et noir', '40', 1, '2021-06-06 07:41:21', '2021-06-06 07:41:21'),
(3, 'ref2', 'rose', '32', 2, '2021-06-06 07:44:25', '2021-06-06 07:44:25'),
(4, 'ref2', 'rouge', '40', 2, '2021-06-06 07:44:45', '2021-06-06 07:44:45'),
(5, 'ref3', 'blanc', '40', 3, '2021-06-06 07:45:10', '2021-06-06 07:45:10'),
(6, 'ref3', 'gris', '33', 3, '2021-06-06 07:45:36', '2021-06-06 07:45:36'),
(7, 'ref4', 'noir', '40', 4, '2021-06-06 07:45:56', '2021-06-06 07:45:56'),
(8, 'ref5', 'move', '33', 5, '2021-06-06 07:46:11', '2021-06-06 07:46:11'),
(9, 'ref11', 'noir', '38', 6, '2021-06-06 08:36:15', '2021-06-06 08:36:15'),
(10, 'ref11', 'marron', '40', 6, '2021-06-06 08:36:32', '2021-06-06 08:36:32'),
(11, 'ref12', 'rouge', '215', 7, '2021-06-06 08:38:47', '2021-06-06 08:38:47'),
(12, 'ref12', 'noir', '3', 7, '2021-06-06 08:39:08', '2021-06-06 08:39:08'),
(13, 'ref13', 'marron', '50', 8, '2021-06-06 08:40:38', '2021-06-06 08:40:38'),
(14, 'ref14', 'noir', '40', 9, '2021-06-06 08:42:21', '2021-06-06 08:42:21'),
(15, 'ref15', 'rouge', '40', 10, '2021-06-06 08:48:57', '2021-06-06 08:48:57');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_cat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_cat` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_cat`, `description`, `image_cat`, `created_at`, `updated_at`) VALUES
(1, 'Sneakers', 'Cette catégorie créer pour rassembler l\'ensemble des baskets des femmes.', 0x64313330333935373466616661653963623936626662643562396231306162662e706e67, '2021-06-05 20:36:18', '2021-06-05 20:36:18'),
(2, 'Talons', 'Cette catégorie contient des talons pour les femmes', 0x373157464939565337584c2e5f41435f53593530302e5f53582e5f55582e5f53592e5f55595f2e6a7067, '2021-06-05 20:39:19', '2021-06-05 20:39:19'),
(3, 'Escarpin', 'Différents escapins de femmes.', 0x636861757373757265732d612d74616c6f6e732d68617574732d736f6c696465732d706f75722d66656d6d65732d612d6c612e6a7067, '2021-06-05 20:41:20', '2021-06-05 20:41:20'),
(4, 'Boots', 'Elle rassemple des boots pour les femmes', 0x74c3a96cc3a96368617267656d656e74202832292e6a7067, '2021-06-05 20:43:08', '2021-06-05 20:43:08');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel1` int(20) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tel2` int(20) NOT NULL,
  `addresse2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `tel1`, `email`, `address1`, `created_at`, `updated_at`, `tel2`, `addresse2`) VALUES
(1, 'HOSNI', 'Laila', 625148788, 'laila@gmail.com', 'CASABLANCA', '2021-06-06 10:31:30', '2021-06-06 10:31:30', 625148788, 'CASABLANCA'),
(2, 'FRHANY', 'IMRANE', 625148788, 'IMRANE@gmail.com', 'ESSAOUIRA', '2021-06-06 10:33:24', '2021-06-06 10:33:24', 625148788, 'ESSAOUIRA');

-- --------------------------------------------------------

--
-- Structure de la table `commande_clients`
--

CREATE TABLE `commande_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_commande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_cmd_client` date NOT NULL,
  `quantite_cmd` int(11) NOT NULL,
  `prix_total` double DEFAULT 0,
  `etat_commande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_client` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_ttc` double DEFAULT NULL,
  `total_tva` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande_clients`
--

INSERT INTO `commande_clients` (`id`, `reference_commande`, `date_cmd_client`, `quantite_cmd`, `prix_total`, `etat_commande`, `id_client`, `created_at`, `updated_at`, `total_ttc`, `total_tva`) VALUES
(1, 'cmd001', '2021-06-06', 5, 900, 'validée', 2, '2021-06-06 10:38:14', '2021-06-06 10:38:14', 396, 216),
(2, 'cmd002', '2021-06-06', 2, 480, 'validée', 2, '2021-06-06 10:38:34', '2021-06-06 10:38:34', 528, 288);

-- --------------------------------------------------------

--
-- Structure de la table `commande_fournisseurs`
--

CREATE TABLE `commande_fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_commande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_cmd_fournisseur` date NOT NULL,
  `quantite_cmd` int(11) NOT NULL,
  `prix_total` double NOT NULL DEFAULT 0,
  `etat_commande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_fournisseur` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande_fournisseurs`
--

INSERT INTO `commande_fournisseurs` (`id`, `reference_commande`, `date_cmd_fournisseur`, `quantite_cmd`, `prix_total`, `etat_commande`, `id_fournisseur`, `created_at`, `updated_at`) VALUES
(1, 'cmd001', '2021-06-06', 25, 4100, 'validée', 1, '2021-06-06 10:06:13', '2021-06-06 10:06:13'),
(2, 'cmd002', '2021-06-06', 15, 5250, 'validée', 1, '2021-06-06 10:06:31', '2021-06-06 10:06:31');

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_devis` date NOT NULL,
  `numero_commande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_client` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `date_devis`, `numero_commande`, `created_at`, `updated_at`, `id_client`) VALUES
(1, '2021-06-06', 'cmd001', '2021-06-06 10:38:15', '2021-06-06 10:38:15', 2),
(2, '2021-06-06', 'cmd002', '2021-06-06 10:38:35', '2021-06-06 10:38:35', 2);

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `logo`, `description`, `date_creation`, `created_at`, `updated_at`, `nom`) VALUES
(1, 'lo.jpg', 'Une société de vente des chaussures de femmes', '2021-06-06', '2021-06-06 10:44:21', '2021-06-06 10:44:21', 'NaiStore');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_fournisseur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom_fournisseur`, `email`, `tel`, `created_at`, `updated_at`) VALUES
(1, 'EL FARHANY Aziza', 'aziza@gmail.com', '0625148788', '2021-06-06 09:55:13', '2021-06-06 09:55:13'),
(2, 'EL FARSI ISMAIL', 'elfarsi@gmail.com', '0625148799', '2021-06-06 09:55:59', '2021-06-06 09:55:59');

-- --------------------------------------------------------

--
-- Structure de la table `lignecommandes_F`
--

CREATE TABLE `lignecommandes_F` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_commande_fourni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite_cmd` bigint(20) UNSIGNED NOT NULL,
  `prix_total` double NOT NULL DEFAULT 0,
  `id_produit` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lignecommandes_F`
--

INSERT INTO `lignecommandes_F` (`id`, `id_commande_fourni`, `quantite_cmd`, `prix_total`, `id_produit`, `created_at`, `updated_at`) VALUES
(1, 'cmd001', 5, 9, 6, '2021-06-06 10:06:13', '2021-06-06 10:06:13'),
(2, 'cmd001', 20, 9, 9, '2021-06-06 10:06:13', '2021-06-06 10:06:13'),
(3, 'cmd002', 15, 8, 8, '2021-06-06 10:06:31', '2021-06-06 10:06:31');

-- --------------------------------------------------------

--
-- Structure de la table `lignecommandesclients`
--

CREATE TABLE `lignecommandesclients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_commande_client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite_cmd` bigint(20) UNSIGNED NOT NULL,
  `prix_total` double NOT NULL DEFAULT 0,
  `id_produit` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_tva` double DEFAULT NULL,
  `total_ttc` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lignecommandesclients`
--

INSERT INTO `lignecommandesclients` (`id`, `id_commande_client`, `quantite_cmd`, `prix_total`, `id_produit`, `created_at`, `updated_at`, `total_tva`, `total_ttc`) VALUES
(1, 'cmd001', 5, 900, 6, '2021-06-06 10:38:14', '2021-06-06 10:38:14', 216, 396),
(2, 'cmd002', 2, 480, 10, '2021-06-06 10:38:35', '2021-06-06 10:38:35', 288, 528);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_bonnde_livraisons`
--

CREATE TABLE `ligne_bonnde_livraisons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produit` bigint(20) NOT NULL,
  `qte` double NOT NULL,
  `prix_total` double NOT NULL,
  `total_ttc` double NOT NULL,
  `total_tva` double NOT NULL,
  `numero_livraison` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ligne_bonnde_livraisons`
--

INSERT INTO `ligne_bonnde_livraisons` (`id`, `id_produit`, `qte`, `prix_total`, `total_ttc`, `total_tva`, `numero_livraison`, `created_at`, `updated_at`) VALUES
(1, 6, 5, 900, 396, 216, 1, '2021-06-06 11:52:53', '2021-06-06 11:52:53'),
(2, 10, 2, 480, 528, 288, 2, '2021-06-06 11:53:31', '2021-06-06 11:53:31'),
(3, 10, 1, 240, 528, 288, 3, '2021-06-06 11:56:47', '2021-06-06 11:56:47');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_12_135325_add_type_to_users', 1),
(5, '2021_05_17_142213_create_tables_categories_e_tproducts', 1),
(6, '2021_05_18_110404_create_tables_fournisseurs_commandes', 1),
(7, '2021_05_21_112258_create_table_setting', 1),
(8, '2021_05_25_224114_create_entreprises_table', 1),
(9, '2021_05_26_093826_create_clients_table', 1),
(10, '2021_05_27_090155_create_commandesclients_table', 1),
(11, '2021_05_28_090354_create_devies_table', 2),
(12, '2021_05_29_214258_create_bondelivraisons_table', 3),
(13, '2021_06_01_093247_stockes', 4);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle_produit` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unite_produit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(100) NOT NULL,
  `stocke_min` int(11) NOT NULL,
  `prix_achat` decimal(8,2) NOT NULL DEFAULT 0.00,
  `prix_vente` decimal(8,2) NOT NULL DEFAULT 0.00,
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `image_produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stocke` int(20) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `ref_produit`, `libelle_produit`, `unite_produit`, `quantite`, `stocke_min`, `prix_achat`, `prix_vente`, `id_category`, `image_produit`, `created_at`, `updated_at`, `stocke`, `description`) VALUES
(1, 'ref1', 'chaussures-cuir-mode-basket-femme', 'KG', 1, 10, '100.00', '150.00', 1, 'chaussures-cuir-mode-chaussure-femme-basket-femme.jpg', '2021-06-06 07:30:16', '2021-06-06 07:30:16', 1, 'chaussures cuir mode chaussure femme basket femme'),
(2, 'ref2', 'basket-rose', 'KG', 1, 10, '80.00', '100.00', 1, 'images.jpg', '2021-06-06 07:33:20', '2021-06-06 07:33:20', 1, 'des baskests rose pour tous les femmes'),
(3, 'ref3', 'basket-rose-mode-cuire', 'KG', 1, 2, '100.00', '110.00', 1, '23424925.webp', '2021-06-06 07:35:09', '2021-06-06 07:35:09', 1, 'des baskets roses et gris pour les femmes avec tous les tailles'),
(4, 'ref4', 'Puimentiua-Chaussures-Femme', 'KG', 1, 8, '150.00', '180.00', 1, 'Puimentiua-Chaussures-Femme-Sneakers-Plateforme-Chaussures-Fermeture-clair-Baskets-Femmes-Chaussures-D-contract-Lacets-Tenis-Feminino.jpg_Q90.jpg_.webp', '2021-06-06 07:36:49', '2021-06-06 07:36:49', 1, 'Puimentiua Chaussures Femme Sneakers'),
(5, 'ref5', 'sneaker-gris', 'KG', 1, 10, '250.00', '280.00', 1, 'téléchargement (1).jpg', '2021-06-06 07:38:39', '2021-06-06 07:38:39', 1, 'des baskets gris pour les femmes'),
(6, 'ref11', 'talon-with-fleur', 'KG', 6, 10, '150.00', '180.00', 2, 'Chaussures-femmes-6.jpg', '2021-06-06 08:35:42', '2021-06-06 08:35:42', 1, 'amaizing talon pour les femmes'),
(7, 'ref12', 'talons-hauts', 'KG', 1, 2, '200.00', '250.00', 2, 'Chaussures-talons-hauts-en-dentelle-pour-femmes-escarpins-rouges-taille-34-43-215-3.webp', '2021-06-06 08:38:24', '2021-06-06 08:38:24', 1, 'Chaussures-talons-hauts-en-dentelle-pour-femmes-escarpins-rouges-taille-34-43-215-3'),
(8, 'ref13', 'talon-compense', 'KG', 1, 10, '300.00', '350.00', 1, 'femmes-talon-compense-talon-carre-talon-carre-sand.jpg', '2021-06-06 08:40:14', '2021-06-06 08:40:14', 1, 'femmes-talon-compense-talon-carre-talon-carre-sand'),
(9, 'ref14', 'sandales-daim-hauts', 'KG', 41, 8, '100.00', '160.00', 2, 'femmes-sandales-chaussures-femmes-daim-hauts-talon.jpg', '2021-06-06 08:41:53', '2021-06-06 08:41:53', 1, 'femmes-sandales-chaussures-femmes-daim-hauts-talon'),
(10, 'ref15', 'talon-haut', 'KG', -2, 10, '200.00', '240.00', 2, 'ch2.jpg', '2021-06-06 08:48:25', '2021-06-06 08:48:25', 1, 'des haut talon 2m pour les femmes');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order2` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`prefix`, `order`, `created_at`, `updated_at`, `order2`) VALUES
('cmd00', 3, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `stockes`
--

CREATE TABLE `stockes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_entree` date DEFAULT NULL,
  `Référence_produit` bigint(20) UNSIGNED DEFAULT NULL,
  `stocke_initial` int(11) DEFAULT NULL,
  `entree` int(11) DEFAULT NULL,
  `sortie` int(11) DEFAULT NULL,
  `new_stocke` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `ref_cmd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_produit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stockes`
--

INSERT INTO `stockes` (`id`, `date_entree`, `Référence_produit`, `stocke_initial`, `entree`, `sortie`, `new_stocke`, `created_at`, `updated_at`, `date_sortie`, `ref_cmd`, `ref_produit`) VALUES
(1, '2021-06-05', 9, 1, 1, 1, 0, '2021-06-06 11:55:24', '2021-06-06 11:55:24', '2021-06-06', 'cmd001', 'ref14'),
(2, '2021-06-02', 8, 1, 21, 10, 11, '2021-06-06 11:55:40', '2021-06-06 11:55:40', '2021-06-05', 'cmd002', 'ref3');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bonde_livraisons`
--
ALTER TABLE `bonde_livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bondelivraisons_id_client_index` (`id_client`),
  ADD KEY `bondelivraisons_numero_commande_index` (`numero_commande`);

--
-- Index pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caracteristiques_ref_produit_foreign` (`ref_produit`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_nom_cat_unique` (`nom_cat`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande_clients`
--
ALTER TABLE `commande_clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commandesclients_reference_commande_unique` (`reference_commande`),
  ADD KEY `commandesclients_id_client_index` (`id_client`);

--
-- Index pour la table `commande_fournisseurs`
--
ALTER TABLE `commande_fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commande_fournisseurs_reference_commande_unique` (`reference_commande`),
  ADD KEY `commande_fournisseurs_id_fournisseur_index` (`id_fournisseur`);

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devies_numero_commande_index` (`numero_commande`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fournisseurs_email_unique` (`email`);

--
-- Index pour la table `lignecommandes_F`
--
ALTER TABLE `lignecommandes_F`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lignecommandes_id_commande_fourni_index` (`id_commande_fourni`),
  ADD KEY `lignecommandes_id_produit_index` (`id_produit`);

--
-- Index pour la table `lignecommandesclients`
--
ALTER TABLE `lignecommandesclients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lignecommandesclients_id_commande_client_index` (`id_commande_client`),
  ADD KEY `lignecommandesclients_id_produit_index` (`id_produit`);

--
-- Index pour la table `ligne_bonnde_livraisons`
--
ALTER TABLE `ligne_bonnde_livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lignebondelivraisons_numero_livraison_index` (`numero_livraison`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_category_foreign` (`id_category`),
  ADD KEY `products_libelle_produit_index` (`libelle_produit`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `settings_prefix_unique` (`prefix`);

--
-- Index pour la table `stockes`
--
ALTER TABLE `stockes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stockes_référence_produit_index` (`Référence_produit`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bonde_livraisons`
--
ALTER TABLE `bonde_livraisons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande_clients`
--
ALTER TABLE `commande_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande_fournisseurs`
--
ALTER TABLE `commande_fournisseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `lignecommandes_F`
--
ALTER TABLE `lignecommandes_F`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `lignecommandesclients`
--
ALTER TABLE `lignecommandesclients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ligne_bonnde_livraisons`
--
ALTER TABLE `ligne_bonnde_livraisons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `stockes`
--
ALTER TABLE `stockes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bonde_livraisons`
--
ALTER TABLE `bonde_livraisons`
  ADD CONSTRAINT `bondelivraisons_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bondelivraisons_numero_commande_foreign` FOREIGN KEY (`numero_commande`) REFERENCES `commande_clients` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  ADD CONSTRAINT `caracteristiques_ref_produit_foreign` FOREIGN KEY (`ref_produit`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commande_clients`
--
ALTER TABLE `commande_clients`
  ADD CONSTRAINT `commandesclients_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commande_fournisseurs`
--
ALTER TABLE `commande_fournisseurs`
  ADD CONSTRAINT `commande_fournisseurs_id_fournisseur_foreign` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `devies_numero_commande_foreign` FOREIGN KEY (`numero_commande`) REFERENCES `commande_clients` (`reference_commande`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lignecommandes_F`
--
ALTER TABLE `lignecommandes_F`
  ADD CONSTRAINT `lignecommandes_id_commande_fourni_foreign` FOREIGN KEY (`id_commande_fourni`) REFERENCES `commande_fournisseurs` (`reference_commande`) ON DELETE CASCADE,
  ADD CONSTRAINT `lignecommandes_id_produit_foreign` FOREIGN KEY (`id_produit`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lignecommandesclients`
--
ALTER TABLE `lignecommandesclients`
  ADD CONSTRAINT `lignecommandesclients_id_commande_client_foreign` FOREIGN KEY (`id_commande_client`) REFERENCES `commande_clients` (`reference_commande`) ON DELETE CASCADE,
  ADD CONSTRAINT `lignecommandesclients_id_produit_foreign` FOREIGN KEY (`id_produit`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ligne_bonnde_livraisons`
--
ALTER TABLE `ligne_bonnde_livraisons`
  ADD CONSTRAINT `lignebondelivraisons_numero_livraison_foreign` FOREIGN KEY (`numero_livraison`) REFERENCES `bonde_livraisons` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stockes`
--
ALTER TABLE `stockes`
  ADD CONSTRAINT `stockes_référence_produit_foreign` FOREIGN KEY (`Référence_produit`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
