<?php

class Files {

	/**
	 *
	 * @param unknown $file
	 * @param unknown $tag
	 * @param unknown $params
	 * @return Ambigous <NULL, array>
	 */
	public static function search_datas_to_xml($file, $tag, $params=array('id', 'code')){
		$output=null;

		if(!empty($tag) && !empty($file)){
			try{
				$elements = simplexml_load_file($file);

				foreach($elements as $value) {
					$value = (Array)$value;

					// Atributs
					$id = $value['@attributes'][$params[0]];
					$code = $value['@attributes'][$params[1]];

					unset($value['@attributes']);

					if($tag===$id){
						$output = $value;
						break;
					}
				}
			}
			catch(Exception $e){}
		}

		return $output;
	}

	public static function read_all_files($root = '.', $specify = null, $type = 1, $ignore = array('.', '..', 'actions', 'templates_c', 'index.php')) {
		$output = null;
		$files = array('files' => array(), 'dirs' => array());
		$directories = array();
		$last_letter = $root[strlen($root) - 1];
		$root = ($last_letter == '\\' || $last_letter == '/') ? $root : $root . DIRECTORY_SEPARATOR;

		$directories[] = $root;

		while (sizeof($directories)) {
			$dir = array_pop($directories);

			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					if (in_array($file, $ignore)) {
						continue;
					}
                    $file = $dir . $file;

					if (is_dir($file)) {
						$directory_path = $file . DIRECTORY_SEPARATOR;
						array_push($directories, $directory_path);
						$files['dirs'][] = $directory_path;
					}
					elseif (is_file($file)) {
						if (!empty($specify)) {
							if (preg_match("/{$specify}/i", $file)) {
								$files['files'][] = substr($file, strrpos($file, "\\") + 1);
							}
						}
						else
							$files['files'][] = $file;
					}
				}
				closedir($handle);
			}

			switch ($type) {
				case 1: default:
					$output = $files['files'];
				break;
				case 2:
					$output = $files['dirs'];
				break;
			}
		}

		return $output;
	}

	public static function zf_loadAllController(){
		$files = self::read_all_files('application/controllers/');

		if(!empty($files) && is_array($files)){
			foreach ($files as $file){
				if(file_exists($file)){
					require_once ($file);
				}
			}
		}
	}

	public static function generated_LESS_to_CSS(){
        $output = array(
                    'less' => null,
                    'css' => null
        );

	    foreach (self::read_all_files('medias/less/') as $key=>$less_file){
	        $less_file = str_replace('\\', '/', $less_file);
            $css_file = str_replace(array('/less/', '.less'), array('/css/', '.css'), $less_file);
            $dir_css_file = substr($css_file, 0, strrpos($css_file, '/')+1);

            $output['less'][] = $less_file;
            $output['css'][] = $css_file;

            if(!file_exists($css_file)){
                if(!is_dir($dir_css_file)){
                    mkdir($dir_css_file);
                }

                file_put_contents($css_file, null);
            }
        }

        return $output;
    }
}