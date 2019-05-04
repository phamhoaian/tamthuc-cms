<?php

class Optional extends AppModel {

	public $actsAs = array(
		'Filebinder.Bindable' => array(
			// 'beforeAttach' => 'resize'
		)
	); 
	public $bindFields = array();

	public $validate = array(
		'content' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d',
				'allowEmpty' => true
			)
		),
		'top_pic' => array(
			'allowExtention' => array(
				'rule' => array('checkExtension', array('jpg', 'jpeg', 'png', 'gif')), 
				'message' => 'Không hỗ trợ định dạng file này', 
				'allowEmpty' => true
			), 
			'fileSize' => array(
				'rule' => array('checkFileSize', '10MB'), 
				'message' => 'Kích thước file tối đa cho phép là %s'
			)
		)
	);

	function __construct()
    {
        parent::__construct();
        $this->bindFields = array(
									array(
										'field' => 'top_pic', 
										'tmpPath' => Configure::read('file_path').'tmp'.DS,
										'filePath' => Configure::read('file_path').'uploads'.DS,
									)
								);
	}
	
	public function resize($tmp_file_path)
    {
        return $this->resize_image($tmp_file_path, 1900, null);
	}

	public function findOptionalByModel($model, $model_id, $type)
	{
		return $this->find('all', array(
			'conditions' => array(
				'Optional.model' => $model,
				'Optional.model_id' => $model_id,
				'Optional.cat_id' => $type
			),
			'order' => array('sort_order IS NULL, sort_order ASC')
		));
	}
}