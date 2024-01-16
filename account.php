<?php
session_start();

include('server/connection.php');
include('layouts/header.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
    }
}

// change password
if(isset($_POST['change-password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $email = $_SESSION['user_email'];

    if($password !== $confirmPassword){
        header('location: account.php?error=Kennwörter überstimmen nicht!');
    
    } else if(strlen($password) < 6){
        header('location: account.php?error=Ihre Kennwort ist zu kurz! Länge muss mindestens 6 Zeichen sein.');
    } else {
        $stmt = $conn_db->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
        $stmt->bind_param('ss', md5($password), $email);
        if($stmt->execute()){
            header('location: account.php?message=Ihr Kennwort ist geändert.');
        } else {
            header('location: account.php?error=Ihr Kennwort ist nicht geändert.');
        }
    }
}




?>

    <!-- ACCOUNT -->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <p class="text-center" style="color: green;"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];}?></p>
                <p class="text-center" style="color: green;"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];}?></p>
                <h3 class="font-weight-bold">Konto</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; }?></span></p>
                    <p>E-Mail <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_email']; }?></span></p>
                    <p><a href=account.php?logout=1" id="logout-btn">Ausloggen</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <form method="POST" action="account.php" id="account-form">
                    <p class="text-center" style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                    <p class="text-center" style="color: green;"><?php if(isset($_GET['message'])){echo $_GET['message'];}?></p>
                    <h3>Kennwort ändern</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label for="">Kennwort</label>
                        <input type="password" name="password" class="form-control" id="account-password">
                    </div>
                    <div class="form-group">
                        <label for="">Kennwort wiederholen</label>
                        <input type="password" name="confirm-password" class="form-control" id="account-password-confirm">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="change-password" value="Kennwort ändern" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>

    

<?php include('layouts/footer.php'); ?>