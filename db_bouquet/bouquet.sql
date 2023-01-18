-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jan 2023 pada 02.52
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bouquet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `header` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `kode`, `nama`, `header`) VALUES
(2, '112', 'Kas', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `kode_aset` int(4) NOT NULL,
  `nama_aset` varchar(20) NOT NULL,
  `umur_aset` varchar(20) NOT NULL,
  `harga_aset` int(8) NOT NULL,
  `merk_aset` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`kode_aset`, `nama_aset`, `umur_aset`, `harga_aset`, `merk_aset`) VALUES
(101, 'Mesin Cuci 1', '60 bulan', 5700000, 'Samsung'),
(102, 'Mesin Cuci 2', '60 bulan', 5700000, 'Samsung'),
(103, 'Mesin Cuci 3', '60 bulan', 3090000, 'LG'),
(104, 'Mesin Cuci 4', '12 bulan', 4600000, 'Sharp'),
(105, 'Mesin Cuci 5', '12 bulan', 4600000, 'Sharp'),
(106, 'Mesin Cuci 6', '12 bulan', 4600000, 'Sharp'),
(201, 'Mesin Pengering 1', '60 bulan', 3700000, 'Samsung'),
(202, 'Mesin Pengering 2', '60 bulan', 3700000, 'Samsung'),
(203, 'Mesin Pengering 3', '12 bulan', 2690000, 'LG'),
(204, 'Mesin Pengering 3', '12 bulan', 2690000, 'LG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `investor`
--

CREATE TABLE `investor` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `asal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `investor`
--

INSERT INTO `investor` (`id`, `kode`, `nama`, `asal`) VALUES
(2, 'INV001', 'Diffo Elza', 'Bandung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `kode_jurnal` int(4) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `kode_akun` char(5) NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `posisi_db_cr` varchar(10) NOT NULL,
  `nominal` int(10) NOT NULL,
  `id_jurnal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`kode_jurnal`, `tgl_jurnal`, `kode_akun`, `nama_akun`, `posisi_db_cr`, `nominal`, `id_jurnal`) VALUES
(1, '2016-01-02', '111', 'KAS', 'DEBIT', 25000000, 18),
(1, '2016-01-02', '311', 'MODAL', 'KREDIT', 25000000, 19),
(2, '2021-11-30', '112', 'PIUTANG USAHA', 'DEBIT', 260000, 20),
(2, '2021-11-30', '112', 'PIUTANG USAHA', 'KREDIT', 260000, 21),
(3, '2021-10-30', '112', 'PIUTANG USAHA', 'DEBIT', 149000, 22),
(3, '2021-10-30', '112', 'PIUTANG USAHA', 'KREDIT', 149000, 23),
(3, '2021-09-30', '112', 'PIUTANG USAHA', 'DEBIT', 230000, 24),
(3, '2021-09-30', '112', 'PIUTANG USAHA', 'KREDIT', 230000, 25),
(4, '2021-08-30', '112', 'PIUTANG USAHA', 'DEBIT', 97000, 26),
(4, '2021-08-30', '112', 'PIUTANG USAHA', 'KREDIT', 97000, 27),
(5, '2021-07-30', '112', 'PIUTANG USAHA', 'DEBIT', 640000, 28),
(5, '2021-07-30', '112', 'PIUTANG USAHA', 'KREDIT', 640000, 29),
(6, '2021-11-30', '123', 'PENDAPATAN JASA', 'DEBIT', 16900000, 30),
(6, '2021-11-30', '123', 'PENDAPATAN JASA', 'KREDIT', 16900000, 31),
(6, '2021-11-30', '123', 'PENDAPATAN JASA', 'DEBIT', 16900000, 32),
(6, '2021-11-30', '123', 'PENDAPATAN JASA', 'KREDIT', 16900000, 33),
(7, '2021-11-30', '123', 'PENDAPATAN JASA', 'DEBIT', 16900000, 34),
(7, '2021-11-30', '123', 'PENDAPATAN JASA', 'KREDIT', 16900000, 35),
(8, '2021-11-30', '123', 'PENDAPATAN JASA', 'DEBIT', 260000, 36),
(8, '2021-11-30', '123', 'PENDAPATAN JASA', 'KREDIT', 260000, 37),
(8, '2021-10-30', '123', 'PENDAPATAN JASA', 'DEBIT', 15400000, 38),
(8, '2021-10-30', '123', 'PENDAPATAN JASA', 'KREDIT', 15400000, 39),
(9, '2021-10-30', '123', 'PENDAPATAN JASA', 'DEBIT', 149000, 40),
(9, '2021-10-30', '123', 'PENDAPATAN JASA', 'KREDIT', 149000, 41),
(10, '2021-09-30', '123', 'PENDAPATAN JASA', 'DEBIT', 15900000, 42),
(10, '2021-09-30', '123', 'PENDAPATAN JASA', 'KREDIT', 15900000, 43),
(11, '2021-09-30', '123', 'PENDAPATAN JASA', 'DEBIT', 230000, 44),
(11, '2021-09-30', '123', 'PENDAPATAN JASA', 'KREDIT', 230000, 45),
(12, '2021-08-30', '123', 'PENDAPATAN JASA', 'DEBIT', 16100000, 46),
(12, '2021-08-30', '123', 'PENDAPATAN JASA', 'KREDIT', 16100000, 47),
(13, '2021-08-30', '123', 'PENDAPATAN JASA', 'DEBIT', 97000, 48),
(13, '2021-08-30', '123', 'PENDAPATAN JASA', 'KREDIT', 97000, 49),
(14, '2021-07-30', '123', 'PENDAPATAN JASA', 'DEBIT', 14980000, 50),
(14, '2021-07-30', '123', 'PENDAPATAN JASA', 'KREDIT', 14980000, 51),
(15, '2021-07-30', '123', 'PENDAPATAN JASA', 'DEBIT', 640000, 52),
(15, '2021-07-30', '123', 'PENDAPATAN JASA', 'KREDIT', 640000, 53),
(16, '2016-02-01', '122', 'PEMBELIAN', 'DEBIT', 14490000, 54),
(16, '2016-02-01', '122', 'PEMBELIAN', 'KREDIT', 14490000, 55),
(17, '2016-02-01', '122', 'PEMBELIAN', 'DEBIT', 7400000, 56),
(17, '2016-02-01', '122', 'PEMBELIAN', 'KREDIT', 7400000, 57),
(18, '2020-02-01', '122', 'PEMBELIAN', 'DEBIT', 13800000, 58),
(18, '2020-02-01', '122', 'PEMBELIAN', 'KREDIT', 13800000, 59),
(19, '2020-02-01', '122', 'PEMBELIAN', 'DEBIT', 5380000, 60),
(19, '2020-02-01', '122', 'PEMBELIAN', 'KREDIT', 5380000, 61),
(20, '2020-02-01', '201', 'UTANG ', 'DEBIT', 10690000, 62),
(20, '2020-02-01', '201', 'UTANG', 'KREDIT', 10690000, 63),
(21, '2020-02-01', '201', 'UTANG ', 'DEBIT', 5380000, 64),
(21, '2020-02-01', '201', 'UTANG', 'KREDIT', 5380000, 65),
(12, '2022-01-07', '111', 'KAS', 'DEBIT', 2000000, 66),
(12, '2022-01-07', '311', 'MODAL', 'KREDIT', 2000000, 67),
(19, '2022-01-09', '112', 'PIUTANG USAHA', 'DEBIT', 10000000, 70),
(19, '2022-01-09', '112', 'PIUTANG USAHA', 'KREDIT', 10000000, 71),
(12, '2022-01-11', '123', 'PENDAPATAN JASA', 'DEBIT', 15000000, 74),
(12, '2022-01-11', '123', 'PENDAPATAN JASA', 'KREDIT', 15000000, 75),
(10, '2022-01-21', '111', 'KAS', 'DEBIT', 2000000, 78),
(10, '2022-01-21', '311', 'MODAL', 'KREDIT', 2000000, 79);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modal`
--

CREATE TABLE `modal` (
  `kode_modal` int(4) NOT NULL,
  `jumlah_modal` int(7) NOT NULL,
  `tgl_modal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `modal`
--

INSERT INTO `modal` (`kode_modal`, `jumlah_modal`, `tgl_modal`) VALUES
(1, 25000000, '2016-01-02'),
(2, 2000000, '2022-01-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(4) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `alamat_pegawai` varchar(50) NOT NULL,
  `no_hp_pegawai` int(12) NOT NULL,
  `posisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `alamat_pegawai`, `no_hp_pegawai`, `posisi`) VALUES
(670301, 'Ayla Sintia', 'Palem 2', 898545678, 'Admin'),
(670302, 'Riski Wibowo', 'Palem 1', 898545679, 'Operasional'),
(670303, 'Luthfi Saputra', 'Bali Residence', 898545680, 'Operasional'),
(670304, 'Mika Syafitri', 'Sukabirus', 898545682, 'Operasional'),
(670305, 'Muhammad Jonah', 'Sukapura', 898545681, 'Delivery Man');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_tlp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode`, `nama`, `email`, `no_tlp`, `alamat`) VALUES
(45, 'P001', 'Al Abrar Elza', 'abrarelza6@gmail.com', '0813-9447-9848', 'Cimahi'),
(46, 'P002', 'Hafid', 'hafidpramudia4@gmail.com', '0813-4443-9876', 'Bandung'),
(50, 'P003', 'Luthfi', 'diffoelza@365.telkomuniversity.ac.id', '2131-2312-3123', 'Bandung'),
(51, 'P004', 'Mamat', 'alabrarelza@student.telkomuniversity.ac.id', '1231-2312-3123', 'Podomoro');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_payment_gateway`
--

CREATE TABLE `pembayaran_payment_gateway` (
  `id_pembayaran` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `gross_amount` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `bill_key` int(11) NOT NULL,
  `biller_code` varchar(100) NOT NULL,
  `pdf_url` varchar(255) NOT NULL,
  `status_code` int(11) NOT NULL,
  `settlement_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data untuk tabel `pembayaran_payment_gateway`
--

INSERT INTO `pembayaran_payment_gateway` (`id_pembayaran`, `order_id`, `gross_amount`, `payment_type`, `transaction_time`, `transaction_id`, `bill_key`, `biller_code`, `pdf_url`, `status_code`, `settlement_time`) VALUES
(41, 253691754, 500000, 'bank_transfer', '2021-05-27 08:22:40', 9, 0, '', 'https://app.sandbox.midtrans.com/snap/v1/transactions/d6304baa-ec1d-49d1-9061-15827e4daf72/pdf', 200, '2021-05-27 08:24:01'),
(42, 1121542099, 100000, 'cstore', '2022-05-13 08:24:43', 5, 0, '', 'https://app.sandbox.midtrans.com/snap/v1/transactions/2a6ab2fd-d2e6-41d6-ac18-056bb555c3f2/pdf', 200, '2022-05-13 08:25:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_pembelian` int(11) NOT NULL,
  `tanggal_beli` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_supplier`, `id_produk`, `keterangan`, `jumlah`, `harga_pembelian`, `tanggal_beli`) VALUES
(12, 1, 21, 'Kecil', 5, 200000, '2022-04-26'),
(13, 2, 24, 'Sedang', 3, 120000, '2022-04-26'),
(14, 3, 26, 'Sedang', 3, 120000, '2022-04-26'),
(15, 1, 21, 'Kecil', 2, 80000, '2022-04-26'),
(16, 4, 22, 'Kecil', 3, 150000, '2022-04-28'),
(18, 1, 21, 'Kecil', 2, 80000, '2022-04-26'),
(19, 1, 21, 'Kecil', 12, 480000, '2022-05-27'),
(20, 1, 22, '', 5, 250000, '2023-01-17'),
(21, 1, 22, '', 5, 250000, '2023-01-24'),
(22, 3, 22, '', 20, 1000000, '2023-01-17'),
(23, 1, 26, '', 5, 300000, '2023-01-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemodalan`
--

CREATE TABLE `pemodalan` (
  `id` int(11) NOT NULL,
  `id_investor` int(11) DEFAULT NULL,
  `harga_pemodalan` int(50) DEFAULT NULL,
  `tanggal_modal` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemodalan`
--

INSERT INTO `pemodalan` (`id`, `id_investor`, `harga_pemodalan`, `tanggal_modal`) VALUES
(1, 2, 100000, '2022-06-04'),
(2, 2, 100000, '2022-07-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan_jasa`
--

CREATE TABLE `pendapatan_jasa` (
  `kode_pendapatan` int(11) NOT NULL,
  `tgl_pendapatan` date NOT NULL,
  `jenis_pendapatan` varchar(30) NOT NULL,
  `jumlah_pendapatan` int(11) NOT NULL,
  `sisa_pendapatan` int(11) NOT NULL,
  `pajak_pendapatan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendapatan_jasa`
--

INSERT INTO `pendapatan_jasa` (`kode_pendapatan`, `tgl_pendapatan`, `jenis_pendapatan`, `jumlah_pendapatan`, `sisa_pendapatan`, `pajak_pendapatan`) VALUES
(1001, '2021-11-30', 'lunas', 16900000, 260000, 0),
(1002, '2021-11-30', 'Belum Lunas', 260000, 0, 0),
(1011, '2021-10-30', 'Lunas', 15400000, 149000, 0),
(1012, '2021-10-30', 'Belum Lunas', 149000, 0, 0),
(1021, '2021-09-30', 'Lunas', 15900000, 230000, 0),
(1022, '2021-09-30', 'Belum Lunas', 230000, 0, 0),
(1031, '2021-08-30', 'Lunas', 16100000, 97000, 0),
(1032, '2021-08-30', 'Belum Lunas', 97000, 0, 0),
(1041, '2021-07-30', 'Lunas', 14980000, 640000, 0),
(1042, '2021-07-30', 'Belum Lunas', 640000, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_penjualan` int(50) NOT NULL,
  `tanggal_jual` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_pelanggan`, `id_produk`, `keterangan`, `jumlah`, `harga_penjualan`, `tanggal_jual`) VALUES
(18, 45, 16, 'Kecil', 3, 150000, '2022-04-04'),
(19, 46, 17, 'Besar', 4, 160000, '2022-12-04'),
(21, 45, 16, 'Kecil', 2, 100000, '2022-20-04'),
(22, 45, 16, 'Kecil', 2, 100000, NULL),
(23, 46, 16, 'Kecil', 2, 100000, NULL),
(24, 46, 16, 'Kecil', 9, 450000, NULL),
(25, 45, 21, 'Sedang', 1, 40000, '01/09/2022'),
(26, 46, 24, 'Sedang', 10, 400000, '20/06/2022'),
(27, 50, 21, 'Kecil', 2, 80000, '2022-06-20'),
(28, 45, 26, 'Kecil', 2, 120000, '2022-06-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peralatan_bahan`
--

CREATE TABLE `peralatan_bahan` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `tanggal_beli` varchar(10) DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peralatan_bahan`
--

INSERT INTO `peralatan_bahan` (`id`, `kode`, `nama`, `harga`, `tanggal_beli`, `keterangan`) VALUES
(22, 'PLT001', 'lem', 1000, '2022-15-03', '-'),
(23, 'PLT002', 'gunting', 2000, '2022-26-03', '-'),
(24, 'PLT003', 'Gunting', 12000, '2022-20-04', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `piutang`
--

CREATE TABLE `piutang` (
  `kode_piutang` int(11) NOT NULL,
  `tgl_piutang` date NOT NULL,
  `jumlah_piutang` int(11) NOT NULL,
  `pajak_pendapatan_usaha` int(20) NOT NULL,
  `pemilik_piutang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `piutang`
--

INSERT INTO `piutang` (`kode_piutang`, `tgl_piutang`, `jumlah_piutang`, `pajak_pendapatan_usaha`, `pemilik_piutang`) VALUES
(1131, '2021-11-30', 260000, 0, 'Adam'),
(1132, '2021-10-30', 149000, 0, 'Fauzi'),
(1133, '2021-09-30', 230000, 0, 'Salsabilla'),
(1134, '2021-08-30', 97000, 0, 'Rian Bowo'),
(1135, '2021-07-30', 640000, 0, 'Mahendra');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama`, `harga`, `keterangan`) VALUES
(21, 'BRG001', 'Snack Bouquet', 40000, 'kecil'),
(22, 'BRG002', 'Snack Bouquet', 50000, 'sedang'),
(23, 'BRG003', 'Snack Bouquet', 60000, 'besar'),
(24, 'BRG004', 'Flower Bouquet', 40000, 'kecil'),
(25, 'BRG005', 'Flower Bouquet', 50000, 'sedang'),
(26, 'BRG006', 'Flower Bouquet', 60000, 'besar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_jasa`
--

CREATE TABLE `produk_jasa` (
  `kode_produk` int(4) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `harga_produk` int(7) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_jasa`
--

INSERT INTO `produk_jasa` (`kode_produk`, `nama_produk`, `harga_produk`, `keterangan`) VALUES
(1, 'slowclean', 5500, '3 hari'),
(2, 'standard', 6000, '2 hari'),
(3, 'quick xpress', 7000, '1 hari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`) VALUES
(1, 'Banda Aceh'),
(2, 'Medan'),
(3, 'Palembang'),
(4, 'Padang'),
(5, 'Bengkulu'),
(6, 'Pekanbaru'),
(7, 'Tanjung Pinang'),
(8, 'Jambi'),
(9, 'Bandar Lampung'),
(10, 'Pangkal Pinang'),
(11, 'Pontianak'),
(12, 'Samarinda'),
(13, 'Banjarmasin'),
(14, 'Palangkaraya'),
(15, 'Tanjung Selor'),
(16, 'Serang'),
(17, 'Jakarta'),
(18, 'Bandung'),
(19, 'Semarang'),
(20, 'Yogyakarta'),
(21, 'Surabaya'),
(22, 'Denpasar'),
(23, 'Kupang'),
(24, 'Mataram'),
(25, 'Gorontalo'),
(26, 'Mamuju'),
(27, 'Palu'),
(28, 'Manado'),
(29, 'Kendari'),
(30, 'Makasar'),
(31, 'Ternate'),
(32, 'Ambon'),
(33, 'Manokwari'),
(34, 'Jayapura');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_tlp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `kode`, `nama`, `no_tlp`, `alamat`, `keterangan`) VALUES
(1, 'S001', 'Fahrizal', '0813-9445-5588', 'bojongsoang', '-'),
(2, 'S002', 'rahmatyadi', '0813-9447-9848', 'jln pahwalawan', '-'),
(3, 'S004', 'Karomuddin', '0812-8100-8187', 'Kp. Jarakosta', '-'),
(4, 'S003', 'Mamat', '0813-1792-2179', 'Sukabirus', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `last_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2022-03-23 11:51:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `utang`
--

CREATE TABLE `utang` (
  `kode_utang` int(11) NOT NULL,
  `tgl_utang` date NOT NULL,
  `jumlah_utang` int(11) NOT NULL,
  `pajak_pembelian_kredit` int(11) NOT NULL,
  `pemberi_utang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `utang`
--

INSERT INTO `utang` (`kode_utang`, `tgl_utang`, `jumlah_utang`, `pajak_pembelian_kredit`, `pemberi_utang`) VALUES
(1141, '2020-02-01', 10690000, 0, 'Toko Electronik Sanjaya'),
(1142, '2020-02-01', 5380000, 0, 'Toko Electronik Sanjaya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`kode_aset`);

--
-- Indeks untuk tabel `investor`
--
ALTER TABLE `investor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `kode_akun` (`kode_akun`) USING BTREE;

--
-- Indeks untuk tabel `modal`
--
ALTER TABLE `modal`
  ADD PRIMARY KEY (`kode_modal`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran_payment_gateway`
--
ALTER TABLE `pembayaran_payment_gateway`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemodalan`
--
ALTER TABLE `pemodalan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peralatan_bahan`
--
ALTER TABLE `peralatan_bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `investor`
--
ALTER TABLE `investor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `pemodalan`
--
ALTER TABLE `pemodalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `peralatan_bahan`
--
ALTER TABLE `peralatan_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
