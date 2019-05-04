<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'Twitter/twitteroauth');

class TwitterController extends LogiAuthAppController
{

    public $uses = array(
            'User', 'MailAuth'
    );
    public $components = array(
            'LogiAuth.Tw', 'LogiAuth.Login', 'Mail'
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login', 'callback', 'password');
        if($this->Auth->user())
            return $this->redirect('/');
    }

    /**
     * Twitterログイン
     */
    public function login()
    {
        list($api_key, $api_secret, $callback_url) = $this->Tw->get_api_info();
        $Twitter       = new TwitterOAuth($api_key, $api_secret);
        $request_token = $Twitter->getRequestToken($callback_url);
        $this->Session->write('Twitter.request_token', $request_token);
        switch($Twitter->http_code){
            case 200:
                return $this->redirect($Twitter->getAuthorizeURL($request_token));
            default:
                $this->Session->setFlash('Twitterに接続できません。恐れ入りますが再度お試しください。');
                return $this->redirect('/login');
        }
    }

    /**
     * twitterコールバック
     */
    public function callback()
    {
        if(empty($_GET['oauth_token'])){
            return $this->redirect('/login');
        }
        $request_token = $this->Session->read('Twitter.request_token');
        if(!$request_token){
            return $this->redirect('/login');
        }
        list($api_key, $api_secret, $callback_url) = $this->Tw->get_api_info();
        $access_token = $this->Tw->get_access_token($api_key, $api_secret, $request_token);
        $content      = $this->Tw->get_user_info($api_key, $api_secret, $access_token);
        $user         = $this->User->findByTwitterId($content->id);
        $auth_id      = $this->Auth->user('id');
        
        //twitterが既に登録されている
        if($user){
            //他のアカウントと連携されている
            if($auth_id && $auth_id != $user['User']['id']){
                $this->Session->setFlash(__('このTwitterアカウントは他のユーザと連携されています。'));
                return $this->redirect('/login');
                //他のアカウントと連携されていない -> ログイン
            }else{
                if(!$auth_id){
                    $this->Auth->login($user['User']);
                }
                return $this->Login->redirect_referer();
            }
            //twitterは未登録
        }else{
            //ログインしている -> twitterを連携する
            if($auth_id){
                $this->User->id = $auth_id;

                //reactive user
                if( $userByMail['User']['status_cd'] == WITHDRAW ) {
                    $userByMail['User']['status_cd'] = REGISTED;
                    $this->User->saveField('status_cd', REGISTED);
                }

                if($this->User->saveField('twitter_id', $content->id)){
                    $this->User->get_twitter_profile_img($content->profile_image_url, $auth_id);
                    $this->Flash->success(__('Twitterアカウントと連携しました。'));
                }else{
                    $this->Session->setFlash(__('Twitterアカウントとの連携に失敗しました。恐れ入りますが再度お試しください。'));
                }
                return $this->redirect('/login');
                //ログインしていない -> twitterを登録する
            }else{
                $this->Session->write('twitter_user_info', $content);
                return $this->redirect(array('action' => 'password'));
            }
        }
    }

    /**
     * Twitterログイン時のメールアドレス・パスワード入力画面
     */
    public function password()
    {
        $this->set('login_page', 1);
        $this->set('captcha', 1);
        $twitter_info = $this->Session->read('twitter_user_info');
        if(empty($twitter_info)){
            $this->callback();
        }
        $this->set('twitter_info', $twitter_info);
        if($this->request->is('post') || $this->request->is('put')){
            $twitter_info = $this->Session->read('twitter_user_info');
            if(!$twitter_info){
                return $this->redirect('/login');
            }

            //check captcha
            $res_recaptcha = $this->post_captcha();
            
            if ( !$res_recaptcha ) {
                return $this->Session->setFlash(__('キャプチャが一致しません。'));
            } 

            //二重登録防止！
            if($this->User->get_user_by_twitter_id($twitter_info->id)){
                $this->Session->delete('twitter_user_info');
                $this->redirect('/');
            }
            if(empty($this->request->data['User']['email']) || empty($this->request->data['User']['password']) //||
                //empty( $this->request->data[ 'User' ][ 'password2' ] )
            ){
                return $this->Session->setFlash('全ての項目を入力してください');
            }

            $user = $this->User->findByEmail($this->request->data['User']['email']);
            if(!empty($user)){
                //既に入力したメールアドレスをもつユーザが存在する場合、入力情報でログインしてみる
                if($this->Auth->login()){
                    //ログインできたら連携する
                    $this->User->id = $user['User']['id'];
                    if($this->User->saveField('twitter_id', $twitter_info->id)){
                        //twitterプロフィール画像の取得
                        $this->User->get_twitter_profile_img($twitter_info->profile_image_url, $user['User']['id']);
                        return $this->Login->redirect_referer();
                    }else{
                        return $this->Session->setFlash(__('Twitterとの連携に失敗しました。恐れ入りますが再度お試しください。'));
                    }
                }else{
                    return $this->Session->setFlash(__('ユーザー登録に失敗しました。恐れ入りますが再度お試しください。'));
                }
            }else{
                $user[ 'User' ][ 'email' ]      = $this->request->data[ 'User' ][ 'email' ];
                $user['User']['password'] = $this->request->data['User']['password'];
                $user[ 'User' ][ 'password2' ]  = $this->request->data[ 'User' ][ 'password2' ];
                $user['User']['group_id']   = USER_ROLE;
                $user['User']['twitter_id'] = $twitter_info->id;
                $user['User']['name']       = $twitter_info->name;
                $user['User']['ether_address']       = $this->request->data[ 'User' ][ 'ether_address' ];
                $user['User']['status_cd'] = REGISTED;
                $user['User']['definitive_date'] = date('Y-m-d H:i:s');
                
                //track IP 
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                $user['User']['remote_ip'] = $ip;

                $this->User->begin();
                $this->User->create();
                $fields = array(
                        'email', 'name', 'twitter_id', 'group_id', 'password', 'created', 'modified', 'id', 'password2', 'ether_address','status_cd', 'remote_ip'
                );
                if($this->User->save($user, true, $fields)){
                        $this->User->commit();
                        
                        $user = $this->User->read();
                        $this->Auth->login($user['User']);

                        $this->User->get_twitter_profile_img($twitter_info->profile_image_url, $this->User->id);
                        $this->Session->delete('twitter_user_info');
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
