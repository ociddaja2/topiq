<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopiQ&copy, Every Smart Head Deserves a Great Hat </title>
    <link rel="stylesheet" type="text/css" href="../css/styleuser.css">
</head>
<body>
    <header>       
        <div class="navbar">
            <ul>
                <?php include 'navbar.php' ?>
            </ul> 
            <div class="logo">
                <a href="../index.php"><img src="../img/topiquserlogo.png" alt="Logo" width="100px"></a>
            </div>
        </div>
    </header> 
    
    <div class="section">
        <div class="container2">
            <h3>Dashboard</h3>
            <div class="box2">
                <h4>Selamat Datang <?php echo $user_row["admin_name"] ?> Silahkan Checkout Barang Belanjamu ^^</h4>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            
            <small>Copyright &copy; 2025 - TopiQ</small>
        </div>
    </footer>
</body>
</html>