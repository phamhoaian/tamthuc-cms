<?php 
App::uses('AppController', 'Controller');

class ContactsController extends AppController {

	public $uses = array('TransactionManager', 'Agency', 'Contact');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
	}

	public function index()
	{
		// get all agencies
		$agencies = $this->Agency->getAllAgency();
		$this->set(compact('agencies'));

		if ($this->request->is("ajax")) {
			$this->layout = "ajax";
			$this->autoRender = false;
			$params = $this->request->data;
			$this->Contact->set($params);
			$trans = $this->TransactionManager->begin();
			if ($this->Contact->validates($params)) {
				if ($this->Contact->save($params)) {
					$this->TransactionManager->commit($trans);
					return json_encode(array('success' => 1));
				} else {
					$this->TransactionManager->rollback($trans);
					return json_encode(array(
                        'success'   => 99,
                        'errors'    => $this->Contact->invalidFields()
                    ));
				}
			} else {
				return json_encode(array(
					'success'   => 0,
					'errors'    => $this->Contact->validationErrors
				));
			}
		}
	}
}