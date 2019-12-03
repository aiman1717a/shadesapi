<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/profileservices.php');

if($_SERVER['REQUEST_METHOD'] == 'PUT')
{
  $ProfileServices = new Services\ProfileServices();
  parse_str(file_get_contents('php://input'), $PUT);
  if(isset($PUT['user_id']) && !is_null($PUT['user_id']) && trim($PUT['user_id']) != ""){

    if(isset($PUT['first_name']) && !is_null($PUT['first_name']) && trim($PUT['first_name']) != ""){
      $json_obj = $ProfileServices->updateProfileFirstName($PUT['user_id'], $PUT['first_name']);
      $response[] = $json_obj;
    }

    if(isset($PUT['last_name']) && !is_null($PUT['last_name']) && trim($PUT['last_name']) != ""){
      $json_obj = $ProfileServices->updateProfileLastName($PUT['user_id'], $PUT['last_name']);
      $response[] = $json_obj;
    }

    if(isset($PUT['address']) && !is_null($PUT['address']) && trim($PUT['address']) != ""){
      $json_obj = $ProfileServices->updateProfileAddress($PUT['user_id'], $PUT['address']);
      $response[] = $json_obj;
    }

    if(isset($response) && !is_null($response)){
      echo json_encode($response);
    } else{
      echo json_encode(array(
        "request" => "Profile Update",
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
      "request" => "profile Update",
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
