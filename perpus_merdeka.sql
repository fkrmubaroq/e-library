-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Bulan Mei 2021 pada 00.41
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_merdeka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `tahun` char(4) NOT NULL,
  `slug_nama_buku` varchar(255) DEFAULT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `deskripsi` text NOT NULL,
  `bahasa` varchar(50) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_trial` varchar(255) NOT NULL,
  `stok` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `nama_buku`, `tahun`, `slug_nama_buku`, `id_kategori`, `deskripsi`, `bahasa`, `penulis`, `cover`, `file`, `file_trial`, `stok`) VALUES
(1, 'Hooman Hooman Manglayang', '2009', 'hooman-hooman-manglayang', 1, '<p font-size:=\"\" open=\"\" style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \">\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n<p font-size:=\"\" open=\"\" style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \">\n	The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\n', 'Indonesia', 'Stephanus Andriawan', '8570e-cover-book.jpg', '67709-skripsi.pdf', '', 15),
(2, 'Sebuah Seni Untuk Bersikap Bodo Amat', '2010', 'sebuah-seni-untuk-bersikap-bodo-amat', 1, '<p>\n	<span style=\"font-size:14px;\">Buku ini tidak berbicara bagaimana cara meringankan masalah atau rasa sakit. Bukan juga panduan untuk mencapai sesuatu. Namun, sebaliknya buku ini akan mengubah rasa sakit menjadi kekuatan, dan mengubah masalah menjadi masalah yang lebih baik. Khususnya, buku ini akan mengajari untuk peduli lebih sedikit.</span></p>\n', 'Indonesia', 'Mark Manson', 'd33bb-cover-book2.jpg', '881f6-sebuah-seni-untuk-bersikap-bodo-amat.pdf', '2663f-15575-881f6-sebuah-seni-untuk-bersikap-bodo-amat_removed-1-.pdf', 10),
(3, 'Dunia Sophie', '2015', 'dunia-sophie', 1, '<p>\n	<span style=\"color: rgb(85, 85, 85); font-family: Roboto, sans-serif; font-size: 14px;\">Sophie, seorang pelajar sekolah menengah berusia empat belas tahun. Suatu hari sepulang sekolah, dia mendapat sebuah surat misterius yang hanya berisikan satu pertanyaan: &ldquo;Siapa kamu?&rdquo; Belum habis keheranannya, pada hari yang sama dia mendapat surat lain yang bertanya: &ldquo;Dari manakah datangnya dunia?&rdquo; Seakan tersentak dari rutinitas hidup sehari-hari, surat-surat itu&hellip;</span></p>\n', 'Indonesia', 'Jostein Gaarder', '94a90-cover-book3.jpg', 'ab3cb-dunia-sophie-novel.pdf', '', 10),
(4, 'Marmut Merah Jambu', '2010', 'marmut-merah-jambu', 1, '<p>\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">Marmut Merah Jambu adalah buku karya Raditya Dika kelima yang diterbitkan pada tahun 2010. Masih berkonsepkan cerita komedi yang ditulis berdasarkan kisah sang penulis seperti dalam buku-buku sebelumnya. Garis besar buku ini menceritakan kisah asmara penulis mapun orang terdekatnya, termasuk saat menjalin kasih dengan penyanyi Indonesia, Sherina Munaf. Buku ini berisi 222 halaman.</span></span></p>\n', 'Indonesia', 'Raditya Dika', 'a7af2-marmut_merah_jambu_film.jpg', '174b9-marmut-merah-jambu.pdf', '0bc50-marmut_merah_jambu_limit.pdf', 10),
(5, 'Matahari', '2016', 'matahari', 1, '<p>\n	<span font-size:=\"\" open=\"\" style=\"color: rgba(49, 53, 59, 0.96); font-family: \">Kini anak istimewa itu bernama Ali. Sama dengan Seli dan Raib, ia juga berusia 15 tahun, masih kelas X. Jika orangtuanya mengizinkan, bahkan seharusnya ia sudah duduk di tingkat akhir ilmu fisika program doktor. Bagi Ali, guru dan teman-teman sekelasnya sangat membosankan. Namun hal itu tidak berlangsung lama setelah pada akhirnya teman sekelasnya mengetahui ada hal aneh pada dirinya dan Seli.</span><br font-size:=\"\" open=\"\" style=\"box-sizing: inherit; color: rgba(49, 53, 59, 0.96); font-family: \" />\n	<br font-size:=\"\" open=\"\" style=\"box-sizing: inherit; color: rgba(49, 53, 59, 0.96); font-family: \" />\n	<span font-size:=\"\" open=\"\" style=\"color: rgba(49, 53, 59, 0.96); font-family: \">Kalau Seli bisa mengeluarkan petir, lain halnya dengan Ali, ia bisa berubah menjadi beruang raksasa. Mengetahui bahwa mereka istimewa, mereka kemudian berpetualang ketempat-tempat yang menakjubkan.</span><br font-size:=\"\" open=\"\" style=\"box-sizing: inherit; color: rgba(49, 53, 59, 0.96); font-family: \" />\n	<br font-size:=\"\" open=\"\" style=\"box-sizing: inherit; color: rgba(49, 53, 59, 0.96); font-family: \" />\n	<span font-size:=\"\" open=\"\" style=\"color: rgba(49, 53, 59, 0.96); font-family: \">Ali, sangatlah paham paham bahwa dunia tidaklah sesederhana yang dilihat oleh orang-orang, dan lebih daripada itu, Ali akhirnya mengerti, bahwa persahabatan merupakan hal yang indah yang paling utama.</span></p>\n', 'Indonesia', 'Tere Liye', '0c65a-sinopsis-novel-matahari-karya-tere-liye.jpg', '3d9a9-matahari.pdf', '', 11),
(6, 'The Secret History of the World', '1999', 'the-secret-history-of-the-world', 5, '<p style=\"color: rgb(32, 33, 36); font-family: Roboto, HelveticaNeue, sans-serif; font-size: 13px;\">\n	The complete history of the world, from the beginning of time to the present day, based on the beliefs and writings of the secret societies.</p>\n<p style=\"color: rgb(32, 33, 36); font-family: Roboto, HelveticaNeue, sans-serif; font-size: 13px;\">\n	Jonathan Black examines the end of the world and the coming of the Antichrist. Or is the Antichrist already here? How will he make himself known and what will become of the world when he does? Willl it be the end of Time?</p>\n<p style=\"color: rgb(32, 33, 36); font-family: Roboto, HelveticaNeue, sans-serif; font-size: 13px;\">\n	Having studied theology and learnt from initiates of all the great secret societies of the world, Jonathan Black has learned that it is possible to reach an altered state of consciousness in which we can see things about the way the world works that hidden from our everyday commonsensical consciousness. This history shows that by using secret techniques, people such as Leonardo.</p>\n', 'Indonesia', 'Mark Booth', 'e0086-cover.jpg', '6c0cf-marmut-merah-jambu.pdf', '', 7),
(7, 'Sejarah Peradaban Islam', '', 'sejarah-peradaban-islam', 5, '<p>\n	<span style=\"color: rgb(61, 61, 61); font-family: &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 14px;\">Buku ini memuat perjalanan panjang sejarah peradaban Islam yang dimulai kajian tentang struktur spasial, struktur sosial, serta agama dan kepercayaan masyarakat Arab pra-Islam. Setelah itu, diulas perkembangan Islam periode awal dengan unit kajian, yakni Islam periode Mekkah dan Madinah yang menunjukkan dua kondisi yang kontradiktif dari segi penerimaan Islam sekaligus menjadi faktor penarik dan pendorong terjadinya peristiwa hijrah.</span></p>\n', '', '', '947d1-cover.jpg', '15575-881f6-sebuah-seni-untuk-bersikap-bodo-amat.pdf', '8dbfd-6_updated_881f6-sebuah-seni-untuk-bersikap-bodo-amat.pdf', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pinjam` int(10) UNSIGNED NOT NULL,
  `id_buku` int(10) UNSIGNED NOT NULL,
  `tgl_berakhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id`, `id_pinjam`, `id_buku`, `tgl_berakhir`) VALUES
(1, 1, 4, '2021-05-15'),
(2, 1, 3, '2021-05-08'),
(3, 1, 5, '2021-05-04'),
(4, 2, 6, '2021-05-15'),
(5, 2, 7, '2021-05-02'),
(6, 3, 2, '2021-05-06'),
(10, 7, 2, '2022-05-04'),
(11, 7, 4, '2022-05-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `no_induk` char(50) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `gelar_depan` char(30) NOT NULL,
  `gelar_belakang` char(30) NOT NULL,
  `alamat` text NOT NULL,
  `telp` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `id_user`, `no_induk`, `nama_guru`, `gelar_depan`, `gelar_belakang`, `alamat`, `telp`) VALUES
(1, 14, '991897829277', 'Andina Merlifasi', '', '', 'Jalan tah', '08736255'),
(2, 10, '19982833', 'Agus Fahrudin', 'S.kom', 'Ir.', 'Jln saluyu indah', '085314027226');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`) VALUES
(1, 'Teknik Komputer Jaringan'),
(2, 'Rekayasa Perangkat Lunak'),
(3, 'Multimedia'),
(4, 'Akuntansi'),
(5, 'Teknik Kendaraan Ringan'),
(6, 'Tata Boga'),
(7, 'Teknik Permesinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_buku`
--

INSERT INTO `kategori_buku` (`id`, `nama_kategori`) VALUES
(1, 'Novel'),
(2, 'Pelajaran'),
(3, 'Sejarah'),
(4, 'Religi'),
(5, 'Pengetahuan'),
(6, 'Romansa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `ip` varchar(20) NOT NULL,
  `tgl_kunjung` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_transaksi` varchar(20) NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `total_pinjam_buku` tinyint(4) NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('1','2') NOT NULL COMMENT '1 : Proses\r\n2 : ACC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`id`, `no_transaksi`, `id_user`, `total_pinjam_buku`, `tgl_transaksi`, `status`) VALUES
(1, '01211235', 3, 3, '2021-05-01 13:36:19', '1'),
(2, '01211707', 3, 2, '2021-05-01 14:45:23', '2'),
(3, '01211652', 3, 1, '2021-05-01 17:36:18', '2'),
(7, '04211556', 10, 2, '2021-05-04 15:59:28', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_buku`
--

CREATE TABLE `rating_buku` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_buku` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rating_buku`
--

INSERT INTO `rating_buku` (`id`, `id_buku`, `id_siswa`, `rating`) VALUES
(1, 3, 3, 7),
(2, 3, 4, 8),
(3, 3, 5, 9),
(4, 4, 3, 7),
(5, 4, 2, 8),
(6, 4, 1, 10),
(7, 3, 1, 6),
(8, 1, 1, 10),
(9, 2, 1, 8),
(10, 5, 1, 8),
(11, 6, 1, 8),
(12, 7, 1, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jurusan` int(10) UNSIGNED DEFAULT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `no_induk` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `id_jurusan`, `id_user`, `no_induk`, `nama_siswa`, `alamat`, `telp`) VALUES
(1, 2, 3, '128882916', 'Chandra Dirgantara', '<p>\n	Jln Kemakmuran Indah</p>\n', NULL),
(2, 1, 4, '19928388', 'Goblin ', '<p>\n	oke brother</p>\n', '0738273'),
(3, 1, 2, '19923839', 'Anderiska', '<p>\n	Jln Margahayu</p>\n', NULL),
(4, 2, NULL, '1902038277', 'Imam Mahdin ', '<p>\n	Jln Burangrang</p>\n', '08635283255'),
(5, 2, NULL, '1992382377', 'Rizki Kalam Baihaqie', '<p>\n	Jln Kopo mesra</p>\n', '083625825'),
(6, 4, NULL, '99282382788', 'Joseph Garden', '<p>\n	Jln tahu sumedang</p>\n', '086632826'),
(7, 6, NULL, '19983762868009', 'Irfan Ramadhan', '<p>\n	Jln tah</p>\n', '0865283525'),
(8, 2, NULL, '919822783223687', 'Odeng', 'Jln xxx', '085382832');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_aktif` enum('1','2') DEFAULT NULL COMMENT '1: AKTIF\r\n2 : NON AKTIF',
  `level` enum('SISWA','GURU','DLL') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `is_aktif`, `level`) VALUES
(2, 'jamesbonlabalibi', '$2y$10$M6fEt662fuX.rbUsudhnJuCQpTis6OOLv15gnEBEbsgaYgEY5mKHC', '1', 'SISWA'),
(3, 'sharoon', '$2y$10$dqPAZtJH2aIRKKaAUfLA/e9dp2RmT/cj32/SNKAeRs8y5kmei4UJ.', '1', 'SISWA'),
(4, 'goblinvander', '$2y$10$dqPAZtJH2aIRKKaAUfLA/e9dp2RmT/cj32/SNKAeRs8y5kmei4UJ.', '1', 'SISWA'),
(5, 'jgarden100', '$2y$10$dqPAZtJH2aIRKKaAUfLA/e9dp2RmT/cj32/SNKAeRs8y5kmei4UJ.', '2', 'SISWA'),
(6, 'gilangsakti123', '$2y$10$dqPAZtJH2aIRKKaAUfLA/e9dp2RmT/cj32/SNKAeRs8y5kmei4UJ.', '2', 'SISWA'),
(7, 'ucingliar', '$2y$10$dqPAZtJH2aIRKKaAUfLA/e9dp2RmT/cj32/SNKAeRs8y5kmei4UJ.', '1', 'SISWA'),
(8, 'kalambaiq', '$2y$10$dqPAZtJH2aIRKKaAUfLA/e9dp2RmT/cj32/SNKAeRs8y5kmei4UJ.', '1', 'SISWA'),
(9, 'odeng', '$2y$10$eJjiBrijBY.4x6mRbHbr2e.u5jU.F5i5VikJP2G6dNOXCpr1gH6l.', '1', 'SISWA'),
(10, 'odadeng', '$2y$10$dqPAZtJH2aIRKKaAUfLA/e9dp2RmT/cj32/SNKAeRs8y5kmei4UJ.', '1', 'GURU'),
(13, 'asdasd', '$2y$10$/gT9fhlmlmSURmSFAJubHOQae9wJ4nyX4kd/8cZWIzHhohfNe0ESS', '2', 'GURU'),
(14, 'brader', '$2y$10$VZ/Nz5nGA4FuwOJUaJR4..bBjVckgedFeAgBKD5.6B7.TeVXK3mhG', '1', 'GURU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu_pinjam`
--

CREATE TABLE `waktu_pinjam` (
  `id` int(10) UNSIGNED NOT NULL,
  `hari` smallint(6) NOT NULL,
  `status` enum('1','2') NOT NULL COMMENT '1 : siswa\r\n2 : GURU'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `waktu_pinjam`
--

INSERT INTO `waktu_pinjam` (`id`, `hari`, `status`) VALUES
(1, 7, '1'),
(2, 14, '1'),
(4, 1, '1'),
(5, 3, '1'),
(6, 5, '1'),
(8, 365, '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_buku` (`nama_buku`),
  ADD UNIQUE KEY `slug_nama_buku` (`slug_nama_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pinjam` (`id_pinjam`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_induk` (`no_induk`),
  ADD UNIQUE KEY `id_user_2` (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `rating_buku`
--
ALTER TABLE `rating_buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user_2` (`id_user`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `waktu_pinjam`
--
ALTER TABLE `waktu_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `rating_buku`
--
ALTER TABLE `rating_buku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `waktu_pinjam`
--
ALTER TABLE `waktu_pinjam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD CONSTRAINT `detail_pinjam_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pinjam_ibfk_3` FOREIGN KEY (`id_pinjam`) REFERENCES `pinjam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru__FK__user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD CONSTRAINT `user_pengunjung` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rating_buku`
--
ALTER TABLE `rating_buku`
  ADD CONSTRAINT `rating_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
