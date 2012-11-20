<?php 
/**
 * This file handles the retrieval and serving of news articles
 * @author Oistein Sorensen <sorenso@gmail.com>
 * @version 1.0
 */
class News_Controller {

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
	 * This is the default function that will be called by router.php
	 * 
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main(array $opt) {
		$newsModel = new News_Model($this->opt);

		// Get news from a REST API
		$rest_api_url = $this->opt['rest_api']['proto'].'://'.
						$this->opt['rest_api']['host'].':'.
						$this->opt['rest_api']['port'].
						'/api/article/get/'.$opt['id'].'?'.
						'limit='.$opt['limit'].
						'&offset='.$opt['offset'].
						'&sort='.$opt['sort'];

		$json_env_str = Tools::call_rest_api('GET', $rest_api_url);
		$env = json_decode($json_env_str, 1);
		
		// get an article
		$article = $newsModel->get_article(array(
			'eq' => array(         // equals
				'author' => $opt['author'],
				'title'  => $opt['title'],
			),
			'gt' => array(),       // greater than
			'lt' => array(),       // less than
			're' => array(),       // regexp match
			'overlaps' => array(), // data overlaps
			// TODO : Add more optins.

			'limit'  => 1,
		));

		$artlist = $newsModel->get_article(array(
			'eq' => array(
				'author' => $opt['author'],
			),
			'limit'  => 10,
		));
		
		// create a new view with class name of this controller.
		$view = new View_Model($this->opt, __CLASS__);
		// echo "News_Controller->main() View_Model($this->template)";
	
		// assign article data to view
		$view->assign(array(
							'article' => $article,
							'artlist' => $artlist,
							'env'     => $env
						   ));

		//echo 'News_Controller->main();';
		//$view->render();
	}
}
