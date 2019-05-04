<?php
/**
 * Routes configuration
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 * PHP 5
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/admin', array(
        'controller' => 'users', 'action' => 'login', 'admin' => true, 'plugin' => 'LogiAuth'
));
Router::connect('/admin/logout', array(
        'controller' => 'users', 'action' => 'logout', 'admin' => true, 'plugin' => 'LogiAuth'
));
Router::connect('/admin/forgot_pass', array(
        'controller' => 'users', 'action' => 'forgot_pass', 'admin' => true, 'plugin' => 'LogiAuth'
));
Router::connect('/admin/dashboards', array(
        'controller' => 'admin_dashboards', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/pages', array(
        'controller' => 'admin_pages', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/features', array(
        'controller' => 'admin_features', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/features/edit', array(
        'controller' => 'admin_features', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/features/edit/*', array(
        'controller' => 'admin_features', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/introductions', array(
        'controller' => 'admin_introductions', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/introductions/edit', array(
        'controller' => 'admin_introductions', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/introductions/edit/*', array(
        'controller' => 'admin_introductions', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/menus', array(
        'controller' => 'admin_menus', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/menus/edit', array(
        'controller' => 'admin_menus', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/menus/edit/*', array(
        'controller' => 'admin_menus', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/promotions', array(
        'controller' => 'admin_promotions', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/promotions/edit', array(
        'controller' => 'admin_promotions', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/promotions/edit/*', array(
        'controller' => 'admin_promotions', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/news', array(
        'controller' => 'admin_news', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/news/edit', array(
        'controller' => 'admin_news', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/news/edit/*', array(
        'controller' => 'admin_news', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/news/categories', array(
        'controller' => 'admin_news', 'action' => 'categories', 'admin' => true
));
Router::connect('/admin/news/category/edit', array(
        'controller' => 'admin_news', 'action' => 'category_edit', 'admin' => true
));
Router::connect('/admin/news/category/edit/*', array(
        'controller' => 'admin_news', 'action' => 'category_edit', 'admin' => true
));
Router::connect('/admin/galleries', array(
        'controller' => 'admin_galleries', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/galleries/edit', array(
        'controller' => 'admin_galleries', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/galleries/edit/*', array(
        'controller' => 'admin_galleries', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/vip-member', array(
        'controller' => 'admin_vip_members', 'action' => 'request', 'admin' => true
));
Router::connect('/admin/vip-member/request', array(
        'controller' => 'admin_vip_members', 'action' => 'request', 'admin' => true
));
Router::connect('/admin/vip-member/policy', array(
        'controller' => 'admin_vip_members', 'action' => 'policy', 'admin' => true
));
Router::connect('/admin/contact', array(
	'controller' => 'admin_contacts', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/contact/agency', array(
	'controller' => 'admin_contacts', 'action' => 'agency', 'admin' => true
));
Router::connect('/admin/orders', array(
	'controller' => 'admin_orders', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/recruitments', array(
        'controller' => 'admin_recruitments', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/events', array(
	'controller' => 'admin_events', 'action' => 'index', 'admin' => true
));
Router::connect('/admin/events/edit', array(
	'controller' => 'admin_events', 'action' => 'edit', 'admin' => true
));
Router::connect('/admin/settings', array(
        'controller' => 'admin_settings', 'action' => 'index', 'admin' => true
));
Router::connect('/', array(
        'controller' => 'base', 'action' => 'index'
));
Router::connect('/action/*', array(
        'controller' => 'base', 'action' => 'action'
));
Router::connect('/pages/*', array(
        'controller' => 'pages', 'action' => 'display'
));
Router::connect('/help', array(
        'controller' => 'pages', 'action' => 'display', 'help'
));
Router::connect('/guidelines', array(
        'controller' => 'pages', 'action' => 'display', 'guidelines'
));
Router::connect('/policy', array(
        'controller' => 'pages', 'action' => 'display', 'policy'
));
Router::connect('/company', array(
        'controller' => 'pages', 'action' => 'display', 'company'
));
Router::connect('/rule', array(
        'controller' => 'pages', 'action' => 'display', 'rule'
));
Router::connect('/point', array(
        'controller' => 'pages', 'action' => 'display', 'point'
));
Router::connect('/withdraw-ether', array(
        'controller' => 'info', 'action' => 'index', 'withdraw-ether'
));
Router::connect('/mypage', array(
        'controller' => 'users', 'action' => 'mypage'
));
Router::connect('/profile/*', array(
        'controller' => 'users', 'action' => 'view'
));
Router::connect('/make', array(
        'controller' => 'projects', 'action' => 'add'
));
Router::connect('/ngon-ngu/*', array(
        'controller' => 'SwitchLanguages', 'action' => 'index'
));
//LogiAuth
Router::connect('/login', array(
        'controller' => 'users', 'action' => 'login', 'plugin' => 'LogiAuth'
));
Router::connect('/logout', array(
        'controller' => 'users', 'action' => 'logout', 'plugin' => 'LogiAuth'
));
Router::connect('/forgot_pass', array(
        'controller' => 'users', 'action' => 'forgot_pass', 'plugin' => 'LogiAuth'
));
Router::connect('/mail_auth/*', array(
        'controller' => 'users', 'action' => 'mail_auth', 'plugin' => 'LogiAuth'
));
Router::connect('/register', array(
        'controller' => 'users', 'action' => 'register', 'plugin' => 'LogiAuth'
));
Router::connect('/confirm_mail/*', array(
        'controller' => 'users', 'action' => 'confirm_mail', 'plugin' => 'LogiAuth'
));
Router::connect('/send_confirm_mail/*', array(
        'controller' => 'users', 'action' => 'send_confirm_mail', 'plugin' => 'LogiAuth'
));
Router::connect('/reset_pass/*', array(
        'controller' => 'users', 'action' => 'reset_pass', 'plugin' => 'LogiAuth'
));
Router::connect('/social', array(
        'controller' => 'users', 'action' => 'social', 'plugin' => 'LogiAuth'
));
Router::connect('/deactive/*', array(
        'controller' => 'users', 'action' => 'deactive', 'plugin' => 'LogiAuth'
));
Router::connect('/reset_account_lock/*', array(
        'controller' => 'users', 'action' => 'reset_account_lock', 'plugin' => 'LogiAuth'
));
Router::connect('/reset_lock/*', array(
        'controller' => 'users', 'action' => 'reset_lock', 'plugin' => 'LogiAuth'
));
//LogiAuth Twitter
Router::connect('/tw_login', array(
        'controller' => 'twitter', 'action' => 'login', 'plugin' => 'LogiAuth'
));
Router::connect('/tw_callback/*', array(
        'controller' => 'twitter', 'action' => 'callback', 'plugin' => 'LogiAuth'
));
Router::connect('/tw_password/*', array(
        'controller' => 'twitter', 'action' => 'password', 'plugin' => 'LogiAuth'
));
//LogiAuth Facebook
Router::connect('/fb_login', array(
        'controller' => 'facebook', 'action' => 'login', 'plugin' => 'LogiAuth'
));
Router::connect('/fb_callback/*', array(
        'controller' => 'facebook', 'action' => 'callback', 'plugin' => 'LogiAuth'
));
Router::connect('/fb_password/*', array(
        'controller' => 'facebook', 'action' => 'password', 'plugin' => 'LogiAuth'
));
Router::connect('/api/create-coin', array(
        'controller' => 'api', 'action' => 'createCoin'
));

Router::connect('/api/dividend-create', array(
        'controller' => 'api', 'action' => 'dividendCreate'
));
Router::connect('/api/dividend-confirm', array(
        'controller' => 'api', 'action' => 'dividendConfirm'
));
Router::connect('/api/dividend-pause', array(
        'controller' => 'api', 'action' => 'dividendPause'
));

Router::connect('/gg_login', array(
        'controller' => 'google', 'action' => 'login', 'plugin' => 'LogiAuth'
));
Router::connect('/gg_callback/*', array(
        'controller' => 'google', 'action' => 'callback', 'plugin' => 'LogiAuth'
));
Router::connect('/gg_password/*', array(
        'controller' => 'google', 'action' => 'password', 'plugin' => 'LogiAuth'
));

Router::connect('/load_images', array(
	'controller' => 'ManagementImages', 'action' => 'load'
));

Router::connect('/upload_image', array(
        'controller' => 'ManagementImages', 'action' => 'upload'
));

Router::connect('/delete_image', array(
	'controller' => 'ManagementImages', 'action' => 'delete'
));

/**
 * Route for feature
 */
Router::connect('/net-dac-sac', array(
	'controller' => 'Features', 'action' => 'index'
));
Router::connect('/net-dac-sac/*', array(
	'controller' => 'Features', 'action' => 'detail'
));

/**
 * Route for introduction
 */
Router::connect('/gioi-thieu', array(
	'controller' => 'Introductions', 'action' => 'index'
));
Router::connect('/gioi-thieu/*', array(
	'controller' => 'Introductions', 'action' => 'detail'
));

/**
 * Route for menu
 */
Router::connect('/thuc-don', array(
	'controller' => 'Menus', 'action' => 'index'
));
Router::connect('/thuc-don/*', array(
	'controller' => 'Menus', 'action' => 'detail'
));

/**
 * Route for promotion
 */
Router::connect('/khuyen-mai', array(
	'controller' => 'Promotions', 'action' => 'index'
));
Router::connect('/khuyen-mai/*', array(
	'controller' => 'Promotions', 'action' => 'detail'
));

/**
 * Route for recruitment
 */
Router::connect('/tuyen-dung', array(
	'controller' => 'Recruitments', 'action' => 'index'
));

/**
 * Route for news
 */
Router::connect('/tin-tuc', array(
	'controller' => 'News', 'action' => 'index'
));
Router::connect('/tin-tuc/the-loai/*', array(
	'controller' => 'News', 'action' => 'index'
));
Router::connect('/tin-tuc/*', array(
	'controller' => 'News', 'action' => 'detail'
));

/**
 * Route for vip member
 */
Router::connect('/thanh-vien-vip', array(
	'controller' => 'VipMembers', 'action' => 'policy'
));
Router::connect('/thanh-vien-vip/gui-yeu-cau', array(
	'controller' => 'VipMembers', 'action' => 'request'
));
Router::connect('/xem-diem-tich-luy', array(
	'controller' => 'VipMembers', 'action' => 'request'
));

/**
 * Route for contact
 */
Router::connect('/lien-he', array(
	'controller' => 'Contacts', 'action' => 'index'
));

/**
 * Route for order
 */
Router::connect('/dat-ban', array(
	'controller' => 'Orders', 'action' => 'index'
));

/**
 * Route for event
 */
Router::connect('/su-kien/dang-ky', array(
	'controller' => 'Events', 'action' => 'register'
));
Router::connect('/su-kien/*', array(
	'controller' => 'Events', 'action' => 'index'
));

/**
 * Route for customer reviews
 */
Router::connect('/y-kien-khach-hang', array(
	'controller' => 'CustomerReviews', 'action' => 'index'
));

/**
 * Route for gallery images
 */
Router::connect('/hinh-anh', array(
	'controller' => 'Galleries', 'action' => 'index'
));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();
/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE.'Config'.DS.'routes.php';
