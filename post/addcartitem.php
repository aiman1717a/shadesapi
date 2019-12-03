<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/cartservices.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $CartServices = new Services\CartServices();
  $validation = false;
  if(isset($_POST['cart_id']) && !is_null($_POST['cart_id']) && trim($_POST['cart_id']) != ""){
    if(isset($_POST['product_id']) && !is_null($_POST['product_id']) && trim($_POST['product_id']) != ""){
      if(isset($_POST['cart_item_quantity']) && !is_null($_POST['cart_item_quantity']) && trim($_POST['cart_item_quantity']) != ""){
        if(isset($_POST['cart_item_price']) && !is_null($_POST['cart_item_price']) && trim($_POST['cart_item_price']) != ""){
          $validation = true;
        }
      }
    }
  }
  if($validation === true){
    $response = $CartServices->addCartItem($_POST['cart_id'], $_POST['product_id'], $_POST['cart_item_quantity'], $_POST['cart_item_price']);
    if(isset($response) && !is_null($response)){
      echo json_encode($response);
    }
  } else {
    echo json_encode(array(
      "request" => "Cart Item Adding",
      "success" => false,
      "time" => date('d-m-Y', time()),
      "request_error" => array(
        "code" => "RQ001",
        "message" => "Parameters Missing"
      )
    ));
  }
}
?>
