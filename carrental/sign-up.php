<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['signup']))
{
    $fname=$_POST['fullname'];
    $email=$_POST['emailid']; 
    $mobile=$_POST['mobileno'];
    $password=md5($_POST['password']); 
    $sql="INSERT INTO  tblusers(FullName,EmailId,ContactNo,Password) VALUES(:fname,:email,:mobile,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    echo "<script>alert('Registration successfull. Now you can login'); document.location = 'login-page.php';</script>";
    }
    else 
    {
    echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Torq | Sign Up</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/premium-ui.css" type="text/css">
<link rel="stylesheet" href="assets/css/dark-theme.css" type="text/css">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script>
function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
    url: "check_availability.php",
    data:'emailid='+$("#emailid").val(),
    type: "POST",
    success:function(data){
    $("#user-availability-status").html(data);
    $("#loaderIcon").hide();
    },
    error:function (){}
    });
}

function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
</head>
<body>

<div class="split-auth-layout">
    <div class="auth-form-container">
        <div class="auth-content">
            <h2 class="auth-logo">Torq</h2>
            
            <form method="post" name="signup" onSubmit="return valid();">
                <div class="form-group premium-input">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                <div class="form-group premium-input">
                    <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="10" required="required">
                </div>
                <div class="form-group premium-input">
                    <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                    <span id="user-availability-status" style="font-size:12px;"></span> 
                    <span id="loaderIcon" style="display:none;"><img src="assets/images/loader-icon.gif" /></span>
                </div>
                <div class="form-group premium-input">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group premium-input">
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                </div>
                
                <div class="form-actions">
                     <label class="checkbox-container">
                        <input type="checkbox" id="terms_agree" required="required" checked="">
                        <span class="checkmark"></span>
                         I Agree with <a href="#">Terms</a>
                    </label>
                    <button type="submit" value="Sign Up" name="signup" id="submit" class="btn-auth-submit">Sign Up</button>
                </div>
                
                <div class="auth-footer">
                    <p>Already got an account? <a href="login-page.php">Login Here</a></p>
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
