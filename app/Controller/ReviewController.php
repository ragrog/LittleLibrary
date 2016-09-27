<?php

App::uses('AppController', 'Controller');

class ReviewController extends AppController {
	public $uses = array('BookInfo', 'Review');
	public function index()
	{

	}
	public function edit($bookId = null){
		$userId = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$this->Review->edit($userId, $bookId, $this->request->data);
		}
		$data = $this->BookInfo->findById($bookId);
		$data += $this->Review->getReview($userId, $bookId);
		$this->set('data', $data);
		// // Controller アクションへのリダイレクト
		// return $this->redirect(
		// 	array('controller' => 'orders', 'action' => 'thanks')
		// );
		

	}

	public function add(){
		// // actionへのデータ
		// $this->redirect(array('action' => 'edit', $id));
	}
}