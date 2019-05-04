<?php 

class Order extends AppModel {

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
		),
		'agency' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng chọn 1 nhà hàng',
				'allowEmpty' => false
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Vui lòng chỉ nhập số'
			)
		),
		'day' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng chọn ngày',
				'allowEmpty' => false
			)
		),
		'hour' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng chọn giờ',
				'allowEmpty' => false
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Vui lòng chỉ nhập số'
			)
		),
		'minute' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng chọn phút',
				'allowEmpty' => false
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Vui lòng chỉ nhập số'
			)
		),
		'num_of_guest' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Số lượng khách không được để trống',
				'allowEmpty' => false
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

	public function getCountUncheckOrder()
	{
		return $this->find('count', array(
			'conditions' => array(
				'read_flag' => UNREAD_FLAG
			)
		));
	}
}