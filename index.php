<?php
echo $_GET['hub_challenge']; exit;
file_put_contents("fb.txt",file_get_contents("php://input"));
?>