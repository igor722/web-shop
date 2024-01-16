<?php

include('header.php');
include('../server/connection.php');

$getCategories = $conn_db->prepare("SELECT DISTINCT(product_category) FROM products");
$getCategories->execute();
$showCategories = $getCategories->get_result();

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

        <h2>Produkt zufügen</h2>

        <div class="mx-auto container">
            <form method="POST" action="create_product.php" enctype="multipart/form-data" id="edit-form">
                <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <div class="form-group mt-2">
                
                    <label>Produkt Name</label>
                    <input type="text" name="name" placeholder="Produkt Name" id="product-name" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label>Produktbeschreibung</label>
                    <input type="text" name="description" placeholder="Produktbeschreibung" id="product-description" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label>Preis</label>
                    <input type="number" step="0.01" name="price" placeholder="Preis" id="product-price" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <select name="category" id="" class="form-select" required>
                        <?php while($showCategory = (mysqli_fetch_array($showCategories, MYSQLI_ASSOC))) {  ?>
                            <option value="<?= $showCategory['product_category']; ?>"><?= $showCategory['product_category']; ?></option>
                        <?php } ?>
                    </select>
                <div class="form-group mt-2">
                    <h5>Farben</h5>
                    
                    <label>Farbe 1 in hex</label>
                    <input type="text" name="color1" placeholder="Farbe" id="product-color" class="form-control">
                    <label>Farbe 2 in hex</label>
                    <input type="text" name="color2" placeholder="Farbe" id="product-color" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label>Foto 1</label>
                    <input type="file" name="image1" id="image1" class="form-control" placeholder="Image 1">
                </div>
                <div class="form-group mt-2">
                    <label>Foto 2</label>
                    <input type="file" name="image2" id="image2" class="form-control" placeholder="Image 2">
                </div>
                <div class="form-group mt-2">
                    <label>Foto 3</label>
                    <input type="file" name="image3" id="image3" class="form-control" placeholder="Image 3">
                </div>
                <div class="form-group mt-2">
                    <label>Foto 4</label>
                    <input type="file" name="image4" id="image4" class="form-control" placeholder="Image 4">
                </div>
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="add-btn" value="Produkt zufügen">
                </div>

                </div>
            </form>
        </div>
        
            
        </div>
    </main>
    </div>
</div>

