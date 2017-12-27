<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare patient object
$patient = new Patient($db);

// set ID property of patient to be edited
$patient->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of patient to be edited
$patient->readOne();

// create array
$patient_arr = array(
    "id" =>  $patient->id,
    "last_name" => $patient->last_name,
    "first_name" => $patient->first_name,
    "phone" => $patient->phone,
    "address_1" => $patient->address_1,
    "address_2" => $patient->address_2,
    "city" => $patient->city,
    "st" => $patient->st,
    "zip" => $patient->zip,
    "bt_id" => $patient->bt_id,
    "ins_1" => $patient->ins_1,
    "ins_2" => $patient->ins_2,
    "ins_3" => $patient->ins_3,
    "created" => $patient->created

);

// make it json format
print_r(json_encode($patient_arr));
?>
