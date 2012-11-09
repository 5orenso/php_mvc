<?php 
//namespace CMS;
//include_once(SERVER_ROOT.'/lib/tools.php');
/**
 * This file handles the retrieval and serving of news articles
 */
class News_Controller extends Tools {

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
	public function main(array $getVars) {
		$newsModel = new News_Model($this->opt);

		//$json_env_str = $this->call_rest_api('GET', 'http://dev.zu.no/php_mvc/env.php');
		//$env = json_decode($json_env_str, 1);
		
		// get an article
		$article = $newsModel->get_article($getVars['author']);
		
		// create a new view with class name of this controller.
		$view = new View_Model($this->opt, __CLASS__);
		// echo "News_Controller->main() View_Model($this->template)";
	
		// assign article data to view
		$view->assign(array(
		              	    'article' => $article,
		              	    'env'     => $env
		              	   ));

		//echo 'News_Controller->main();';
		//$view->render();
	}
}
