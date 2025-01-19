<?php
session_start(); // memulai sesi
session_unset(); // menghapus semua data sesi
session_destroy(); // menghancurkan sesi sepenuh nya
header('Location: login.php'); // Arahkan pengguna ke halaman login
exit(); // Menghentikan eksekusi script