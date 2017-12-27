<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare patient object
$patient = new Patient($db);

// get id of patient to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of patient to be edited
$patient->id = $data->id;

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

// update the patient
if($patient->update()){
    echo '{';
        echo '"message": "Patient was updated."';
    echo '}';
}

// if unable to update the patient, tell the user
else{
    echo '{';
        echo '"message": "Unable to update patient."';
    echo '}';
}
?>
