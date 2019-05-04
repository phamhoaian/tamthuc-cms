<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController{

    public function beforeFilter()
    {
        parent::beforeFilter();
        
        $auth_user = $this->get_auth_user();
        if(isset($auth_user['user_type_cd']) &&
        	$auth_user['user_type_cd'] != ADMIN_ROLE
      	){
        	return $this->redirect('/');
      	}
    }

    private function get_auth_user()
    {
		$user = $this->Auth->user();
		
        if($this->Auth->user()){
            $this->auth_user = $this->User->findById($user['id']);
        }
        $this->set('auth_user', $this->auth_user);
    }
}