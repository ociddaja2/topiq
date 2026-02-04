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
            <h3 class="card-title">Product Data</h3>
            <p><a href="produk_tambah.php">➕Add a Product</a></p>
            <table class="table1" width="95%" border="1">
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Product Detail</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Picture</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php 
                $no = 1;
                $product = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                if(mysqli_num_rows($product) > 0) {
                    while($row = mysqli_fetch_array($product)) {

                ?> 
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['product_name'];?></td>
                            <td><?php echo $row['product_description'];?></td>
                            <td>Rp.<?php echo number_format ($row['product_price']);?></td>
                            <td><?php echo $row['stock'];?></td>

                            <td><a href="produk/<?php echo $row['product_image']; ?>" target="_blank"> <img src="../produk/<?php echo $row ['product_image']; ?>" alt="" width="70px"></a></td>

                            <td><?php echo ($row['product_status'] == 0 ) ? 'Tidak Aktif' : 'Aktif'; ?></td>
                            <td>
                                <a href="produk_edit.php?id=<?php echo $row['product_id'] ?>">Edit ||</a> <a href="hapus_proses.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm ('Yakin ingin hapus ?')">Delete</a>
                            </td>
                        </tr>  
            <?php
                 }
                } else { 
                    ?>
                    <tr>
                        <td colspan="9">Theres no Data</td>
                    </tr>
             <?php   } ?>
            </table>
        </div>
    </div>
</body>
</html>