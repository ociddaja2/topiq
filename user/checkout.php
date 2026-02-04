<?php
session_start();
include '../db.php';


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TopiQ&copy, Every Smart Head Deserves a Great Hat</title>
    <link rel="stylesheet" type="text/css" href="../css/styleuser.css">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
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
        <div class="container-cart">
            <h3 align="center">Product Checkout</h3>
            <br>
            <div class="box2">
                <table border="1" cellspacing="0" class="table1">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Picture</th>
                            <th>Amount</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $admin_id=$_SESSION['id_login'];
                        $produk = mysqli_query($conn, "SELECT tb_checkout_temp.product_id, (jml*product_price) AS total, chart_id, category_name, product_name, product_price, product_image, jml
                        FROM tb_product, tb_category, tb_checkout_temp
                        WHERE tb_category.category_id=tb_product.category_id AND
                        tb_checkout_temp.product_id=tb_product.product_id AND
                        admin_id=$admin_id
                        ");
                        while($row = mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                            <td><a href="../produk/<?php echo $row['product_image'] ?>" target="_blank">
                                <img src="../produk/<?php echo $row['product_image'] ?>" width="50px"></a></td>
                            <td align="center"><?php echo $row['jml'] ?></td>
                            <td align="center">Rp. <?php echo number_format($row['total']) ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <?php
                            $produk = mysqli_query($conn, "SELECT SUM(jml) AS jumlah, tb_checkout_temp.product_id, 
                            SUM(jml*product_price) AS total, chart_id, category_name, product_name, product_price, product_image, jml
                            FROM tb_product, tb_category, tb_checkout_temp
                            WHERE tb_category.category_id=tb_product.category_id AND
                            tb_checkout_temp.product_id=tb_product.product_id AND
                            admin_id=$admin_id
                            ");
                            $row = mysqli_fetch_array($produk);
                            ?>
                            <th colspan="5">Total</th>
                            <th><?php echo $row['jumlah'] ?></th>
                            <th style="text-decoration: underline; color: Red;">Rp. <?php echo number_format($row['total']) ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   
    <div class="boxtf">
         <h3>Payment</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Payment Account Options:</label><br>
            <label>BRI - 0236816293941</label><br>
            <label>BNI - 2036182921</label><br>
            <label>MANDIRI - 8973277619293</label><br>
            <label>BCA - 68289123</label><br>
            <label>BSI - 23916240</label><hr style="border :solid 1px #FF9D23"><br>
            <label>Upload Payment Proof</label><br>
            <input type="file" name="gambar" placeholder="...Gambar Produk..." class="form-control" required>
            <input type="submit" name="proses" value="Kirim" class="btn1">
        </form>
    </div>

    <?php
    if(isset($_POST['proses'])){
        $tgl = date('Y-m-d');
        $filename = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        $type1 = explode('.', $filename);
        $type2 = $type1[1];

        $newname = 'tf'.time().'.'.$type2;  

        // menampung data format file yang diizinkan
        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');

        // validasi format file
        if(!in_array($type2, $tipe_diizinkan)){ 
            // jika format file tidak ada di dalam tipe diizinkan
            echo '<script>alert("Format file tidak diizinkan")</script>';
        }else{
            // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
            // proses upload file sekaligus insert ke database
            move_uploaded_file($tmp_name, '../bukti_transfer/'.$newname);

            $query=mysqli_query($conn, "SELECT * FROM tb_checkout_temp NATURAL JOIN tb_product");
            while($r=mysqli_fetch_array($query)){
                $jml = $r['jml'];
                $product_price = $r['product_price'];
                $total = $jml*$product_price;
                $insert = mysqli_query($conn, "INSERT INTO tb_checkout VALUES (null,'$r[product_id]','$jml','$r[admin_id]','$total','$newname','Waiting','Pending','$tgl') ");
                mysqli_query($conn, "UPDATE tb_product SET stock=stock-'$jml' WHERE product_id='$r[product_id]'");
            }

            mysqli_query($conn, "TRUNCATE tb_checkout_temp");

            if($insert){
                echo '<script>alert("Payment Complete")</script>';
                echo '<script>window.location="checkout_data.php"</script>';
            }else{
                echo 'gagal '.mysqli_error($conn);
            }
        }
    }
    ?>
    </div>
    </div>
    </div>
    <footer >
        <div class="container">
            <small>Copyright &copy; 2025 - TopiQ</small>
        </div>
    </footer>

</body>
</html>