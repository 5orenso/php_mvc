<?php
/**
 * The MySQL Improved driver extends the Database_Library to provide 
 * interaction with a MySQL database
 */
class Postgresql_Driver extends Database {
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
		
		//create new postgresql connection
		$this->connection = pg_connect(
		                  				'host='    .$this->coalesce($this->opt, 'host', NULL).' '.
		                  				'dbname='  .$this->coalesce($this->opt, 'db',   NULL).' '.
		                  				'user='    .$this->coalesce($this->opt, 'user', NULL).' '.
		                  				'password='.$this->coalesce($this->opt, 'pwd',  NULL).' '.
		                  				'port='    .$this->coalesce($this->opt, 'port',  NULL).' '
		                  			  ) or die ("Could not connect to server\n");
		
		return TRUE;
	}

	/**
	 * Break connection to database
	 */
	public function disconnect () {
		//clean up connection!
		pg_close($this->connection);
		return TRUE;
	}
	
	/**
	 * Prepare query to execute
	 * 
	 * @param $query
	 */
	public function prepare ($query) {
		//store query in query variable
		$this->query = $query;	
		return TRUE;
	}
	
	/**
	 * Sanitize data to be used in a query
	 * 
	 * @param $data
	 */
	public function escape ($data) {
		return pg_escape_string($data);
	}
	
	/**
	 * Execute a prepared query
	 */
	public function query () {
		if (isset($this->query)) {
			//execute prepared query and store in result variable
			$this->result = pg_query($this->connection, $this->query) or die("Cannot execute query: $query\n");		
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
					$row = pg_fetch_assoc($this->result);
					break;
				
				case 'object':				
					//fall through...
				
				default:				
					//fetch a row as object
					$row = pg_fetch_object($this->result);
					break;
			}
			
			return $row;
		}
		
		return FALSE;
	}
}