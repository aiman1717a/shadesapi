<?php
namespace Services;
use Repository;

class ProductServices
{
    function __construct()
    {
        global $ProductRepository;
        include('../repository/productrepository.php');
        $ProductRepository = new Repository\ProductRepository();
    }

    public function getProducts(){
        global $ProductRepository;

        $json_obj = $ProductRepository->getProducts();
        if ($json_obj["success"]) {
            return array(
                "request" => "Products",
                "success" => true,
                "time" => date('d-m-Y', time()),
                "data" => $json_obj["data"]
            );
        } else {
            return array(
                "request" => "Products",
                "success" => false,
                "time" => date('d-m-Y', time()),
                "status" => $json_obj["status"]
            );
        }
    }
    public function getProductById($product_id){
        global $ProductRepository;

        $json_obj = $ProductRepository->getProductById($product_id);
        if ($json_obj["success"]) {
            return array(
                "request" => "Get Products By Id",
                "success" => true,
                "message"=> "Product loaded Successfully",
                "time" => date('d-m-Y', time()),
                "data" => $json_obj["data"]
            );
        } else {
            return array(
                "request" => "Products",
                "success" => false,
                "message"=> "Product loaded Failed Successfully!!",
                "time" => date('d-m-Y', time()),
                "status" => $json_obj["status"]
            );
        }
    }
    public function getProductsByName($product_name){
        global $ProductRepository;

        $json_obj = $ProductRepository->getProductsByName($product_name);
        if ($json_obj["success"]) {
            return array(
                "request" => "Get Products By Name",
                "success" => true,
                "time" => date('d-m-Y', time()),
                "data" => $json_obj["data"]
            );
        } else {
            return array(
                "request" => "Get Products By Name",
                "success" => false,
                "time" => date('d-m-Y', time()),
                "status" => $json_obj["status"]
            );
        }
    }
    public function getProductsByBrand($brand_name){
        global $ProductRepository;

        $json_obj = $ProductRepository->getProductsByBrand($brand_name);
        if ($json_obj["success"]) {

            return array(
                "request" => "Get Products By Brand",
                "success" => true,
                "time" => date('d-m-Y', time()),
                "data" => $json_obj["data"]
            );
        } else {
            return array(
                "request" => "Get Products By Brand",
                "success" => false,
                "time" => date('d-m-Y', time()),
                "status" => $json_obj["status"]
            );
        }
    }
}
?>
