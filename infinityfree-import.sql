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

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
('dda692418f704e04', 'Super Admin', 'superadmin@sciencebus.com', '$2y$10$DN0VIhGVVzjUDXJgR5HnbuDaWBdsr3Xyd5EVGp8GiGz0QEW9QU4S2', 'super_admin', '2026-05-16 06:54:49'),
('c827040ffb12e20d', 'Admin', 'admin@sciencebus.com', '$2y$10$wLgidnICXdN7L8Et/5XTLOay.3V6HgrIJlNFkFPDLTOHWy/3tCU4W', 'admin', '2026-05-16 06:54:50')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `password` = VALUES(`password`), `role` = VALUES(`role`);

INSERT INTO `team_members` (`id`, `section`, `name`, `role`, `org`, `email`, `contact`, `image`, `sort_order`) VALUES
('58a9fbdd616825c6', 'main_team', 'Prof. Deepu Philip', 'Professor, DOMS Department', 'IIT Kanpur', 'dphilip@iitk.ac.in', '', 'assets/image/Team/ProfDeepuPhilip.png', 0),
('e125ae233b6d8fdf', 'main_team', 'Dr. Sumit Kumar Srivastava', 'Scientific Officer', 'C.S.T Department, UP', 'sumit.astro.physics@gmail.com', '', 'assets/image/Team/sumitkumarsr.jpeg', 1),
('6bb29e87012473ba', 'main_team', 'Rachna Agrawal', 'Project Executive Officer', 'IIT Kanpur', 'rachna@iitk.ac.in', '', 'assets/image/Team/rachna.jpeg', 2),
('1f88cdc6a893347f', 'educator_team', 'Mr. Rinku', 'Educator', '', 'rinkugangwar9991@gmail.com', '9451237404', 'assets/image/Team/rinku.jpeg', 0),
('6de7d9fd5629aac8', 'educator_team', 'Mr. Brikesh Kumar', 'Educator', '', 'brikesh.kumar.0108@gmail.com', '7860134226', 'assets/image/Team/brikesh.jpeg', 1),
('213c01a325fe93d6', 'operational_team', 'Mr. Ashish Tripathi', 'Operational Manager', 'IIT Kanpur', 'ashishkt@iitk.ac.in', '', 'assets/image/Team/ashish.jpeg', 0),
('895010cfd84b549a', 'operational_team', 'Mr. Subhashish Panday', 'Lab Technician', '', 'pshubhashish8@gmail.com', '9794370873', 'assets/image/Team/Shubhashish.jpeg', 1),
('b2c2f7153757c969', 'operational_team', 'Mr. Devendra Mishra', 'Bus Driver', '', 'devendramishra225@gmail.com', '9838577697', 'assets/image/Team/devendra.jpeg', 2)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `role` = VALUES(`role`), `org` = VALUES(`org`), `email` = VALUES(`email`), `contact` = VALUES(`contact`), `image` = VALUES(`image`);

INSERT INTO `news_items` (`id`, `title`, `image`, `sort_order`) VALUES
('86d16e56e60b75bbdd80811a29019247', '20260518080914-9a422d1fd39930a4.png', 'assets/uploads/20260518080914-9a422d1fd39930a4.png', 0),
('4970d20ca5edfc242613664f824124f8', '20260518075516-69f51f0369c97fdc.png', 'assets/uploads/20260518075516-69f51f0369c97fdc.png', 1),
('3a37a78cecb1f1b0ad066d2958ad6029', '10jaunpur_20260117_visit.jpeg', 'assets/image/news/10jaunpur_20260117_visit.jpeg', 2),
('5549b586f015b47fc3b1cc935fdd4c00', '9Meerut_bus_visit.jpeg', 'assets/image/news/9Meerut_bus_visit.jpeg', 3),
('704163311b61039555f0f9a69105fb72', '8Balia_bus_visit.jpeg', 'assets/image/news/8Balia_bus_visit.jpeg', 4),
('c1f0a20116496c37c2baa03c8edb9c35', '7yogi-ji_bus_launch.jpeg', 'assets/image/news/7yogi-ji_bus_launch.jpeg', 5),
('f624d8eafaebad100b1acb3d1ffb6dba', '6Etawah_bus_visit.jpeg', 'assets/image/news/6Etawah_bus_visit.jpeg', 6),
('54d3074bc3092fd8c1de58c8b787cb59', '5Etawah-II_bus_visit.jpeg', 'assets/image/news/5Etawah-II_bus_visit.jpeg', 7),
('4f0ff66ba5f7cd6cab572e1a59507437', '4Kandhini_bus_visit.jpeg', 'assets/image/news/4Kandhini_bus_visit.jpeg', 8),
('57bd874bf7b037fc1dcf6d386d5b9a94', '3Chakiya.jpg', 'assets/image/news/3Chakiya.jpg', 9),
('e85f462eace1fc3a7c0b086968e2c007', '2Sandeela2.jpg', 'assets/image/news/2Sandeela2.jpg', 10),
('f17a805e2188a888f6472d99c953413d', '1Sandeela1.jpg', 'assets/image/news/1Sandeela1.jpg', 11)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `sort_order` = VALUES(`sort_order`);

INSERT INTO `gallery_categories` (`id`, `name`, `sort_order`) VALUES
(1, 'Travel 1', 0), (2, 'Travel 2', 1), (3, 'Travel 3', 2), (4, 'travel3', 3)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `sort_order` = VALUES(`sort_order`);

INSERT INTO `gallery_packages` (`id`, `category_id`, `name`, `sort_order`) VALUES
(1, 1, 'College 1', 0), (2, 1, 'College 2', 1), (3, 2, 'College 1', 0),
(4, 2, 'College 2', 1), (5, 3, 'College 1', 0), (6, 3, 'College 2', 1)
ON DUPLICATE KEY UPDATE `category_id` = VALUES(`category_id`), `name` = VALUES(`name`), `sort_order` = VALUES(`sort_order`);

INSERT INTO `gallery_images` (`package_id`, `image`, `sort_order`) VALUES
(1, 'assets/image/gallery/3.jpeg', 0), (1, 'assets/image/gallery/4.jpeg', 1), (1, 'assets/image/gallery/5.jpeg', 2), (1, 'assets/uploads/20260518081123-f52cc833066ea4db.png', 3),
(2, 'assets/image/gallery/6.jpeg', 0), (2, 'assets/image/gallery/10.jpeg', 1), (2, 'assets/image/gallery/12.jpeg', 2),
(3, 'assets/image/gallery/3.jpeg', 0), (3, 'assets/image/gallery/4.jpeg', 1), (3, 'assets/image/gallery/5.jpeg', 2),
(4, 'assets/image/gallery/6.jpeg', 0), (4, 'assets/image/gallery/10.jpeg', 1), (4, 'assets/image/gallery/12.jpeg', 2),
(5, 'assets/image/gallery/3.jpeg', 0), (5, 'assets/image/gallery/4.jpeg', 1), (5, 'assets/image/gallery/5.jpeg', 2),
(6, 'assets/image/gallery/6.jpeg', 0), (6, 'assets/image/gallery/10.jpeg', 1), (6, 'assets/image/gallery/12.jpeg', 2);
