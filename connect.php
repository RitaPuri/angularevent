<?php 
$conn = mysqli_connect('localhost','root','','i2capmarkets');
header('Authorization: ApiAuth xyz');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
?>