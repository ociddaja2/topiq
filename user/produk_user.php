<?php
error_reporting(0);
include('session.php');
include '../db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopiQ&copy, Every Smart Head Deserves a Great Hat</title>
    <link rel="stylesheet" type="text/css" href="../css/styleuser.css">
</head>
<body>
    <header>
       <div class="navbar">
        <div class="nav-container">
            <ul>
                <?php include 'navbar.php' ?>
            </ul> 
            <div class="logo">
                <a href="dashboard_user.php"><img src="../img/topiquserlogo.png" alt="Logo" width="100px"></a>
                </div>
            </div>
        </div>
    </header>

    <div class="search">
        <div class="container-search">
            <form action="produk_user.php" method="GET">
                <input type="text" name="search" placeholder="Search" value="<?php echo $_GET['search'] ?>" required>
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <button type="submit" name="cari"><img src="../img/search.png" alt="Search"></button>
            </form>
            <span class="copyright">Copyright &copy;</span>
        </div>  
    </div>
    
    <div class="section-category" >
        <h3 align="center">Category</h3>
        <div class="container-category">       
        <div class="box">
            <?php 
            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
            if(mysqli_num_rows($kategori) > 0){
                while ($k = mysqli_fetch_array($kategori)){
            ?>  
                
                    <div class="col-5">
                        <a href="produk_cari_kategori.php?kat=<?php echo $k['category_id']?>" > 
                        <p><?php echo $k['category_name']?></p>
                    </div>
                </a>
            <?php }} else { echo "<p>Kategori tidak ada</p>"; } ?><br>
        </div>
    </div>
    </div>
    <h3 align="center" class="info">Product</h3>
   <div class="section-product">
         <div class="container-product">
            <?php
            if ($_GET['search'] != '' || $_GET['kat'] != '') {
                $where = "AND product_name LIKE '%". $_GET['search'] ."%' AND category_id LIKE '%" . $_GET['kat'] . "%'";
            }
            
            $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC");
            if (mysqli_num_rows($produk) > 0) {
                while ($p = mysqli_fetch_array($produk)) {
                    $image_path = "../produk/" . $p['product_image'];
            ?>
            <div class="box1">
                <div class="col-4">
                        <a href="detail_produk_user.php?id=<?php echo $p ['product_id'] ?>" title="Detail Produk">
                        <img src="../produk/<?php echo $p ['product_image'] ?>" width="150px">
                        <p class="nama"><?php echo substr($p ['product_name'], 0, 30) ?></p>
                        <p class="harga">Rp. <?php echo number_format($p ['product_price']) ?> (Stock <?php echo $p ['stock'] ?>)</p>
                    </a>
                    <form action="chart_proses.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $p['product_id']; ?>">
                        <input type="hidden" name="stock" value="<?php echo $p['stock']; ?>">
                        <input type="hidden" name="admin_id" value="<?php echo $_SESSION['id_login']; ?>">
                        
                        <input type="number" name="jml" value="1"  style="width: 60px;" autofocus required min="1">
                        <button type="submit" name="submit" class="buy">BUY NOW</button>
                    </form>
                </div>
            </div>        
            
            <?php }
            } else { echo "<p>Theres no product</p>"; } ?>
            </div>
    </div>
<div class="footer">
    <div class="container">
        <i>
              <div class="icon-text-wrapper">
    <img src="../img/address.png" alt="Address Icon" width="20px">
    <h4>Address : <?php echo $a->admin_address ?></h4>
</div>

<div class="icon-text-wrapper">
    <img src="../img/email.png" alt="" width="20px">
    <h4>Email : <?php echo $a->admin_email ?></h4>
</div>

<div class="icon-text-wrapper">
    <img src="../img/contact.png" alt="" width="20px">
    <h4>Phone Number : <?php echo $a->admin_telp ?></h4>
</div><br>
        </i>
        <small>Copyright &copy; 202 - TopiQ.</small>
        <small>All Rights Reserved.</small>
        </div>
</div>

</body>
</html>