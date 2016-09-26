<?php
App::uses('AppModel', 'Model');
App::uses('BookInfo','Model');

class LendInfo extends AppModel {
	public $useTable = 'lend_info';
	public $validate = array(
		// 'title' => array(
		// 	'required' => array(
		// 		'rule' => 'notEmpty',
		// 		'message' => 'タイトルは必須です'
		// 	),
		// 	'maxLength' => array(
		// 		'rule' => array('maxLength', 100),
		// 		'message' => '100文字までです',
		// 		'required' => true
		// 	)
		// ),
		// 'author' => array(
		// 	'required' => array(
		// 		'rule' => 'notEmpty',
		// 		'message' => '著者は必須です'
		// 	),
		// 	'maxLength' => array(
		// 		'rule' => array('maxLength', 100),
		// 		'message' => '100文字までです',
		// 		'required' => true
		// 	)
		// ),
		// 'publisher' => array(
		// 	'required' => array(
		// 		'rule' => 'notEmpty',
		// 		'message' => '出版社は必須です'
		// 	),
		// 	'maxLength' => array(
		// 		'rule' => array('maxLength', 100),
		// 		'message' => '100文字までです',
		// 		'required' => true
		// 	)
		// ),
		// 'thumbnail_name' => array(
		// 	'image' => array(
		// 		'rule' => array(
		// 			'extension',
		// 			array('gif', 'jpeg', 'png', 'jpg')
		// 		),
		// 		'message' => '有効な画像ファイルを指定してください',
		// 	)
		// ),
		// 'count' => array(
		// 	'range' => array(
		// 		'rule' => array('range', 0, 999),
		// 		'message' => '冊数は999までの数値で入力してください',
		// 	)
		// ),
		// 'publication_date' => array(
		// 	'required' => array(
		// 		'rule' => 'notEmpty',
		// 		'message' => '出版年は必須です'
		// 	),
		// 	'date' => array(
		// 		'rule' => 'date',
		// 		'message' => '有効な日付を YY-MM-DD フォーマットで入力してください'
		// 	)
		// ),
		// 'isbn' => array(
		// 	'required' => array(
		// 		'rule' => 'notEmpty',
		// 		'message' => 'ISBNは必須です'
		// 	),
		// 	'regex' => array(
		// 		'rule' => '/(^\d{10}$)|(^\d{13}$)/',
		// 		'message' => '10桁または13桁の数値で入力してください'
		// 	),
		// 	'isUnique' => array(
		// 		'rule' => 'isUnique',
		// 		'message' => 'そのISBNはすでに登録されています'
		// 	)
		// )
	);
	public $fieldList = array(
		'title',
		'author',
		'publisher',
		'publication_date',
		'isbn',
		'count'
	);
	// レンタル
	public function rentalBook($userId, $bookId) {
		// ユーザ自身がこの本を借りることができ、かつ本自体が貸出可能状態
		if ($this->avaiableRentalByUser($userId, $bookId) 
			&& $this->avaiableRentalByNum($bookId)) {
			$saveData = array(
				'user_id' => $userId,
				'book_info_id' => $bookId,
				'lend_date' => date('Y/m/d'),
				'return_date_scheduled' => date('Y/m/d', strtotime("+ 14 days")),
				'is_revocation' => true
			);
			if ($this->save($saveData)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function avaiableRentalBook($userId, $bookId) {
		return $this->avaiableRentalByUser($userId, $bookId) 
		&& $this->avaiableRentalByNum($bookId);
	}

	// 返却
	public function returnBook($userId, $bookId) {

		// 本を借りていない場合はfalse
		$id = $this->nowRental($userId, $bookId);
		if ($id === false) {
			return false;
		} 
		$saveData = array(
			'id'            => $id,
			'user_id'       => $userId,
			'book_info_id'  => $bookId,
			'return_date'   => date('Y/m/d'),
			'is_revocation' => false
		);
		if ($this->save($saveData)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function getNowRentalNum($bookId) {
		
		return $this->find('count', array(
			'conditions' => array(
				'LendInfo.book_info_id' => $bookId,
				'LendInfo.is_revocation' => true
			)
		));
	}
	public function avaiableRentalByUser($userId, $bookId) {
		// 自分がこの本を借りているか情報を取得
		$data = $this->find('all', array(
			'conditions' => array(
				'LendInfo.user_id' => $userId,
				'LendInfo.book_info_id' => $bookId,
				'LendInfo.is_revocation' => true
			)
		));
		// 自分が現在借りている本の数を取得
		$count = $this->find('count', array(
			'conditions' => array(
				'LendInfo.user_id' => $userId,
				'LendInfo.is_revocation' => true
			)
		));

		return (empty($data) && $count < 20)? true : false;
	}
	// 本の数的にレンタル可能かどうかを判定
	public function avaiableRentalByNum($bookId) {
		$book_info = new BookInfo();
		$count = $book_info->find('count', array(
					'conditions' => array(
						'BookInfo.id' => $bookId
					)
				));
		if ($count == 0) {
			return false;
		}

		$bookTotalNum = $book_info->getBookTotal($bookId);
		$bookRentalNum = $this->getNowRentalNum($bookId);
		// 本の総数よりも、借りられている数が下だった場合、レンタル可能
		if ($bookTotalNum > $bookRentalNum) {
			return true;
		} else {
			return false;
		}
	}
	// return "NOW_RENTAL, CANNOT_RENTAL, CAN_RENTAL"
	public function userRentalStatus($userId, $bookId) {
		if ($this->nowRental($userId, $bookId) !== false) {
			return 'NOW_RENTAL';
		} else if ($this->avaiableRentalBook($userId, $bookId)) {
			return 'CAN_RENTAL';
		} else {
			return 'CANNOT_RENTAL';
		}
	}
	// 現在、借りているかいないか。借りていたら、idを渡す
	public function nowRental($userId, $bookId) {
		$data = $this->find('first', array(
			'conditions' => array(
				'LendInfo.user_id' => $userId,
				'LendInfo.book_info_id' => $bookId,
				'LendInfo.is_revocation' => true
			)
		));

		if (!empty($data)) {
			return $data['LendInfo']['id'];
		} else {
			return false;
		}
	}

}