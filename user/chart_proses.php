<?php
include '../db.php';
if (isset($_POST['submit'])) {
    $jml        = $_POST['jml'];
    $product_id = $_POST['product_id'];
    $admin_id   = $_POST['admin_id'];
    $stock      = $_POST['stock'];


    if($stock < $jml){
        echo '<script>alert("Stok tidak mencukupi")</script>';
        echo '<script>window.location="produk_user.php"</script>';
    }elseif($stock == 0){
        echo '<script>alert("Stock Empty")</script>';
        echo '<script>window.location="produk_user.php"</script>';
    } else {
    
    $insert = mysqli_query($conn, "INSERT INTO tb_chart VALUES (
        null,   '" . $product_id . "',
                '" . $jml . "',
                '" . $admin_id . "'
        ) ");
    if ($insert) {
        echo '<script>alert("Added to Your Cart")</script>';
        echo '<script>window.location="produk_user.php"</script>';
    } else {
        echo 'gagal' . mysqli_error($conn);
    }}
}
?>