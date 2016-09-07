<?php
print_r($_GET); exit;
file_put_contents("fb.txt",file_get_contents("php://input"));
?>