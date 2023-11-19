<?php
// Encargado del manejo de errores y de formular los archivos json que se enviaran
class CustomerController extends BaseController
{
    // funcion encargada de realizar la busqueda del cliente por id
    public function id_action()
    {
        $strErrorDesc = ''; // String de Error
        $requestMethod = $_SERVER["REQUEST_METHOD"]; // Obtención del Metodo de la Solicitud
        $arrQueryStringParams = $this->getQueryStringParams();  // Asignación del array de parametros de la URL
        if (strtoupper($requestMethod) == 'GET') {  // Si el Metodo es GET
            try {
                $customerModel = new CustomerModel();   
                $id = 0;
                // si hay valor en el array asociativo con clave ¨id¨ y no esta la cadena vacia
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) { // caso .../id? | .../id?id=
                    $id = $arrQueryStringParams['id'];  // Asignando el id
                    $customer = $customerModel->get_customer_id($id);   // Trae la primer fila que coincida con el id en customers
                    if ( !$customer ) {         // Si no trajo ninguna Fila
                        $strErrorDesc = 'No existe cliente con id: '.$id;
                        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    }
                } 
                else { // si no hay valor en clave id
                    $strErrorDesc = 'Debe ingresar un valor para id!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                
            } catch (Error $e) {    //en caso de error
                $strErrorDesc = $e->getMessage().' Algo salio mal!.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else { // En caso de elegir cualquier Metodo no Soportado
            $strErrorDesc = 'Método no Soportado';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // envio de respuesta 
        if (!$strErrorDesc) { // Si no existe mensaje de error
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
        } else { // Si existe mensaje de error
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
        // enviamos la respuesta 
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