<?php 
App::uses('AppController', 'Controller');

class PromotionsController extends AppController {

	public $uses = array('Promotion');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'detail'));
	}

	public function index()
	{
		// get all promotions
		$promotion_list = array();
		$page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
		$this->paginate = array(
			'fields' => array('Promotion.*, Event.slug'),
			'conditions' => array('Promotion.status_cd' => STATUS_PUBLIC),
			'joins' => array(
				array(
                    'table' => 'events',
                    'alias' => 'Event',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Promotion.event_id = Event.id'
                    )
                )
			),
			'limit' => PROMOTION_LIMIT,
			'page' => 1,
			'order' => array('created' => 'desc'),
			'paramType' => 'querystring',
		);

		$promotion_list = $this->paginate('Promotion');
		$this->set(compact('promotion_list', 'page'));
	}

	public function detail($slug)
	{
		// find promotion item by slug
		$promotion = $this->Promotion->findBySlug($slug);
		if (!$promotion || !$slug) {
			$this->Flash->error('Trang không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		$this->set(compact('slug', 'promotion'));
	}
}