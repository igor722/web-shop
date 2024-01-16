<?php

include('header.php');
include('../server/connection.php');

if(isset($_GET['product_id'])){ //maybe product-id
    $productID = $_GET['product_id'];
    $stmt = $conn_db->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $products = $stmt->get_result();
} else if(isset($_POST['edit-btn'])) {

    $productID = $_POST['product-id'];
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $category    = $_POST['category'];
    $color1      = $_POST['color1'];
    $color2      = $_POST['color2'];

    $stm1 = $conn_db->prepare("UPDATE products SET product_name = ?, product_description = ?, product_price = ?,
                               product_category = ?, product_color1 = ?, product_color2 = ?
                               WHERE product_id = ?");
    $stm1->bind_param('ssssssi', $name, $description, $price, $category, $color1, $color2, $productID);
    if($stm1->execute()){
        header('location: products.php?edit_success_message=Produkt geändert!');
    } else {
        header('location: products.php?edit_failure_message=Fehler! Produkt nicht geändert!');
    }

} else {
    header('location: product.php');
    exit;
}
?>

<div class="container-fluid">
    <div class="row" style="min-height: 100px;">
        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">

                </div>
            </div>
        </div>

        <h2>Produkt ändern</h2>

        <div class="mx-auto container">
            <form method="POST" action="edit_product.php" id="edit-form">
                <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <div class="form-group mt-2">
                <?php foreach($products as $product) { ?>
                    <input type="hidden" name="product-id" value="<?php echo $product['product_id'] ?>">
                    <label>Produkt Name</label>
                    <input type="text" name="name" value="<?php echo $product['product_name'] ?>" placeholder="Produkt Name" id="product-name" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label>Produktbeschreibung</label>
                    <input type="text" name="description" value="<?php echo $product['product_description'] ?>" placeholder="Produktbeschreibung" id="product-description" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label>Preis</label>
                    <input type="number" step="0.01" name="price" value="<?php echo $product['product_price'] ?>" placeholder="Preis" id="product-price" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <select name="category" id="" class="form-select" required>
                        <option value="T-Shirt">T-Shirts</option>
                        <option value="Jacke">Jacken</option>
                        <option value="Hose">Hosen</option>
                        <option value="Mütze">Mützen</option>
                        <option value="Latzschürze">Latzschürzen</option>
                        <option value="Schuhe">Schuhe</option>
                        <option value="Handschuhe">Handschuhe</option>
                        <option value="Overall">Overalls</option>
                    </select>
                <div class="form-group mt-2">
                    <h5>Farben</h5>

                    <dir style="width: 30px; height: 30px; background-color:<?php echo $product['product_color1']; ?>"></dir>
                    <dir style="width: 30px; height: 30px; background-color:<?php echo $product['product_color2']; ?>"></dir>
                    
                    <label>Farbe 1 in hex</label>
                    <input type="text" name="color1" value="<?php echo $product['product_color1'] ?>" placeholder="Farbe" id="product-color" class="form-control">
                    <label>Farbe 2 in hex</label>
                    <input type="text" name="color2" value="<?php echo $product['product_color2'] ?>" placeholder="Farbe" id="product-color" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="edit-btn" value="Edit">
                </div>
                <?php } ?>
                </div>
            </form>
        </div>
        
            
        </div>
    </main>
    </div>
</div>