<?php

App::uses('Component', 'Controller');
App::import('Vendor', 'Google/config');

class GoogleController extends LogiAuthAppController
{

    public $uses = array(
            'User', 'MailAuth'
    );
    public $components = array(
            'LogiAuth.Google',
            'LogiAuth.Login', 'Mail'
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
        // echo 'tu tu';die;
        list($api_key, $api_secret, $callback_url) = $this->Google->get_api_info();
        //print_r($callback_url);die;
        $gClient = new Google_Client();

        $gClient->setClientId($api_key);
        $gClient->setClientSecret($api_secret);
        $gClient->setApplicationName("Login Realboost by google account");
        $gClient->setRedirectUri($callback_url);
        $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
        //$gClient->addScope(Google_Service_Oauth2::USERINFO_PROFILE);
        $gClient->setAccessType("offline");
        $gClient->setApprovalPrompt("force");
        //self::$_client->setRedirectUri(self::$_config['redirect']);

        $loginURL = $gClient->createAuthUrl();

        $google_info = $this->Session->read('google_user_info');

        if ($google_info) {

            $this->Session->delete('google_user_info');
            $this->Session->delete('Google.access_token');
            $gClient->revokeToken();
        }

        //print_r($loginURL);die;
        $this->redirect($loginURL);
         
    }

    public function callback()
    {
        list($api_key, $api_secret, $callback_url) = $this->Google->get_api_info();
        $gClient = new Google_Client();

        $gClient->setClientId($api_key);
        $gClient->setClientSecret($api_secret);
        $gClient->setApplicationName("Login Realboost by google account");
        $gClient->setRedirectUri($callback_url);
        $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

        $access_token = $this->Session->read('Google.access_token');

        if ($access_token) {

            $gClient->setAccessToken($access_token);

        } else if (isset($_GET['code'])) {
            $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->Session->write('Google.access_token', $token);
        } else {
            return $this->redirect('/login');
        }

        $oAuth = new Google_Service_Oauth2($gClient);
        $userData = $oAuth->userinfo_v2_me->get();
         
        $user         = $this->User->findByGoogleId($userData->id);
        $auth_id      = $this->Auth->user('id');
        $userByMail   = $this->User->findByEmail($userData->email);
         
        $google_user_info = [
            'email' => $userData->email,
            'id'    => $userData->id,
            'name'  => $userData->name
        ];
        if ($userByMail) {

            if($auth_id && $auth_id != $userByMail['User']['id']){
                $this->Session->setFlash(__('このGoogleアカウントは他のユーザと連携されています。'));
                return $this->redirect('/login');
                
            }else{
                $this->User->id = $userByMail['User']['id'];

                //reactive user
                if( $userByMail['User']['status_cd'] == WITHDRAW ) {
                    $userByMail['User']['status_cd'] = REGISTED;
                    $this->User->saveField('status_cd', REGISTED);
                }
                if($this->User->saveField('google_id', $userData->id)) {
                    if(!$auth_id){
                        $this->Auth->login($userByMail['User']);
                    }
                    return $this->Login->redirect_referer();
                }
                 
            }
        }

        if($user){
             
            if($auth_id && $auth_id != $user['User']['id']){
                $this->Session->setFlash(__('このGoogleアカウントは他のユーザと連携されています。'));
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
                if($this->User->saveField('google_id', $userData->id)){
                     
                    $this->Flash->success(__('Googleアカウントと連携しました。'));
                }else{
                    $this->Session->setFlash(__('Googleアカウントとの連携に失敗しました。恐れ入りますが再度お試しください。'));
                }
                return $this->redirect('/login');
                //ログインしていない -> Googleを登録する
            }else{
                $this->Session->write('google_user_info', $google_user_info);
                return $this->redirect(array('action' => 'password'));
            }
        }


    }


    public function password()
    {
        $this->set('login_page', 1);
        $google_info = $this->Session->read('google_user_info');
        $this->set('captcha', 1);
        if(empty($google_info)){
            $this->callback();
        }
        $this->set('google_info', $google_info);
        if($this->request->is('post') || $this->request->is('put')){

            $google_info = $this->Session->read('google_user_info');
            //print_r($google_info);die;

            if(!$google_info){
                return $this->redirect('/login');
            }

            //check captcha
            $res_recaptcha = $this->post_captcha();
            
            if ( !$res_recaptcha ) {
                return $this->Session->setFlash(__('キャプチャが一致しません。'));
            } 
            
            //二重登録防止！
            if($this->User->findByGoogleId($google_info['id'])) {
                $this->Session->delete('google_user_info');
                $this->redirect('/');
            }
            if(empty($this->request->data['User']['email']) || empty($this->request->data['User']['password']) 
            ){
                return $this->Session->setFlash('全ての項目を入力してください');
            }
 
            $user = $this->User->findByEmail($this->request->data['User']['email']);
            if(!empty($user)){
                 
                if($this->Auth->login()){
                     
                    $this->User->id = $user['User']['id'];
                    if($this->User->saveField('google_id', $google_info['id'])){
                        return $this->Login->redirect_referer();
                    }else{
                        return $this->Session->setFlash(__('Googleとの連携に失敗しました。恐れ入りますが再度お試しください。'));
                    }
                }else{
                    return $this->Session->setFlash(__('ユーザー登録に失敗しました。恐れ入りますが再度お試しください。'));
                }
            }else{
                $user[ 'User'][ 'email' ]      = $this->request->data[ 'User' ][ 'email' ];
                $user['User']['password'] = $this->request->data['User']['password'];
                $user['User']['password2' ]  = $this->request->data[ 'User' ][ 'password2' ];
                $user['User']['group_id']   = USER_ROLE;
                $user['User']['google_id'] = $google_info['id'];
                $user['User']['name']       = $this->request->data['User']['name'];
                $user['User']['ether_address'] = $this->request->data[ 'User' ][ 'ether_address' ];
                $user['User']['status_cd'] = REGISTED;
                $user['User']['definitive_date'] = date('Y-m-d H:i:s');
                
                //track IP 
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                $user['User']['remote_ip'] = $ip;

                $this->User->begin();
                $this->User->create();
                $fields = array(
                        'email', 'name', 'google_id', 'group_id', 'password', 'created', 'modified', 'id', 'password2', 'ether_address','status_cd', 'remote_ip'
                );
                if($this->User->save($user, true, $fields)){
                    
                        $this->User->commit();
                        
                        $user = $this->User->read();
                        $this->Auth->login($user['User']);

                        $this->Session->delete('google_user_info');
                        $this->Flash->success(__('支援者会員登録が完了しました！'));
                        return $this->redirect('/token_request/');
                }
                $this->User->rollback();
                $this->Session->setFlash(__('ユーザー登録に失敗しました。恐れ入りますが再度お試しください。'));
                return;
            }
        }
    }

    
}