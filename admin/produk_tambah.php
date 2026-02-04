<?php include ('session.php'); ?>
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
                <?php include 'sidebar.php'?>
            </ul>
        </div>
        <div class="section">
            <div class="container">
                <?php 
                $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '" . $_SESSION['id_login'] . "' ");
                $d = mysqli_fetch_object($query);
                ?>

                <h3>Add Product Data</h3>
                  <p><a href="produk_data.php">🔙Back</a></p>
                <form action="" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <label for="">Category Name</label>
                        <select name="kategori" class="form-control" required>
                            <option value="">--Choose--</option>
                            <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while ($r = mysqli_fetch_array ($kategori)) {
                                ?>
                                    <option value="<?php echo $r ['category_id'] ?>"><?php echo $r ['category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <label for="">Nama Produk</label>
                        <input type="text" name="nama" placeholder="Name..." class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <label for="">Harga</label>
                        <input type="text" name="harga" placeholder="Price..." class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <label for="">Stok</label>
                        <input type="number" name="stock" placeholder="Stock..." class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <label for="">Gambar Produk</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <label for="">Deskripsi Area</label>
                        <textarea name="deskripsi" placeholder="Description..." class="form-control" required></textarea><br>
                    </fieldset>
                    <fieldset>
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="">--Choose--</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Add</button>
                    </fieldset>

                </form>
                <?php
                if (isset($_POST['submit'])) {
                    //menampung, meminta dan menganbil data inputan dari FROM menggunakan name nya
                    $kategori   = $_POST['kategori'];
                    $nama       = $_POST['nama'];
                    $harga      = $_POST['harga'];
                    $stock      = $_POST['stock'];
                    $deskripsi  = $_POST['deskripsi'];
                    $status     = $_POST['status'];

                    //menampung data file gambar yang diupload
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];
                    $newname = 'produk' . time() . '.' . $type2;

                    //menampung data format file yang diizinkan
                    $tipe_diizinkan = array ('jpg', 'jpeg', 'png','gif','PNG','JPG','JPEG','GIF');
                    //validasi format file
                    if (!in_array($type2, $tipe_diizinkan)) {
                        //jika format file tidak ada di dalam tipe diizinkan
                        echo '<script>alert("Format file tidak diizinkan")</script>';
                    } else {
                        //jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                        //proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, '../produk/' . $newname);

                        $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES(null, '$kategori', '$nama', '$harga', '$deskripsi', '$newname' , '$status',  null, '$stock') ");   

                        if ($insert) {
                            echo '<script>alert("Adding Data Complete")</script>';
                            echo '<script>window.location="produk_data.php"</script>';
                        } else {
                            echo 'gagal ' . mysqli_error($conn);
                        }
                    }
                }                
                ?>

                
                </div>
            </div>
        </div>
</body>
</html>