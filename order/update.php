<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/order.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare order object
$order = new Order($db);

// get id of order to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of order to be edited
$order->id = $data->id;

// set order property values
$order->insurance = $data->insurance;
$order->clinic = $data->clinic;
$order->patient_id = $data->patient_id;
$order->oot = $data->oot;

// update the order
if($order->update()){
    echo '{';
        echo '"message": "Order was updated."';
    echo '}';
}

// if unable to update the order, tell the user
else{
    echo '{';
        echo '"message": "Unable to update order."';
    echo '}';
}
?>
