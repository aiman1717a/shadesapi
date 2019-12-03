<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/userservices.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(isset($_POST['email']) && !is_null($_POST['email']) && trim($_POST['email']) != ""){
    if(isset($_POST['password']) && !is_null($_POST['password']) && trim($_POST['password']) != ""){
      $UserServices = new Services\UserServices();
  		$json_obj = $UserServices->login($_POST['email'], $_POST['password']);
      echo json_encode($json_obj);
    } else {
      echo json_encode(array(
        "request" => "Login",
        "success" => false,
        "message"=> "Login Failed!! Try Again!!",
        "time" => date('d-m-Y', time()),
        "request_error" => array(
          "code" => "RQ002",
          "message" => "Password Parameter Missing"
        )
      ));
    }
  } else {
    echo json_encode(array(
      "request" => "Login",
      "success" => false,
      "message"=> "Login Failed!! Try Again!!",
      "time" => date('d-m-Y', time()),
      "request_error" => array(
        "code" => "RQ002",
        "message" => "Email Parameter Missing"
      )
    ));
  }
}
?>
