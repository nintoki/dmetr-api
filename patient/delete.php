<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object file
include_once '../config/database.php';
include_once '../objects/patient.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare patient object
$patient = new Patient($db);

// get patient id
$data = json_decode(file_get_contents("php://input"));

// set patient id to be deleted
$patient->id = $data->id;

// delete the patient
if($patient->delete()){
    echo '{';
        echo '"message": "Patient was deleted."';
    echo '}';
}

// if unable to delete the patient
else{
    echo '{';
        echo '"message": "Unable to delete patient."';
    echo '}';
}
?>
