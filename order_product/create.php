<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate order object
include_once '../objects/order_product.php';

$database = new Database();
$db = $database->getConnection();

$order_product = new OrderProduct($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

if($data->op1_1 == false) { $data->op1_1 = "0"; }
if($data->op1_2 == false) { $data->op1_2 = "0"; }
if($data->op1_3 == false) { $data->op1_3 = "0"; }
if($data->op1_4 == false) { $data->op1_4 = "0"; }
if($data->op1_5 == false) { $data->op1_5 = "0"; }
if($data->op2_1 == false) { $data->op2_1 = "0"; }
if($data->op2_2 == false) { $data->op2_2 = "0"; }
if($data->op2_3 == false) { $data->op2_3 = "0"; }

// set order property values
$order_product->product_id = $data->product_id;
$order_product->order_id = $data->order_id;
$order_product->description = $data->description;
$order_product->op1_1 = $data->op1_1;
$order_product->op1_1_dt = $data->op1_1_dt;
$order_product->op1_2 = $data->op1_2;
$order_product->op1_2_dt = $data->op1_2_dt;
$order_product->op1_3 = $data->op1_3;
$order_product->op1_3_dt = $data->op1_3_dt;
$order_product->op1_4 = $data->op1_4;
$order_product->op1_4_dt = $data->op1_4_dt;
$order_product->op1_5 = $data->op1_5;
$order_product->op1_5_dt = $data->op1_5_dt;
$order_product->op2_1 = $data->op2_1;
$order_product->op2_1_dt = $data->op2_1_dt;
$order_product->op2_2 = $data->op2_2;
$order_product->op2_2_dt = $data->op2_2_dt;
$order_product->op2_3 = $data->op2_3;
$order_product->op2_3_dt = $data->op2_3_dt;
$order_product->rush = $data->rush;
$order_product->exchange = $data->exchange;
$order_product->return = $data->return;
$order_product->status = $data->status;


// create the order
if($order_product->create()){
    echo '{';
        echo '"message": "Order product was created."';
    echo '}';
}

// if unable to create the order, tell the user
else{
    echo '{';
        echo '"message": "Unable to create order product."';
    echo '}';
}
?>
