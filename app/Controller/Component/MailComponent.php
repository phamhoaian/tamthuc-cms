<?php
App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Class MailComponent
 * Mail共有コンポーネント
 */
class MailComponent extends Component
{

    public function initialize(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * お問い合わせメール 送信関数
     */
    public function contact($data, $type)
    {
        return $this->mail('contact', compact('data'), $type, $data['Contact']['mail']);
    }

    /**
     * メール作成送信関数
     * @param string $template  メールテンプレート名（定数、フィールド名も同じ）小文字
     * @param array  $vars      (viewに渡す変数)
     * @param string $mail_type ('admin' or 'user')
     * @param string $email     ('typeがadminの場合不要')
     * @return bool
     */
    public function mail($template, $vars, $mail_type, $email = null, $subject = null, $format = 'text')
    {
        $setting = $this->controller->setting;
        if($setting){
            $from    = $setting['from_mail_address'];
            if($subject == null) {
                $subject = $setting['site_name'].' - '.constant(strtoupper($template).'_SUBJECT');
            }
            if($mail_type == 'admin'){
                $email   = $setting['admin_mail_address'];
                $subject = '['.__('Admin').'] '.$subject;
            }
            $vars['setting'] = $setting;
            if($this->send_mail($email, $template, $from, $subject, $vars, $format)){
                return true;
            }
        }
        return false;
    }

    /**
     * メール送信関数
     */
    public function send_mail($email, $template, $from, $subject, $viewVars, $format)
    {
        $setting = $this->controller->setting;
        Configure::write('debug', 2);
        try{ //ユーザ向け
            $Email = new CakeEmail('default');
            $Email->charset = 'utf-8';
            $Email->to($email);
            $Email->emailFormat($format);
            $Email->template($template);
            $Email->from(array($from => $setting['site_name']));
            $Email->subject($subject);
            $Email->viewVars($viewVars);
            $Email->send();
        }catch(Exception $e){
            $this->log('error : send_mail');
            $this->log($e->getMessage());
            return false;
        }
        return true;
    }

    /**
     * メールアドレス認証用メール 送信関数
     */
    public function confirm_mail_address($email, $url, $user_type_cd)
    {
        return $this->mail('confirm_mail_address', compact('url', 'user_type_cd'), 'user', $email);
    }

    /**
     * ユーザ登録完了メール　送信関数
     */
    public function registered($user, $type)
    {
        return $this->mail('registered', compact('user'), $type, $user['User']['email']);
    }

    /**
     * パスワード忘れメール　送信関数
     */
    public function forgot_pass($user, $url, $template, $subject = null)
    {
        return $this->mail($template, compact('user', 'url'), 'user', $user['User']['email'], $subject, 'html');
    }

    /**
     * アカウントロック解除メール　送信関数
     */
    public function reset_lock($email, $url, $lang = 'jpn', $subject = null)
    {
        return $this->mail("$lang/reset_lock", compact('email', 'url'), 'user', $email, $subject, 'html');
    }

    /**
     * パスワード再設定完了メール　送信関数
     */
    public function reset_pass_complete($user, $template, $subject = null)
    {
        return $this->mail($template, compact('user'), 'user', $user['User']['email'], $subject, 'html');
    }
	
    /**
     * コイン申請通知
     */
    public function coin_request($user, $sponsee, $setting ,$type)
    {
        return $this->mail('coin_request', compact('user', 'sponsee', 'setting'), $type, $user['User']['email']);
    }

	/**
     * コイン作成登録通知
     */
    public function coin_create($user, $setting ,$type)
    {
        return $this->mail('coin_create', compact('user', 'setting'), $type, $user['User']['email']);
    }
	
    /**
     * 支援完了メール（管理者・プロジェクトオーナー向け）　送信関数
     */
//    public function back_complete_owner($owner, $backer, $project, $backed_project, $type)
//    {
//        return $this->mail('back_complete_owner', compact('owner', 'backer', 'project', 'backed_project'), $type, $owner['User']['email']);
//    }

    /**
     * 支援完了メール（支援者向け）　送信関数
     */
//    public function back_complete_backer($backer, $project, $backed_project)
//    {
//        return $this->mail('back_complete_backer', compact('backer', 'project', 'backed_project'), 'user', $backer['User']['email']);
//    }

    /**
     * メッセージ送信通知関数
     */
//    public function messaged($to_user, $from_user, $msg, $url)
//    {
//        return $this->mail('messaged', compact('to_user', 'from_user', 'msg', 'url'), 'user', $to_user['email']);
//    }

    /**
     * Email after request coin creation
     */
    public function thanks_for_register_coin($email, $to_user, $template, $subject = null)
    {
        return $this->mail($template, compact('to_user'), 'user', $email, $subject, 'html');
    }

    /**
     * Email after request to judge
     */
    public function request_confirm($email, $url, $template, $subject = null)
    {
        return $this->mail($template, compact('url'), 'user', $email, $subject, 'html');
    }

    /**
    * Email after confirm email
    */
    public function thanks_for_request($email, $to_user, $template, $subject = null) {
        return $this->mail($template, compact('to_user'), 'user', $email, $subject, 'html');
    }
    
    /**
    * Email after created coin by admin
    */
    public function complete_coin_creating($email, $to_user, $template, $subject = null) {
        return $this->mail($template, compact('to_user'), 'user', $email, $subject, 'html');
    }
    
    /**
     * Sending email when admin rejected request
     */   
    public function reject_request_of_judgement($email, $to_user, $template, $subject = null) {
        return $this->mail($template, compact('to_user'), 'user', $email, $subject, 'html');
    }

    /**
     * Sending email when sponsee recevie reward coin
     */   
    public function send_reward_coin_to_sponsee($email, $to_user, $template, $subject = null, $coin, $coin_symbol) {
        return $this->mail($template, compact('to_user','coin', 'coin_symbol'), 'user', $email, $subject, 'html');
    }
    /**
     * Sending email when admin accepted request
     */   
    public function accept_request_of_judgement($email, $to_user, $template, $subject = null) {
        return $this->mail($template, compact('to_user'), 'user', $email, $subject, 'html');
    }

    /**
    * Send request judge to admin
    */

    public function send_admin_judge($user_email, $url, $template, $subject) {
        return $this->mail($template, compact('user_email', 'url'), 'admin', null, $subject, 'html');
    }

    /**
    * Send request create coin to admin
    */
    public function send_admin_create_coin($user_email, $url, $template, $subject) {
        return $this->mail($template, compact('user_email', 'url'), 'admin', null, $subject, 'html');
    }

    /**
    * Confirm register email
    */
    public function confirm_mail_address_register($email, $url, $template, $subject)
    {
        return $this->mail($template, compact('url'), 'user', $email, $subject, 'html');
    }

    /**
    * Register completely
    */
    public function registered_complete($email, $user, $template, $subject) {
        return $this->mail($template, compact('user'), 'user', $email, $subject, 'html');
    }

    public function send_admin_request_update_address($url, $sponsee_name, $template, $subject) {
        return $this->mail($template, compact('url','sponsee_name'), 'admin', null, $subject, 'html');
    }

     public function send_user_change_received_address($email, $to_user, $before_address, $after_address, $template, $subject = null) {
        return $this->mail($template, compact('to_user','before_address', 'after_address'), 'user', $email, $subject, 'html');
    }

    public function complete_buy_content($email, $to_user, $sponsee_name, $content_title, $url, $template, $subject=null) {
        return $this->mail($template, compact('to_user','sponsee_name', 'content_title', 'url'), 'user', $email, $subject, 'html');
    }

    public function reject_coin_card_update($email, $to_user, $template, $subject=null) {
        return $this->mail($template, compact('to_user'), 'user', $email, $subject, 'html');
    }

    public function accept_coin_card_update($email, $to_user, $template, $subject=null) {
        return $this->mail($template, compact('to_user'), 'user', $email, $subject, 'html');
    }

    public function update_coin_card($user_email, $url, $template, $subject=null)
    {
        return $this->mail($template, compact('user_email', 'url'), 'admin', null, $subject, 'html');
    }

     public function send_admin_send_dividend($url, $template, $subject) {
        return $this->mail($template, compact('url'), 'admin', null, $subject, 'html');
    }
}