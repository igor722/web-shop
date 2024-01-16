<?php

session_start();

include('server/connection.php');
include('layouts/header.php');

//if user is already registered, take user to account page
if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if($password !== $confirmPassword){
        header('location: register.php?error=Kennwörter überstimmen nicht!');
    
    } else if(strlen($password) < 6){
        header('location: register.php?error=Ihre Kennwort ist zu kurz! Länge muss mindestens 6 Zeichen sein.');
    //if there are no errors
    } else {
        //check if username with this email already exists
        $stmt1 = $conn_db->prepare("SELECT COUNT(*) FROM users WHERE user_email = ?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        if($num_rows != 0){
            header('location: register.php?error=Ein Nutzer mit diesem E-Mail ist schon registriert');
        // if no user registered with the email before
        } else {
            // create a new user
            $stmt = $conn_db->prepare("INSERT INTO users (user_name, user_email, user_password)
                            VALUES (?,?,?)");

            //if account was created succesfully
            $stmt->bind_param('sss', $name, $email, md5($password));
            if($stmt->execute()){
                $user_id = $stmt->insert_id;  //hier konnte ich ein Problem haben, weil es gibt kein place_order.php
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=Du hast dich erfolgreich registriert');
            //account could not be created
            } else {
                header('location: register.php?error=Ihre Konto wurde nicht registriert.');
            }
        }
    }
}



?>


    <!-- REGISTER -->
    <div class="container text-center pt-5 register-login">
        <h2 class="form-weight-bold">Register</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="register.php">
            <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="register-name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="">E-Mail</label>
                <input type="text" class="form-control" name="email" id="register-email" placeholder="E-Mail" required>
            </div>
            <div class="form-group">
                <label for="">Kennwort</label>
                <input type="password" class="form-control" name="password" id="register-password" required>
            </div>
            <div class="form-group">
                <label for="">Kennwort bestätigen</label>
                <input type="password" class="form-control" name="confirm-password" id="register-confirm-password" required>
            </div>
            <div class="form-group">
                <input type="submit"  class="btn" id="register-btn" name="register" value="Register">
            </div>
            <div class="form-group">
                <a id="login-url" class="btn" href="login.php">Sind Sie schon registriert? Anmelden</a>
            </div>
        </form>
    </div>
<?php include('layouts/footer.php'); ?>