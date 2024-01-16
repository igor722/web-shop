<?php

include('../server/connection.php');

if(isset($_POST['add-btn'])) {

    $name        = $_POST['name'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $category    = $_POST['category'];
    $color1      = $_POST['color1'];
    $color2      = $_POST['color2'];

    $image1      = $_FILES['image1']['tmp_name'];
    $image2      = $_FILES['image2']['tmp_name'];
    $image3      = $_FILES['image3']['tmp_name'];
    $image4      = $_FILES['image4']['tmp_name'];
    //$file_name   = $_FILES['image1']['name'];

    $image_name1 = $name . "1.jpeg";
    $image_name2 = $name . "2.jpeg";
    $image_name3 = $name . "3.jpeg";
    $image_name4 = $name . "4.jpeg";

    move_uploaded_file($image1, "../assets/imgs/" . $image_name1);
    move_uploaded_file($image2, "../assets/imgs/" . $image_name2);
    move_uploaded_file($image3, "../assets/imgs/" . $image_name3);
    move_uploaded_file($image4, "../assets/imgs/" . $image_name4);

    
    $stm = $conn_db->prepare("INSERT INTO products (product_name, product_description, product_price,
                               product_category, product_color1, product_color2, product_image1, product_image2, product_image3, product_image4)
                               VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stm->bind_param('ssssssssss', $name, $description, $price, $category, $color1, $color2, $image_name1, $image_name2, $image_name3, $image_name4);
    if($stm->execute()){
        header('location: products.php?add_success_message=Produkt zugefügt!');
    } else {
        header('location: products.php?add_failure_message=Fehler! Versuchen Sie später nochmal!');
    }

} 


?>