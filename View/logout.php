<?php 

session_start();

$_SESSION=array(); 

setcookie("PHPSESSID","",time()-3000,'/~bsg23/',0,0);

session_destroy();

echo "<h2> You are now logged out. </h2> <br>";

?>
