<?php session_start(); //es ist am beste das nur im header.php zu haben und nicht im jede Seite ?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <title>Safety Gear - Adminbereich</title>
  </head>
  <body>
    <!-- HEADER -->
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a href="#" class="navbar-brand col-md-3 col-lg-2 me-0 px-3">SafetyGear ProShop</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <?php if(isset($_SESSION['admin_logged_in'])) { ?>
            <a href="logout.php?logout=1" class="nav-link px-3">Ausloggen</a>
          <?php } ?>
        </div>
      </div>
    </header>