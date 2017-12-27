<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/order_product.php';

// utilities
$utilities = new Utilities();

// instantiate database and order object
$database = new Database();
$db = $database->getConnection();

// initialize object
$order_product = new OrderProduct($db);

// query orders
$stmt = $order_product->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // orders array
    $order_products_arr=array();
    $order_products_arr["records"]=array();
    $order_products_arr["paging"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $order_product_item=array(
            "id" => $id,
            "product_id" => $product_id,
            "order_id" => $order_id,
            "description" => $description,
            "op1_1" => $op1_1,
            "op1_1_dt" => $op1_1_dt,
            "op1_2" => $op1_2,
            "op1_2_dt" => $op1_2_dt,
            "op1_3" => $op1_3,
            "op1_3_dt" => $op1_3_dt,
            "op1_4" => $op1_4,
            "op1_4_dt" => $op1_4_dt,
            "op1_5" => $op1_5,
            "op1_5_dt" => $op1_5_dt,
            "op2_1" => $op2_1,
            "op2_1_dt" => $op2_1_dt,
            "op2_2" => $op2_2,
            "op2_2_dt" => $op2_2_dt,
            "op2_3" => $op2_3,
            "op2_3_dt" => $op2_3_dt,
            "rush" => $rush,
            "exchange" => $exchange,
            "return" => $return,
            "status" => $status
        );

        // array_push($order_products_arr["records"], $order_product_item);
        array_push($order_products_arr, $order_product_item);
    }


    // include paging
    $total_rows=$order_product->count();
    $page_url="{$home_url}order/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $order_products_arr["paging"]=$paging;

    echo json_encode($order_products_arr);
}

else{
    echo json_encode(
        array("message" => "No orders found.")
    );
}
?>
