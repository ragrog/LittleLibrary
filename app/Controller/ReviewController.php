<?php

App::uses('AppController', 'Controller');

class ReviewController extends AppController {
	public $uses = array('BookInfo', 'Review');

	public function edit($bookId, $userId = null) {
		// 管理者以外、またはuserIdがnullの場合はログインIDでuserIdを設定
		if ($this->Auth->user('role') !== 'admin' || $userId === null ) {
			$userId = $this->Auth->user('id');
		}
		if ($this->request->is('post')) {
			$this->Review->edit($userId, $bookId, $this->request->data);
		}

		$data = $this->BookInfo->findById($bookId);
		$review = $this->Review->getReview($userId, $bookId);
		if (empty($review)) {
			$this->set('isEdit', false);
		} else {
			$data += $review;
			$this->set('isEdit', true);
		}
		$this->set('data', $data);
	}

	public function delete($bookId, $userId = null) {

		// 管理者以外、またはuserIdがnullの場合はログインIDでuserIdを設定
		if ($this->Auth->user('role') !== 'admin' || $userId === null ) {
			$userId = $this->Auth->user('id');
		}

		$this->Review->deleteReview($userId, $bookId);
		$this->redirect(array('action' => 'index'));
	}
	
}