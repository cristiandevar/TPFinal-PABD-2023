<?php
// require_once __DIR__.'/../../Model/CustomerModel.php';
class CustomerController extends BaseController
{
    /** 
* "/user/list" Endpoint - Get list of users 
*/
    public function idAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        // parse_str($_SERVER['QUERY_STRING'], $query);
        // die($arrQueryStringParams['id']);
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $customerModel = new CustomerModel();
                // $response = [];
                $id = 0;
                
                // $intLimit = 10;
                // $companyname = '';
                
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $id = $arrQueryStringParams['id'];
                    $customer = $customerModel->get_customer_id($id);
                    if ( !$customer ) {
                        $strErrorDesc = 'No existe cliente con ese id!';
                        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    
                    }
                    // $response[''] = 
                    // $responseData = json_encode($customer);
                }
                else {
                    $strErrorDesc = 'Debe ingresar un valor para id!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }

                // $arrCustomers = $customerModel->getUsers($intLimit);
                // $responseData = json_encode($arrCustomers);
                
                // if ( (isset($arrQueryStringParams['companyname']) && $arrQueryStringParams['companyname']) ) {
                //     $companyname = $arrQueryStringParams['companyname'];
                // }
                
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
                        // 'error' => $strErrorDesc
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
                        // 'error' => $strErrorDesc
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

    public function companynameAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $customerModel = new CustomerModel();
                // $intLimit = 10;
                $id = 0;
                $companyname = '';
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $id = $arrQueryStringParams['id'];
                }
                if ( (isset($arrQueryStringParams['companyname']) && $arrQueryStringParams['companyname']) ) {
                    $companyname = $arrQueryStringParams['companyname'];
                }
                
                $response = [];
                $customer = $customerModel->

                $arrCustomers = $customerModel->getUsers($intLimit);
                $responseData = json_encode($arrCustomers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
?>