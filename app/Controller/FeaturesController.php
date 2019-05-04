<?php 
App::uses('AppController', 'Controller');

class FeaturesController extends AppController {

	public $uses = array('Feature', 'Optional');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'detail'));
	}

	public function index()
	{
		// find the first feature item
		$feature = $this->Feature->findFirstFeature();
		if (!$feature) {
			$this->Flash->error('Trang không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		// redirect to feature detail
		$this->redirect(array('action' => 'detail', $feature['Feature']['slug']));
	}

	public function detail($slug)
	{
		// find feature item by slug
		$feature = $this->Feature->findBySlug($slug);
		if (!$feature || !$slug) {
			$this->Flash->error('Trang không tồn tại!');
			$this->redirect(array('controller' => 'base', 'action' => 'index'));
		}
		$this->set(compact('slug', 'feature'));

		// get all features
		$feature_list = $this->Feature->getAllFeature();
		$this->set(compact('feature_list'));

		// get optional how to enjoy
		$how_to_enjoy = $this->Optional->findOptionalByModel('Feature', $feature['Feature']['id'], OPTIONAL_HOW_TO_ENJOY);
		$this->set(compact('how_to_enjoy'));

		// get optional sauce
		$sauce = $this->Optional->findOptionalByModel('Feature', $feature['Feature']['id'], OPTIONAL_SAUCE);
		$this->set(compact('sauce'));
	}
}