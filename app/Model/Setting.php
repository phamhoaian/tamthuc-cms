<?php
App::uses('AppModel', 'Model');

class Setting extends AppModel
{
    public $validate = array(
            'site_url' => array(
                'notblank' => array(
                    'rule'		=> array('notblank'),
                    'message'	=> 'Site URL không được để trống',
                    'allowEmpty' => false
                )
            ),
            'site_title' => array(
                'notblank' => array(
                    'rule'		=> array('notblank'),
                    'message'	=> 'Site title không được để trống',
                    'allowEmpty' => false
                )
            ),
            'facebook_pixel' => array(
                'maxLength' => array(
                    'rule'		=> array('maxLength', 1000),
                    'message'	=> 'Số kí tự tối đa là %d'
                )
            ), 
            'facebook_chat' => array(
                'maxLength' => array(
                    'rule'      => array('maxLength', 1000),
                    'message'   => 'Số kí tự tối đa là %d'
                )
            ),
            'google_site_verification' => array(
                'maxLength' => array(
                    'rule'		=> array('maxLength', 1000),
                    'message'	=> 'Số kí tự tối đa là %d'
                )
            ),
            'admin_mail_address' => array(
                'notblank' => array(
                    'rule'		=> array('notblank'),
                    'message'	=> 'Admin email address không được để trống',
                    'allowEmpty' => false
                ),
                'email' => array(
                    'rule'      => array('email'),
                    'message'   => 'Vui lòng nhập đúng địa chỉ email'
                )
            )
    );

    function __construct()
    {
        parent::__construct();
        
    }
}
