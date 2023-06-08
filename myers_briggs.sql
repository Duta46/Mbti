-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2017 at 02:23 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myers_briggs`
--
CREATE DATABASE IF NOT EXISTS `myers_briggs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `myers_briggs`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` int(6) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_dpa` int(11) DEFAULT NULL,
  `nama` varchar(45) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `divisi` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `id_mahasiswa`, `id_dpa`, `nama`, `username`, `password`, `divisi`) VALUES
(1, NULL, 1, 'Dosen 1', '123456789', '25f9e794323b453885f5181f1b624d0b', 'DPA'),
(2, 2, NULL, 'Muhamad Arif Syaifuddin', '18192017', 'e22969466bf4cb9c1bfe89d2a7249af2', 'Mahasiswa'),
(3, NULL, NULL, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `dpa`
--

CREATE TABLE `dpa` (
  `id_dpa` int(12) NOT NULL,
  `id_th_ajaran` int(12) NOT NULL,
  `nip` varchar(16) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dpa`
--

INSERT INTO `dpa` (`id_dpa`, `id_th_ajaran`, `nip`, `nama`, `email`, `no_hp`, `foto`) VALUES
(1, 1, '123456789', 'Dosen 1', 'a@a.com', '123456789', '123456789.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(12) NOT NULL,
  `bobot` int(11) NOT NULL,
  `nama_jawaban` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `bobot`, `nama_jawaban`) VALUES
(1, 1, 'Tidak Sesuai dengan Diri Saya'),
(2, 2, 'Mirip dengan Diri Saya'),
(3, 3, 'Sangat Sesuai dengan Diri Saya');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` char(3) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('EXT', 'Extrovert'),
('FLG', 'Feeling'),
('INT', 'Introvert'),
('JDG', 'Judging'),
('NTV', 'Intuitive'),
('PCV', 'Perceiving'),
('SNG', 'Sensing'),
('TKG', 'Thinking');

-- --------------------------------------------------------

--
-- Table structure for table `konten_soal`
--

CREATE TABLE `konten_soal` (
  `kode_soal` varchar(5) NOT NULL,
  `id_kategori` char(3) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `nama_konten` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konten_soal`
--

INSERT INTO `konten_soal` (`kode_soal`, `id_kategori`, `id_soal`, `nama_konten`) VALUES
('EXT01', 'EXT', 1, 'Saya suka bersosialisasi dan bicara dengan orang lain'),
('EXT02', 'EXT', 1, 'Saya adalah orang yang ramah'),
('EXT03', 'EXT', 1, 'Saya tetap merasa nyaman ketika bertemu dengan orang baru'),
('EXT04', 'EXT', 1, 'Saya senang menjadi pusat perhatian'),
('EXT05', 'EXT', 1, 'Saya lebih suka berbicara daripada menulis'),
('EXT06', 'EXT', 1, 'Saya dapat mengobrol dengan siapa saja'),
('EXT07', 'EXT', 1, 'Saya memiliki banyak teman dan kenalan'),
('EXT08', 'EXT', 1, 'Saya merasa kesepian jika tidak berada dengan orang lain'),
('EXT09', 'EXT', 1, 'Saya harus menahan diri agar orang lain memiliki kesempatan untuk berbicara'),
('EXT10', 'EXT', 1, 'Saya mengembangkan ide melalui diskusi'),
('FLG01', 'FLG', 3, 'Saya dapat memahami perasaan orang lain'),
('FLG02', 'FLG', 3, 'Saya suka berbicara hal yang berkaitan dengan perasaan'),
('FLG03', 'FLG', 3, 'Saya mempertimbangkan dampak dari keputusan yang saya ambil'),
('FLG04', 'FLG', 3, 'Saya tidak terlalu suka mengkritik orang lain'),
('FLG05', 'FLG', 3, 'Saya suka bila diakui dan dihargai oleh orang lain'),
('FLG06', 'FLG', 3, 'Saya dikenal sebagai pribadi yang hangat'),
('FLG07', 'FLG', 3, 'Saya sedikit kesulitan untuk mengungkapkan keinginan saya'),
('FLG08', 'FLG', 3, 'Saya sukar menolak permintaan orang lain'),
('FLG09', 'FLG', 3, 'Saya memegang teguh nilai-nilai yang ada di masyarakat'),
('FLG10', 'FLG', 3, 'Saya seringkali sensitif terhadap kritik yang diberikan secara personal'),
('INT01', 'INT', 1, 'Saya canggung berada di antara orang yang baru saya kenal'),
('INT02', 'INT', 1, 'Saya lebih suka menghabiskan waktu sendirian'),
('INT03', 'INT', 1, 'Saya hanya memiliki beberapa teman dekat'),
('INT04', 'INT', 1, 'Saya lebih suka jika orang lain menghampiri saya'),
('INT05', 'INT', 1, 'Saya dikenal sebagai orang yang pemalu'),
('INT06', 'INT', 1, 'Saya membutuhkan waktu untuk memikirkan apa yang saya katakan'),
('INT07', 'INT', 1, 'Saya tidak nyaman saat menghabiskan waktu dengan orang lain dalam waktu yang lama'),
('INT08', 'INT', 1, 'Saya lebih suka bekerja sendiri'),
('INT09', 'INT', 1, 'Saya selektif dalam memilih teman'),
('INT10', 'INT', 1, 'Saya menghindar untuk menjadi pusat perhatian'),
('JDG01', 'JDG', 4, 'Saya susah berkonsentrasi jika lingkungan sekitar saya berantakan'),
('JDG02', 'JDG', 4, 'Saya membuat daftar apa yang harus dilakukan'),
('JDG03', 'JDG', 4, 'Saya merasa puas jika telah menyelesaikan seluruh tugas saya'),
('JDG04', 'JDG', 4, 'Saya tidak suka mengubah rencana yang telah saya buat'),
('JDG05', 'JDG', 4, 'Saya selalu meletakkan sesuatu sesuai dengan tempatnya'),
('JDG06', 'JDG', 4, 'Sebelum memulai suatu pekerjaan, saya memastikan semua barang yang diperlukan telah terpenuhi'),
('JDG07', 'JDG', 4, 'Datang tepat waktu adalah suatu hal yang penting bagi saya'),
('JDG08', 'JDG', 4, 'Saya membuat jadwal dan waktu yang dibutuhkan untuk bekerja'),
('JDG09', 'JDG', 4, 'Saya tidak suka jika ada tugas yang belum terselesaikan'),
('JDG10', 'JDG', 4, 'Saya harus menyelesaikan pekerjaan saya sebelum beristirahat'),
('NTV01', 'NTV', 2, 'Saya suka berspekulasi dengan berbagai cara'),
('NTV02', 'NTV', 2, 'Saya sering menggunakan analogi untuk menjelaskan sesuatu'),
('NTV03', 'NTV', 2, 'Saya cenderung mengikuti inspirasi'),
('NTV04', 'NTV', 2, 'Saya suka memikirkan berbagai kemungkinan yang muncul'),
('NTV05', 'NTV', 2, 'Saya kurang menyukai tugas rutin dan monoton'),
('NTV06', 'NTV', 2, 'Saya senang memecahkan masalah yang kompleks'),
('NTV07', 'NTV', 2, 'Saya menyukai perubahan'),
('NTV08', 'NTV', 2, 'Saya kurang dapat memperhatikan sesuatu yang terjadi saat ini'),
('NTV09', 'NTV', 2, 'Saya cenderung melihat sesuatu secara menyeluruh'),
('NTV10', 'NTV', 2, 'Saya suka melakukan inovasi'),
('PCV01', 'PCV', 4, 'Saya dapat bersikap santai dan fleksibel terhadap perubahan rencana'),
('PCV02', 'PCV', 4, 'Saya dapat mengerjakan beberapa tugas dalam waktu yang bersamaan'),
('PCV03', 'PCV', 4, 'Saya senang memulai pekerjaan baru walaupun ada pekerjaan yang belum selesai'),
('PCV04', 'PCV', 4, 'Saya senang bekerja mendekati deadline'),
('PCV05', 'PCV', 4, 'Saya tidak terlalu suka membuat jadwal kegiatan'),
('PCV06', 'PCV', 4, 'Saya tidak terlalu rapi dalam mengatur barang-barang'),
('PCV07', 'PCV', 4, 'Saya dapat beristirahat dan bersenang-senang walaupun ada tugas yang belum selesai'),
('PCV08', 'PCV', 4, 'Saya cenderung menunda keputusan yang harus diambil'),
('PCV09', 'PCV', 4, 'Saya terbuka terhadap kesempatan yang muncul tiba-tiba'),
('PCV10', 'PCV', 4, 'Saya dapat menerima pandangan-pandangan baru'),
('SNG01', 'SNG', 2, 'Saya cenderung praktis, realistis, dan bekerja berdasarkan fakta'),
('SNG02', 'SNG', 2, 'Saya lebih menyukai praktek dibandingkan teori'),
('SNG03', 'SNG', 2, 'Saya menyukai tugas yang memberikan hasil konkrit'),
('SNG04', 'SNG', 2, 'Saya melakukan tugas secara bertahap'),
('SNG05', 'SNG', 2, 'Saya dapat menjadi observer yang baik'),
('SNG06', 'SNG', 2, 'Saya senang dengan pekerjaan keterampilan'),
('SNG07', 'SNG', 2, 'Saya senang mengembangkan keterampilan yang saya miliki'),
('SNG08', 'SNG', 2, 'Saya menyukai tugas-tugas rutin'),
('SNG09', 'SNG', 2, 'Saya menggunakan pengalaman dan cara standar dalam pemecahan masalah'),
('SNG10', 'SNG', 2, 'Saya tidak suka berspekulasi tentang masa depan'),
('TKG01', 'TKG', 3, 'Dalam membuat keputusan, saya cenderung berpikir secara logis'),
('TKG02', 'TKG', 3, 'Saya suka berdebat dan mempertahankan pendapat saya'),
('TKG03', 'TKG', 3, 'Saya kurang dapat memerhatikan perasaan orang lain'),
('TKG04', 'TKG', 3, 'Saya seringkali menggunakan analisa yang logis'),
('TKG05', 'TKG', 3, 'Saya dapat mengkritik orang lain secara langsung'),
('TKG06', 'TKG', 3, 'Saya lebih memperhatikan ide/pikiran orang lain dibandingkan perasaannya'),
('TKG07', 'TKG', 3, 'Saya kurang suka menampilkan emosi saya di depan umuma'),
('TKG08', 'TKG', 3, 'Saya kurang mempertimbangkan penilaian maupun lingkungan sekitar'),
('TKG09', 'TKG', 3, 'Saya memegang prinsip atau aturan yang berlaku'),
('TKG10', 'TKG', 3, 'Saya dapat memutuskan sesuatu tanpa pertimbangan orang lain');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(12) NOT NULL,
  `id_dpa` int(12) DEFAULT NULL,
  `nim` int(12) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `alamat` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `program_studi` varchar(45) NOT NULL,
  `indeks_prestasi` varchar(4) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `id_dpa`, `nim`, `nama`, `alamat`, `email`, `program_studi`, `indeks_prestasi`, `foto`) VALUES
(2, 1, 123456, 'Muhamad Arif Syaifuddin', 'Jl Cempaka No 107', 'a@a.com', 'Teknik Informatika', '3.4', '18192017.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_result` int(11) NOT NULL,
  `kode_soal` varchar(5) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_result`, `kode_soal`, `nilai`) VALUES
(1, 'EXT01', 1),
(1, 'EXT02', 2),
(1, 'EXT03', 3),
(1, 'EXT04', 2),
(1, 'EXT05', 1),
(1, 'INT01', 1),
(1, 'INT02', 2),
(1, 'INT03', 3),
(1, 'INT04', 2),
(1, 'INT05', 1),
(1, 'NTV01', 1),
(1, 'NTV02', 2),
(1, 'NTV03', 3),
(1, 'NTV04', 3),
(1, 'NTV05', 2),
(1, 'SNG01', 1),
(1, 'SNG02', 2),
(1, 'SNG03', 3),
(1, 'SNG04', 2),
(1, 'SNG05', 1),
(1, 'FLG01', 1),
(1, 'FLG02', 2),
(1, 'FLG03', 3),
(1, 'FLG04', 2),
(1, 'FLG05', 1),
(1, 'TKG01', 1),
(1, 'TKG02', 2),
(1, 'TKG03', 3),
(1, 'TKG04', 3),
(1, 'TKG05', 2),
(1, 'JDG01', 1),
(1, 'JDG02', 1),
(1, 'JDG03', 2),
(1, 'JDG04', 3),
(1, 'JDG05', 2),
(1, 'PCV01', 1),
(1, 'PCV02', 2),
(1, 'PCV03', 1),
(1, 'PCV04', 2),
(1, 'PCV05', 3),
(2, 'EXT01', 1),
(2, 'EXT02', 2),
(2, 'EXT03', 3),
(2, 'EXT04', 3),
(2, 'EXT05', 2),
(2, 'INT01', 1),
(2, 'INT02', 3),
(2, 'INT03', 1),
(2, 'INT04', 2),
(2, 'INT05', 3),
(2, 'NTV01', 3),
(2, 'NTV02', 2),
(2, 'NTV03', 1),
(2, 'NTV04', 2),
(2, 'NTV05', 2),
(2, 'SNG01', 1),
(2, 'SNG02', 2),
(2, 'SNG03', 3),
(2, 'SNG04', 2),
(2, 'SNG05', 3),
(2, 'FLG01', 1),
(2, 'FLG02', 1),
(2, 'FLG03', 2),
(2, 'FLG04', 3),
(2, 'FLG05', 2),
(2, 'TKG01', 1),
(2, 'TKG02', 2),
(2, 'TKG03', 3),
(2, 'TKG04', 2),
(2, 'TKG05', 3),
(2, 'JDG01', 1),
(2, 'JDG02', 1),
(2, 'JDG03', 3),
(2, 'JDG04', 2),
(2, 'JDG05', 2),
(2, 'PCV01', 1),
(2, 'PCV02', 3),
(2, 'PCV03', 2),
(2, 'PCV04', 3),
(2, 'PCV05', 2),
(3, 'EXT01', 2),
(3, 'EXT02', 3),
(3, 'EXT03', 3),
(3, 'EXT04', 3),
(3, 'EXT05', 3),
(3, 'INT01', 2),
(3, 'INT02', 2),
(3, 'INT03', 2),
(3, 'INT04', 3),
(3, 'INT05', 3),
(3, 'NTV01', 3),
(3, 'NTV02', 3),
(3, 'NTV03', 3),
(3, 'NTV04', 2),
(3, 'NTV05', 2),
(3, 'SNG01', 2),
(3, 'SNG02', 3),
(3, 'SNG03', 2),
(3, 'SNG04', 3),
(3, 'SNG05', 2),
(3, 'FLG01', 1),
(3, 'FLG02', 2),
(3, 'FLG03', 3),
(3, 'FLG04', 3),
(3, 'FLG05', 2),
(3, 'TKG01', 1),
(3, 'TKG02', 3),
(3, 'TKG03', 2),
(3, 'TKG04', 2),
(3, 'TKG05', 3),
(3, 'JDG01', 1),
(3, 'JDG02', 2),
(3, 'JDG03', 1),
(3, 'JDG04', 2),
(3, 'JDG05', 3),
(3, 'PCV01', 3),
(3, 'PCV02', 2),
(3, 'PCV03', 1),
(3, 'PCV04', 2),
(3, 'PCV05', 3),
(4, 'EXT01', 2),
(4, 'EXT02', 2),
(4, 'EXT03', 1),
(4, 'EXT04', 2),
(4, 'EXT05', 1),
(4, 'INT01', 2),
(4, 'INT02', 3),
(4, 'INT03', 2),
(4, 'INT04', 2),
(4, 'INT05', 2),
(4, 'NTV01', 1),
(4, 'NTV02', 1),
(4, 'NTV03', 2),
(4, 'NTV04', 2),
(4, 'NTV05', 2),
(4, 'SNG01', 3),
(4, 'SNG02', 2),
(4, 'SNG03', 1),
(4, 'SNG04', 3),
(4, 'SNG05', 2),
(4, 'FLG01', 2),
(4, 'FLG02', 2),
(4, 'FLG03', 2),
(4, 'FLG04', 3),
(4, 'FLG05', 2),
(4, 'TKG01', 3),
(4, 'TKG02', 2),
(4, 'TKG03', 1),
(4, 'TKG04', 2),
(4, 'TKG05', 2),
(4, 'JDG01', 1),
(4, 'JDG02', 2),
(4, 'JDG03', 3),
(4, 'JDG04', 3),
(4, 'JDG05', 2),
(4, 'PCV01', 1),
(4, 'PCV02', 2),
(4, 'PCV03', 3),
(4, 'PCV04', 2),
(4, 'PCV05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id_result` int(11) NOT NULL,
  `id_tipekepribadian` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `tgl_pengerjaan` datetime NOT NULL,
  `waktu_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id_result`, `id_tipekepribadian`, `id_mahasiswa`, `tgl_pengerjaan`, `waktu_selesai`) VALUES
(1, 3, 2, '2017-06-07 00:00:00', '08:29:39'),
(2, 8, 2, '2017-06-12 06:33:40', '00:04:00'),
(3, 2, 2, '2017-06-12 06:35:08', '00:00:27'),
(4, 13, 2, '2017-06-12 06:38:55', '00:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `no_urut` int(2) NOT NULL,
  `nama_soal` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `no_urut`, `nama_soal`) VALUES
(1, 1, 'Darimanakah Kita Memperoleh Energi'),
(2, 2, 'Bagaimanakah Cara Kita Memperoleh Informasi'),
(3, 3, 'Bagaimana Cara Kita Mengambil Keputusan'),
(4, 4, 'Cara Kerja Seperti Apa yang Lebih Kita Sukai');

-- --------------------------------------------------------

--
-- Table structure for table `th_ajaran`
--

CREATE TABLE `th_ajaran` (
  `id_th_ajaran` int(12) NOT NULL,
  `nama_th_ajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `th_ajaran`
--

INSERT INTO `th_ajaran` (`id_th_ajaran`, `nama_th_ajaran`) VALUES
(1, '2017/2018'),
(2, '2016/2017');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kepribadian`
--

CREATE TABLE `tipe_kepribadian` (
  `id_tipekepribadian` int(11) NOT NULL,
  `nama` varchar(12) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_kepribadian`
--

INSERT INTO `tipe_kepribadian` (`id_tipekepribadian`, `nama`, `deskripsi`) VALUES
(1, 'ENFJ', '- Ambisius dan pekerja keras.\n- Teratur dan berorientasi pada tujuan.\n- Bertanggungjawab, diplomatis dan berorientasi pada hasil.\n- Cenderung tergesa-gesa dalam menyelesaikan sesuatu.\n- Memiliki rasa '),
(2, 'ENFP', '- Kreatif dan penuh akan ide-ide baru.\r\n- Cepat dalam menyelesaikan suatu masalah.\r\n- Menyukai pekerjaan dalam kelompok.\r\n- Antusias dalam memulai pekerjaan.\r\n- Suka menolong, dapat berempati dan mamp'),
(3, 'ENTJ', '- Berpikir analitis, logis dan inovatif.\r\n- Mampu memecahkan masalah yang kompleks.\r\n- Melihat masalah sebagai tantangan.\r\n- Memiliki kemampuan menjadi seorang pemimpin.\r\n- Suka berterus terang dan am'),
(4, 'ENTP', '- Inovatif, kreatif dan menyukai perubahan.\r\n- Dapat mengerjakan beberapa hal sekaligus.\r\n- Kurang dapat berfokus pada satu hal.\r\n- Antusias, menarik dan mudah bergaul.\r\n- Suka berdebat.\r\n- Berani men'),
(5, 'ESFJ', '- terorganisir dan selalu berusaha dalam menyelesaikan pekerjaannya.\r\nMenyukai pekerjaan yang rutin dan terjadwal.\r\n- Efesien dan teratur.\r\n- Kooperatif dan senang bekerja dalam kelompok.\r\n- Kurang me'),
(6, 'ESFP', '- Menyukai tantangan dan variasi dalam kegiatan.\r\n- Lebih mudah untuk mengingat fakta daripada teori.\r\n- Mengerjakan tugas dengan mendekati batas waktu yang diberikan.\r\n- Cenderung ingin cepat dalam m'),
(7, 'ESTJ', '- Mampu mengorganisir kegiatan dengan baik.\r\n- Mampu memanfaatkan sumber dan waktu secara efektif.\r\n- Fokus pada penyelesaian masalah.\r\n- Suka mengorganisir dan menjalankan aktivitas.\r\n- Pekerja keras'),
(8, 'ESTP', '- Realistis, pragmatis dan bekerja berdasarkan fakta.\r\n- Berorientasi pada hasil.\r\n- Mampu menerima dan mengingat banyak informasi.\r\n- Menyelesaikan tugas dengan mendekati deadline.\r\n- Mampu bekerja d'),
(9, 'INFJ', '- Kreatif, original dan idealis.\r\n- Berhati-hati dalam bertindak.\r\n- Memiliki pendirian yang tegas.\r\n- Berusaha mencari cara yang tepat agar dapat memberikan hasil yang terbaik.\r\n- Menuntut agar orang'),
(10, 'INFP', '- Idealis, sensitif dan kreatif.\r\n- Kurang menyukai aturan, jadwal dan deadline.\r\n- Kurang menyukai situasi kompetitif.\r\n- Sabar dalam mengerjakan tugas yang kompleks.\r\n- Melihat segala sesuatu dari b'),
(11, 'INTJ', '- Mandiri dan senang bekerja sendiri.\r\n- Teratur dan bertanggungjawab.\r\n- Dapat memecahkan masalah secara kreatif.\r\n- Memiliki ide serta gagasan ke depan.\r\n- Cenderung teoritis.\r\n- Mudah merasa frusta'),
(12, 'INTP', '- Bersikap analitis dan terampil dalam menyelesaikan sesuatu.\r\n- Mampu memecahkan masalah yang kompleks dan konseptual.\r\n- Senang bekerja sendiri.\r\n- Memiliki rasa ingin tahu yang tinggi dan memiliki '),
(13, 'ISFJ', '- Teliti, akurat dan bersungguh-sungguh.\r\n- Memiliki ingatan yang baik terhadap detail.\r\n- Menyelesaikan tugas dengan tepat waktu.\r\n- Mengerjakan sesuatu secara bertahap.\r\n- Fokus pada satu kegiatan.\r'),
(14, 'ISFP', '- Memiliki standard yang tinggi dalam bekerja.\r\n- Fleksibel dan mudah beradaptasi.\r\n- Sensitif terhadap konflik dan menghindari perbedaan pendapat.\r\n- Tidak menyukai peraturan dan struktur yang ketat.'),
(15, 'ISTJ', '- Praktis, logis dan realistis.\r\n- Lebih mudah mengingat informasi dalam bentuk fakta.\r\n- Dapat mengerjakan sesuatu secara detail.\r\n- Suka bekerja sendiri.\r\n- Membutuhkan petunjuk yang jelas dalam men'),
(16, 'ISTP', '- Logis, realistis dan praktis.\r\n- Lebih menyukai tindakan dibandingkan berbicara.\r\n- Menyukai tantangan serta mampu menangani situasi kritis.\r\n- Fokus pada inti dari permasalahan.\r\n- Cenderung mengab');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dpa` (`id_dpa`);

--
-- Indexes for table `dpa`
--
ALTER TABLE `dpa`
  ADD PRIMARY KEY (`id_dpa`),
  ADD KEY `id_th_ajaran` (`id_th_ajaran`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `konten_soal`
--
ALTER TABLE `konten_soal`
  ADD PRIMARY KEY (`kode_soal`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_dpa` (`id_dpa`),
  ADD KEY `id_dpa_2` (`id_dpa`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD KEY `id_result` (`id_result`),
  ADD KEY `kode_soal` (`kode_soal`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id_result`),
  ADD KEY `id_tipekepribadian` (`id_tipekepribadian`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `th_ajaran`
--
ALTER TABLE `th_ajaran`
  ADD PRIMARY KEY (`id_th_ajaran`);

--
-- Indexes for table `tipe_kepribadian`
--
ALTER TABLE `tipe_kepribadian`
  ADD PRIMARY KEY (`id_tipekepribadian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dpa`
--
ALTER TABLE `dpa`
  MODIFY `id_dpa` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `th_ajaran`
--
ALTER TABLE `th_ajaran`
  MODIFY `id_th_ajaran` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipe_kepribadian`
--
ALTER TABLE `tipe_kepribadian`
  MODIFY `id_tipekepribadian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`id_dpa`) REFERENCES `dpa` (`id_dpa`);

--
-- Constraints for table `dpa`
--
ALTER TABLE `dpa`
  ADD CONSTRAINT `dpa_ibfk_1` FOREIGN KEY (`id_th_ajaran`) REFERENCES `th_ajaran` (`id_th_ajaran`);

--
-- Constraints for table `konten_soal`
--
ALTER TABLE `konten_soal`
  ADD CONSTRAINT `konten_soal_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `konten_soal_ibfk_2` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`) ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_dpa`) REFERENCES `dpa` (`id_dpa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_result`) REFERENCES `result` (`id_result`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kode_soal`) REFERENCES `konten_soal` (`kode_soal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`id_tipekepribadian`) REFERENCES `tipe_kepribadian` (`id_tipekepribadian`),
  ADD CONSTRAINT `result_ibfk_3` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
