<?php

require_once "Framework/MHErrorHandler/Catcher.php";
require_once "Framework/MHErrorHandler/ExceptionType.php";
$catcher = new Catcher();
//$catcher->exception(\MHErrorHandler\ExceptionType::Exception, "Exception test", 0);
$catcher->exception();
echo $catcher;
?>

