<?php 
App::uses('Controller', 'Controller');
class AjaxController extends AppController{

	public $uses = array(
           'Like', 'Attachment', 'Contribution', 'Coin', 'Notification', 'Comment', 'Reply', 'CountPlayed', 'Bought', 'ContributionContent',
           'Delivery', 'AddressBook'
    );
	public $components = array(
           'Common'
    );
    public $setting = null; 
    public function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow(array('count', 'users_like', 'getPhoto', 'count_played', 'get_balance', 'inStock', 'check_sufficient'));
    	$this->autoRender = false;
    	$this->layout = 'ajax';
    	$this->models = array(
						LIKE_TYPE_PHOTO => 'Attachment',
						LIKE_TYPE_ACTIVITY => 'Contribution',
						LIKE_TYPE_COMMENT => 'Comment',
						LIKE_TYPE_REPLY => 'Reply'
					);
    }
	
	public function like(){
		$params = $this->request->data;
		$type = $params['type'];
		$item_id = $params['id'];
		$owner_object = $params['user'];
		$user_id = $this->Auth->user('id');

		$data = array('object_id' => $item_id, 'type' => $type, 'user_id' => $user_id);
		$checked = $this->Like->existed($type, $item_id, $user_id);
		$model = $this->models[$type];
		
		$file_exist = $this->$model->findById($item_id);

		if(!$file_exist) {
			exit(json_encode(array('success' => 0, 'error' => 'Object not exist')));
		}

		$additions = $notif = array();
		$notif['sender_id'] = $user_id;
		$notif['receiver_id'] = $owner_object;
		if($type == LIKE_TYPE_PHOTO) {
			$additions['attm'] = $item_id;
			$notif['additional'] = serialize($additions);
			$notif['action'] = 'USER_LIKE_PHOTO';
		}
		elseif ($type == LIKE_TYPE_ACTIVITY){
			$additions['ctrb'] = $item_id;
			$contribution = $this->Contribution->findById($item_id);
			if($contribution){
				if($contribution['Contribution']['contribution_type_cd'] == CONTRIBUTION_TYPE_ARTICLE){
					$notif['action'] = 'USER_LIKE_POST';
				}
				else{
					$notif['action'] = 'USER_LIKE_CONTENT';
				}
				$notif['additional'] = serialize($additions);
			}
		}

		if($checked){
			$this->Like->deleteAll($data, false);
			$this->$model->updateAll(array("{$model}.likes" => "IF({$model}.likes = 0, 0, {$model}.likes-1)"), array("{$model}.id"=>$item_id));
			if (in_array($type, array(LIKE_TYPE_PHOTO, LIKE_TYPE_ACTIVITY)))
			{
				$this->Notification->deleteAll($notif, false);
			}
		}
		else{
			if($this->Like->save($data)){
				$this->$model->updateAll(array("{$model}.likes" => "{$model}.likes+1"), array("{$model}.id"=>$item_id));
				if (in_array($type, array(LIKE_TYPE_PHOTO, LIKE_TYPE_ACTIVITY)) && $notif['sender_id'] != $notif['receiver_id'])
				{
					$this->Notification->save($notif);
				}
				
			}
		}
		$count = (int)$this->$model->countLike($item_id);
		exit(json_encode(array('success' => 1, 'count_format' => $this->Common->number_format_short($count), 'count' => $count)));
	}

	public function count($scope = 'like') {
		$params = $this->request->data;
		$auth = $this->Auth->user('id');
		$type = $params['type'];
		$item_id = $params['id'];
		$model = $this->models[$type];
		$count = $this->$model->countLike($item_id);
		$liked = 0;
		if($auth){
			$checked = $this->Like->existed($type, $item_id, $auth);
			if($checked) $liked = 1;
		}
		exit(json_encode(array('success' => 1, 'count' => $count, 'count_format' => $this->Common->number_format_short($count), 'liked' => $liked)));
	}

	public function users_like(){
		$this->autoRender = true;
		$auth = $this->Auth->user('id');
		$params = $this->request->data;
		$auth = $this->Auth->user('id');
		$type = $params['type'];
		$item_id = $params['id'];
		$users = $this->Like->getUsers($type, $item_id);
		$like_users_list = $this->Like->getUsersList($type, $item_id);
		$this->addTop2SponsorPics($users, $like_users_list);
		$favs = array();
		if($auth) {
			$favs = $this->Favorite->getSponseeList($auth);
		}
		$this->set(compact('users', 'auth', 'favs'));		
		
	}

	private function addTop2SponsorPics(&$users, $user_ids) {
		$users = Hash::combine($users, '{n}.User.id', '{n}');
		foreach($user_ids as $id) {
			$pic = $this->User->findById($id);
			$users[$id]['User']['profile_pic'] = !empty($pic['User']['profile_pic']) ? $pic['User']['profile_pic'] : null;
		}
	}

	public function getPhoto($photo_id){
		//get attachment with photo id

		$options["fields"] = "Attachment.*, Contribution.sponsee_id";
		
        $options['joins'] = array(
									array(
											'type' => 'LEFT',
											'table' => 'contributions',
											'alias' => 'Contribution', 
											'conditions' => array('Attachment.model = "Contribution"', 'Attachment.model_id = Contribution.id',
												'Contribution.status_cd' => CONTRIBUTION_STATUS_OPENED
											),
										),
									array(
											'type' => 'LEFT',
											'table' => 'contribution_contents',
											'alias' => 'ContributionContent', 
											'conditions' => array('Attachment.model = "ContributionContent"', 'Attachment.model_id = ContributionContent.id', 'ContributionContent.contribution_id = Contribution.id')
										),
								);
		
		$options["conditions"] = array(
									'OR' => array('Attachment.model' => 'Sponsee', 
													'Attachment.model = "Contribution"', 
													'Attachment.model = "ContributionContent"',
													'Attachment.model = "User"'),
									'IF(Contribution.id IS NOT NULL, Contribution.contribution_type_cd = '.CONTRIBUTION_TYPE_ARTICLE.', 1)',
									'IF(ContributionContent.id IS NOT NULL, ContributionContent.contents_type_cd = '.CONTENTS_TYPE_PICTURE.', 1)',
									'IF(Attachment.model = "Sponsee", Attachment.field_name IN ("top_pic") , 1)',
									'IF(Attachment.model = "User", Attachment.field_name = "profile_pic", 1)',
									'IF(Attachment.model = "Coin", Attachment.field_name = "coin_card", 1)',
									'IF(Attachment.model = "Contribution", Contribution.id IS NOT NULL,1)',
									'IF(Attachment.model = "ContributionContent", ContributionContent.id IS NOT NULL,1)',
									'Attachment.id = "'.$photo_id.'"'
								);
		
		$attachment = $this->Attachment->find('first', $options);
		if(!$attachment) {
			exit(json_encode(array('success' => 0, 'error' => 'image not found')));
		}
		$image = $this->Common->makeS3Link($attachment['Attachment']);

		//get receiver id
		$data_user = 0;
		if($attachment['Attachment']['model'] == 'Sponsee' || 
			$attachment['Attachment']['model'] == 'User'
		){
			$data_user = $attachment['Attachment']['model_id'];
		}
		elseif($attachment['Attachment']['model'] == 'Contribution' || 
			$attachment['Attachment']['model'] == 'ContributionContent'
		) {
			$data_user = $attachment['Contribution']['sponsee_id'];
		}
		else{
			$coin_id = $attachment['Coin']['model_id'];
			$coin_data = $this->Coin->findById($coin_id);
			if($coin_data){
				$data_user = $coin_data['Coin']['sponsee_id'];
			}
		}

		$auth = $this->Auth->user('id');
		$type = LIKE_TYPE_PHOTO;
		$model = $this->models[$type];
		$count = $this->$model->countLike($photo_id);
		$liked = 0;
		if($auth){
			$checked = $this->Like->existed($type, $photo_id, $auth);
			if($checked) $liked = 1;
		}

		return json_encode(array('success' => 1, 'image' => $image, 'count' => $count, 'count_format' => $this->Common->number_format_short($count), 'liked' => $liked, 'data-user' => $data_user));
	}

	public function count_played(){
		$params = $this->request->data;
		$contribution_id = !empty($params['contribution_id']) ? $params['contribution_id'] : null;
		$src = !empty($params['src']) ? $params['src'] : null;
		$countOnly = !empty($params['countOnly']) ? $params['countOnly'] : false;

		if($contribution_id && $src){
			$src = urldecode($src);
			if(strrpos($src, '/') != false){
				$pos = strrpos($src, '/');
				$src = substr($src, $pos+1);
			}
			$item = $this->CountPlayed->find('first', array('conditions' => array('contribution_id' => $contribution_id, 'src' => $src)));

			if($countOnly) {
				if(empty($item)) {
					exit(json_encode(array('state'=> 'success', 'data' => '0' .__('閲覧回数'))));
				}
				else{
					exit(json_encode(array(
											'state'=> 'success', 
											'data' => number_format( $item['CountPlayed']['played'] ) . 
																		($item['CountPlayed']['played'] > 1 ? __('閲覧回数 ') : __('閲覧回数'))
										)
									)
						);
				}
			}

			$played = 1;
			if($item){
				$this->CountPlayed->updateAll(array('played' => '`played`+1', 'modified' => '"'.date('Y-m-d H:i:s').'"' ), array('id' => $item['CountPlayed']['id']));
				$played = $item['CountPlayed']['played'] + 1;
			}
			else{
				$this->CountPlayed->save(array(
												'contribution_id' => $contribution_id,
												'src' => $src,
												'played' => $played
											));
			}
			exit(json_encode(array('state'=> 'success', 'data' => $played)));
		}
		else{
			exit(json_encode(array('state'=> 'error', 'data' => 'Invalid inputs')));
		}
	}

	public function check_sufficient() {
		$user_id = $this->Auth->user('id');
		$sponsee_id = !empty($this->data['sponsee_id']) ? $this->data['sponsee_id'] : '';
		$contribution_id = !empty($this->data['contribution_id']) ? $this->data['contribution_id'] : '';
		$quantity = !empty($this->data['quantity']) ? $this->data['quantity'] : 1;

		if(empty($user_id) || empty($sponsee_id) || empty($contribution_id)){
			exit(json_encode(array('state'=> 'success', 'data' => 0)));
		}
		
		$balance = $this->Common->getCurrentBalance($user_id, $sponsee_id);
		$con = $this->Contribution->findById($contribution_id);
		if(empty($con)){
			exit(json_encode(array('state'=> 'success', 'data' => 0)));
		}

		$price = $con['Contribution']['contents_price'];

		exit(json_encode(array('state'=> 'success', 'data' => (int)($balance >= $price*$quantity) )));
	}

	public function inStock() {
		$contribution_content_id = !empty($this->data['contribution_content_id']) ? $this->data['contribution_content_id']: '';
		$paymentId = !empty($this->data['paymentId']) ? $this->data['paymentId']: '';

		$sold_items = $this->Bought->getNumberItemsBought($contribution_content_id);
		$content = $this->ContributionContent->findById($contribution_content_id);
		if( !$content && !$paymentId){
			exit( json_encode(array('success' => 1, 'data' => 0, 'paymentStatus' => 0)));
		}

		$stock = $content['ContributionContent']['quantity'];
		$contribution = $this->Contribution->findById($content['ContributionContent']['contribution_id']);

		$bought = $this->Bought->find('first', array(
												'conditions'=> array('id'=> $paymentId, 'status' => PAYMENT_OK)));
		$paymentStatus = PAYMENT_PENDING;
		if($bought) {
			$paymentStatus = PAYMENT_OK;
		}
		$self = 0;

		$lastPayment = $this->Bought->getLastPaymentId();
		if($lastPayment) {
			if($lastPayment['Bought']['id'] == $paymentId) {
				$self = 1;
			}
		}

		if($stock < 0) {
			$stock = 0;
		}

		if(
			isset($contribution['Contribution']['status_cd']) &&
			$contribution['Contribution']['status_cd'] == CONTRIBUTION_STATUS_DELETED
		){
			$stock = 0;
			$self = 0;
		}
	
		exit(json_encode( array('success' => 1, 'data' => $stock, 'paymentStatus' =>$paymentStatus, 'self' => $self )));
	}

	public function order_status(){
		$order_id = !empty($this->data['order_id']) ? $this->data['order_id'] : null;
		$status = isset($this->data['status']) ? $this->data['status'] : null;
		if(empty($order_id) || is_null($status)){
			exit( json_encode(array('success' => 0, 'data' => 'Input invalid')));
		}

		if($this->Delivery->save(array('id' => $order_id, 'status'=> $status))){
			exit( json_encode(array('success' => 1)));
		}
	}

	public function order_ddress(){
		$address_id = !empty($this->data['address_id']) ? $this->data['address_id'] : null;
		if(empty($address_id)){
			exit( json_encode(array('success' => 0, 'data' => 'Input invalid')));
		}
		$data = $this->AddressBook->findById($address_id);
		if($data){
			$data['AddressBook']['note'] = nl2br($data['AddressBook']['note']);
			if($data['AddressBook']['zip_cd']){
				$data['AddressBook']['zip_cd'] = __('〒%s', $data['AddressBook']['zip_cd']);
			}

			exit( json_encode(array('success' => 1, 'data' => $data['AddressBook'])));
		}
		exit( json_encode(array('success' => 0, 'data' => 'Not found')));
	}
}

 ?>
