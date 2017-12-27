<?php
class OrderProduct{

    // database connection and table name
    private $conn;
    private $table_name = "order_products";

    // object properties
    public $id;
    public $product_id;
    public $order_id;
    public $description;
    public $op1_1;
    public $op1_1_dt;
    public $op1_2;
    public $op1_2_dt;
    public $op1_3;
    public $op1_3_dt;
    public $op1_4;
    public $op1_4_dt;
    public $op1_5;
    public $op1_5_dt;
    public $op2_1;
    public $op2_1_dt;
    public $op2_2;
    public $op2_2_dt;
    public $op2_3;
    public $op2_3_dt;
    public $rush;
    public $exchange;
    public $return;
    public $status;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read orders
    function read(){

        // select all query
        $query = "SELECT
                     op.id,
                     op.product_id,
                     op.order_id,
                     op.description,
                     op.op1_1,
                     op.op1_1_dt,
                     op.op1_2,
                     op.op1_2_dt,
                     op.op1_3,
                     op.op1_3_dt,
                     op.op1_4,
                     op.op1_4_dt,
                     op.op1_5,
                     op.op1_5_dt,
                     op.op2_1,
                     op.op2_1_dt,
                     op.op2_2,
                     op.op2_2_dt,
                     op.op2_3,
                     op.op2_3_dt,
                     op.rush,
                     op.exchange,
                     op.return,
                     op.status
                FROM
                    " . $this->table_name . " op
                    INNER JOIN
                        products p
                            ON op.product_id = p.id
                ORDER BY
                    op.id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create order
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                     product_id=:product_id,
                     order_id=:order_id,
                     description=:description,
                     op1_1=:op1_1,
                     op1_1_dt=:op1_1_dt,
                     op1_2=:op1_2,
                     op1_2_dt=:op1_2_dt,
                     op1_3=:op1_3,
                     op1_3_dt=:op1_3_dt,
                     op1_4=:op1_4,
                     op1_4_dt=:op4_1_dt,
                     op1_5=:op1_5,
                     op1_5_dt=:op5_1_dt,
                     op2_1=:op2_1,
                     op2_1_dt=:op2_1_dt,
                     op2_2=:op2_2,
                     op2_2_dt=:op2_2_dt,
                     op2_3=:op2_3,
                     op2_3_dt=:op2_3_dt,
                     rush=:rush,
                     exchange=:exchange,
                     return=:return,
                     status=:status
                     ";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        $this->order_id=htmlspecialchars(strip_tags($this->order_id));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->op1_1=htmlspecialchars(strip_tags($this->op1_1));
        $this->op1_1_dt=htmlspecialchars(strip_tags($this->op1_1_dt));
        $this->op1_2=htmlspecialchars(strip_tags($this->op1_2));
        $this->op1_2_dt=htmlspecialchars(strip_tags($this->op1_2_dt));
        $this->op1_3=htmlspecialchars(strip_tags($this->op1_3));
        $this->op1_3_dt=htmlspecialchars(strip_tags($this->op1_3_dt));
        $this->op1_4=htmlspecialchars(strip_tags($this->op1_4));
        $this->op1_4_dt=htmlspecialchars(strip_tags($this->op1_4_dt));
        $this->op1_5=htmlspecialchars(strip_tags($this->op1_5));
        $this->op1_5_dt=htmlspecialchars(strip_tags($this->op1_5_dt));
        $this->op2_1=htmlspecialchars(strip_tags($this->op2_1));
        $this->op2_1_dt=htmlspecialchars(strip_tags($this->op2_1_dt));
        $this->op2_2=htmlspecialchars(strip_tags($this->op2_2));
        $this->op2_2_dt=htmlspecialchars(strip_tags($this->op2_2_dt));
        $this->op2_3=htmlspecialchars(strip_tags($this->op2_3));
        $this->op2_3_dt=htmlspecialchars(strip_tags($this->op2_3_dt));
        $this->rush=htmlspecialchars(strip_tags($this->rush));
        $this->exchange=htmlspecialchars(strip_tags($this->exchange));
        $this->return=htmlspecialchars(strip_tags($this->return));
        $this->status=htmlspecialchars(strip_tags($this->status));

        // bind values
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":op1_1", $this->op1_1);
        $stmt->bindParam(":op1_1_dt", $this->op1_1_dt);
        $stmt->bindParam(":op1_2", $this->op1_2);
        $stmt->bindParam(":op1_2_dt", $this->op1_2_dt);
        $stmt->bindParam(":op1_3", $this->op1_3);
        $stmt->bindParam(":op1_3_dt", $this->op1_3_dt);
        $stmt->bindParam(":op1_4", $this->op1_4);
        $stmt->bindParam(":op1_4_dt", $this->op1_4_dt);
        $stmt->bindParam(":op1_5", $this->op1_5);
        $stmt->bindParam(":op1_5_dt", $this->op1_5_dt);
        $stmt->bindParam(":op2_1", $this->op2_1);
        $stmt->bindParam(":op2_1_dt", $this->op2_1_dt);
        $stmt->bindParam(":op2_2", $this->op2_2);
        $stmt->bindParam(":op2_2_dt", $this->op2_2_dt);
        $stmt->bindParam(":op2_3", $this->op2_3);
        $stmt->bindParam(":op2_3_dt", $this->op2_3_dt);
        $stmt->bindParam(":rush", $this->rush);
        $stmt->bindParam(":exchange", $this->exchange);
        $stmt->bindParam(":return", $this->return);
        $stmt->bindParam(":status", $this->status);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // used when filling up the update order form
    function readOne(){

        // query to read single record
        $query = "SELECT
                     op.id,
                     op.product_id,
                     op.order_id,
                     op.description,
                     op.op1_1,
                     op.op1_1_dt,
                     op.op1_2,
                     op.op1_2_dt,
                     op.op1_3,
                     op.op1_3_dt,
                     op.op1_4,
                     op.op1_4_dt,
                     op.op1_5,
                     op.op1_5_dt,
                     op.op2_1,
                     op.op2_1_dt,
                     op.op2_2,
                     op.op2_2_dt,
                     op.op2_3,
                     op.op2_3_dt,
                     op.rush,
                     op.exchange,
                     op.return,
                     op.status
                FROM
                    " . $this->table_name . " op
                    INNER JOIN
                        products p
                            ON op.product_id = p.id
                WHERE
                    op.id = ?
                LIMIT
                    0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of order to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->product_id = $row['product_id'];
        $this->order_id = $row['order_id'];
        $this->description = $row['description'];
        $this->op1_1 = $row['op1_1'];
        $this->op1_1_dt = $row['op1_1_dt'];
        $this->op1_2 = $row['op1_2'];
        $this->op1_2_dt = $row['op1_2_dt'];
        $this->op1_3 = $row['op1_3'];
        $this->op1_3_dt = $row['op1_3_dt'];
        $this->op1_4 = $row['op1_4'];
        $this->op1_4_dt = $row['op1_4_dt'];
        $this->op1_5 = $row['op1_5'];
        $this->op1_5_dt = $row['op1_5_dt'];
        $this->op2_1 = $row['op2_1'];
        $this->op2_1_dt = $row['op2_1_dt'];
        $this->op2_2 = $row['op2_2'];
        $this->op2_2_dt = $row['op2_2_dt'];
        $this->op2_3 = $row['op2_3'];
        $this->op2_3_dt = $row['op2_3_dt'];
        $this->rush = $row['rush'];
        $this->exchange = $row['exchange'];
        $this->return = $row['return'];
        $this->status = $row['status'];
    }

    // update the order
    function update(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                  product_id=:product_id,
                  order_id=:order_id,
                  description=:description,
                  op1_1=:op1_1,
                  op1_1_dt=:op1_1_dt,
                  op1_2=:op1_2,
                  op1_2_dt=:op1_2_dt,
                  op1_3=:op1_3,
                  op1_3_dt=:op1_3_dt,
                  op1_4=:op1_4,
                  op1_4_dt=:op4_1_dt,
                  op1_5=:op1_5,
                  op1_5_dt=:op5_1_dt,
                  op2_1=:op2_1,
                  op2_1_dt=:op2_1_dt,
                  op2_2=:op2_2,
                  op2_2_dt=:op2_2_dt,
                  op2_3=:op2_3,
                  op2_3_dt=:op2_3_dt,
                  rush=:rush,
                  exchange=:exchange,
                  return=:return,
                  status=:status,
                WHERE
                    id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        $this->order_id=htmlspecialchars(strip_tags($this->order_id));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->op1_1=htmlspecialchars(strip_tags($this->op1_1));
        $this->op1_1_dt=htmlspecialchars(strip_tags($this->op1_1_dt));
        $this->op1_2=htmlspecialchars(strip_tags($this->op1_2));
        $this->op1_2_dt=htmlspecialchars(strip_tags($this->op1_2_dt));
        $this->op1_3=htmlspecialchars(strip_tags($this->op1_3));
        $this->op1_3_dt=htmlspecialchars(strip_tags($this->op1_3_dt));
        $this->op1_4=htmlspecialchars(strip_tags($this->op1_4));
        $this->op1_4_dt=htmlspecialchars(strip_tags($this->op1_4_dt));
        $this->op1_5=htmlspecialchars(strip_tags($this->op1_5));
        $this->op1_5_dt=htmlspecialchars(strip_tags($this->op1_5_dt));
        $this->op2_1=htmlspecialchars(strip_tags($this->op2_1));
        $this->op2_1_dt=htmlspecialchars(strip_tags($this->op2_1_dt));
        $this->op2_2=htmlspecialchars(strip_tags($this->op2_2));
        $this->op2_2_dt=htmlspecialchars(strip_tags($this->op2_2_dt));
        $this->op2_3=htmlspecialchars(strip_tags($this->op2_3));
        $this->op2_3_dt=htmlspecialchars(strip_tags($this->op2_3_dt));
        $this->rush=htmlspecialchars(strip_tags($this->rush));
        $this->exchange=htmlspecialchars(strip_tags($this->exchange));
        $this->return=htmlspecialchars(strip_tags($this->return));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":op1_1", $this->op1_1);
        $stmt->bindParam(":op1_1_dt", $this->op1_1_dt);
        $stmt->bindParam(":op1_2", $this->op1_2);
        $stmt->bindParam(":op1_2_dt", $this->op1_2_dt);
        $stmt->bindParam(":op1_3", $this->op1_3);
        $stmt->bindParam(":op1_3_dt", $this->op1_3_dt);
        $stmt->bindParam(":op1_4", $this->op1_4);
        $stmt->bindParam(":op1_4_dt", $this->op1_4_dt);
        $stmt->bindParam(":op1_5", $this->op1_5);
        $stmt->bindParam(":op1_5_dt", $this->op1_5_dt);
        $stmt->bindParam(":op2_1", $this->op2_1);
        $stmt->bindParam(":op2_1_dt", $this->op2_1_dt);
        $stmt->bindParam(":op2_2", $this->op2_2);
        $stmt->bindParam(":op2_2_dt", $this->op2_2_dt);
        $stmt->bindParam(":op2_3", $this->op2_3);
        $stmt->bindParam(":op2_3_dt", $this->op2_3_dt);
        $stmt->bindParam(":rush", $this->rush);
        $stmt->bindParam(":exchange", $this->exchange);
        $stmt->bindParam(":return", $this->return);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // delete the order
    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    // search orders
    function search($keywords){

        // select all query
        $query = "SELECT
                     op.id,
                     op.product_id,
                     op.order_id,
                     op.description,
                     op.op1_1,
                     op.op1_1_dt,
                     op.op1_2,
                     op.op1_2_dt,
                     op.op1_3,
                     op.op1_3_dt,
                     op.op1_4,
                     op.op1_4_dt,
                     op.op1_5,
                     op.op1_5_dt,
                     op.op2_1,
                     op.op2_1_dt,
                     op.op2_2,
                     op.op2_2_dt,
                     op.op2_3,
                     op.op2_3_dt,
                     op.rush,
                     op.exchange,
                     op.return,
                     op.status
                FROM
                    " . $this->table_name . " op
                    INNER JOIN
                        products p
                            ON op.product_id = p.id
                    INNER JOIN
                        orders o
                            ON op.order_id = o.id
                WHERE
                    o.id LIKE ? OR p.id LIKE ?
                ORDER BY
                    o.id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read orders with pagination
    public function readPaging($from_record_num, $records_per_page){

        // select query
        $query = "SELECT
                     op.id,
                     op.product_id,
                     op.order_id,
                     op.description,
                     op.op1_1,
                     op.op1_1_dt,
                     op.op1_2,
                     op.op1_2_dt,
                     op.op1_3,
                     op.op1_3_dt,
                     op.op1_4,
                     op.op1_4_dt,
                     op.op1_5,
                     op.op1_5_dt,
                     op.op2_1,
                     op.op2_1_dt,
                     op.op2_2,
                     op.op2_2_dt,
                     op.op2_3,
                     op.op2_3_dt,
                     op.rush,
                     op.exchange,
                     op.return,
                     op.status
                FROM
                    " . $this->table_name . " op
                    INNER JOIN
                        products p
                            ON op.product_id = p.id
                ORDER BY op.id DESC
                LIMIT ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }

    // used for paging orders
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }
}
