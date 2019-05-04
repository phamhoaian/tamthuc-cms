<?php 
App::uses('AppController', 'Controller');

class MenusController extends AppController {

	public $uses = array('Menu');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'detail'));
	}

	public function index()
	{
		// find the first menu item
		$menu = $this->Menu->findFirstMenu();
		if (!$menu) {
			$this->Flash->error('Trang không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		// redirect to menu detail
		$this->redirect(array('action' => 'detail', $menu['Menu']['slug']));
	}

	public function detail($slug)
	{
		// find menu item by slug
		$menu = $this->Menu->findBySlug($slug);
		if (!$menu || !$slug) {
			$this->Flash->error('Trang không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		$this->set(compact('slug', 'menu'));

		// get all menus
		$menu_list = $this->Menu->getAllMenu();
		$this->set(compact('menu_list'));
	}
}