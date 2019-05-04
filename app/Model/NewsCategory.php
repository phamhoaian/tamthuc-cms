<?php 

class NewsCategory extends AppModel {

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
		)
	);

	function __construct()
    {
        parent::__construct();
	}

	public function getAllNewsCategory()
	{
		return $this->find('all', array(
			'conditions' => array('status_cd' => STATUS_PUBLIC),
			'order' => array('order ASC')
		));
	}

	public function findFirstNewsCategory()
	{
		return $this->find('first', array(
			'conditions' => array('status_cd' => STATUS_PUBLIC),
			'order' => array('order ASC'),
			'limit' => 1
		));
	}
}