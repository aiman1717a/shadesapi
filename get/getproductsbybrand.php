<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/productservices.php');
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  if(isset($_GET['brand_name']) && !is_null($_GET['brand_name']) && trim($_GET['brand_name']) != ""){
    $ProductServices = new Services\ProductServices();
    $json_obj = $ProductServices->getProductsByBrand($_GET['brand_name']);
    echo json_encode($json_obj);
  } else {
    echo json_encode(array(
      "request" => "Get Products By Brand",
      "success" => false,
      "message"=> "Failed!! Try Again!!",
      "time" => date('d-m-Y', time()),
      "request_error" => array(
        "code" => "RQ001",
        "message" => "Parameter Missing"
      )
    ));
  }
}
?>
