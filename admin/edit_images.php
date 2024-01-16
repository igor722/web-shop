<?php

include('header.php');

if(isset($_GET['product_id'])){ //vielleicht product-id
    $productID = $_GET['product_id'];
    $name = $_GET['product_name'];
    
} else {
    header('location: products.php');
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

        <h2>Edit Fotos</h2>

        <div class="mx-auto container">

            <form method="POST" action="update_images.php" enctype="multipart/form-data" id="edit-image-form">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                <input type="hidden" name="product-id" value="<?php echo $productID ?>"/>
                <input type="hidden" name="product-name" value="<?php echo $name ?>"/>

                <div class="form-group mt-2">
                    <label>Image 1</label>
                    <input type="file" name="image1" id="image1" class="form-control" placeholder="Image 1"/>
                </div>

                <div class="form-group mt-2">
                    <label>Image 2</label>
                    <input type="file" name="image2" id="image2" class="form-control" placeholder="Image 2"/>
                </div>

                <div class="form-group mt-2">
                    <label>Image 3</label>
                    <input type="file" name="image3" id="image3" class="form-control" placeholder="Image 3"/>
                </div>

                <div class="form-group mt-2">
                    <label>Image 4</label>
                    <input type="file" name="image4" id="image4" class="form-control" placeholder="Image 4"/>
                </div>

                <div class="form-group mt-3">
                    <input type="submit" name="update-img-btn" id="sub-btn" class="btn btn-primary" value="Bestätigen"/>
                </div>
            </form>
        </div>
    </div>
</div>