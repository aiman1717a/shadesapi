<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/cartservices.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $CartServices = new Services\CartServices();
  if(isset($_POST['cart_item_id']) && !is_null($_POST['cart_item_id']) && trim($_POST['cart_item_id']) != ""){
    $response = $CartServices->deleteCartItemByItemId($_POST['cart_item_id']);
    if(isset($response) && !is_null($response)){
      echo json_encode($response);
    } else {
      echo json_encode(array(
        "request" => "Delete Cart Item",
        "success" => false,
        "time" => date('d-m-Y', time()),
        "request_error" => array(
          "code" => "RQ001",
          "message" => "Parameters Missing"
        )
      ));
    }
  }else{
    echo json_encode(array(
      "request" => "Delete Cart Item",
      "success" => false,
      "time" => date('d-m-Y', time()),
      "request_error" => array(
        "code" => "RQ002",
        "message" => "User ID Parameter Missing"
      )
    ));
  }
}
?>
