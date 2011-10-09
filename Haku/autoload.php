<?php
namespace Haku;

/**
 * Autoloader
 *
 * @author	Steven Ellis
 * @package	Backstage CMS
 */
class Autoloader {

	/**
	 * Constructor for Autoloader
	 * 
	 */
	public function __construct() {
		spl_autoload_register(array($this, 'loadClass'));
	}

	/**
	 * Load class
	 * 
	 * @param mixed $className Class name
	 */
	private function loadClass( $className ) {
		$fullClassPath = dirname(__file__)."/../".str_replace("\\", "/", $className).".php";
		if(file_exists($fullClassPath)){
			require_once $fullClassPath;
		}
	}

}

$hakuAutoLoader = new Autoloader();
?>