<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'ユーザーネームは必須です',
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => '既にユーザーネームが使われています'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'パスワードは必須です'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'member')),
				'message' => '役割の選択は必須です',
				'required' => true
			)
		)
	);

	public function beforeSave($options = array()) {
	if (isset($this->data[$this->alias]['password'])) {
		$passwordHasher = new BlowfishPasswordHasher();
		$this->data[$this->alias]['password'] = $passwordHasher->hash(
			$this->data[$this->alias]['password']
		);
	}
	return true;
	}
	// 権限を取得する
	public function getRole($id) {
		$data = $this->find('first', array('conditons' => array(
			'User.id' => $id
		)));
		return $data['User']['role'];
	}
}