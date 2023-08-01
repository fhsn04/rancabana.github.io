<?php
session_start();
if ($_SESSION) {
    if ($_SESSION['role'] == 'admin') {
    } else {
        header("location:../login_admin.php");
    }
} else {
    header('location:../login_admin.php');
}

$conn = mysqli_connect("localhost", "root", "", "laundry1");

if (mysqli_connect_error()) {
    echo "Koneksi ke database gagal : " . mysqli_connect_error();
}
error_reporting (0);