<?php
$host = "localhost";
$user = "root";
$pass = ""; // Password bawaan Laragon biasanya kosong
$db   = "db_hotel";

// Membuat koneksi ke database MySQL
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>