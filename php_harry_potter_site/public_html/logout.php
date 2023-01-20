<?php
include('config.php');
$username = $_COOKIE['username'];
$t = time();
file_put_contents($file_path.'/adminlog.txt', $t.",".$username.","."logout"."\n", FILE_APPEND);
// destory the cookies
setcookie('loggedin', "", time()-3600);

setcookie('username', "", time()-3600);
setcookie('firstname', "", time()-3600);
setcookie('lastname', "", time()-3600);

// send back to the admin form
header('Location: admin.php?loggedout=true');
exit();

?>
