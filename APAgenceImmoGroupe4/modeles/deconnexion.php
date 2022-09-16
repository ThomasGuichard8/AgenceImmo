<?php

session_start();

include_once '../vuescontrolleurs/menu.php';

session_destroy();

unset($_SESSION);

echo '<script language="JavaScript">
             setTimeout("window.location=\''."../vuescontrolleurs/index.php".'\'"); 
             </script>';

?>