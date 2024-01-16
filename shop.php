<?php 
include('server/connection.php');
include('layouts/header.php');

$getCategories = $conn_db->prepare("SELECT DISTINCT(product_category) FROM products");
$getCategories->execute();
$showCategories = $getCategories->get_result();

if(isset($_POST['search'])){
  //when filter section is used
  $category = $_POST['category'];
  echo $category;
  
  $get_all_products_query = $conn_db->prepare("SELECT * FROM products WHERE product_category = ?");
  $get_all_products_query->bind_param('s', $category);
  $get_all_products_query->execute();

  $all_products = $get_all_products_query->get_result();


} else {
  $get_all_products_query = $conn_db->prepare("SELECT * FROM products");
  $get_all_products_query->execute();

  $all_products = $get_all_products_query->get_result();

}



?>

<main>
  <div class="parent">

    <!-- PRODUCTS FILTER -->
    <div class="row mx-auto container-fluid child-search">
      <div class="col-lg-3 col-md-3 col-sm-3">
        <form method="POST" action="shop.php">
            <p>Kategorie</p>
              
            <?php while($showCategory = (mysqli_fetch_array($showCategories, MYSQLI_ASSOC))) {  ?>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="category"  value="<?= $showCategory['product_category']; ?>">
                <label class="form-check-label"><?= $showCategory['product_category']; ?></label>
              </div>
            <?php } ?>
          
          <div class="form-group my-3 mx-3">
            <input type="submit" name="search" value="search" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>

    <!-- PRODUCTS -->
    <div class="row mx-auto container-fluid child-products">
      
      
      <?php while($row = (mysqli_fetch_array($all_products, MYSQLI_ASSOC))){  ?>
    
      <div class="product text-center col-lg-3 col-md-4 col-sm-12 d-flex flex-wrap justify-content-center">
        <img class="img-fluid mb-3 main-product-img" src="assets/imgs/<?php echo $row["product_image1"]; ?> " />
        
        <h5 class="p-name">
          <?php echo $row["product_name"]; ?>
        </h5>
        <p><?php echo $row["product_description"]; ?>"></p>
        <h4 class="p-price">€<?php echo $row["product_price"]; ?></h4>
        
        <div
          class="colors colors row mx-auto container-fluid justify-content-center"
        >
          <div><p>Color</p></div>
          <div class="color1" style="background-color: <?php echo $row["product_color1"]; ?>"></div>
          <div class="color2" style="background-color: <?php echo $row["product_color2"]; ?>"></div>
        </div>
        <div>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button type="button"  class="btn btn-outline-success buy-btn">Kaufen</button></a>
        </div>
      </div>
      <?php } ?>

      
    </div>
  </div>
</main>
  
<?php include('layouts/footer.php'); ?>