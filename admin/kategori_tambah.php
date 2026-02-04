<?php include ('session.php');?>
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
                <?php include'sidebar.php'?>
            </ul>
        </div>
        <div class="section">
            <div class="container">
                <form action="kategori_proses.php" method="post">
                    
                    <h3>Add Category Data</h3>
                    <p><a href="kategori_data.php">🔙Back</a></p>
                    <fieldset>
                        <input type="text" name="nama" placeholder="...Nama Kategori..." class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Add</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>
</html>