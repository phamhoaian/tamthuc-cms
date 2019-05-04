<?php 

class EventRegister extends AppModel {

	public $validate = array(
		'name' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng nhập tên đầy đủ',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 50),
				'message'	=> 'Số kí tự tối đa là %s'
			)
		),
		'email' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng nhập địa chỉ email',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 255),
				'message'	=> 'Số kí tự tối đa là %s'
			),
			'email' => array(
				'rule' => array('email'), 
				'message' => 'Vui lòng nhập địa chỉ email đúng'
			)
		),
		'phone' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng nhập số điện thoại',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 11),
				'message'	=> 'Số kí tự tối đa là %s'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Vui lòng chỉ nhập số nguyên'
			)
		)
	);

	function __construct()
    {
        parent::__construct();
	}

	public function checkDuplicateRegistration($params)
	{
		return $this->find('first', array(
			'conditions' => array(
				'event_id' => $params['EventRegister']['event_id'],
				'OR' => array(
					'email' => $params['EventRegister']['email'],
					'phone' => $params['EventRegister']['phone']
				)
				
			)
		));
	}
}