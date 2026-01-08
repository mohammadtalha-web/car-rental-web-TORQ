<?php
include('includes/config.php');

$username = 'admin';
$password = 'admin';
$hashed_password = md5($password);

try {
    $sql = "UPDATE admin SET Password=:password WHERE UserName=:username";
    $query = $dbh->prepare($sql);
    $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo "Success: Password for '$username' has been reset to '$password'.";
    } else {
        echo "Info: No changes made. (Password might already be '$password' or user not found).";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
