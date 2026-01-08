<?php
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
echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
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

<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Username or Email*" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
               
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p>
      </div>
    </div>
  </div>
</div>