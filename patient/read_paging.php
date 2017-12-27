<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/patient.php';

// utilities
$utilities = new Utilities();

// instantiate database and patient object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);

// query patients
$stmt = $patient->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // patients array
    $patients_arr=array();
    $patients_arr["records"]=array();
    $patients_arr["paging"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $patient_item=array(
            "id" => $id,
            "patient_name" => html_entity_decode($patient_name),
            "phone" => html_entity_decode($phone),
            "address" => html_entity_decode($address),
            "city" => html_entity_decode($city),
            "st" => html_entity_decode($st),
            "zip" => html_entity_decode($zip),
            "bt_id" => html_entity_decode($bt_id),
            "ins_1" => html_entity_decode($ins_1),
            "ins_2" => html_entity_decode($ins_2),
            "ins_3" => html_entity_decode($ins_3),
            "created" => $patient->created
        );

        array_push($patients_arr["records"], $patient_item);
    }


    // include paging
    $total_rows=$patient->count();
    $page_url="{$home_url}patient/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $patients_arr["paging"]=$paging;

    echo json_encode($patients_arr);
}

else{
    echo json_encode(
        array("message" => "No patients found.")
    );
}
?>
