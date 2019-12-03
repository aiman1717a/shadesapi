<?php
namespace Services;
use Repository;

class ProfileServices
{
  private $UserRepository;
  function __construct()
  {
    global $ProfileRepository;
    include('../repository/profilerepository.php');
    $ProfileRepository = new Repository\ProfileRepository();
  }

  public function getProfile($user_id){
    global $ProfileRepository;

    $json_obj = $ProfileRepository->getProfile($user_id);
    if($json_obj["success"]){
        return array(
          "request" => "profile",
          "success"=> true,
          "message"=> "Profile Selected Successfully",
          "message"=> null,
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "profile",
        "success"=> false,
        "message"=> "Profile Selection Failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
  public function updateProfileFirstName($user_id, $first_name){
    global $ProfileRepository;

    $json_obj = $ProfileRepository->updateFirstName($user_id, $first_name);
    if($json_obj["success"]){
        return array(
          "request" => "Profile First Name Update",
          "success"=> true,
          "message"=> "Profile First Name Updated Successfully",
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Profile First Name Update",
        "success"=> false,
        "message"=> "Profile First Name Update failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
  public function updateProfileLastName($user_id, $last_name){
    global $ProfileRepository;

    $json_obj = $ProfileRepository->updateLastName($user_id, $last_name);
    if($json_obj["success"]){
        return array(
          "request" => "Profile Last Name Update",
          "success"=> true,
          "message"=> "Profile Last Name Updated Successfully",
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Profile Last Name Update",
        "success"=> false,
        "message"=> "Profile Last Name Update failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
  public function updateProfileAddress($user_id, $address){
    global $ProfileRepository;

    $json_obj = $ProfileRepository->updateAddress($user_id, $address);
    if($json_obj["success"]){
        return array(
          "request" => "Profile Address Update",
          "message"=> "Profile Address Updated Successfully",
          "success"=> true,
          "time"=> date('d-m-Y', time()),
          "data" => $json_obj["data"]
        );
    } else if(!$json_obj["success"]){
      return array(
        "request" => "Profile Address Update",
        "success"=> false,
        "message"=> "Profile Address Update failed!! Try Again!!",
        "time"=> date('d-m-Y', time()),
        "status" => $json_obj["status"]
      );
    }
  }
}
?>
