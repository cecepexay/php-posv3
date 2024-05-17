<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "penjualan";
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
mysql_connect($server,$user,$password) or die ("Koneksi gagal");
mysql_select_db($database) or die ("Database tidak ditemukan");
?>
