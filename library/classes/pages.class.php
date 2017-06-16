<?php

class Pages {

	public $zf_instance;

	public $zf_getRequest;

	public $zf_getResponse;

	public $passport_page;


	public function __construct()
    {
		/*
		 * Données utiles
		 */

		$this->zf_instance = Zend_Controller_Front::getInstance();

		// getRequest / getResponse
		$this->zf_getRequest = $this->zf_instance->getRequest();
		$this->zf_getResponse = $this->zf_instance->getResponse();

		$get_json_format = self::getParam_path('get_json', 'get');
		$get_datas_format = self::getParam_path('datas_format', 'get');

        $origine_convertigo = self::getParam_path('ORIGINE', 'get');
        $idevent_convertigo = self::getParam_path('IDEVENT', 'get');

		/*
		 * Données de la page
		 */
		$this->passport_page = array(
								'domain' => self::getDomain(),
								'is_poc' => self::isPoc(),
								'is_ajax' => $get_json_format,
								'datas_format' => ($get_datas_format=='json') ? 'json' : 'xml',
								'showMenu' => self::getParam_path('showMenu', 'get'),
								'token' => self::getParam_path('token', 'get'),
                                'token_convertigo' => self::getParam_path('TOKEN', 'get'),
								'limit_request' => self::getParam_path('limit', 'get'),
								'code_cli' => self::getParam_path('code_cli', 'get'),
								'code_str' => self::getParam_path('code_str', 'get'),
								'car_policy' => self::getParam_path('car_policy', 'get'),
								'pol_ent' => self::getParam_path('pol_ent', 'get'),
								'logo_ent' => self::getParam_path('logo_ent', 'get'),
								'type_ent' => self::getParam_path('type_ent', 'get'),
                                'sequence_convertigo' => self::getParam_path('__sequence', 'get'),
                                'idcontract_convertigo' => self::getParam_path('IDCONTRACT', 'get'),
                                'immat_convertigo' => self::getParam_path('IMMAT', 'get'),
                                'customer_name_convertigo' => self::getParam_path('NOM', 'get'),
                                'customer_surname_convertigo' => self::getParam_path('PRENOM', 'get'),
                                'guid_convertigo' => self::getParam_path('GUID', 'get'),
                                'idevent_convertigo' => empty($idevent_convertigo) ? 0 : $idevent_convertigo,
                                'origine_convertigo' => empty($origine_convertigo) ? 0 : $origine_convertigo,
                                'description_convertigo' => self::getParam_path('DESCRIPTION', 'get'),
                                'commentaire_convertigo' => self::getParam_path('COMMENTAIRE', 'get'),
                                'pos_convertigo' => self::getParam_path('POS', 'get'),
                                'note_convertigo' => self::getParam_path('NOTE', 'get'),
                                'dateevent_convertigo' => self::getParam_path('DATEEVENT', 'get'),
                                'heureevent_convertigo' => self::getParam_path('HEUREEVENT', 'get'),
                                'typeevent_convertigo' => self::getParam_path('TYPEEVENT', 'get'),
                                'listpos_convertigo' => self::getParam_path('LISTPOS', 'get'),
                                'statut_copnvertigo' => self::getParam_path('STATUT', 'get')
		);
	}

	/**
	 *
	 * @return multitype:
	 */
	public static function getUriPath()
    {
		/* Sous domaine */
		$us_domain = self::getUsDomain();
		$us_domain = !empty($us_domain) ? $us_domain . '/' : null;

		// URI
		$request_uri = str_replace($us_domain, null, substr($_SERVER['REQUEST_URI'], 1));

		$output = explode("/", $request_uri);

		return $output;
	}

	/**
	 *
	 * @return boolean
	 */
	public static function isPoc()
    {
		$output=false;
		$path = self::getUriPath();

		/*
		 * Méthodes & Actions
		 */
		$method = !empty($path[0]) ? $path[0] : null;
		$action = !empty($path[1]) ? $path[1] : null;

		$list_methods = self::pocMethods();
		$list_actions = self::pocActions();

		if(!empty($method) && in_array($method, $list_methods)){
			$output=true;

			if(!empty($action) && !preg_match('/\?/', $action)){
				$output = ( (!empty($list_actions[$method]) && is_array($list_actions[$method])) && in_array($action, $list_actions[$method])) ? true : false;
			}
		}

		return $output;
	}

	/**
	 *
	 * @return multitype:string
	 */
	public static function pocMethods()
    {
		$output = array(
					'users',
					'token',
					'servicesSqlAldo'
		);

		return $output;
	}

	/**
	 *
	 * @return multitype:multitype:string
	 */
	public static function pocActions()
    {
		$output = array(
					'users' => array(
								'create',
								'read'
					),
					'token' => array(
								'create'
					),
					'servicesSqlAldo' => array(
											'test-token'
					)
		);

		return $output;
	}

	/**
	 *
	 * @param unknown $param
	 * @param string $action
	 * @return Ambigous <NULL, unknown>
	 */
	public static function getParam_path($param, $action='post')
    {
		$output=null;

		if(!empty($param)){
			switch($action){
				case 'post':
					$output = isset($_POST[$param]) ? $_POST[$param] : null;
				break;
				case 'get': default:
					$output = isset($_GET[$param]) ? $_GET[$param] : null;
				break;
			}
		}

		return $output;
	}

	/**
	 *
	 * @param unknown $proxy
	 * @return unknown
	 */
	public static function getDatasProxy($proxy)
    {
		$output=false;

		try {$client = new Zend_Http_Client($proxy);

			$output = $client->request()->getBody();
		}
		catch (Exception $e){
			echo "<p><label>Zend Rest clients Errors<label> : <span style='color: red;'>". $e->getMessage() ."</span></p>";
		}

		return $output;
	}

	/**
	 *
	 * @return mixed
	 */
	public static function getUsDomain()
    {
		$root = str_replace(
					array('/index.php', '', '/'),
					array(null, null, null),
					$_SERVER['PHP_SELF']
		);

		return $root;
	}

	/**
	 *
	 * @return mixed
	 */
	public static function getDomain()
    {
		$uri = $_SERVER['REQUEST_URI'];
	    $query = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
	    $root = str_replace('/index.php', '', $_SERVER['PHP_SELF']);

	    // Url de redirection
	    $redirect_url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : null;

	    if(!empty($redirect_url) && !empty($root)){
	    	$redirect_url = explode($root, $redirect_url);
	    	$redirect_url = $redirect_url[1];
	    }

	    /*
	     * On set le domaine
	     */
	    $url = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https' : 'http') . ':#' . $_SERVER['HTTP_HOST'] . $uri . '/';
	    $url = str_replace(
	    			array('?'. $query, $redirect_url, '//', ':#'),
	    			array(null, null, '/', '://'),
	    			$url
	    );

		return  $url;
	}
}