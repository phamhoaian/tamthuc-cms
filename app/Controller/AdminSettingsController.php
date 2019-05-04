<?php 
App::uses('AdminController', 'Controller');

class AdminSettingsController extends AdminController {

    public $uses = array('TransactionManager', 'Setting');

    public $components = array('Ring' => array(
            'className'=>'Imagebinder.ImageRing'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->layout = 'admin';
        $this->set('page_title', __('Thiết lập'));

        // breadcrumb
        $this->Breadcrumb->addCrumb(array(
        	'title'	=> __('Tổng quan'),
        	'url'	=> array('controller' => 'admin_dashboards', 'action' => 'admin_index')
		));
    }

    public function admin_index()
    {   
        if(!$this->setting){
            $this->redirect('/');
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Setting->id                    = $this->setting['id'];
            $this->request->data['Setting']['id'] = $this->setting['id'];
            $this->Setting->set($this->request->data);
            $trans = $this->TransactionManager->begin();
            if ($this->Setting->validates($this->request->data)) {
                if ($this->Setting->save($this->request->data)) {
                    $this->TransactionManager->commit($trans);
                    $this->Flash->success('Thiết lập thành công!');
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    $this->TransactionManager->rollback($trans);
                    $this->Flash->error('Có lỗi xảy ra!');
                    $this->redirect(array('action' => 'admin_index'));
                }
            }
        } else {
            $this->request->data['Setting'] = $this->setting;
        }

        $this->set('active_menu', 'setting');

        // breadcrumbs
        $this->Breadcrumb->addCrumb(array(
            'title'	=> __("Thiết lập")
        ));
        $breadcrumb = $this->Breadcrumb->getCrumbs();
        $this->set(compact('breadcrumb'));
    }
}
