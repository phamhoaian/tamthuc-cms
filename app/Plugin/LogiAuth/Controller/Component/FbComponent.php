<?php
App::uses('Component', 'Controller');
// App::import('Vendor', 'Facebook/facebook');
App::import('Vendor', 'Facebook/Autoload');

/**
 * Class FbComponent
 * Facebook API操作コンポーネント
 */
class FbComponent extends Component
{
    public $components = array(
            'Session', 'Auth'
    );

    public function initialize(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Facebook Login URlのセット関数
     */
    public function set_facebook_login_url()
    {
        $Facebook = $this->get_facebook();
        if($Facebook){
            $url = Router::url(array(
                'controller' => 'facebook', 'action' => 'callback', 'plugin' => 'LogiAuth'
            ), true);
            if(isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])){
                $url = str_replace('http://', 'https://', $url );
            }
            $params = [
                'scope'        => 'email',
                'redirect_uri' => $url, 
                'auth_type'    => 'reauthenticate',
                'auth_nonce'   => md5(uniqid(mt_rand(), true))
            ];
            //$this->controller->set('facebook_login_url', $Facebook->getLoginUrl($params));
            //return true;
            return $Facebook->getLoginUrl($params);
        }else{
            return false;
        }
    }

    /**
     * Facebook Obj作成関数
     */
    public function get_facebook()
    {
        if(empty($this->controller->setting['facebook_api_key'])
           || empty($this->controller->setting['facebook_api_secret'])
        ){
            if(!FB_API_KEY || !FB_API_SECRET){
                return null;
            }
            return new Facebook(array(
                    'appId' => FB_API_KEY, 'secret' => FB_API_SECRET, 'cookie' => true,
            ));
        }
        // return new Facebook(array(
        //         'appId' => $this->controller->setting['facebook_api_key'],
        //         'secret' => $this->controller->setting['facebook_api_secret'], 'cookie' => true,
        // ));
    }

    public function get_api_info()
    {
        $url = h(Router::url('/fb_callback', true));
        $url = str_replace('http://', 'https://', $url );
        // $url = h(Router::url('/fb_callback', true));
        // if(isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])){
        //     $url = str_replace('http://', 'https://', $url );
        // }
        // if(empty($this->controller->setting['facebook_api_key'])
        //    || empty($this->controller->setting['facebook_api_secret'])
        // ){
        //     if(!FB_API_KEY || !FB_API_SECRET){
        //         return $this->controller->redirect('/login');
        //     }
        //     $url = h(Router::url('/fb_callback', true));
        //     if(isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])){
        //         $url = str_replace('http://', 'https://', $url );
        //     }
        //     $this->log($url);
        //     return array(
        //             FB_API_KEY, FB_API_SECRET, $url
        //     );
        // }
        return array(
            $this->controller->setting['facebook_api_key'],
            $this->controller->setting['facebook_api_secret'],
            $url
        );
    }

}