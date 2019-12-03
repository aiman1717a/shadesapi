<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/productservices.php');
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
		$validation = false;
		$ProductServices = new Services\ProductServices();
		if(isset($_GET['product_id']) && !is_null($_GET['product_id']) && trim($_GET['product_id']) != ""){
			$validation =  true;
		}

		if($validation === true){
			$json_obj = $ProductServices->getProductById($_GET['product_id']);
			echo json_encode($json_obj);
		} else {
			echo json_encode(array(
	      "request" => "Get Products By Id",
	      "success" => false,
	      "message"=> "Failed!! Try Again!!",
	      "time" => date('d-m-Y', time()),
	      "request_error" => array(
	        "code" => "RQ001",
	        "message" => "Parameter Missing"
	      )
	    ));
		}
}
?>
