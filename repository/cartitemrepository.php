<?php
namespace Repository;
include_once('../repository/repository.php');

class CartItemRepository extends Repository
{
  public $data = array();
  function __construct()
  {
    parent::__construct();
  }
  public function addCartItem($cart_id, $product_id, $cart_item_quantity, $cart_item_price){
    global $mysqli;

    global $database;
    global $tbl_cart_item;
    $query = "INSERT INTO " . $database . "." . $tbl_cart_item . " (`cart_id`, `product_id`, `cart_item_quantity`, `cart_item_price`) VALUES (?, ?, ?, ?);";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iiii', $cart_id, $product_id, $cart_item_quantity, $cart_item_price);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      return array(
          "success" => true,
          "data" => array(
            "cart_item_id"=>$mysqli->insert_id
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
  public function getCartItemByCartId($cart_id){
    global $mysqli;
    global $user;
    global $data;

    global $database;
    global $tbl_cart_item;
    $query = "SELECT `cart_item_id`, `product_id`, `cart_item_quantity`, `cart_item_price` FROM " . $database . "." . $tbl_cart_item . " WHERE cart_id=?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $cart_id);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($cart_item_id, $product_id, $cart_item_quantity, $cart_item_price);
    if ($count > 0) {
      while ($stmt->fetch()) {
        $row = array(
          "cart_item_id" => $cart_item_id,
          "product_id" => $product_id,
          "cart_item_quantity" => $cart_item_quantity,
          "cart_item_price" => $cart_item_price
        );
        $data[] = $row;
      }
      return array(
          "success" => true,
          "data" => $data
      );
    } else {
      return array(
        "success" => "false",
        "time" => date('d-m-Y', time()),
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"CIR001",
          "description"=>"Cart Item Not Found in the database"
        )
      );
    }
  }
  public function updateCartItemQty($cart_item_id, $cart_item_quantity){
    global $mysqli;

    global $database;
    global $tbl_cart_item;
    $query = "UPDATE ".$database.".".$tbl_cart_item." SET `cart_item_quantity` = ? WHERE `cart_item_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ii', $cart_item_quantity, $cart_item_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting firstname
      //////////////////////
      $query = "SELECT `cart_item_id`, `cart_item_quantity` FROM ".$database.".".$tbl_cart_item." WHERE `cart_item_id` = ?;";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $cart_item_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($cart_item_id, $cart_item_quantity);
      if($count > 0){
          return array(
              "success" => true,
              "data" => array(
                  "cart_item_id" => $cart_item_id,
                  "cart_item_quantity" => $cart_item_quantity
                )
          );
      } else{
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"CIR001",
            "description"=>"Cart Item Not Found in the database"
          )
        );
      }
      //////////////////////
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->error,
          "code"=>"G001",
          "description"=>"Unexpected Error Occured"
        )
      );
    }
  }
  public function deleteCartItemByItemId($cart_item_id){
    global $mysqli;

    global $database;
    global $tbl_cart_item;
    $query = "DELETE FROM " . $database . "." . $tbl_cart_item . " WHERE cart_item_id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $cart_item_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      return array(
          "success" => true
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
