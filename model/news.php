<?php
//include_once(SERVER_ROOT.'/lib/tools.php');
//namespace CMS;
/**
 * The News Model does the back-end heavy lifting for the News Controller
 */
class News_Model {
	/**
	 * Holds instance of database connection
	 */
	private $db;

	/* 
	 * Holds the input opt when __construct had been called.
	 */
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
			$this->db = new Postgresql_Driver($this->opt['postgresql']);

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
	public function get_article($author) {		
		//connect to database
		$this->db->connect();
		

		if ($this->opt['database']['driver'] == 'mongodb') {
			$article = $this->db->find('articles', array(
			               	 				 		 'author' => $author
			                						));

		} else {
			//sanitize data
			$author = $this->db->escape($author);
		
			//prepare query
			$this->db->prepare(
							   "
			SELECT
				date,
				title,
				content,
				author
			FROM
				articles
			WHERE
				author = '$author'
			LIMIT
				1
			;
			                   ");
		
			//execute query
			$this->db->query();
		
			$article = $this->db->fetch('array');
			// echo '<b>';
			// print_r($article);
			// echo '</b><br>';
		}
		
		return $article;
	}
	
}
