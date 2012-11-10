<?php
/**
 * The MySQL Improved driver extends the Database_Library to provide 
 * interaction with a MySQL database
 */
class Mongodb_Driver extends Database {
	/* 
	 * Holds the input opt when __construct had been called.
	 */
	private $opt;

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
	 * Connection holds MySQLi resource
	 */
	private $connection;
	/**
	 * Collection holds MongoDB collection
	 */
	private $collection;
	
	/**
	 * Query to perform
	 */
	private $query;
	
	/**
	 * Result holds data retrieved from server
	 */
	private $result;
	
	/**
	 * Create new connection to database
	 */ 
	public function connect () {
		$this->log(__FILE__.' : ');
		$this->dumper($this->opt);
		
		//create new mongo connection
		$m = new Mongo(
		               "mongodb://".
		               $this->coalesce($this->opt, 'host', NULL).':'.
		               $this->coalesce($this->opt, 'port', NULL)
		              ); // array("replicaSet" => "cluster"));
		// var_dump($m);
  		$this->connection = $m->selectDB($this->coalesce($this->opt, 'db',   NULL));
		//$db->authenticate("my_login", "my_password");
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
	public function prepare ($query) {
		//store query in query variable
		//$this->query = $query;	
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
	public function query () {
		return FALSE;		
	}
	
	/**
	 * Fetch a row from the query result
	 * 
	 * @param $type
	 */
	public function fetch ($type = 'object') {		
		return FALSE;
	}


	public function find ($collection, array $filter) {
		$this->collection = $this->connection->selectCollection($collection);
		print_r($filter);
		$this->result = $this->collection->find($filter);
		foreach ($this->result as $doc) {
			print_r($doc);
			return $doc;
		}

	}

}