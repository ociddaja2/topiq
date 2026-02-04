<?php include('../db.php');
    session_start();
    //check apakah variabel session ada atau tidak ada
    if (!isset($_SESSION['id_login']) || (trim($_SESSION['id_login']) == '')  ) { ?>
    <script>
        alert('Please login first');
        window.location = "../login.php";
        </script>
    <?php
    }
    $session_id=$_SESSION['id_login'];

    $user_query = mysqli_query($conn, "select * from tb_admin where admin_id = '$session_id'")or die(mysql_error());
    $user_row = mysqli_fetch_array($user_query);
?>