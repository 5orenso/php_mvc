<?php 
//namespace CMS;
include_once(SERVER_ROOT.'/lib/tools.php');
/**
 * This file handles the retrieval and serving of news articles
 */
class News_Controller extends Tools {

	public $opt;

	public function __construct ($opt) {
		Tools::log(__FILE__.' '.(__NAMESPACE__ ? __NAMESPACE__.'::' : '')
		     .(__CLASS__ ? __CLASS__ : 'noclass').'->'
		     .' [ob_level='.ob_get_level().'] '
		     .__FUNCTION__.'()'.' #'.__LINE__);

		$this->opt = $opt;
	}

	public function __destruct () {

	}

	/**
	 * This template variable will hold the 'view' portion of our MVC for this 
	 * controller
	 */
	public $template = 'news.html';
	
	/**
	 * This is the default function that will be called by router.php
	 * 
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main(array $getVars) {
		$newsModel = new News_Model($this->opt);
		
		// get an article
		$article = $newsModel->get_article($getVars['author']);
		
		// create a new view and pass it our template
		$view = new View_Model($this->template);
		// echo "News_Controller->main() View_Model($this->template)";
	
		//assign article data to view
		$view->assign('article' , $article);

		//echo 'News_Controller->main();';
		//$view->render();
	}
}
