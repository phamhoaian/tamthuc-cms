<?php

class AppSchema extends CakeSchema
{

    public $attachments = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'model' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'model_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'field_name' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'file_name' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'file_content_type' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'file_size' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'file_object' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'
            )
    );
    public $backed_projects = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'project_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'user_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'backing_level_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'invest_amount' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'comment' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'orderId' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_general_ci', 'charset' => 'utf8'
            ), 'accessId' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'accessPass' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'status' => array(
                    'type' => 'string', 'null' => false, 'default' => '作成完了', 'length' => 30,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'forward' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'approve' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'transactionId' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'tranDate' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'checkString' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'manual_flag' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'
            )
    );
    public $backing_levels = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'project_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'name' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'invest_amount' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 200,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'return_amount' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'max_count' => array(
                    'type' => 'integer', 'null' => true, 'default' => null, 'length' => 5
            ), 'now_count' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5
            ), 'delivery' => array(
                    'type' => 'integer', 'null' => true, 'default' => '1', 'length' => 1
            ), 'created' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $banks = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'bank_name' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'bank_branch' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'bank_type' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'bank_user_name' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'bank_account_no' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'user_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'created' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $categories = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'name' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 200,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'setting_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'order' => array(
                    'type' => 'integer', 'null' => false, 'default' => '1', 'length' => 2
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $comments = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'user_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'project_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'comment' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $favourite_projects = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'user_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'project_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'backed' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 20,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $group_applications = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'
            ), 'from_setting_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10
            ), 'to_setting_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10
            ), 'comment' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $groups = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'key' => 'primary'
            ), 'name' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $mail_auths = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'email' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'token' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'user_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null, 'length' => 10
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $message_pairs = array(
            'message_pair_id' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 23, 'key' => 'primary',
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'last_sender_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'last_receiver_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'read_flag' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'message_pair_id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $messages = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'message_pair_id' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'from_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'to_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'content' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $news = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'
            ), 'title' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'content' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $project_content_orders = array(
            'project_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'
            ), 'order' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'project_id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $project_contents = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'
            ), 'project_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10
            ), 'open' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4
            ), 'type' => array(
                    'type' => 'string', 'null' => false, 'default' => 'text', 'length' => 20,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'txt_content' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'movie_type' => array(
                    'type' => 'string', 'null' => false, 'default' => 'youtube', 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'movie_code' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'img_caption' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $projects = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'setting_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10
            ), 'project_name' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 200,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'category_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'description' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'goal_amount' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'collection_term' => array(
                    'type' => 'integer', 'null' => false, 'default' => '60', 'length' => 2
            ), 'collection_start_date' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'collection_end_date' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'thumbnail_type' => array(
                    'type' => 'integer', 'null' => false, 'default' => '1', 'length' => 1
            ), 'thumbnail_movie_type' => array(
                    'type' => 'string', 'null' => true, 'default' => 'youtube', 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'thumbnail_movie_code' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'user_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'opened' => array(
                    'type' => 'string', 'null' => false, 'default' => 'no', 'length' => 3,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'backers' => array(
                    'type' => 'integer', 'null' => true, 'default' => '0'
            ), 'comment_cnt' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4
            ), 'report_cnt' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3
            ), 'collected_amount' => array(
                    'type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10
            ), 'max_back_level' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 20,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'active' => array(
                    'type' => 'string', 'null' => false, 'default' => 'yes', 'length' => 3,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'stop' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'return' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'contact' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'rule' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'fundee_fee' => array(
                    'type' => 'integer', 'null' => true, 'default' => null, 'length' => 2
            ), 'site_fee' => array(
                    'type' => 'integer', 'null' => true, 'default' => null, 'length' => 2
            ), 'fundee_price' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10
            ), 'site_price' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10
            ), 'project_owner_price' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10
            ), 'pay_plan_date_pj_owner' => array(
                    'type' => 'date', 'null' => true, 'default' => null
            ), 'pay_plan_date_site_owner' => array(
                    'type' => 'date', 'null' => true, 'default' => null
            ), 'pay_date_pj_owner' => array(
                    'type' => 'date', 'null' => true, 'default' => null
            ), 'pay_date_site_owner' => array(
                    'type' => 'date', 'null' => true, 'default' => null
            ), 'pay_fin_flag_pj_owner' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'pay_fin_flag_site_owner' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $report_content_orders = array(
            'report_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'
            ), 'order' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'report_id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $report_contents = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'
            ), 'report_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10
            ), 'type' => array(
                    'type' => 'string', 'null' => false, 'default' => 'text', 'length' => 20,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'txt_content' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'movie_type' => array(
                    'type' => 'string', 'null' => false, 'default' => 'youtube', 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'movie_code' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'img_caption' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $reports = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'project_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'open' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'title' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 200,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $schema_migrations = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'class' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci',
                    'charset' => 'latin1'
            ), 'type' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 50,
                    'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'
            )
    );
    public $sessions = array(
            'id' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'key' => 'primary',
                    'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'
            ), 'data' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci',
                    'charset' => 'latin1'
            ), 'expires' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'
            )
    );
    public $settings = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'user_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10
            ), 'subdomain' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 30,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'original_domain' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'price_type' => array(
                    'type' => 'integer', 'null' => true, 'default' => null, 'length' => 1
            ), 'shinsa_fin_flag' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1
            ), 'yuryo_shinsa_flag' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1
            ), 'shiharai_fin_flag' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'shiharai_monthly_flag' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '1'
            ), 'gmo_id' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'gmo_password' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'twitter_api_key' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'twitter_api_secret' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'facebook_api_key' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'facebook_api_secret' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'fee' => array(
                    'type' => 'integer', 'null' => false, 'default' => '20', 'length' => 2
            ), 'site_open' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'site_name' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'site_title' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'site_description' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'site_keywords' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'about' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'company_name' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'company_type' => array(
                    'type' => 'integer', 'null' => false, 'default' => '1', 'length' => 1
            ), 'company_url' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'company_ceo' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'company_address' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'copy_right' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'from_mail_address' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'admin_mail_address' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'mail_signature' => array(
                    'type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'toppage_projects_ids' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 150,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'toppage_pickup_project_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null, 'length' => 10
            ), 'toppage_new_projects_flag' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'toppage_ok_projects_flag' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '0'
            ), 'link_color' => array(
                    'type' => 'string', 'null' => true, 'default' => '006699', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'back1' => array(
                    'type' => 'string', 'null' => false, 'default' => 'f2f2f2', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'back2' => array(
                    'type' => 'string', 'null' => false, 'default' => 'd2d2d2', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'border_color' => array(
                    'type' => 'string', 'null' => false, 'default' => '999999', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'top_back' => array(
                    'type' => 'string', 'null' => true, 'default' => 'ffffff', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'top_color' => array(
                    'type' => 'string', 'null' => true, 'default' => '000000', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'top_alpha' => array(
                    'type' => 'integer', 'null' => false, 'default' => '80', 'length' => 2
            ), 'footer_back' => array(
                    'type' => 'string', 'null' => true, 'default' => 'd5d5d5', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'footer_color' => array(
                    'type' => 'string', 'null' => true, 'default' => '353539', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'graph_back' => array(
                    'type' => 'string', 'null' => true, 'default' => '0099cc', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'top_box_back' => array(
                    'type' => 'string', 'null' => false, 'default' => 'cceeff', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'top_box_black' => array(
                    'type' => 'integer', 'null' => false, 'default' => '60', 'length' => 2
            ), 'top_box_color' => array(
                    'type' => 'string', 'null' => false, 'default' => '000000', 'length' => 6,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'top_box_height' => array(
                    'type' => 'integer', 'null' => false, 'default' => '500', 'length' => 3
            ), 'top_box_content_num' => array(
                    'type' => 'integer', 'null' => false, 'default' => '1', 'length' => 1
            ), 'content_type1' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'content_position1' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 2,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'txt_content1' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'movie_type1' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'movie_code1' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'content_type2' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'content_position2' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 2,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'txt_content2' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'movie_type2' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'movie_code2' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'site_group' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );
    public $shinsas = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'
            ), 'setting_id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10
            ), 'status' => array(
                    'type' => 'integer', 'null' => false, 'default' => null
            ), 'created' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => false, 'default' => null
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'
            )
    );
    public $users = array(
            'id' => array(
                    'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'
            ), 'nick_name' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'name' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 100,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'email' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'password' => array(
                    'type' => 'string', 'null' => false, 'default' => null, 'length' => 50,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'sex' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 10,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'address' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 30,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'birthday' => array(
                    'type' => 'date', 'null' => true, 'default' => null
            ), 'twitter_id' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'facebook_id' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'self_description' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'url1' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 200,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'url2' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 200,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'url3' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 200,
                    'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'
            ), 'receive_address' => array(
                    'type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci',
                    'charset' => 'utf8'
            ), 'created' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'modified' => array(
                    'type' => 'datetime', 'null' => true, 'default' => null
            ), 'group_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null
            ), 'active' => array(
                    'type' => 'boolean', 'null' => false, 'default' => '1'
            ), 'token' => array(
                    'type' => 'string', 'null' => true, 'default' => null, 'length' => 512,
                    'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'
            ), 'setting_id' => array(
                    'type' => 'integer', 'null' => true, 'default' => null, 'length' => 10
            ), 'login_try_count' => array(
                    'type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2
            ), 'indexes' => array(
                    'PRIMARY' => array(
                            'column' => 'id', 'unique' => 1
                    )
            ), 'tableParameters' => array(
                    'charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'
            )
    );

    public function before($event = array())
    {
        return true;
    }

    public function after($event = array())
    {
    }

}
