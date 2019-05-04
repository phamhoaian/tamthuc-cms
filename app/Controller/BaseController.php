<?php 
App::uses('AppController', 'Controller');

class BaseController extends AppController {

	public $uses = array('Feature', 'Introduction', 'Menu', 'Promotion', 'Agency');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('index');
		$this->set('is_home', true);
	}

	public function index()
	{
		// get all features
		$features = $this->Feature->getAllFeature();
		$this->set(compact('features'));

		// get all introductions
		$introductions = $this->Introduction->getAllIntroduction();
		$this->set(compact('introductions'));

		// get all menus
		$menus = $this->Menu->getAllMenu();
		$this->set(compact('menus'));

		// get all promotions
		$promotions = $this->Promotion->getAllPromotion();
		$this->set(compact('promotions'));

		// get all agencies
		$agencies = $this->Agency->getAllAgency();
		$this->set(compact('agencies'));
	}
}