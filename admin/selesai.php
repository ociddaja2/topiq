<?php include ('session.php');

include 'fungsi_indotgl.php'; ?>
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
        <div class="header"></div>
        <div class="sidebar">
            <div class="sidebar-logo"><img src="../Img/topiqlogo2.png" alt="Logo PNG"></div>
            <div class="sidebar-title">
            <h2>TopiQ</h2>
            </div>
            <ul>
                <?php include'sidebar.php'?>
            </ul>
        </div>
        <div class="section">
            <h3 class="card-title">Finished Checkout Data</h3>
            <table class="table1" border="1">
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Picture</th>
                    <th>Amount</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Proof</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                </tr>
                <?php
                $no = 1;
                $admin_id = $_SESSION['id_login'];
                $produk = mysqli_query($conn, "SELECT admin_name, admin_telp, admin_address,
                (jml*product_price) AS total, tanggal, ck_id, product_name,
                product_price, product_image, jml, bukti, validasi, status 
                FROM tb_product, tb_checkout, tb_admin  
                WHERE tb_admin.admin_id = tb_checkout.admin_id AND
                tb_checkout.product_id = tb_product.product_id AND
                status ='selesai' 
                ");

                while ($row = mysqli_fetch_array($produk)) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                        <td><a href="../produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="../produk/<?php echo $row['product_image'] ?>" width="50px"></a></td>
                        <td><?php echo $row['jml'] ?></td>
                        <td>Rp. <?php echo number_format($row['total']) ?></td>
                        <td><?php echo tgl_indo($row['tanggal']) ?></td>
                        <td><a href="../bukti_transfer/<?php echo $row['bukti'] ?>" target="_blank"> <img src="../bukti_transfer/<?php echo $row['bukti'] ?>" width="50px"></a></td>
                        <td><?php echo $row['admin_name'] ?></td>
                        <td><?php echo $row['admin_address'] ?></td>
                        <td><?php echo $row['admin_telp'] ?></td>
                    </tr> 
                <?php } ?>
                    <?php if (mysqli_num_rows($produk) == 0) { ?>
                    <tr>
                        <td colspan="11">Theres no Data</td>
                    </tr>
                <?php } ?>  
            </table>

            </div>
        </div>
        </body>
</html>