<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/order.php';

// instantiate database and order object
$database = new Database();
$db = $database->getConnection();

// initialize object
$order = new Order($db);

// query orders
$stmt = $order->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // orders array
    $orders_arr=array();
    // $orders_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $order_item=array(
            "id" => $id,
            "clinic" => $clinic,
            "insurance" => $insurance,
            "patient_id" => $patient_id,
            "patient_name" => $patient_name,
            "oot" => $oot,
            "created" => $created
        );

        // array_push($orders_arr["records"], $order_item);
        array_push($orders_arr, $order_item);
    }

    echo json_encode($orders_arr);
}

else{
    echo json_encode(
        array("message" => "No orders found.")
    );
}
?>
