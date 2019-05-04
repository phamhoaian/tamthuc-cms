<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attachment extends AppModel {
	
	public function countUpdateCard(){
		return $this->find('count', array('conditions' => array('model' => 'Coin', 'field_name' => 'tmp_coin_card')));
	}

	public function getCardRequest($sponsee_id){
		$joins = array(
			array(
				'alias' => 'Coin',
				'table' => 'coins',
				'type' => 'INNER',
				'conditions' => array('Coin.id = Attachment.model_id')
			),
			array(
				'alias' => 'User',
				'table' => 'users',
				'type' => 'INNER',
				'conditions' => array('User.id = Coin.sponsee_id')
			),
		);
		return $this->find('first', 
							array(
								'fields' => array('User.id','User.name', 'Attachment.created', 'Attachment.id', 'Coin.id'),
								'joins' => $joins,
								'conditions' => array('model' => 'Coin', 
													'field_name' => 'tmp_coin_card',
													'User.id' => $sponsee_id),
							)
					);
	}

	public function getCoinCard($model_id, $fieldname = 'coin_card') {
		return $this->find('first', array('conditions'=> array('model' => 'Coin', 'model_id' => $model_id, 'field_name' => $fieldname)));
	}
	public function countLike($id) {
		$res = $this->find('first', array('fields' => 'likes', 'conditions' => array('id' => $id)));
		if($res) return $res['Attachment']['likes'];
		return 0;
	}
}