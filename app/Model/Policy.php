<?php 

class Policy extends AppModel {

	public $validate = array(
		'content_en' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		),
		'content_vi' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 10000),
				'message'	=> 'Số kí tự tối đa là %d'
			)
		)
	);

	function __construct()
    {
        parent::__construct();
	}
}