<?php 
App::uses('AppController', 'Controller');

class VipMembersController extends AppController {

	public $uses = array('TransactionManager', 'Policy', 'Request');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('policy', 'request'));
	}

	public function policy()
	{
		// get policy
		$policy = $this->Policy->find('first');
		$this->set(compact('policy'));

		// active menu
		$this->set('active_menu', 'policy');
	}

	public function request()
	{
		// disable this page
		$this->redirect('/');

		// active menu
		$this->set('active_menu', 'request');

		if ($this->request->is("ajax")) {
			$this->layout = "ajax";
			$this->autoRender = false;
			$params = $this->request->data;
			$this->Request->set($params);
			$trans = $this->TransactionManager->begin();
			if ($this->Request->validates($params)) {
				if ($this->Request->save($params)) {
					$this->TransactionManager->commit($trans);
					return json_encode(array('success' => 1));
				} else {
					$this->TransactionManager->rollback($trans);
					return json_encode(array(
                        'success'   => 99,
                        'errors'    => $this->Request->invalidFields()
                    ));
				}
			} else {
				return json_encode(array(
					'success'   => 0,
					'errors'    => $this->Request->validationErrors
				));
			}
		}
	}
}