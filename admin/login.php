<?php

include('../server/connection.php');
include('header.php');

if(isset($_SESSION['admin_logged_in'])){
    header('location: index.php');
    exit;
}

if(isset($_POST['login-btn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn_db->prepare("SELECT admin_id, admin_email, admin_name, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $password);
    if($stmt->execute()){
        $stmt->bind_result($admin_id, $admin_email, $admin_name, $admin_password);
        $stmt->store_result();
        
        if($stmt->num_rows() == 1){
            $stmt->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php?login_success=Erfolgreich eingeloggt!');


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
    <div class="container text-center mt-3 pt-5">
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
            
        </form>
    </div>
<?php include('footer.php'); ?>