<?php
/**
 * The Database Library handles database interaction for the application
 */
abstract class Database_Lib
{
	public function __construct () {
		echo "Database_Lib->__construct()<br>";
	}

	public function __destruct () {

	}
	abstract protected function connect();
	abstract protected function disconnect();
	abstract protected function prepare($query);
	abstract protected function query();
	abstract protected function fetch($type = 'object');	
}