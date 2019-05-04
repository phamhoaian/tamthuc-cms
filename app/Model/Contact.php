<?php 

class Contact extends AppModel {

	public $validate = array(
		'name' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Họ tên không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 50),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'email' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Email không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 255),
				'message'	=> 'Số kí tự tối đa là %d'
			),
			'email' => array(
				'rule' => array('email'), 
				'message' => 'Vui lòng nhập địa chỉ email chính xác'
			)
		),
		'title' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Chủ đề không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 255),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'content' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Nội dung không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 1000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		)
	);

	function __construct()
    {
        parent::__construct();
	}

	public function getCountUncheckContact()
	{
		return $this->find('count', array(
			'conditions' => array(
				'read_flag' => UNREAD_FLAG
			)
		));
	}
}