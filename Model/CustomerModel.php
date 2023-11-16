<?php
class CustomerModel extends Database{

    public function get_customer_id($id){
        $query = "select * from customers where customerid = '".$id."' limit 1;";
        $db = 'northwind';
        $result = $this->ejecutar_consulta_db($query, $db);
        if($result){
            $customer = pg_fetch_assoc($result);
        }
        else {
            $customer = '';
        }
        return $customer;
    }

    public function get_customer_name($name){
        $query = "select * from customers where companyname ilike '".$name."%' limit 1;";
        $db = 'northwind';
        $result = $this->ejecutar_consulta_db($query, $db);
        if($result){
            $customer = pg_fetch_assoc($result);
        }
        else {
            $customer = null;
        }
        return $customer;
    }

}
?>