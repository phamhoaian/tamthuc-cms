<?php
App::uses('AdminController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class AdminUsersController extends AdminController
{
    public $uses = array(
            'User', 'MailAuth'
    );
    public $components = array('Mail');

    public function beforeFilter()
    {
        parent::beforeFilter();
        parent::check_admin_user();
        $this->Auth->allow(array('hoge'));
        $this->layout = 'admin';
        if($this->action === 'edit'){
            //ajaxフォーム対策（token複数回利用可など）
            $this->Security->validatePost = false;
            $this->Security->csrfUseOnce  = false;
        }
    }

    /**
     * 管理 - ユーザー一覧
     */
    public function admin_index()
    {
         //ユーザー検索
        $email          = !empty($this->request->query['email_like']) ? $this->request->query['email_like'] : null;
        $type          = !empty($this->request->query['user_type_cd']) ? $this->request->query['user_type_cd'] : false;
        $name          = !empty($this->request->query['name_like']) ? $this->request->query['name_like'] : '';

        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        
        $this->paginate = $this->User->get_users_by_filters($email, $name ,$type, true, 10, $page, true);
        $users          = $this->paginate('User');
        return $this->set(compact('users', 'page', 'email', 'type', 'name'));
    }

    /**
     * 管理 - ユーザー詳細
     */
    public function admin_view($user_id)
    {
        $user = $this->User->findById($user_id);
        $this->set('u', $user['User']);
        if(! $user) $this->redirect('/');
    }

    /**
     * 管理 - ユーザ編集
     */
    public function admin_edit($user_id)
    {
        $user = $this->User->findById($user_id);
        $this->set('u', $user['User']);
        if(! $user || $user['User']['group_id'] == ADMIN_ROLE) $this->redirect('/');

        if($this->request->is('post') || $this->request->is('put')){
            $this->User->id = $user_id;
            if($this->User->save($this->request->data, true, array('nick_name', 'name', 'email',
                                                                   'address', 'url1', 'url2', 'url3',
                                                                   'self_description', 'receive_address')))
            {
                $this->Session->setFlash('ユーザ情報を更新しました。');
                $this->redirect('/admin/admin_users/');
            }else{
                $this->Session->setFlash('ユーザ情報の登録に失敗しました。恐れ入りますが再度お試しください。');
            }
        }else{
            $this->request->data = $user;
        }
    }

    /**
     * 管理 - ユーザ削除
     */
    public function admin_delete($user_id)
    {
        $user = $this->User->findById($user_id);
        if(! $user || $user['User']['group_id'] == ADMIN_ROLE) $this->redirect('/');
        if($this->User->withdraw($user_id)){
            $this->Session->setFlash('ユーザを削除しました');
        }else{
            $this->Session->setFlash('ユーザが削除できませんでした。恐れ入りますが再度お試しください。');
        }
        $this->redirect('/admin/admin_users');
    }

    /**
     * 管理者の編集
     */
    public function admin_owner_edit()
    {
        if($this->request->is('post') || $this->request->is('put')){
            $fields = array(
                    'nick_name', 'email'
            );
            if(!empty($this->request->data['User']['password'])){
                $fields[] = 'password';
            }
            $this->User->id                    = $this->Auth->user('id');
            $this->request->data['User']['id'] = $this->Auth->user('id');
            if($this->User->save($this->request->data, true, $fields)){
                $this->Session->setFlash('保存しました');
            }else{
                $this->Session->setFlash('保存できませんでした');
            }
        }else{
            $this->request->data = $this->auth_user;
        }
    }

    /**
     * メールアドレス変更時の処理
     * @param str $email
     * @param int $user_id
     * @return int 1 -> ok, 2 -> ng, 3 -> 他ユーザ登録済み
     */
    private function change_email($email, $user_id)
    {
        if($this->User->get_user_from_email($email)){
            return 3;
        }
        $url = $this->MailAuth->make_mail_auth_and_url_for_change($email, $user_id);
        if($url){
            if($this->Mail->confirm_mail_address($email, $url)){
                return 1;
            }
        }
        return 2;
    }

    public function admin_csv(){
        $params = $this->request->data;
        $filename = date('Y-m-d');

        $email          = !empty($this->request->data['email_like']) ? $this->request->data['email_like'] : null;
        $type          = !empty($this->request->data['user_type_cd']) ? $this->request->data['user_type_cd'] : false;
        $name          = !empty($this->request->data['name_like']) ? $this->request->data['name_like'] : '';

        switch ($type) {
            case SPONSEE:
                $filename .= '_sponsee';
                break;
            case SPONSOR:
                $filename .= '_sponsor';
                break;

            default:
                $filename .= '_sponsee_sponsor';
                break;
        }

        $results = $this->User->get_users_export($email, $name ,$type);
        
        $csv_array = $this->convertToArray($results);
        
        header('Content-type: application/octet-stream');
        if (preg_match("/MSIE 8\.0/", $_SERVER['HTTP_USER_AGENT'])) {
            header('Content-Disposition: filename=' . $filename . '.csv');
        } else {
            header('Content-Disposition: attachment; filename=' . $filename . '.csv');
        }
        header('Pragma: public');
        header('Cache-control: public');

        $arrCsvOutputCols = array('id','email','name','user_type_cd','ether_address');
        $title = array('id','email','name','type','ether address');
        foreach($title as $t_key => $t_val){
            $title[$t_key] = $t_val;
        }   
        $arrCsvOutputTitle = join(",", $title) . "\r\n";
        
        $csv_str = "";
        if ($csv_array) {
            foreach ($csv_array as $csv) {
                $cols = array();
                foreach ($arrCsvOutputCols as $val_col) {
                    $value = isset($csv[$val_col])?$csv[$val_col]:'';
                    $value = str_replace("\r", "", $value);
                    $value = str_replace("\n", "", $value);
                    $value = str_replace("\"", "\"\"", $value);
                    $value = $this->_csvCharset($value);
                    if($val_col == 'user_type_cd'){
                        switch ($value) {
                            case SPONSEE:
                                $value = 'SPONSEE';
                                break;
                            case SPONSOR:
                                $value = 'SPONSOR';
                                break;
                        }
                    }
                    array_push($cols, '"' . $value . '"'); 
                }
                $csv_str .= join(",", $cols) . "\r\n";
            }
        }        
        echo  $arrCsvOutputTitle  . $csv_str;
        exit;
        
    }

    private function convertToArray($data){
        $res = array();
        foreach ($data as $key => $item) {
            $res[$key] = $item['User'];
        }
        return $res;
    }

    private function _csvCharset($str) {
        $str = mb_convert_encoding($str, "utf-8", "auto");
        return $str;
    }

}