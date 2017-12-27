<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate patient object
include_once '../objects/patient.php';

$database = new Database();
$db = $database->getConnection();

$patient = new Patient($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set patient property values
$patient->last_name = $data->last_name;
$patient->first_name = $data->first_name;
$patient->phone = $data->phone;
$patient->address_1 = $data->address_1;
$patient->address_2 = $data->address_2;
$patient->city = $data->city;
$patient->st = $data->st;
$patient->zip = $data->zip;
$patient->bt_id = $data->bt_id;
$patient->ins_1 = $data->ins_1;
$patient->ins_2 = $data->ins_2;
$patient->ins_3 = $data->ins_3;
$patient->created = date('Y-m-d H:i:s');

// create the patient
if($patient->create()){
    echo '{';
        echo '"message": "Patient was created."';
    echo '}';
}

// if unable to create the patient, tell the user
else{
    echo '{';
        echo '"message": "Unable to create patient."';
    echo '}';
}
?>
