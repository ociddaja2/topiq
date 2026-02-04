<?php include ('session.php');
include '../db.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>TopiQ | Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>
<body>
    <div class="wrapper">
        <div class="header">
        </div>
        <div class="sidebar">
        <div class="sidebar-logo"><img src="../Img/topiqlogo2.png" alt="Logo PNG"></div>
            <div class="sidebar-title"><h2>TopiQ</h2></div>
            <ul>
                <?php include 'sidebar.php'?>
            </ul>
        </div>
        <div class="section">
            <h1>Welcome Admin System: <?php echo $user_row["admin_name"]?></h1>
        </div>
    </div>
</body>
</html>