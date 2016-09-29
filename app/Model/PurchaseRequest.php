<?php
App::uses('AppModel', 'Model');
App::uses('BookInfo','Model');

class PurchaseRequest extends AppModel {
	public $useTable = 'purchase_requests';
	// public $validate = array(
	
	// );
	// public $fieldList = array(
	// 	'evaluation',
	// 	'sentence'
	// );
	// public function edit($userId, $bookId, $request) {
	// 	// もしもレビューが存在したら、idをsaveする
	// 	$id = $this->getReviewId($userId, $bookId);
	// 	if ($id  !== false) {
	// 		$saveData['id'] = $id;
	// 	}
	// 	// フィールドリストにあるカラムだけ保存
	// 	foreach ($this->fieldList as $value) {
	// 		$saveData[$value] = isset($request['Review'][$value]) ? $request['Review'][$value] : '';
	// 	}

	// 	$saveData['user_id'] = $userId;
	// 	$saveData['book_info_id'] = $bookId;

	// 	if ($this->save($saveData)) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	
	// }
	// public function getReviewId($userId, $bookId) {
	// 	$data = $this->getReview($userId, $bookId);
	// 	if (empty($data)) {
	// 		return false;
	// 	} else {
	// 		return $data['Review']['id'];
	// 	}
	// }
	// public function getReview($userId, $bookId) {
	// 	return $this->find('first', array(
	// 		'conditions' => array(
	// 			'Review.user_id' => $userId,
	// 			'Review.book_info_id' => $bookId
	// 		)
	// 	));
	// }
	// public function getReviewAll($options = []) {
	// 	$options['order'][] = 'Review.modified';
	// 	return $this->find('all', $options);
	// }
	// public function getReviewByUserId($userId, $options = []) {
	// 	$options['conditions']['Review.user_id'] = $userId;
	// 	return $this->find('all', $options);
	// }
	// public function getReveiwByBookId($bookId, $options = []) {
	// 	$options['conditions']['Review.book_id'] = $BookId;
	// 	return $this->find('all', $options);
	// }
	// public function deleteReview($userId, $bookId) {
	// 	if (($id = $this->getReviewId($userId, $bookId)) === false) {
	// 		return false;
	// 	}
	// 	return $this->delete($id);
	// }
	public $addFieldList = array(
	);
	public function edit($request, $purchaseId, $userId) {
		
		echo '<pre>';
		var_dump($request);
		echo '</pre>';
		$saveData = [];

		// コメントカラムがない場合は、失敗
		if (isset($request['PurchaseRequest']['comment']))
		{
			$saveData['comment'] = $request['PurchaseRequest']['comment'];
		} else {
			return false;
		}

		$dataSource = $this->getDataSource();
		$dataSource->begin();
		// Idが存在しなければ新規作成。あれば編集
		if ($this->exists($purchaseId)) {
			// idをセット
			$saveData['id'] = $purchaseId;
			$bookId = $this->getBookId($purchaseId);
		} else {
			$book_info = new BookInfo();
			// 本の登録に成功しなければ、エラー
			if (!$book_info->edit($request, null, true)) {
				$dataSource->rollback();
				return false;
			} else {
				$bookId = $book_info->getLastInsertID();
			}
		}
		$saveData += array('user_id' => $userId, 'book_info_id' => $bookId);


		if ($this->save($saveData)) {
			$dataSource->commit();
			return true;
		} else {
			$dataSource->roolback();
			return false;
		}
		// requestを整形
		// 新規作成ならば作り直す
	}
	public function getBookId($purchaseId) {
		$data = $this->find('first', array(
			'conditions' => array(
				'PurchaseRequest.id' => $purchaseId
			),
			'fields' => array(
				'PurchaseRequest.book_info_id'
			)
		));
		if (empty($data)) {
			return null;
		} else  {
			return $data['PurchaseRequest']['book_info_id'];
		}
	}
}