-- Custom tables extracted from sql_dump.sql
-- Imported into dtehm_insurance_api database
-- WordPress (wprm_*) tables excluded

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';
SET NAMES utf8mb4;


-- --------------------------------------------------------
-- Table structure for table `admin_activity_log`
--

CREATE TABLE `admin_activity_log` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `admin_activity_log`
--

INSERT INTO `admin_activity_log` (`id`, `admin_id`, `action`, `module`, `record_id`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'create', 'news_posts', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-18 14:19:46'),
(2, 1, 'update', 'news_posts', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-18 14:20:09'),
(3, 1, 'create', 'news_posts', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-18 14:29:17'),
(4, 1, 'update', 'news_posts', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-18 14:29:32'),
(5, 1, 'create', 'events', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-18 15:08:02'),
(6, 1, 'update', 'events', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-18 15:08:21'),
(7, 1, 'create', 'causes', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-18 15:45:58'),
(8, 1, 'update', 'causes', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-18 15:46:37'),
(9, 1, 'update', 'news_posts', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 21:30:22'),
(10, 1, 'update', 'news_posts', 10, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 21:42:32'),
(11, 1, 'update', 'news_posts', 12, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 21:44:36'),
(12, 1, 'update', 'causes', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 22:00:17'),
(13, 1, 'update', 'causes', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 22:00:20'),
(14, 1, 'update', 'causes', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 22:00:30'),
(15, 1, 'update', 'causes', 3, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 22:02:03'),
(16, 1, 'update', 'news_posts', 12, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 22:26:35'),
(17, 1, 'delete', 'news_posts', 16, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 22:26:45'),
(18, 1, 'update', 'events', 9, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 22:29:38'),
(19, 1, 'update', 'causes', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-20 22:32:38'),
(20, 1, 'update', 'news_posts', 3, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-21 09:48:02'),
(21, 1, 'update', 'news_posts', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-21 19:43:59'),
(22, 1, 'update', 'news_posts', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-21 20:08:38'),
(23, 1, 'update', 'news_posts', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-21 20:08:41'),
(24, 1, 'update', 'news_posts', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-21 08:38:12');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `full_name`, `email`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$U544UrreKrF9a50gR0vrDO1tV5mCyT3ufVpQCbOk.HGl1FMm/JTbW', 'ULFA Administrator', 'admin@ulfa.org', 'active', '2026-02-21 11:28:39', '2026-01-18 13:04:35', '2026-02-21 08:28:39');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `causes`
--

CREATE TABLE `causes` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cause_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goal_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `raised_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `beneficiaries` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urgency` enum('low','medium','high','critical') COLLATE utf8mb4_unicode_ci DEFAULT 'medium',
  `status` enum('active','completed','paused','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `is_featured` tinyint(1) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `donors_count` int(11) DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `title`, `slug`, `description`, `cause_image`, `category`, `goal_amount`, `raised_amount`, `start_date`, `end_date`, `beneficiaries`, `location`, `urgency`, `status`, `is_featured`, `views`, `donors_count`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Asperiores et vero blanditiis quas enim veniam', 'asperiores-et-vero-blanditiis-quas-enim-veniam', '<p><span style=\"text-decoration: underline;\"><strong>Asperiores</strong></span> et vero blanditiis quas enim veniamAsperiores et vero blanditiis quas enim veniamAsperiores et vero blanditiis quas enim veniamAsperiores et vero blanditiis quas enim veniam</p>', 'cause-1.jpg', 'Healthcare', 85.00, 67.00, '1995-04-29', '1996-07-02', 'Est lorem aliquam do', 'Culpa voluptatum du', 'low', 'active', 1, 0, 0, 1, '2026-01-18 12:45:58', '2026-01-18 23:55:39'),
(2, 'Build a School', 'build-a-school', '<p>Support our Build a School initiative. Your donation will make a direct impact on the lives of those we serve.</p>\r\n<p>Every contribution counts and <strong>helps</strong> us reach our goal.</p>', 'causes/img_696ffafe0e8ae5.01992408.jpeg', 'Education', 150000.00, 87500.00, '2025-12-19', NULL, '&amp;amp;lt;br /&amp;amp;gt;&amp;amp;lt;b&amp;amp;gt;Deprecated&amp;amp;lt;/b&amp;amp;gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &amp;amp;lt;b&amp;amp;gt;/Applications/MAMP/htdocs/ulfa/admin/causes-edit.php&amp;amp;lt;/b&amp;amp;gt; on line &amp;amp;lt;b&amp;amp;gt;125&amp;amp;lt;/b&amp;amp;gt;&amp;amp;lt;br /&amp;amp;gt;', '&amp;amp;lt;br /&amp;amp;gt;&amp;amp;lt;b&amp;amp;gt;Deprecated&amp;amp;lt;/b&amp;amp;gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &amp;amp;lt;b&amp;amp;gt;/Applications/MAMP/htdocs/ulfa/admin/causes-edit.php&amp;amp;lt;/b&amp;amp;gt; on line &amp;amp;lt;b&amp;amp;gt;131&amp;amp;lt;/b&amp;amp;gt;&amp;amp;lt;br /&amp;amp;gt;', 'medium', 'active', 1, 0, 0, 1, '2026-01-18 23:28:28', '2026-01-20 19:32:38'),
(3, 'Medical Equipment Fund', 'medical-equipment-fund', '<p>Support our Medical Equipment Fund initiative. Your donation will make a direct impact on the lives of those we serve.</p>\r\n<p>Every contribution counts and helps us reach our goal.</p>', 'causes/img_696ffb5bcc4293.72912600.jpg', 'Healthcare', 200000.00, 145000.00, '2025-12-19', NULL, '&lt;br /&gt;&lt;b&gt;Deprecated&lt;/b&gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &lt;b&gt;/Applications/MAMP/htdocs/ulfa/admin/causes-edit.php&lt;/b&gt; on line &lt;b&gt;125&lt;/b&gt;&lt;br /&gt;', '&lt;br /&gt;&lt;b&gt;Deprecated&lt;/b&gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &lt;b&gt;/Applications/MAMP/htdocs/ulfa/admin/causes-edit.php&lt;/b&gt; on line &lt;b&gt;131&lt;/b&gt;&lt;br /&gt;', 'medium', 'active', 1, 0, 0, 1, '2026-01-18 23:28:28', '2026-01-20 19:02:03'),
(4, 'Feed 1000 Families', 'feed-1000-families', '<p>Support our Feed 1000 Families initiative. Your donation will make a direct impact on the lives of those we serve.</p><p>Every contribution counts and helps us reach our goal.</p>', 'cause-4.jpg', 'Food Security', 60000.00, 42300.00, '2025-12-19', NULL, NULL, NULL, 'medium', 'active', 1, 0, 0, 1, '2026-01-18 23:28:28', '2026-01-18 23:55:39'),
(5, 'Student Scholarships', 'student-scholarships', '<p>Support our Student Scholarships initiative. Your donation will make a direct impact on the lives of those we serve.</p><p>Every contribution counts and helps us reach our goal.</p>', 'cause-5.jpg', 'Education', 100000.00, 58900.00, '2025-12-19', NULL, NULL, NULL, 'medium', 'active', 0, 0, 0, 1, '2026-01-18 23:28:28', '2026-01-18 23:55:39'),
(6, 'Clean Water Project', 'clean-water-project', '<p>Support our Clean Water Project initiative. Your donation will make a direct impact on the lives of those we serve.</p><p>Every contribution counts and helps us reach our goal.</p>', 'cause-6.jpg', 'Water', 80000.00, 35600.00, '2025-12-19', NULL, NULL, NULL, 'high', 'active', 0, 0, 0, 1, '2026-01-18 23:28:28', '2026-01-18 23:55:39'),
(7, 'Women Training Center', 'women-training-center', '<p>Support our Women Training Center initiative. Your donation will make a direct impact on the lives of those we serve.</p><p>Every contribution counts and helps us reach our goal.</p>', 'cause-7.jpg', 'Empowerment', 120000.00, 78200.00, '2025-12-19', NULL, NULL, NULL, 'medium', 'active', 0, 0, 0, 1, '2026-01-18 23:28:28', '2026-01-18 23:55:39'),
(8, 'Senior Citizens Support', 'senior-citizens-support', '<p>Support our Senior Citizens Support initiative. Your donation will make a direct impact on the lives of those we serve.</p><p>Every contribution counts and helps us reach our goal.</p>', 'cause-8.jpg', 'Elder Care', 108000.00, 67400.00, '2025-12-19', NULL, NULL, NULL, 'medium', 'active', 0, 0, 0, 1, '2026-01-18 23:28:28', '2026-01-18 23:55:39'),
(9, 'Orphanage Renovation', 'orphanage-renovation', '<p>Support our Orphanage Renovation initiative. Your donation will make a direct impact on the lives of those we serve.</p><p>Every contribution counts and helps us reach our goal.</p>', 'cause-9.jpg', 'Child Welfare', 175000.00, 92800.00, '2025-12-19', NULL, NULL, NULL, 'medium', 'active', 0, 0, 0, 1, '2026-01-18 23:28:28', '2026-01-18 23:55:39');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `contact_inquiries`
--

CREATE TABLE `contact_inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` enum('new','read','replied','closed') COLLATE utf8mb4_unicode_ci DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `contact_inquiries`
--

INSERT INTO `contact_inquiries` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`, `created_at`, `ip_address`) VALUES
(1, 'Muhindo Mubaraka', 'mubahood360@gmail.com', '0783204665', 'volunteer', 'cause-detail.phpcause-detail.phpcause-detail.phpcause-detail.phpcause-detail.phpcause-detail.php', 'read', '2026-01-19 10:48:08', '::1');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `donor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donor_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donor_phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `amount_usd` decimal(12,2) DEFAULT NULL,
  `exchange_rate` decimal(10,2) DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'UGX',
  `cause_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `is_anonymous` tinyint(1) DEFAULT '0',
  `merchant_reference` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','completed','failed','reversed','invalid') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `donor_name`, `donor_email`, `donor_phone`, `amount`, `amount_usd`, `exchange_rate`, `currency`, `cause_id`, `message`, `is_anonymous`, `merchant_reference`, `order_tracking_id`, `payment_method`, `confirmation_code`, `payment_status`, `created_at`, `completed_at`, `updated_at`, `ip_address`) VALUES
(1, 'Muhindo Mubaraka', 'mubahood360@gmail.com', '0783204665', 1000.00, NULL, NULL, 'UGX', NULL, 'Just for test', 1, 'ULFA-20260119-FB9C512E', 'cefcada0-ac7a-48b7-bd67-dad474f42d51', 'MTNUG', '37963709468', 'completed', '2026-01-19 22:27:09', '2026-01-20 01:28:04', '2026-01-19 22:28:04', '::1'),
(2, 'Muhindo Mubaraka', 'mubahood360@gmail.com', '0783204665', 1000.00, NULL, NULL, 'USD', 6, 'just for testing', 0, 'ULFA-20260120-7A6F2920', 'bc80c016-3bb5-40e0-a538-dad39b2e93bf', NULL, NULL, 'pending', '2026-01-20 22:54:33', NULL, '2026-01-20 22:54:33', '::1'),
(3, 'Muhindo Mubaraka', 'ulitsug@gmail.com', '0783204665', 1.00, NULL, NULL, 'USD', 6, NULL, 0, 'ULFA-20260121-79E0CF95', '7ca5516b-286a-4723-888b-dad319fa94b2', NULL, NULL, 'pending', '2026-01-21 09:08:48', NULL, '2026-01-21 09:08:48', '::1');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `venue_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue_address` text COLLATE utf8mb4_unicode_ci,
  `registration_required` tinyint(1) DEFAULT '0',
  `registration_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_capacity` int(11) DEFAULT '0',
  `current_registrations` int(11) DEFAULT '0',
  `status` enum('upcoming','ongoing','completed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'upcoming',
  `views` int(11) DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `slug`, `description`, `event_image`, `event_type`, `start_datetime`, `end_datetime`, `venue_name`, `venue_address`, `registration_required`, `registration_link`, `max_capacity`, `current_registrations`, `status`, `views`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'Annual Charity Gala 2026', 'annual-charity-gala-2026', '<p>Join us for Annual Charity Gala 2026. This is an important event that brings our community together to support ULFA\'s mission.</p><p>Registration and more details available on our website.</p>', 'event-2.jpg', 'Fundraiser', '2026-03-14 10:00:00', '2026-03-14 16:00:00', 'ULFA Community Center', '456 Community Avenue', 1, NULL, 200, 0, 'upcoming', 0, 1, '2026-01-18 23:28:27', '2026-01-18 23:55:39'),
(3, 'Community Health Fair', 'community-health-fair', '<p>Join us for Community Health Fair. This is an important event that brings our community together to support ULFA\'s mission.</p><p>Registration and more details available on our website.</p>', 'event-3.jpg', 'Healthcare', '2026-02-21 10:00:00', '2026-02-21 16:00:00', 'ULFA Community Center', '456 Community Avenue', 1, NULL, 200, 0, 'upcoming', 0, 1, '2026-01-18 23:28:27', '2026-01-18 23:55:39'),
(4, 'Education Summit', 'education-summit', '<p>Join us for Education Summit. This is an important event that brings our community together to support ULFA\'s mission.</p><p>Registration and more details available on our website.</p>', 'event-4.jpg', 'Conference', '2026-04-09 10:00:00', '2026-04-09 16:00:00', 'ULFA Community Center', '456 Community Avenue', 1, NULL, 200, 0, 'upcoming', 0, 1, '2026-01-18 23:28:27', '2026-01-18 23:55:39'),
(9, 'School Supply Distribution', 'school-supply-distribution', '<p><strong>Join</strong> us for School Supply Distribution. This is an important event that brings our community together to support ULFA\'s mission.</p>\r\n<p>Registration and more details available on our website.</p>', 'events/img_697001d23008e2.77257809.jpg', 'Fundraiser', '2026-08-14 10:00:00', '2026-08-14 16:00:00', 'ULFA Community Center', '456 Community Avenue', 1, 'https://docs.google.com/forms/d/e/1FAIpQLSe0Wr8v6tdm70poa3A6juDmhy8YtGtOsrxn-zh7QCtoXhLKyg/viewform?usp=publish-editor', 200, 0, 'upcoming', 0, 1, '2026-01-18 23:28:28', '2026-01-20 19:29:38');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `gallery_albums`
--

CREATE TABLE `gallery_albums` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `status` enum('active','hidden') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `image_count` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `gallery_albums`
--

INSERT INTO `gallery_albums` (`id`, `title`, `slug`, `description`, `cover_image`, `category`, `event_id`, `is_featured`, `status`, `image_count`, `views`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Irure optio tempor', 'irure-optio-tempor', '<p>https://youtu.be/7zLncvKIgag Dolore voluptate vel</p>', 'gallery-album-1.jpg', 'Volunteers', 1, 0, 'hidden', 0, 0, 1, '2026-01-18 14:12:59', '2026-01-18 23:55:39'),
(2, 'Velit est quam quos', 'velit-est-quam-quos', 'Inventore perferendi', 'gallery-album-2.jpg', 'Events', 1, 0, 'active', 0, 0, 1, '2026-01-18 14:13:26', '2026-01-18 23:55:39'),
(3, 'Velit est quam quos', 'velit-est-quam-quos-1', 'Inventore perferendi', 'gallery-album-3.jpg', 'Events', 1, 0, 'active', 0, 0, 1, '2026-01-18 14:16:37', '2026-01-18 23:55:39'),
(4, 'Velit est quam quos', 'velit-est-quam-quos-2', 'Inventore perferendi', 'gallery-album-4.jpg', 'Events', 1, 1, 'active', 3, 0, 1, '2026-01-18 14:16:40', '2026-01-18 23:55:39'),
(7, 'Education Programs 2025', 'education-programs-2025', 'Photo collection from Education Programs 2025 showcasing our community impact and volunteer activities.', 'gallery/albums/cover_696ffbab1a3e0.jpeg', 'Events', NULL, 0, 'active', 5, 0, 1, '2026-01-18 23:28:28', '2026-01-20 22:37:43'),
(8, 'Health Fair Events', 'health-fair-events', 'Photo collection from Health Fair Events showcasing our community impact and volunteer activities.', 'gallery/albums/cover_69996f1eb8dc5.jpg', 'Volunteers', NULL, 0, 'active', 3, 0, 1, '2026-01-18 23:28:28', '2026-02-21 05:38:54'),
(10, 'Women Empowerment', 'women-empowerment', 'Photo collection from Women Empowerment showcasing our community impact and volunteer activities.', 'gallery-album-10.jpg', 'Empowerment', NULL, 0, 'active', 0, 0, 1, '2026-01-18 23:28:28', '2026-01-18 23:55:39'),
(11, 'Community Cleanups', 'community-cleanups', 'Photo collection from Community Cleanups showcasing our community impact and volunteer activities.', 'gallery-album-11.jpg', 'Community', NULL, 0, 'active', 0, 0, 1, '2026-01-18 23:28:28', '2026-01-18 23:55:39');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `is_cover` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `album_id`, `image_path`, `thumbnail_path`, `title`, `caption`, `alt_text`, `sort_order`, `is_cover`, `created_at`) VALUES
(7, 4, 'gallery-album-4-img-2.jpg', 'gallery/thumbs/img_696d3e7bbe37e.jpg', 'amina_1_1', NULL, NULL, 2, 0, '2026-01-18 20:11:39'),
(8, 4, 'gallery-album-4-img-3.jpg', 'gallery/thumbs/img_696d4385004e1.jpg', 'product_9', NULL, NULL, 3, 0, '2026-01-18 20:33:09'),
(9, 4, 'gallery-album-4-img-4.jpg', 'gallery/thumbs/img_696d4391d1cfe.png', 'no_image', NULL, NULL, 4, 0, '2026-01-18 20:33:21'),
(15, 8, 'gallery-album-8-img-1.jpg', NULL, 'Photo 1', 'Image 1 from Health Fair Events', NULL, 1, 0, '2026-01-18 23:28:28'),
(16, 8, 'gallery-album-8-img-2.jpg', NULL, 'Photo 2', 'Image 2 from Health Fair Events', NULL, 2, 0, '2026-01-18 23:28:28'),
(25, 10, 'gallery-album-10-img-1.jpg', NULL, 'Photo 1', 'Image 1 from Women Empowerment', NULL, 1, 0, '2026-01-18 23:28:28'),
(26, 10, 'gallery-album-10-img-2.jpg', NULL, 'Photo 2', 'Image 2 from Women Empowerment', NULL, 2, 0, '2026-01-18 23:28:28'),
(27, 10, 'gallery-album-10-img-3.jpg', NULL, 'Photo 3', 'Image 3 from Women Empowerment', NULL, 3, 0, '2026-01-18 23:28:28'),
(28, 10, 'gallery-album-10-img-4.jpg', NULL, 'Photo 4', 'Image 4 from Women Empowerment', NULL, 4, 0, '2026-01-18 23:28:28'),
(29, 10, 'gallery-album-10-img-5.jpg', NULL, 'Photo 5', 'Image 5 from Women Empowerment', NULL, 5, 0, '2026-01-18 23:28:28'),
(30, 11, 'gallery-album-11-img-1.jpg', NULL, 'Photo 1', 'Image 1 from Community Cleanups', NULL, 1, 0, '2026-01-18 23:28:28'),
(31, 11, 'gallery-album-11-img-2.jpg', NULL, 'Photo 2', 'Image 2 from Community Cleanups', NULL, 2, 0, '2026-01-18 23:28:28'),
(32, 11, 'gallery-album-11-img-3.jpg', NULL, 'Photo 3', 'Image 3 from Community Cleanups', NULL, 3, 0, '2026-01-18 23:28:28'),
(33, 11, 'gallery-album-11-img-4.jpg', NULL, 'Photo 4', 'Image 4 from Community Cleanups', NULL, 4, 0, '2026-01-18 23:28:28'),
(34, 11, 'gallery-album-11-img-5.jpg', NULL, 'Photo 5', 'Image 5 from Community Cleanups', NULL, 5, 0, '2026-01-18 23:28:28'),
(50, 7, 'gallery/albums/img_696ffbca7b371.jpg', 'gallery/thumbs/img_696ffbca7b371.jpg', 'The-team-from-Mbale-Regional-Referral-Hospital-and-Busitema-University-receiving-the-equipment-scaled (1)', NULL, NULL, 6, 0, '2026-01-20 22:03:54'),
(51, 7, 'gallery/albums/img_696ffbcf469c8.jpeg', 'gallery/thumbs/img_696ffbcf469c8.jpeg', 'images (17)', NULL, NULL, 7, 0, '2026-01-20 22:03:59'),
(52, 7, 'gallery/albums/img_696ffbe144b93.jpg', 'gallery/thumbs/img_696ffbe144b93.jpg', 'pict_large', NULL, NULL, 8, 0, '2026-01-20 22:04:17'),
(53, 7, 'gallery/albums/img_697003a9bbd74.jpg', 'gallery/thumbs/img_697003a9bbd74.jpg', 'logo (1)', NULL, NULL, 9, 0, '2026-01-20 22:37:29'),
(54, 7, 'gallery/albums/img_697003b1c8d0a.jpg', 'gallery/thumbs/img_697003b1c8d0a.jpg', 'amina_1_1', NULL, NULL, 10, 0, '2026-01-20 22:37:38'),
(56, 8, 'gallery/albums/img_697003dca3074.jpg', 'gallery/thumbs/img_697003dca3074.jpg', 'New-Nursery-Children-2017-640x400', NULL, NULL, 6, 0, '2026-01-20 22:38:20');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `news_posts`
--

CREATE TABLE `news_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci DEFAULT 'draft',
  `views` int(11) DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `news_posts`
--

INSERT INTO `news_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `category`, `tags`, `status`, `views`, `published_at`, `created_at`, `updated_at`) VALUES
(3, 'ULFA Launches New Education Initiative for Underprivileged Children', 'ulfa-launches-new-education-initiative-for-underprivileged-children', 'ULFA (United Love for All) is proud to announce the launch of our comprehensive education initiative designed to transform the lives of underprivileged children. This program will provide free tutorin...', '<p>ULFA (United Love for All) is proud to announce the launch of our comprehensive education initiative designed to transform the lives of underprivileged children. This program will provide free tutoring, school supplies, and mentorship to over 500 students in our first year.</p>\r\n<p>Our dedicated team of volunteers and educators will work closely with local schools to identify students who would benefit most from this program.</p>', 'news/img_6970a0d207b249.18664286.jpeg', 1, 'Stories', '&lt;br /&gt;&lt;b&gt;Deprecated&lt;/b&gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &lt;b&gt;/Applications/MAMP/htdocs/ulfa/admin/news-edit.php&lt;/b&gt; on line &lt;b&gt;243&lt;/b&gt;&lt;br /&gt;', 'published', 0, '2026-01-11 23:16:00', '2026-01-18 23:16:12', '2026-01-21 06:48:02'),
(10, 'Emergency Relief Fund Supports Families After Recent Floods', 'emergency-relief-fund-supports-families-after-recent-floods', 'In response to the recent floods that displaced over 300 families, ULFA has launched an Emergency Relief Fund and mobilized our disaster response team. Within 48 hours, our team established relief cam...', '<p>In response to the recent floods that displaced over 300 families, ULFA has launched an Emergency Relief Fund and mobilized our disaster response team. Within 48 hours, our team established relief camps, distributed emergency supplies, and began coordinating with local authorities.</p>', 'news/img_696ff6c893a446.71030597.jpg', 1, 'News', '&lt;br /&gt;&lt;b&gt;Deprecated&lt;/b&gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &lt;b&gt;/Applications/MAMP/htdocs/ulfa/admin/news-edit.php&lt;/b&gt; on line &lt;b&gt;243&lt;/b&gt;&lt;br /&gt;', 'published', 0, '2026-01-17 23:16:00', '2026-01-18 23:16:28', '2026-01-20 18:42:32'),
(11, 'Education Initiative Launch.', 'education-initiative-launch', 'This is a sample news article about Education Initiative Launch. It provides important information about ULFA&amp;amp;amp;#039;s charitable activities and community impact.', '<p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our <strong><u>communities</u></strong>. asas</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p>This is detailed content for Education Initiative Launch. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p><p><br></p><p><br></p>', 'news/img_696ff3ee00c7a5.84404329.webp', 1, 'News', '&amp;amp;amp;lt;br /&amp;amp;amp;gt;&amp;amp;amp;lt;b&amp;amp;amp;gt;Deprecated&amp;amp;amp;lt;/b&amp;amp;amp;gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &amp;amp;amp;lt;b&amp;amp;amp;gt;/Applications/MAMP/htdocs/ulfa/admin/news-edit.php&amp;amp;amp;lt;/b&amp;amp;amp;gt; on line &amp;amp;amp;lt;b&amp;amp;amp;gt;243&amp;amp;amp;lt;/b&amp;amp;amp;gt;&amp;amp;amp;lt;br /&amp;amp;amp;gt;', 'published', 0, '2026-01-17 23:28:00', '2026-01-18 23:28:27', '2026-02-21 05:38:12'),
(12, 'Community Cleanup Success', 'community-cleanup-success', 'This is a sample news article about Community Cleanup Success. It provides important information about ULFA&amp;#039;s charitable activities and community impact.', '<p>This is detailed content for Community Cleanup Success. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p>\r\n<p>We are committed to serving those in need and creating lasting change in our communities.</p>', 'news/img_696ff744c75927.65815969.webp', 1, 'News', '&amp;lt;br /&amp;gt;&amp;lt;b&amp;gt;Deprecated&amp;lt;/b&amp;gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &amp;lt;b&amp;gt;/Applications/MAMP/htdocs/ulfa/admin/news-edit.php&amp;lt;/b&amp;gt; on line &amp;lt;b&amp;gt;243&amp;lt;/b&amp;gt;&amp;lt;br /&amp;gt;', 'published', 0, '2026-01-16 23:28:00', '2026-01-18 23:28:27', '2026-01-20 19:26:35');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci,
  `setting_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'text',
  `description` text COLLATE utf8mb4_unicode_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `setting_key`, `setting_value`, `setting_type`, `description`, `updated_at`) VALUES
(1, 'site_name', 'United Love for All (ULFA).', 'text', 'Website name', '2026-01-20 22:24:20'),
(2, 'site_email', 'ulfaorphanage@gmail.com', 'text', 'Contact email', '2026-01-21 08:35:30'),
(3, 'site_phone', '+256757689986', 'text', 'Contact phone', '2026-01-21 08:35:30'),
(4, 'site_address', 'Mpondwe Lhubiriha Town Council, Kasese District, Uganda', 'text', 'Physical address', '2026-01-21 08:35:30'),
(5, 'facebook_url', '', 'text', 'Facebook page URL', '2026-01-20 22:24:20'),
(6, 'twitter_url', '', 'text', 'Twitter profile URL', '2026-01-20 22:24:20'),
(7, 'instagram_url', '', 'text', 'Instagram profile URL', '2026-01-20 22:24:20'),
(8, 'youtube_url', '', 'text', 'YouTube channel URL', '2026-01-20 22:24:20'),
(18, 'site_tagline', '', 'text', NULL, '2026-01-20 22:24:20'),
(19, 'site_description', '', 'text', NULL, '2026-01-20 22:24:20'),
(20, 'footer_text', '', 'text', NULL, '2026-01-20 22:24:20'),
(21, 'contact_email', 'ulfaorphanage@gmail.com', 'text', NULL, '2026-01-21 08:35:30'),
(22, 'contact_phone', '+256757689986', 'text', NULL, '2026-01-21 08:35:30'),
(23, 'contact_address', 'P.O. Box 113004, Mpondwe', 'text', NULL, '2026-01-21 08:35:30'),
(27, 'linkedin_url', '', 'text', NULL, '2026-01-20 22:24:20'),
(41, 'pesapal_environment', 'live', 'text', 'Pesapal environment: sandbox or live', '2026-01-20 22:24:20'),
(42, 'pesapal_consumer_key', 'lRkoOQIl7QQc17Ej//RtpRfrq4Z9qzl/', 'text', 'Pesapal Consumer Key', '2026-01-20 22:24:20'),
(43, 'pesapal_consumer_secret', 'AlcvoKfr+Al2nCL9u0AH/eASyTk=', 'text', 'Pesapal Consumer Secret', '2026-01-20 22:24:20'),
(44, 'pesapal_ipn_id', 'f7a190a0-5c93-4c06-a61a-dad4585d85aa', 'text', 'Pesapal IPN Notification ID', '2026-01-20 22:24:20'),
(65, 'site_logo', 'site/logo_1768943539.png', 'text', NULL, '2026-01-20 21:12:19'),
(82, 'site_favicon', 'site/favicon_1768947524.png', 'text', NULL, '2026-01-20 22:18:44'),
(84, 'site_short_name', 'ULFA', 'text', NULL, '2026-01-20 22:24:20'),
(87, 'founding_year', '', 'text', NULL, '2026-01-20 22:24:20'),
(88, 'registration_number', '', 'text', NULL, '2026-01-20 22:24:20'),
(89, 'mission_statement', '', 'text', NULL, '2026-01-20 22:24:20'),
(90, 'vision_statement', '', 'text', NULL, '2026-01-20 22:24:20'),
(91, 'currency_code', 'USD', 'text', NULL, '2026-01-20 22:24:20'),
(92, 'currency_symbol', '$', 'text', NULL, '2026-01-21 08:35:30'),
(93, 'min_donation', '1', 'text', NULL, '2026-01-21 09:07:41'),
(96, 'contact_phone_alt', '', 'text', NULL, '2026-01-20 22:24:20'),
(97, 'whatsapp_number', '+256757689986', 'text', NULL, '2026-01-21 08:35:30'),
(99, 'contact_city', 'Kasese', 'text', NULL, '2026-01-21 08:35:30'),
(100, 'contact_country', 'Uganda', 'text', NULL, '2026-01-20 22:24:20'),
(101, 'google_maps_embed', '', 'text', NULL, '2026-01-20 22:24:20'),
(102, 'office_hours', '', 'text', NULL, '2026-01-20 22:24:20'),
(103, 'office_hours_weekend', '', 'text', NULL, '2026-01-20 22:24:20'),
(104, 'logo_icon_class', 'fas fa-hands-helping', 'text', NULL, '2026-01-20 22:24:20'),
(105, 'primary_color', '#ffc107', 'text', NULL, '2026-01-20 22:24:20'),
(106, 'secondary_color', '#1a1a1a', 'text', NULL, '2026-01-20 22:24:20'),
(108, 'footer_about', '', 'text', NULL, '2026-01-20 22:24:20'),
(109, 'developer_name', '', 'text', NULL, '2026-01-20 22:24:20'),
(110, 'developer_url', '', 'text', NULL, '2026-01-20 22:24:20'),
(116, 'tiktok_url', '', 'text', NULL, '2026-01-20 22:24:20'),
(117, 'whatsapp_default_message', 'Hello, I would like to know more about ULFA.', 'text', NULL, '2026-01-20 22:24:20'),
(122, 'bank_name', '', 'text', NULL, '2026-01-20 22:24:20'),
(123, 'bank_account_name', '', 'text', NULL, '2026-01-20 22:24:20'),
(124, 'bank_account_number', '', 'text', NULL, '2026-01-20 22:24:20'),
(125, 'bank_swift_code', '', 'text', NULL, '2026-01-20 22:24:20'),
(126, 'mobile_money_number', '', 'text', NULL, '2026-01-20 22:24:20'),
(127, 'meta_title', '', 'text', NULL, '2026-01-20 22:24:20'),
(128, 'meta_description', '', 'text', NULL, '2026-01-20 22:24:20'),
(129, 'meta_keywords', '', 'text', NULL, '2026-01-20 22:24:20'),
(130, 'og_title', '', 'text', NULL, '2026-01-20 22:24:20'),
(131, 'og_description', '', 'text', NULL, '2026-01-20 22:24:20'),
(132, 'google_analytics_id', '', 'text', NULL, '2026-01-20 22:24:20'),
(133, 'facebook_pixel_id', '', 'text', NULL, '2026-01-20 22:24:20'),
(134, 'maintenance_message', '', 'text', NULL, '2026-01-20 22:24:20'),
(135, 'notification_email', '', 'text', NULL, '2026-01-20 22:24:20'),
(136, 'custom_head_code', '', 'text', NULL, '2026-01-20 22:24:20'),
(137, 'custom_footer_code', '', 'text', NULL, '2026-01-20 22:24:20'),
(139, 'site_logo_light', 'site/logo_light_1768943539.png', 'text', NULL, '2026-01-20 21:12:19'),
(140, 'maintenance_mode', '0', 'text', NULL, '2026-01-20 22:24:20'),
(141, 'show_donation_popup', '0', 'text', NULL, '2026-01-20 22:24:20'),
(142, 'enable_whatsapp_chat', '1', 'text', NULL, '2026-01-20 22:24:20'),
(143, 'enable_google_analytics', '0', 'text', NULL, '2026-01-20 22:24:20'),
(560, 'usd_to_ugx_rate', '3600', 'text', 'Exchange rate: 1 USD = X UGX', '2026-01-21 08:56:10');

-- --------------------------------------------------------

--

-- --------------------------------------------------------
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` enum('Leadership','Management','Program Staff','Administrative','Volunteers','Advisors') COLLATE utf8mb4_unicode_ci DEFAULT 'Program Staff',
  `bio` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `is_featured` tinyint(1) DEFAULT '0',
  `joined_date` date DEFAULT NULL,
  `social_facebook` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_twitter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_linkedin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` int(11) DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

-- --------------------------------------------------------
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `slug`, `position`, `department`, `bio`, `photo`, `email`, `phone`, `linkedin`, `twitter`, `facebook`, `sort_order`, `is_featured`, `joined_date`, `social_facebook`, `social_twitter`, `social_linkedin`, `display_order`, `status`, `created_at`, `updated_at`) VALUES
(26, 'Muadhi Kisando', NULL, 'Founder & Executive Director', 'Leadership', 'Muadhi Kisando is the visionary founder of ULFA Orphanage. With a deep passion for helping vulnerable children, he established ULFA to provide love, education, and hope to orphaned children in Uganda.', 'team/team_69709ee0b32dc.webp', 'muadhi@ulfaorphanage.com', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, 'active', '2026-01-21 09:34:50', '2026-01-21 06:39:44'),
(27, 'Amina Nabukenya.', 'amina-nabukenya', 'Programs Coordinator', 'Management', 'Amina oversees all educational and welfare programs at ULFA, ensuring every child receives quality care and education. She brings over 8 years of experience in child development.', 'team/amina-nabukenya.jpg', 'amina@ulfaorphanage.com', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 2, 'active', '2026-01-21 09:34:50', '2026-02-21 05:39:11'),
(28, 'Ibrahim Ssekandi', NULL, 'Operations Manager', 'Management', 'Ibrahim manages the day-to-day operations of the orphanage, from logistics to community outreach. His dedication ensures smooth running of all ULFA activities.', 'team/ibrahim-ssekandi.jpg', 'ibrahim@ulfaorphanage.com', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 3, 'active', '2026-01-21 09:34:50', '2026-01-21 09:34:50');

-- --------------------------------------------------------

--

-- Indexes for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_admin_id` (`admin_id`),
  ADD KEY `idx_module` (`module`),
  ADD KEY `idx_created_at` (`created_at`);

--

-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_status` (`status`);

--

-- Indexes for table `causes`
--
ALTER TABLE `causes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `created_by` (`created_by`);

--

-- Indexes for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_subject` (`subject`);

--

-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchant_reference` (`merchant_reference`),
  ADD KEY `idx_donor_email` (`donor_email`),
  ADD KEY `idx_payment_status` (`payment_status`),
  ADD KEY `idx_cause_id` (`cause_id`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_merchant_reference` (`merchant_reference`),
  ADD KEY `idx_order_tracking_id` (`order_tracking_id`);

--

-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `created_by` (`created_by`);

--

-- Indexes for table `gallery_albums`
--
ALTER TABLE `gallery_albums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `created_by` (`created_by`);

--

-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--

-- Indexes for table `news_posts`
--
ALTER TABLE `news_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_published_at` (`published_at`),
  ADD KEY `idx_category` (`category`);
ALTER TABLE `news_posts` ADD FULLTEXT KEY `idx_search` (`title`,`content`);

--

-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`),
  ADD KEY `idx_setting_key` (`setting_key`);

--

-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_display_order` (`display_order`);

--

-- AUTO_INCREMENT for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--

-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--

-- AUTO_INCREMENT for table `causes`
--
ALTER TABLE `causes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--

-- AUTO_INCREMENT for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--

-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--

-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--

-- AUTO_INCREMENT for table `gallery_albums`
--
ALTER TABLE `gallery_albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--

-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--

-- AUTO_INCREMENT for table `news_posts`
--
ALTER TABLE `news_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--

-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=561;

--

-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--

COMMIT;