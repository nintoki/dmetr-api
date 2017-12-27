<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/order.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare order object
$order = new Order($db);

// set ID property of order to be edited
$order->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of order to be edited
$order->readOne();

// create array
$order_arr = array(
    "id" =>  $order->id,
    "clinic" => $order->clinic,
    "insurance" => $order->insurance,
    "patient_id" => $order->patient_id,
    "patient_name" => $order->patient_name,
    "oot" => $order->oot,
    "created" => $order->created

);

// make it json format
print_r(json_encode($order_arr));
?>
