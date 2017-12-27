<?php
class Patient{

    // database connection and table name
    private $conn;
    private $table_name = "patients";

    // object properties
    public $id;
    public $last_name;
    public $first_name;
    public $phone;
    public $address_1;
    public $address_2;
    public $city;
    public $st;
    public $zip;
    public $bt_id;
    public $ins_1;
    public $ins_2;
    public $ins_3;
    public $created;

    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    id, concat(last_name, ', ', first_name) as patient_name, phone, address_1, address_2, city, st, zip, bt_id, ins_1, ins_2, ins_3, created
                FROM
                    " . $this->table_name . "
                ORDER BY
                    patient_name";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    // used by select drop-down list
    public function read(){

        //select all data
        $query = "SELECT
                    id, last_name, first_name, phone, address_1, address_2, city, st, zip, bt_id, ins_1, ins_2, ins_3, created
                FROM
                    " . $this->table_name . "
                ORDER BY
                    last_name";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    // create patient
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET

                    last_name = :last_name,
                    first_name = :first_name,
                    phone = :phone,
                    address_1 = :address_1,
                    address_2 = :address_2,
                    city = :city,
                    st = :st,
                    zip = :zip,
                    bt_id = :bt_id,
                    ins_1 = :ins_1,
                    ins_2 = :ins_2,
                    ins_3 = :ins_3,
                    created = :created";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->address_1=htmlspecialchars(strip_tags($this->address_1));
        $this->address_2=htmlspecialchars(strip_tags($this->address_2));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->st=htmlspecialchars(strip_tags($this->st));
        $this->zip=htmlspecialchars(strip_tags($this->zip));
        $this->bt_id=htmlspecialchars(strip_tags($this->bt_id));
        $this->ins_1=htmlspecialchars(strip_tags($this->ins_1));
        $this->ins_2=htmlspecialchars(strip_tags($this->ins_2));
        $this->ins_3=htmlspecialchars(strip_tags($this->ins_3));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind values
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address_1", $this->address_1);
        $stmt->bindParam(":address_2", $this->address_2);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":st", $this->st);
        $stmt->bindParam(":zip", $this->zip);
        $stmt->bindParam(":bt_id", $this->bt_id);
        $stmt->bindParam(":ins_1", $this->ins_1);
        $stmt->bindParam(":ins_2", $this->ins_2);
        $stmt->bindParam(":ins_3", $this->ins_3);
        $stmt->bindParam(":created", $this->created);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // used when filling up the update patient form
    function readOne(){

        // query to read single record
        $query = "SELECT
                      id, last_name, first_name, phone, address_1, address_2, city, st, zip, bt_id, ins_1, ins_2, ins_3, created
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of patient to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->last_name = $row['last_name'];
        $this->first_name = $row['first_name'];
        $this->phone = $row['phone'];
        $this->address_1 = $row['address_1'];
        $this->address_2 = $row['address_2'];
        $this->city = $row['city'];
        $this->st = $row['st'];
        $this->zip = $row['zip'];
        $this->bt_id = $row['bt_id'];
        $this->ins_1 = $row['ins_1'];
        $this->ins_2 = $row['ins_2'];
        $this->ins_3 = $row['ins_3'];
        $this->created = $row['created'];
    }

    // update the patient
    function update(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    last_name = :last_name,
                    first_name = :first_name,
                    phone = :phone,
                    address_1 = :address_1,
                    address_2 = :address_2,
                    city = :city,
                    st = :st,
                    zip = :zip,
                    bt_id = :bt_id,
                    ins_1 = :ins_1,
                    ins_2 = :ins_2,
                    ins_3 = :ins_3
                WHERE
                    id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->address_1=htmlspecialchars(strip_tags($this->address_1));
        $this->address_2=htmlspecialchars(strip_tags($this->address_2));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->st=htmlspecialchars(strip_tags($this->st));
        $this->zip=htmlspecialchars(strip_tags($this->zip));
        $this->bt_id=htmlspecialchars(strip_tags($this->bt_id));
        $this->ins_1=htmlspecialchars(strip_tags($this->ins_1));
        $this->ins_2=htmlspecialchars(strip_tags($this->ins_2));
        $this->ins_3=htmlspecialchars(strip_tags($this->ins_3));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address_1", $this->address_1);
        $stmt->bindParam(":address_2", $this->address_2);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":st", $this->st);
        $stmt->bindParam(":zip", $this->zip);
        $stmt->bindParam(":bt_id", $this->bt_id);
        $stmt->bindParam(":ins_1", $this->ins_1);
        $stmt->bindParam(":ins_2", $this->ins_2);
        $stmt->bindParam(":ins_3", $this->ins_3);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // delete the patient
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

    // search patients
    function search($keywords){

        // select all query
        $query = "SELECT
                    id, concat(last_name, ', ', first_name) as patient_name, phone, address_1, address_2, city, st, zip, bt_id, ins_1, ins_2, ins_3, created
                FROM
                    " . $this->table_name . "
                WHERE
                    id LIKE ? OR bt_id LIKE ? OR last_name LIKE ? OR first_name LIKE ?
                ORDER BY
                    id DESC";


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

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read patients with pagination
    public function readPaging($from_record_num, $records_per_page){

        // select query
        $query = "SELECT
                    id, concat(last_name, ', ', first_name) as patient_name, phone, concat(address_1, ' ', address_2) as address, city, st, zip, bt_id, ins_1, ins_2, ins_3
                FROM
                    " . $this->table_name . "
                ORDER BY
                    last_name
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

    // used for paging patients
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

}
?>
