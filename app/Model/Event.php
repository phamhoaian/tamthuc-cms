<?php 

class Event extends AppModel {

	public $validate = array(
		'status_cd' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng chọn trạng thái',
				'allowEmpty' => false
			)
		),
		'slug' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Slug không được để trống',
				'allowEmpty' => false
			)
		),
		'title_en' => array(
			'notblank' => array(
				'rule' 		=> array('notblank'),
				'message'	=> 'Tiêu đề không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 50),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'title_vi' => array(
			'notblank' => array(
				'rule' 		=> array('notblank'),
				'message'	=> 'Tiêu đề không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 50),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'content_top_en' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'content_top_vi' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'content_bottom_en' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'content_bottom_vi' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'condition_en' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'condition_vi' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'agency' => array(
			'multiple' => array(
				'rule' 		=> array('multiple', array(
					'min' => 1
				)),
				'message'	=> 'Vui lòng chọn chi nhánh',
				'allowEmpty' => false
			),
		),
		'start_date' => array(
			'notblank' => array(
				'rule' 		=> array('notblank'),
				'message'	=> 'Vui lòng chọn ngày bắt đầu',
				'allowEmpty' => false
			),
		),
		'end_date' => array(
			'notblank' => array(
				'rule' 		=> array('notblank'),
				'message'	=> 'Vui lòng chọn ngày kết thúc',
				'allowEmpty' => false
			),
		)
	);

	function __construct()
    {
        parent::__construct();
	}
}