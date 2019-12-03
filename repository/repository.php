<?php
namespace Repository;

class Repository
{
  function __construct()
  {
    global $database;
    $database = "shades_db";

    global $tbl_user;
    $tbl_user = "tbl_user";

    global $tbl_profile;
    $tbl_profile = "tbl_profile";

    global $tbl_brands;
    $tbl_brands = "tbl_brands";

    global $tbl_product;
    $tbl_product = "tbl_product";

    global $tbl_cart;
    $tbl_cart = "tbl_cart";

    global $tbl_cart_item;
    $tbl_cart_item = "tbl_cart_item";

    global $tbl_shipping;
    $tbl_shipping = "tbl_shipping";

    require_once('../config/dbconn.php');
  }
}

?>
