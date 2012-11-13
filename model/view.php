<?php
/**
 * Handles the view functionality of our MVC framework
 * @author Oistein Sorensen <sorenso@gmail.com>
 * @version 1.0
 */
class View_Model {
	/* 
	 * Holds the input opt when __construct had been called.
	 */
	private $opt;
	/**
	 * Holds variables assigned to template
	 */
	private $data = array();

	/**
	 * Holds render status of view.
	 */
	private $render = FALSE;

	/**
	 * Accept a template to load
	 * @param array $opt Options for this function as an assoc array.
	 * @param string $controller_class Name of caller class.
	 * @return boolean
	 */
	public function __construct (array $opt, $controller_class) {
		Tools::log(__FILE__.' '.(__NAMESPACE__ ? __NAMESPACE__.'::' : '')
			 .(__CLASS__ ? __CLASS__ : 'noclass').'->'
			 .' [ob_level='.ob_get_level().'] '
			 .__FUNCTION__.'('.$controller_class.')'.' #'.__LINE__);

		$this->opt = $opt;

		//compose file name
		$class_name = explode('_', strtolower($controller_class));
		$template = $opt['template'][$class_name[0]];
		Tools::log(implode(', ', $class_name).' :: '.$template);
		$file = SERVER_ROOT.'/view/'.$template;
		//echo "View_Model->__construct() [ $file ]";
		if (file_exists($file)) {
			/**
			 * trigger render to include file when this model is destroyed
			 * if we render it now, we wouldn't be able to assign variables
			 * to the view!
			 */
			//$this->render = $file;
			$this->render = strtolower($template);
			//echo "View_Model->__construct() : $template";
			//echo "View_Model->__construct() [ $file ]";
			return TRUE;
		}
		return FALSE;
	}

	public function __destruct () {
		$this->render();
		$end_time = microtime(TRUE);
		echo $end_time - START_TIME;
	}

	/**
	 * Receives assignments from controller and stores in local data array
	 * 
	 * @param $variable
	 * @param $value
	 */
	//public function assign ($variable, $value) {
	public function assign ($data) {
		$this->data = $data;
		//$this->data[$variable] = $value;
		//echo 'View_Model->assign();';
	}

	/**
	 * Render the output directly to the page, or optionally, return the
	 * generated output to caller.
	 * 
	 * @param $direct_output Set to any non-TRUE value to have the 
	 * output returned rather than displayed directly.
	 */
	public function render ($direct_output = TRUE) {
		// Use Twig as template engine.
		require_once '/var/www/lib/Twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem(SERVER_ROOT.'/view');
		$twig = new Twig_Environment($loader, array(
			'cache' => SERVER_ROOT.'/view_cache',
			'auto_reload' => 1
		));

		// Turn output buffering on, capturing all output
		if ($direct_output !== TRUE) {
			ob_start();
		}
	
		// Render template with Twig engine.
		// echo $this->data['article']['title'];
		echo $twig->render($this->render, $this->data);
		
		// Get the contents of the buffer and return it
		if ($direct_output !== TRUE) {
			return ob_get_clean();
		}
	}


}
