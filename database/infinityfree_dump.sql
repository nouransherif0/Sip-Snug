SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
START TRANSACTION;
SET time_zone = '+00:00';

-- Table structure for `migrations`
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data for `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2026_07_21_001400_create_delivery_zones_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2026_07_21_001700_create_categories_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2026_07_21_001800_create_subcategories_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2026_07_21_002314_create_carts_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2026_07_21_002900_create_addresses_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2026_07_21_003300_create_orders_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2026_07_21_003400_create_products_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2026_07_21_003450_create_add_ons_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2026_07_21_003500_create_product_addons_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2026_07_21_003550_create_cart_items_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14, '2026_07_21_003600_create_order_items_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15, '2026_07_21_003643_create_order_item_addons_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16, '2026_07_22_002249_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17, '2026_07_22_155228_add_profile_image_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18, '2026_07_22_160905_create_favorites_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19, '2026_07_22_185350_add_image_to_subcategories_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20, '2026_07_22_192610_create_contact_messages_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21, '2026_07_22_192611_create_subscribers_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22, '2026_07_22_192612_create_reservations_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23, '2026_07_22_224830_add_image_to_subcategories_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24, '2026_07_23_021348_create_saved_cards_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25, '2026_07_23_023618_add_reward_points_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26, '2026_07_23_053316_add_columns_to_contact_and_reservations_tables', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27, '2026_07_24_225138_add_details_to_products_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28, '2026_07_24_225150_create_reviews_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29, '2026_07_26_100000_add_scope_and_targets_to_add_ons_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30, '2026_07_26_200000_create_addon_scope_pivot_tables', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31, '2026_07_26_300000_create_store_locations_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32, '2026_07_26_400000_update_store_locations_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33, '2026_07_26_500000_make_working_hours_nullable_in_store_locations', 1);

-- Table structure for `users`
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NULL,
  `role` VARCHAR(255) NOT NULL DEFAULT 'customer',
  `remember_token` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `profile_image` VARCHAR(255) NULL,
  `reward_points` INTEGER NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data for `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `role`, `remember_token`, `created_at`, `updated_at`, `profile_image`, `reward_points`) VALUES ('01kyh9z1skkedvwtqg8evtefae', 'Admin Nouran', 'admin@sipandsnug.com', '2026-07-27 08:09:51', '$2y$12$WxTFmnRKOqOMU2w1zrLMM.zPIpMO4rkbO0uai.tgMk40wHwXKPsq6', NULL, 'admin', 'PsarDVxwJ5', '2026-07-27 08:09:51', '2026-07-27 08:09:51', NULL, 0);

-- Table structure for `password_reset_tokens`
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `sessions`
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` VARCHAR(255) NULL,
  `ip_address` VARCHAR(255) NULL,
  `user_agent` TEXT NULL,
  `payload` TEXT NOT NULL,
  `last_activity` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `cache`
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` TEXT NOT NULL,
  `expiration` INTEGER NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `cache_locks`
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INTEGER NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `jobs`
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `queue` VARCHAR(255) NOT NULL,
  `payload` TEXT NOT NULL,
  `attempts` INTEGER NOT NULL,
  `reserved_at` INTEGER NULL,
  `available_at` INTEGER NOT NULL,
  `created_at` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `job_batches`
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INTEGER NOT NULL,
  `pending_jobs` INTEGER NOT NULL,
  `failed_jobs` INTEGER NOT NULL,
  `failed_job_ids` TEXT NOT NULL,
  `options` TEXT NULL,
  `cancelled_at` INTEGER NULL,
  `created_at` INTEGER NOT NULL,
  `finished_at` INTEGER NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `failed_jobs`
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` VARCHAR(255) NOT NULL,
  `queue` VARCHAR(255) NOT NULL,
  `payload` TEXT NOT NULL,
  `exception` TEXT NOT NULL,
  `failed_at` TIMESTAMP NULL DEFAULT NULL NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `delivery_zones`
DROP TABLE IF EXISTS `delivery_zones`;
CREATE TABLE `delivery_zones` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `delivery_fee` TEXT NOT NULL,
  `minimum_order_value` TEXT NULL,
  `estimated_time` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `categories`
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data for `categories`
INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES (1, 'Coffee', 'image/coffee/coffee cate.jpg', '2026-07-27 08:09:51', '2026-07-27 08:09:51');
INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES (2, 'Fresh Juice', 'image/fresh juice/fresh juice.jpg', '2026-07-27 08:09:54', '2026-07-27 08:09:54');
INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES (3, 'Matcha', 'image/matcha/matcha cate.jpg', '2026-07-27 08:09:56', '2026-07-27 08:09:56');
INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES (4, 'Refreshers', 'image/refreshers/refreshers.jpg', '2026-07-27 08:09:58', '2026-07-27 08:09:58');
INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES (5, 'Smoothies', 'image/smoothies/smoothies.jpg', '2026-07-27 08:10:00', '2026-07-27 08:10:00');
INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES (6, 'Shop', 'image/shop/shop.jpg', '2026-07-27 08:10:02', '2026-07-27 08:10:02');

-- Table structure for `subcategories`
DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE `subcategories` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `category_id` INTEGER NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `image` VARCHAR(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data for `subcategories`
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (1, 1, 'Hot Coffee', '2026-07-27 08:09:52', '2026-07-27 08:09:52', 'image/coffee/hot coffee category .jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (2, 1, 'Iced Coffee', '2026-07-27 08:09:52', '2026-07-27 08:09:52', 'image/coffee/iced coffee category .jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (3, 2, 'Single Fruit Juice', '2026-07-27 08:09:54', '2026-07-27 08:09:54', 'image/fresh juice/fresh juice.jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (4, 2, 'Blended Juice', '2026-07-27 08:09:54', '2026-07-27 08:09:54', 'image/fresh juice/Beet-Apple Juice.jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (5, 3, 'Hot Matcha', '2026-07-27 08:09:56', '2026-07-27 08:09:56', 'image/matcha/hot matcha.jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (6, 3, 'Iced Matcha', '2026-07-27 08:09:56', '2026-07-27 08:09:56', 'image/matcha/iced matcha .jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (7, 4, 'Mojito', '2026-07-27 08:09:58', '2026-07-27 08:09:58', 'image/refreshers/mojito.jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (8, 4, 'Iced Tea', '2026-07-27 08:09:59', '2026-07-27 08:09:59', 'image/refreshers/peach iced tea.jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (9, 5, 'Fruit Smoothies', '2026-07-27 08:10:00', '2026-07-27 08:10:00', 'image/smoothies/berry.jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (10, 5, 'Dessert Smoothies', '2026-07-27 08:10:00', '2026-07-27 08:10:00', 'image/smoothies/nutella smoothie.jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (11, 6, 'Mugs & Cups', '2026-07-27 08:10:02', '2026-07-27 08:10:02', 'image/shop/Ceramic Mug.jpg');
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`, `image`) VALUES (12, 6, 'Coffee & Matcha Powders', '2026-07-27 08:10:02', '2026-07-27 08:10:02', 'image/shop/japanese mtcha.jpg');

-- Table structure for `carts`
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `addresses`
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` VARCHAR(255) NOT NULL,
  `delivery_zone_id` INTEGER NOT NULL,
  `label` VARCHAR(255) NULL,
  `street` TEXT NOT NULL,
  `building_number` VARCHAR(255) NOT NULL,
  `floor` VARCHAR(255) NULL,
  `apartment` VARCHAR(255) NULL,
  `landmark` VARCHAR(255) NULL,
  `phone_number` VARCHAR(255) NOT NULL,
  `is_default` INTEGER NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `orders`
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` VARCHAR(255) NOT NULL,
  `address_id` VARCHAR(255) NOT NULL,
  `total_price` TEXT NOT NULL,
  `delivery_fee` TEXT NOT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'pending',
  `payment_method` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `products`
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `subcategory_id` INTEGER NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `price` TEXT NOT NULL,
  `image` VARCHAR(255) NULL,
  `stock` INTEGER NOT NULL,
  `is_featured` INTEGER NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `calories` INTEGER NULL DEFAULT '180',
  `prep_time` INTEGER NULL DEFAULT '5',
  `discount_price` TEXT NULL,
  `is_bestseller` INTEGER NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data for `products`
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (1, 1, 'Espresso', 'Rich and bold espresso.', 20, 'image/coffee/esspresso.jpg', 50, 1, '2026-07-27 08:09:52', '2026-07-27 08:09:52', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (2, 1, 'Hot Americano', 'Classic hot americano.', 25, 'image/coffee/hot amrecano.jpg', 50, 0, '2026-07-27 08:09:52', '2026-07-27 08:09:52', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (3, 1, 'Hot Dark Mocha', 'Dark chocolate mocha.', 35, 'image/coffee/hot dark mocha.jpg', 50, 0, '2026-07-27 08:09:53', '2026-07-27 08:09:53', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (4, 1, 'Hot Latte', 'Smooth hot latte.', 30, 'image/coffee/hot latte.jpg', 50, 1, '2026-07-27 08:09:53', '2026-07-27 08:09:53', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (5, 2, 'Iced Americano', 'Refreshing iced americano.', 25, 'image/coffee/iced amrecano.jpg', 50, 0, '2026-07-27 08:09:53', '2026-07-27 08:09:53', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (6, 2, 'Iced Cold Brew', 'Slow-steeped cold brew.', 40, 'image/coffee/iced cold brew.jpg', 50, 1, '2026-07-27 08:09:53', '2026-07-27 08:09:53', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (7, 2, 'Iced Dark Mocha', 'Iced dark chocolate mocha.', 40, 'image/coffee/iced dark mocha.jpg', 50, 0, '2026-07-27 08:09:53', '2026-07-27 08:09:53', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (8, 2, 'Iced Latte', 'Creamy iced latte.', 35, 'image/coffee/iced latte.jpg', 50, 0, '2026-07-27 08:09:54', '2026-07-27 08:09:54', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (9, 3, 'Mango Juice', 'Fresh mango juice.', 30, 'image/fresh juice/mango juice.jpg', 50, 1, '2026-07-27 08:09:55', '2026-07-27 08:09:55', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (10, 3, 'Orange Juice', 'Freshly squeezed orange juice.', 25, 'image/fresh juice/orange juice.jpg', 50, 0, '2026-07-27 08:09:55', '2026-07-27 08:09:55', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (11, 3, 'Pineapple Juice', 'Tropical pineapple juice.', 35, 'image/fresh juice/pinnaple juice.jpg', 50, 0, '2026-07-27 08:09:55', '2026-07-27 08:09:55', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (12, 3, 'Watermelon Juice', 'Refreshing watermelon juice.', 25, 'image/fresh juice/watermelon juice.jpg', 50, 1, '2026-07-27 08:09:55', '2026-07-27 08:09:55', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (13, 4, 'Beet-Apple Juice', 'Healthy beet and apple blend.', 40, 'image/fresh juice/Beet-Apple Juice.jpg', 50, 0, '2026-07-27 08:09:55', '2026-07-27 08:09:55', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (14, 4, 'Ginger-Lemon Juice', 'Zesty ginger and lemon.', 35, 'image/fresh juice/Ginger-Lemon Juice.jpg', 50, 0, '2026-07-27 08:09:56', '2026-07-27 08:09:56', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (15, 4, 'Orange-Carrot Juice', 'Nutritious orange and carrot blend.', 35, 'image/fresh juice/Orange-Carrot Juice.jpg', 50, 1, '2026-07-27 08:09:56', '2026-07-27 08:09:56', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (16, 5, 'Hot Matcha', 'Traditional hot matcha.', 45, 'image/matcha/hot matcha.jpg', 50, 0, '2026-07-27 08:09:57', '2026-07-27 08:09:57', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (17, 5, 'Hot Matcha Latte', 'Creamy hot matcha latte.', 50, 'image/matcha/hot matcha latte.jpg', 50, 1, '2026-07-27 08:09:57', '2026-07-27 08:09:57', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (18, 6, 'Blueberry Matcha', 'Matcha with blueberry flavor.', 55, 'image/matcha/blueberry matcha.jpg', 50, 0, '2026-07-27 08:09:57', '2026-07-27 08:09:57', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (19, 6, 'Mango Matcha', 'Tropical mango matcha.', 55, 'image/matcha/mango.jpg', 50, 1, '2026-07-27 08:09:57', '2026-07-27 08:09:57', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (20, 6, 'Matcha Coconut', 'Matcha blended with coconut milk.', 60, 'image/matcha/matcha coconut.jpg', 50, 0, '2026-07-27 08:09:58', '2026-07-27 08:09:58', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (21, 6, 'Pink Matcha', 'Special pink matcha blend.', 55, 'image/matcha/pink matcha.jpg', 50, 1, '2026-07-27 08:09:58', '2026-07-27 08:09:58', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (22, 6, 'Rose Matcha', 'Delicate rose-flavored matcha.', 60, 'image/matcha/rose.jpg', 50, 0, '2026-07-27 08:09:58', '2026-07-27 08:09:58', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (23, 7, 'Classic Mojito', 'Classic mint and lime mojito.', 35, 'image/refreshers/mojito.jpg', 50, 0, '2026-07-27 08:09:59', '2026-07-27 08:09:59', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (24, 7, 'Pina Colada Mojito', 'Tropical pina colada mojito.', 45, 'image/refreshers/pina colada mojito.jpg', 50, 1, '2026-07-27 08:09:59', '2026-07-27 08:09:59', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (25, 7, 'Strawberry Mojito', 'Sweet strawberry mojito.', 40, 'image/refreshers/strawberry mojito.jpg', 50, 0, '2026-07-27 08:09:59', '2026-07-27 08:09:59', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (26, 7, 'Watermelon Mojito', 'Refreshing watermelon mojito.', 40, 'image/refreshers/watermelon mojito.jpg', 50, 1, '2026-07-27 08:09:59', '2026-07-27 08:09:59', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (27, 8, 'Blueberry Iced Tea', 'Iced tea infused with blueberry.', 35, 'image/refreshers/blue berry iced tea.jpg', 50, 0, '2026-07-27 08:10:00', '2026-07-27 08:10:00', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (28, 8, 'Lemon Iced Tea', 'Classic lemon iced tea.', 30, 'image/refreshers/lemon ioced tea.jpg', 50, 0, '2026-07-27 08:10:00', '2026-07-27 08:10:00', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (29, 8, 'Peach Iced Tea', 'Sweet peach iced tea.', 35, 'image/refreshers/peach iced tea.jpg', 50, 1, '2026-07-27 08:10:00', '2026-07-27 08:10:00', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (30, 9, 'Mixed Berry Smoothie', 'Blend of wild berries.', 45, 'image/smoothies/berry.jpg', 50, 1, '2026-07-27 08:10:01', '2026-07-27 08:10:01', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (31, 9, 'Mango Smoothie', 'Creamy mango smoothie.', 40, 'image/smoothies/mango smoothie.jpg', 50, 0, '2026-07-27 08:10:01', '2026-07-27 08:10:01', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (32, 9, 'Strawberry Smoothie', 'Fresh strawberry smoothie.', 40, 'image/smoothies/straw smoothie.jpg', 50, 0, '2026-07-27 08:10:01', '2026-07-27 08:10:01', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (33, 9, 'Tropical Blend', 'Special tropical fruit blend.', 45, 'image/smoothies/pexels-alejandro-aznar-155337093-28525199.jpg', 50, 1, '2026-07-27 08:10:01', '2026-07-27 08:10:01', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (34, 10, 'Nutella Smoothie', 'Indulgent Nutella smoothie.', 50, 'image/smoothies/nutella smoothie.jpg', 50, 1, '2026-07-27 08:10:02', '2026-07-27 08:10:02', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (35, 11, 'Ceramic Mug', 'High quality ceramic mug.', 150, 'image/shop/Ceramic Mug.jpg', 50, 0, '2026-07-27 08:10:02', '2026-07-27 08:10:02', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (36, 11, 'Reusable Cup', 'Eco-friendly reusable cup.', 120, 'image/shop/reusable.jpg', 50, 1, '2026-07-27 08:10:03', '2026-07-27 08:10:03', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (37, 11, 'Thermal Flask', 'Keeps your drinks hot or cold.', 250, 'image/shop/thermal.jpg', 50, 1, '2026-07-27 08:10:03', '2026-07-27 08:10:03', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (38, 11, 'To Go Cup', 'Stylish to-go cup.', 100, 'image/shop/to go cup.jpg', 50, 0, '2026-07-27 08:10:03', '2026-07-27 08:10:03', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (39, 12, 'Doncafé Beans', 'Premium Doncafé beans.', 300, 'image/shop/Doncafé.jpg', 50, 1, '2026-07-27 08:10:03', '2026-07-27 08:10:03', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (40, 12, 'Nescafé Blend', 'Classic Nescafé blend.', 200, 'image/shop/Nescafé.jpg', 50, 0, '2026-07-27 08:10:03', '2026-07-27 08:10:03', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (41, 12, 'Ade Leaf Matcha', 'Authentic Ade Leaf Matcha.', 450, 'image/shop/ade leaf matcha.jpg', 50, 0, '2026-07-27 08:10:04', '2026-07-27 08:10:04', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (42, 12, 'Japanese Matcha Powder', 'Ceremonial grade Japanese Matcha.', 500, 'image/shop/japanese mtcha.jpg', 50, 1, '2026-07-27 08:10:04', '2026-07-27 08:10:04', 180, 5, NULL, 0);
INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `stock`, `is_featured`, `created_at`, `updated_at`, `calories`, `prep_time`, `discount_price`, `is_bestseller`) VALUES (43, 12, 'Turkish Matcha', 'Special Turkish Matcha blend.', 400, 'image/shop/turkish matcha.jpg', 50, 0, '2026-07-27 08:10:04', '2026-07-27 08:10:04', 180, 5, NULL, 0);

-- Table structure for `product_addon`
DROP TABLE IF EXISTS `product_addon`;
CREATE TABLE `product_addon` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `product_id` INTEGER NOT NULL,
  `addon_id` INTEGER NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `cart_items`
DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `cart_id` VARCHAR(255) NOT NULL,
  `product_id` INTEGER NOT NULL,
  `quantity` INTEGER NOT NULL,
  `add_ons` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `order_items`
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `order_id` VARCHAR(255) NOT NULL,
  `product_id` INTEGER NOT NULL,
  `quantity` INTEGER NOT NULL,
  `price` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `order_item_addons`
DROP TABLE IF EXISTS `order_item_addons`;
CREATE TABLE `order_item_addons` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `order_item_id` INTEGER NOT NULL,
  `addon_id` INTEGER NOT NULL,
  `price_adjustment` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `personal_access_tokens`
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `tokenable_type` VARCHAR(255) NOT NULL,
  `tokenable_id` INTEGER NOT NULL,
  `name` TEXT NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `abilities` TEXT NULL,
  `last_used_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `expires_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `favorites`
DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `user_id` VARCHAR(255) NOT NULL,
  `product_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`user_id`, `product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `contact_messages`
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `subscribers`
DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE `subscribers` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `reservations`
DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `saved_cards`
DROP TABLE IF EXISTS `saved_cards`;
CREATE TABLE `saved_cards` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `user_id` VARCHAR(255) NOT NULL,
  `card_type` VARCHAR(255) NOT NULL,
  `card_name` VARCHAR(255) NOT NULL,
  `card_number` VARCHAR(255) NOT NULL,
  `expiry_date` VARCHAR(255) NOT NULL,
  `cvv` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `reviews`
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `user_id` VARCHAR(255) NOT NULL,
  `product_id` INTEGER NOT NULL,
  `rating` INTEGER NOT NULL,
  `comment` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `add_ons`
DROP TABLE IF EXISTS `add_ons`;
CREATE TABLE `add_ons` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `price_adjustment` TEXT NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `scope` VARCHAR(255) NOT NULL DEFAULT 'global',
  `category_id` INTEGER NULL,
  `subcategory_id` INTEGER NULL,
  `product_id` INTEGER NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `addon_category`
DROP TABLE IF EXISTS `addon_category`;
CREATE TABLE `addon_category` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `addon_id` INTEGER NOT NULL,
  `category_id` INTEGER NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `addon_subcategory`
DROP TABLE IF EXISTS `addon_subcategory`;
CREATE TABLE `addon_subcategory` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `addon_id` INTEGER NOT NULL,
  `subcategory_id` INTEGER NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `store_locations`
DROP TABLE IF EXISTS `store_locations`;
CREATE TABLE `store_locations` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `badge` VARCHAR(255) NULL,
  `address` VARCHAR(255) NOT NULL,
  `working_hours` VARCHAR(255) NULL,
  `phone` VARCHAR(255) NOT NULL,
  `google_maps_url` TEXT NULL,
  `is_active` INTEGER NOT NULL DEFAULT '1',
  `created_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'open',
  `days_label` VARCHAR(255) NULL DEFAULT 'Daily',
  `opening_time` VARCHAR(255) NULL,
  `closing_time` VARCHAR(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data for `store_locations`
INSERT INTO `store_locations` (`id`, `name`, `badge`, `address`, `working_hours`, `phone`, `google_maps_url`, `is_active`, `created_at`, `updated_at`, `status`, `days_label`, `opening_time`, `closing_time`) VALUES (1, 'Nasr City Branch', 'Flagship Store', 'Abbas El Akkad St, Nasr City, Cairo', 'Daily: 07:00 AM - 12:00 AM', '+20 19696 (Ext. 1)', 'https://maps.google.com/?q=Nasr+City', 1, '2026-07-27 08:10:04', '2026-07-27 08:10:04', 'open', 'Daily', '07:00', '00:00');
INSERT INTO `store_locations` (`id`, `name`, `badge`, `address`, `working_hours`, `phone`, `google_maps_url`, `is_active`, `created_at`, `updated_at`, `status`, `days_label`, `opening_time`, `closing_time`) VALUES (2, 'Zamalek Outlet', 'Co-Working Friendly', '26th of July St, Zamalek, Cairo', 'Daily: 08:00 AM - 11:30 PM', '+20 19696 (Ext. 2)', 'https://maps.google.com/?q=Zamalek', 1, '2026-07-27 08:10:05', '2026-07-27 08:10:05', 'open', 'Daily', '08:00', '23:30');
INSERT INTO `store_locations` (`id`, `name`, `badge`, `address`, `working_hours`, `phone`, `google_maps_url`, `is_active`, `created_at`, `updated_at`, `status`, `days_label`, `opening_time`, `closing_time`) VALUES (3, 'New Cairo - Waterway', 'Garden Seating', 'Waterway Compound, 5th Settlement', 'Daily: 07:30 AM - 01:00 AM', '+20 19696 (Ext. 3)', 'https://maps.google.com/?q=Waterway+New+Cairo', 1, '2026-07-27 08:10:05', '2026-07-27 08:10:05', 'open', 'Daily', '07:30', '01:00');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;