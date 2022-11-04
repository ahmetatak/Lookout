-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: db_server
-- Üretim Zamanı: 04 Kas 2022, 11:25:35
-- Sunucu sürümü: 10.5.9-MariaDB-1:10.5.9+maria~focal
-- PHP Sürümü: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `lookout`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_account`
--

CREATE TABLE `os_account` (
  `account_id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `firebase_id` text DEFAULT NULL,
  `active` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `femail` varchar(100) DEFAULT NULL,
  `pw` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birthday` varchar(25) DEFAULT NULL,
  `rank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `os_account`
--

INSERT INTO `os_account` (`account_id`, `file_id`, `firebase_id`, `active`, `username`, `email`, `femail`, `pw`, `fullname`, `phone`, `birthday`, `rank`) VALUES
(1, 1, '0', 1, 'admin', 'admin@admin.com', 'admn@admin.com', 'd0f0aa62301085065936f671a5ee67db', 'Ahmet ATAK', '00905000000000', '', 'admin'),
(2, NULL, NULL, 1, 'ahmet', 'ahmet@ahmet.com', NULL, '4eb7c5b66e0aad3a1750739933bed2b0', 'ahmet', NULL, NULL, 'user'),
(3, NULL, NULL, 1, 'aakakk', 'dkdkfkf@ddd.ddd', 'dkdkfkf@ddd.ddd', '5d793fc5b00a2348c3fb9ab59e5ca98a', 'aaa', NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_company`
--

CREATE TABLE `os_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_owner` int(11) NOT NULL,
  `company_mail` varchar(255) NOT NULL,
  `company_website` varchar(255) NOT NULL,
  `company_phone` varchar(20) NOT NULL,
  `company_fax` varchar(255) NOT NULL,
  `company_gsm` varchar(20) NOT NULL,
  `company_address` text NOT NULL,
  `company_statu` int(1) NOT NULL,
  `company_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `os_company`
--

INSERT INTO `os_company` (`company_id`, `company_name`, `company_owner`, `company_mail`, `company_website`, `company_phone`, `company_fax`, `company_gsm`, `company_address`, `company_statu`, `company_no`) VALUES
(5, 'Customer Company name', 0, 'dogus@dogus.edu.tr', 'dogus.edu.tr', '055455', '5555555', '0500000', 'aaa', 1, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_device`
--

CREATE TABLE `os_device` (
  `device_id` int(11) NOT NULL,
  `device_access_key` text NOT NULL,
  `device_serial_number` varchar(255) NOT NULL,
  `device_sim_number` varchar(20) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `device_statu` int(1) NOT NULL,
  `device_version` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_employee`
--

CREATE TABLE `os_employee` (
  `employee_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `employee_position` varchar(255) NOT NULL,
  `employee_statu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `os_employee`
--

INSERT INTO `os_employee` (`employee_id`, `company_id`, `account_id`, `employee_position`, `employee_statu`) VALUES
(1, 5, 1, 'driver', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_file`
--

CREATE TABLE `os_file` (
  `file_id` int(11) NOT NULL,
  `file_path` text NOT NULL,
  `file_type` varchar(25) NOT NULL,
  `file_statu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_location`
--

CREATE TABLE `os_location` (
  `location_id` int(11) NOT NULL,
  `location_action` varchar(25) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `location_lat` varchar(255) NOT NULL,
  `location_lon` varchar(255) NOT NULL,
  `location_time` varchar(100) NOT NULL,
  `location_statu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_log`
--

CREATE TABLE `os_log` (
  `log_table` varchar(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `log_data_id` int(11) NOT NULL,
  `log_action` varchar(50) NOT NULL,
  `log_datetime` varchar(50) NOT NULL,
  `log_ip` varchar(255) NOT NULL,
  `log_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `os_log`
--

INSERT INTO `os_log` (`log_table`, `account_id`, `log_data_id`, `log_action`, `log_datetime`, `log_ip`, `log_detail`) VALUES
('account', 1, 1, 'signin', '1667560286', '192.168.224.1', ''),
('account', 1, 1, 'signin', '1667560928', '192.168.240.1', ''),
('account', 1, 2, 'insert', '1667561082', '192.168.240.1', ''),
('account', 1, 3, 'insert', '1667561126', '192.168.240.1', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_permission`
--

CREATE TABLE `os_permission` (
  `permission_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `permission_key` varchar(255) NOT NULL,
  `permission_value` varchar(255) NOT NULL,
  `permission_expire` varchar(30) NOT NULL,
  `permission_statu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `os_permission`
--

INSERT INTO `os_permission` (`permission_id`, `account_id`, `permission_key`, `permission_value`, `permission_expire`, `permission_statu`) VALUES
(1, 1, 'company_display', 'true', '', 1),
(2, 1, 'company_delete', 'true', '', 1),
(3, 1, 'company_add', 'true', '', 1),
(4, 1, 'company_update', 'true', '', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_session`
--

CREATE TABLE `os_session` (
  `account_id` int(11) NOT NULL,
  `expire_time` varchar(30) NOT NULL,
  `access_key` varchar(500) NOT NULL,
  `statu` int(1) NOT NULL,
  `detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_setting`
--

CREATE TABLE `os_setting` (
  `setting_key` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `setting_statu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `os_vehicle`
--

CREATE TABLE `os_vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_access_token` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `vehicle_type` varchar(25) NOT NULL,
  `vehicle_plate_number` varchar(50) NOT NULL,
  `vehicle_serial_number` varchar(255) NOT NULL,
  `vehicle_statu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `os_account`
--
ALTER TABLE `os_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Tablo için indeksler `os_company`
--
ALTER TABLE `os_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Tablo için indeksler `os_device`
--
ALTER TABLE `os_device`
  ADD PRIMARY KEY (`device_id`);

--
-- Tablo için indeksler `os_employee`
--
ALTER TABLE `os_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Tablo için indeksler `os_file`
--
ALTER TABLE `os_file`
  ADD PRIMARY KEY (`file_id`);

--
-- Tablo için indeksler `os_location`
--
ALTER TABLE `os_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Tablo için indeksler `os_permission`
--
ALTER TABLE `os_permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Tablo için indeksler `os_vehicle`
--
ALTER TABLE `os_vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `os_account`
--
ALTER TABLE `os_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `os_company`
--
ALTER TABLE `os_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `os_device`
--
ALTER TABLE `os_device`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `os_employee`
--
ALTER TABLE `os_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `os_file`
--
ALTER TABLE `os_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `os_location`
--
ALTER TABLE `os_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `os_permission`
--
ALTER TABLE `os_permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `os_vehicle`
--
ALTER TABLE `os_vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
