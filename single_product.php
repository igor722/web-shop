<?php

include('server/get_all_products.php');
include('layouts/header.php');

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
    
    $get_single_product_query = $conn_db->prepare("SELECT * FROM products WHERE product_id = ?");
    $get_single_product_query->bind_param("i", $product_id);
    $get_single_product_query->execute();

    $product = $get_single_product_query->get_result();
} else {
    header('location: index.php');
}

?>

    <?php while($row = (mysqli_fetch_array($product, MYSQLI_ASSOC))){  ?>

    
    <div class="row mx-auto container-fluid main-wrapper single-product-parent">
        <div class="single-product-child-sm-imgs col-lg-3 col-md-4 col-sm-12 d-flex flex-wrap justify-content-center d-flex flex-column mb-3 photo-wrapper">
          <img
            class="product-photos-small"
            src="assets/imgs/<?php echo $row["product_image1"]; ?>"
            alt="Thumbnail 1"
            id="thumbnail-1"
            onclick="changeImg1()"
          />
            <img
            class="product-photos-small"
            src="assets/imgs/<?php echo $row["product_image2"]; ?>"
            alt="Thumbnail 2"
            id="thumbnail-2"
            onclick="changeImg2()"
          />
          <img
            class="product-photos-small"
            src="assets/imgs/<?php echo $row["product_image3"]; ?>"
            alt="Thumbnail 3"
            id="thumbnail-3"
            onclick="changeImg3()"
          />
          <img
            class="product-photos-small"
            src="assets/imgs/<?php echo $row["product_image4"]; ?>"
            alt="Thumbnail 4"
            id="thumbnail-4"
            onclick="changeImg4()"
          />
        </div>
        <div class="single-product-child-main-img col-lg-3 col-md-4 col-sm-12 d-flex flex-wrap justify-content-center">
            <img id="big-img" class="img-fluid mb-3" src="assets/imgs/<?php echo $row["product_image1"]; ?> " />
        </div>
        <div class="single-product-child-text col-lg-3 col-md-4 col-sm-12 d-flex flex-wrap justify-content-center">
            <h3 class="p-name">
          <?php echo $row["product_name"]; ?>
        </h3>
        <h5><?php echo $row["product_description"]; ?>"></h5>
        <h2 class="p-price">€<?php echo $row["product_price"]; ?></h2>
        
        <div
          class="colors colors row mx-auto container-fluid justify-content-center"
        >
          <p class="color-p">Color:  </p>
          <div class="color1" style="background-color: <?php echo $row["product_color1"]; ?>"></div>
          <div class="color2" style="background-color: <?php echo $row["product_color2"]; ?>"></div>
        </div>
        <form method="POST" action="cart.php">
        <input type="hidden" name="product-id" value="<?php echo $row["product_id"]; ?>">
        <input type="hidden" name="product-image" value="<?php echo $row["product_image1"]; ?>">
        <input type="hidden" name="product-name" value="<?php echo $row["product_name"]; ?>">
        <input type="hidden" name="product-price" value="<?php echo $row["product_price"]; ?>">
        <div class="row g-3">
            <div class="col-auto">
                <label for="quantity" class="visually-hidden">Password</label>
                <input type="number" name="product-quantity" class="form-control" id="quantity" value="1">
            </div>
            <div class="col-auto">
                <button type="submit" name="add-to-cart" class="btn btn-primary mb-3">In den Warenkorb</button>
            </div>
        </div>
        
    </div>

    </form>
    <?php } ?>

    <script src="scripts/script.js"></script>
<?php include('layouts/footer.php'); ?>