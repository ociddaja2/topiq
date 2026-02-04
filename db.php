<?php

$conn = mysqli_connect("localhost", "root", "","topiq");

//check koneksi apabila gagal muncul di bawah ini
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal  :  " . mysqli_connect_error();
}