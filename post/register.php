<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/userservices.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $UserServices = new Services\UserServices();
  $validation = false;

  if(isset($_POST['user_name']) && !is_null($_POST['user_name']) && trim($_POST['user_name']) != ""){
    if(isset($_POST['user_email']) && !is_null($_POST['user_email']) && trim($_POST['user_email']) != ""){
      if(isset($_POST['user_password']) && !is_null($_POST['user_password']) && trim($_POST['user_password']) != ""){
        $validation = true;
      }
    }
  }

  if($validation === true){
    $response = $UserServices->register($_POST['user_name'], $_POST['user_email'], $_POST['user_password']);
    if(isset($response) && !is_null($response)){
      echo json_encode($response);
    }
  } else {
    echo json_encode(array(
      "request" => "User Registration",
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
