<?php

class Vars {
	
	public $datas_format;

    private $get_ajax;
	
	
	public function __construct() {
	
		/*
		 * Données utiles
		 */
		
		$get_datas_format = Pages::getParam_path('datas_format', 'get');

		$this->datas_format = ($get_datas_format=='xml') ? 'xml' : 'json'; // Format des données à retourner

        $this->get_ajax = Pages::getParam_path('get_ajax', 'get');
	}
	
	/**
	 *
	 * @param unknown $name
	 * @return Ambigous <NULL, unknown>
	 */
	public static function getGlobalsDataValue($name){
		$output=null;
		 
		if(!empty($name)){
			$output = !empty(Zend_Registry::isRegistered($name)) ? Zend_Registry::get($name) : null;
		}
		 
		return $output;
	}
	
	/**
	 * 
	 * @param number $length
	 * @return string
	 */
	public static function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		
		return $randomString;
	}
	
	public static function formatWebText($val){
		$output=false;
		
		if(!empty($val)){
			$output = str_replace('~P~', '%', $val);
			$output = str_replace('\n', '<br/>', urldecode($output));
		}
		
		return $output;
	}

	public static function formatCustomerName_cars_infos($name=null, $surname=null){
        $output=null;
        $tmpAnd=0;

        if(!empty($name)){
            $output .= "AND LCASE(NOMCONDUC) like(LCASE('%{$name}%'))";
            $tmpAnd=1;
        }
        if(!empty($surname)){
            if($tmpAnd==1){
                $output .= " AND ";
            }

            $output .= "LCASE(PRENOMCOND) like(LCASE('%{$surname}%'))";
        }

        return $output;
    }
	
	public static function isJSON($string){
		return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
	}
	
	public static function formatControllerName($controller_name){
		$output=null;
	
		if(!empty($controller_name)){
			$output = ucwords($controller_name);
		}
	
		return $output;
	}
	
	public static function formatActionName($action_name){
		$output=null;
		
		if(!empty($action_name)){
			$action_name = str_replace('-', ' ', $action_name);
			$output = str_replace(' ', '', ucwords($action_name));
		}
		
		return $output;
	}

    /**
     * @param $controller_action
     * @return array
     */
	public static function getControllerAction($controller_action){
        $output = array(
                       'controller' => null,
                       'action' => null,
                       'attributs' => false
        );

	    if(!empty($controller_action) && (is_array($controller_action) && count($controller_action)==2)){
            // Controlleur
            $controller_name = self::formatControllerName($controller_action[0]);
            // Action
            $action_name = self::formatActionName($controller_action[1]);

            $output = array(
                        'controller' => $controller_name,
                        'action' => $action_name,
                        'attributs' => true
            );
        }

        return $output;
    }

    /**
     * @param $array
     * @param null $controller_action
     * @param null $primary_node
     * @param null $rootElement
     * @param null $xml
     * @return mixed|null
     */
	public static function arrayToXml($array, $controller_action = null, $primary_node = null, $rootElement = null,  $xml = null) {
		$output=null;
		
		$_xml = $xml;
		
		if ($_xml === null) {
			$_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<document/>');
		}

        $names_controller_action = self::getControllerAction($controller_action);

		if(!empty($names_controller_action['attributs'])){
			// Controlleur 
			$controller_name = $names_controller_action['controller'];
			// Action
			$action_name = $names_controller_action['action'];
			
			$_xml->addAttribute('context', "{$controller_name}::{$action_name}");
			$_xml->addAttribute('controller', $controller_name);
			$_xml->addAttribute('action', $action_name);
		}
		
		if(!empty($primary_node)){
			if(is_array($primary_node)){
				// Attributs
				$attributs_node = !empty($primary_node['attributs']) ? $primary_node['attributs'] : null;
				// Noeud
				$primary_node = !empty($primary_node['name']) ? $primary_node['name'] : null;
			}
			else
				$primary_node = self::formatActionName($primary_node);
		}
		
		if(!empty($array) && ( is_object($array) || is_array($array) )) {
			// On construit le noeud principal
			$primary_node = !empty($primary_node) ? $_xml->addChild($primary_node) : $_xml;
			
			if(!empty($attributs_node) && is_array($attributs_node)){
				foreach (array_keys($attributs_node) as $keys_attributs=>$values_attributs){
					$primary_node->addAttribute($values_attributs, $attributs_node[$values_attributs]);
				}
			}
			
			foreach ($array as $key => $value) {
				if (is_array($value)) {
				    $name_primary_node = !empty($controller_action) ? $controller_action : $key;
					/*
					 * On insère les données
					 */
					$node  = $primary_node->addChild($name_primary_node);
					$nodes = $node->getName($key);
					
					foreach ($value as $us_key=> $us_value){
						$us_value = (is_object($us_value)==true) ? (Array)$us_value : $us_value;
						
						if(is_array($us_value)){
							
							if(count($node->children())>0){
								$node  = $primary_node->addChild($key);
								$nodes = $node->getName($key);
							}
							
							foreach ($us_value as $final_key=>$final_value){
								$node->addChild($final_key, htmlspecialchars($final_value));
							}
						}
						else {
							$node->addChild($us_key, htmlspecialchars($us_value));
						}
					}
					
				} else {
                    $value = is_object($value) ? null : $value;

					$primary_node->addChild($key, htmlspecialchars($value));
				}
			}
			
			header('Content-Type: application/xml');
			
			$output = $_xml->asXML();
		}
		
		print($output);
		exit(0);
	}

    /**
     * @param $datas
     * @param null $controller_action
     * @param null $primary_node
     * @param string $rootElement
     * @return null|string
     */
	public function formatDatasJson($datas, $controller_action = null, $primary_node = null, $header = true, $rootElement = 'document'){
        $output=null;

        /*
         * Controleur & Action
         */
        $names_controller_action = self::getControllerAction($controller_action);
        $controller_name = $names_controller_action['controller'];
        $action_name = $names_controller_action['action'];

	    if(!empty($datas)){
	        if(empty($this->get_ajax)){
                header('Content-Type: application/json; charset=utf-8');
            }

            // On vérifie le format de la données
            $is_json = self::isJSON($datas);
            $datas = ($is_json==true) ? (Array)json_decode($datas) : (Array)$datas;

            if(!empty($names_controller_action['attributs'])){
                if(!empty($primary_node)){
                    if(is_array($primary_node)){
                        // Attributs
                        $attributs_node = !empty($primary_node['attributs']) ? $primary_node['attributs'] : null;
                        // Noeud
                        $primary_node = !empty($primary_node['name']) ? $primary_node['name'] : null;

                        $output[$rootElement][$primary_node] = $datas;

                        if(!empty($attributs_node) && is_array($attributs_node)){
                            foreach (array_keys($attributs_node) as $keys_attributs=>$values_attributs){
                                $output[$rootElement]['attr'][$values_attributs] = $attributs_node[$values_attributs];
                            }
                        }
                    }
                    else
                        $output[$rootElement][$action_name] = $datas;
                }
                else{
                    $output[$rootElement] = $datas;
                }

                $output[$rootElement]['attr']['controller'] = $controller_name;
                $output[$rootElement]['attr']['action'] = $action_name;
            }
            else{
                $output[$rootElement] = $datas;
            }

            $output = json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

        return $output;
    }
	
	public function MVC_format_datas($datas = null, $controller_action = null, $primary_node = null, $header = true){
		$output=null;
		
		$is_json = self::isJSON($datas);
		
		switch ($this->datas_format){
			case 'json':
				$output = self::formatDatasJson($datas, $controller_action, $primary_node, $header);
			break;
			case 'xml': default:
				$datas = ($is_json==true) ? json_decode($datas): $datas;
				
				$output = self::arrayToXml($datas, $controller_action, $primary_node);
			break;
		}
		
		return $output;
	}
}

?>