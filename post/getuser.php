<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/userservices.php');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$UserServices = new Services\UserServices();
  if(isset($_POST['user_id']) && !is_null($_POST['user_id']) && trim($_POST['user_id']) != ""){
		$json_obj = $UserServices->getUser($_POST['user_id']);
    echo json_encode($json_obj);
	}else{
    echo json_encode(array(
      "request" => "Get User",
      "success" => false,
			"message"=> "Account details could not be loaded",
      "time" => date('d-m-Y', time()),
      "request_error" => array(
				"code" => "RQ001",
				"message" => "Parameter Missing"
      )
    ));
  }
}
?>
