<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/cartservices.php');

if($_SERVER['REQUEST_METHOD'] == 'PUT')
{
  $CartServices = new Services\CartServices();
  parse_str(file_get_contents('php://input'), $PUT);

  if(isset($PUT['cart_item_id']) && !is_null($PUT['cart_item_id']) && trim($PUT['cart_item_id']) != ""){

    if(isset($PUT['cart_item_quantity']) && !is_null($PUT['cart_item_quantity']) && trim($PUT['cart_item_quantity']) != ""){
      $json_obj = $CartServices->updateCartItemQty($PUT['cart_item_id'], $PUT['cart_item_quantity']);
      $response[] = $json_obj;
    }

    if(isset($response) && !is_null($response)){
      echo json_encode($response);
    } else{
      echo json_encode(array(
        "request" => "Cart Item Qty Update",
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
      "request" => "Cart Item Qty Update",
      "success" => false,
      "time" => date('d-m-Y', time()),
      "request_error" => array(
        "code" => "RQ002",
        "message" => "Cart Item Id Parameter Missing"
      )
    ));
  }
}
?>
