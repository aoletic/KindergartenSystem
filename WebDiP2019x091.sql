-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2020 at 10:53 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian8~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2019x091`
--

-- --------------------------------------------------------

--
-- Table structure for table `dijete`
--

CREATE TABLE `dijete` (
  `dijete_id` int(11) NOT NULL,
  `ime_djeteta` varchar(45) COLLATE utf8_bin NOT NULL,
  `prezime_djeteta` varchar(45) COLLATE utf8_bin NOT NULL,
  `godina_rodenja` date NOT NULL,
  `spol` char(10) COLLATE utf8_bin NOT NULL,
  `slika_djeteta` varchar(70) COLLATE utf8_bin NOT NULL,
  `koristenje_podataka` tinyint(1) NOT NULL,
  `prijave_prijave_id` int(11) NOT NULL,
  `vrtic_vrtic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dijete`
--

INSERT INTO `dijete` (`dijete_id`, `ime_djeteta`, `prezime_djeteta`, `godina_rodenja`, `spol`, `slika_djeteta`, `koristenje_podataka`, `prijave_prijave_id`, `vrtic_vrtic_id`) VALUES
(17, 'Marko', 'Markić', '2020-04-08', 'Muško', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 18, 10),
(18, 'Josip', 'Rosandić', '2019-09-10', 'Muško', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 19, 10),
(19, 'Petra', 'Petrić', '2019-08-06', 'Žensko', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 20, 10),
(20, 'Sinan', 'Šakić', '2020-03-11', 'Muško', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 21, 9),
(21, 'Ivana', 'Martinović', '2019-08-20', 'Žensko', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 22, 8),
(22, 'Emil', 'Sarić', '2019-09-16', 'Muško', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 23, 10),
(23, 'Sara', 'Sariž', '2020-04-01', 'Žensko', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 24, 10),
(24, 'Pero', 'Miari', '2019-09-10', 'Muško', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 25, 10),
(25, 'Saša', 'Cohen', '2020-02-14', 'Žensko', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 26, 8),
(26, 'Saša', 'Marić', '2019-12-18', 'Muško', 'http://barka.foi.hr/WebDiP/2019/slika.png', 1, 27, 10),
(31, 'Marko', 'Ivić', '2005-06-06', 'Muško', 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/multimedija/', 1, 19, 10),
(36, 'Ivana', 'Jović', '2005-06-06', 'Žensko', '20200428_155754.jpg', 1, 22, 8);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `radnja` text COLLATE utf8_bin NOT NULL,
  `datum_vrijeme` datetime NOT NULL,
  `korisnik_korisnik_id` int(11) NOT NULL,
  `tip_tip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `radnja`, `datum_vrijeme`, `korisnik_korisnik_id`, `tip_tip_id`) VALUES
(1, 'Kreiranje vrtića Maslačak', '2020-04-16 00:00:00', 1, 1),
(2, 'Kreiranje vrtića Suncokret', '2020-02-19 00:00:00', 1, 1),
(3, 'Kreiranje vrtića Mašta', '2020-01-09 00:00:00', 1, 1),
(4, 'Kreiranje skupine Tigrići', '2020-02-05 00:00:00', 6, 2),
(5, 'Kreiranje skupine Mačkice', '2020-02-13 00:00:00', 8, 2),
(6, 'Kreiranje skupine Zečići', '2020-04-16 00:00:00', 8, 2),
(7, 'Unos djeteta Marko', '2020-04-22 00:00:00', 9, 7),
(8, 'Unos djeteta Silvija', '2020-04-08 00:00:00', 5, 6),
(9, 'Unos djeteta Ivan', '2020-03-05 00:00:00', 4, 6),
(10, 'Unos ocjene za vrtić Maslačak', '2020-02-11 00:00:00', 1, 3),
(11, 'Unos vrtića', '2020-06-15 15:08:06', 7, 1),
(12, 'Izbriši vrtić', '2020-06-15 15:08:29', 7, 18),
(13, 'Pogled popisa prijava', '2020-06-15 15:21:07', 3, 5),
(14, 'Pogled popisa prijava', '2020-06-15 15:37:03', 3, 5),
(18, 'Prijava u sustav', '2020-06-15 16:03:31', 7, 11),
(19, 'Prijava u sustav', '2020-06-15 16:12:16', 7, 11),
(20, 'Evidentirati dolazak', '2020-06-15 16:12:27', 7, 7),
(21, 'Unos ocjene za vrtić', '2020-06-15 16:13:13', 7, 3),
(22, 'Unos skupine', '2020-06-15 00:00:00', 7, 2),
(23, 'Ažuriraj skupinu', '2020-06-15 00:00:00', 7, 20),
(24, 'Izbriši skupinu', '2020-06-15 00:00:00', 7, 21),
(25, 'Kreiraj poziv', '2020-06-15 16:15:15', 7, 13),
(27, 'Kreiraj poziv', '2020-06-15 16:17:38', 7, 13),
(28, 'Prijava u sustav', '2020-06-15 16:24:01', 10, 11),
(29, 'Kreiraj poziv', '2020-06-15 16:24:39', 10, 13),
(30, 'Prijava u sustav', '2020-06-15 16:29:01', 10, 11),
(31, 'Kreiraj poziv', '2020-06-15 00:00:00', 10, 13),
(32, 'Prijava u sustav', '2020-06-15 16:57:52', 7, 11),
(33, 'Prijava u sustav', '2020-06-15 16:58:31', 10, 11),
(34, 'Kreiraj poziv', '2020-06-15 17:07:17', 10, 13),
(35, 'Ažuriraj poziv', '2020-06-15 17:07:42', 10, 26),
(36, 'Ažuriraj poziv', '2020-06-15 17:09:33', 10, 26),
(37, 'Kreiraj poziv', '2020-06-15 17:09:53', 10, 27),
(38, 'Prijava u sustav', '2020-06-15 17:28:12', 7, 11),
(39, 'Prijava u sustav', '2020-06-15 17:44:44', 3, 11),
(40, 'Pogled popisa prijava', '2020-06-15 17:44:56', 3, 5),
(41, 'Pogled popisa prijava', '2020-06-15 17:46:59', 3, 5),
(42, 'Pogled popisa prijava', '2020-06-15 17:49:22', 3, 5),
(43, 'Unos djeteta', '2020-06-15 17:49:45', 3, 6),
(44, 'Pogled popisa prijava', '2020-06-15 17:49:45', 3, 5),
(45, 'Unos djeteta', '2020-06-15 17:50:08', 3, 6),
(46, 'Pogled popisa prijava', '2020-06-15 17:50:08', 3, 5),
(47, 'Unos djeteta', '2020-06-15 18:13:02', 3, 6),
(48, 'Pogled popisa prijava', '2020-06-15 18:13:02', 3, 5),
(49, 'Unos djeteta', '2020-06-15 18:13:08', 3, 6),
(50, 'Pogled popisa prijava', '2020-06-15 18:13:08', 3, 5),
(51, 'Pogled popisa prijava', '2020-06-15 18:13:23', 3, 5),
(52, 'Prijava u sustav', '2020-06-15 18:13:52', 7, 11),
(53, 'Pogled popisa prijava', '2020-06-15 18:14:56', 7, 5),
(54, 'Pogled popisa prijava', '2020-06-15 18:15:00', 7, 5),
(55, 'Pogled popisa prijava', '2020-06-15 18:15:50', 7, 5),
(56, 'Pogled popisa prijava', '2020-06-15 18:16:07', 7, 5),
(57, 'Prijava u sustav', '2020-06-15 18:25:31', 10, 11),
(58, 'Pogled popisa prijava', '2020-06-15 18:29:02', 10, 5),
(59, 'Pogled popisa prijava', '2020-06-15 18:29:05', 10, 5),
(60, 'Pogled popisa prijava', '2020-06-15 18:29:14', 10, 5),
(61, 'Pregledaj račune', '2020-06-15 18:29:17', 10, 30),
(62, 'Prijava u sustav', '2020-06-15 18:29:32', 3, 11),
(63, 'Pogled popisa prijava', '2020-06-15 18:29:43', 3, 5),
(64, 'Pogled popisa prijava', '2020-06-15 18:30:21', 3, 5),
(65, 'Pogled popisa prijava', '2020-06-15 18:30:37', 3, 5),
(66, 'Pregledaj račune', '2020-06-15 18:30:43', 3, 30),
(67, 'Pregledaj račune', '2020-06-15 18:30:51', 3, 30),
(68, 'Prijava u sustav', '2020-06-15 20:08:32', 10, 11),
(69, 'Prijava u sustav', '2020-06-15 20:09:19', 7, 11),
(70, 'Prijava u sustav', '2020-06-15 20:12:15', 7, 11),
(71, 'Prijava u sustav', '2020-06-15 20:27:22', 7, 11),
(72, 'Prijava u sustav', '2020-06-15 23:15:59', 7, 11),
(73, 'Registracija u sustav', '2020-06-16 13:20:02', 75, 14),
(74, 'Prijava u sustav', '2020-06-17 17:48:17', 10, 11),
(75, 'Pogled popisa prijava', '2020-06-17 17:48:26', 10, 5),
(76, 'Pregledaj račune', '2020-06-17 17:48:28', 10, 30),
(77, 'Pregledaj račune', '2020-06-17 17:48:38', 10, 30),
(78, 'Pregledaj račune', '2020-06-17 17:48:40', 10, 30),
(79, 'Pregledaj račune', '2020-06-17 17:48:42', 10, 30),
(80, 'Pregledaj račune', '2020-06-17 17:48:50', 10, 30),
(81, 'Pregledaj račune', '2020-06-17 17:48:53', 10, 30),
(82, 'Pregledaj račune', '2020-06-17 17:49:02', 10, 30),
(83, 'Pregledaj račune', '2020-06-17 17:49:09', 10, 30),
(84, 'Pogled popisa prijava', '2020-06-17 17:49:11', 10, 5),
(85, 'Pregledaj račune', '2020-06-17 17:49:12', 10, 30),
(86, 'Pogled popisa prijava', '2020-06-17 17:49:28', 10, 5),
(87, 'Pregledaj račune', '2020-06-17 17:49:36', 10, 30),
(88, 'Pregledaj račune', '2020-06-17 17:50:03', 10, 30),
(89, 'Pregledaj račune', '2020-06-17 17:50:22', 10, 30),
(90, 'Prijava u sustav', '2020-06-17 17:50:28', 3, 11),
(91, 'Pregledaj račune', '2020-06-17 17:50:31', 3, 30),
(92, 'Pogled popisa prijava', '2020-06-17 17:50:35', 3, 5),
(93, 'Pogled popisa prijava', '2020-06-17 17:50:41', 3, 5),
(94, 'Prijava u sustav', '2020-06-17 17:50:48', 7, 11),
(95, 'Prijava u sustav', '2020-06-17 20:45:36', 10, 11),
(96, 'Pregledaj račune', '2020-06-17 20:45:42', 10, 30),
(97, 'Pregledaj račune', '2020-06-17 20:45:47', 10, 30),
(98, 'Pregledaj račune', '2020-06-17 20:49:25', 10, 30),
(99, 'Prijava u sustav', '2020-06-17 20:49:33', 3, 11),
(100, 'Pogled popisa prijava', '2020-06-17 20:49:38', 3, 5),
(101, 'Registracija u sustav', '2020-06-17 21:24:50', 76, 14),
(102, 'Prijava u sustav', '2020-06-17 21:25:34', 76, 11),
(103, 'Pregledaj račune', '2020-06-17 21:25:46', 76, 30),
(104, 'Slanje prijave za vrtić', '2020-06-17 21:36:29', 76, 4),
(105, 'Pogled popisa prijava', '2020-06-17 21:36:38', 76, 5),
(106, 'Pregledaj račune', '2020-06-17 21:37:36', 76, 30),
(107, 'Pregledaj račune', '2020-06-17 21:37:42', 76, 30),
(108, 'Prijava u sustav', '2020-06-17 21:38:27', 10, 11),
(109, 'Ažuriraj skupinu', '2020-06-17 00:00:00', 10, 20),
(110, 'Kreiraj poziv', '2020-06-17 21:40:07', 10, 13),
(111, 'Pogled popisa prijava', '2020-06-17 21:40:26', 10, 5),
(112, 'Pogled popisa prijava', '2020-06-17 21:40:35', 10, 5),
(113, 'Pogled popisa prijava', '2020-06-17 21:40:37', 10, 5),
(114, 'Pogled popisa prijava', '2020-06-17 21:40:47', 10, 5),
(115, 'Pogled popisa prijava', '2020-06-17 21:40:48', 10, 5),
(116, 'Prihvaćanje prijava', '2020-06-17 21:40:52', 10, 24),
(117, 'Pogled popisa prijava', '2020-06-17 21:40:52', 10, 5),
(118, 'Pogled popisa prijava', '2020-06-17 21:40:54', 10, 5),
(119, 'Pogled popisa prijava', '2020-06-17 21:41:01', 10, 5),
(120, 'Pogled popisa prijava', '2020-06-17 21:41:01', 10, 5),
(121, 'Pogled popisa prijava', '2020-06-17 21:41:04', 10, 5),
(122, 'Pogled popisa prijava', '2020-06-17 21:42:15', 10, 5),
(123, 'Pregledaj račune', '2020-06-17 21:43:43', 10, 30),
(124, 'Pregledaj račune', '2020-06-17 21:43:49', 10, 30),
(125, 'Kreiraj račun', '2020-06-17 21:44:30', 10, 25),
(126, 'Pregledaj račune', '2020-06-17 21:44:37', 10, 30),
(127, 'Pregledaj račune', '2020-06-17 21:44:42', 10, 30),
(128, 'Pregledaj račune', '2020-06-17 21:45:05', 10, 30),
(129, 'Kreiraj račun', '2020-06-17 21:46:07', 10, 25),
(130, 'Pregledaj račune', '2020-06-17 21:46:10', 10, 30),
(131, 'Pregledaj račune', '2020-06-17 21:46:14', 10, 30),
(132, 'Pregledaj račune', '2020-06-17 21:46:41', 10, 30),
(133, 'Prijava u sustav', '2020-06-17 21:46:51', 7, 11),
(134, 'Unos vrtića', '2020-06-17 21:47:34', 7, 1),
(135, 'Dodjeljuje moderatora', '2020-06-17 21:47:47', 7, 8),
(136, 'Dodjeljuje moderatora', '2020-06-17 21:48:03', 7, 8),
(137, 'Kreiraj poziv', '2020-06-17 21:48:30', 7, 13),
(138, 'Izbriši poziv', '2020-06-17 21:52:27', 7, 27),
(139, 'Kreiraj poziv', '2020-06-17 21:52:37', 7, 13),
(140, 'Izbriši poziv', '2020-06-17 21:52:42', 7, 27),
(141, 'Kreiraj poziv', '2020-06-17 21:52:52', 7, 13),
(142, 'Ažuriraj poziv', '2020-06-17 21:53:03', 7, 26),
(143, 'Evidentirati dolazak', '2020-06-17 21:56:49', 7, 7),
(144, 'Evidentirati dolazak', '2020-06-17 21:57:38', 7, 7),
(145, 'Evidentirati dolazak', '2020-06-17 21:57:38', 7, 7),
(146, 'Evidentirati dolazak', '2020-06-17 21:57:39', 7, 7),
(147, 'Evidentirati dolazak', '2020-06-17 21:57:39', 7, 7),
(148, 'Evidentirati dolazak', '2020-06-17 21:57:40', 7, 7),
(149, 'Evidentirati dolazak', '2020-06-17 21:57:40', 7, 7),
(150, 'Evidentirati dolazak', '2020-06-17 21:57:40', 7, 7),
(151, 'Evidentirati dolazak', '2020-06-17 21:57:41', 7, 7),
(152, 'Evidentirati dolazak', '2020-06-17 21:58:22', 7, 7),
(153, 'Evidentirati dolazak', '2020-06-17 21:58:23', 7, 7),
(154, 'Evidentirati dolazak', '2020-06-17 21:58:23', 7, 7),
(155, 'Evidentirati dolazak', '2020-06-17 21:59:42', 7, 7),
(156, 'Evidentirati dolazak', '2020-06-17 21:59:43', 7, 7),
(157, 'Evidentirati dolazak', '2020-06-17 22:00:03', 7, 7),
(158, 'Evidentirati dolazak', '2020-06-17 22:00:14', 7, 7),
(159, 'Evidentirati dolazak', '2020-06-17 22:00:15', 7, 7),
(160, 'Evidentirati dolazak', '2020-06-17 22:00:15', 7, 7),
(161, 'Evidentirati dolazak', '2020-06-17 22:00:16', 7, 7),
(162, 'Evidentirati dolazak', '2020-06-17 22:00:40', 7, 7),
(163, 'Evidentirati dolazak', '2020-06-17 22:00:41', 7, 7),
(164, 'Evidentirati dolazak', '2020-06-17 22:00:41', 7, 7),
(165, 'Evidentirati dolazak', '2020-06-17 22:03:08', 7, 7),
(166, 'Kreiraj račun', '2020-06-17 22:03:23', 7, 25),
(167, 'Unos skupine', '2020-06-17 00:00:00', 7, 2),
(168, 'Izbriši skupinu', '2020-06-17 00:00:00', 7, 21),
(169, 'Izbriši poziv', '2020-06-17 22:05:09', 7, 27),
(170, 'Prijava u sustav', '2020-06-17 22:10:34', 10, 11),
(171, 'Pregledaj račune', '2020-06-17 22:10:42', 10, 30),
(172, 'Pregledaj račune', '2020-06-17 22:12:28', 10, 30),
(173, 'Prijava u sustav', '2020-06-17 22:12:45', 7, 11),
(174, 'Prijava u sustav', '2020-06-17 22:13:36', 7, 11),
(175, 'Prijava u sustav', '2020-06-17 22:14:34', 7, 11),
(176, 'Prijava u sustav', '2020-06-17 22:15:04', 7, 11),
(177, 'Prijava u sustav', '2020-06-17 22:16:05', 7, 11),
(178, 'Prijava u sustav', '2020-06-17 22:16:49', 7, 11),
(179, 'Prijava u sustav', '2020-06-17 22:18:28', 7, 11),
(180, 'Pregledaj račune', '2020-06-17 22:18:48', 7, 30),
(181, 'Prijava u sustav', '2020-06-17 22:19:09', 7, 11),
(182, 'Pregledaj račune', '2020-06-17 22:19:16', 7, 30),
(183, 'Pregledaj račune', '2020-06-17 22:19:18', 7, 30),
(184, 'Pregledaj račune', '2020-06-17 22:19:40', 7, 30),
(185, 'Pregledaj račune', '2020-06-17 22:19:44', 7, 30),
(186, 'Pregledaj račune', '2020-06-17 22:20:16', 7, 30),
(187, 'Pregledaj račune', '2020-06-17 22:21:41', 7, 30),
(188, 'Pregledaj račune', '2020-06-17 22:21:45', 7, 30),
(189, 'Pregledaj račune', '2020-06-17 22:22:08', 7, 30),
(190, 'Pregledaj račune', '2020-06-17 22:22:25', 7, 30),
(191, 'Pregledaj račune', '2020-06-17 22:22:48', 7, 30),
(192, 'Pregledaj račune', '2020-06-17 22:22:55', 7, 30);

-- --------------------------------------------------------

--
-- Table structure for table `dolasci`
--

CREATE TABLE `dolasci` (
  `dolazak_id` int(11) NOT NULL,
  `datum_dolaska` date NOT NULL,
  `doslo` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT 'da',
  `dijete_dijete_id` int(11) NOT NULL,
  `korisnik_korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dolasci`
--

INSERT INTO `dolasci` (`dolazak_id`, `datum_dolaska`, `doslo`, `dijete_dijete_id`, `korisnik_korisnik_id`) VALUES
(1, '2020-06-01', 'da', 17, 10),
(2, '2020-06-02', 'da', 17, 10),
(3, '2020-06-03', 'da', 17, 10),
(4, '2020-06-04', 'da', 17, 10),
(5, '2020-06-05', 'da', 19, 10),
(6, '2020-06-06', 'da', 19, 10),
(7, '2020-06-07', 'ne', 19, 10),
(8, '2020-06-08', 'da', 19, 10),
(9, '2020-06-09', 'ne', 17, 10),
(10, '2020-06-10', 'ne', 19, 10),
(11, '2020-06-14', 'da', 17, 10),
(12, '2020-06-14', 'da', 17, 10),
(18, '2020-06-15', 'da', 31, 10),
(19, '2020-06-16', 'ne', 31, 10),
(20, '2020-06-17', 'da', 31, 10),
(21, '2020-06-18', 'ne', 31, 10),
(22, '2020-06-19', 'da', 31, 10),
(23, '2020-06-15', 'ne', 23, 7),
(26, '2020-06-14', 'da', 20, 7);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `ime` varchar(45) COLLATE utf8_bin NOT NULL,
  `prezime` varchar(45) COLLATE utf8_bin NOT NULL,
  `korisnicko_ime` varchar(25) COLLATE utf8_bin NOT NULL,
  `email` varchar(45) COLLATE utf8_bin NOT NULL,
  `lozinka` varchar(25) COLLATE utf8_bin NOT NULL,
  `lozinka_sha1` varchar(40) COLLATE utf8_bin NOT NULL,
  `pogreska_lozinka` int(11) NOT NULL DEFAULT '0',
  `uvjeti` datetime DEFAULT NULL,
  `aktivacijski_kod` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `verificiran` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT 'ne',
  `uloga_uloga_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka`, `lozinka_sha1`, `pogreska_lozinka`, `uvjeti`, `aktivacijski_kod`, `verificiran`, `uloga_uloga_id`) VALUES
(1, 'Marko', 'Marulić', 'mmarulic', 'mmarulic@gmail.com', 'asdfasdfeq', '520b47d38b099303accde8ced5470994f126f660', 0, '2020-04-08 00:00:00', NULL, 'da', 1),
(2, 'Ivana', 'Ikić', 'iikic', 'iikic@gmail.com', 'asdASFGs', '3ebf13a93d16209bedfcead516c18bfcdf4ddfe1', 0, '2020-04-02 00:00:00', NULL, 'da', 3),
(3, 'Josip', 'Peric', 'jperic', 'jperic@yahoo.com', 'asdfasdfa', '1b6d20788dea279d8156c9dbe6bec46c96316e87', 0, '2020-04-10 00:00:00', NULL, 'da', 3),
(4, 'Antonio', 'Saski', 'asaski', 'asaski@yahoo.com', 'adfasdfyxcv', '513d0ca53e491caf693f769b03eab6864f5758a8', 0, '2020-04-09 14:15:14', NULL, 'da', 3),
(5, 'Sladana', 'Radojkovic', 'sradojko', 'sladana@gmail.com', 'sladana123', 'c30f597860a7b39342ca5f226ff021861a4dc131', 5, '2020-04-02 03:13:15', NULL, 'da', 3),
(6, 'Mirko', 'Filipovic', 'mfilipovic', 'mfilipovic@gmail.com', 'mirkoheehe', 'ccffc34c8cbb5eb9f945a7720a0a57da435e2837', 0, '2020-04-09 05:10:19', NULL, 'da', 2),
(7, 'Jovan', 'Sipic', 'jsipic', 'jsipic@gmail.com', 'jole1234', '3070cd13faf993d6e640f41ae3621265dc4012b9', 0, '2020-04-02 06:24:21', NULL, 'da', 1),
(8, 'Ivan', 'Parac', 'iparac', 'iparac@net.hr', 'gljivo1234', '265732277f41923ed770dc01c2118bf4ac205113', 0, '2020-04-02 05:14:07', NULL, 'da', 2),
(9, 'Jole', 'Jolic', 'joljolic', 'joljolic@gmail.com', 'jolethebest', 'fc77b0a6701a2b47578c66cd8565e5b7ec0c958e', 0, '2020-04-02 00:00:00', NULL, 'da', 3),
(10, 'Mirjana', 'Mahnet', 'mmahnet', 'mmahnet@gmail.com', 'miremalamoja', '18f61db9a589c41e15db3c9a921afb55ecb658db', 0, '2020-04-08 00:00:00', NULL, 'da', 2),
(11, 'Marko', 'Josipović', 'mjosip', 'mjosipovic@gmail.com', 'Pazizebra1*', '02d6df0b7c2af0ef962a89a85de949ba459739a5', 0, NULL, NULL, 'da', NULL),
(12, 'Filip', 'Tonkic', 'ftonkic', 'ftonkic@net.hr', 'Tonkic1?2', '7ba02aae78ef6d101e99ad95c44ec453b70905d5', 0, NULL, NULL, 'da', NULL),
(13, 'Test', 'Testić', 'test123', 'ttest@gmail.com', 'Test123?', '3220691f9a9dfcfdbfba44a271de3bf26f74c793', 0, NULL, NULL, 'da', NULL),
(14, 'test', 'Testovica', 'TTest', 'ttestv@gmail.com', 'Test123?', '3220691f9a9dfcfdbfba44a271de3bf26f74c793', 0, NULL, NULL, 'da', NULL),
(15, 'asdf', 'Testić', 'Asd', 'asd@gmail.com', 'Haha123?', '7e4ea5492197d485c8abdc5355c8ec5243ac0794', 0, NULL, NULL, 'da', NULL),
(16, 'Test', 'Testina', 'ttestina', 'ttestina@yahoo.com', 'Test123?*', '1f99882dcdeccc25dbd7e411467064cb99f6dcfa', 0, NULL, '2987a05042dfcb16145775d3ae002c0f', 'ne', 3),
(37, 'Test', 'Testa', 'ttesta', 'ttesta@yahoo.com', 'Test1234?*', 'cb707f89c01d21b0ad60998242fc1eb5ff38c09b', 2, NULL, 'e063cfa586229b094c57429656590c87', 'ne', 3),
(61, 'Test', 'Testov', 'ttestovkha', 'morshed.khaled@fromlitic.', 'Test123?*', '1f99882dcdeccc25dbd7e411467064cb99f6dcfa', 0, NULL, '4568c2a23e835c68f76612b6694e68e5', 'ne', 3),
(62, 'Qua', 'Ad', 'QUaad', 'qoualihoudayfa6@52964.xyz', 'Pazi123?*', 'f3302f7a2b9fe4969f6a46aa6f0593fdab766a94', 0, NULL, 'b0af5585a9ea807903c8e990b8830444', 'da', 3),
(66, 'Tomislav', 'Musić', 'tmusic', 'tmusic@foi.hr', 'Branko123&', '4054370c27d81b8959c3024c62f44b58bc5c3ffb', 0, NULL, '9570d410bc159ce7d5fdb519adaf216a', 'da', 3),
(69, 'Marko', 'Testre', 'mtester', 'mtester@gmail.com', 'Pazi123?*', 'f3302f7a2b9fe4969f6a46aa6f0593fdab766a94', 3, NULL, '1f27bbf75a679ba4e67435a031ffdf3f', 'ne', 3),
(74, 'Lady', 'Gaga', 'lgaga', '6sifa07080@getlesshot.ml', 'w9VDg1yr', '82e7ae1646e7b41d306f2f8497f26192e09b50b3', 5, NULL, 'f3c9ddb06a85965e42f5d3815a76518c', 'da', 3),
(76, 'Generalna', 'Proba', 'gproba', 'ldjrowenny.t@yvvdt.site', 'Proba123?', 'edf1a93be583041ae1014d33e8e232d225ffd1aa', 0, NULL, '590e1e6aa2f3578555305fc778a45472', 'da', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lista_cekanja`
--

CREATE TABLE `lista_cekanja` (
  `lista_cekanja_id` int(11) NOT NULL,
  `prijave_prijave_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lista_cekanja`
--

INSERT INTO `lista_cekanja` (`lista_cekanja_id`, `prijave_prijave_id`) VALUES
(4, 4),
(1, 5),
(2, 6),
(3, 10),
(5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `ocjena_vrtica`
--

CREATE TABLE `ocjena_vrtica` (
  `ocjena_vrtica_id` int(11) NOT NULL,
  `ocjena` int(11) NOT NULL,
  `ocjena_mjesec` date NOT NULL,
  `vrtic_vrtic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ocjena_vrtica`
--

INSERT INTO `ocjena_vrtica` (`ocjena_vrtica_id`, `ocjena`, `ocjena_mjesec`, `vrtic_vrtic_id`) VALUES
(1, 5, '2020-06-05', 4),
(2, 5, '2020-07-09', 3),
(3, 5, '2019-10-16', 10),
(4, 5, '2019-11-14', 10),
(5, 4, '2019-12-19', 5),
(6, 4, '2020-01-09', 2),
(7, 4, '2020-02-12', 1),
(8, 2, '2019-09-11', 5),
(9, 2, '2019-04-03', 6),
(10, 5, '2019-04-17', 1),
(12, 4, '2019-10-15', 1),
(13, 4, '2019-10-15', 1),
(14, 3, '2020-03-19', 4),
(15, 4, '2020-01-14', 4),
(16, 5, '2020-06-09', 4),
(17, 4, '2020-01-07', 3),
(18, 5, '2019-11-21', 3),
(19, 5, '2019-09-18', 10),
(20, 2, '2019-09-17', 5),
(21, 4, '2020-05-20', 5),
(22, 3, '2020-03-12', 2),
(23, 4, '2020-01-15', 2),
(24, 1, '2020-05-13', 6),
(25, 2, '2020-04-15', 6),
(26, 3, '2020-03-19', 4),
(27, 4, '2020-01-14', 4),
(28, 5, '2020-06-09', 4),
(29, 4, '2020-01-07', 3),
(30, 5, '2019-11-21', 3),
(31, 5, '2019-09-18', 10),
(32, 2, '2019-09-17', 5),
(33, 4, '2020-05-20', 5),
(34, 3, '2020-03-12', 2),
(35, 4, '2020-01-15', 2),
(36, 1, '2020-05-13', 6),
(39, 9, '2020-06-15', 7);

-- --------------------------------------------------------

--
-- Table structure for table `prijave`
--

CREATE TABLE `prijave` (
  `prijave_id` int(11) NOT NULL,
  `upisi_upisi_id` int(11) NOT NULL,
  `korisnik_korisnik_id` int(11) NOT NULL,
  `prihvacen` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT 'ne',
  `upisan` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT 'ne'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `prijave`
--

INSERT INTO `prijave` (`prijave_id`, `upisi_upisi_id`, `korisnik_korisnik_id`, `prihvacen`, `upisan`) VALUES
(18, 7, 2, 'da', 'ne'),
(19, 9, 3, 'da', 'da'),
(20, 5, 4, 'da', 'ne'),
(21, 6, 4, 'ne', 'ne'),
(22, 10, 3, 'da', 'da'),
(23, 9, 2, 'ne', 'ne'),
(24, 8, 2, 'ne', 'ne'),
(25, 7, 5, 'ne', 'ne'),
(26, 10, 5, 'ne', 'ne'),
(27, 9, 9, 'ne', 'ne'),
(28, 23, 3, 'ne', 'ne'),
(29, 23, 76, 'ne', 'ne');

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `racun_id` int(11) NOT NULL,
  `datum_vrijeme` datetime NOT NULL,
  `iznos` float NOT NULL,
  `placen` tinyint(1) NOT NULL,
  `vrtic_vrtic_id` int(11) NOT NULL,
  `korisnik_korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`racun_id`, `datum_vrijeme`, `iznos`, `placen`, `vrtic_vrtic_id`, `korisnik_korisnik_id`) VALUES
(1, '2020-04-09 05:11:07', 500, 1, 3, 3),
(2, '2020-04-10 00:00:00', 600, 0, 5, 5),
(3, '2020-03-03 00:00:00', 400, 1, 3, 2),
(4, '2020-03-19 00:00:00', 650, 1, 2, 2),
(5, '2020-01-16 00:00:00', 600, 1, 1, 2),
(6, '2019-11-14 00:00:00', 450, 1, 6, 4),
(7, '2019-12-19 00:00:00', 600, 1, 6, 4),
(8, '2020-01-02 00:00:00', 300, 0, 6, 4),
(9, '2020-02-20 00:00:00', 600, 1, 3, 5),
(10, '2020-05-14 04:07:09', 600, 0, 2, 4),
(11, '2020-06-14 18:14:41', 590, 0, 10, 2),
(14, '2020-06-14 18:49:18', 650, 0, 10, 3),
(15, '2020-06-17 00:00:00', 600, 0, 10, 4),
(16, '2020-06-17 00:00:00', 600, 0, 10, 4),
(17, '2020-06-17 00:00:00', 580, 0, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skupina`
--

CREATE TABLE `skupina` (
  `skupina_id` int(11) NOT NULL,
  `naziv_skupine` varchar(45) COLLATE utf8_bin NOT NULL,
  `cijena_skupine` float NOT NULL,
  `vrtic_vrtic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `skupina`
--

INSERT INTO `skupina` (`skupina_id`, `naziv_skupine`, `cijena_skupine`, `vrtic_vrtic_id`) VALUES
(1, 'Pandice', 500, 6),
(2, 'Leptirići', 500, 6),
(3, 'Žirafice', 550, 8),
(4, 'Pilići', 600, 6),
(5, 'Mačke', 500, 10),
(6, 'Trigrići', 620, 6),
(7, 'Veprići', 650, 8),
(8, 'Lavići', 610, 10),
(9, 'Zebrice', 620, 10),
(10, 'Zečići', 700, 8),
(11, 'Šišmiši', 600, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tip`
--

CREATE TABLE `tip` (
  `tip_id` int(11) NOT NULL,
  `naziv_tipa` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tip`
--

INSERT INTO `tip` (`tip_id`, `naziv_tipa`) VALUES
(1, 'Unos vrtića'),
(2, 'Unos skupine'),
(3, 'Unos ocjene za vrtić'),
(4, 'Slanje prijave za vrtić'),
(5, 'Pogled popisa prijava'),
(6, 'Unos djeteta'),
(7, 'Evidentirati dolazak'),
(8, 'Dodjeljuje moderatora'),
(9, 'Gledanje ukupnog broja djece'),
(11, 'Prijava u sustav'),
(12, 'Odjava iz sustava'),
(13, 'Kreiraj poziv'),
(14, 'Registracija u sustav'),
(15, 'Otključaj korisnika'),
(16, 'Zaključaj korisnika'),
(17, 'Ažuriraj vrtić'),
(18, 'Izbriši vrtić'),
(19, 'Izbriši moderatora'),
(20, 'Ažuriraj skupinu'),
(21, 'Izbriši skupinu'),
(22, 'Ažuriraj ocjenu'),
(23, 'Izbriši ocjenu'),
(24, 'Prihvaćanje prijava'),
(25, 'Kreiraj račun'),
(26, 'Ažuriraj poziv'),
(27, 'Izbriši poziv'),
(29, 'Generirana nova lozinka'),
(30, 'Pregledaj račune');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `uloga_id` int(11) NOT NULL,
  `naziv_uloge` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`uloga_id`, `naziv_uloge`) VALUES
(1, 'Administrator'),
(2, 'Voditelj'),
(3, 'Roditelj');

-- --------------------------------------------------------

--
-- Table structure for table `upisi`
--

CREATE TABLE `upisi` (
  `upisi_id` int(11) NOT NULL,
  `broj_mjesta` int(11) NOT NULL,
  `skupina_skupina_id` int(11) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date NOT NULL,
  `korisnik_korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `upisi`
--

INSERT INTO `upisi` (`upisi_id`, `broj_mjesta`, `skupina_skupina_id`, `datum_od`, `datum_do`, `korisnik_korisnik_id`) VALUES
(1, 14, 3, '2020-04-01', '2020-04-09', 6),
(2, 10, 4, '2020-04-01', '2020-04-23', 6),
(3, 7, 5, '2020-03-11', '2020-04-23', 8),
(4, 25, 6, '2020-02-22', '2020-02-29', 8),
(5, 7, 9, '2019-12-10', '2019-12-19', 10),
(6, 9, 1, '2019-12-12', '2020-04-24', 10),
(7, 8, 4, '2020-03-02', '2020-03-25', 10),
(8, 40, 8, '2019-09-03', '2019-09-11', 10),
(9, 15, 7, '2019-12-12', '2019-12-19', 8),
(10, 4, 5, '2020-04-08', '2020-04-22', 8),
(11, 30, 5, '2020-07-13', '2020-08-13', 10),
(12, 37, 5, '2020-07-15', '2020-08-13', 10),
(13, 35, 5, '2020-07-13', '2020-08-13', 10),
(22, 37, 5, '2019-05-06', '2019-05-06', 10),
(23, 14, 3, '2020-06-10', '2020-06-25', 10),
(24, 16, 5, '2020-07-15', '2020-05-05', 7),
(25, 16, 5, '2020-07-15', '2020-05-05', 7),
(26, 59, 6, '2020-07-13', '2020-08-13', 7),
(28, 51, 9, '2019-05-06', '2019-05-06', 10),
(32, 7, 5, '2020-07-15', '2020-08-13', 10);

-- --------------------------------------------------------

--
-- Table structure for table `vrtic`
--

CREATE TABLE `vrtic` (
  `vrtic_id` int(11) NOT NULL,
  `naziv_vrtica` varchar(45) COLLATE utf8_bin NOT NULL,
  `adresa_vrtica` varchar(45) COLLATE utf8_bin NOT NULL,
  `korisnik_korisnik_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vrtic`
--

INSERT INTO `vrtic` (`vrtic_id`, `naziv_vrtica`, `adresa_vrtica`, `korisnik_korisnik_id`) VALUES
(1, 'Maslačak', 'Poljska 7', NULL),
(2, 'Leptirić', 'Poljska 8', 7),
(3, 'Kokoška', 'Poljska 9', 1),
(4, 'Velika djeca', 'Poljska 10', 1),
(5, 'Corgi', 'Poljska 7', 7),
(6, 'Mašta', 'Poljska 2', 7),
(7, 'Jež', 'Poljska 3', 7),
(8, 'Srnica', 'Poljska 34', 7),
(9, 'Frulica', 'Poljska 37', 1),
(10, 'Trav', 'Poljska 40', 10),
(17, 'Mrav', 'Poljska 40', NULL),
(18, 'Leptirić', 'Dunajska 7', NULL),
(20, 'Ljenjivci', 'Ljenjivci 49', 76);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dijete`
--
ALTER TABLE `dijete`
  ADD PRIMARY KEY (`dijete_id`),
  ADD KEY `fk_dijete_prijave1_idx` (`prijave_prijave_id`),
  ADD KEY `fk_dijete_vrtic` (`vrtic_vrtic_id`);

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`,`korisnik_korisnik_id`,`tip_tip_id`),
  ADD KEY `fk_dnevnik_korisnik1_idx` (`korisnik_korisnik_id`),
  ADD KEY `fk_dnevnik_tip1_idx` (`tip_tip_id`);

--
-- Indexes for table `dolasci`
--
ALTER TABLE `dolasci`
  ADD PRIMARY KEY (`dolazak_id`),
  ADD KEY `fk_dolasci_korisnik1_idx` (`korisnik_korisnik_id`),
  ADD KEY `fk_dolasci_dijete` (`dijete_dijete_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD KEY `fk_korisnik_uloga_idx` (`uloga_uloga_id`);

--
-- Indexes for table `lista_cekanja`
--
ALTER TABLE `lista_cekanja`
  ADD PRIMARY KEY (`lista_cekanja_id`),
  ADD KEY `fk_lista_cekanja_prijave1_idx` (`prijave_prijave_id`);

--
-- Indexes for table `ocjena_vrtica`
--
ALTER TABLE `ocjena_vrtica`
  ADD PRIMARY KEY (`ocjena_vrtica_id`,`vrtic_vrtic_id`),
  ADD KEY `fk_ocjena_vrtica_vrtic1_idx` (`vrtic_vrtic_id`);

--
-- Indexes for table `prijave`
--
ALTER TABLE `prijave`
  ADD PRIMARY KEY (`prijave_id`),
  ADD KEY `fk_prijave_upisi1_idx` (`upisi_upisi_id`),
  ADD KEY `korisnik_korisnik_id` (`korisnik_korisnik_id`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`racun_id`),
  ADD KEY `fk_racun_korisnik1_idx` (`korisnik_korisnik_id`),
  ADD KEY `vrtic_vrtic_id` (`vrtic_vrtic_id`);

--
-- Indexes for table `skupina`
--
ALTER TABLE `skupina`
  ADD PRIMARY KEY (`skupina_id`,`vrtic_vrtic_id`),
  ADD KEY `fk_skupina_vrtic1` (`vrtic_vrtic_id`);

--
-- Indexes for table `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`uloga_id`);

--
-- Indexes for table `upisi`
--
ALTER TABLE `upisi`
  ADD PRIMARY KEY (`upisi_id`,`korisnik_korisnik_id`),
  ADD KEY `fk_upisi_korisnik1_idx` (`korisnik_korisnik_id`),
  ADD KEY `skupina_skupina_id` (`skupina_skupina_id`);

--
-- Indexes for table `vrtic`
--
ALTER TABLE `vrtic`
  ADD PRIMARY KEY (`vrtic_id`),
  ADD KEY `fk_vrtic_korisnik1_idx` (`korisnik_korisnik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dijete`
--
ALTER TABLE `dijete`
  MODIFY `dijete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
--
-- AUTO_INCREMENT for table `dolasci`
--
ALTER TABLE `dolasci`
  MODIFY `dolazak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `lista_cekanja`
--
ALTER TABLE `lista_cekanja`
  MODIFY `lista_cekanja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ocjena_vrtica`
--
ALTER TABLE `ocjena_vrtica`
  MODIFY `ocjena_vrtica_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `prijave`
--
ALTER TABLE `prijave`
  MODIFY `prijave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `racun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `skupina`
--
ALTER TABLE `skupina`
  MODIFY `skupina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tip`
--
ALTER TABLE `tip`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `uloga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `upisi`
--
ALTER TABLE `upisi`
  MODIFY `upisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `vrtic`
--
ALTER TABLE `vrtic`
  MODIFY `vrtic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dijete`
--
ALTER TABLE `dijete`
  ADD CONSTRAINT `fk_dijete_prijave1` FOREIGN KEY (`prijave_prijave_id`) REFERENCES `prijave` (`prijave_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dijete_vrtic` FOREIGN KEY (`vrtic_vrtic_id`) REFERENCES `vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik1` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dnevnik_tip1` FOREIGN KEY (`tip_tip_id`) REFERENCES `tip` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dolasci`
--
ALTER TABLE `dolasci`
  ADD CONSTRAINT `fk_dolasci_korisnik1` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`uloga_uloga_id`) REFERENCES `uloga` (`uloga_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lista_cekanja`
--
ALTER TABLE `lista_cekanja`
  ADD CONSTRAINT `fk_lista_cekanja_prijave1` FOREIGN KEY (`prijave_prijave_id`) REFERENCES `prijave` (`prijave_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ocjena_vrtica`
--
ALTER TABLE `ocjena_vrtica`
  ADD CONSTRAINT `fk_ocjena_vrtica_vrtic1` FOREIGN KEY (`vrtic_vrtic_id`) REFERENCES `vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prijave`
--
ALTER TABLE `prijave`
  ADD CONSTRAINT `fk_prijave_korisnik` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prijave_upisi1` FOREIGN KEY (`upisi_upisi_id`) REFERENCES `upisi` (`upisi_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `fk_racun_vrtic` FOREIGN KEY (`vrtic_vrtic_id`) REFERENCES `vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_racun_korisnik1` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skupina`
--
ALTER TABLE `skupina`
  ADD CONSTRAINT `fk_skupina_vrtic1` FOREIGN KEY (`vrtic_vrtic_id`) REFERENCES `vrtic` (`vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `upisi`
--
ALTER TABLE `upisi`
  ADD CONSTRAINT `fk_upisi_skupina` FOREIGN KEY (`skupina_skupina_id`) REFERENCES `skupina` (`skupina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_upisi_korisnik1` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vrtic`
--
ALTER TABLE `vrtic`
  ADD CONSTRAINT `fk_vrtic_korisnik1` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
