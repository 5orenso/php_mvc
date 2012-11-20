<?php 
//namespace CMS;
/**
 * This file handles the retrieval and serving of news articles
 * Build as Singelton class
 *
 * Typical usage:
 *   $db = Tools::db_connect();
 * @author Oistein Sorensen <sorenso@gmail.com>
 * @version 1.0
 */
class Tools {

	/**
	* Instance of the database class
	* @static Database $instance
	*/
	private static $instance;
	/**
	* Database connection
	* @access private
	* @var PDO $connection
	*/
	private static $connection;


	private function __construct (array $opt) {
		Tools::log(__FILE__.' '.(__NAMESPACE__ ? __NAMESPACE__.'::' : '')
			 .(__CLASS__ ? __CLASS__ : 'noclass').'->'
			 .' [ob_level='.ob_get_level().'] '
			 .__FUNCTION__.'()'.' #'.__LINE__);
		$this->opt = $opt;
	}

	public function __destruct () {

	}


	/**
	* Gets an instance of the Database class width the PostgreSQL driver.
	*
	* @static
	* @return Database An instance of the database singleton class.
	*/
	public static function db_connect_postgresql (array $opt) {
		if (empty(self::$connection)) {
			self::$connection = pg_pconnect(
				'host='    .self::coalesce($opt, 'host', NULL).' '.
				'dbname='  .self::coalesce($opt, 'db',   NULL).' '.
				'user='    .self::coalesce($opt, 'user', NULL).' '.
				'password='.self::coalesce($opt, 'pwd',  NULL).' '.
				'port='    .self::coalesce($opt, 'port',  NULL).' '
			) or die ("Could not connect to server\n");
		}
		return self::$connection;
	}

	/**
	* Gets an instance of the Database class with the MySQLi driver
	*
	* @static
	* @return Database An instance of the database singleton class.
	*/
	public static function db_connect_mysqli (array $opt) {
		if (empty(self::$connection)) {
			self::$connection = new mysqli(
				Tools::coalesce($opt, 'host', NULL),
				Tools::coalesce($opt, 'user', NULL),
				Tools::coalesce($opt, 'pwd', NULL),
				Tools::coalesce($opt, 'db', NULL),
				Tools::coalesce($opt, 'port', NULL),
				Tools::coalesce($opt, 'socket', NULL)
			);
		}
		return self::$connection;
	}

	/**
	* Gets an instance of the Database class with the MySQLi driver
	*
	* @static
	* @return Database An instance of the database singleton class.
	*/
	public static function db_connect_mongodb (array $opt) {
		if (empty(self::$connection)) {
			$m = new Mongo(
				"mongodb://".
				Tools::coalesce($opt, 'host', NULL).':'.
				Tools::coalesce($opt, 'port', NULL),
				array(
					'persist' => 32
				)); // array("replicaSet" => "cluster"));
			//$db->authenticate("my_login", "my_password");
			self::$connection = $m->selectDB(Tools::coalesce($opt, 'db',   NULL));
		}
		return self::$connection;
	}



	/*
	 * Coalesce function like in SQL.
	 * Check if $array[$key] is defined.
	 * If true return the value.
	 * If not return $default
	 */
	public function coalesce ($array, $key, $default) {
		return isset($array[$key]) ? $array[$key] : $default;
	}

	/*
	 * Parse ini files with APC cache
	 */
	public function parse_ini_file_ext ($file, $sections = null) {
		ob_start();
		include $file;
		$str = ob_get_contents();
		ob_end_clean();
		return parse_ini_string($str, $sections);
	}

	/*
	 * Helper function like Perl. 
	 * Used for debugging.
	 */
	public function dumper ($var) {
		//echo Tools::timestamp();
		//echo ' : <b>';
		//print_r($var);
		//echo '</b><br>';
	}

	/* 
	 * A sensible log function. 
	 * TODO: Configure this to log to other places than stdout.
	 */
	public function log ($var) {
		//echo Tools::timestamp();
		//echo ' : ';
		//echo($var);
		//echo '<br>';
	}

	/* 
	 * Just a function to create a standard timestamp.
	 * Don't invent your own timestamp format!
	 */
	function timestamp () {
		return date("Y-m-d\TH:i:s") . substr((string)microtime(), 1, 8);
	}

	/*
	 * Call external rest API.
	 */
	function call_rest_api($method, $url, $data = false) {
		$curl = curl_init();

		switch ($method) {
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);
				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "PUT":
				curl_setopt($curl, CURLOPT_PUT, 1);
				break;
			default:
				if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		}

		// Optional Authentication:
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "username:password");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		return curl_exec($curl);
	}




}