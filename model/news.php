<?php
include_once(SERVER_ROOT.'/lib/tools.php');
//namespace CMS;
/**
 * The News Model does the back-end heavy lifting for the News Controller
 */
class News_Model {
	/**
	 * Holds instance of database connection
	 */
	private $db;
		
	public function __construct ($opt) {
		Tools::log(__FILE__.' '.(__NAMESPACE__ ? __NAMESPACE__.'\\' : '')
		     .(__CLASS__ ? __CLASS__ : 'noclass').'->'
		     .' [ob_level='.ob_get_level().'] '
		     .__FUNCTION__.'()'.' #'.__LINE__);
		
		if ($opt['database']['driver'] == 'mysql') {
			$this->db = new MysqlImproved_Driver($opt['mysql']);
		} elseif ($opt['database']['driver'] == 'mysql') {
			// $this->db = new MysqlImproved_Driver($opt['mysql']);

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
		
		//sanitize data
		$author = $this->db->escape($author);
		
		//prepare query
		$this->db->prepare(
			"
			SELECT
				`date`,
				`title`,
				`content`,
				`author`
			FROM
				`articles`
			WHERE
				`author` = '$author'
			LIMIT
				1
			;
			"
		);
		
		//execute query
		$this->db->query();
		
		$article = $this->db->fetch('array');
		
		return $article;
	}
	
}
