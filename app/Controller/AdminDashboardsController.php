<?php 
App::uses('AdminController', 'Controller');

class AdminDashboardsController extends AdminController {

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'admin';
    }

    public function admin_index()
    {
        $this->set('page_title', __('Tổng quan'));
        $this->set('active_menu', 'dashboard');
    }
}
