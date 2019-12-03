<?php
namespace Repository;
include_once('../repository/repository.php');

class UserRepository extends Repository
{

  function __construct()
  {
    parent::__construct();
  }

  /**
  *
  * Use: Creates a User
  *
  */
  public function register($user_name, $user_email, $user_password){
    global $mysqli;

    global $database;
    global $tbl_user;
    $query = "INSERT INTO " . $database . "." . $tbl_user . " (`user_name`, `user_email`, `user_password`) VALUES (?, ?, ?);";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sss', $user_name, $user_email, $user_password);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      return array(
          "success" => true,
          "data" => array(
            "user_id"=>$mysqli->insert_id
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

  /**
  *
  * Use: Used for user login
  *
  */
  public function login($email, $password){
    global $mysqli;
		global $user;

    global $database;
    global $tbl_user;
    $query = "SELECT `user_id`, `user_email` FROM " . $database . "." .$tbl_user. " WHERE user_email=? AND user_password=?;";//SELECT QUERY
  	$stmt = $mysqli->prepare($query);//PREPARING THE MYSQLI PREPARED STATEMENT
  	$stmt->bind_param('ss', $email, $password);//BINDING PARAMETER VARIABLES TO TO VARIABLES
    $stmt->execute();//EXECUTING THE THE PREPARED STATEMENT
    $stmt->store_result();//STORING THE RESULTS
    $count = $stmt->num_rows;//CHECKING NUMBER OF ROWS AFFECTED
    $stmt->bind_result($user_id, $user_email);//ASSIGNING DATA TO VARIABLES
    $stmt->fetch();
    if($count > 0)//CHECKING NUMBER OF AFFECTED ROWS MORE THAN 0
    {
      return array(
        "success"=> true,
        "data" => array(
          "user_id" => $user_id,
          "user_email" => $user_email
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

  /**
  *
  * Use: Getting User by user_id
  *
  */
  public function getUser($user_id){
    global $mysqli;

    global $database;
    global $tbl_user;
    $query = "SELECT `user_id`, `user_name`, `user_email` FROM ".$database.".".$tbl_user." WHERE user_id = ?;";
  	$stmt = $mysqli->prepare($query);
  	$stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($user_id, $user_name, $user_email);
    if($count > 0)
    {
      while ($stmt->fetch()) {
        $row = array(
            "user_id" => $user_id,
            "user_name" => $user_name,
            "user_email" => $user_email,
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
   * Use: check wehther Email is available
   *
   */
  public function checkEmailAvailable($user_email){
    global $mysqli;

    global $database;
    global $tbl_user;

    $query = "SELECT `user_id`, `user_email` FROM ".$database.".".$tbl_user." WHERE user_email = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $user_email);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($user_id, $user_email);
    if($count > 0){
      return array(
        "available"=> false
      );
    }else{
      return array(
        "available" => true
      );
    }
  }

  /**
   *
   * Use: check wehther User Name is available
   *
   */
  public function checkUserNameAvailable($user_name){
    global $mysqli;

    global $database;
    global $tbl_user;

    $query = "SELECT `user_id`, `user_name` FROM ".$database.".".$tbl_user." WHERE user_name = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $user_name);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->bind_result($user_id, $user_name);
    if($count > 0){
      return array(
        "available"=> false
      );
    }else{
      return array(
        "available" => true
      );
    }
  }

  /**
   *
   * Use: Update User Name
   *
   */
  public function updateUserName($user_id, $user_name){
    global $mysqli;

    global $database;
    global $tbl_user;

    $query = "UPDATE ".$database.".".$tbl_user." SET `user_name` = ? WHERE `user_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $user_name, $user_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting user_name
      //////////////////////
      $query = "SELECT `user_id`, `user_name` FROM ".$database.".".$tbl_user." WHERE user_id = ?;";
    	$stmt = $mysqli->prepare($query);
    	$stmt->bind_param('i', $user_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($user_id, $user_name);
      if($count > 0){
        return array(
          "success" => true,
          "data" => array(
              "user_id" => $user_id,
              "user_name" => $user_name
            )
          );
      } else {
        return array(
          "success"=> false,
          "status"=> array(
            "mysql_code"=>$mysqli->connect_errno,
            "code"=>"UR001",
            "description"=>"User Not Found in the database"
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
   * Use: Update Email
   *
   */
  public function updateEmail($user_id, $user_email){
    global $mysqli;

    global $database;
    global $tbl_user;
    $query = "UPDATE ".$database.".".$tbl_user." SET `user_email` = ? WHERE `user_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $user_email, $user_id);
    $stmt->execute();
    $count = $mysqli->affected_rows;
    if($count > 0)
    {
      //getting user_name
      //////////////////////
      $query = "SELECT `user_id`, `user_email` FROM ".$database.".".$tbl_user." WHERE user_id = ?;";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $user_id);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      $stmt->bind_result($user_id, $user_email);
      if($count > 0){
        return array(
            "success" => true,
            "data" => array(
                "user_id" => $user_id,
                "email" => $user_email
              )
            );
      } else{
        return array(
          "success"=> false,
          "status"=> array(
            "code"=>$mysqli->connect_errno,
            "status_code"=>"UR001",
            "description"=>"User Not Found in the database"
          )
        );
      }
      //////////////////////
    } else {
      return array(
        "success"=> false,
        "status"=> array(
          "code"=>$mysqli->connect_errno,
          "status_code"=>"G001",
          "description"=>"Unexpected Error Happened"
        )
      );
    }
  }

  /**
   *
   * Use: Update Password
   *
   */
  public function updatePassword($user_id, $password){
    global $mysqli;

    global $database;
    global $tbl_user;
    $query = "UPDATE ".$database.".".$tbl_user." SET `user_password` = ? WHERE `user_id` = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $password, $user_id);
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
          "code"=>$mysqli->connect_errno,
          "status_code"=>"G001",
          "description"=>"Unexpected Error Happened"
        )
      );
    }
  }

  /**
   *
   * Use: Delete User
   *
   */
  public function deleteUser($value=''){
    // code....
  }
}
?>
