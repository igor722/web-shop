<?php

session_start();
include('server/connection.php');
include('layouts/header.php');

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

if(isset($_POST['login-btn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn_db->prepare("SELECT user_id, user_email, user_name, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $password);
    if($stmt->execute()){
        $stmt->bind_result($user_id, $user_email, $user_name, $user_password);
        $stmt->store_result();
        
        if($stmt->num_rows() == 1){
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success=Erfolgreich eingeloggt!');


        } else {
            header('location: login.php?error=Ihre E-Mail und/oder Kennwort stimmen nicht.');
        }
    } else {
        //error
        header('location: login.php?error=Etwas hat nicht geklappt');
    }
}


?>


    <!-- LOGIN -->
    <div class="container text-center pt-5 register-login">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <p stlye="color: red;" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
        <form id="login-form" method="POST" action="login.php">
            <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
            
            <div class="form-group">
                <label for="">E-Mail</label>
                <input type="text" class="form-control" name="email" id="login-email" placeholder="E-Mail" required>
            </div>
            <div class="form-group">
                <label for="">Kennwort</label>
                <input type="password" class="form-control" name="password" id="login-password" required>
            </div>
            
            <div class="form-group">
                <input type="submit"  class="btn" id="register-btn" name="login-btn" value="Login">
            </div>
            <div class="form-group">
                <a id="register-url" class="btn" href="register.php">Haben Sie keine Konto? Registrieren</a>
            </div>
        </form>
    </div>
<?php include('layouts/footer.php'); ?>