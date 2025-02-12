<?php

// Menghubungkan ke file konfigurasi database
include("config.php");

// memulai sesi untuk menyimpan notifikasi
session_start();

// Proses penambahan kategori baru
if (isset($_POST['simpan'])) {
    // mengambil data nama kategori dari form
    $category_name = $_POST['category_name'];

    // Query untuk menambahkan data kategori ke dalam database
    $query = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    $exec = mysqli_query($conn, $query);

    // menyimpan notifikasi berhasil atau gagal ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary', // jenis notifikasi  (contoh: primary untuk keberhasilan)
            'message' => 'kategori berhasil di tambahkan!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger', // jenis notifikasi (contoh: danger untuk kegagalan)
            'message' => 'Gagal menambahkan kategori: ' . mysqli_error($econn)
        ];
    }

    // Redirect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();
}

// Proses penghapusan kategori
if (isset($_POST['delete'])) {
    // Mengambil ID kategori dari parameter URL
    $catID = $_POST['catID'];

    // Query untuk menghapus kategori berdasarkan ID
    $exec = mysqli_query($conn, "DELETE FROM categories WHERE category_id='$catID'");

    // Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Kategori berhasil dihapus!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal menghapus kategori: ' . mysqli_error($conn)
        ];
    }

    // Redirect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();
}
// proses pembaruan kategori
if (isset($_POST['update'])) {
    // mengambil data dari form pembaruan
    $catID = $_POST['catID'];
    $category_name = $_POST['category_name'];

    //query untuk memperbarui data kategori berdasarkan ID
    $query = "UPDATE categories SET category_name = '$category_name' WHERE category_id='$catID'";
    $exec = mysqli_query($conn, $query);

    // menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'kategori berhasil di perbarui!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal memperbarui kategori: ' . mysqli_error($conn)
        ];
    }

    // Redrect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();
}