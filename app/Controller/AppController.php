<?php
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
// App::import('Vendor', 'Aws/autoloader');
App::import('Vendor', 'wysiwyg-editor-php-sdk/lib/autoload');
class AppController extends Controller
{
    public $uses = array(
            'User', 'Attachment', 'Setting', 'Request', 'Contact', 'Order'

    );
    public $heplers = array('Color', 'BreadcrumbFormatter', 'Notification');
    public $components = array(
        'Flash',
            'Session', 'Auth' => array(
                    'loginAction' => array(
                            'controller' => 'users', 'action' => 'login', 'plugin' => 'LogiAuth'
                    ), 'logoutRedirect' => array(
                            'controller' => 'base', 'action' => 'index', 'plugin' => false
                    ), 'ajaxLogin' => 'ajax/ajax_auth_error'
            ), 'Security', 'Breadcrumb', 'Notice', 'Ring' => array('className'=>'Imagebinder.ImageRing'), 'DebugKit.Toolbar'
    );

    public $smart_phone = false;  //スマホからアクセスしているかのフラグ（trueはスマホアクセス）
    public $setting = null; //設定情報（settingsテーブル）

    public function beforeFilter()
    {
        $this->_chk_https_for_sakura_ssl();
        $this->setting();
        //httpsとhttp接続の切り替え（全ページhttps接続を想定）
        $this->Security->blackHoleCallback = 'forceSSL';
        $this->Security->requireSecure();
        
        //set site language
        $this->_setLang();

        // Check site maintenance
        if(empty($this->setting['site_open'])){
            throw new InternalErrorException('Not Implement Exception');
        }

        if($this->params['admin']){
            AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->authenticate  = array(
                    'Form' => array(
                            'userModel' => 'User', 'scope' => array(
                                    'User.user_type_cd IN' => array(ADMIN_ROLE, EDITOR_ROLE), 'status_cd' => REGISTED
                            ), 'fields' => array(
                                    'username' => 'email', 'password' => 'password'
                            )
                    )
            );

            // prepare init data for admin
            $count_uncheck_request = $this->Request->getCountUncheckRequest();
            $this->set(compact('count_uncheck_request'));

            $count_uncheck_contact = $this->Contact->getCountUncheckContact();
            $this->set(compact('count_uncheck_contact'));

            $count_uncheck_order = $this->Order->getCountUncheckOrder();
            $this->set(compact('count_uncheck_order'));
        }else{
            $this->Auth->authenticate = array(
                    'Form' => array(
                            'userModel' => 'User', 'scope' => array('status_cd' => REGISTED), 'fields' => array(
                                    'username' => 'email', 'password' => 'password'
                            )
                    )
            );
            $user = array();
			if ($this->request->params["controller"]!='imagebinder') {
				$auth = $this->Auth->user();
                if($auth){
                    $this->get_auth_user();
                }
                $user = $this->auth_user;
                if($user) {
                    $user = $user['User'];
                }
			}
            
            // $notification = $this->Notice->getNotice($this->Auth->user('id'));
            // $unread_flag = $this->Notice->chkUnread($notification);
            // $this->set(compact('notification', 'unread_flag'));

        }
		
        $this->check_smart_phone();

		if ($this->request->is("post") && empty($this->request->data)) {
			//php.iniのpost_max_sizeを超えた場合
			$this->Session->setFlash("送信されたデータの合計量が大き過ぎます。送信内容を見直してください。");
			$this->redirect($this->request->referer());
		}
        
        
        $suppported_langs = array('en' => 'English', 'vi' => '‪Vietnamese');
        $this->set(compact('suppported_langs'));
        $this->configFileBinder();


    }

    /**
     * 設定情報の読み込み
     */
    private function setting()
    {
        $setting = $this->Setting->find('first');
        if(!empty($setting['Setting'])){
            $this->setting = $setting['Setting'];
            $this->set('setting', $this->setting);
        }else{
            $this->set('setting', null);
        }
    }

    /**
     * ログインユーザの取得
     */
    private function get_auth_user()
    {
		$user = $this->Auth->user('id');
		
        if($user){
            $this->auth_user = $this->User->findById($user);
        }
        else {
            return $this->redirect($this->Auth->logout());
        }
		
        $this->set('auth_user', $this->auth_user);
    }
    
    public function check_admin_user()
    {
        $user = $this->Auth->user('id');
        if ($user) {
            $auth_user = $this->User->findById($user);
            if ($auth_user && $auth_user['User']['user_type_cd'] == ADMIN_ROLE) {
                $this->set('admin_user', true);
                return;
            }
        }
        $this->Auth->logout();
        return $this->redirect('/admin');
    }

    /**
     * スマホからのアクセスだった場合の処理（各種変数セットなど）
     */
    public function check_smart_phone()
    {
        $ua = $this->request->header('User-Agent');
        if($this->check_agent($ua)){
            $this->set('smart_phone', true);
            $this->smart_phone = true;
        }else{
            $this->set('smart_phone', false);
        }
    }

    /**
     * スマホからのアクセスかチェックする関数
     * スマホだったらtrue(ipad除く）だったはず
     * @param $ua
     * @return bool
     */
    private function check_agent($ua)
    {
        $this->set(compact('ua'));
        if((((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPod') !== false) || (strpos($ua, 'PDA') !== false)
             || (strpos($ua, 'BkackBerry') !== false)
             || (strpos($ua, 'Windows Phone') !== false))
            && strpos($ua, 'iPad') === false)
           || ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false))
        ){
            return true;
        }
    }

    /**
     * https強制接続
     */
    public function forceSSL()
    {
        if(!empty($this->setting['https_flag']) && 
            $this->setting['https_flag'] && 
            ( 
                !isset($_SERVER['HTTP_X_FORWARDED_PROTO']) || 
                $_SERVER['HTTP_X_FORWARDED_PROTO'] != 'https'
            ) &&
            $this->request->params['controller'] != 'twitter' &&
            $this->request->params['controller'] != 'google' &&
            $this->request->params['controller'] != 'facebook'
        ){
            $this->redirect('https://'.env('SERVER_NAME').$this->here);
        }
    }

    /**
     * http強制接続
     */
    public function _unforceSSL()
    {
        $this->redirect('http://'.env('SERVER_NAME').$this->here);
    }

    /**
     * さくらレンタルサーバのSIN SSL利用への対応
     */
    public function _chk_https_for_sakura_ssl()
    {
        if(isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])){
            $_SERVER['HTTPS'] = 'on';
        }
    }

    private function _setLang(){
        $supported_languages = Configure::read('supported_languages');

        if(isset($this->request->query['language']) && 
            in_array($this->request->query['language'], Configure::read('languages'))) {
            $lang = $this->request->query['language'];
            $selected_lang = $supported_languages[$lang];
            $this->Session->write('Config.language_key', $lang);
            Configure::write('Config.language_key', $lang);
            $this->Session->write('Config.language', $selected_lang);
            Configure::write('Config.language', $selected_lang);
        }

        if($this->Session->check('Config.language') ==false) {
            
            $language_key = DEFAULT_LANGUAGE;
            $selected_lang = $supported_languages[$language_key];        
            Configure::write('Config.language_key', $language_key);
            Configure::write('Config.language', $selected_lang);
            $this->Session->write('Config.language_key', $language_key);
            $this->Session->write('Config.language', $selected_lang);
        }
        else{
            Configure::write('Config.language_key', $this->Session->read('Config.language_key'));
            Configure::write('Config.language', $this->Session->read('Config.language'));
        }

    }

    private function configFileBinder(){
        Configure::write('Filebinder.S3.key', $this->setting['s3_key']);
        Configure::write('Filebinder.S3.secret', $this->setting['s3_secret']);
        Configure::write('Filebinder.S3.bucket', $this->setting['s3_bucket']);
        Configure::write('Filebinder.S3.upload_dir', $this->setting['s3_upload_dir']);
    }

    public function setFacebookSNS($title ='', $description = '', $image = null) {
        $sns = array('title' => $title, 'description' => $description, 'image' => $image);
        $this->set(compact('sns'));
    }
}
