<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 */
class User extends AppModel
{
    public $actsAs = array('Filebinder.Bindable' => array('storage' => array('S3'), 'dbStorage' => true, 'beforeAttach' => 'resize', 'afterAttach' => 'thumbnail')); 
    public $bindFields = array();
    /**
     * Display field
     * @var string
     */
    public $displayField = 'name';
    /**
     * Validation rules
     * @var array
     */
    public $validate = array(

            'profile_pic'		=> array(
                                    'notblank'			=> array('rule' => array('notEmptyFile'), 'message' => '画像を選択してください。'),
									'allowExtention' => array('rule' => array('checkExtension', array('jpg', 'jpeg', 'png', 'gif')), 'message' => 'プロフィール画像の拡張子が無効です'), 
									'fileSize' => array('rule' => array('checkFileSize', '1GB'), 'message' => 'プロフィール画像のファイルサイズが%sを超過しています'), 
									'illegalCode' => array('rule' => array('checkIllegalCode'))
								), 
			'user_nn'	=> array(
									'maxLength' => array('rule' => array('maxLength', 15), 'message' => '名前は%d文字以内で入力してください。')
								), 
			'name'		=> array(
									'notblank' => array('rule' => array('notblank'), 'message' => 'ユーザーネームを入力してください。', 'allowEmpty' => false), 
                                    'maxLength' => array('rule' => array('maxLength', 32), 'message' => 'ユーザーネームは%d文字以内の半角英数字を入力してください。'),
                                    // 'unique' => array('rule' => 'uniqueNickName', 'required' => array('create', 'update'), 'message' => 'このユーザーネームは既に登録されています。')
								),
			'email'		=> array(
									'notblank' => array('rule' => array('notblank'), 'message' => 'メールアドレスを入力してください。', 'allowEmpty' => false),
									'email' => array('rule' => array('email'), 'message' => '正しいメールアドレスを入力してください。'), 
									'unique' => array('rule' => 'uniqueActive', 'required' => array('create', 'update'), 'message' => 'このメールアドレスは既に登録されています。'),
									// 'confirm' => array('rule' => array('emailConfirm'), 'message' => 'メールアドレスが確認値と一致しません。')
                                ), 
            'old_password'	=> array(
									'notblank' => array('rule' => array('notblank'), 'message' => 'パスワードを入力してください。', 'allowEmpty' => false),
                                    'between' => array('rule' => array('between', 5, 15), 'message' => 'パスワードは%d文字以上%d文字以内の半角英数字を入力してください。'), 
                                    'oldPass' => array('rule' => array('oldPass'), 'message' => '現在のパスワードが間違いました。再入力してください。')
								),
			'password'	=> array(
									'notblank' => array('rule' => array('notblank'), 'message' => 'パスワードを入力してください。', 'allowEmpty' => false),
									'between' => array('rule' => array('between', 5, 15), 'message' => 'パスワードは%d文字以上%d文字以内の半角英数字を入力してください。'), 
                                    'notSameOldPassword' => array('rule' => 'notSameOldPassword', 'message' => '新しいパスワードは古いパスワードと同じであってはなりません')
                                    // 'confirm' => array('rule' => array('passConfirm'), 'message' => 'パスワードが一致しません。')
								),
            'password2'  => array(
                                    'confirm' => array('rule' => array('passConfirm'), 'message' => 'パスワードが一致しません。')
                                ),
            'sex_cd'	=> array(
									'notblank' => array('rule' => array('notblank'), 'message' => '性別/グループ/企業を選択してください。', 'allowEmpty' => false),
								),
            'zip_cd'	=> array(
									// 'notblank' => array('rule' => array('notblank'), 'message' => '郵便番号を入力してください。', 'allowEmpty' => false),
									'custom' => array('rule' => array('custom', '/^\d{7}$/'), 'message' => '郵便番号は7桁の数字で入力してください。', 'allowEmpty' => true)
								), 
			'address'	=> array(
									// 'notblank' => array('rule' => array('notblank'), 'message' => '住所を入力してください。', 'allowEmpty' => false),
									'maxlength' => array('rule' => array('maxlength' , 128),'message' => '住所は%d文字以内で入力してください。'),
									'custom' => array('rule' => array('custom', '/^.{7,128}$/u'), 'message' => '住所は都道府県から全て入力してください。', 'allowEmpty' => true)
								), 
			'telephone_no' => array(
									// 'notblank' => array('rule' => array('notblank'), 'message' => '電話番号/携帯番号を入力してください。', 'allowEmpty' => false),
									'maxlength' => array('rule' => array('maxlength' , 15),'message' => '電話番号/携帯番号は%d文字以内で入力してください。'),
									'custom' => array('rule' => array('custom', '/^\d{9,15}$/'), 'message' => '電話番号/携帯番号に誤りがあります。', 'allowEmpty' => true)
								),
            'ether_address' => array(
                    'notempty' => array(
                            'rule' => array('notBlank'), 'message' => 'イーサリアムアドレスを入力してください', 'allowEmpty' => false,
                    ),
                    'alphanumeric' => array(
                            'rule' => '/^[0-9a-z]*$/i', 'message' => 'イーサリアムアドレスが不正です'
                    ),
                    'maxLength' => array(
                            'rule' => array(
                                    'maxLength', 42
                            ), 'message' => 'イーサリアムアドレスは%d文字以内で入力してください'
                    ),
                    'unique' => array('rule' => 'uniqueEtherAddress', 'required' => array('create', 'update'), 'message' => 'このイーサリアムアドレスは既に登録されています。'),
                    'valid' => array('rule' => 'validEtherAddress', 'required' => array('create', 'update'), 'message' => 'イーサリアムアドレスが不正です'),
            ),			
    );
    /**
     * hasMany associations
     * @var array
     */
//    public $hasMany = array(
//            'BackedProject' => array(
//                    'className' => 'BackedProject', 'foreignKey' => 'user_id', 'dependent' => false, 'conditions' => '',
//                    'fields' => '', 'order' => '', 'limit' => '', 'offset' => '', 'exclusive' => '',
//                    'finderQuery' => '', 'counterQuery' => ''
//            ), 'Comment' => array(
//                    'className' => 'Comment', 'foreignKey' => 'user_id', 'dependent' => false, 'conditions' => '',
//                    'fields' => '', 'order' => '', 'limit' => '', 'offset' => '', 'exclusive' => '',
//                    'finderQuery' => '', 'counterQuery' => ''
//            ), 'FavouriteProject' => array(
//                    'className' => 'FavouriteProject', 'foreignKey' => 'user_id', 'dependent' => false,
//                    'conditions' => '', 'fields' => '', 'order' => '', 'limit' => '', 'offset' => '', 'exclusive' => '',
//                    'finderQuery' => '', 'counterQuery' => ''
//            ), 'Project' => array(
//                    'className' => 'Project', 'foreignKey' => 'user_id', 'dependent' => false, 'conditions' => '',
//                    'fields' => '', 'order' => '', 'limit' => '', 'offset' => '', 'exclusive' => '',
//                    'finderQuery' => '', 'counterQuery' => ''
//            )
//    );
//    public $hasOne = array(
//            'Bank' => array(
//                    'class' => 'Bank', 'foreignKey' => 'user_id',
//            )
//    );

    function __construct()
    {
        parent::__construct();
        $this->bindFields[] = array(
										'field' => 'profile_pic', 
										'tmpPath' => Configure::read('file_path').'tmp'.DS,
										'filePath' => false,
                                        'bucket' => Configure::read('Filebinder.S3.bucket'), // bucket name,
                                        // 'acl' => AmazonS3::ACL_PUBLIC // S3 ACL
								);
    }

    /**
     * 画像リサイズ
     * @param array $tmp_file_path
     * @return bool
     */
    public function resize($tmp_file_path)
    {
        return $this->resize_image($tmp_file_path, 400, 400);
    }

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    /**
     * サムネイル作成
     * @param array $file_path
     * @return bool
     */
    public function thumbnail($file_path)
    {
        return $this->create_thumbnail($file_path, array(
                array(
                        THUMB_PROFILE_MID_WIDTH, null
                    ),
                array(
                        THUMB_PROFILE_SMALL_WIDTH, null
                    )
                )
                ,'profile_pic'
        );
    }

    public function oldPass($data)
    {
        if ( ! empty($data['old_password'])) {
            $user = $this->findById($this->data['User']['id']);
            $oldPass = AuthComponent::password($data['old_password']);
            if ($user['User']['password'] == $oldPass) {
                return true;
            }
        }
        return false;
    }

    public function notSameOldPassword($data)
    {
        if (isset($this->data['User']['old_password'])) {
            return $data['password'] != $this->data['User']['old_password'];
        }
        return true;
    }

    public function passConfirm($data)
    {
        if(empty($this->data['User']['password'])) {
            $this->data['User']['password'] = '';
        }
        return $data['password2'] == $this->data['User']['password'];
    }
	
    public function emailConfirm($data)
    {
        if(!empty($this->data['User']['email_2'])){
            return $data['email'] == $this->data['User']['email_2'];
        }
        return false;
    }

    public function uniqueNickName($data)
    {
		//受援者はニックネームが重複しても止むを得ないので、常にチェックOKとする
		// if ($this->data['User']['user_type_cd']==SPONSEE) {
		// 	return true;
		// }
		
        $options = array(
                'conditions' => array(
                        'User.status_cd' => REGISTED, 'User.name' => $data['name']
                ), 'fields' => array('User.id')
        );
        if(!empty($this->id)){
            $options['conditions']['User.id !='] = $this->id;
        }
        if($this->find('first', $options)){
            return false;
        }
        return true;
    }

    public function uniqueEtherAddress($data)
    {
        //受援者はニックネームが重複しても止むを得ないので、常にチェックOKとする
        // if ($this->data['User']['user_type_cd']==SPONSEE) {
        //     return true;
        // }
        
        $options = array(
                'conditions' => array(
                        'User.status_cd' => REGISTED, 'User.ether_address' => $data['ether_address']
                ), 'fields' => array('User.id')
        );
        if(!empty($this->id)){
            $options['conditions']['User.id !='] = $this->id;
        }
        if($this->find('first', $options)){
            return false;
        }
        return true;
    }

	
    public function uniqueActive($data)
    {
        $options = array(
                'conditions' => array(
                        'User.status_cd' => array(REGISTED, WITHDRAW), 'User.email' => $data['email']
                ), 'fields' => array('User.id')
        );
        if(!empty($this->id)){
            $options['conditions']['User.id !='] = $this->id;
        }
        if($this->find('first', $options)){
            return false;
        }
        return true;
    }

    public function beforeSave($options = array())
    {
        if(isset($this->data[$this->alias]['password'])){
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

//    /**
//     * プロジェクトへの支援者のオプションを取得する関数
//     * @param int $project_id
//     * @param int $limit
//     * @return array $users
//     */
//    public function get_backers_options($project_id, $limit = 10)
//    {
//        return array(
//                'joins' => array(
//                        array(
//                                'table' => 'backed_projects', 'alias' => 'BackedProject', 'type' => 'inner',
//                                'conditions' => array('User.id = BackedProject.user_id'),
//                        ),
//                ), 'conditions' => array(
//                        'BackedProject.project_id' => $project_id,
//                        'BackedProject.status' => Configure::read('STATUSES_FOR_OPEN')
//                ), 'order' => array('BackedProject.created' => 'DESC'), 'limit' => $limit, 'fields' => array(
//                        'User.id', 'User.nick_name', 'BackedProject.created', 'BackedProject.comment'
//                )
//        );
//    }
//
//    /**
//     * プロジェクトへの支援者のオプションを取得する関数
//     * （現金手渡しの支援者を省くバージョン）
//     */
//    public function get_backers_options_except_for_manual($project_id, $limit = 10)
//    {
//        return array(
//                'joins' => array(
//                        array(
//                                'table' => 'backed_projects', 'alias' => 'BackedProject', 'type' => 'inner',
//                                'conditions' => array('User.id = BackedProject.user_id'),
//                        ),
//                ), 'conditions' => array(
//                        'BackedProject.project_id' => $project_id,
//                        'BackedProject.status' => Configure::read('STATUSES_FOR_OPEN'), 'BackedProject.manual_flag' => 0
//                ), 'order' => array('BackedProject.created' => 'DESC'), 'limit' => $limit, 'fields' => array(
//                        'User.id', 'User.nick_name', 'BackedProject.created', 'BackedProject.comment'
//                )
//        );
//    }

    /**
     * メールアドレスからユーザを取得する関数
     * @param string $email
     * @return array $user
     */
    public function get_user_from_email($email)
    {
        return $this->findByEmail($email);
    }

    /**
     * トークンからユーザを取得する関数
     */
    public function get_user_from_token($token)
    {
        return $this->findByToken($token);
    }

    /**
     * Token作成関数
     */
    public function make_token()
    {
        while(true){
            $token = Security::hash(rand(100000, 999999), 'sha1', true);
            $user  = $this->findByToken($token);
            if(empty($user)){
                return $token;
            }
        }
    }

    /**
     * Twitterプロフィール画像の登録関数
     * @param str $twitter_img_url
     * @param int $user_id
     */
    public function get_twitter_profile_img($twitter_img_url, $user_id)
    {
        return $this->save_twitter_profile_img($twitter_img_url, $user_id); //FileBinderのビヘイビアに書いた
    }

    /**
     * TwitterIdからユーザ取得する関数
     */
    public function get_user_by_twitter_id($twitter_id)
    {
        return $this->findByTwitterId($twitter_id);
    }

    /**
     * ログイン試行回数のアップ
     */
    public function up_login_try_count($email)
    {
        $user = $this->findByEmail($email);
		
        if($user){
			$data = array(
							"login_try_count"		=> $user['User']['login_try_count'] + 1,
							"last_login_try_date"	=> date('Y-m-d H:i:s'),
							"modified"				=> false
						);
			
            $this->id        = $user['User']['id'];
            $this->save($data, false, array("login_try_count", "last_login_try_date", "modified"));
			
            return $user['User']['login_try_count'] + 1;
        }else{
            return null;
        }
    }

    /**
     * ログイン試行回数のリセット
     */
    public function reset_login_try_count($user_id, $is_loggedin=false)
    {
        $user     = array(
                'User' => array(
                        'login_try_count' => 0, 'token' => null, 'modified' => false
                )
        );
		
		$fields = array(
                'login_try_count', 'token', 'modified'
        );
		
		if ($is_loggedin) {
			$user["User"]["last_login_date"] = date('Y-m-d H:i:s');
			array_push($fields, "last_login_date");
		}
		
        $this->id = $user_id;
		
        if($this->save($user, true, $fields)
        ){
            return true;
        }
        return false;
    }

    /**
     * 通常ユーザ(支援会員本登録ユーザ)を全て取得する
     */
    public function get_all_users($option = true, $limit = 30)
    {
        $options = array(
                'conditions' => array('User.user_type_cd' => array(SPONSOR, SPONSEE), 'User.status_cd' => REGISTED), 'limit' => $limit,
                'order' => array('User.id' => 'DESC')
        );
        if($option){
            return $options;
        }
        return $this->find('all', $options);
    }

    /**
     * ユーザをEmailで検索する
     */
    public function get_users_by_email($email, $option = true, $limit = 30)
    {
        $options = array(
                'conditions' => array(
                        'User.email LIKE' => "%$email%", 'User.user_type_cd' => SPONSOR,
                        'User.status_cd' => REGISTED
                ), 'limit' => $limit, 'order' => array('User.id' => 'DESC')
        );
        if($option){
            return $options;
        }
        return $this->find('all', $options);
    }

    public function get_users_by_filters($email, $name, $user_type_cd = false, $option = true, $limit = 30, $page = 1)
    {
        if(empty($user_type_cd)){
            $user_type_cd =  array(SPONSOR, SPONSEE);
        }

        $options = array(
                'conditions' => array(
                        'User.email LIKE' => "%$email%", 'User.name LIKE' => "%$name%", 'User.user_type_cd' => $user_type_cd,
                        'User.status_cd' => REGISTED
                ), 'limit' => $limit, 'order' => array('User.id' => 'DESC'), 'page' => $page, 'paramType' => 'querystring'
        );
        if($option){
            return $options;
        }
        return $this->find('all', $options);
    }

    public function get_users_export($email, $name, $user_type_cd = false)
    {
        if(empty($user_type_cd)){
            $user_type_cd =  array(SPONSOR, SPONSEE);
        }

        $options = array(
                'conditions' => array(
                        'User.email LIKE' => "%$email%", 'User.name LIKE' => "%$name%", 'User.user_type_cd' => $user_type_cd,
                        'User.status_cd' => REGISTED
                ), 'order' => array('User.id' => 'asc')
        );

        return $this->find('all', $options);
    }

    /**
     * 退会処理
     */
    public function withdraw($user_id)
    {
        $this->id = $user_id;
        $data     = array(
                'status_cd' => WITHDRAW, 'twitter_id' => '', 'facebook_id' => ''
        );
        if($this->save($data)){
            return true;
        }
        return false;
    }

}