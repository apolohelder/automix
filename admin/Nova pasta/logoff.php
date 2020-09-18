<?php 
session_start();
session_destroy();
print("<script> location = 'login.php'</script>");
?>