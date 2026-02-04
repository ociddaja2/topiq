<?php
// index.php
// Halaman utama untuk aplikasi LapakOcid
    include '../db.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = '1' ");
    $a = mysqli_fetch_object($kontak);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopiQ</title>
    <link rel="stylesheet" type="text/css" href="css/styleindex.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM8d7j3z2l4e5c5e5f5e5f5e5f5e5f5e5f5e5" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> 

</head>
<body>

    <!------------------- NAVBAR -------------------->

    <header>
        <div class="container">
            <div class="navbar"> 
            
            <div class="nav-left">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#product">Products</a></li>
                <li><a href="#footer">About</a></li>
            </ul>
            </div>
            <div class="nav-logo">
                <a href="index.php"><img src="img/topiqlogo3.png" alt="TopiQ"></a>
            </div>
            <div class="nav-right"> 
                <div class="search-box">
                    <form action="produk_cari.php" method="Post">
                        <input type="text" name="search" placeholder="Search...">
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending"><img src="img/search.png" alt="Search" width="13px"></button>
                    </form>
                </div>
                <ul>
                <li><a href="dashboard_user.php"><img src="img/login.png" alt="Back" width="27px"></a></li>
                <li><a href="#product"><img src="img/product.png" alt="Produk" width="25px"></a></li>
                </ul>
            </div>
        </div>
    </div>
    </header>

    <!------------------- NAVBAR -------------------->

    <!------------------- BRANDBAR -------------------->
    <div class="brandbar">
        <p><small>Copyright &copy;</small></p>
        <div class="brand-container">
                <img src="img/newera1.png" alt="" width="15px">
                <img src="img/kangol1.png" alt="" width="15px">
                <img src="img/eiger1.png" alt="" width="15px">
                <img src="img/brixton1.png" alt="" width="15px">
        </div>
    </div>

    <!------------------- Swiper or banner -------------------->
   
    <div class="swiper-container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="img/topiqbanner1new.png" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="img/topiqbanner2new.png" alt="">
                    </div>
                </div>

            
            <div class="swiper-pagination"></div>
    </div>
    </div>
    <!-- Swiper or banner -->

    <!------------------- Category and Product -------------------->
    
    <div class="section">
        <div class="container">
            <h2>silahkan login</h2>
            <br>
            
            <h3>Category</h3>
            <div class="box1">
                <?php 
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if(mysqli_num_rows($kategori) > 0){
                    while ($k = mysqli_fetch_array($kategori)){
                ?>  
                
                        <div class="col-5">
                            <a href="index.php?kat=<?php echo $k['category_id']?>#product"> 
                            <p><?php echo $k['category_name']?></p>

                        </div>
                    </a>
                <?php }} else { ?>
                    <p>Kategori tidak ada</p> <?php } ?> 
            </div>
        </div>
    </div>
                                                
                                                 
    <div class="section">
        <div class="container">
            <h3 id="product">Newest Product</h3><br>
           
            <div class="box">
                <?php
                    ini_set('error_reporting', 0);
                    if($_GET['kat']==''){
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");

                    } else {
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE category_id = $_GET[kat] AND product_status = 1 ORDER BY product_id DESC LIMIT 8");

                    }
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){ 

                    ?>
                    <a href="detail_produk.php?id=<?php echo $p ['product_id'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['product_image'] ?>" alt="">
                            <p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
                            <table width="100%" border="1">
                                <tr> 
                                    <p class="stok"><b>STOCK <?php echo $p['stock'] ?></b></p>
                                    <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                                </tr>
                            </table>
                        </div>
                        
                    </a>
                    
                <?php } } else { ?>
                    <p>produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>
   
    
    <!------------------- Category and Product -------------------->

    <!------------------- Banner -------------------->
    
    <div class="banner">
        <div class="banner-container">
            <img src="img/topiqbannerdown1.png" alt="">
        </div>
    </div>
    <!------------------- Banner -------------------->

    <div class="footer" id="footer">
        <div class="container">
        <i>
            <h5>Address : <i><?php echo $a->admin_address ?></i></h5>
            <h5>Email : <?php echo $a->admin_email ?></h5>
            <h5>Phone Number : <?php echo $a->admin_telp ?></h5>
        </i> <br>
        <small>Copyright &copy; 2025 - TopiQ.</small>
        <small>All Rights Reserved.</small>
        </div>
    </div>

 <script>
  var swiper = new Swiper(".mySwiper", {
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>
</body>
</html>