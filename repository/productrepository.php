<?php
namespace Repository;
include_once('../repository/repository.php');

class ProductRepository extends Repository
{
    function __construct()
    {
        parent::__construct();
    }

    public function getProducts(){
        global $mysqli;
        global $data;

        global $database;
        global $tbl_product;

        $query = "SELECT `product_id`, `product_name`, `product_number`, `brand_id`, `product_price`, `product_qty`, `product_image` FROM " . $database . "." . $tbl_product;
        $stmt  = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->bind_result($product_id, $product_name, $product_number, $brand_id, $product_price, $product_qty, $product_image);
        if ($count > 0) {
            while ($stmt->fetch()) {
                $row = array(
                    "product_id" => $product_id,
                    "product_name" => $product_name,
                    "product_number" => $product_number,
                    "brand_id" => $brand_id,
                    "product_price" => $product_price,
                    "product_qty" => $product_qty,
                    "product_image" => $product_image
                );
                $data[] = $row;
            }
            return array(
                "success" => true,
                "data" => $data
            );
        } else {
            return array(
                "success" => false,
                "status"=> array(
                  "mysql_code"=>$mysqli->connect_errno,
                  "code"=>"PRR001",
                  "description"=>"Product Not Found in the database"
                )
            );
        }
    }
    public function getProductById($product_id){
        global $mysqli;

        global $database;
        global $tbl_product;

        $query = "SELECT `product_id`, `product_name`, `product_number`, `brand_id`, `product_price`, `product_qty`, `product_image` FROM " . $database . "." . $tbl_product. " WHERE `product_id`=?";
        $stmt  = $mysqli->prepare($query);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->bind_result($product_id, $product_name, $product_number, $brand_id, $product_price, $product_qty, $product_image);
        $stmt->fetch();
        if ($count > 0) {
            return array(
                "success" => true,
                "data" => array(
                    "product_id" => $product_id,
                    "product_name" => $product_name,
                    "product_number" => $product_number,
                    "brand_id" => $brand_id,
                    "product_price" => $product_price,
                    "product_qty" => $product_qty,
                    "product_image" => $product_image
                )
            );
        } else {
            return array(
                "success" => false,
                "status"=> array(
                  "mysql_code"=>$mysqli->connect_errno,
                  "code"=>"PRR001",
                  "description"=>"Product Not Found in the database"
                )
            );
        }
    }
    public function getProductsByName($product_name){
        global $mysqli;

        global $database;
        global $tbl_product;

        $query = "SELECT `product_id`, `product_name`, `product_number`, `product_price`, `product_image` FROM " . $database . "." . $tbl_product . " WHERE product_name = ?";
        $stmt  = $mysqli->prepare($query);
        $stmt->bind_param('s', $product_name);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->bind_result($product_id, $product_name, $product_number, $product_price, $product_image);
        if ($count > 0) {
            while ($stmt->fetch()) {
                $row = array(
                    "product_id" => $product_id,
                    "product_name" => $product_name,
                    "product_number" => $product_number,
                    "product_price" => $product_price,
                    "product_image" => $product_image
                );
                $data[] = $row;
            }
            return array(
                "success" => true,
                "data" => $data
            );
        } else {
            return array(
                "success" => false,
                "status"=> array(
                  "mysql_code"=>$mysqli->connect_errno,
                  "code"=>"PRR001",
                  "description"=>"Product Not Found in the database"
                )
            );
        }
    }
    public function getProductsByBrand($brand_name){
        global $mysqli;

        global $database;
        global $tbl_product;
        global $tbl_brands;

        $query = "SELECT `product_id`, `product_name`, `product_number`, `product_price`, `product_image` FROM " . $database . "." . $tbl_product . " WHERE `brand_id` IN (SELECT `brand_id` FROM  " . $database . "." . $tbl_brands . " WHERE brand_name = ?)";
        $stmt  = $mysqli->prepare($query);
        $stmt->bind_param('s', $brand_name);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->bind_result($product_id, $product_name, $product_number, $product_price, $product_image);
        if ($count > 0) {
            while ($stmt->fetch()) {
                $row = array(
                    "product_id" => $product_id,
                    "product_name" => $product_name,
                    "product_number" => $product_number,
                    "product_price" => $product_price,
                    "product_image" => $product_image
                );
                $data[] = $row;
            }
            return array(
                "success" => true,
                "data" => $data
            );
        } else {
            return array(
                "success" => false,
                "status"=> array(
                  "mysql_code"=>$mysqli->connect_errno,
                  "code"=>"PRR001",
                  "description"=>"Product Not Found in the database"
                )
            );
        }
    }
}
?>
