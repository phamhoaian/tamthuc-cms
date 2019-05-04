<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController
{

    public $uses = array(
            'User', 'Project', 'BackedProject', 'MailAuth'
    );
    public $components = array('Mail');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('view'));
        if($this->action === 'edit'){
            //ajaxフォーム対策（token複数回利用可など）
            $this->Security->validatePost = false;
            $this->Security->csrfUseOnce  = false;
        }
    }

    /**
     * プロフィール画面
     * @param int    $user_id
     * @param string $mode (backed or registered) ※backedはnullでもよい
     * @return \CakeResponse
     */
    public function view($user_id = null, $mode = null)
    {
        $user = $this->User->findById($user_id);
        if(!$user || !$user['User']['active']){
            $this->redirect('/');
        }
        $this->set(compact('user'));
        $this->set('categories', $this->Project->Category->find('list'));
        if(!$mode || $mode == 'backed'){ //ユーザーが特定サイトで支援したプロジェクト一覧
            //サブメニュー用変数
            $this->set('menu_mode', 'backed');
            //プロジェクト取得
            $this->paginate = $this->Project->get_back_pj_of_user($user_id, 'options', 'all', 10);
            $this->set('projects', $this->paginate('Project'));
            return $this->render('view', 'profile');
        }else{
            //サブメニュー用変数
            $this->set('menu_mode', 'registered');
            //作成したプロジェクト一覧取得
            $this->paginate = $this->Project->get_pj_of_user($user_id, 'options', 'all', 10);
            $this->set('projects', $this->paginate('Project'));
            return $this->render('registered', 'profile');
        }
    }

    

    /**
     * パスワード変更画面
     */
    public function change_password()
    {
        $this->layout = 'mypage';
        if($this->request->is('post') || $this->request->is('put')){
            $this->User->id = $this->Auth->user('id');
            if($this->User->save($this->request->data, true, array('password'))){
                $this->Flash->success(__('パスワードを変更しました。'));
                $this->redirect(array('action' => 'edit'));
            }else{
                $this->Session->setFlash(__('パスワードが保存できませんでした。恐れ入りますが再度お試しください。'));
            }
        }
        $user = $this->User->findById($this->Auth->user('id'));
        $this->set(compact('user'));
    }

    /**
     * 退会
     */
    public function delete($user_id)
    {
        if(!$this->request->is('post') || $this->Auth->user('id') != $user_id){
            return $this->redirect('/');
        }
        if($this->_chk_user_status($user_id)){
            if($this->User->withdraw($user_id)){
                $this->Auth->logout();
                $this->Flash->success('退会処理が完了しました。ご利用ありがとうございました。');
                return $this->redirect('/');
            }else{
                $this->Session->setFlash('退会処理に失敗しました。恐れ入りますが、再度お試しください。');
                return $this->redirect(array('action' => 'edit'));
            }
        }else{
            $this->Session->setFlash('プロジェクト作成や支援をされている場合、退会できません。');
            return $this->redirect(array('action' => 'edit'));
        }
    }

    /**
     * ユーザ状態チェック
     * プロジェクトを公開していないか？
     * プロジェクトに支援していないか？
     * @params int $user_id
     * @return bool (trueなら削除可能)
     */
    private function _chk_user_status($user_id)
    {
        if($this->Project->chk_user_opened_pj($user_id)){
            if(!$this->Project->BackedProject->findByUserId($user_id)){
                return true;
            }
        }
        return false;
    }

}