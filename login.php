<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopiQ | Sign In</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id=bg-login>
    <div class="box-login">
        <h1>Sign In</h1>
        <img src="img/topiqlogo3.png" alt="" width="250px">
   
        <form action="" method="post">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Sign in" class="btn">
            <p class="bottom-text">
                <label for="">Doesn't have account?</label> <a href="register.php"><b>Register</b></a>
            </p>
        </form>

        <?php
        include('db.php');
        if (isset($_POST['submit'])) {
            $username = $_POST['user'];
            $password = $_POST['pass'];

            $sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'")
            or die(mysqli_error());
            if(mysqli_num_rows($sql) == 0 ){
                echo "<script>alert('Username atau Password anda Salah')</script>";
                echo'<script type="text/javascript">window.location="login.php"</script>';

            }else{
                session_start();
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['id_login'] = $row['admin_id'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['status_login']= true;

                if($row['level'] == 'admin'){
                    echo "<script>alert('login Sukses')</script>";
                    echo '<script type="text/javascript">window.location="admin/dashboard.php"</script>';
                }elseif ($row['level'] == 'pelanggan'){
                    echo "<script>alert('login Sukses')</script>";
                    echo '<script type="text/javascript">window.location="user/dashboard_user.php"</script>';
                }else{
                    header('locatin:index.php');
                }
            }
        }
        ?>
    </div>
</body>
</html>