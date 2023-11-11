-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Kas 2023, 20:01:33
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.0.28

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
  `islem_durumu` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hisseler`
--

INSERT INTO `hisseler` (`id`, `hisse_adi`, `alis_maliyeti`, `guncel_fiyat`, `adet`, `kar_zarar`, `islem_durumu`) VALUES
(1, 'otosan', '10', '20', '100', '10', 0),
(2, 'asdasd', '10', '10', '100', '0', 0),
(3, 'asddd', '101', '201', '1001', '20', 0),
(4, 'fcvv', '101', '201', '1001', '30', 1),
(5, 'ert', '10', '20', '100', '40', 1),
(6, 'mnb', '10', '20', '100', '50', 1),
(7, 'tgb', '10', '20', '100', '60', 1),
(8, 'aer', '10', '20', '100', '70', 1),
(9, 'qwcv', '10', '20', '100', '80', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
