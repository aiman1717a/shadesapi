<?php
namespace Services;
use Repository;

class BrandServices
{
  private $BrandRepository;

  function __construct()
  {
    global $BrandRepository;
    include('../repository/brandrepository.php');
    $BrandRepository = new Repository\BrandRepository();
  }

  public function getBrands(){
    global $BrandRepository;

    $json_obj = $BrandRepository->getBrands();
    if($json_obj["success"] === true){
        return array(
          "request" => "Get Brands",
          "success"=> true,
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else {
      return array(
        "request" => "Get Brands",
        "success"=> false,
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
  public function getBrandById($brand_id){
    global $BrandRepository;

    $json_obj = $BrandRepository->getBrandById($brand_id);
    if($json_obj["success"] === true){
        return array(
          "request" => "Get Brands By Id",
          "success"=> true,
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else {
      return array(
        "request" => "Get Brands By Id",
        "success"=> false,
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
  public function getBrandByName($brand_name){
    global $BrandRepository;

    $json_obj = $BrandRepository->getBrandByName($brand_name);
    if($json_obj["success"] === true){
        return array(
          "request" => "Get Brands By Name",
          "success"=> true,
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else {
      return array(
        "request" => "Get Brands By Name",
        "success"=> false,
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }

}

?>
