<?php 

class Request extends AppModel {

	public $validate = array(
		'name' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Tên không được để trống',
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
		'phone' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Số điện thoại không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 11),
				'message'	=> 'Số kí tự tối đa là %d'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Vui lòng chỉ nhập số'
			)
		)
	);

	function __construct()
    {
        parent::__construct();
	}

	public function getCountUncheckRequest()
	{
		return $this->find('count', array(
			'conditions' => array(
				'read_flag' => UNREAD_FLAG
			)
		));
	}
}