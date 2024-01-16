<?php

session_start();

include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){
    header('location: index.php');
    exit();
}

if(isset($_GET['product_id'])){
    $productID = $_GET['product_id'];

    $stmt = $conn_db->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $productID);
    
    if($stmt->execute()){
        header('location: products.php?deleted_successfully=Produkt wurde gelöscht!');
    } else {
        header('location: products.php?deleted_failure=Produkt wurde nicht gelöscht!');
    }

    
}

?>