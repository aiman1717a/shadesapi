<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/shippingservices.php');

if($_SERVER['REQUEST_METHOD'] == 'PUT')
{
  $ShippingServices = new Services\ShippingServices();
  parse_str(file_get_contents('php://input'), $PUT);

  if(isset($PUT['shipping_id']) && !is_null($PUT['shipping_id']) && trim($PUT['shipping_id']) != ""){

    if(isset($PUT['shipping_place']) && !is_null($PUT['shipping_place']) && trim($PUT['shipping_place']) != ""){
      $json_obj = $ShippingServices->updateShippingPlace($PUT['shipping_id'], $PUT['shipping_place']);
      $response[] = $json_obj;
    }

    if(isset($PUT['shipping_street']) && !is_null($PUT['shipping_street']) && trim($PUT['shipping_street']) != ""){
      $json_obj = $ShippingServices->updateShippingStreet($PUT['shipping_id'], $PUT['shipping_street']);
      $response[] = $json_obj;
    }

    if(isset($PUT['shipping_city']) && !is_null($PUT['shipping_city']) && trim($PUT['shipping_city']) != ""){
      $json_obj = $ShippingServices->updateShippingCity($PUT['shipping_id'], $PUT['shipping_city']);
      $response[] = $json_obj;
    }

    if(isset($PUT['shipping_country']) && !is_null($PUT['shipping_country']) && trim($PUT['shipping_country']) != ""){
      $json_obj = $ShippingServices->updateShippingCountry($PUT['shipping_id'], $PUT['shipping_country']);
      $response[] = $json_obj;
    }

    if(isset($PUT['shipping_zip']) && !is_null($PUT['shipping_zip']) && trim($PUT['shipping_zip']) != ""){
      $json_obj = $ShippingServices->updateShippingZip($PUT['shipping_id'], $PUT['shipping_zip']);
      $response[] = $json_obj;
    }

    if(isset($response) && !is_null($response)){
      echo json_encode($response);
    } else{
      echo json_encode(array(
        "request" => "Shipping Update",
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
      "request" => "Shipping Update",
      "success" => false,
      "time" => date('d-m-Y', time()),
      "request_error" => array(
        "code" => "RQ002",
        "message" => "Shipping ID Parameter Missing"
      )
    ));
  }
}
?>
