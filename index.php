<?php
//print_r($_GET['hub_challenge']);
//$values = json_encode($_REQUEST) . json_encode($_GET) . json_encode($_POST) . json_encode(file_get_contents('php://input'));
file_put_contents("fb.txt",file_get_contents('php://input'));
?>