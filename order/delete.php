<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object file
include_once '../config/database.php';
include_once '../objects/order.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare order object
$order = new Order($db);

// get order id
$data = json_decode(file_get_contents("php://input"));

// set order id to be deleted
$order->id = $data->id;

// delete the order
if($order->delete()){
    echo '{';
        echo '"message": "Order was deleted."';
    echo '}';
}

// if unable to delete the order
else{
    echo '{';
        echo '"message": "Unable to delete order."';
    echo '}';
}
?>
