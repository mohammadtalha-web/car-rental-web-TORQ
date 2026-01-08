<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    // First try regular User login
    $sql ="SELECT EmailId,Password,FullName FROM tblusers WHERE EmailId=:username and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() > 0)
    {
        $_SESSION['login']=$username;
        $_SESSION['fname']=$results->FullName;
        $currentpage=$_SERVER['REQUEST_URI'];
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    } else {
        // If not a user, try Admin login
        $sql_admin ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
        $query_admin= $dbh -> prepare($sql_admin);
        $query_admin-> bindParam(':username', $username, PDO::PARAM_STR);
        $query_admin-> bindParam(':password', $password, PDO::PARAM_STR);
        $query_admin-> execute();
        $results_admin=$query_admin->fetch(PDO::FETCH_OBJ);

        if($query_admin->rowCount() > 0)
        {
            $_SESSION['alogin']=$username;
            echo "<script type='text/javascript'> document.location = 'admin/dashboard.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Torq | Login</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/premium-ui.css" type="text/css">
<link rel="stylesheet" href="assets/css/dark-theme.css" type="text/css">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="split-auth-layout">
    <div class="auth-form-container">
        <div class="auth-content">
            <h2 class="auth-logo">Torq</h2>
            
            
            <form method="post">
                <div class="form-group premium-input">
                    <input type="text" class="form-control" name="username" placeholder="Username or Email" required>
                </div>
                <div class="form-group premium-input">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                
                <div class="form-actions">
                    <label class="checkbox-container">
                        <input type="checkbox" id="remember">
                        <span class="checkmark"></span>
                        Remember login
                    </label>
                    <button type="submit" name="login" class="btn-auth-submit">Login</button>
                </div>
                
                <div class="auth-footer">
                    <p>Forgot your <a href="#">username or password ?</a></p>
                    <p>Don't have account? <a href="sign-up.php">Sign Up</a></p>
                    
                    <div class="legal-text">
                        By signing up, you agree to Torq's<br>
                        <a href="#">Terms and Conditions & Privacy Policy</a>
                    </div>
                    
                     <div class="social-login-icons">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="auth-image-side" style="background-image: url('assets/images/hero-luxury-car.jpg');">
        <!-- Optional overlay or content on image side -->
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
