<?php

session_start();
include("connections.php");
$user_id = $_SESSION["user_id"];
$user_md5 = md5($user_id);


function rand_a( $length = 50 ) {
$str = "abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890";
$shuffled = substr ( str_shuffle( $str ), 0,  $length );
return $shuffled;
}

$shuffled_logout = rand_a(57);
unset($_SESSION['user_id']);
session_unset();
session_destroy();
echo "Logging out ... Please wait ...";
echo "<script>window.location.href='index?logout=$shuffled_logout&v_1=$user_md5';</script>";
exit();

?>

