<?php 
App::uses('AppController', 'Controller');

class EventsController extends AppController {

	public $uses = array('Event', 'EventRegister', 'Agency', 'TransactionManager');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'register'));
	}

	public function index($slug = '')
	{
		// specific layout
		$this->layout = "landing";

		// find event item by slug
		$event = $this->Event->findBySlug($slug);
		if (!$event || !$slug) {
			$this->Flash->error('Sự kiện đã kết thúc!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		$this->set(compact('slug', 'event'));

		// find agencies
		$agencies = $this->Agency->find('all', array(
			'conditions' => array(
				'id IN' => explode(',', $event['Event']['agency']),
				'status_cd' => STATUS_PUBLIC
			),
		));
		$this->set(compact('agencies'));
	}

	public function register()
	{
		$this->layout = "ajax";
		$this->autoRender = false;

		if ($this->request->is("ajax")) {
			$params = $this->request->data;
			$this->EventRegister->set($params);
			$trans = $this->TransactionManager->begin();
			if ($this->EventRegister->validates($params)) {
				$checkDuplicateRegistration = $this->EventRegister->checkDuplicateRegistration($params);
				if ($checkDuplicateRegistration) {
					return json_encode(array(
						'success' 	=> -1
					));
				}
				if ($this->EventRegister->save($params)) {
					$this->TransactionManager->commit($trans);
					return json_encode(array('success' => 1));
				} else {
					$this->TransactionManager->rollback($trans);
					return json_encode(array(
                        'success'   => 99,
                        'errors'    => $this->EventRegister->invalidFields()
                    ));
				}
			} else {
				return json_encode(array(
					'success'   => 0,
					'errors'    => $this->EventRegister->validationErrors
				));
			}
		}
	}
}