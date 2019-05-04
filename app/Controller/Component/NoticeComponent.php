<?php 
/**
* Notice Component
*/
class NoticeComponent extends Component
{

	public function initialize(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function getNotice($user_id)
    {
        // get notification model instance
        $notification_model = ClassRegistry::init('Notification');

        // check whether there is any notice doesnt read
        $unread_flag = false;

        $options = array(
            'conditions' => array(
                'receiver_id' => $user_id
            ),
            'order' => array(
                'created' => 'DESC'
            ),
            'limit' => NOTIFICATION_LIMIT
        );
        $notification = $notification_model->find('all', $options);
        if ($notification) 
        {
            $notification = $this->addSenderInfo($notification);
        }
        return $notification;
    }

    public function addNoticeToUser($sender_id = null, $receiver_id, $action, $additional = null)
    {
        // get user model instance
        $user_model = ClassRegistry::init('User');

        // receiver user
        $receiver_user = $user_model->findById($receiver_id);
        if ( ! $receiver_user) {
            return false;
        }

        // get notification model instance
        $notification_model = ClassRegistry::init('Notification');
        $notification_model->begin();
        $notification_model->create();
        $notification['Notification'] = array(
            'sender_id'     => $sender_id,
            'receiver_id'   => $receiver_id,
            'action'        => $action,
            'additional'    => $additional,
            'read_flag'     => 0,
            'created'       => date('Y-m-d H:i:s')
        );
        if ($notification_model->save($notification)) {
            $notification_model->commit();
            return true;
        }
        $notification_model->rollback();
        return false;
    }

    public function addNoticeToAdmin($options = array())
    {
        
    }

    public function addSenderInfo($list = array())
    {
        if ( ! is_array($list) || empty($list))
        {
            return false;
        }

        // get user model instance
        $user_model = ClassRegistry::init('User');

        // get contribution model instance
        $contribution_model = ClassRegistry::init('Contribution');

        // get attachment model instance
        $attachment_model = ClassRegistry::init('Attachment');

        foreach ($list as &$notice) 
        {
            // sender picture
            $sender = $user_model->findById($notice['Notification']['sender_id']);
            if ($sender) 
            {
                $notice['Notification']['sender_name'] = $sender['User']['name'];
                $notice['Notification']['sender_pic'] = $sender['User']['profile_pic'];
            }
            else
            {
                $notice['Notification']['sender_name'] = __('匿名');
                $notice['Notification']['sender_pic'] = null;
            }

            // post/content picture
            if (!empty($notice['Notification']['additional']))
            {
                $additional = unserialize($notice['Notification']['additional']);
                if (isset($additional['ctrb']) && $additional['ctrb'])
                {
                    $contribution = $contribution_model->findById($additional['ctrb']);
                    if ($contribution)
                    {
                        $notice['Notification']['contribution_pic'] = $contribution['Contribution']['eyecatch_pic'];
                    }
                }
                if (isset($additional['attm']) && $additional['attm'])
                {
                    $attachment = $attachment_model->findById($additional['attm']);
                    if ($attachment)
                    {
                        $notice['Notification']['photo_url'] = $this->makeS3Link($attachment['Attachment']);
                    }
                }
            }

            if ( ! $notice['Notification']['read_flag'])
            {
                $unread_flag = true;
            }
        }
        unset($notice);
        return $list;
    }

    public function chkUnread($list = array())
    {
        if ( ! is_array($list) || empty($list))
        {
            return false;
        }

        $unread_flag = false;
        foreach ($list as $notice) 
        {
            if ( ! $notice['Notification']['read_flag'])
            {
                $unread_flag = true;
                break;
            }
        }

        return $unread_flag;
    }

    public function makeS3Link($attachment) {
        $path = $attachment['model'].DS. $attachment['model_id'].DS. $attachment['field_name'] .DS. $attachment['file_name'];
        // get setting model instance
        $setting_model = ClassRegistry::init('Setting');
        $setting = $setting_model->find('first');
        return 'https://'. $setting['Setting']['s3_bucket'] . '.s3.amazonaws.com' . DS . $path;
    }
}