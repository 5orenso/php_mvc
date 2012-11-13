<?php
/**
 * The Database Library handles database interaction for the application
 * @author Oistein Sorensen <sorenso@gmail.com>
 * @version 1.0
 */
abstract class Database {
	abstract protected function connect();
	abstract protected function disconnect();
	abstract protected function prepare(array $query, $table, $limit);
	abstract protected function query($limit);
	abstract protected function fetch($type = 'object');	
}