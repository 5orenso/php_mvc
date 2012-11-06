<?php 
namespace CMS;
/**
 * This file handles the retrieval and serving of news articles
 */
class News_Controller {
	public function __construct () {
		echo __FILE__.' '.(__NAMESPACE__ ? __NAMESPACE__.'::' : '')
		     .(__CLASS__ ? __CLASS__ : 'noclass').'->'
		     .__FUNCTION__.'('.$className.')'.' #'.__LINE__."<br>";
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
		$newsModel = new News_Model;
		
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
