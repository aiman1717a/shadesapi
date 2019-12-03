<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/brandservices.php');
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  		$BrandServices = new Services\BrandServices();
  		$json_obj = $BrandServices->getBrands();
      echo json_encode($json_obj);
}
?>
