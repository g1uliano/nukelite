<?php
$local = "install/index.php";
$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
header($header_location . $local);
?>