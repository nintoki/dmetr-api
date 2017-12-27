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
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

if($data->oot == false) { $data->oot = "0"; }

// set order property values
$order->insurance = $data->insurance;
$order->clinic = $data->clinic;
$order->patient_id = $data->patient_id;
$order->oot = $data->oot;
$order->created = date('Y-m-d H:i:s');


// create the order
if($order->create()){
    echo '{';
        echo '"message": "Order was created."';
    echo '}';
}

// if unable to create the order, tell the user
else{
    echo '{';
        echo '"message": "Unable to create order."';
    echo '}';
}
?>
