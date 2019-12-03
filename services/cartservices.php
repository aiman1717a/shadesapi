<?php
namespace Services;
use Repository;

class CartServices
{
    function __construct()
    {
        global $CartRepository;
        include('../repository/cartrepository.php');
        $CartRepository = new Repository\CartRepository();

        global $CartItemRepository;
        include('../repository/cartitemrepository.php');
        $CartItemRepository = new Repository\CartItemRepository();

        global $ProductRepository;
        include('../repository/productrepository.php');
        $ProductRepository = new Repository\ProductRepository();
    }
    public function addCartItem($cart_id, $product_id, $cart_item_quantity, $cart_item_price){
      global $CartItemRepository;
      $json_obj = $CartItemRepository->addCartItem($cart_id, $product_id, $cart_item_quantity, $cart_item_price);
      if($json_obj["success"] === true){
          return array(
            "request" => "Cart Item Adding",
            "success"=> true,
            "message"=> "Cart Item Added Successfully",
            "time"=> date('d-m-Y', time()),
            "data" => $json_obj["data"]
          );
      } else {
        return array(
          "request" => "Cart Item Adding",
          "success"=> false,
          "message"=> "Cart Item Adding Failed!! Try Again!!",
          "time"=> date('d-m-Y', time()),
          "status" => $json_obj["status"]
        );
      }
    }
    public function getCartByUserId($user_id){
        global $CartRepository;
        global $CartItemRepository;
        global $ProductRepository;

        //Cart
        $cart = $CartRepository->getCartByUserId($user_id);
        if ($cart["success"] === true) {

          //Cart Item
          $cart_items = $CartItemRepository->getCartItemByCartId($cart['data']['cart_id']);
          if($cart_items["success"] === true){

            //new cart item to be done initialized
            $new_cart_item = array();

            //taking array of cart items
            $cart_item = $cart_items["data"];
            for ($j=0; $j < count($cart_item); $j++) {
              //getting a product by product_id
              $product = $ProductRepository->getProductById($cart_item[$j]['product_id']);
              if($product["success"] === true){
                $row = array(
                  "cart_item_id" => $cart_item[$j]['cart_item_id'],
                  "product_id" => $product['data'],
                  "cart_item_quantity" => $cart_item[$j]['cart_item_quantity'],
                  "cart_item_price" => $cart_item[$j]['cart_item_price']
                );
              } else {
                $row = array(
                  "cart_item_id" => $cart_item[$j]['cart_item_id'],
                  "product_id" => null,
                  "cart_item_quantity" => $cart_item[$j]['cart_item_quantity'],
                  "cart_item_price" => $cart_item[$j]['cart_item_price']
                );
              }
              $new_cart_item[] = $row;
            }
            return array(
                "request" => "Get Cart by User Id",
                "success" => true,
                "time" => date('d-m-Y', time()),
                "cart" => array(
                    "cart_id" => $cart["data"]["cart_id"],
                    "cart_date" => $cart["data"]["cart_date"],
                    "cart_time" => $cart["data"]["cart_time"],
                    "cart_qty" => $cart["data"]["cart_qty"],
                    "cart_total" => $cart["data"]["cart_total"],
                    "cart_item"=> $new_cart_item
                )
            );
          }else{
            return array(
                "request" => "Get Cart by User Id",
                "success" => true,
                "time" => date('d-m-Y', time()),
                "cart" => $cart_items["status"]
            );
          }
        } else {
            return array(
                "request" => "Get Cart by User Id",
                "success" => false,
                "time" => date('d-m-Y', time()),
                "status" => $json_obj["status"]
            );
        }
    }
    public function getCartOnlyByUserId($user_id){
        global $CartRepository;

        //Cart
        $cart = $CartRepository->getCartByUserId($user_id);
        if ($cart["success"] === true) {
            return array(
              "request" => "Get Cart Only by User Id",
              "success"=> true,
              "time"=> date('d-m-Y', time()),
              "data" => $cart["data"]
            );
        } else {
            return array(
                "request" => "Get Cart Only by User Id",
                "success" => false,
                "time" => date('d-m-Y', time()),
                "status" => $cart["status"]
            );
        }
    }
    public function updateCartItemQty($cart_item_id, $cart_item_quantity){
      global $CartItemRepository;
      $json_obj = $CartItemRepository->updateCartItemQty($cart_item_id, $cart_item_quantity);
      if($json_obj["success"]){
          return array(
            "request" => "Cart Item Qty Update",
            "success"=> true,
            "message"=> "Cart Item Quantity Updated Successfully",
            "time"=> date('d-m-Y', time()),
            "data" => $json_obj["data"]
          );
      } else if(!$json_obj["success"]){
        return array(
          "request" => "Cart Item Qty Update",
          "success"=> false,
          "message"=> "Cart Item Quantity Update Failed!! Try Again!!",
          "time"=> date('d-m-Y', time()),
          "status" => $json_obj["status"]
        );
      }
    }
    public function deleteCartItemByItemId($cart_item_id){
      global $CartItemRepository;
      $json_obj = $CartItemRepository->deleteCartItemByItemId($cart_item_id);
      if($json_obj["success"]){
          return array(
            "request" => "Cart Item Delete",
            "success"=> true,
            "message"=> "Cart Item Deleted Successfully",
            "time"=> date('d-m-Y', time())
          );
      } else if(!$json_obj["success"]){
        return array(
          "request" => "Cart Item Qty Delete",
          "success"=> false,
          "message"=> "Cart Item Quantity Deletion Failed!! Try Again!!",
          "time"=> date('d-m-Y', time()),
          "status" => $json_obj["status"]
        );
      }
    }
}
?>
