<?php 
include '../db.php'; include('session.php');

$product_id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$product_id) {
    echo "Product not found.";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$product_id' AND status = 1");
if (mysqli_num_rows($query) == 0) {
    echo "Product not available.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details - G.R.I.N.D.</title>
    <link rel="stylesheet" type="text/css" href="../css/styleuser_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .quantity-input {
            width: 80px;
            padding: 8px;
            font-size: 16px;
            border: 2px solid #0a1a3a;
            border-radius: 6px;
            margin-right: 12px;
        }
    </style>
</head>
<body>

<!-- header -->
<header>
    <div class="navbar-container">
        <a href="dashboard_user.php" class="navbar-title">G.R.I.N.D.</a>
        <ul class="nav-links">
            <?php include('navbar.php'); ?> 
        </ul>
    </div>
</header>

<h1 class="section-title">Product Details</h1>

<div class="section">
    <div class="container">

    <?php
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$id' AND status = 1");

        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
    ?>

        <div class="product-detail-box">
            <img class="product-detail-image" src="../product/<?php echo $data['product_image']; ?>" alt="<?php echo $data['product_name']; ?>">

            <div class="product-detail-info">
                <h1><?php echo $data['product_name']; ?></h1>
                <p class="product-price">IDR <?php echo number_format($data['product_price']); ?></p>
                <p class="product-stock">Units in stock: <?php echo $data['stok']; ?></p>
                <p class="product-size">Size ranged from 35 to 45.</p>
                <details class="product-details">
                    <summary>Description</summary>
                    <p class="product-description"><?php echo $data['product_description']; ?></p>
                </details>
                

                <form action="chart_proses.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
                                <input type="hidden" name="stok" value="<?php echo $data['stok']; ?>">
                                <input type="hidden" name="admin_id" value="<?php echo $_SESSION['id_login']; ?>">
                                <input type="number" name="jml" class="quantity-input" min="1" max="<?php echo $data['stok']; ?>" placeholder="Qty." required>
                                <button type="submit" name="submit" class="add-to-cart-btn">Buy now</button>
                            </form>
            </div>
        </div>

    <?php
        } else {
            echo "<p>Product not found or is unavailable.</p>";
        }
    } else {
        echo "<p>No product selected.</p>";
    }
    ?>

    </div>
</div>

<footer>
    <!-- Optional: Your footer content here -->
</footer>

</body>
</html>