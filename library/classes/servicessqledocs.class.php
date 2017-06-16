<?php

class ServicesSqleDocs {

	public $firephp = null;
	
	public $run;
	
	protected $soap_wsdl_path;
	
	protected $rest_wsdl_path;
	
	protected $soap_client;
	
	protected $soap_options;


	public function __construct(){

		/* Initialize constructor here */

		$run = $this->run = new Run();
		
		$wsdl_path = "http://". $run->service_edocs_soap_server .":". $run->service_edocs_soap_port;
		
		$this->soap_wsdl_path = $wsdl_path . $run->service_edocs_soap_root_path ."?WSDL";
		$this->rest_wsdl_path = $wsdl_path . $run->service_edocs_soap_root_path;

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
	public function GetCarPolicyDocument($code_cli=false, $code_str=false, $type=false){
		$output=false;
		
		try{
            $this->soap_client = new SoapClient($this->soap_wsdl_path, $this->soap_options);

			$params = array(
						'clientId' => $code_cli,
						'structureId' => $code_str,
						'doctype' => $type
			);

			$output = $this->soap_client->GetCarPolicyDocument($params)->GetCarPolicyDocumentResult;
		}
		catch(SoapFault $e){
			$output=false;
		}
		
		return $output;
	}
}