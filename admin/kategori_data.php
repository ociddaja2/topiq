<?php include ('session.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Topiq | Admin</title>
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
            <h3 class="card-title">Category</h3>
            <p><a href="Kategori_tambah.php">➕Add Data</a></p>
            <table class="table1" width="80%" border="1">
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id");
                if (mysqli_num_rows($kategori) > 0) {
                 while ($row = mysqli_fetch_array($kategori)) {
                ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td>
                                <a href="kategori_edit.php?id=<?php echo $row['category_id'] ?>">Edit</a> || <a href="hapus_proses.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin ingin hapus ?')">Delete</a>
                            </td>
                        </tr>
                    <?php }
                } else {  ?>
                    <tr>
                        <td colspan="3">Theres no Data</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>