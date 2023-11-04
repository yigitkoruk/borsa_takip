-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 Eki 2023, 22:02:31
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `borsa_takip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hisseler`
--

CREATE TABLE `hisseler` (
  `id` int(11) NOT NULL,
  `hisse_adi` varchar(250) NOT NULL,
  `alis_maliyeti` varchar(250) NOT NULL,
  `guncel_fiyat` varchar(250) NOT NULL,
  `adet` varchar(250) NOT NULL,
  `kar_zarar` varchar(250) NOT NULL,
  `tarih` date NOT NULL,
  `islem_durumu` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hisseler`
--

INSERT INTO `hisseler` (`id`, `hisse_adi`, `alis_maliyeti`, `guncel_fiyat`, `adet`, `kar_zarar`, `tarih`, `islem_durumu`) VALUES
(1, '0', '10', '20', '10', '100', '0000-00-00', 1),
(2, '0', '10', '20', '10', '100', '0000-00-00', 1),
(3, ' thyo', '10', '20', '10', '100', '0000-00-00', 1),
(4, '0', '10', '20', '10', '100', '0000-00-00', 1),
(5, '0', '10', '20', '10', '100', '0000-00-00', 1),
(6, '0', '10', '20', '10', '100', '0000-00-00', 1),
(7, '0', '10', '20', '10', '100', '0000-00-00', 1),
(8, '0', '10', '20', '10', '100', '0000-00-00', 1),
(9, '0', '10', '20', '10', '100', '0000-00-00', 1),
(10, '0', '10', '20', '10', '100', '0000-00-00', 1),
(11, '0', '10', '20', '10', '100', '0000-00-00', 1),
(12, '0', '10', '20', '10', '100', '0000-00-00', 1),
(13, '0', '10', '20', '10', '100', '0000-00-00', 1),
(14, '0', '10', '20', '10', '100', '0000-00-00', 1),
(15, '0', '10', '20', '10', '100', '0000-00-00', 1),
(16, '0', '10', '20', '10', '100', '0000-00-00', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hisseler`
--
ALTER TABLE `hisseler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hisseler`
--
ALTER TABLE `hisseler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
