<?php 

class News extends AppModel {

    public $actsAs = array(
		'Filebinder.Bindable' => array(
			// 'beforeAttach' => 'resize'
		)
	); 
	public $bindFields = array();

	public $validate = array(
		'cat_id' => array(
			'notblank' => array(
				'rule'		=> array('notblank'),
				'message'	=> 'Vui lòng chọn thể loại',
				'allowEmpty' => false
			)
		),
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
				'rule'		=> array('maxLength', 250),
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
				'rule'		=> array('maxLength', 250),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'content_en' => array(
			'notblank' => array(
				'rule' 		=> array('notblank'),
				'message'	=> 'Nội dung không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'content_vi' => array(
			'notblank' => array(
				'rule' 		=> array('notblank'),
				'message'	=> 'Nội dung không được để trống',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
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
        return $this->resize_image($tmp_file_path, 500, null);
	}
}