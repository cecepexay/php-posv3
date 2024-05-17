-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2014 at 02:11 PM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bandun66_adaro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT 'administrator',
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'admin',
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `level`, `alamat`, `no_telp`, `email`, `blokir`, `id_session`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Farhan Nandi Putra', 'admin', 'Jakarta', '08123456789', 'Farhan.Putra@ptadaro.com', 'N', '3be6b8ff763747d023d1a96605267e89'),
(4, 'rahmat', 'af2a4c9d4c4956ec9d6ba62213eed568', 'rahmat', 'admin', 'rahmat', '089657241465', 'rahmat@gmail.com', 'N', 'b1a4atl0f4mbpsl31n8vpnacb4');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_info` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `id_info`, `nama`) VALUES
(32, 'SP', 'Surat Penting'),
(41, 'gg', 'ddd');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_pegawai` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `id_kategori`, `nama`, `id_pegawai`) VALUES
(32, 'SP', 'Surat Penting', 8),
(38, 'xxx', 'xxx', 11),
(39, '121', 'Surat Biasas', 11),
(40, 'xx', 'xx', 8),
(41, 'sd', 'asd', 8);

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('pegawai','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=75 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Manajemen Admin', '?module=admin', '', '', 'N', 'admin', 'N', 2, ''),
(18, 'Surat Masuk', '?module=surat_masuk', '', '', 'Y', 'pegawai', 'Y', 6, 'semua-berita.html'),
(10, 'Manajemen Modul', '?module=modul', '', '', 'N', 'admin', 'N', 1, ''),
(31, 'Manajemen Rak', '?module=rak', '', '', 'Y', 'pegawai', 'Y', 5, ''),
(41, 'Manajemen Kategori', ' ?module=kategori', '', '', 'Y', 'pegawai', 'Y', 4, 'semua-agenda.html'),
(67, 'Home', '?module=home', '', '', 'Y', '', 'Y', 1, ''),
(68, 'Surat Keluar', '?module=surat_keluar', '', '', 'Y', 'pegawai', 'Y', 7, ''),
(69, 'Laporan Surat Masuk', '?module=laporan_surat_masuk', '', '', 'Y', 'pegawai', 'Y', 9, ''),
(70, 'Laporan Surat Keluar', '?module=laporan_surat_keluar', '', '', 'Y', 'pegawai', 'Y', 10, ''),
(72, 'Informasi', '?module=info', '', '', 'Y', 'pegawai', 'Y', 11, '');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(9) NOT NULL AUTO_INCREMENT,
  `nip` char(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(100) NOT NULL,
  `password_login` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'pegawai',
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `jabatan` varchar(200) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nip`, `nama_lengkap`, `username_login`, `password_login`, `level`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_telp`, `email`, `foto`, `website`, `jabatan`, `blokir`, `id_session`) VALUES
(8, 'G0001', 'Asep Setiawan', 'pegawai', '047aeeb234644b9e2d4138ed3bc7976a', 'pegawai', 'Bandung, Indonesia', 'bandung', '1977-06-26', 'L', 'Islam', '089657241465', 'investasi.saya@gmail.com', 'BHINNEKA.jpg', 'www.contoh-ta.com', 'Dosen', 'N', 'ed1auvdqr7n6245pdvajfe35b2'),
(11, 'G', 'a', 'pegawai2', 'fa23517aa1adfaab707494340009a330', 'pegawai', 'alamat', 'bandung', '2013-12-31', 'L', 'Islam', '089657241465', 'investasi.saya@gmail.com', 'S003.jpg', 'http://www.contoh-ta.com', 'Admnistrasi', 'N', 'ktb52ju52855dtd4vme7fhv7v1');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE IF NOT EXISTS `rak` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_rak` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kategori` varchar(5) NOT NULL,
  `id_pegawai` int(9) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id`, `id_rak`, `nama`, `id_kategori`, `id_pegawai`, `deskripsi`) VALUES
(22, 'Rak02', 'Rak02', 'SP', 8, 'surat penting'),
(26, 'xxx', 'xxx', 'xxx', 11, 'edit file ini jangan di hapus untuk pertama kali mengisi'),
(27, 'Rak03', 'Rak 03', 'SP', 8, 'edit file ini jangan di hapus untuk pertama kali mengisi'),
(28, '111', '1111', '121', 11, 'edit file ini jangan di hapus untuk pertama kali mengisi');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE IF NOT EXISTS `surat_keluar` (
  `id_file` int(7) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `id_kategori` varchar(5) NOT NULL,
  `id_rak` varchar(5) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `tgl_posting` date NOT NULL,
  `pembuat` varchar(50) NOT NULL,
  `hits` int(3) NOT NULL,
  `pengirim` varchar(60) NOT NULL,
  `lampiran` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tgl_surat` date NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_file`, `judul`, `id_kategori`, `id_rak`, `nama_file`, `tgl_posting`, `pembuat`, `hits`, `pengirim`, `lampiran`, `deskripsi`, `no_surat`, `tgl_surat`) VALUES
(1, 'd', '121', '111', 'logo.jpg', '2014-01-14', '11', 0, 'cc', 'ccddd', 'edit file ini jangan di hapus untuk pertama kali mengisi', 'cc', '2014-01-01'),
(100, 'Surat Penting', 'SP', 'Rak02', 'x.xlsx', '2014-01-14', '8', 0, 'Rahmat Affandi', '2', 'edit file ini jangan di hapus untuk pertama kali mengisi', 'SK001', '2014-01-14'),
(101, 'asd', 'SP', 'Rak02', 'bekam image.jpg', '2014-01-22', '8', 0, 'sdd', 'asd', 'asdasd', 'asd', '2014-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `id_file` int(7) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `id_kategori` varchar(5) NOT NULL,
  `id_rak` varchar(5) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `tgl_posting` date NOT NULL,
  `pembuat` varchar(50) NOT NULL,
  `hits` int(3) NOT NULL,
  `pengirim` varchar(60) NOT NULL,
  `lampiran` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `no_surat` varchar(60) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_terima` date NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_file`, `judul`, `id_kategori`, `id_rak`, `nama_file`, `tgl_posting`, `pembuat`, `hits`, `pengirim`, `lampiran`, `deskripsi`, `no_surat`, `tgl_surat`, `tgl_terima`) VALUES
(101, 'Surat Pernikahan', '121', '111', 'toko online.png', '2014-04-29', '11', 0, '5', '23', 'edit file', 'SK003', '1950-01-01', '2014-01-01'),
(100, 'Undangan', '121', '111', 'simpas.png', '2014-04-28', '11', 0, 'Jajang Mulyana', '2', 'edit file ini', 'SK002', '1950-01-01', '0000-00-00'),
(102, 'aweu', 'SP', 'Rak03', 'BAB II.docx', '2014-04-29', '8', 0, 'dadang', '2', 'aweu', 'aweu', '2014-04-29', '2014-04-30'),
(103, 'Retribusi', 'SP', 'Rak03', 'xss.xlsx', '2014-04-29', '8', 0, 'PT. Banshu Indonesia', '1', 'Memenuhi Syarat', 'SK00123', '2014-04-29', '2014-04-29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
