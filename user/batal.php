<?php 
    include 'session.php';
    include '../db.php';
    include 'fungsi_indotgl.php';
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
    <header>
       <div class="navbar">
            <ul>
                <?php include 'navbar.php' ?>
            </ul> 
            <div class="logo">
                <a href="dashboard_user.php"><img src="../img/topiquserlogo.png" alt="Logo" width="100px"></a>
            </div>
        </div>
    </header>
          <div class="section">
    <div class="container-ck">
        <h3>Canceled Checkout Data</h3>
        <h4>The Product That you Cancel</h4>
        <br>
        <div class="box2">
            <table border="1" cellspacing="0" class="table1">
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th width="100px">Category</th>
                        <th width="100px">Product Name</th>
                        <th width="100px">Price</th>
                        <th width="100px">Pics</th>
                        <th width="20px">Amount</th>
                        <th width="100px">Total</th>
                        <th width="100px">Payment</th>
                        <th width="100px">Date</th>
                        <th width="100px">Proof</th>
                    </tr>       
                </thead> 
                <tbody>
                    <?php 
                    $no = 1;
                    $admin_id=$_SESSION['id_login'];
                    $produk = mysqli_query($conn, "SELECT (jml*product_price) AS total, tanggal, ck_id, category_name, product_name,
                    product_price, product_image, jml, bukti, validasi, status
                    FROM tb_product, tb_category, tb_checkout
                    WHERE tb_category.category_id=tb_product.category_id AND
                    tb_checkout.product_id=tb_product.product_id AND 
                    status = 'batal' AND
                    admin_id=$admin_id
                    ");
                    while($row = mysqli_fetch_array($produk)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                        <td><a href="../produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="../produk/<?php echo $row['product_image'] ?>" width="50px"> </a>
                        <td><?php echo $row['jml'] ?></td>
                        <td>Rp. <?php echo number_format($row['total']) ?></td>
                        <td>Transfer</td>
                        <td><?php echo tgl_indo($row['tanggal']) ?></td>
                        <td><a href="../bukti_transfer/<?php echo $row['bukti'] ?>" target="_blank"> <img src="../bukti_transfer/<?php echo $row['bukti'] ?>" width="50px"> </a></td>
                    </tr>
                    <?php } ?>
                </tbody>
                    </table>
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