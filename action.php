<?php
include "db.php";
include "dbConf.php";
class DataOperation extends Database
{
    public $table;
    public function insert_record($table, $fileds)
    {
        //"INSERT INTO table_name (, , ) VALUES ('', '')";
        $sql = "";
        $sql .= "INSERT INTO " . $table;
        $sql .= "(" . implode(",", array_keys($fileds)) . ") VALUES ";
        $sql .= "('" . implode("','", array_values($fileds)) . "')";
        $query = mysqli_query($this->con, $sql);
        if ($query) {
            return true;
        }
    }
    public function fetch_record($table)
    {
        $sql = "SELECT * FROM " . $table;
        $array = array();
        $query = mysqli_query($this->con, $sql);
        while ($row =  mysqli_fetch_assoc($query)) {
            $array[] = $row;
        }
        return $array;
    }
    public function select_record($table, $where)
    {
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql .= "SELECT * FROM " . $table . " WHERE " . $condition;
        $query = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_array($query);
        return $row;
    }
    public function update_record($table, $where, $fileds)
    {
        $sql = "";
        $condition = "";
        // $fileds = "";
        // $myArray = "";
        foreach ($where as $key => $value) {
            $condition .= $key . "='" . $value . "'";
        }
        foreach ($fileds as $key => $value) {
            $sql .= $key . "='" . $value . "', ";
        }
        $sql = substr($sql, 0, -2);
        $sql = "UPDATE " . $table . " SET " . $sql . " WHERE " . $condition;
        // $query = mysqli_query($this->con, $sql);
        if (mysqli_query($this->con, $sql)) {
            return true;
        }
        // $row = mysqli_fetch_array($query);
        // return $row;
    }
    public function delete_record($table, $where)
    {
        //$sql = "delete  * FROM `crud` WHERE id=$id";
        $sql = "";
        foreach ($where as $key => $value) {
            $sql .= $key . "='" . $value . "'";
        }
        $sql = "DELETE FROM " . $table . " WHERE " . $sql;
        // echo $sql;
        $result = mysqli_query($this->con, $sql);
        if ($result) {
            return true;
        }
    }
}

// $obj = new DataOperation(serverName, userName, password, dbName);

class med extends DataOperation
{
    public $table = "med";
    public $name;
    public $number;

    public function insertMed($inputs)
    {

        $this->name = $inputs["name"];
        $this->number = $inputs["qty"];
        $myArray = array(
            "name" => $this->name,
            "number" => $this->number
        );
        if ($this->insert_record($this->table, $myArray)) {
            header("location:index.php?msg=Done");
        }

        // echo "Done";
        // header("location: index.php?msg=Done");
    }
}

$obj = new med();
if (isset($_POST['submit'])) {
    $obj->insertMed($_POST);
}
// if (isset($_POST['submit'])) {
//     $myArray = array(
//         "name" => $_POST["name"],
//         "number" => $_POST["qty"]
//     );
//     if ($obj->insert_record("med", $myArray)) {
//         header("location:index.php?msg=Done");
//     }

//     // echo "Done";
//     // header("location: index.php?msg=Done");
// }
if (isset($_POST["edit"])) {
    $id = $_POST["id"];
    $where = array("id" => $id);
    $myArray = array(
        "name" => $_POST["name"],
        "number" => $_POST["qty"]
    );
    $update = $obj->update_record("med", $where, $myArray);
    if ($update) {
        header("location:index.php?msg=Record Updated Successfully");
    }
}

if (isset($_GET['deleteid'])) {
    $id = $_GET["deleteid"];
    $where = array("id" => $id);
    if ($obj->delete_record("med", $where)) {
        header("location:index.php?msg=Record Deleted Successfully");
    }

    // echo "Done";
    // header("location: index.php?msg=Done");
}
