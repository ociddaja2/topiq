<?php
    include '../db.php';

    if(isset($_GET['ck_id'])){
        $delete = mysqli_query($conn, "UPDATE tb_checkout SET status='selesai' WHERE
        ck_id = '".$_GET['ck_id']."'");
        echo '<script>window.location="selesai.php"</script>';
    }

?>