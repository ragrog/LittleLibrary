<?php

App::uses('AppController', 'Controller');

class BookController extends AppController {
	public $uses = array('BookInfo', 'LendInfo');
	public function index()
	{
		$data = $this->BookInfo->getRentalBooks();
		$this->set('data', $data);
	}

	public function add(){
		if ($this->request->is('post')) {
			// edit
			$this->BookInfo->edit($this->request->data, null);
			$this->set('validation', $this->BookInfo->validationErrors);
		}
		$this->set('isEdit', false);
		// book\edit.ctpを描画
		$this->render('/Book/edit');
	}
	public function edit($id) {
		if ($this->request->is('post')) {
			// edit
			$this->BookInfo->edit($this->request->data, $id);
			$this->set('validation', $this->BookInfo->validationErrors);
			// $this->redirect(array('action' => 'edit', null));
		}
		$data = $this->BookInfo->findById($id);
		$this->set('isEdit', true);
		$this->set('data', $data);
	}
	public function delete($id) {
		// データの削除
		if ($this->BookInfo->exists($id)) {
			$this->BookInfo->delete($id);
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function view($bookId) {
		$data = $this->BookInfo->findById($bookId);
		$data['role'] = $this->Auth->user('role');
		// レンタル中の本の数を渡す
		$data['BookInfo']['rentalNum'] = $this->LendInfo->getNowRentalNum($bookId);
		// 借りれるか返すのかを渡す
		$this->set('userRentalStatus', $this->LendInfo->userRentalStatus($this->Auth->user('id'), $bookId));
		
		$this->set('data', $data);
	}


}