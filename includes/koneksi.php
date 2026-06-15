<?php
$conn = mysqli_connect("localhost", "root", "", "sd2_demaan_kudus");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
