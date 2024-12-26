-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2024 at 05:42 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon_mhs`
--

CREATE TABLE `calon_mhs` (
  `nis` varchar(20) DEFAULT NULL,
  `jk` varchar(30) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `file_pendukung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `calon_mhs`
--

INSERT INTO `calon_mhs` (`nis`, `jk`, `nama`, `telepon`, `alamat`, `foto`, `file_pendukung`) VALUES
('23432', 'Laki-laki', 'LIO', '88888888', 'JASKJD', '675be76d5af1e.png', '675be76d5af22.docx');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nind` char(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jabatan` varchar(44) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nind`, `nama`, `jabatan`, `alamat`) VALUES
('23126007', 'Alif Fajriadi', 'Asisten Praktikum Dosen', 'Kav Sungai Lekop Blok A no 05');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `angkatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nik` char(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `bagian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nik`, `nama`, `bagian`) VALUES
('333', 'Elza Dewi Syofyana', 'direktur1'),
('33124409', 'Han So Hee', 'Ketua Departement');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'alif', '$2y$10$HfABeKzQFCG118ysM83tDONPsrFRFF1j/IYE4v2dWesUNndtShy.W', 'admin'),
(88, 'mahasiswa', '$2y$10$BcDJDWUV.Eq0OZ6OvaoXfednmWmNtebSiDdi8y7DXqOg4e7oEU0.6', 'mahasiswa'),
(89, 'alipp', '$2y$10$74z6rYTjp4EE9KWRJ.Y7KO9hcZw/1w1rrcmYyLsjWky5l7Yyyxz.i', 'admin'),
(90, 'okee', '$2y$10$6FshouoEDJECvDo5EacLwOESoYdcmcMPSbiJRBl0eVUlGNYdGHOPe', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
