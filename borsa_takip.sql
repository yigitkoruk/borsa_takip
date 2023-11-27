SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `aylık_karzarar` (
  `id` int(11) NOT NULL,
  `ay` varchar(250) NOT NULL,
  `kar_zarar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `hisseler` (
  `id` int(11) NOT NULL,
  `hisse_adi` varchar(250) NOT NULL,
  `alis_maliyeti` varchar(250) NOT NULL,
  `guncel_fiyat` varchar(250) NOT NULL,
  `adet` varchar(250) NOT NULL,
  `kar_zarar` varchar(250) NOT NULL,
  `islem_durumu` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `toplam_gunluk_karzarar` (
  `id` int(11) NOT NULL,
  `kar_zarar` mediumtext NOT NULL,
  `tarih` varchar(250) NOT NULL,
  `ay` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
