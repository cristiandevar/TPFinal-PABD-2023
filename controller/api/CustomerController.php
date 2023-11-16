<?php
// require_once __DIR__.'/../../Model/CustomerModel.php';
class CustomerController extends BaseController
{
    /** 
* "/user/list" Endpoint - Obtiene un Cliente de la base de datos Northwind
*/
    // funcion encargada de realizar la busqueda del cliente por id
    public function id_action()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $customerModel = new CustomerModel();
                $id = 0;
                
                die(json_encode($arrQueryStringParams));
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $id = $arrQueryStringParams['id'];
                    $customer = $customerModel->get_customer_id($id);
                    if ( !$customer ) {
                        $strErrorDesc = 'No existe cliente con id: '.$id;
                        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    
                    }
                }
                else {
                    $strErrorDesc = 'Debe ingresar un valor para id!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().' Algo salio mal!.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Método no Soportado';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                json_encode(
                    array(
                        'status' => 'success',
                        'data' => $customer,
                        'message' => null 
                    )
                ),
                array(
                    'Content-Type: application/json',
                    'HTTP/1.1 200 OK'
                )
            );
        } else {
            $this->sendOutput(
                json_encode(
                    array(
                        'status' => 'error',
                        'data' => null,
                        'message' => $strErrorDesc 
                    )
                ), 
                array(
                    'Content-Type: application/json',
                    $strErrorHeader
                )
            );
        }
    }

    public function name_action()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $customerModel = new CustomerModel();
                // $id = 0;
                if (isset($arrQueryStringParams['name']) && $arrQueryStringParams['name']) {
                    $name = $arrQueryStringParams['name'];
                    $customer = $customerModel->get_customer_name($name);
                    if ( !$customer ) {
                        $strErrorDesc = 'No existe cliente de nombre:'.$name;
                        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    
                    }
                }
                else {
                    $strErrorDesc = 'Debe ingresar un valor para name!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().' Algo salio mal!.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Método no Soportado';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                json_encode(
                    array(
                        'status' => 'success',
                        'data' => $customer,
                        'message' => null 
                    )
                ),
                array(
                    'Content-Type: application/json',
                    'HTTP/1.1 200 OK'
                )
            );
        } else {
            $this->sendOutput(
                json_encode(
                    array(
                        'status' => 'error',
                        'data' => null,
                        'message' => $strErrorDesc 
                    )
                ), 
                array(
                    'Content-Type: application/json',
                    $strErrorHeader
                )
            );
        }
    }
}
?>