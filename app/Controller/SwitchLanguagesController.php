<?php
App::uses('Controller', 'Controller');

class SwitchLanguagesController extends AppController
{
    public $components = array('Session');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('index'));
    }
    public function index($lang = DEFAULT_LANGUAGE) {

        $supported_languages = Configure::read('supported_languages');

        $language_key = DEFAULT_LANGUAGE;
        $selected_lang = $supported_languages[$language_key];
        
        if($lang) {
            if(in_array($lang, Configure::read('languages'))) {
                
                $this->Session->write('Config.language_key', $lang);
                $selected_lang = $supported_languages[$lang];
                
                Configure::write('Config.language_key', $lang);
            }
        }
        $this->Session->write('Config.language', $selected_lang);
        Configure::write('Config.language', $selected_lang);

        $referer = $this->referer();
        if(strpos($referer, '?language') != false) {
            $referer = substr($referer, 0, strpos($referer, '?language'));
        }
        $this->redirect($referer);
    }
}
