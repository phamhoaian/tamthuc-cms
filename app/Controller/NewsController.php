<?php 
App::uses('AppController', 'Controller');

class NewsController extends AppController {

	public $uses = array('News', 'NewsCategory');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'detail'));

		// get all news categories
		$news_categories = $this->NewsCategory->getAllNewsCategory();
		$this->set(compact('news_categories'));
	}

	public function index($cat_slug = '')
	{
		if (empty($cat_slug)) {
			$news_category = $this->NewsCategory->findFirstNewsCategory();
			$cat_slug = $news_category['NewsCategory']['slug'];
		} else {
			$news_category = $this->NewsCategory->findBySlug($cat_slug);
		}

		if (!$news_category) {
			$this->Flash->error('Trang không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}

		// get all news
		$news_list = array();
		$page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
		$this->paginate = array(
			'conditions' => array(
				'cat_id' => $news_category['NewsCategory']['id']
			),
			'limit' => NEWS_LIMIT,
			'page' => 1,
			'order' => array('created' => 'desc'),
			'paramType' => 'querystring',
		);

		$news_list = $this->paginate('News');
		$this->set(compact('news_category', 'news_list', 'page', 'cat_slug'));
	}

	public function detail($slug)
	{
		// find news item by slug
		$news = $this->News->findBySlug($slug);
		if (!$news || !$slug) {
			$this->Flash->error('Tin không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		$this->set(compact('slug', 'news'));
	}
}