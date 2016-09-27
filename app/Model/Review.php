<?php
App::uses('AppModel', 'Model');

class Review extends AppModel {
	public $useTable = 'reviews';
	public $validate = array(
	
	);
	public $fieldList = array(
		'evaluation',
		'sentence'
	);
	public function edit($userId, $bookId, $request) {
		// もしもレビューが存在したら、idをsaveする
		$id = $this->getReviewId($userId, $bookId);
		if ($id  !== false) {
			$saveData['id'] = $id;
		}
		// フィールドリストにあるカラムだけ保存
		foreach ($this->fieldList as $value) {
			$saveData[$value] = isset($request['Review'][$value]) ? $request['Review'][$value] : '';
		}

		$saveData['user_id'] = $userId;
		$saveData['book_info_id'] = $bookId;

		if ($this->save($saveData)) {
			return true;
		} else {
			return false;
		}
	
	}
	public function getReviewId($userId, $bookId) {
		$data = $this->getReview($userId, $bookId);
		if (empty($data)) {
			return false;
		} else {
			return $data['Review']['id'];
		}
	}
	public function getReview($userId, $bookId) {
		return $this->find('first', array(
			'conditions' => array(
				'Review.user_id' => $userId,
				'Review.book_info_id' => $bookId
			)
		));
	}
	public function getReviewByUserId($userId, $options = []) {
		$options['conditions'][] = 'Review.user_id' => $userId;
		return $this->find('all', $options);
	}
	public function getReveiwByBookId($bookId, $options = []) {
		$options['conditions'][] = 'Review.book_id' => $BookId;
		return $this->find('all', $options);
	}
}