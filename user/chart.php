<?php
include 'session.php';
include '../db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styleuser.css">
    <title>TopiQ&copy, Every Smart Head Deserves a Great Hat</title>
</head>
<body>

<!-- Header -->
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

<!-- Content -->
<div class="section">
    <div class="container-ck">
    <h3>Your Cart</h3>
        <p align="center" style="font-weight: bold;">Please select the product you want to checkout</p>
        <br>
        <div class="box2">
            <table border="1" cellspacing="0" class="table1">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Pics</th>
                        <th>Amount</th>
                        <th>Total</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $admin_id = $_SESSION['id_login'];
                    $produk = mysqli_query($conn, "SELECT tb_chart.product_id, (jml*product_price) AS total, chart_id, category_name, product_name, product_price, product_image, jml
                        FROM tb_product, tb_category, tb_chart
                        WHERE tb_category.category_id = tb_product.category_id 
                        AND tb_chart.product_id = tb_product.product_id 
                        AND admin_id = $admin_id");

                    while ($row = mysqli_fetch_array($produk)) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                        <td>
                            <a href="../produk/<?php echo $row['product_image'] ?>" target="_blank">
                                <img src="../produk/<?php echo $row['product_image'] ?>" width="50px">
                            </a>
                        </td>
                        <td><?php echo $row['jml'] ?></td>
                        <td>Rp. <?php echo number_format($row['total']) ?></td>
                        <td>
                          <form method="post" action="">
                            
                            <input type="hidden" name="jml[]" value="<?php echo $row['jml'] ?>">
                            <input type="hidden" name="product_id[]" value="<?php echo $row['product_id'] ?>">
                            <input type="hidden" name="admin_id[]" value="<?php echo $admin_id ?>">
                            Check Out<input type="checkbox" id="checkitem" name="check[]" value="<?php echo $row['chart_id'] ?>"> || <a href="hapus_proses.php?idc=<?php echo $row['chart_id'] ?>" onclick="return confirm('Yakin ingin hapus ?')">Delete</a>
                        </td>
                    </tr>
                    <br>

                    
                <?php } ?>

                </tbody>
            </table><hr style="border :solid 1px #FF9D23">
            <button type="submit" class="btn" name="save">Check Out</button>
            </form>
                        
        </div>
            <?php
            if (isset($_POST['save'])) {
                $checkbox   = $_POST['check'];
                $jml        = $_POST['jml'];
                $product_id = $_POST['product_id'];
                $admin_id   = $_POST['admin_id'];

                for($i=0;$i<count($checkbox);$i++){
                    $check_id   = $checkbox[$i];
                    $jml        = $jml[$i];
                    $product_id = $product_id[$i];
                    $admin_id   = $admin_id[$i];
                    mysqli_query($conn, "insert into tb_checkout_temp values (
                    $check_id,
                    $product_id,
                    $jml,
                    $admin_id
                    )") or die(mysqli_error());
                   
                    // Hapus dari keranjang
                    mysqli_query($conn, "DELETE FROM tb_chart WHERE chart_id=$check_id")
                        or die(mysqli_error());
                }

                echo '<script>alert("Checkout Complete")</script>';
                echo '<script>window.location="checkout.php"</script>';
            }
            
            ?>
        </div>
    </div>
</div>

<!-- Footer -->
<footer >
    <div class="container">
        <small>Copyright &copy; 2025 - LapakOcid.</small>
    </div>
</footer>

</body>
</html>