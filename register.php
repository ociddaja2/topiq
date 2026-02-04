<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="bg-login">
    <div class="box-login">
        <h1>Insert Your Data</h1>
        <br>
        <form action="" method="POST">
            <input type="text" name="nama" placeholder="Full Name" class="input-control" required>
            <input type="text" name="alamat" placeholder="Address" class="input-control" required>
            <input type="text" name="telpon" placeholder="Phone Number" class="input-control" required>
            <input type="text" name="email" placeholder="Email" class="input-control" required>
            <hr>
            <br>
            <input type="text" name="user" placeholder="Username" class="input-control" required>
            <input type="password" name="pass" placeholder="Password" class="input-control" required>
            <input type="submit" name="submit" value="Sign Up" class="btn">

            <p class="bottom-text">
                <label for="">Already have an account?</label> <a href="login.php"><b>Login</b></a>
        </form>
        <?php
        include('db.php');
        if(isset($_POST['submit'])){
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telpon = $_POST['telpon'];
            $email = $_POST['email'];
            $username = $_POST['user'];
            $password = $_POST['pass'];

            $insert = mysqli_query($conn, "INSERT INTO tb_admin VALUES (null,'".$nama."',
            '".$username."','".$password."','".$telpon."','".$email."','".$alamat."','pelanggan')");

            if($insert){
                echo "<script>alert('Berhasil, silakan login')</script>";
                echo "<script type='text/javascript'>window.location='login.php'</script>";
            }else{
                echo "<script>alert('Gagal')</script>";
                echo "<script type='text/javascript'>window.location='register.php'</script>";
                echo '<script type="text/javascript">window.location="register.php"</script>';
            }
        }
        ?>
        </div>
    </body>
</html>