<?php
App::import('Core', 'Controller');
// App::import('Controller', 'App');
App::uses('CakeEmail', 'Network/Email');


class DividendShell extends AppShell
{
    public $uses = array(
           'Dividend'
    );
    public $components = array('Mail', 'Common');
    var $setting = null;

    public function startup()
    {
        $setting = $this->Setting->findById(1);
        $this->setting = $setting['Setting'];
    }

    
    public function main() 
    {
        
        
    }

    

    

}