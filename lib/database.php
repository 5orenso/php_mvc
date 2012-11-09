<?php
//include_once(SERVER_ROOT.'/lib/tools.php');
/**
 * The Database Library handles database interaction for the application
 */
abstract class Database extends Tools {
	abstract protected function connect();
	abstract protected function disconnect();
	abstract protected function prepare($query);
	abstract protected function query();
	abstract protected function fetch($type = 'object');	
}