-- phpMyAdmin SQL Dump
-- Rent-A-Car Veritabanı Yapısı

CREATE DATABASE IF NOT EXISTS `rentacar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rentacar`;

-- --------------------------------------------------------

--
-- Tablo yapısı: `kategoriler`
--

CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi: `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `ad`) VALUES
(1, 'Sedan'),
(2, 'SUV'),
(3, 'Hatchback'),
(4, 'Elektrikli');

-- --------------------------------------------------------

--
-- Tablo yapısı: `araclar`
--

CREATE TABLE IF NOT EXISTS `araclar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marka` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `yil` int(11) NOT NULL,
  `gunluk_fiyat` int(11) NOT NULL,
  `yakit` varchar(20) NOT NULL,
  `vites` varchar(20) NOT NULL,
  `gorsel` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `durum` varchar(20) DEFAULT 'Aktif',
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `fk_arac_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategoriler` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi: `araclar`
--

INSERT INTO `araclar` (`id`, `marka`, `model`, `yil`, `gunluk_fiyat`, `yakit`, `vites`, `gorsel`, `kategori_id`, `durum`) VALUES
(1, 'Fiat', 'Egea', 2023, 1200, 'Dizel', 'Manuel', 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500&auto=format&fit=crop&q=60', 1, 'Aktif'),
(2, 'Renault', 'Clio', 2022, 1000, 'Benzin', 'Otomatik', 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=500&auto=format&fit=crop&q=60', 3, 'Aktif'),
(3, 'Peugeot', '3008', 2023, 2200, 'Dizel', 'Otomatik', 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=500&auto=format&fit=crop&q=60', 2, 'Aktif'),
(4, 'Tesla', 'Model Y', 2024, 3800, 'Elektrik', 'Otomatik', 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?w=500&auto=format&fit=crop&q=60', 4, 'Aktif'),
(5, 'Volkswagen', 'Golf', 2022, 1400, 'Benzin', 'Otomatik', 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=500&auto=format&fit=crop&q=60', 3, 'Aktif'),
(6, 'Toyota', 'Corolla', 2023, 1300, 'Hibrit', 'Otomatik', 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=500&auto=format&fit=crop&q=60', 1, 'Aktif'),
(7, 'Dacia', 'Duster', 2021, 1500, 'Dizel', 'Manuel', 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=500&auto=format&fit=crop&q=60', 2, 'Aktif'),
(8, 'Hyundai', 'i20', 2022, 950, 'Benzin', 'Manuel', 'https://images.unsplash.com/photo-1563720223185-11003d516935?w=500&auto=format&fit=crop&q=60', 3, 'Aktif'),
(9, 'Land Rover', 'Range Rover', 2023, 5500, 'Dizel', 'Otomatik', 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=500&auto=format&fit=crop&q=60', 2, 'Aktif'),
(10, 'Mercedes-Benz', 'C-Class', 2022, 2800, 'Benzin', 'Otomatik', 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=500&auto=format&fit=crop&q=60', 1, 'Aktif'),
(11, 'BMW', '5 Series', 2023, 3200, 'Dizel', 'Otomatik', 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=500&auto=format&fit=crop&q=60', 1, 'Aktif'),
(12, 'Audi', 'A3', 2022, 1700, 'Benzin', 'Otomatik', 'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?w=500&auto=format&fit=crop&q=60', 3, 'Aktif');

-- --------------------------------------------------------

--
-- Tablo yapısı: `talepler`
--

CREATE TABLE IF NOT EXISTS `talepler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arac_id` int(11) NOT NULL,
  `ad_soyad` varchar(100) NOT NULL,
  `eposta` varchar(100) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `gun_sayisi` int(11) NOT NULL,
  `toplam_tutar` int(11) NOT NULL DEFAULT 0,
  `alis_tarihi` date NOT NULL,
  `mesaj` text DEFAULT NULL,
  `durum` varchar(20) DEFAULT 'Beklemede',
  `talep_tarihi` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `arac_id` (`arac_id`),
  CONSTRAINT `fk_talep_arac` FOREIGN KEY (`arac_id`) REFERENCES `araclar` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo yapısı: `kullanicilar`
--

CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici_adi` varchar(50) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `eposta` varchar(100) NOT NULL,
  `rol` varchar(20) DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kullanici_adi` (`kullanici_adi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi: `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullanici_adi`, `sifre`, `eposta`, `rol`) VALUES
(1, 'T1B', '$2y$10$AmpMA4YynYsaBOsXOaXmj.6t/Cf6vwLt/8SaIvPd3nLWezGKqSWQ2', 'info@t1b.store', 'admin');

COMMIT;

