<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/userservices.php');

if($_SERVER['REQUEST_METHOD'] == 'PUT')
{
  $UserServices = new Services\UserServices();
  parse_str(file_get_contents('php://input'), $PUT);

  if(isset($PUT['user_id']) && !is_null($PUT['user_id']) && trim($PUT['user_id']) != ""){

    if(isset($PUT['user_name']) && !is_null($PUT['user_name']) && trim($PUT['user_name']) != ""){
      $json_obj = $UserServices->updateUserName($PUT['user_id'], $PUT['user_name']);
      $response[] = $json_obj;
    }

    if(isset($PUT['email']) && !is_null($PUT['email']) && trim($PUT['email']) != ""){
      $json_obj = $UserServices->updateUserEmail($PUT['user_id'], $PUT['email']);
      $response[] = $json_obj;
    }

    if(isset($PUT['password']) && !is_null($PUT['password']) && trim($PUT['password']) != ""){
      $json_obj = $UserServices->updateUserPassword($PUT['user_id'], $PUT['password']);
      $response[] = $json_obj;
    }

    if(isset($response) && !is_null($response)){
      echo json_encode($response);
    } else{
      echo json_encode(array(
        "request" => "User Update",
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
      "request" => "User Update",
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
