<?php 
	include '../db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TopiQ</title>
	<link rel="stylesheet" type="text/css" href="../css/styleuser.css">
</head>
<body>
	<!-- header -->
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

	<!-- search -->
	 <div class="search">
        <div class="container-search">
            <form action="produk_user.php" method="GET">
                <input type="text" name="search" placeholder="Search">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <button type="submit" name="cari"><img src="../img/search.png" alt="Search"></button>
            </form>
            <span class="copyright">Copyright &copy;</span>
        </div>  
    </div>

	<!-- category -->
	<div class="section-category">
		<h3 align="center">Kategori</h3>
		<div class="container-category">
			
			<div class="box">
				<?php 
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					if(mysqli_num_rows($kategori) > 0){
						while($k = mysqli_fetch_array($kategori)){
				?>
					<a href="produk_cari_kategori.php?kat=<?php echo $k['category_id'] ?>">
						<div class="col-5">
							<p><?php echo $k['category_name'] ?></p>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Category Not Exist</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- new product -->
	<div class="section-product">
		<div class="container-product">
			<h3>Produk Terbaru</h3>
			<div class="box1">
				<?php 
					ini_set('error_reporting',0);
					if($_GET['kat']==''){
						$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
					}else
					{
						$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE category_id=$_GET[kat] AND product_status = 1 ORDER BY product_id DESC LIMIT 8");
					}
					if(mysqli_num_rows($produk) > 0){
						while($p = mysqli_fetch_array($produk)){
				?>	
					<a href="detail_produk.php?id=<?php echo $p['product_id'] ?>">
						<div class="col-4">
							<img src="../produk/<?php echo $p['product_image'] ?>">
							<p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p><table  width="100%">
								<tr>
									<td>
									<p class="nama" ><strong>Stok <?php echo $p['stock'] ?></strong></p></td>
									<td>
									<p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p></td>
								</tr>
							</table>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Produk tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- footer -->
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