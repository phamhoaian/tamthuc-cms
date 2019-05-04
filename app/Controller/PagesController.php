<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController
{

    public $uses = array();

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('display');

        $this->layout = "page";
    }

    /**
     * Displays a view
     * @throws NotFoundException
     * @throws Exception
     * @throws MissingViewException
     * @internal param \What $mixed page to display
     * @return void
     */
    public function display()
    {
        $lang_key = Configure::read('Config.language_key');
        
        $path  = func_get_args();
        $count = count($path);
        if(!$count){
            return $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;
        if(!empty($path[0])){
            $page = $path[0];
        }
        if(!empty($path[1])){
            $subpage = $path[1];
        }
        if(!empty($path[$count - 1])){
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        
        $path = implode('/', $path);

        $this->set(compact('page', 'subpage', 'title_for_layout', 'path'));
        //ログイン画面のデザインを反映
        $this->set('login_page', 1);
        try{
            $this->render($path . '/' .$lang_key);
        }catch(MissingViewException $e){
            if(Configure::read('debug')){
                throw $e;
            }
            throw new NotFoundException();
        }
    }
}
