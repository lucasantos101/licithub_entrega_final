-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/07/2025 às 22:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `licithub`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cashier_subscriptions`
--

CREATE TABLE `cashier_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_status` varchar(255) NOT NULL,
  `stripe_price` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cashier_subscriptions`
--

INSERT INTO `cashier_subscriptions` (`id`, `user_id`, `name`, `stripe_id`, `stripe_status`, `stripe_price`, `quantity`, `trial_ends_at`, `ends_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'default', 'sub_1RaTlTQZYlGh3UzqmxDv0o1S', 'active', 'price_1RRROTQZYlGh3UzqVpcHQJzq', 1, NULL, NULL, '2025-06-16 06:31:25', '2025-06-16 06:31:25'),
(2, 3, 'default', 'sub_1RdN58QZYlGh3UzqFSbbq9P3', 'active', 'price_1RRROTQZYlGh3UzqVpcHQJzq', 1, NULL, NULL, '2025-06-24 05:59:39', '2025-06-24 05:59:39'),
(3, 5, 'default', 'sub_1RdNQiQZYlGh3UzqIPsK8JRZ', 'active', 'price_1RRROTQZYlGh3UzqVpcHQJzq', 1, NULL, NULL, '2025-06-24 06:21:58', '2025-06-24 06:21:58'),
(4, 7, 'default', 'sub_1RdxWYQZYlGh3UzqF14Gt9hh', 'active', 'price_1RTEFZQZYlGh3UzqyX7ZoWOx', 1, NULL, NULL, '2025-06-25 20:54:24', '2025-06-25 20:54:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cashier_subscription_items`
--

CREATE TABLE `cashier_subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_product` varchar(255) NOT NULL,
  `stripe_price` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED NOT NULL,
  `to_user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `from_user_id`, `to_user_id`, `message`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'oi', 0, NULL, '2025-06-25 06:37:38', '2025-06-25 06:37:38'),
(2, 2, 2, 'oi', 1, '2025-06-25 06:37:57', '2025-06-25 06:37:56', '2025-06-25 06:37:57'),
(3, 2, 3, 'ola', 1, '2025-07-08 20:24:43', '2025-06-25 06:40:12', '2025-07-08 20:24:43'),
(4, 2, 5, 'oi', 1, '2025-06-25 06:40:41', '2025-06-25 06:40:35', '2025-06-25 06:40:41'),
(5, 5, 2, 'ola', 1, '2025-06-25 06:41:03', '2025-06-25 06:41:01', '2025-06-25 06:41:03'),
(6, 5, 2, 'oi gente aloou', 1, '2025-06-25 06:41:34', '2025-06-25 06:41:31', '2025-06-25 06:41:34'),
(7, 2, 5, 'oi calma por favor.', 1, '2025-06-25 06:41:50', '2025-06-25 06:41:50', '2025-06-25 06:41:50'),
(8, 2, 5, 'oi etelvino', 1, '2025-06-25 06:42:47', '2025-06-25 06:42:45', '2025-06-25 06:42:47'),
(9, 5, 2, 'ola bruno', 1, '2025-06-25 06:42:53', '2025-06-25 06:42:52', '2025-06-25 06:42:53'),
(10, 5, 2, 'oi', 1, '2025-06-25 06:53:01', '2025-06-25 06:52:58', '2025-06-25 06:53:01'),
(11, 2, 5, 'sim siim', 1, '2025-06-25 06:53:04', '2025-06-25 06:53:03', '2025-06-25 06:53:04'),
(12, 5, 2, 'nao', 1, '2025-06-25 06:53:34', '2025-06-25 06:53:31', '2025-06-25 06:53:34'),
(13, 2, 5, 'oi', 1, '2025-06-25 07:05:10', '2025-06-25 07:05:05', '2025-06-25 07:05:10'),
(14, 5, 1, 'oi', 1, '2025-06-25 07:06:47', '2025-06-25 07:06:45', '2025-06-25 07:06:47'),
(15, 1, 5, 'oi', 1, '2025-06-25 07:06:50', '2025-06-25 07:06:49', '2025-06-25 07:06:50'),
(16, 2, 7, 'oi', 0, NULL, '2025-06-25 20:55:49', '2025-06-25 20:55:49'),
(17, 3, 2, 'a', 1, '2025-07-08 22:15:21', '2025-07-08 22:13:45', '2025-07-08 22:15:21'),
(18, 5, 1, 'oi', 1, '2025-07-09 22:09:50', '2025-07-09 22:04:28', '2025-07-09 22:09:50'),
(19, 5, 1, 'r', 1, '2025-07-09 22:09:50', '2025-07-09 22:04:39', '2025-07-09 22:09:50'),
(20, 5, 1, 'a', 1, '2025-07-09 22:09:50', '2025-07-09 22:04:57', '2025-07-09 22:09:50'),
(21, 5, 1, 'oi', 1, '2025-07-09 22:09:50', '2025-07-10 00:07:02', '2025-07-09 22:09:50'),
(22, 5, 1, 'oi', 1, '2025-07-09 22:09:50', '2025-07-09 22:07:26', '2025-07-09 22:09:50'),
(23, 5, 1, 'carlah', 1, '2025-07-09 22:09:50', '2025-07-09 22:08:04', '2025-07-09 22:09:50'),
(24, 5, 1, 'OIE', 1, '2025-07-09 22:09:50', '2025-07-10 00:09:05', '2025-07-09 22:09:50'),
(25, 5, 1, 'OIE', 1, '2025-07-09 22:09:50', '2025-07-10 00:09:06', '2025-07-09 22:09:50'),
(26, 5, 1, 'oi', 1, '2025-07-09 22:09:50', '2025-07-09 22:09:34', '2025-07-09 22:09:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_05_22_043236_create_cashier_tables', 1),
(2, '2025_05_22_043304_add_stripe_price_id_to_plans_table', 2),
(3, '2025_05_23_041859_create_chat_messages_table', 3),
(4, '2025_06_24_182115_add_features_off_to_plans_table', 4),
(5, '2025_06_25_030104_create_chat_messages_table', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('brvisan@gmail.com', '$2y$12$vazHX00RX8pWa93FX4.EWOpN/ljCCKCe7y8/fOE6KP42V.vGVTkw6', '2025-06-25 20:12:20'),
('dossantoslucs@gmail.com', '$2y$12$jruO.6YGQOM7ifHz/5Cf1.NRSOnVnISea2VjR60cN8lSiLxfC9qUS', '2025-05-25 02:09:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'BRL',
  `gateway` varchar(255) NOT NULL,
  `gateway_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'paid, pending, failed, refunded',
  `paid_at` timestamp NULL DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Dados adicionais',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Despejando dados para a tabela `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `subscription_id`, `amount`, `currency`, `gateway`, `gateway_id`, `status`, `paid_at`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 10.00, 'brl', 'stripe', 'in_1RaTlTQZYlGh3UzqOB5vvdT7', 'paid', '2025-06-16 06:31:19', NULL, '2025-06-16 06:31:25', '2025-06-16 06:31:25'),
(2, 3, 2, 10.00, 'brl', 'stripe', 'in_1RdN58QZYlGh3UzqyPUCVvpw', 'paid', '2025-06-24 05:59:34', NULL, '2025-06-24 05:59:40', '2025-06-24 05:59:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `trial_days` int(11) NOT NULL DEFAULT 0,
  `interval` varchar(255) NOT NULL COMMENT 'monthly, yearly',
  `stripe_price_id` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Recursos do plano em JSON',
  `features_off` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Despejando dados para a tabela `plans`
--

INSERT INTO `plans` (`id`, `name`, `slug`, `description`, `price`, `trial_days`, `interval`, `stripe_price_id`, `is_active`, `features`, `features_off`, `created_at`, `updated_at`) VALUES
(1, 'Plano Explorador', 'plano-explorador', 'Pequenos empresários ou autônomos que estão começando a buscar oportunidades em licitações.', 39.90, 0, 'month', 'price_1RRROTQZYlGh3UzqVpcHQJzq', 1, '\"[\\\"Acesso a licita\\\\u00e7\\\\u00f5es por regi\\\\u00e3o e por tipo de servi\\\\u00e7o\\\",\\\"At\\\\u00e9 3 filtros por busca (como estado, \\\\u00f3rg\\\\u00e3o ou categoria).\\\",\\\"Atualiza\\\\u00e7\\\\u00f5es de novas licita\\\\u00e7\\\\u00f5es duas vezes por semana.\\\",\\\"Hist\\\\u00f3rico das \\\\u00faltimas 10 licita\\\\u00e7\\\\u00f5es visualizadas.\\\"]\"', '[\"Acesso a todos os estados ao mesmo tempo.\",\"Alertas autom\\u00e1ticos e personalizados.\",\"Relat\\u00f3rios em PDF.\",\"An\\u00e1lise de concorr\\u00eancia.\"]', '2025-05-27 06:36:45', '2025-07-08 21:50:02'),
(2, 'Plano Estratégico', 'plano-estrategico', 'Empresas que já participam ou desejam participar com frequência de licitações e precisam de eficiência nas buscas.', 89.90, 0, 'month', 'price_1RTEFZQZYlGh3UzqyX7ZoWOx', 1, '\"[\\\"Todos os Recursos Do Plano Explorador\\\",\\\"Acesso a todos os estados ao mesmo tempo.\\\",\\\"Alertas autom\\\\u00e1ticos e personalizados.\\\",\\\"Relat\\\\u00f3rios em PDF.\\\",\\\"An\\\\u00e1lise de concorr\\\\u00eancia.\\\"]\"', '[\"Sugest\\u00f5es inteligentes com base em hist\\u00f3rico de vit\\u00f3rias.\",\"Acesso multiusu\\u00e1rio (para equipes).\"]', '2025-05-27 06:36:45', '2025-07-08 21:52:07'),
(4, 'Plano Inteligente', 'plano-inteligente', 'Empresas que querem otimizar seus resultados em licitações com ajuda de dados, automações e inteligência competitiva.', 199.90, 0, 'month', NULL, 1, '\"[\\\"Todos os Recursos do Plano Estrat\\\\u00e9gico\\\",\\\"Sugest\\\\u00f5es inteligentes com base em hist\\\\u00f3rico de vit\\\\u00f3rias.\\\",\\\"Acesso multiusu\\\\u00e1rio (at\\\\u00e9 5 membros da equipe).\\\",\\\"Dashboard com estat\\\\u00edsticas e metas.\\\",\\\"Sugest\\\\u00f5es autom\\\\u00e1ticas de licita\\\\u00e7\\\\u00f5es com maior chance de sucesso.\\\",\\\"An\\\\u00e1lise de concorrentes: veja quem venceu, com qual proposta e frequ\\\\u00eancia.\\\"]\"', '[]', '2025-06-28 05:03:13', '2025-07-08 21:53:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Ex: admin, manager, support',
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Permissões em JSON',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2Gr8W3ATt0OOkCsIksYqFVU8qlqukLZ4U9PbirqK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/117.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiREFwZWVrVUlTWFpTRmY3aEVOZVRPZGsxN2dleVdhYllZVE1CM1ZZTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jaGF0P2NsaWVudF9pZD01Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1752088812),
('6gk1saJbw1jZcu4xWlNwmSdVfhHfQIhmHy0d9F34', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUw1cTRVdTNmZ0UxY1ZWRzJlN0F5OVBMemN2R3BpMnVWTVNaa213aiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1752088651),
('SVeIvgBTOdVHKKwJHm8dL9tTjWKVNSI79SfYpKPM', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0FvSHdNcGxDNU03VWs3Zm9rOEdsOXRrdEgxa01Nb3RKWTZSdXZKZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbGllbnQvY2hhdD9hZG1pbl9pZD0xIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1752088814);

-- --------------------------------------------------------

--
-- Estrutura para tabela `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'active, canceled, expired, trial',
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `starts_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ends_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `canceled_at` timestamp NULL DEFAULT NULL,
  `gateway` varchar(255) NOT NULL COMMENT 'stripe, paypal, etc',
  `gateway_id` varchar(255) NOT NULL COMMENT 'ID no gateway de pagamento',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `plan_id`, `status`, `trial_ends_at`, `starts_at`, `ends_at`, `canceled_at`, `gateway`, `gateway_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'active', NULL, '2025-06-16 06:01:16', '2025-06-16 03:01:16', NULL, 'stripe', 'sub_1RaTIHQZYlGh3Uzq4flsXvLq', '2025-06-16 06:01:16', '2025-06-16 06:01:16'),
(2, 2, 1, 'active', NULL, '2025-06-16 06:18:13', '2025-06-16 03:18:13', NULL, 'stripe', 'sub_1RaTXvQZYlGh3Uzq6b9PWa3Y', '2025-06-16 06:17:25', '2025-06-16 06:18:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `stripe_id` varchar(255) DEFAULT NULL COMMENT 'ID no Stripe',
  `pm_type` varchar(255) DEFAULT NULL COMMENT 'Tipo de pagamento',
  `pm_last_four` varchar(4) DEFAULT NULL COMMENT 'Últimos 4 dígitos',
  `trial_ends_at` timestamp NULL DEFAULT NULL COMMENT 'Fim do período de trial',
  `user_type` enum('customer','employee','admin') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Lucas Vinicius', 'dossantoslucs@gmail.com', NULL, '$2y$12$PrhZJqleeK/7Jev.N0iIUeG0qMWLvJqGMgkf/ab5LLVKEreEee7C2', NULL, NULL, NULL, NULL, NULL, 'admin', '2025-05-25 02:08:47', '2025-05-26 00:58:51'),
(2, 'Bruno Santos', 'brvisan@gmail.com', NULL, '$2y$12$Newk2TQL..B43WJFK7626eb7ecy4zW39j2Alwc8a5IN.iov4fYrdq', NULL, 'cus_SVUkGcZIKe8XWK', 'card', '4242', NULL, 'admin', '2025-05-25 04:39:23', '2025-06-16 06:27:39'),
(3, 'kauana', 'kauan@kauan.com', NULL, '$2y$12$wgSMKWP6KMWzEpHwxiI6y.yevorNeGVXyxze/0/U5XjWEdvcPXj6G', NULL, 'cus_SYU3RTNB0jgHUV', 'card', '4242', NULL, 'customer', '2025-05-25 07:23:18', '2025-06-08 10:01:42'),
(5, 'etelvino', 'etelvino@etelvino.com', NULL, '$2y$12$bUkVSUhFnd.NVtJMWKqQ7Ojq2GZ09HBQpLFQZdQhaQNE7IWkOu7FW', NULL, 'cus_SYUPj4uVY7IdHJ', 'card', '4242', NULL, 'customer', '2025-06-24 06:20:24', '2025-06-24 06:20:24'),
(6, 'ronaldo', 'ronaldo@ronaldo', NULL, '$2y$12$sXZOes0iT9Q1ib2KgKbAc.4.8EyOZRmTC1JFZL2xPLmCij067lIo2', NULL, NULL, NULL, NULL, NULL, 'customer', '2025-06-24 06:34:44', '2025-06-24 06:34:44'),
(7, 'lucas', 'ronaldo@ronaldo.com', NULL, '$2y$12$JFHW9hNgXzsSf1stramNFuvkMYOBvRf/8pumHWx3t4AzU5NiBdtjG', NULL, 'cus_SZ5hwg62yNGBdD', 'card', '4242', NULL, 'customer', '2025-06-25 20:53:59', '2025-06-25 20:53:59'),
(8, 'Alfonsos', 'afonso@afonso.com', NULL, '$2y$12$JVym2vg3CeWMO8clYDfpieHZyMUNKKEsY.72lJGG9LDxcZsqxX/oW', NULL, NULL, NULL, NULL, NULL, 'customer', '2025-06-30 08:11:03', '2025-06-30 08:13:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cashier_subscriptions`
--
ALTER TABLE `cashier_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cashier_subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `cashier_subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Índices de tabela `cashier_subscription_items`
--
ALTER TABLE `cashier_subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cashier_subscription_items_subscription_id_stripe_price_unique` (`subscription_id`,`stripe_price`),
  ADD UNIQUE KEY `cashier_subscription_items_stripe_id_unique` (`stripe_id`);

--
-- Índices de tabela `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_from_user_id_foreign` (`from_user_id`),
  ADD KEY `chat_messages_to_user_id_foreign` (`to_user_id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_subscription_id_foreign` (`subscription_id`),
  ADD KEY `payments_status_index` (`status`),
  ADD KEY `payments_paid_at_index` (`paid_at`);

--
-- Índices de tabela `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_slug_unique` (`slug`),
  ADD KEY `plans_stripe_price_id_index` (`stripe_price_id`);

--
-- Índices de tabela `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_foreign` (`user_id`),
  ADD KEY `subscriptions_plan_id_foreign` (`plan_id`),
  ADD KEY `subscriptions_status_index` (`status`),
  ADD KEY `subscriptions_ends_at_index` (`ends_at`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Índices de tabela `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cashier_subscriptions`
--
ALTER TABLE `cashier_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cashier_subscription_items`
--
ALTER TABLE `cashier_subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
