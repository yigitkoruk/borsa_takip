SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `aylık_karzarar` (
  `id` int(11) NOT NULL,
  `ay` varchar(250) NOT NULL,
  `kar_zarar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `aylık_karzarar` (`id`, `ay`, `kar_zarar`) VALUES
(22, 'November', '428'),
(23, 'November', '856'),
(24, 'November', '856'),
(25, 'November', '856'),
(26, 'November', '856'),
(27, 'November', '856'),
(28, 'November', '856'),
(29, 'November', '856'),
(30, 'November', '856'),
(31, 'November', '856'),
(32, 'November', '1164'),
(33, 'November', '1164'),
(34, 'November', '1164'),
(35, 'November', '1164'),
(36, 'November', '1318');

CREATE TABLE `gunluk_hisse` (
  `id` int(11) NOT NULL,
  `hisse_id` int(11) NOT NULL,
  `alis_maliyeti` varchar(250) NOT NULL,
  `guncel_fiyat` varchar(250) NOT NULL,
  `adet` varchar(250) NOT NULL,
  `kar_zarar` varchar(250) NOT NULL,
  `islem_durumu` tinyint(1) NOT NULL,
  `gun` timestamp NOT NULL DEFAULT current_timestamp(),
  `ay` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gunluk_hisse` (`id`, `hisse_id`, `alis_maliyeti`, `guncel_fiyat`, `adet`, `kar_zarar`, `islem_durumu`, `gun`, `ay`) VALUES
(1180, 8, '10', '13', '10', '30', 0, '2023-11-24 17:56:16', 'November'),
(1181, 9, '10', '14', '10', '40', 0, '2023-11-24 17:56:16', 'November'),
(1182, 10, '10', '15', '10', '50', 0, '2023-11-24 17:56:16', 'November'),
(1183, 11, '10', '16', '10', '60', 0, '2023-11-24 17:56:16', 'November'),
(1184, 6, '10', '11', '10', '10', 0, '2023-11-25 10:17:29', 'November'),
(1185, 7, '10', '12', '12', '24', 0, '2023-11-25 10:17:29', 'November'),
(1186, 8, '10', '13', '10', '30', 0, '2023-11-25 10:17:29', 'November'),
(1187, 9, '10', '14', '10', '40', 0, '2023-11-25 10:17:29', 'November'),
(1188, 10, '10', '15', '10', '50', 0, '2023-11-25 10:17:29', 'November'),
(1189, 6, '10', '11', '10', '10', 0, '2023-11-25 10:18:10', 'November'),
(1190, 7, '10', '12', '12', '24', 0, '2023-11-25 10:18:10', 'November'),
(1191, 8, '10', '13', '10', '30', 0, '2023-11-25 10:18:10', 'November'),
(1192, 9, '10', '14', '10', '40', 0, '2023-11-25 10:18:10', 'November'),
(1193, 10, '10', '15', '10', '50', 0, '2023-11-25 10:18:10', 'November'),
(1194, 6, '10', '11', '10', '10', 0, '2023-11-25 10:20:40', 'November'),
(1195, 7, '10', '12', '12', '24', 0, '2023-11-25 10:20:40', 'November'),
(1196, 8, '10', '13', '10', '30', 0, '2023-11-25 10:20:40', 'November'),
(1197, 9, '10', '14', '10', '40', 0, '2023-11-25 10:20:40', 'November'),
(1198, 10, '10', '15', '10', '50', 0, '2023-11-25 10:20:40', 'November');

CREATE TABLE `hisseler` (
  `id` int(11) NOT NULL,
  `hisse_adi` varchar(250) NOT NULL,
  `alis_maliyeti` varchar(250) NOT NULL,
  `guncel_fiyat` varchar(250) NOT NULL,
  `adet` varchar(250) NOT NULL,
  `kar_zarar` varchar(250) NOT NULL,
  `islem_durumu` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hisseler` (`id`, `hisse_adi`, `alis_maliyeti`, `guncel_fiyat`, `adet`, `kar_zarar`, `islem_durumu`) VALUES
(1, 'otosan', '10', '20', '100', '10', 0),
(2, 'asdasd', '10', '10', '100', '0', 0),
(3, 'asddd', '101', '201', '1001', '20', 0),
(4, 'fcvv', '101', '111', '1001', '30', 0),
(5, 'ert', '10', '111', '100', '40', 0),
(6, 'mnb1', '10', '11', '10', '10', 1),
(7, 'tgb', '10', '12', '12', '24', 1),
(8, 'aer', '10', '13', '10', '30', 1),
(9, 'qwcv', '10', '14', '10', '40', 1),
(10, 'deneme', '10', '15', '10', '50', 1),
(11, 'deneme2', '10', '16', '10', '60', 0);

CREATE TABLE `toplam_gunluk_karzarar` (
  `id` int(11) NOT NULL,
  `kar_zarar` mediumtext NOT NULL,
  `tarih` varchar(250) NOT NULL,
  `ay` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `toplam_gunluk_karzarar` (`id`, `kar_zarar`, `tarih`, `ay`) VALUES
(175, '214', '24', 'November'),
(176, '214', '24', 'November'),
(177, '214', '24', 'November'),
(178, '214', '24', 'November'),
(179, '154', '25', 'November'),
(180, '154', '25', 'November'),
(181, '154', '25', 'November');

ALTER TABLE `aylık_karzarar`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gunluk_hisse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hisse_id` (`hisse_id`);

ALTER TABLE `hisseler`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `toplam_gunluk_karzarar`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `aylık_karzarar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

ALTER TABLE `gunluk_hisse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1199;

ALTER TABLE `hisseler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `toplam_gunluk_karzarar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

ALTER TABLE `gunluk_hisse`
  ADD CONSTRAINT `gunluk_hisse_ibfk_1` FOREIGN KEY (`hisse_id`) REFERENCES `hisseler` (`id`) ON DELETE CASCADE;
COMMIT;
