<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/profileservices.php');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	  if(isset($_POST['user_id']) && !is_null($_POST['user_id']) && trim($_POST['user_id']) != ""){
			$ProfileServices = new Services\ProfileServices();
			$json_obj = $ProfileServices->getProfile($_POST['user_id']);
	    echo json_encode($json_obj);
		}else{
	    echo json_encode(array(
	      "request" => "Get Profile",
	      "success" => false,
				"message"=> "Profile details could not be loaded",
	      "time" => date('d-m-Y', time()),
	      "request_error" => array(
					"code" => "RQ002",
					"message" => "User ID Parameter Missing"
	      )
	    ));
	  }
}
?>
