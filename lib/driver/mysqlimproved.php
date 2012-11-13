<?php
/**
 * The MySQL Improved driver extends the Database_Library to provide 
 * interaction with a MySQL database
 * @author Oistein Sorensen <sorenso@gmail.com>
 * @version 1.0
 */
class MysqlImproved_Driver extends Database {
	// Holds the input opt when __construct had been called.
	private $opt;
	// Connection holds MySQLi resource
	private $connection;
	// Query to perform
	private $query;
	// Result holds data retrieved from server
	private $result = array();
	// Database table or collection to bind to.
	private $table;
	

	public function __construct (array $opt) {
		Tools::log(__FILE__.' '.(__NAMESPACE__ ? __NAMESPACE__.'::' : '')
		     .(__CLASS__ ? __CLASS__ : 'noclass').'->'
		     .' [ob_level='.ob_get_level().'] '
		     .__FUNCTION__.'()'.' #'.__LINE__);
		$this->opt = $opt;
	}

	public function __destruct () {

	}
	
	/**
	 * Create new connection to database
	 */ 
	public function connect () {
		if (empty($this->connection)) {
			//$this->log(__FILE__.' : ');
			//$this->dumper($this->opt);
		
			//create new mysqli connection
			$this->connection = Tools::db_connect_mysqli($this->opt);
		}
		return TRUE;
	}

	/**
	 * Break connection to database
	 */
	public function disconnect () {
		//clean up connection!
		$this->connection->close();	
		
		return TRUE;
	}
	
	/**
	 * Prepare query to execute
	 * 
	 * @param $query
	 */
	public function prepare ($query, $table) {
		// Store table/collection in this class.
		$this->table = $table;
		// store query in this class.
		$this->query = $query;	
		return TRUE;
	}
	
	/**
	 * Sanitize data to be used in a query
	 * 
	 * @param $data
	 */
	public function escape ($data) {
		return $this->connection->real_escape_string($data);
	}
	
	/**
	 * Execute a prepared query
	 */
	public function query ($limit) {
		if (isset($this->query)) {
			// execute prepared query and store in result variable
			$result = $this->connection->query($this->query);
			// parse results and store into array $this->result
			while ($row = $result->fetch_object()) {
				array_push($this->result, $row);
			}
			return TRUE;
		}
		return FALSE;		
	}
	
	/**
	 * Fetch a row from the query result
	 * 
	 * @param $type
	 */
	public function fetch ($type = 'object') {
		if (isset($this->result)) {
			switch ($type) {
				case 'array':
					return $this->result;
					break;
				
				case 'object':
					return array_shift($this->result);
					break;
				
				default:
					break;
			}	
		}		
		return FALSE;
	}

}