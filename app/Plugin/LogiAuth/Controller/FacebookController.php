<?php
App::uses('Component', 'Controller');
//App::import('Vendor', 'Facebook/facebook');
App::import('Vendor', 'Facebook/autoload');

class FacebookController extends LogiAuthAppController
{
    public $uses = array(
            'User', 'MailAuth'
    );
    public $components = array(
            'LogiAuth.Fb', 'LogiAuth.Login', 'Mail'
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login', 'callback', 'password');
        if($this->Auth->user())
            return $this->redirect('/');
    }

 
    public function login()
    {

        list($api_key, $api_secret, $callback_url) = $this->Fb->get_api_info();

        $fb = new Facebook\Facebook([
            'app_id'                => $api_key,
            'app_secret'            => $api_secret,
            'default_graph_version'   => 'v2.4',
            'persistent_data_handler' => 'session'
        ]);
         

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        $loginUrl = $helper->getLoginUrl($callback_url, $permissions);

        $this->redirect($loginUrl);

       
    }

    public function callback() 
    {
        list($api_key, $api_secret, $callback_url) = $this->Fb->get_api_info();
        $fb = new Facebook\Facebook([
            'app_id'                => $api_key,
            'app_secret'            => $api_secret,
            'default_graph_version'   => 'v2.4',
            'persistent_data_handler' => 'session'
        ]);
        $helper = $fb->getRedirectLoginHelper();
        try {
            $setting = $this->setting();
            $accessToken = $helper->getAccessToken( $setting['site_url'] . 'fb_callback' );
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        if (!isset($accessToken)) {
            return $this->redirect('/login');
        }
        $_SESSION['facebook_access_token'] = (string) $accessToken;
            
        $response = $fb->get('/me?locale=en_US&fields=name,email', $_SESSION['facebook_access_token'] );
        $userData = $response->getGraphUser();
        $userByMail   = $this->User->findByEmail($userData['email']);
        $user         = $this->User->findByFacebookId($userData['id']);
        $auth_id      = $this->Auth->user('id');

        
        $facebook_user_info = [
            'email' => isset($userData['email']) ? $userData['email'] : '',
            'id'    => $userData['id'],
            'name'  => $userData['name']
        ];

        if ($userByMail) {
            if($auth_id && $auth_id != $userByMail['User']['id']){
                $this->Session->setFlash(__('このFacebookアカウントは他のユーザと連携されています。'));
                return $this->redirect('/login');
                
            }else{
                $this->User->id = $userByMail['User']['id'];

                //reactive user
                if( $userByMail['User']['status_cd'] == WITHDRAW ) {
                    $userByMail['User']['status_cd'] = REGISTED;
                    $this->User->saveField('status_cd', REGISTED);
                }

                if($this->User->saveField('facebook_id', $userData['id'])) {
                    if(!$auth_id){
                        $this->Auth->login($userByMail['User']);
                    }
                    return $this->Login->redirect_referer();
                }
                 
            }
        }

        if($user){
             
            if($auth_id && $auth_id != $user['User']['id']){
                $this->Session->setFlash(__('このFacebookアカウントは他のユーザと連携されています。'));
                return $this->redirect('/login');
                
            }else{
                if(!$auth_id){
                    $this->Auth->login($user['User']);
                }
                return $this->Login->redirect_referer();
            }
             
        }else{
             
            if($auth_id){
                $this->User->id = $auth_id;
                if($this->User->saveField('facebook_id', $userData['id)'])) { 
                     
                    $this->Flash->success(__('Facebookアカウントと連携しました。'));
                }else{
                    $this->Session->setFlash(__('Facebookアカウントとの連携に失敗しました。恐れ入りますが再度お試しください。'));
                }
                return $this->redirect('/login');
                //ログインしていない -> Facebookを登録する
            }else{
                $this->Session->write('facebook_user_info', $facebook_user_info);
                return $this->redirect(array('action' => 'password'));
            }
        }
    }
    
 
    public function password()
    {
        $this->set('login_page', 1);
        $facebook_info = $this->Session->read('facebook_user_info');
        $this->set('captcha', 1);
        if(!$facebook_info){
            $this->redirect('/');
        }
        $this->set('facebook_info', $facebook_info);
        // print_r($facebook_info);die;

        if($this->request->is('post') || $this->request->is('put')){

            if(empty($this->request->data['User']['password']))// || empty($this->request->data['User']['password2']))
            {
                $this->Session->setFlash('パスワードを入力してください');
                return;
            }

            //check captcha
            $res_recaptcha = $this->post_captcha();
            
            if ( !$res_recaptcha ) {
                return $this->Session->setFlash(__('キャプチャが一致しません。'));
            } 
            
            $user = $this->User->findByEmail($this->request->data['User']['email']);
            if(!empty($user)){

                if($this->Auth->login()){
                     
                    $this->User->id = $user['User']['id'];
                    if($this->User->saveField('facebook_id', $facebook_info['id'])){
                        $this->Session->setFlash(__('Facebookと連携しました。'));
                        return $this->Login->redirect_referer();
                    }else{
                        return $this->Session->setFlash(__('Facebookとの連携に失敗しました。恐れ入りますが再度お試しください。'));
                    }
                }else{
                    return $this->Session->setFlash(__('ユーザー登録に失敗しました。恐れ入りますが再度お試しください。'));
                }
            } else {


                $user['User']['email']       =  $this->request->data['User']['email'];
                $user['User']['name']        = $facebook_info['name'];
                $user['User']['name']        = $this->request->data['User']['name'];
                $user['User']['facebook_id'] = $facebook_info['id'];
                $user['User']['password']    = $this->request->data['User']['password'];
                $user['User']['ether_address'] = $this->request->data[ 'User' ][ 'ether_address' ];
                //$user['User']['password2'] = $this->request->data['User']['password2'];
                $user['User']['group_id'] = USER_ROLE;
                $user['User']['status_cd'] = REGISTED;
                $user['User']['definitive_date'] = date('Y-m-d H:i:s');
                //track IP 
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                $user['User']['remote_ip'] = $ip;

                $this->User->begin();
                $this->User->create();
                $fields = array(
                        'email', 'name', 'facebook_id', 'group_id', 'password', 'created', 'modified', 'id', 'password2', 'ether_address','status_cd', 'remote_ip'
                );
                 
                if($this->User->save($user, true, $fields)){
                     
                    $this->__registered_complete($user);
                    $this->User->commit();
                    $user = $this->User->read();
                    $this->Auth->login($user['User']);

                    $this->Session->delete('facebook_user_info');
                    $this->Flash->success(__('支援者会員登録が完了しました！'));
                    return $this->redirect('/token_request/');

                }

                $this->User->rollback();
                 $this->Session->setFlash(__('ユーザー登録に失敗しました。恐れ入りますが再度お試しください。'));
                return;
            }
        }
    }

    private function __registered_complete($user){
        $subject = __('「REALBOOST」本登録が完了いたしました。');
        $lang = Configure::read('Config.language');
        $this->Mail->registered_complete($user['User']['email'], $user, "$lang/registered", $subject);
    }

    private function setting()
    {
        $setting = $this->Setting->find('first');
        return $setting['Setting'];
    }
}
