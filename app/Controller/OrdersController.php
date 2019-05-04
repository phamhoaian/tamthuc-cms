<?php 
App::uses('AppController', 'Controller');

class OrdersController extends AppController {

	public $uses = array('TransactionManager', 'Order', 'Agency');

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

		// list agency
		$list_agency = array();
		if ($agencies) {
			foreach ($agencies as $row) {
				$list_agency[$row['Agency']['id']] = json_decode($row['Agency']['title'], TRUE)[Configure::read('Config.language_key')];
			}
		}
		$this->set(compact('list_agency'));

		// list hour
		$list_hour = array();
		for ($i = OPEN_TIME; $i <= CLOSE_TIME; $i++) {
			$list_hour[$i] = ($i < 10 ? '0' . $i : $i) . ' ' . __('giờ');
		}
		$this->set(compact('list_hour'));

		// list minute
		$list_minute = array();
		for ($i = 0; $i <= 55; $i = $i + 5) {
			$list_minute[$i] = ($i < 10 ? '0' . $i : $i) . ' ' . __('phút');
		}
		$this->set(compact('list_minute'));

		if ($this->request->is("ajax")) {
			$this->layout = "ajax";
			$this->autoRender = false;
			$params = $this->request->data;
			$this->Order->set($params);
			$trans = $this->TransactionManager->begin();
			if ($this->Order->validates($params)) {
				if ($this->Order->save($params)) {
					$this->TransactionManager->commit($trans);
					return json_encode(array('success' => 1));
				} else {
					$this->TransactionManager->rollback($trans);
					return json_encode(array(
                        'success'   => 99,
                        'errors'    => $this->Order->invalidFields()
                    ));
				}
			} else {
				return json_encode(array(
					'success'   => 0,
					'errors'    => $this->Order->validationErrors
				));
			}
		}
	}
}