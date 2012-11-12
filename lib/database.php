<?php
//include_once(SERVER_ROOT.'/lib/tools.php');
/**
 * The Database Library handles database interaction for the application
 */
abstract class Database {
	abstract protected function connect();
	abstract protected function disconnect();
	abstract protected function prepare($query, $table);
	abstract protected function query($limit);
	abstract protected function fetch($type = 'object');	
}