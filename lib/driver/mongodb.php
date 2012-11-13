<?php
/**
 * The MySQL Improved driver extends the Database_Library to provide 
 * interaction with a MySQL database
 * @author Oistein Sorensen <sorenso@gmail.com>
 * @version 1.0
 */
class Mongodb_Driver extends Database {
	// Holds the input opt when __construct had been called.
	private $opt;
	// Connection holds MySQLi resource
	private $connection;
	// Collection holds MongoDB collection
	private $collection;
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
		//$this->log(__FILE__.' : ');
		//$this->dumper($this->opt);
		
		if (empty($this->connection)) {
			//create new mongo connection
			$this->connection = Tools::db_connect_mongodb($this->opt);
		}
		return TRUE;
	}

	/**
	 * Break connection to database
	 */
	public function disconnect () {
		//clean up connection!
		//pg_close($this->connection);
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
		//return pg_escape_string($data);
		return $data;
	}
	
	/**
	 * Execute a prepared query
	 */
	public function query ($limit) {
		if (isset($this->query)) {
			// select collection
			$this->collection = $this->connection->selectCollection($this->table);
			// execute query
			$mongodb_cursor = $this->collection->find($this->query)->limit($limit);
			// parse results and store into array $this->result
			foreach ($mongodb_cursor as $doc) {
				array_push($this->result, $doc);
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
					//fetch a row as array
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