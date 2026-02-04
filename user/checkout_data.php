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
        <h3>Your Check Out data is Waiting for Validation and Delivery</h3>
        <h4>Please wait for confirmation from the admin for validation and delivery of the product you have purchased.</h4>
        <br>
        <ul> 

        </ul>

        <div class="box2">
            <table border="1" cellspacing="0" class="table1">
                <thead>
                    <tr>
                        <th width="20px">Num</th>
                        <th width="100px">Category</th>
                        <th width="100px">Product Name</th>
                        <th width="100px">Price</th>
                        <th width="100px">Pics</th>
                        <th width="20px">Amount</th>
                        <th width="100px">Total</th>
                        <th width="100px">Payment</th>
                        <th width="100px">Date</th>
                        <th width="100px">Proof</th>
                        <th width="100px">Status</th>
                        <th width="100px">Delivery</th>
                        <th width="20px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $admin_id = $_SESSION['id_login'];
                    $produk = mysqli_query($conn, "SELECT (jml*product_price) AS total, ck_id, category_name, product_name,
                    product_price, product_image, jml, bukti, validasi, status , tanggal
                    FROM tb_product, tb_category, tb_checkout
                    WHERE tb_category.category_id = tb_product.category_id AND
                    tb_checkout.product_id = tb_product.product_id AND
                    status != 'selesai' AND status != 'batal' AND
                    admin_id = $admin_id");

                    while ($row = mysqli_fetch_array($produk)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                        <td><a href="../produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="../produk/<?php echo $row['product_image'] ?>" width="50px"> </a>
                        <td><?php echo $row['jml'] ?></td>
                        <td>Rp. <?php echo number_format($row['total']) ?></td>

                        <td>Tranfer</td>
                        <td><?php echo tgl_indo($row['tanggal']); ?></td>

                        <td><a href="../bukti_transfer/<?php echo $row['bukti'] ?>" target="_blank"> <img src="../bukti_transfer/<?php echo $row['bukti'] ?>" width="50px"> </a></td>
                        <td><?php echo $row['validasi'] ?></td>
                        <?php if ($row['status'] == 'Proses') { ?>
                        <?php } else { ?>
                        <td><mark><?php echo $row['status']; ?></mark></td>

                        <td> 
                            
                            <a href="proses.php?ck_id=<?php echo $row['ck_id']; ?>" 
                               onclick="return confirm('The Certain product have arrive?')" class="text-white">
                               <strong>Arrive</strong>
                            </a><hr>
                            
                            <a href="batal_proses.php?ck_id=<?php echo $row['ck_id']; ?>" 
                               onclick="return confirm('You want to cancel the transaction?')" class="text-white">
                               <strong>Cancel</strong>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>

                        
                    </tr> 
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
    <footer>
        <div class="container">
            
            <small>Copyright&copy; 2025 - TopiQ</small>
        </div>
    </footer>
</body>
</html>