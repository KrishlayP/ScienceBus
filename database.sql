CREATE DATABASE IF NOT EXISTS `sciencebus`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `sciencebus`;

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` varchar(32) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','super_admin') NOT NULL DEFAULT 'admin',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `team_members` (
  `id` varchar(32) NOT NULL,
  `section` enum('main_team','educator_team','operational_team') NOT NULL,
  `name` varchar(190) NOT NULL,
  `role` varchar(190) NOT NULL,
  `org` varchar(190) NOT NULL DEFAULT '',
  `email` varchar(190) NOT NULL DEFAULT '',
  `contact` varchar(80) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `team_members_section_sort_idx` (`section`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `news_items` (
  `id` varchar(32) NOT NULL,
  `title` varchar(190) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL,
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_items_image_unique` (`image`),
  KEY `news_items_sort_idx` (`sort_order`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `gallery_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(190) NOT NULL,
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `gallery_categories_sort_idx` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `gallery_packages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(190) NOT NULL,
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `gallery_packages_category_sort_idx` (`category_id`, `sort_order`),
  CONSTRAINT `gallery_packages_category_fk`
    FOREIGN KEY (`category_id`) REFERENCES `gallery_categories` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `gallery_images_package_sort_idx` (`package_id`, `sort_order`),
  CONSTRAINT `gallery_images_package_fk`
    FOREIGN KEY (`package_id`) REFERENCES `gallery_packages` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` varchar(32) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `school` varchar(190) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `contact_messages_created_idx` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
