<?php


Class Run {
	
	protected  $application;
	
	public $app_options;
	
	public $driver_soap_port;
	
	public $driver_soap_root_path;
	
	public $driver_soap_server;
	
	public $driver_rest_root_path;
	
	public $service_edocs_soap_port;
	
	public $service_edocs_soap_root_path;
	
	public $service_edocs_soap_server;

    public $service_partner_soap_port;

    public $service_partner_soap_root_path;

    public $service_partner_soap_server;
	
	
	public function __construct(){
		
		/* Initialize constructor here */
		
		$this->application = new Zend_Application(
									APPLICATION_ENV,
									APPLICATION_PATH . '/configs/application.ini'
		);
		
		$options = $this->app_options = $this->application->getOptions();
		
		// Soap Driver
		$this->driver_soap_port = $options['serviceDriver_SoapPort']; 
		$this->driver_soap_root_path = $options['serviceDriver_SoapRootPath'];
		$this->driver_soap_server = $options['serviceDriver_SoapServer'];
		// Rest Driver
		$this->driver_rest_root_path = $options['serviceDriver_RestRootPath'];
		
		###  Edocs Services
		$this->service_edocs_soap_port = $options['serviceEdocs_SoapPort'];
		$this->service_edocs_soap_root_path = $options['serviceEdocs_SoapRootPath'];
		$this->service_edocs_soap_server = $options['serviceEdocs_SoapServer'];

        ###  Partners Services
        $this->service_partner_soap_port = $options['servicePartner_SoapPort'];
        $this->service_partner_soap_root_path = $options['servicePartner_SoapRootPath'];
        $this->service_partner_soap_server = $options['servicePartner_SoapServer'];
	}
}