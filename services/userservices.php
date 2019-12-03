<?php
namespace Services;
use Repository;

class UserServices
{
  private $UserRepository;
  function __construct()
  {
    global $UserRepository;
    include('../repository/userrepository.php');
    $UserRepository = new Repository\UserRepository();
  }
  public function register($user_name, $user_email, $user_password){
    global $UserRepository;

    $json_obj = $UserRepository->register($user_name, $user_email, $user_password);
    if($json_obj["success"]){
      return array(
        "request" => "User Registration",
        "success" => true,
        "message" => "Login Successful",
        "time" => date('d-m-Y', time()),
        "data" => $json_obj["data"]
      );
    } else {
      return array(
        "request" => "User Registration",
        "success" => false,
        "message" => "Login Failed!! Try Again!!",
        "time" => date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
  public function login($email, $pass){
    global $UserRepository;

    $json_obj = $UserRepository->login($email, $pass);
    if($json_obj["success"]){
      return array(
        "request" => "Login",
        "success" => true,
        "message" => "Login Successful",
        "time" => date('d-m-Y', time()),
        "data" => $json_obj["data"]
      );
    } else {
      return array(
        "request" => "Login",
        "success" => false,
        "message" => "Login Failed!! Try Again!!",
        "time" => date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
  public function getUser($user_id){
    global $UserRepository;

    $json_obj = $UserRepository->getUser($user_id);
    if($json_obj["success"]){
        return array(
          "request" => "Get User",
          "success"=> true,
          "message"=> "User Selected Successfully",
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Get User",
        "success"=> false,
        "message"=> "Profile Selection Failed",
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
  public function updateUserName($user_id, $user_name){
    global $UserRepository;
    $response = $UserRepository->checkUserNameAvailable($user_name);
    if($response["available"]){
      $json_obj = $UserRepository->updateUserName($user_id, $user_name);
      if($json_obj["success"]){
          return array(
            "request" => "User Name Update",
            "success"=> true,
            "message"=> "User Name Updated Successfully",
            "time"=> date('d-m-Y', time()),
            "data" => $json_obj["data"]
          );
      } else if(!$json_obj["success"]){
        return array(
          "request" => "User Name Update",
          "success"=> false,
          "message"=> "User Name Update Failed!! Try Again!!",
          "time"=> date('d-m-Y', time()),
          "status" => $json_obj["status"]
        );
      }
    } else {
      return array(
        "request" => "User Name Update",
        "success"=> false,
        "message"=> "User Name is already used in an Account!!",
        "time"=> date('d-m-Y', time())
      );
    }

  }
  public function updateUserEmail($user_id, $user_email){
    global $UserRepository;
    $response = $UserRepository->checkEmailAvailable($user_email);

    if($response["available"]){
      $json_obj = $UserRepository->updateEmail($user_id, $user_email);
      if($json_obj["success"]){
          return array(
            "request" => "User Email Update",
            "success"=> true,
            "message"=> "Email Updated Successfully",
            "time"=> date('d-m-Y', time()),
            "data" => $json_obj["data"]
          );
      } else {
        return array(
          "request" => "User Email Update",
          "success"=> false,
          "message"=> "Email Update Failed!! Try Again!!",
          "time"=> date('d-m-Y', time()),
          "status" => $json_obj["status"]
        );
      }
    }else{
      return array(
        "request" => "User Email Update",
        "success"=> false,
        "message"=> "Email is already used in an Account!!",
        "time"=> date('d-m-Y', time())
      );
    }
  }
  public function updateUserPassword($user_id, $password){
    global $UserRepository;

    $json_obj = $UserRepository->updatePassword($user_id, $password);
    if($json_obj["success"]){
        return array(
          "request" => "profileAddressUpdate",
          "success"=> true,
          "message"=> "Password Updated Successfully",
          "time"=> date('d-m-Y', time()),
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "profileAddressUpdate",
        "success"=> false,
        "message"=> "Password Update Failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
}
?>
