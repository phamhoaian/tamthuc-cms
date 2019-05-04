<?php

class NotificationHelper extends AppHelper {

    public $helpers = array('Html');

    public function showTitle($data)
    {
        if ( ! is_array($data)) {
            return false;
        }

        switch ($data['action']) {
            case 'COMMENT_POST':
                return __('<strong>%s</strong>があなたの投稿にコメントしました。', h($data['sender_name']));
                break;
            case 'COMMENT_CONTENT':
                return __('<strong>%s</strong>があなたのコンテンツにコメントしました。', h($data['sender_name']));
                break;
            case 'COMMENT_SPONSEE':
                return __('<strong>%s</strong>があなたのチャットルームにコメントしました。', h($data['sender_name']));
                break;
            case 'REPLY_COMMENT':
                return __('<strong>%s</strong>があなたのコメントに返信しました。', h($data['sender_name']));
            case 'USER_SUPPORT':
                $additional = unserialize($data['additional']);
                $eth_amount = $additional['eth'];
                if (!$data['sender_name']) 
                {
                    $data['sender_name'] = __('匿名');
                }
                return __('<strong>%s</strong>さんが%sETHを支援しました。', h($data['sender_name']), number_format($eth_amount, 2));
            case 'USER_LIKE_POST':
                return __('<strong>%s</strong>さんはあなたの投稿にいいねと言っています。', h($data['sender_name']));
            case 'USER_LIKE_CONTENT':
                return __('<strong>%s</strong>さんはあなたのコンテンツにいいねと言っています。', h($data['sender_name']));
            case 'USER_LIKE_PHOTO':
                return __('<strong>%s</strong>さんはあなたの写真にいいねと言っています。', h($data['sender_name']));
                break;
            case 'USER_ADD_FAVORITES':
                return __('<strong>%s</strong>さんがあなたをお気に入りに追加しました。', h($data['sender_name']));
                break;
            case 'SPONSEE_ADD_POST':
                return __('<strong>%s</strong>さんは新しい投稿を追加しました。', h($data['sender_name']));
                break;
            case 'SPONSEE_ADD_CONTENT':
                return __('<strong>%s</strong>さんは新しいコンテンツを追加しました。', h($data['sender_name']));
                break;
            case 'USER_BUY':
                return __('<strong>%s</strong>さんがあなたのコンテンツを購入しました。', h($data['sender_name']));
                break;
        }
        return false;
    }

    public function getNoticeLink($data)
    {
       if ( ! is_array($data)) {
            return false;
        }

        return $this->Html->url(array(
            'controller'    => 'notification',
            'action'        => 'notice_link',
            $data['id'],
            $data['receiver_id']
        ), true);     
    }
}