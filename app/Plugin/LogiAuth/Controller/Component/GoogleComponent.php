<?php

App::uses('Component', 'Controller');
App::import('Vendor', 'Google/config');

 

class GoogleComponent extends Component
{

    public function initialize(Controller $controller)
    {
        $this->controller = $controller;
    }


    public function get_api_info()
    {
        $url = h(Router::url('/gg_callback', true));
        $url = str_replace('http://', 'https://', $url );
        
        // if(isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])){
        //     $url = str_replace('http://', 'https://', $url );
        // }
        // if(empty($this->controller->setting['google_api_key'])
        //    || empty($this->controller->setting['google_api_secret'])
        // ){
        //     if(!GG_API_KEY || !GG_API_SECRET){
        //         return $this->controller->redirect('/login');
        //     }
        //     $url = h(Router::url('/gg_callback', true));
        //     if(isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])){
        //         $url = str_replace('http://', 'https://', $url );
        //     }
        //     $this->log($url);
        //     return array(
        //             GG_API_KEY, GG_API_SECRET, $url
        //     );
        // }
        return array(
            $this->controller->setting['google_api_key'],
            $this->controller->setting['google_api_secret'],
            $url
        );
    }
    
}




































