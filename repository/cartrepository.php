<?php
namespace Repository;
include_once('../repository/repository.php');

class CartRepository extends Repository
{
  function __construct()
  {
    parent::__construct();
  }
  public function getCartByUserId($user_id){
    global $mysqli;
    global $user;

    global $database;
    global $tbl_cart;
    $query = "SELECT `cart_id`, `cart_date`, `cart_time`, `cart_qty`, `cart_total` FROM " . $database . "." . $tbl_cart . " WHERE user_id=?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($cart_id, $cart_date, $cart_time, $cart_qty, $cart_total);
    if ($count > 0) {
      while ($stmt->fetch()) {
        return array(
          "success" => true,
          "time" => date('d-m-Y', time()),
          "data" => array(
              "cart_id" => $cart_id,
              "cart_date" => $cart_date,
              "cart_time" => $cart_time,
              "cart_qty" => $cart_qty,
              "cart_total" => $cart_total
            )
          );
        }
      } else {
        return array(
          "success" => "false",
          "time" => date('d-m-Y', time()),
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"CR001",
            "description"=>"Cart Not Found in the database"
          )
        );
      }
    }
}
?>
