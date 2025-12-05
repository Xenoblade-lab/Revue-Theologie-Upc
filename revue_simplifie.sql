-- ============================================================
-- Base de données simplifiée pour la Revue de Théologie UPC
-- Basée sur la documentation du projet
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Base de données : `revue_theologie`
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `revue_theologie` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `revue_theologie`;

-- --------------------------------------------------------
-- Table 1: users
-- Utilisateurs du système (auteurs, reviewers, admins)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','auteur','reviewer','abonne') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'auteur',
  `affiliation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Institution/Université',
  `orcid` varchar(19) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ORCID ID si disponible',
  `statut` enum('actif','suspendu','en_attente') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_index` (`role`),
  KEY `users_orcid_index` (`orcid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table 2: volumes
-- Volumes de la revue (ex: Volume 28, Volume 29)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `volumes`;
CREATE TABLE `volumes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `annee` year NOT NULL,
  `numero` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ex: "Volume 28" ou "28e Année"',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `volumes_annee_numero_unique` (`annee`,`numero`),
  KEY `volumes_annee_index` (`annee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table 3: issues
-- Numéros spécifiques dans un volume (ex: Numéro 1, Numéro 2)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `volume_id` bigint UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Titre du numéro',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  `fichier_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'PDF complet du numéro',
  `statut` enum('brouillon','en_preparation','publie') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brouillon',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `issues_volume_id_foreign` (`volume_id`),
  CONSTRAINT `issues_volume_id_foreign` FOREIGN KEY (`volume_id`) REFERENCES `volumes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table 4: articles
-- Articles scientifiques publiés ou en cours de traitement
-- --------------------------------------------------------

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `issue_id` bigint UNSIGNED DEFAULT NULL COMMENT 'Numéro dans lequel l''article est publié',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Titre en anglais',
  `abstract` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Résumé en français',
  `abstract_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Résumé en anglais',
  `keywords` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mots-clés séparés par virgules',
  `keywords_en` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Chemin vers le PDF de l''article',
  `doi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'DOI si attribué',
  `status` enum('soumis','en_revision','accepte','rejete','publie') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'soumis',
  `pages` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ex: "15-42"',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_issue_id_foreign` (`issue_id`),
  KEY `articles_status_index` (`status`),
  KEY `articles_doi_index` (`doi`),
  CONSTRAINT `articles_issue_id_foreign` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table 5: authors_articles
-- Relation many-to-many entre auteurs et articles
-- --------------------------------------------------------

DROP TABLE IF EXISTS `authors_articles`;
CREATE TABLE `authors_articles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ordre` tinyint UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Ordre de l''auteur (1 = premier auteur)',
  `affiliation_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Affiliation spécifique pour cet article',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `authors_articles_article_user_unique` (`article_id`,`user_id`),
  KEY `authors_articles_user_id_foreign` (`user_id`),
  KEY `authors_articles_ordre_index` (`article_id`,`ordre`),
  CONSTRAINT `authors_articles_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `authors_articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table 6: reviews
-- Évaluations par les pairs (peer review)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint UNSIGNED NOT NULL,
  `reviewer_id` bigint UNSIGNED NOT NULL COMMENT 'ID du reviewer (user avec role reviewer)',
  `report_text` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Rapport de relecture',
  `recommendation` enum('accepte','revision_majeure','revision_mineure','rejete') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de soumission du rapport',
  `confidential_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Commentaires confidentiels pour l''éditeur',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_article_id_foreign` (`article_id`),
  KEY `reviews_reviewer_id_foreign` (`reviewer_id`),
  CONSTRAINT `reviews_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table 7: submissions
-- Historique des soumissions d'articles
-- --------------------------------------------------------

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE `submissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint UNSIGNED NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `version` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1.0' COMMENT 'Version du manuscrit',
  `track_changes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Suivi des modifications',
  `notes_editoriales` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Notes internes éditoriales',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submissions_article_id_foreign` (`article_id`),
  KEY `submissions_submitted_at_index` (`submitted_at`),
  CONSTRAINT `submissions_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table 8: files
-- Fichiers associés aux articles (manuscrits, figures, etc.)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint UNSIGNED NOT NULL,
  `file_type` enum('manuscrit','figure','tableau','annexe','autre') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manuscrit',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Chemin vers le fichier',
  `nom_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nom original du fichier uploadé',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taille` bigint UNSIGNED DEFAULT NULL COMMENT 'Taille en octets',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_article_id_foreign` (`article_id`),
  KEY `files_file_type_index` (`file_type`),
  CONSTRAINT `files_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table 9: logs
-- Journal d'audit pour traçabilité des actions
-- --------------------------------------------------------

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL COMMENT 'Utilisateur ayant effectué l''action',
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Type d''action (create, update, delete, login, etc.)',
  `model_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Type de modèle (Article, Issue, etc.)',
  `model_id` bigint UNSIGNED DEFAULT NULL COMMENT 'ID du modèle concerné',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Description de l''action',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `logs_user_id_foreign` (`user_id`),
  KEY `logs_action_index` (`action`),
  KEY `logs_model_index` (`model_type`,`model_id`),
  KEY `logs_created_at_index` (`created_at`),
  CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Données initiales
-- --------------------------------------------------------

-- Utilisateur admin par défaut (mot de passe: admin123)
-- À CHANGER EN PRODUCTION !
INSERT INTO `users` (`nom`, `prenom`, `email`, `password`, `role`, `affiliation`, `statut`, `created_at`, `updated_at`) VALUES
('Admin', 'Principal', 'admin@revue-theologie.upc.ac.cd', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5zFqJ5qJ5qJ5q', 'admin', 'Université Protestante au Congo', 'actif', NOW(), NOW());

-- Volume exemple
INSERT INTO `volumes` (`annee`, `numero`, `description`, `created_at`, `updated_at`) VALUES
(2025, 'Volume 28', 'Volume 2025 de la Revue de la Faculté de Théologie', NOW(), NOW());

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

