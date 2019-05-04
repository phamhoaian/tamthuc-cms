<?php
App::import('Core', 'Controller');
App::import('Controller', 'App');
App::uses('CakeEmail', 'Network/Email');


class CronShell extends AppShell
{
    public $uses = array(
            'Contribution',
            'ContributionContent',
            'ContributorName',
            'ViewSponseeBasicInfo',
            'Reward',
            'Setting'
    );
    public $components = array('Mail', 'Common');
    var $setting = null;

    public function startup()
    {
        $this->setting = $this->Setting->findById(1);
    }

    
    public function main() 
    {
        $this->log(date('Y-m-d H:i:s') . '| Cron Reward: ', LOG_DEBUG );
        $this->autoRender = false;
        $today    = date('Y-m-d H:i');
        $time_now = date('H:i');
        // if ($time_now != "09:00") {
        //     exit(json_encode(array('state' => 'error', 'error' => 'Not this time')));
        // }
        $isUpdated = $this->Reward->find('first', ['conditions' => ['DATE_FORMAT(created, "%Y-%m-%d")' => date('Y-m-d')]]);
        if (!empty($isUpdated)) {
            exit(json_encode(array('state' => 'error', 'error' => 'The data has already been updated by system at '.$isUpdated['Reward']['created'])));
        }
       
        $date_start   = date('Y-m-d 08:00',strtotime($today . "-1 days"));
        $date_end     = date_format(new DateTime($today), 'Y-m-d 08:00');
        //echo $date_start.'-to-'.$date_end;die;

        $contributions = $this->Contribution->find('all',[
            'conditions' => array(
                                    'DATE_FORMAT(Contribution.modified, "%Y-%m-%d %H:%I") BETWEEN ? AND ?' => [$date_start, $date_end],
                                    'Contribution.status_cd' =>  CONTRIBUTION_STATUS_OPENED,
                                    'Contribution.reward_cd' => NULL
                                ),
            'joins' => array(
                            array(
                                'type' => 'LEFT',
                                'table' => 'contribution_contents',
                                'alias' => 'ContributionContent', 
                                'conditions' => array('`Contribution`.`id`=`ContributionContent`.`contribution_id`')
                            ),
                            array(
                                'type' => 'INNER',
                                'table' => 'view_sponsee_basic_infos',
                                'alias' => 'ViewSponseeBasicInfo', 
                                'conditions' => array('`Contribution`.`sponsee_id`=`ViewSponseeBasicInfo`.`sponsee_id`')
                            ),
                            array(
                                'type' => 'LEFT',
                                'table' => 'contributor_names',
                                'alias' => 'ContributorName', 
                                'conditions' => array('`Contribution`.`contributor_id`=`ContributorName`.`id`')
                            ),
                            array(
                                'type' => 'LEFT',
                                'table' => 'coins',
                                'alias' => 'Coin',
                                'conditions' => array('`Coin`.`sponsee_id`=`Contribution`.`sponsee_id`')
                            )
                    
                        ),
             
            'fields' => array('Contribution.*', 'ContributionContent.*', 'ContributorName.contributor_name','ViewSponseeBasicInfo.sponsee_name','Coin.coin_address','Coin.received_address'),
            'order' => array(
                        "Contribution.created"  => "desc", 
                        "Contribution.id"       => "desc"
                    ),
        ]);
    
        $list_sponsees = $this->calculateCoin($contributions);

        if (empty($list_sponsees)) {
            exit(json_encode(array('state' => 'error', 'error' => 'Not Found Data')));
        }

        $reward_data = array();
        foreach ($list_sponsees as $k => $sponsee) {
            if ($sponsee['coin'] < 50)  {
                unset($list_sponsees[$k]);
                continue;
            }
           
            $reward_data[] = [
                'sponsee_id'  => $k,
                'coin_values' => $sponsee['coin'] > 500 ? 500 : $sponsee['coin'],
                'status_cd'   => null
            ];
            $this->log(date('Y-m-d H:i:s') . '| data: ' . json_encode($reward_data), LOG_DEBUG );
        }
        if($reward_data) {
            $this->Reward->begin();
            if ($this->Reward->saveMany($reward_data)) {
                $this->Reward->commit();
            } else {
                $this->Reward->rollback();
                exit(json_encode(array('state' => 'error', 'error' => 'Updated fail')));
            }
            if ($this->_sendMailRewardCoin($list_sponsees)) {
                exit(json_encode(array('state' => 'success', 'message' => 'This data has been updated successfully')));
            }
        }
    }

    private function _sendMailRewardCoin($list_sponsees) {

        $supported_languages = Configure::read('supported_languages');
        $language_key = !empty($user['User']['language']) ? $user['User']['language'] : DEFAULT_LANGUAGE;
        $lang = $supported_languages[$language_key];
        $subject = __('コイン報酬送信依頼').' '.date('Y-m-d H:i');
        $url = Router::url('/', true)."admin/admin_reward_coin/";
        
        return $this->noti_reward_coin_to_admin($url, "jpn/reward_coin", $subject, json_encode($list_sponsees));
    }
    public function noti_reward_coin_to_admin($url, $template, $subject, $sponsees) {
        return $this->mail($template, compact('url', 'sponsees'), 'admin', null, $subject, 'html');
    }
    public function mail($template, $vars, $mail_type, $email = null, $subject = null, $format = 'text')
    {
        $setting = $this->setting['Setting'];
        if($setting){
            $from    = $setting['from_mail_address'];
            if($subject == null) {
                $subject = $setting['site_name'].' - '.constant(strtoupper($template).'_SUBJECT');
            }
            if($mail_type == 'admin'){
                $email   = $setting['admin_mail_address'];
                $subject = '[管理] '.$subject;
            }
            $vars['setting'] = $setting;
            if($this->send_mail($email, $template, $from, $subject, $vars, $format)){
                return true;
            }
        }
        return false;
    }
    public function send_mail($email, $template, $from, $subject, $viewVars, $format)
    {
        $setting = $this->setting['Setting'];
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

    public function calculateCoin($data) {

        $list_sponsees = [];
        $spec_char    = [',',' ', '_', ';', '.', 'Your browser does not support HTML5 video'];
        $spec_char_en = [',', '_', ';', '.', 'Your browser does not support HTML5 video'];


        foreach ($data as $key => $contri) {
            //1 word = 1 coin
            if (!isset($list_sponsees[$contri['Contribution']['sponsee_id']])) {
                $list_sponsees[$contri['Contribution']['sponsee_id']]['coin'] = 0;
            }
            // $list_sponsees[$contri['Contribution']['sponsee_id']]['contribution_id'] = $contri['Contribution']['id'];
            $list_sponsees[$contri['Contribution']['sponsee_id']]['sponsee_name'] = $contri['ViewSponseeBasicInfo']['sponsee_name'];
            $list_sponsees[$contri['Contribution']['sponsee_id']]['coin_address'] = $contri['Coin']['coin_address'];
            $list_sponsees[$contri['Contribution']['sponsee_id']]['received_address'] = $contri['Coin']['received_address'];

            $num_images = substr_count( $contri['Contribution']['content'], '<img src' );
            $num_video  = substr_count( $contri['Contribution']['content'], '<video' );
            $list_sponsees[$contri['Contribution']['sponsee_id']]['coin'] += $num_images > 0 ? 50*$num_images : 0;
            $list_sponsees[$contri['Contribution']['sponsee_id']]['coin'] += $num_video > 0 ? 100*$num_video : 0;
            //check kind of language
            if ($this->isJapanese($contri['Contribution']['content'])) {
                $text_jp = trim(preg_replace('#<[^>]+>#', ' ', $contri['Contribution']['content'])); 
                $text_jp = str_replace($spec_char,' ',$text_jp);
                $list_sponsees[$contri['Contribution']['sponsee_id']]['coin'] += $this->countwordJP($text_jp);
                 
                //echo $this->countwordJP($text_jp);die;
               
            } else {

                $str_en = str_replace($spec_char_en,' ',$contri['Contribution']['content']);
                //echo $this->get_num_of_words($str_en).'</br>';die;

                $list_sponsees[$contri['Contribution']['sponsee_id']]['coin'] += $this->get_num_of_words($str_en);
                
            }

            // if ($contri['Contribution']['contribution_type_cd'] == CONTRIBUTION_TYPE_ARTICLE) {

                

            // } else if ($contri['Contribution']['contribution_type_cd'] == CONTRIBUTION_TYPE_CONTENTS) {

                

            //     switch ($contri['ContributionContent']['contents_type_cd']) {
            //         case CONTENTS_TYPE_PICTURE:
            //             $list_sponsees[$contri['Contribution']['sponsee_id']]['coin'] += 50;
            //             break;
            //         case CONTENTS_TYPE_MOVIE:
            //             $list_sponsees[$contri['Contribution']['sponsee_id']]['coin'] += 100;
            //             break;
            //         default:
            //             break;
            //     }
            // }
            
            $Contribution    = ClassRegistry::init('Contribution');
            $Contribution->id = $contri['Contribution']['id'];
            if ($Contribution->saveField('reward_cd', PAYMENT_OK)) {
                
            }
           
        }
        return $list_sponsees;
    }
    function countwordJP($string) {
        $string = explode(" ", $string);
        $c = 0;
        foreach ($string as $k => $str) {
            if (!empty(trim($str))) {
                if ($this->isJapanese($str)) {
                    $c += mb_strlen($str);
                } else {
                    $c++;
                }
                 
            }
        }
        return $c;
    }
    function get_num_of_words($string) {
        $string = str_replace("&nbsp;", " ", strip_tags($string));
        $string = preg_replace('/\s+/', ' ',$string);
        $string = trim($string);
        if (empty($string)) {
            return 0;
        }
        $words = explode(" ", $string);
        return count($words);
    }

    function isJapanese($word) {
        return preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $word);
    }   

}