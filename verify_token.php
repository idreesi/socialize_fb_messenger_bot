<?php

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];
file_put_contents("fb.txt",file_get_contents("php://input"));
if ($verify_token === 'my_token_code') {
echo $challenge;
}
?>
