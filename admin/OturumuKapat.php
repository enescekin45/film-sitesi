<?php 

session_start();// Oturumu başlat
session_destroy();// Oturumu sonlandır
header('location:giriş.php'); // Kullanıcıyı 'giriş.php' sayfasına yönlendir

 ?>