<?php
include '../db.php';

$nama = $_POST['nama'];

$insert = mysqli_query($conn, "insert into tb_category values('', '$nama')");

if ($insert) {
    echo '<script>alert("Adding Data Complete")</script>';
    echo '<script>window.location="kategori_data.php"</script>';
} else {
    echo 'gagal ' . mysqli_error($conn);
}
?>