<?php
include 'session.php';
include '../db.php';

if (!isset($_GET['product_id'])) {
    echo "Product not found.";
    exit;
}

$product_id = intval($_GET['product_id']);
$query = mysqli_query($conn, "SELECT tb_product.*, tb_category.category_name 
    FROM tb_product 
    JOIN tb_category ON tb_product.category_id = tb_category.category_id 
    WHERE tb_product.product_id = $product_id
    LIMIT 1");
$product = mysqli_fetch_assoc($query);

if (!$product) {
    echo "Product not found.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Detail | TopiQ</title>
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
        <div class="container">
            <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <img src="../produk/<?php echo htmlspecialchars($product['product_image']); ?>" width="200px" alt="Product Image">
            <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category_name']); ?></p>
            <p><strong>Price:</strong> Rp. <?php echo number_format($product['product_price']); ?></p>
            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($product['product_description'] ?? '')); ?></p>
            <a href="checkout.php?product_id=<?php echo $product['product_id']; ?>" class="btn">Buy Now</a>
        </div>
    </div>
    <footer>
        <div class="container">
            <small>&copy; 2025 - TopiQ</small>
        </div>
    </footer>
</body>
</html>