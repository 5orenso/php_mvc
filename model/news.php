<?php
/**
 * The News Model does the back-end heavy lifting for the News Controller
 * @author Oistein Sorensen <sorenso@gmail.com>
 * @version 1.0
 */
class News_Model {
	// Holds instance of database connection
	private $db;
	// Holds the input opt when __construct had been called.
	private $opt;

		
	public function __construct (array $opt) {
		Tools::log(__FILE__.' '.(__NAMESPACE__ ? __NAMESPACE__.'\\' : '')
			 .(__CLASS__ ? __CLASS__ : 'noclass').'->'
			 .' [ob_level='.ob_get_level().'] '
			 .__FUNCTION__.'()'.' #'.__LINE__);

		$this->opt = $opt;

		if ($this->opt['database']['driver'] == 'mysql') {
			$this->db = new MysqlImproved_Driver($this->opt['mysql']);

		} elseif ($this->opt['database']['driver'] == 'postgresql') {
			$this->db = new Postgresql_Driver($this->opt['postgresql'], $db);

		} elseif ($this->opt['database']['driver'] == 'rest_api') {
			// $this->db = new MysqlImproved_Driver($opt['mysql']);

		} elseif ($this->opt['database']['driver'] == 'mongodb') {
			$this->db = new Mongodb_Driver($this->opt['mongodb']);

		}
	}

	public function __destruct () {

	}	
	
	/**
	 * Fetches article based on supplied name
	 * 
	 * @param string $author
	 * 
	 * @return array $article
	 */
	public function get_article (array $opt) {		
		// connect to database
		$this->db->connect();

		if ($this->opt['database']['driver'] == 'mongodb') {
			// MongoDB
			$this->db->prepare(array(
									 'author' => $opt['author'],
									 'title'  => 'test title',

									), 'articles', $opt['limit']);
			$this->db->query($opt['limit']);
			$article = $this->db->fetch('object');

		} else {
			// MySQL, PostgreSQL
			// prepare query
			// TODO: Move this to a generic database class or a driver specific.
			$this->db->prepare($opt, 'articles', $opt['limit']);

			// execute query
			$this->db->query($opt['limit']);
			$article = $this->db->fetch($opt['limit'] > 1 ? 'array' : 'object');
			//var_dump($article);
		}
		
		return $article;
	}

}
