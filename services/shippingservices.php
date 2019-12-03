<?php
namespace Services;
use Repository;

class ShippingServices
{
  private $ShippingRepository;
  function __construct()
  {
    global $ShippingRepository;
    include('../repository/shippingrepository.php');
    $ShippingRepository = new Repository\ShippingRepository();
  }

  public function getShippingByUserId($user_id){
    global $ShippingRepository;

    $json_obj = $ShippingRepository->getShippingByUserId($user_id);
    if($json_obj["success"]){
        return array(
          "request" => "Get Shipping By User Id",
          "success"=> true,
          "message"=> "Shipping Details Selected Successfully",
          "message"=> null,
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else {
      return array(
        "request" => "Get Shipping By User Id",
        "success"=> false,
        "message"=> "Shipping Details Selection Failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "data" => $json_obj["status"]
      );
    }
  }
  public function updateShippingPlace($shipping_id, $shipping_place){
    global $ShippingRepository;

    $json_obj = $ShippingRepository->updateShippingPlace($shipping_id, $shipping_place);
    if($json_obj["success"]){
        return array(
          "request" => "Shipping Place Update",
          "success"=> true,
          "message"=> "Shipping Place Name Updated Successfully",
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Shipping Place Update",
        "success"=> false,
        "message"=> "Shipping Place Name Update failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "data" => $json_obj["error"]
      );
    }
  }
  public function updateShippingStreet($shipping_id, $shipping_street){
    global $ShippingRepository;

    $json_obj = $ShippingRepository->updateShippingStreet($shipping_id, $shipping_street);
    if($json_obj["success"]){
        return array(
          "request" => "Shipping Street Update",
          "success"=> true,
          "message"=> "Shipping Street Updated Successfully",
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Shipping Street Update",
        "success"=> false,
        "message"=> "Shipping Street Update failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "data" => $json_obj["error"]
      );
    }
  }
  public function updateShippingCity($shipping_id, $shipping_city){
    global $ShippingRepository;

    $json_obj = $ShippingRepository->updateShippingCity($shipping_id, $shipping_city);
    if($json_obj["success"]){
        return array(
          "request" => "Shipping City Update",
          "success"=> true,
          "message"=> "Shipping City Updated Successfully",
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Shipping City Update",
        "success"=> false,
        "message"=> "Shipping City Update failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "data" => $json_obj["error"]
      );
    }
  }
  public function updateShippingCountry($shipping_id, $shipping_county){
    global $ShippingRepository;

    $json_obj = $ShippingRepository->updateShippingCountry($shipping_id, $shipping_county);
    if($json_obj["success"]){
        return array(
          "request" => "Shipping County Update",
          "success"=> true,
          "message"=> "Shipping County Updated Successfully",
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Shipping County Update",
        "success"=> false,
        "message"=> "Shipping County Update failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "data" => $json_obj["error"]
      );
    }
  }
  public function updateShippingZip($shipping_id, $shipping_zip){
    global $ShippingRepository;

    $json_obj = $ShippingRepository->updateShippingZip($shipping_id, $shipping_zip);
    if($json_obj["success"]){
        return array(
          "request" => "Shipping Zip Update",
          "success"=> true,
          "message"=> "Shipping Zip Updated Successfully",
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Shipping Zip Update",
        "success"=> false,
        "message"=> "Shipping County Update failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "data" => $json_obj["error"]
      );
    }
  }
}
?>
