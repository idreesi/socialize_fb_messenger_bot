<?php
//$values = json_encode($_REQUEST) . json_encode($_GET) . json_encode($_POST) . json_encode(file_get_contents('php://input'));
file_put_contents("fb.txt",json_encode($_REQUEST));
?>