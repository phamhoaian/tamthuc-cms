<?php 
App::uses('AppController', 'Controller');

class CustomerReviewsController extends AppController {

	public $uses = array('TransactionManager');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
	}

	public function index()
	{

	}
}