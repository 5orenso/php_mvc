<?php 
//namespace CMS;
/**
 * This file handles the retrieval and serving of news articles
 */
class Tools {

	public $opt;

	public function __construct ($opt) {
		Tools::log(__FILE__.' '.(__NAMESPACE__ ? __NAMESPACE__.'::' : '')
		     .(__CLASS__ ? __CLASS__ : 'noclass').'->'
		     .' [ob_level='.ob_get_level().'] '
		     .__FUNCTION__.'()'.' #'.__LINE__);
		$this->opt = $opt;
	}


	public function __destruct () {

	}


	public function coalesce ($array, $key, $default) {
		return isset($array[$key]) ? $array[$key] : $default;
	}


	// Parse ini files with APC cache
	public function parse_ini_file_ext ($file, $sections = null) {
	    ob_start();
    	include $file;
	    $str = ob_get_contents();
	    ob_end_clean();
	    return parse_ini_string($str, $sections);
	}


	public function dumper ($var) {
		echo Tools::timestamp();
		echo ' : <b>';
		print_r($var);
		echo '</b><br>';
	}


	public function log ($var) {
		echo Tools::timestamp();
		echo ' : ';
		echo($var);
		echo '<br>';
	}


	function timestamp () {
        return date("Y-m-d\TH:i:s") . substr((string)microtime(), 1, 8);
	}


}