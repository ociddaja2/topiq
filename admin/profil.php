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
            <div class="container">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '" . $_SESSION['id_login'] . "' ");
                $d = mysqli_fetch_object($query);
                ?>
                <form action="" id="contact" method="post" class="profile-form">
                    <h2>Profile</h2>
                    <fieldset>
                        <input type="text" name="nama" placeholder="Full Name" class="form-control" value="<?php echo $d->admin_name ?>" required>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="user" placeholder="Username" class="form-control" value="<?php echo $d->username ?>" required>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="hp" placeholder="Phone Number" class="form-control" value="<?php echo $d->admin_telp ?>" required>
                    </fieldset>
                    <fieldset>
                        <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $d->admin_email ?>" required>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="alamat" placeholder="Address" class="form-control" value="<?php echo $d->admin_address ?>" required>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Change Profile</button>
                    </fieldset>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama   = ucwords($_POST['nama']);
                    $user   = $_POST['user'];
                    $hp     = $_POST['hp'];
                    $email  = $_POST['email'];
                    $alamat = ucwords($_POST['alamat']);
                    $update = mysqli_query($conn, "UPDATE tb_admin SET admin_name = '" . $nama . "', username = '" . $user . "', admin_telp = '" . $hp . "', admin_email = '" . $email . "', admin_address = '" . $alamat . "' WHERE admin_id = '" . $d->admin_id . "' ");
                    if ($update) {
                        echo '<script>alert("Ubah Data Berhasil")</script>';
                        echo '<script>window.location="profil.php"</script>';
                    }  else {
                        echo 'gagal ' . mysqli_error($conn);
                    }
                }
                ?>

                <?php
                $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '" . $_SESSION['id_login'] . "' ");
                $d = mysqli_fetch_object($query);
                ?>
                <form action="" method="post" id="contact" class="password-form">
                    <h3>Change Password</h3>
                    <fieldset>
                        <input type="password" name="pass1" placeholder="New Password" class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <input type="password" name="pass2" placeholder="New Password Confirmation" class="form_control" required>
                    </fieldset>
                    <fieldset>
                        <button name="ubah_password" type="submit" id="contact-submit" data-submit="...Sending">Change Password</button>
                    </fieldset>
                </form>
                <?php
                if (isset($_POST['ubah_password'])) {
                    $pass1  =$_POST['pass1'];
                    $pass2  =$_POST['pass2'];
                    if ($pass2 != $pass1) {
                        echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
                    } else {
                        $u_pass = mysqli_query($conn, "UPDATE tb_admin SET password = '" . $pass1 . "' WHERE admin_id = '" . $d->admin_id . "' ");
                        if ($u_pass) {
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="profil.php"</script>';
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