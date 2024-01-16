<?php

session_start();
include('layouts/header.php');

if(isset($_POST['add-to-cart'])){

    //if user has already added a product to the cart
    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'], "product_id"); // return an array with all products ids
        //checks if product has already been added to cart
        if(!in_array($_POST['product-id'], $products_array_ids)){ // if 'product_id' exists in $products_array_ids array

            $product_id = $_POST['product-id'];

            $product_array = array(
                'product_id' => $_POST['product-id'],
                'product_name' => $_POST['product-name'],
                'product_price' => $_POST['product-price'],
                'product_image' => $_POST['product-image'],
                'product_quantity' => $_POST['product-quantity']
            );

            //creata a new session and adding array in it
            $_SESSION['cart'][$product_id] = $product_array;

            //product has already been added
        } else {
            echo '<script>alert("Dieses Produkt befindet sich schon im Einkaufskorb!");</script>';
        }

    //if this is first product to the cart
    } else {
        //getting the values from POST request from single_product.php
        $product_id = $_POST['product-id'];
        $product_name = $_POST['product-name'];
        $product_price = $_POST['product-price'];
        $product_image = $_POST['product-image'];
        $product_quantity = $_POST['product-quantity'];

        //making an array from those values
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        
        $_SESSION['cart'][$product_id] = $product_array; //product_id is key value from this array

    }

    //Update total price
    calculateTotalCart();

//remove product from cart
} else if(isset($_POST['remove-product'])) {
    $product_id = $_POST['product-id'];
    unset($_SESSION['cart'][$product_id]);
    calculateTotalCart();

// edit quantity
} else if(isset($_POST['edit-quantity'])) {

    // get ID and quantity from form
    $product_id = $_POST['product-id'];
    $product_quantity = $_POST['product-quantity'];

    //get product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    $product_array['product_quantity'] = $product_quantity; //product array is old array and now is being updated with
                                                            //new value, which came from form

    // return array back to session                                                        
    $_SESSION['cart'][$product_id] = $product_array;

    calculateTotalCart();



} else {
    header('location: index.php');
}

function calculateTotalCart(){

    $total = 0;

    foreach($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];

        $price = $product['product_price']; //ako ne funkcionira, probati product-price
        $quantity = $product['product_quantity']; //ako ne funkcionira, probati product-price

        $total = $total + ($price * $quantity);
    }

    $_SESSION['total'] = $total;

}

?>




    <!-- TABLE -->

    <div class="cart-table">
        <table class="mt-5 pt-5 buy-table">
            <tr>
                <th>Produkt</th>
                <th>Menge</th>
                <th>Zwischensumme</th>
            </tr>

            <?php foreach($_SESSION['cart'] as $key => $value){ //key se odnosi na key iz $_SESSION Arraya?>
            <tr>
                <td>
                    <div class="cart-produkt-parent">
                        <div class="cart-produkt-img-child">
                            <img class="cart-img" src="assets/imgs/<?php echo $value['product_image']; ?>" alt="">
                        </div>
                        <div class="cart-produkt-text-child">
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span>€</span><?php echo $value['product_price']; ?></small>
                            <br>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="product-id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" name="remove-product" class="remove-btn btn btn-danger" value="Entfernen"></input>
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <!-- EDIT FORM -->
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product-id" value="<?php echo $value['product_id']; ?>">
                        <input type="number" name="product-quantity" value="<?php echo $value['product_quantity']; ?>">
                        <input type="submit" name="edit-quantity" class="edit-btn btn btn-success" value="Edit">
                    </form>
                    
                </td>
                <td>
                    <span>€</span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td>Total:   </td>
                <td class="total-price">€<?php echo $_SESSION['total']; ?></td>
            </tr>
        </table>
    </div>

<?php include('layouts/footer.php'); ?>