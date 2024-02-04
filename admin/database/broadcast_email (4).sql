-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 28, 2020 at 12:17 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `broadcast_email`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '$2y$10$gn5rjD/9EhJvzrrF1q22jeIzc.A9zVbjsXBhfnCUXUyo2cujPMXsS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_pangkat` int(11) DEFAULT NULL,
  `nrp` char(20) DEFAULT NULL,
  `nama` char(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `id_jabatan`, `id_pangkat`, `nrp`, `nama`, `email`) VALUES
(5, 12, 3, '12617/P', 'Muhammad Nizar Gadafi, S.E.', ''),
(6, 20, 17, '11970045320776', 'Fransiscus Ari Susetio, S.E.', ''),
(7, 13, 17, '11960039640274', 'Slamet Riadi, S.I.P.', ''),
(8, 21, 2, '523339', 'R. Endri Kargono', ''),
(9, 30, 3, '13292/P', 'Wahyu Cahyono, S.T., M.M.', ''),
(10, 14, 2, '523332', 'Andreas A. D, S.E., M.Si. (Han)., M.Sc.', ''),
(11, 22, 17, '11970033930275', 'Hendi Ahmad Pribadi, S.I.P.', ''),
(12, 16, 17, '11960050920675', 'Jones Sasmita Muliawan, S.I.P. M.M.', ''),
(13, 25, 3, '11364/P', 'Kunto Tjahjono, S.E.', ''),
(14, 15, 19, '11926/P', 'Siswanto, S.T., M.T.', ''),
(15, 23, 15, '11960039720274', 'Wahyudi Dwi Santoso, S.E.', ''),
(16, 17, 2, '523401', 'Erick Rofiq Nurdin', ''),
(17, 24, 17, '11970034500375', 'Purnomosidi, S.I.P., M.AP.', ''),
(18, 18, 17, '11980053710877', 'Aulia Dwi Nasrullah', ''),
(19, 26, 18, '71010253', 'F. Barung Mangera, S.I.K.', ''),
(20, 9, 2, '521877', 'Henri Ahmad Badawi', ''),
(21, 27, 3, '12647/P', 'Dores Afrianto Ardi, S.E., M.Si.', ''),
(22, 11, 2, '523341', 'Sidik Setiyono, S.E.', ''),
(23, 19, 16, '74050394', 'Muji Ediyanto, S.H., S.I.K.', ''),
(24, 12, 2, '523390', 'Vincentius Endy, H.P.', ''),
(25, 20, 4, '11960050010375', 'Marthen Venry Rorintulus, S.E.', 'agastyapandu7@gmail.com'),
(26, 13, 2, '523361', 'Jajang Setiawan, S.M.', ''),
(27, 21, 17, '11970042350376', 'Tamimi Hendra Kesuma, S.H., M.A.P.', ''),
(28, 30, 3, '11920/P', 'Bayu Alisyahbana, S.M.', ''),
(29, 14, 17, '11970032520974', 'Riza Anom Putranto, S.I.P., M.Si.', ''),
(30, 22, 2, '523412', 'Feri Yunaldi, S.E.', ''),
(31, 16, 2, '523357', 'A. Donie Prihandono, S.E.', ''),
(32, 25, 17, '11970037650975', 'Iwan Setiawan, S.I.P.', ''),
(33, 15, 20, '518840', 'Videon Nugroho S, S.T.', ''),
(34, 23, 17, '11960046811174', 'Deki Zulkarnaen, S.I.P.', ''),
(35, 17, 14, '520294', 'Visnu Hermawan, S.E., M.M.', ''),
(36, 24, 5, '11960052171073', 'Vincentius Agung Cahya K, S.I.P.', ''),
(37, 18, 21, '520299', 'Rudiyanto, S.T., M.M.', ''),
(38, 26, 18, '74040735', 'Didi Hayamansyah, S.H., S.I.K., M.H.', ''),
(39, 9, 3, '11885/P', 'Anung Sutanto, S.Sos., M.Si.', ''),
(40, 27, 2, '521759', 'Bambang Sudewo', ''),
(41, 11, 3, '10683/P', 'Uki Prasetia, S.T., M.M.', ''),
(42, 19, 2, '521785', 'Benny Bayu Nirwan, S.T.', ''),
(43, 12, 17, '11960043500874', 'Andy Mustafa Akad, S.E.', ''),
(44, 20, 2, '521845', 'Jhonson Henrico Simatupang', ''),
(45, 13, 3, '13278/P', 'Tunggul', ''),
(46, 21, 17, '11960043920874', 'M. Taufiq Zega, S.I.P., M.Si.', ''),
(47, 30, 17, '11960044420974', 'Chrisbianto Arimurti', ''),
(48, 14, 2, '523340', 'Lilik Eko Susanto, S.E., M.M.', ''),
(49, 22, 5, '11970053720575', 'Asep Rahmat Sukmana, S.I.P.', ''),
(50, 16, 17, '11950048230574', 'Franz Yohannes Purba, S.I.P.', ''),
(51, 25, 3, '11906/P', 'Adi Lumaksana, S.Sos.', ''),
(52, 15, 19, '11931/P', 'Reza Kusumanegara, M.A.P.', ''),
(53, 23, 20, '521806', 'Arman Rusmanto, S.T.', ''),
(54, 17, 14, '521754', 'Nana Setiawan, S.E.', ''),
(55, 24, 18, '68080524', 'I Ketut Yudha Karyana, S.I.K.', ''),
(56, 18, 7, '10769/P', 'Yudi Harsono, S.T.', ''),
(57, 26, 5, '11980060491175', 'Zulhadrie S Mara', ''),
(58, 9, 3, '12644/P', 'Wawan Trisatya Atmaja, S.E.', ''),
(59, 27, 17, '11980053220777', 'Andre Julian, S.I.P., M.Sos.', ''),
(60, 11, 3, '12262/P', 'Arya Delano, S.E., MPD.', ''),
(61, 19, 19, '70121127', 'Djadjuli, S.I.K., M.Si.', ''),
(62, 31, 23, '-', 'Muhammad Anjum Saeed (Pakist)', ''),
(63, 12, 17, '11960052741074', 'Herfin Kartika Aji, S.I.P.', ''),
(64, 20, 2, '521812', 'Ali Gusman, S.T., M.M.', ''),
(65, 13, 3, '12624/P', 'Rakhmat Arief Bintoro, S.Kel.', ''),
(66, 21, 17, '11950038580771', 'Teguh Pudji Rahardjo', ''),
(67, 14, 17, '11960051420875', 'Agus Bhakti, S.I.P.', ''),
(68, 22, 2, '523405', 'Rizaldy Efranza, S.T.', ''),
(69, 16, 3, '11923/P', 'Oky IZ Dipura, S.H., M.P.A.', ''),
(70, 25, 17, '11960048061274', 'Teddy Arifiyanto Setimiharja, S.I.P.', ''),
(71, 15, 19, '11934/P', 'Christanto Pratomo, S.T., M.A.P.', ''),
(72, 23, 4, '1195005317', 'Harvin Kidingalio', ''),
(73, 17, 2, '523397', 'Antonius Adi Nur W, S.E.', ''),
(74, 24, 18, '71030329', 'Christiyanto Goetomo, S.I.K., S.H., M.H.', ''),
(75, 18, 17, '11960046401174', 'Mochamad Andi Prihantoro', ''),
(76, 26, 18, '70090398', 'Nanang Masbudi, S.I.K., M.Si.', ''),
(77, 9, 17, '11970043670576', 'Endra Saputra Kusuma, ZR., S.E.', ''),
(78, 27, 24, '523330', 'Rano Kristiyono, S.T.', ''),
(79, 11, 17, '11940011500969', 'Wahyu Handoyo, S.I.P.', ''),
(80, 19, 2, '521832', 'Purwanto Adi Nugroho', ''),
(81, 31, 23, '-', 'JD Masurkar (India)', ''),
(82, 12, 17, '11970057371075', 'Edwin Adrian Sumantha, S.H., PG Dipl.', ''),
(83, 20, 3, '11908/P', 'Henricus Prihantoko', ''),
(84, 13, 17, '11970036820875', 'Maychel Asmi, P.Sc., S.E.', ''),
(85, 21, 2, '518843', 'Ridha Hermawan, S.H.', ''),
(86, 14, 15, '11960040790474', 'Ari Estefanus, S.Sos., M.Sc.', ''),
(87, 22, 25, '11964/P', 'Sunaryadi, S.E., M.Si.', ''),
(88, 16, 17, '11950044840774', 'Surya Wibawa Suparman', ''),
(89, 25, 17, '11940027450573', 'M. Arif Suryandaru', ''),
(90, 15, 17, '11970043340476', 'Adek Chandra Kurniawan', ''),
(91, 23, 15, '11960047231274', 'Wijang Rimoko Ardani, S.Sos.', ''),
(92, 17, 24, '521782', 'Arif Budiyanto, S.E.', ''),
(93, 24, 18, '74020330', 'Abdul Karim, S.I.K., M.Si.', ''),
(94, 18, 15, '11950050690571', 'Wiwin Sugiono, S.I.P.', ''),
(95, 26, 18, '72030201', 'Rickynaldo Chairul, S.I.K., M.M.', ''),
(96, 9, 17, '11970041510176', 'Patar Mospa Natanael Sitorus', ''),
(97, 27, 26, '12732/P', 'Agus Gunawan Wibisono, S.H., M.M.', ''),
(98, 11, 5, '11970054630576', 'M. Andhy Kusuma, S.Sos., M.M.', ''),
(99, 19, 18, '74090552', 'Hando Wibowo, S.I.K., M.Si.', ''),
(100, 12, 17, '11950036641270', 'Andi Asmara Dewa', ''),
(101, 20, 2, '523352', 'I Gusti Putu Setia D, S.T., M.M.', ''),
(102, 13, 17, '11960049050275', 'Yuri Elias Mamahi', ''),
(103, 21, 15, '11970050420875', 'Johanes Toar Pioh, S.I.P., M.Si. (Han)', ''),
(104, 30, 17, '11970044900676', 'Mohammad Sjahroni, S.E.', ''),
(105, 14, 17, '11970044330576', 'Yudha Rismansyah', ''),
(106, 22, 27, '520244', 'Budi Setyo, S.H.', ''),
(107, 16, 6, '11960030970572', 'Teguh Heri, S.E., M.M.', ''),
(108, 25, 25, '12702/P', 'Ferry Mulyadi Arifin', ''),
(109, 15, 6, '11970048050676', 'Yudi Prasetio, S.I.P.', ''),
(110, 23, 17, '11970043420476', 'Jarot Suprihanto', ''),
(111, 17, 17, '11960051260775', 'Wulang Nur Yudhanto', ''),
(112, 24, 6, '11950049971173', 'Donova Pri Pamungkas', ''),
(113, 18, 7, '11416/P', 'Budiman Marpaung, S.T., S.E.', ''),
(114, 26, 15, '11970048700474', 'Brantas Suharyo G', ''),
(115, 9, 26, '11994/P', 'Dede Harsana', ''),
(116, 27, 6, '11950049891173', 'Haerus Shaleh, S.Sos.', ''),
(117, 11, 17, '11960047801274', 'Dody Triwinarto, S.I.P.', ''),
(118, 19, 18, '73060608', 'Akhmad Yusep Gunawan, S.H., S.I.K.', ''),
(119, 12, 4, '11970049460175', 'Candy Cristian Riantory, S.I.P.', ''),
(120, 20, 2, '518852', 'Mochammad Untung Suropati, S.E.', ''),
(121, 13, 3, '11915/P', 'Bagus Handoko, S.H., M.Si.', ''),
(122, 21, 4, '11960044180874', 'Deni Sukwara, S.E., M.Si.', ''),
(123, 14, 24, '11960045901074', 'Otto Sollu, S.E.', ''),
(124, 22, 2, '523345', 'Roni Widodo', ''),
(125, 16, 3, '13288/P', 'Harry Setiawan, S.E.', ''),
(126, 25, 17, '11960048630275', 'Andrian Susanto, S.I.P.', ''),
(127, 15, 19, '11412/P', 'Agung Setiawan', ''),
(128, 23, 17, '11960048970275', 'Erwin, S.I.P.', ''),
(129, 17, 24, '521835', 'Darmawan Hendro W, M.Eng.Sc.', ''),
(130, 24, 16, '69100444', 'Dr. Hadi Utomo, S.H., M.Hum.', ''),
(131, 18, 17, '11960034440473', 'Renal Aprindo Sinaga', ''),
(132, 26, 17, '11960039310274', 'Safta Feryansyah, S.E., S.I.P.', ''),
(133, 9, 3, '11888/P', 'Baharudin Anwar, S.T., M.M.', ''),
(134, 27, 17, '11970045990876', 'Ade David Siregar', ''),
(135, 11, 3, '11897/P', 'I Komang Teguh A, S.T., M.AP.', ''),
(136, 19, 18, '74060705', 'Dayan V. Imanuel Blegur, S.I.K., M.H.', ''),
(137, 31, 13, '-', 'Mamao Monis Tandayao (Filipina)', ''),
(138, 12, 17, '11960044260974', 'Horasman Pakpahan, S.I.P.', ''),
(139, 20, 2, '523407', 'Rony Armanto, S.E., M.M.', ''),
(140, 13, 3, '11924/P', 'Irwan SP. Siagian', ''),
(141, 21, 17, '11950043020972', 'Lalu Habibburrahim WD, S.I.P. M.Si.', ''),
(142, 14, 17, '11960032610173', 'Muhammad Aidi, S.I.P., M.Si.', ''),
(143, 22, 28, '520298', 'Mukhtar Bakhrong, S.E., M.M.', ''),
(144, 16, 17, '11940027940773', 'Edi Saputra, S.I.P.', ''),
(145, 25, 17, '11950043771172', 'Musa David M. Hasibuan, S.I.P.', ''),
(146, 15, 17, '11950037830671', 'Jaelan, S.I.P.', ''),
(147, 23, 25, '11963/P', 'DR. Hery Setiyo N, S.E., M.AP.', ''),
(148, 17, 24, '521823', 'Saeful Rakhmat', ''),
(149, 24, 18, '71050218', 'Chaidir, S.H., S.I.K., M.Si., M.P.P.', ''),
(150, 18, 7, '12688/P', 'Abraham OP Sahureka, S.T., MMT.', ''),
(151, 26, 21, '517477', 'Djoko Triono', ''),
(152, 9, 26, '12713/P', 'Kresno Pratowo, S.E.', ''),
(153, 27, 2, '523392', 'Toto Ginanto, S.T., M.AP.', ''),
(154, 11, 26, '11481/P', 'Arif Handono, S.A.P.', ''),
(155, 19, 18, '70090406', 'Leonardus E B, S.I.K., S.H., M.Hum.', ''),
(156, 31, 13, '-', 'Maxmillion Goh (Singapura)', ''),
(157, 12, 26, '11470/P', 'Amir Kasman, S.E., M.M.', ''),
(158, 20, 17, '11970041440176', 'Willy Brodus Yos Rohadi', ''),
(159, 13, 26, '12738/P', 'Didiet Hendra Wijaya, MMP.', ''),
(160, 21, 17, '11960047561274', 'Asep Sukarna, S.Sos., S.I.P., M.M.', ''),
(161, 14, 17, '11960032041072', 'Agus Soeprianto', ''),
(162, 22, 17, '11940023310572', 'Yudi Ruskandar, S.I.P.', ''),
(163, 16, 26, '11459/P', 'Mauriadi, S.E.', ''),
(164, 25, 17, '11970040521175', 'Susanto Lastua Manurung, S.I.P.', ''),
(165, 15, 17, '11980041500375', 'Sutrisno Pujiono, S.E., M.M.', ''),
(166, 23, 18, '73040543', 'Guruh Arif Darmawan, S.I.K., M.H.', ''),
(167, 34, 19, '11395/P', 'Ahmad Alfajar, S.T.', ''),
(168, 18, 17, '11970039301175', 'Ferry Irawan, S.I.P.', ''),
(169, 26, 17, '11970032110774', 'Muhammad Thohir', ''),
(170, 29, 20, '521755', 'Rudy Nursofjan, S.T.', ''),
(174, NULL, NULL, '1217619', 'Agastya Pandu Satriya Utama', 'agastypandu@gmail.com'),
(175, NULL, NULL, '899893277', 'ACENG', 'titilestiasriwahyuni@gmail.com'),
(176, 38, 28, '91283128', 'Jafar', 'jafarlukmana@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `broadcast_email`
--

CREATE TABLE `broadcast_email` (
  `id_broadcast` int(11) NOT NULL,
  `tanggal_kirim` datetime NOT NULL DEFAULT current_timestamp(),
  `judul_broadcast` varchar(100) NOT NULL,
  `isi_broadcast` text NOT NULL,
  `jumlah_anggota` smallint(11) NOT NULL,
  `asal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `broadcast_email`
--

INSERT INTO `broadcast_email` (`id_broadcast`, `tanggal_kirim`, `judul_broadcast`, `isi_broadcast`, `jumlah_anggota`, `asal`) VALUES
(1, '2020-09-08 00:00:00', 'SUBYEK', '<p>dasdasdasdas</p>', 3, NULL),
(2, '2020-09-08 00:00:00', 'awdawd', '<p>awdawd</p>', 1, NULL),
(3, '2020-09-08 00:00:00', 'percobaan', '<p>percobaan<br></p>', 1, NULL),
(4, '2020-09-08 00:00:00', 'nklop', '<p>awdawd</p>', 1, NULL),
(5, '2020-09-08 00:00:00', 'awdawd', '<p>awdaw</p>', 1, NULL),
(6, '2020-09-08 00:00:00', 'awdawd', '<p>awd</p>', 2, NULL),
(7, '2020-09-09 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 9, NULL),
(8, '2020-09-10 00:00:00', 'Tes', '<p><span style=\"white-space:pre\">	</span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p><span style=\"white-space:pre\">	</span>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p><span style=\"white-space:pre\">	</span>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p><span style=\"white-space:pre\">	</span>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p><span style=\"white-space:pre\">	</span>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p><span style=\"white-space:pre\">	</span>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, NULL),
(9, '2020-09-10 00:00:00', 'awdasd', '<p>adawdawd</p>', 1, NULL),
(10, '2020-09-12 00:00:00', 'awdaw', '<p>awdaw</p>', 1, NULL),
(11, '2020-09-12 00:00:00', 'awdaw', '<p>awd</p>', 2, NULL),
(12, '2020-09-12 00:00:00', 'awdaw', '<p>awd</p>', 2, NULL),
(13, '2020-09-12 00:00:00', 'awdawd', '<p>awdawd</p>', 2, NULL),
(14, '2020-09-12 00:00:00', 'awdawd', '<p>awdawd</p>', 2, NULL),
(15, '2020-09-12 00:00:00', 'awd', '<p>awdawa</p>', 1, NULL),
(16, '2020-09-12 00:00:00', 'awdawdawdw', '<p>awdawdawd</p>', 2, NULL),
(17, '2020-09-12 00:00:00', 'awdaw', '<p>awd</p>', 2, NULL),
(18, '2020-09-12 00:00:00', 'awdaw', '<p>awd</p>', 2, NULL),
(19, '2020-09-12 00:00:00', 'awdaw', '<p>awd</p>', 2, NULL),
(20, '2020-09-12 00:00:00', 'awdaw', '<p>awdawd</p>', 1, NULL),
(21, '2020-09-12 00:00:00', 'awdaw', '<p>awdawd</p>', 1, NULL),
(22, '2020-09-12 00:00:00', 'awdawd', '<p>awd</p>', 2, NULL),
(23, '2020-09-12 00:00:00', 'awdawd', '<p>awd</p>', 2, NULL),
(24, '2020-09-12 00:00:00', 'Percobaan Email', '<p>Percobaan Email<br></p>', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_broadcast`
--

CREATE TABLE `detail_broadcast` (
  `id_detail_broadcast` int(11) NOT NULL,
  `id_broadcast` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_broadcast`
--

INSERT INTO `detail_broadcast` (`id_detail_broadcast`, `id_broadcast`, `id_anggota`, `email`, `status`) VALUES
(1, 1, 175, 'titilestiasriwahyuni2x@gmail.com', '1'),
(2, 1, 150, 'titilestiasriwahyuni2@gmail.com', '2'),
(3, 1, 134, '', '2'),
(4, 2, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(5, 3, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(6, 4, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(7, 5, 31, '', '2'),
(8, 6, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(9, 6, 93, '', '2'),
(10, 7, 62, '', '2'),
(11, 7, 81, '', '2'),
(12, 7, 97, '', '2'),
(13, 7, 115, '', '2'),
(14, 7, 152, '', '2'),
(15, 7, 154, '', '2'),
(16, 7, 157, '', '2'),
(17, 7, 159, '', '2'),
(18, 7, 163, '', '2'),
(19, 8, 176, 'jafarlukmana@gmail.com', '1'),
(20, 9, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(21, 10, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(22, 11, 31, '', '2'),
(23, 11, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(24, 12, 31, '', '2'),
(25, 12, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(26, 13, 150, '', '2'),
(27, 13, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(28, 14, 150, '', '2'),
(29, 14, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(30, 15, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(31, 16, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(32, 16, 150, '', '2'),
(33, 17, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(34, 17, 93, '', '2'),
(35, 18, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(36, 18, 93, '', '2'),
(37, 19, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(38, 19, 93, '', '2'),
(39, 20, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(40, 21, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(41, 22, 150, '', '2'),
(42, 22, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(43, 23, 150, '', '2'),
(44, 23, 175, 'titilestiasriwahyuni@gmail.com', '1'),
(45, 24, 175, 'titilestiasriwahyuni@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `urutan` tinyint(4) NOT NULL,
  `is_plus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `urutan`, `is_plus`) VALUES
(11, 'Staf Ahli I', 3, 0),
(12, 'Asintel I', 5, 0),
(13, 'Asops I', 7, 0),
(14, 'Aspers I', 10, 0),
(15, 'Aslog I', 11, 0),
(16, 'Asren I', 15, 0),
(17, 'Aster I/<br/>Aspotmar I/<br/>Aspotdirga I', 13, 0),
(18, 'Askomlek I', 17, 0),
(19, 'Staf Ahli II', 4, 0),
(20, 'Asintel II', 6, 0),
(21, 'Asops II', 8, 0),
(22, 'Aspers II', 11, 0),
(23, 'Aslog II', 12, 0),
(24, 'Aster II /<br/>Aspotmar II /<br/>Aspotdirga II', 14, 0),
(25, 'Asren II', 16, 0),
(26, 'Askomlek II', 18, 0),
(27, 'Kepala Staf', 2, 2),
(29, 'Askomlek III', 19, 0),
(30, 'Asops III', 9, 0),
(31, 'Staff Ahli III', 5, 0),
(32, 'Aspotmar I', 13, 0),
(33, 'Aspotmar II', 14, 0),
(34, 'Aslog III', 13, 0),
(35, 'Aspotdirga I', 13, 0),
(36, 'Aspotdirga II', 14, 0),
(37, 'Panglima', 0, 0),
(38, 'Panglima Kodam', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_email`
--

CREATE TABLE `konfigurasi_email` (
  `id_konfigurasi` int(11) NOT NULL,
  `host` char(20) NOT NULL,
  `smtp_secure` char(20) NOT NULL,
  `port` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfigurasi_email`
--

INSERT INTO `konfigurasi_email` (`id_konfigurasi`, `host`, `smtp_secure`, `port`) VALUES
(1, 'smtp.gmail.com', 'ssl', 465);

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `id_pangkat` int(11) NOT NULL,
  `nama_pangkat` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id_pangkat`, `nama_pangkat`) VALUES
(1, 'Kolonel Int'),
(2, 'Kolonel Pnb'),
(3, 'Kolonel Laut (P)'),
(4, 'Kolonel Arh'),
(5, 'Kolonel Czi'),
(6, 'Kolonel Kav'),
(7, 'Kolonel Laut (E)'),
(13, 'Colonel AD'),
(14, 'Kolonel Pas'),
(15, 'Kolonel Arm'),
(16, 'Kombes Pol'),
(17, 'Kolonel Inf'),
(18, 'Kombes Pol'),
(19, 'Kolonel Laut (T)'),
(20, 'Kolonel Tek'),
(21, 'Kolonel Lek'),
(22, 'Kolonel Kal'),
(23, ' Group Captain AU\r\n'),
(24, ' Kolonel Nav\r\n\r\n'),
(25, 'Kolonel Laut (S)'),
(26, ' Kolonel Mar\r\n'),
(27, ' Kolonel Pom'),
(28, 'Jendral');

-- --------------------------------------------------------

--
-- Table structure for table `pengirim`
--

CREATE TABLE `pengirim` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `id_konfigurasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengirim`
--

INSERT INTO `pengirim` (`id`, `email`, `password`, `id_konfigurasi`) VALUES
(6, 'uwu', 'YWt3b2F3a2F3b2s', 1),
(7, 'fikrimubarok19@gmail.com', 'ZmlrcmkxNDA0NQ', 1),
(9, 'suksesdianglobaltech@gmail.com', 'YzNWcmMyVnpjR0Z6ZEdreE1qTT0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `token_login`
--

CREATE TABLE `token_login` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token_login`
--

INSERT INTO `token_login` (`id`, `id_admin`, `token`, `tanggal`) VALUES
(1, 1, 'e37296dc2ed2f615eb0359d1c4e67844fb30a2af', '2020-09-28 09:34:09'),
(2, 1, 'cc3595252094806b0925c07693ad8080e6c730d7', '2020-09-28 09:58:46'),
(3, 1, 'e382288a42b2ac9e4350ac66dce980cd078a3d62', '2020-09-28 10:02:08'),
(4, 1, '917190125f385f4b428c693feb1d70ab8a632bf2', '2020-09-28 10:02:28'),
(5, 1, '609b9610a877ca6c7707bd3925f96c560bcee6bb', '2020-09-28 11:31:31'),
(6, 1, '47c268c3fd9630ae1eb475f55a043e74afe8385a', '2020-09-28 15:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `t_quotes`
--

CREATE TABLE `t_quotes` (
  `id` int(11) NOT NULL,
  `quotes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_quotes`
--

INSERT INTO `t_quotes` (`id`, `quotes`) VALUES
(1, 'Belajar tanpa berpikir itu tidaklah berguna, tapi berpikir tanpa belajar itu sangatlah berbahaya! -Soekarno'),
(2, 'Beri aku 1.000 orang tua, niscaya akan kucabut semeru dari akarnya. Beri aku 10 pemuda niscaya akan kuguncangkan dunia.  -Soekarno'),
(3, 'Bangsa yang besar adalah bangsa yang menghormati jasa pahlawannya. -Soekarno'),
(4, 'Laki-laki dan perempuan adalah sebagai dua sayapnya seekor burung. Jika dua sayap sama kuatnya, maka terbanglah burung itu sampai ke puncak yang setinggi-tingginya; jika patah satu dari pada dua sayap itu, maka tak dapatlah terbang burung itu sama sekali. -Soekarno'),
(5, 'Barangsiapa ingin mutiara, harus berani terjun di lautan yang dalam.\r\n -Soekarno'),
(6, 'Jika kita memiliki keinginan yang kuat dari dalam hati, maka seluruh alam semesta akan bahu membahu mewujudkannya. -Soekarno'),
(7, 'Gantungkan cita-cita mu setinggi langit! Bermimpilah setinggi langit. Jika engkau jatuh, engkau akan jatuh di antara bintang-bintang. -Soekarno'),
(8, 'Bunga mawar tidak mempropagandakan harum semerbaknya, dengan sendirinya harum semerbaknya itu tersebar di sekelilingnya. -Soekarno'),
(9, 'Aku akan memuji apa yang baik, tak pandang sesuatu itu datangnya dari seorang komunis, islam, atau seorang Hopi Indian. -Soekarno'),
(10, 'Jadikan deritaku ini sebagai kesaksian bahwa kekuasaan seorang Presiden sekalipun ada batasnya. Karena kekuasaan yang langgeng hanya kekuasaan rakyat. Dan diatas segalanya adalah Kekuasaan Tuhan Yang Maha Esa. -Soekarno'),
(11, 'Hati yang sabar, pemikiran yang religius, tindakan yang baik. -Seoharto'),
(12, 'Kaya tanpa harta, menantang tanpa orang lain, berani tanpa gagang, dan menang tanpa membunuh. -Seoharto'),
(13, 'Kalau kamu ingin menjadi pribadi yang maju, kamu harus pandai mengenal apa yang terjadi, pandai melihat, pandai mendengar, dan pandai menganalisis. -Seoharto'),
(14, 'Penguasa yang enak hidupnya hanya karena banyak harta bendanya, kelak matinya tidak akan terhormat. Oleh karena itu jangan kejam dan sewenang-wenang terhadap rakyatnya. -Seoharto'),
(15, 'kita perlu berani mengatakan yang benar itu benar dan yang salah itu salah. -Seoharto'),
(16, 'Siapa saja yang mencoba melawan, akan saya gebuki. -Seoharto'),
(17, 'Jangan mudah terkejut, tidak kagum, dan jangan sombong. -Seoharto'),
(18, 'Saya ini tentara. Tentara itu pedoman hidupnya Sapta Marga. Kami patriot Indonesia, pendukung dan pembela ideologi negara yang bertanggungjawab dan tidak mengenal menyerah. -Seoharto'),
(19, 'Seseorang harus menjaga kebaikannya. Karena itu adalah investasi yang baik bagi kehidupan. -Seoharto'),
(20, 'Sehubungan dengan Tuhanmu, guru, ratu dan orang tua Anda. -Seoharto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_pangkat` (`id_pangkat`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `broadcast_email`
--
ALTER TABLE `broadcast_email`
  ADD PRIMARY KEY (`id_broadcast`);

--
-- Indexes for table `detail_broadcast`
--
ALTER TABLE `detail_broadcast`
  ADD PRIMARY KEY (`id_detail_broadcast`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `konfigurasi_email`
--
ALTER TABLE `konfigurasi_email`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konfigurasi` (`id_konfigurasi`);

--
-- Indexes for table `token_login`
--
ALTER TABLE `token_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_quotes`
--
ALTER TABLE `t_quotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `broadcast_email`
--
ALTER TABLE `broadcast_email`
  MODIFY `id_broadcast` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `detail_broadcast`
--
ALTER TABLE `detail_broadcast`
  MODIFY `id_detail_broadcast` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `konfigurasi_email`
--
ALTER TABLE `konfigurasi_email`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id_pangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `token_login`
--
ALTER TABLE `token_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_quotes`
--
ALTER TABLE `t_quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengirim`
--
ALTER TABLE `pengirim`
  ADD CONSTRAINT `pengirim_ibfk_1` FOREIGN KEY (`id_konfigurasi`) REFERENCES `konfigurasi_email` (`id_konfigurasi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
