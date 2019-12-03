<?php
namespace Repository;
include_once('../repository/repository.php');

class BrandRepository extends Repository
{
  function __construct()
  {
    parent::__construct();
  }

  public function getBrands(){
    global $mysqli;

    global $database;
    global $tbl_brands;
    $query = "SELECT `brand_id`, `brand_name` FROM  ". $database . "." .$tbl_brands;
  	$stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($brand_id, $brand_name);
    if($count > 0)
    {
      while ( $stmt->fetch() )
      {
        $row = array(
          "brand_id" => $brand_id,
          "brand_name" => $brand_name
        );
        $data[] = $row;
      }
      return array(
        "success"=> true,
        "data" => $data
      );
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"G001",
          "description"=>"Unexpected Error Occured"
        )
      );
    }
  }
  public function getBrandById($brand_id){
    global $mysqli;

    global $database;
    global $tbl_brands;
    $query = "SELECT `brand_id`, `brand_name` FROM ".$database.".".$tbl_brands." WHERE brand_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $brand_id);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($brand_id, $brand_name);
    $stmt->fetch();
    if($count > 0)
    {
      return array(
        "success"=> true,
        "data" => array(
          "brand_id" => $brand_id,
          "brand_name" => $brand_name
        )
      );
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"G001",
          "description"=>"Unexpected Error Occured"
        )
      );
    }
  }
  public function getBrandByName($brand_name){
    global $mysqli;

    global $database;
    global $tbl_brands;
    $query = "SELECT `brand_id`, `brand_name` FROM ".$database.".".$tbl_brands." WHERE brand_name = ?";
  	$stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $brand_name);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($brand_id, $brand_name);
    $stmt->fetch();
    if($count > 0)
    {
      return array(
        "success"=> true,
        "data" => array(
          "brand_id" => $brand_id,
          "brand_name" => $brand_name
        )
      );
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"G001",
          "description"=>"Unexpected Error Occured"
        )
      );
    }
  }
}
?>
