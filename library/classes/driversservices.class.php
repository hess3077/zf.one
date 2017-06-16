<?php

class DriversServices {

	public $firephp = null;
	
	public $run;
	
	protected $soap_wsdl_path;
	
	protected $rest_wsdl_path;
	
	protected $soap_client;
	
	
	public function __construct(){

		/* Initialize constructor here */

		$run = $this->run = new Run();
		
		$wsdl_path = "http://". $run->driver_soap_server .":". $run->driver_soap_port;
		
		$this->soap_wsdl_path = $wsdl_path . $run->driver_soap_root_path ."?WSDL";
		$this->rest_wsdl_path = $wsdl_path . $run->driver_rest_root_path;

        $this->soap_options = array(
                                'soap_version' => SOAP_1_2,
                                'cache_wsdl' => WSDL_CACHE_MEMORY,
                                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_DEFLATE
        );
	}
	
	/**
	 * 
	 * @param string $token
	 * @param string $param
	 * @return unknown
	 */
	public function CIsTokenValid_soap($token=null, $param='token'){
		$output=false;

        if(!empty($token)) {
            try {
                $this->soap_client = new SoapClient($this->soap_wsdl_path, $this->soap_options);

                $output = $this->soap_client->IsTokenValid(array($param => $token))->IsTokenValidResult;

                // $this->soap_client->GetByLogin(array('login' => 'nathvida')); // Récupération des données du users

                return $output;
            } catch (Zend_Exception $e) {
                echo "<p><label>Zend Soap Client errors</label> : <span style='color: red;'>" . $e->getMessage() . "</span></p>";
            }
        }
		
		return $output;
	}
	
	/**
	 * 
	 * @param unknown $token
	 * @param string $param
	 * @return string
	 */
	public function CIsTokenValid($token, $param='istokenvalid'){
		$output=false;

        if(!empty($token)){
            try {
                $client = new Zend_Http_Client($this->rest_wsdl_path ."{$param}/{$token}");

                //$client->setRawData($json, 'application/json')->request('GET');

                $output = $client->request()->getBody();
            }
            catch (Exception $e){
                echo "<p><label>Zend Rest clients Errors<label> : <span style='color: red;'>". $e->getMessage() ."</span></p>";
            }
        }
		
		return $output;
	}
}