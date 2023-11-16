<?php
// require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class CustomerModel extends Database{

    public function get_customer_id($id){
        $query = "select * from customers where customerid = '".$id."' limit 1;";
        $db = 'northwind';
        $result = $this->ejecutar_consulta_db($query, $db);
        if($result){
            // $customer = [];
            $customer = pg_fetch_assoc($result);
            // die($customer['companyname']);
        }
        else {
            $customer = '';
        }
        // die($customer==false);
        return $customer;
    }

    public function get_customer_companyname($companyname){
        $query = "select * from customers where companyname = '".$companyname."' limit 1;";
        $db = 'northwind';
        $result = $this->ejecutar_consulta_db($query, $db);
        if($result){
            // $customer = [];
            $customer = pg_fetch_assoc($result);
        }
        else {
            $customer = null;
        }
        return $customer;
    }

}
?>