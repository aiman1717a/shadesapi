<?php
namespace Repository;
include_once('../repository/repository.php');

class ProfileRepository extends Repository
{

  function __construct()
  {
    parent::__construct();
  }

  public function getProfile($user_id){
    global $mysqli;
		global $user;

    global $database;
    global $tbl_profile;
    $query = "SELECT `user_id`, `profile_first_name`, `profile_last_name`, `profile_address` FROM ".$database.".".$tbl_profile." WHERE user_id = ?;";
  	$stmt = $mysqli->prepare($query);
  	$stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($user_id, $first_name, $last_name, $address);
    if($count > 0)
    {
      while ($stmt->fetch()) {
        $row = array(
            "user_id" => $user_id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "address" => $address
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
          "code"=>"PR001",
          "description"=>"Profile Not Found in the database"
        )
      );
    }
  }
  public function updateFirstName($user_id, $first_name){
    global $mysqli;
		global $user;

    global $database;
    global $tbl_profile;
    $query = "UPDATE ".$database.".".$tbl_profile." SET `profile_first_name` = ? WHERE `user_id` = ?;";
  	$stmt = $mysqli->prepare($query);
  	$stmt->bind_param('si', $first_name, $user_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting firstname
      //////////////////////
      $query = "SELECT `user_id`, `profile_first_name` FROM ".$database.".".$tbl_profile." WHERE user_id = ?;";
    	$stmt = $mysqli->prepare($query);
    	$stmt->bind_param('i', $user_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($user_id, $first_name);
      if($count > 0){
          return array(
              "success" => true,
              "data" => array(
                  "user_id" => $user_id,
                  "first_name" => $first_name
                )
          );
      } else{
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"PR001",
            "description"=>"Profile Not Found in the database"
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
          "description"=>"Unexpected Error Occured"
        )
      );
    }
  }
  public function updateLastName($user_id, $last_name){
    global $mysqli;
		global $user;

    global $database;
    global $tbl_profile;
    $query = "UPDATE ".$database.".".$tbl_profile." SET `profile_last_name` = ? WHERE `user_id` = ?;";
  	$stmt = $mysqli->prepare($query);
  	$stmt->bind_param('si', $last_name, $user_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting lastname
      //////////////////////
      $query = "SELECT `user_id`, `profile_last_name` FROM ".$database.".".$tbl_profile." WHERE user_id = ?;";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $user_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($user_id, $last_name);
      if($count > 0){
          return array(
              "success" => true,
              "data" => array(
                  "user_id" => $user_id,
                  "last_name" => $last_name
                )
          );
      } else{
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"PR001",
            "description"=>"Profile Not Found in the database"
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
          "description"=>"Unexpected Error Occured"
        )
      );
    }
  }
  public function updateAddress($user_id, $address){
    global $mysqli;
		global $user;

    global $database;
    global $tbl_profile;
    $query = "UPDATE ".$database.".".$tbl_profile." SET `profile_address` = ? WHERE `user_id` = ?;";
  	$stmt = $mysqli->prepare($query);
  	$stmt->bind_param('si', $address, $user_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting address
      //////////////////////
      $query = "SELECT `user_id`, `profile_address` FROM ".$database.".".$tbl_profile." WHERE user_id = ?;";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $user_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($user_id, $address);
      if($count > 0){
          return array(
              "success" => true,
              "data" => array(
                  "user_id" => $user_id,
                  "address" => $address
                )
          );
      } else{
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"PR001",
            "description"=>"Profile Not Found in the database"
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
          "description"=>"Unexpected Error Occured"
        )
      );
    }
  }
}
?>
