<?php
    include '../db.php';

    if(isset($_GET['ck_id'])){
        $update = mysqli_query($conn, "UPDATE tb_checkout SET status='batal' WHERE ck_id = '".$_GET['ck_id']."'");
        echo '<script>window.location="batal.php"</script>';
    }
?>