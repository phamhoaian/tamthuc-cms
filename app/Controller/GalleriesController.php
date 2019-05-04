<?php 
App::uses('AppController', 'Controller');

class GalleriesController extends AppController {

	public $uses = array('Gallery', 'NewsCategory');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
	}

	public function index()
	{
		// get all galleries
		$page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
		$this->paginate = array(
			'conditions' => array('Gallery.status_cd' => STATUS_PUBLIC),
			'limit' => GALLERY_LIMIT,
			'page' => 1,
			'order' => array('created' => 'desc'),
			'paramType' => 'querystring',
		);

		$galleries = $this->paginate('Gallery');
		$this->set(compact('galleries', 'page'));

		$pagination = ceil(count($galleries) / GALLERY_LIMIT);
		$this->set(compact('pagination'));

		// get all news categories
		$news_categories = $this->NewsCategory->getAllNewsCategory();
		$this->set(compact('news_categories'));
	}
}