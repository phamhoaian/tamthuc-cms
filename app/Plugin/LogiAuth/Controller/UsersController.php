<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends LogiAuthAppController
{
    public $uses = array(
            'User', 'MailAuth', 'Setting', "ClsCode"
    );
    public $components = array(
            'LogiAuth.Fb', 'LogiAuth.Login', 'Mail', 'Common'
    );
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login', 'forgot_pass', 'reset_pass', 'register', 'confirm_mail', 'send_confirm_mail', 'mail_auth', 'reset_account_lock', 'reset_lock');
    }

    /**
     * Login
     */
    public function login()
    {
        $this->set('title', __('Đăng nhập'));
        $this->set('login_page', 1);
        if($this->Auth->user('id')){
            return $this->Login->redirect_referer();
        }
        $this->Fb->set_facebook_login_url();
        if($this->request->is('get')){
            return $this->Login->set_referer();
        }
        if(!$this->Auth->login()){
            $count = $this->User->up_login_try_count($this->request->data['User']['email']);
            if($count == 10){ //Only when the number of login attempts is 10, the account is locked and automatically send mail
                $user           = $this->User->get_user_from_email($this->request->data['User']['email']);
                $token          = $this->User->make_token();
                $lang_key = Configure::read('Config.language_key');
                $url            = h(Router::url('/', true)).'reset_lock/'.$token . '?language=' .$lang_key;
                $this->User->id = $user['User']['id'];
                if($this->User->saveField('token', $token)){
                    $lang = Configure::read('Config.language');
                    $subject = __('Tài khoản bị khóa.');

                    if($this->Mail->reset_lock($user['User']['email'], $url, $lang, $subject)){
                        if($this->request->isAjax()) {
                            exit(json_encode(array('success' => 0, 'error' => __('Tài khoản của bạn đã bị khóa. Vui lòng kiểm tra e-mail của bạn và mở khóa.'))));
                        }
                        return $this->Session->setFlash(__('Tài khoản của bạn đã bị khóa. Vui lòng kiểm tra e-mail của bạn và mở khóa.'));
                    }
                }
            }
            if($this->request->isAjax()) {
                exit(json_encode(array('success' => 0, 'error' => __('Email hoặc mật khẩu không đúng!'))));
            }
            return $this->Session->setFlash(__('Email hoặc mật khẩu không đúng!'));
        }else{ //ログイン成功
            //ログイン回数（アカウントロック）チェック
            if($this->Auth->user('login_try_count') > 9){
                $this->Auth->logout();
                $this->set('account_lock', true);

                if($this->request->isAjax()) {
                    exit(json_encode(array('success' => 0, 'error' => __('Tài khoản bị khóa. Vui lòng mở khóa từ URL được truy cập trong email của bạn.'))));
                }
                return $this->Session->setFlash(__('Tài khoản bị khóa. Vui lòng mở khóa từ URL được truy cập trong email của bạn.'));
            }else{
                //ログイン試行回数のリセット
                $this->User->reset_login_try_count($this->Auth->user('id'));
                $lang = $this->Auth->user('language') ? $this->Auth->user('language') : 'ja';
                if($this->request->isAjax()) {
                    exit(json_encode(array('success' => 1)));
                }
                return $this->Login->redirect_referer();
            }
        }
    }

    /**
     * ログアウト
     */
    public function logout()
    {
        $this->Session->delete('Google.access_token');
        $this->redirect($this->Auth->logout());
    }

    /**
     * パスワード再設定依頼画面
     */
    public function forgot_pass()
    {
        $this->set('login_page', 1);
        if($this->Auth->user('id')){
            return $this->Login->redirect_referer();
        }
        if($this->request->is('post') || $this->request->is('put')){
            if(empty($this->request->data['User']['email'])){
                return $this->redirect('/login');
            }
            $user = $this->User->get_user_from_email($this->request->data['User']['email']);
            if(!$user || $user['User']['status_cd']!==REGISTED){
                return $this->Session->setFlash(__('Địa chỉ email này chưa được đăng ký.'));
            }
            $token          = $this->User->make_token();
            $lang_key       = Configure::read('Config.language_key');
            $url            = h(Router::url('/', true)).'reset_pass/'.$token . "?language=" . $lang_key;
            $this->User->id = $user['User']['id'];
            $lang = Configure::read('Config.language');
            $subject = __('Reset mật khẩu');

            if($this->User->saveField('token', $token)){
                if($this->Mail->forgot_pass($user, $url, "$lang/forgot_pass", $subject)){
                    $this->Flash->success(__('Tôi đã gửi email về việc reset mật khẩu của bạn.'));
                    $this->redirect(array('action' => 'login'));
                }
            }
            $this->Session->setFlash(__('Không thể reset mật khẩu.'));
        }
    }

    /**
     * パスワード再設定画面
     */
    public function reset_pass($token = null)
    {
        $this->set('login_page', 1);
        if($this->Auth->user('id')){
            return $this->Login->redirect_referer();
        }
        if(empty($token)){
            $this->redirect('/');
        }
        $user = $this->User->get_user_from_token($token);
        if(!$user){
            $this->redirect('/');
        }
        if($this->request->is('post') || $this->request->is('put')){
            $this->request->data['User']['token'] = null;
            $this->User->id                       = $user['User']['id'];
            $lang = Configure::read('Config.language');
            $subject = __('Quá trình reset mật khẩu hoàn tất.');

            if($this->User->save($this->request->data, true, array(
                    'token', 'password', 'password2'
            ))
            ){
                $this->Flash->success(__('Tôi đã đặt lại mật khẩu.'));
                $this->Mail->reset_pass_complete($user, "$lang/reset_pass_complete", $subject);
                $this->redirect(array('action' => 'login'));
            }else{
                $this->Session->setFlash(__('Không thể reset mật khẩu. Xin lỗi, Vui lòng thử lại.'));
            }
        }
    }

    /**
     * アカウントロック解除　申請画面
     */
    public function reset_account_lock()
    {
        $this->set('login_page', 1);
        if($this->Auth->user('id')){
            return $this->Login->redirect_referer();
        }
        if($this->request->is('post') || $this->request->is('put')){
            if(empty($this->request->data['User']['email'])){
                return $this->redirect('/login');
            }
            $user = $this->User->get_user_from_email($this->request->data['User']['email']);
            if(!$user || $user['User']['login_try_count'] < 10 || $user['User']['status_cd']!==REGISTED){
                return $this->Session->setFlash(__('Địa chỉ thư không được đăng ký hoặc tài khoản không bị khóa.'));
            }
            $token          = $this->User->make_token();
            $url            = h(Router::url('/', true)).'reset_lock/'.$token;
            $this->User->id = $user['User']['id'];
            if($this->User->saveField('token', $token)){
                if($this->Mail->reset_lock($user['User']['email'], $url)){
                    $this->Flash->success(__('Tôi đã liên lạc với bạn về e-mail về việc phát hành khóa tài khoản.'));
                    $this->redirect(array('action' => 'login'));
                }
            }
            $this->Session->setFlash(__('Không thể xử lý bản phát hành khóa tài khoản. Xin lỗi, hãy thử lại.'));
        }
    }

    /**
     * アカウントロック解除
     */
    public function reset_lock($token = null)
    {
        if($this->Auth->user('id')){
            return $this->Login->redirect_referer();
        }
        if(empty($token)){
            $this->redirect('/');
        }
        $user = $this->User->get_user_from_token($token);
        if(!$user){
            $this->redirect('/');
        }
        if($this->User->reset_login_try_count($user['User']['id'])){
            $this->Flash->success(__('Tôi đã mở khoá tài khoản.'));
        }else{
            $this->Session->setFlash(__('Không thể hủy khóa tài khoản. Xin lỗi, hãy thử lại.'));
        }
        return $this->redirect('/login');
    }

    /**
     * メール登録画面（ユーザ新規登録時）
     */
    public function mail_auth($user_type_cd=SPONSOR)
    {
	    $this->set('title', __('Tạo tài khoản'));
        $this->set('login_page', 1);
		$this->set('user_type_cd', $user_type_cd);
		$this->set('captcha', 1);
        if($this->Auth->user('id')){
            return $this->redirect("/");
        }
		
        $this->Fb->set_facebook_login_url();
        
		if($this->request->is('post') || $this->request->is('put')){

			$user_type_cd = $this->request->data['User']['user_type_cd'];
            $email = $this->request->data['User']['email'];
			
            //check captcha
            $res_recaptcha = $this->post_captcha();
            
            if ( !$res_recaptcha ) {
                return $this->Session->setFlash(__('Captcha không đúng'));
            } 
            
            if(empty($email)){
                return $this->Session->setFlash(__('Vui lòng nhập địa chỉ email của bạn.'));
            }
			
            $user = $this->User->get_user_from_email($email);
			
            if($user && ($user['User']['status_cd']==REGISTED || $user['User']['status_cd']== WITHDRAW)){
                return $this->Session->setFlash(__('Địa chỉ email này đã được đăng ký.'));
            }
			
            if($this->Common->inBlackListMail($email)) {
                return $this->Session->setFlash(__('Địa chỉ email của bạn không được phép.'));
            }

            $this->MailAuth->begin();
            $token = $this->MailAuth->make_token();
            
			if($this->MailAuth->make_mail_auth($token, $email)){
                // $url = $this->MailAuth->make_confirm_url($user_type_cd, $token);

				if($this->_sendMailConfirmRegister($email, $token)){
                    $this->MailAuth->commit();
                    $this->Flash->success(__('Chúng tôi đã gửi một email đăng ký mới.'));
                    return $this->redirect('/');
                }
            }
			
            $this->MailAuth->rollback();
            $this->Session->setFlash(__('Không thể đăng ký địa chỉ thư. Xin lỗi, Vui lòng thử lại.'));
        }
    }

    private function _sendMailConfirmRegister($email, $token){
        $lang = Configure::read('Config.language');
        $lang_key = Configure::read('Config.language_key');
        
        $subject = __('「Mo Mo Paradise」Xác thực địa chỉ email');
        $url = Router::url('/', true)."confirm_mail/{$token}/1?language={$lang_key}";
        return $this->Mail->confirm_mail_address_register($email, $url, "$lang/verify_email_address", $subject);
    }
    /**
     * メール認証画面（新規登録かメール変更完了）/^\w{7,128}$/u
     * mail_authにuser_idがあればメール変更。なければ新規登録
     */
    public function confirm_mail($token = null, $user_type_cd=null)
    {
        $this->set('login_page', 1);
		
        if(!$token){
            return $this->redirect('/login');
        }
		
        $mail_auth = $this->MailAuth->get_mail_auth_from_token($token);
		
        if(!$mail_auth){
            return $this->redirect('/login');
        }
		
        if(!empty($mail_auth['MailAuth']['user_id'])){
            $this->change_email_complete($mail_auth);
        }else if(!is_null($user_type_cd)){
             //set Auth data to show Email on sign up
            $this->set('mail_auth', $mail_auth['MailAuth']);
            $this->register($mail_auth, $user_type_cd);
            
		} else {
			return $this->redirect('/login');
        }
    }

    /**
     * メール認証後のメールアドレス変更処理
     * @param $mail_auth
     */
    public function change_email_complete($mail_auth)
    {
        $this->set('login_page', 1);
        //メールアドレス変更
        switch($this->MailAuth->change_email($mail_auth)){
            case 1: //成功
                $this->Flash->success(__('Tôi đã đăng ký địa chỉ email của mình'));
                break;
            case 2: //Error
                $this->Session->setFlash(__('Không thể đăng ký địa chỉ email. Xin lỗi, Vui lòng thử lại'));
                break;
            case 3: //他ユーザで登録済み
                $this->Session->setFlash(__('Địa chỉ email này đã được đăng ký'));
        }
        return $this->redirect('/');
    }

    /**
     * メール認証後の新規登録
     * @param $mail_auth
     */
    public function register($mail_auth, $user_type_cd)
    {
        $this->set('captcha', 1);
        $lang = Configure::read('Config.language_key');
        $title = $user_type_cd==SPONSEE?__('受援者新規登録', true):__('新規登録', true);
        $this->set('title', $title);
        $this->set('login_page', 1);
        if($this->Auth->user('id')){
            return $this->Login->redirect_referer();
        }
		
		$this->set('user_type_cd', $user_type_cd);
		
		if ($user_type_cd == SPONSEE) { 
			$sex_cd = $this->ClsCode->getCodeAndNameByClsAdminID(SEX_CD);
			$this->set('sex_cd', $sex_cd);
		}
		
		if ($user_type_cd==SPONSEE && !$sex_cd) {
			$this->Session->setFlash(__('現在登録ページに問題が生じています。しばらく時間が経ってから再度実行してください。'));
		} else {		
			if($this->request->is('post') || $this->request->is('put')){
				
                //check captcha
                $res_recaptcha = $this->post_captcha();
                
                if ( !$res_recaptcha ) {
                    $this->Session->setFlash(__('キャプチャが一致しません。'));
                    $this->render('register');
                    return;
                } 

				$this->request->data['User']['name'] = trim($this->request->data['User']['name']);
				$this->request->data['User']['user_type_cd'] = $user_type_cd;
				$this->request->data['User']['email']     = $mail_auth['MailAuth']['email'];

				// $this->request->data['User']['password2'] = $this->request->data['User']['password'];

				$this->request->data['User']['status_cd'] = REGISTED;
				$this->request->data['User']['definitive_date'] = date('Y-m-d H:i:s');
                $this->request->data['User']['language'] = $lang;

                //track IP 
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                $this->request->data['User']['remote_ip'] = $ip;

				unset($this->request->data['User']['id']);
				$this->User->create();
				$this->User->begin();
				if ($this->User->save(
										$this->request->data, 
										true, 
										array('id', 'user_type_cd', 'sex_cd', 'status_cd', 'email','definitive_date', 'name', 'password', 'password2', 'created', 'modified', 'ether_address', 'language', 'remote_ip')
									)
				) { 
					if ($this->MailAuth->delete_mail_auth($mail_auth)) {
						$this->User->commit();
						$user = $this->User->read();
						$this->__registered_complete($user);
						// $this->Mail->registered($user, 'admin');
						
						//自動ログイン
						$user = $this->User->read();
						$this->Auth->login($user['User']);
						
						if ($user_type_cd!=SPONSEE) {
							$this->Flash->success(__('支援者会員登録が完了しました！'));
						} else {
							$this->Flash->success(__('受援者登録が完了しました！<br/>続けてコイン申請を行ってください。'));
						}
                        return $this->redirect('/token_request/');
					}
				}

				$this->User->rollback();
			}
		}
		
        $this->render('register');
    }

    /**
     * ソーシャルアカウント連携画面
     */
    public function social()
    {
        $this->layout = 'mypage';
        $this->set('user', $this->auth_user);
        $this->Fb->set_facebook_login_url();
    }

    /**
     * ソーシャル連携解除・退会関数
     * @param string $action ('withdraw', 'unlinkFacebook', 'unlinkTwitter')
     * @return void
     */
    public function deactive($action = null)
    {
        $this->set('login_page', 1);

//		if(!$this->request->is('post')){
//            $this->redirect('/');
//        }
		
        $this->User->id = $this->Auth->user('id');
        $flag           = true;
		
        if($action == 'withdraw'){ //退会
			$this->User->status_cd = WITHDRAW;
			$this->User->withdraw_date = date('Y-m-d H:i:s');
			
            if(!$this->User->save($this->User, false, array('status_cd', 'withdraw_date'))) {
                $flag = false;
            }
			
			$this->Auth->logout();
            $this->Flash->success(__('退会しました'));
			$this->redirect('/');
        }elseif($action == 'unlinkFacebook'){ //Facebook解除
            if(!$this->User->saveField('facebook_id', '')){
                $flag = false;
            }
            $this->Flash->success(__('Facebookアカウントの連携を解除しました。'));
        }elseif($action == 'unlinkTwitter'){ //Twitter解除
            if(!$this->User->saveField('twitter_id', '')){
                $flag = false;
            }
            $this->Flash->success(__('Twitterアカウントの連携を解除しました。'));
        }
        if($flag){
            if($action == 'withdraw'){
                $this->Auth->logout();
				$this->redirect('/');
            }
			
            $this->redirect('/social');
        }else{
            $this->Session->setFlash(__('処理に失敗しました。恐れ入りますが再度お試しください。'));
            return $this->Login->redirect_referer();
        }
    }

    //admin
    /**
     * 管理者ログイン画面
     */
    public function admin_login()
    {
        $this->layout = 'admin_login';
        $this->set('login_page', 1);
        if($this->request->is('post')){
            $this->Auth->logout();
            if($this->Auth->login()){
                if($this->Auth->user('user_type_cd') == ADMIN_ROLE || $this->Auth->user('user_type_cd') == EDITOR_ROLE){
                    //ログイン回数（アカウントロック）チェック
                    if($this->Auth->user('login_try_count') > 9){
                        $this->Auth->logout();
                        $this->set('account_lock', true);
                        return $this->Session->setFlash(__('Tài khoản bị khóa. Vui lòng mở khóa từ URL được truy cập trong thư của bạn.'));
                    }else{
                        //ログイン試行回数のリセット
                        $this->User->reset_login_try_count($this->Auth->user('id'));
						
						return $this->redirect(array(
                                'controller' => 'admin_dashboards', 'action' => 'admin_index', 'plugin' => false
                        ));
                    }
                }
            }
            $count = $this->User->up_login_try_count($this->request->data['User']['email']);
            if($count == 10){ //ログイン試行回数が10回のときのみ、アカウントロックされてるよメールを自動送信する
                $user           = $this->User->get_user_from_email($this->request->data['User']['email']);
                $token          = $this->User->make_token();
                $url            = h(Router::url('/', true)).'reset_lock/'.$token;
                $this->User->id = $user['User']['id'];
                if($this->User->saveField('token', $token)){
                    if($this->Mail->reset_lock($user['User']['email'], $url)){
                        return $this->Session->setFlash(__('Tài khoản của bạn đã bị khóa. Vui lòng kiểm tra e-mail của bạn và mở khóa.'));
                    }
                }
            }
            $this->Session->setFlash(__('Email hoặc mật khẩu không đúng!'));
        }
    }

    /**
     * 管理者ログアウト
     */
    public function admin_logout()
    {
        $this->Auth->logout();
        $this->redirect('/admin');
    }

    public function admin_forgot_pass()
    {
        // if($this->Auth->user('id')){
        //     return $this->Login->redirect_referer();
        // }
        if($this->request->is('post') || $this->request->is('put')){
            if(empty($this->request->data['User']['email'])){
                return $this->redirect('/admin');
            }
            $user = $this->User->get_user_from_email($this->request->data['User']['email']);
            if(!$user || $user['User']['status_cd']!==REGISTED){
                return $this->Session->setFlash(__('Địa chỉ email này chưa được đăng ký.'));
            }
            $token          = $this->User->make_token();
            $lang_key       = Configure::read('Config.language_key');
            $url            = h(Router::url('/', true)).'reset_pass/'.$token . "?language=" . $lang_key;
            $this->User->id = $user['User']['id'];
            $lang = Configure::read('Config.language');
            $subject = __('Reset mật khẩu');

            if($this->User->saveField('token', $token)){
                if($this->Mail->forgot_pass($user, $url, "$lang/forgot_pass", $subject)){
                    $this->Flash->success(__('Tôi đã gửi email về việc reset mật khẩu của bạn.'));
                    $this->redirect(array('action' => 'admin_login'));
                }
            }
            $this->Session->setFlash(__('Không thể reset mật khẩu.'));
        }
    }

    private function __registered_complete($user){
        $subject = __('「REALBOOST」Đăng ký đã hoàn tất.');
        $lang = Configure::read('Config.language');
        $this->Mail->registered_complete($user['User']['email'], $user, "$lang/registered", $subject);
    }
}
