<?php
class CustomerModel extends Database{
    // Metodos utilizado para consultar a la BD Northwind
    // Ambos metodos utilizan exec_query_db, el cual 
    // pertenece a la clase padre Database

    // este metodo devuelve un/ningun customer dado un id
    public function get_customer_id($id){
        $query = "select * from customers where customerid = '".$id."' order by customerid limit 1;";
        $db = 'northwind';
        $result = $this->exec_query_db($query, $db);
        if($result){
            $customer = pg_fetch_assoc($result);
        }
        else {
            $customer = '';
        }
        return $customer;
    }

    
    // Metodo utilizado para consultar a la BD Northwind
    // este metodo devuelve un/ningun customer dado un id
    public function get_customer_name($name){
        $query = "select * from customers where companyname ilike '".$name."%' order by customerid limit 1;";
        $db = 'northwind';
        $result = $this->exec_query_db($query, $db);
        if($result){
            $customer = pg_fetch_assoc($result);
        }
        else {
            $customer = null;
        }
        return $customer;
    }

    // Metodo utilizado para consultar a la BD Northwind
    // este metodo devuelve un/ningun customer dado un id
    public function get_customer_id_name($id, $name){
        $query = "select * from customers 
                  where customerid = '".$id."' and companyname ilike '".$name."%' order by customerid limit 1;";
        $db = 'northwind';
        $result = $this->exec_query_db($query, $db);
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