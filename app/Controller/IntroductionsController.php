<?php 
App::uses('AppController', 'Controller');

class IntroductionsController extends AppController {

	public $uses = array('Introduction');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'detail'));
	}

	public function index()
	{
		// find the first introduction item
		$introduction = $this->Introduction->findFirstIntroduction();
		if (!$introduction) {
			$this->Flash->error('Trang không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		// redirect to feature detail
		$this->redirect(array('action' => 'detail', $introduction['Introduction']['slug']));
	}

	public function detail($slug)
	{
		// find introduction item by slug
		$introduction = $this->Introduction->findBySlug($slug);
		if (!$introduction || !$slug) {
			$this->Flash->error('Trang không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		$this->set(compact('slug', 'introduction'));

		// get all introductions
		$introduction_list = $this->Introduction->getAllIntroduction();
		$this->set(compact('introduction_list'));
	}
}