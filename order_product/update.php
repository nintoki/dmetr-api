<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/order_product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare order object
$order_product = new OrderProduct($db);

// get id of order to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of order to be edited
$order_product->id = $data->id;

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

// update the order
if($order_product->update()){
    echo '{';
        echo '"message": "Order product was updated."';
    echo '}';
}

// if unable to update the order, tell the user
else{
    echo '{';
        echo '"message": "Unable to update order product."';
    echo '}';
}
?>
