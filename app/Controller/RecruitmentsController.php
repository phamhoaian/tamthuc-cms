<?php 
App::uses('AppController', 'Controller');

class RecruitmentsController extends AppController {

	public $uses = array('Recruitment');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
	}

	public function index()
	{
		// get recruitment
		$recruitment = $this->Recruitment->find('first');
		$this->set(compact('recruitment'));
	}
}