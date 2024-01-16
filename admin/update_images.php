<?php

include('../server/connection.php');

if(isset($_POST['update-img-btn'])) {

    $productID = $_POST['product-id'];
    $name = $_POST['product-name'];

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

    
    $stmt = $conn_db->prepare("UPDATE products 
                               SET product_image1 = ?, product_image2 = ?, product_image3 = ?, product_image4 = ?
                               WHERE product_id = ?");
    $stmt->bind_param('ssssi', $image_name1, $image_name2, $image_name3, $image_name4, $productID);
    if($stmt->execute()){
        header('location: products.php?photos_success_message=Bilder geändert!');
    } else {
        header('location: products.php?photos_failure_message=Fehler! Versuchen Sie später nochmal!');
    }

} 

?>