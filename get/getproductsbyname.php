<?php
header('Content-Type: application/json; charset=utf-8');
require('../services/productservices.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['product_name']) && !is_null($_GET['product_name']) && trim($_GET['product_name']) != "") {
        $ProductServices = new Services\ProductServices();
        $json_obj = $ProductServices->getProductsByName($_GET['product_name']);
        echo json_encode($json_obj);
    } else {
      echo json_encode(array(
        "request" => "Get Products By Name",
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
