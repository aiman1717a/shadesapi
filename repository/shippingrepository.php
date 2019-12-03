<?php
namespace Repository;
include_once('../repository/repository.php');

class ShippingRepository extends Repository
{

  function __construct()
  {
    parent::__construct();
  }

  public function getShippingByUserId($user_id){
    global $mysqli;
		global $user;

    global $database;
    global $tbl_shipping;
    $query = "SELECT `shipping_id`, `user_id`, `shipping_place`, `shipping_street`, `shipping_city`, `shipping_country`, `shipping_zip` FROM ".$database.".".$tbl_shipping." WHERE user_id = ?;";
  	$stmt = $mysqli->prepare($query);
  	$stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($shipping_id, $user_id, $shipping_place, $shipping_street, $shipping_city, $shipping_country, $shipping_zip);
    if($count > 0)
    {
      while ($stmt->fetch()) {
        $row = array(
            "shipping_id" => $shipping_id,
            "user_id" => $user_id,
            "shipping_place" => $shipping_place,
            "shipping_street" => $shipping_street,
            "shipping_city" => $shipping_city,
            "shipping_country" => $shipping_country,
            "shipping_zip" => $shipping_zip
        );
        $data[] = $row;
      }
      return array(
          "success" => true,
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

  /**
   *
   * Use: Update Shipping Place
   *
   */
  public function updateShippingPlace($shipping_id, $shipping_place){
    global $mysqli;

    global $database;
    global $tbl_shipping;
    $query = "UPDATE ".$database.".".$tbl_shipping." SET `shipping_place` = ? WHERE `shipping_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $shipping_place, $shipping_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting shiping_place
      //////////////////////
      $query = "SELECT `shipping_id`, `shipping_place` FROM ".$database.".".$tbl_shipping." WHERE shipping_id = ?;";
    	$stmt = $mysqli->prepare($query);
    	$stmt->bind_param('i', $shipping_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($shipping_id, $shipping_place);
      if($count > 0){
        return array(
          "success" => true,
          "data" => array(
              "shipping_id" => $shipping_id,
              "shipping_place" => $shipping_place
            )
          );
      } else {
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"SR001",
            "description"=>"Shipping Details Not Found in the database"
          )
        );
      }
      //////////////////////
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"G001",
          "description"=>"Unexpected Error Happened"
        )
      );
    }
  }

  /**
   *
   * Use: Update Shipping Street
   *
   */
  public function updateShippingStreet($shipping_id, $shipping_street){
    global $mysqli;

    global $database;
    global $tbl_shipping;
    $query = "UPDATE ".$database.".".$tbl_shipping." SET `shipping_street` = ? WHERE `shipping_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $shipping_street, $shipping_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting shiping_place
      //////////////////////
      $query = "SELECT `shipping_id`, `shipping_street` FROM ".$database.".".$tbl_shipping." WHERE shipping_id = ?;";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $shipping_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($shipping_id, $shipping_street);
      if($count > 0){
        return array(
          "success" => true,
          "data" => array(
              "shipping_id" => $shipping_id,
              "shipping_street" => $shipping_street
            )
          );
      } else {
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"SR001",
            "description"=>"Shipping Details Not Found in the database"
          )
        );
      }
      //////////////////////
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"G001",
          "description"=>"Unexpected Error Happened"
        )
      );
    }
  }

  /**
   *
   * Use: Update Shipping City
   *
   */
  public function updateShippingCity($shipping_id, $shipping_city){
    global $mysqli;

    global $database;
    global $tbl_shipping;
    $query = "UPDATE ".$database.".".$tbl_shipping." SET `shipping_city` = ? WHERE `shipping_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $shipping_city, $shipping_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting shiping_place
      //////////////////////
      $query = "SELECT `shipping_id`, `shipping_city` FROM ".$database.".".$tbl_shipping." WHERE shipping_id = ?;";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $shipping_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($shipping_id, $shipping_city);
      if($count > 0){
        return array(
          "success" => true,
          "data" => array(
              "shipping_id" => $shipping_id,
              "shipping_city" => $shipping_city
            )
          );
      } else {
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"SR001",
            "description"=>"Shipping Details Not Found in the database"
          )
        );
      }
      //////////////////////
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"G001",
          "description"=>"Unexpected Error Happened"
        )
      );
    }
  }

  /**
   *
   * Use: Update Shipping Country
   *
   */
  public function updateShippingCountry($shipping_id, $shipping_country){
    global $mysqli;

    global $database;
    global $tbl_shipping;
    $query = "UPDATE ".$database.".".$tbl_shipping." SET `shipping_country` = ? WHERE `shipping_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $shipping_country, $shipping_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting shiping_place
      //////////////////////
      $query = "SELECT `shipping_id`, `shipping_country` FROM ".$database.".".$tbl_shipping." WHERE shipping_id = ?;";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $shipping_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($shipping_id, $shipping_country);
      if($count > 0){
        return array(
          "success" => true,
          "data" => array(
              "shipping_id" => $shipping_id,
              "shipping_country" => $shipping_country
            )
          );
      } else {
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"SR001",
            "description"=>"Shipping Details Not Found in the database"
          )
        );
      }
      //////////////////////
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"G001",
          "description"=>"Unexpected Error Happened"
        )
      );
    }
  }

  /**
   *
   * Use: Update Shipping Zip
   *
   */
  public function updateShippingZip($shipping_id, $shipping_zip){
    global $mysqli;

    global $database;
    global $tbl_shipping;
    $query = "UPDATE ".$database.".".$tbl_shipping." SET `shipping_zip` = ? WHERE `shipping_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $shipping_zip, $shipping_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting shiping_place
      //////////////////////
      $query = "SELECT `shipping_id`, `shipping_zip` FROM ".$database.".".$tbl_shipping." WHERE shipping_id = ?;";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $shipping_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($shipping_id, $shipping_zip);
      if($count > 0){
        return array(
          "success" => true,
          "data" => array(
              "shipping_id" => $shipping_id,
              "shipping_zip" => $shipping_zip
            )
          );
      } else {
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"SR001",
            "description"=>"Shipping Details Not Found in the database"
          )
        );
      }
      //////////////////////
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "mysql_code"=>$mysqli->connect_errno,
          "code"=>"G001",
          "description"=>"Unexpected Error Happened"
        )
      );
    }
  }

}
?>
