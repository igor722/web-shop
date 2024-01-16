<?php

include('../server/connection.php');
include('header.php');

if(!isset($_SESSION['admin_logged_in'])){
    header('location: index.php');
    exit();
}

//1. determine page no
if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    //if user has already entered page number
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

// 2. return number of products
$stmt1 = $conn_db->prepare("SELECT COUNT(*) AS total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// 3. products per page
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$total_no_of_pages = ceil($total_records / $total_records_per_page);

//4. get all products
$stmt2 = $conn_db->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$products = $stmt2->get_result();

?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">

    <?php include('sidemenu.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">

                </div>
            </div>
        </div>

        <h2>Produkte</h2>

        <!-- MODALS -->

        <?php if(isset($_GET['edit_failure_message'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message'] ?></p>
        <?php } ?>

        <?php if(isset($_GET['edit_success_message'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'] ?></p>
        <?php } ?>

        <?php if(isset($_GET['deleted_failure'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'] ?></p>
        <?php } ?>

        <?php if(isset($_GET['deleted_successfully'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'] ?></p>
        <?php } ?>

        <?php if(isset($_GET['add_failure_message'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['add_failure_message'] ?></p>
        <?php } ?>

        <?php if(isset($_GET['add_success_message'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['add_success_message'] ?></p>
        <?php } ?>

        <?php if(isset($_GET['photos_failure_message'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['photos_failure_message'] ?></p>
        <?php } ?>

        <?php if(isset($_GET['photos_success_message'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['photos_success_message'] ?></p>
        <?php } ?>

        <!-- MODALS -->

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Produkt ID</th>
                        <th scope="col">Produkt Bild</th>
                        <th scope="col">Produkt Name</th>
                        <th scope="col">Produkt Preis</th>
                        <th scope="col">Produkt Kategorie</th>
                        <th scope="col">Produkt Farbe</th>
                        <th scope="col">Fotos ändern</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Löschen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product) { ?>
                        <tr>
                            <td><?php echo $product['product_id']; ?></td>
                            <td><img src="<?php echo "../assets/imgs/" . $product['product_image1']; ?>" style="width: 70px; height:70px;"/></td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo "€" . $product['product_price']; ?></td>
                            <td><?php echo $product['product_category']; ?></td>
                            <td>
                                <div class="colors colors row mx-auto container-fluid justify-content-center">
                                    <dir class="color1" style="width: 30px; height: 30px; background-color:<?php echo $product['product_color1']; ?>"></dir>
                                    <dir class="color2" style="width: 30px; height: 30px; background-color:<?php echo $product['product_color2']; ?>"></dir>
                                </dir>
                            </td>
                            <td><a href="<?php echo "edit_images.php?product_id=" . $product['product_id'] . "&product_name=" . $product['product_name']; ?>" class="btn btn-primary">Fotos ändern</a></td>
                            <td><a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Edit</a></td>
                            <td><a href="delete_product.php?product_id=<?php echo $product['product_id'] ?>" class="btn btn-danger">Löschen</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <nav class="mx-auto" aria-label="Page navigation example" ></nav>
            <ul class="pagination mt-5 mx-auto">

                <li class="page-item <?php if($page_no <= 1){echo 'disabled';} ?>">
                    <a href="<?php if($page_no <= 1){echo '#';} else {echo "?page_no=" . ($page_no - 1);} ?>" class="page-link">Vorherige</a>
                </li>

                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                <?php if($page_no >= 3) { ?>
                    <li class="page-item"><a href="#" class="page-link">...</a></li>
                    <li class="page-item"><a href="<?php echo "page_no=" . $page_no; ?>" class="page-link"><?php echo $total_no_of_pages ?></a></li>
                <?php } ?>

                <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';} ?>">
                    <a href="<?php if($page_no >= $total_no_of_pages){echo '#';} else {echo "?page_no=" . ($page_no + 1);} ?>" class="page-link">Nächste</a>
                </li>

            </ul>
        </div>
    </main>

    </div>
</div>