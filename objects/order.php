<?php
class Order{

    // database connection and table name
    private $conn;
    private $table_name = "orders";

    // object properties
    public $id;
    public $clinic;
    public $insurance;
    public $patient_id;
    public $patient_name;
    public $oot;
    public $created;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read orders
    function read(){

        // select all query
        $query = "SELECT
                    concat(pt.last_name, ', ', pt.first_name) as patient_name, o.id, o.clinic, o.insurance, o.patient_id, o.oot, o.created
                FROM
                    " . $this->table_name . " o
                    LEFT JOIN
                        patients pt
                            ON o.patient_id = pt.id
                ORDER BY
                    o.created DESC";

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
                     insurance=:insurance, clinic=:clinic, patient_id=:patient_id, oot=:oot, created=:created";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->insurance=htmlspecialchars(strip_tags($this->insurance));
        $this->clinic=htmlspecialchars(strip_tags($this->clinic));
        $this->patient_id=htmlspecialchars(strip_tags($this->patient_id));
        $this->oot=htmlspecialchars(strip_tags($this->oot));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind values
        $stmt->bindParam(":insurance", $this->insurance);
        $stmt->bindParam(":clinic", $this->clinic);
        $stmt->bindParam(":patient_id", $this->patient_id);
        $stmt->bindParam(":oot", $this->oot);
        $stmt->bindParam(":created", $this->created);

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
                    concat(pt.last_name, ', ', pt.first_name) as patient_name, o.id, o.clinic, o.insurance, o.patient_id, o.oot, o.created
                FROM
                    " . $this->table_name . " o
                    LEFT JOIN
                        patients pt
                            ON o.patient_id = pt.id
                WHERE
                    o.id = ?
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
        $this->insurance = $row['insurance'];
        $this->clinic = $row['clinic'];
        $this->patient_id = $row['patient_id'];
        $this->patient_name = $row['patient_name'];
        $this->oot = $row['oot'];
        $this->created = $row['created'];
    }

    // update the order
    function update(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    insurance = :insurance,
                    clinic = :clinic,
                    patient_id = :patient_id,
                    oot = :oot,
                WHERE
                    id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->insurance=htmlspecialchars(strip_tags($this->insurance));
        $this->clinic=htmlspecialchars(strip_tags($this->clinic));
        $this->patient_id=htmlspecialchars(strip_tags($this->patient_id));
        $this->oot=htmlspecialchars(strip_tags($this->oot));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':insurance', $this->insurance);
        $stmt->bindParam(':clinic', $this->clinic);
        $stmt->bindParam(':patient_id', $this->patient_id);
        $stmt->bindParam(':oot', $this->oot);
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
                    concat(pt.last_name, ' ', pt.first_name) as patient_name, o.id, o.clinic, o.insurance, o.patient_id, o.oot, o.created
                FROM
                    " . $this->table_name . " o
                    LEFT JOIN
                        patients pt
                            ON o.patient_id = pt.id
                WHERE
                    pt.id LIKE ?
                    OR o.clinic LIKE ?
                    OR pt.last_name LIKE ?
                    OR pt.first_name LIKE ?
                    OR concat(pt.last_name, ' ', pt.first_name) LIKE ?
                    OR concat( pt.first_name, ' ', pt.last_name) LIKE ?
                ORDER BY
                    o.created DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);
        $stmt->bindParam(5, $keywords);
        $stmt->bindParam(6, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read orders with pagination
    public function readPaging($from_record_num, $records_per_page){

        // select query
        $query = "SELECT
                    concat(pt.last_name, ', ', pt.first_name) as patient_name, o.id, o.clinic, o.insurance, o.patient_id, o.oot, o.created
                FROM
                    " . $this->table_name . " o
                    LEFT JOIN
                        patients pt
                            ON o.patient_id = pt.id
                ORDER BY o.created DESC
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
