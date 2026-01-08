<?php
include('includes/config.php');
$passwords = ['admin', 'password', '12345', '123456', 'admin123', 'Test@12345'];
$db_hash = '5c428d8875d2948607f3e3fe134d71b4'; // Found in DB

echo "DB Hash: " . $db_hash . "<br>";

foreach ($passwords as $p) {
    $hash = md5($p);
    echo "Password: '$p' -> Hash: $hash ";
    if ($hash == $db_hash) {
        echo " <b>MATCH FOUND!</b>";
    }
    echo "<br>";
}
echo "<br>";
echo "If no match found, we should reset the password.";
?>
