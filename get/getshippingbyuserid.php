<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/shippingservices.php');
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  if(isset($_GET['user_id']) && !is_null($_GET['user_id']) && trim($_GET['user_id']) != ""){
    $ShippingServices = new Services\ShippingServices();
    $json_obj = $ShippingServices->getShippingByUserId($_GET['user_id']);
    echo json_encode($json_obj);
  } else {
    echo json_encode(array(
      "request" => "Get Shipping By User Id",
      "success" => false,
      "message"=> "Failed!! Try Again!!",
      "time" => date('d-m-Y', time()),
      "request_error" => array(
        "code" => "RQ002",
        "message" => "User ID Parameter Missing"
      )
    ));
  }
}
?>
