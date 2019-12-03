<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/productservices.php');
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
		$ProductServices = new Services\ProductServices();
		$json_obj = $ProductServices->getProducts();
    echo json_encode($json_obj);
}
?>
