<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/order_product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare order object
$order_product = new OrderProduct($db);

// set ID property of order to be edited
$order_product->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of order to be edited
$order_product->readOne();

// create array
$order_product_arr = array(
    "id" => $order_product->$id,
    "product_id" => $order_product->$product_id,
    "order_id" => $order_product->$order_id,
    "description" => $order_product->$description,
    "op1_1" => $order_product->$op1_1,
    "op1_1_dt" => $order_product->$op1_1_dt,
    "op1_2" => $order_product->$op1_2,
    "op1_2_dt" => $order_product->$op1_2_dt,
    "op1_3" => $order_product->$op1_3,
    "op1_3_dt" => $order_product->$op1_3_dt,
    "op1_4" => $order_product->$op1_4,
    "op1_4_dt" => $order_product->$op1_4_dt,
    "op1_5" => $order_product->$op1_5,
    "op1_5_dt" => $order_product->$op1_5_dt,
    "op2_1" => $order_product->$op2_1,
    "op2_1_dt" => $order_product->$op2_1_dt,
    "op2_2" => $order_product->$op2_2,
    "op2_2_dt" => $order_product->$op2_2_dt,
    "op2_3" => $order_product->$op2_3,
    "op2_3_dt" => $order_product->$op2_3_dt,
    "rush" => $order_product->$rush,
    "exchange" => $order_product->$exchange,
    "return" => $order_product->$return,
    "status" => $order_product->$status
);

// make it json format
print_r(json_encode($order_product_arr));
?>
