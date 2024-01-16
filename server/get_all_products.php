<?php

include('connection.php');

$get_all_products_query = $conn_db->prepare("SELECT * FROM products");
$get_all_products_query->execute();

$all_products = $get_all_products_query->get_result();

?>