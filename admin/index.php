<?php

include('header.php'); 

if(!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}


?>

<dic class="container-fluid">
    <div class="row">
        
        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-cewnter pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>
                </div>
            </div>
            <h3>Hallo <?=$_SESSION['admin_name']; ?>, willkommen im Adminbereich</h3>
        </main>

    </div>
</dic>