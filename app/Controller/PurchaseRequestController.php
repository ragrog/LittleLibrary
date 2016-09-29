<?php

App::uses('AppController', 'Controller');

class PurchaseRequestController extends AppController {
	public $uses = array('PurchaseRequest', 'BookInfo');
	public function index()
	{

	}
	public function edit($purchaseId){
		$userId = $this->Auth->user('id');
		// ポストされたときの編集処理
		if ($this->request->is('post')) {
			$this->PurchaseRequest->edit($this->request->data, $purchaseId, $userId);
		}
		// 保存したデータを再度取得して渡す
		$data = $this->PurchaseRequest->findById($purchaseId);
		$data += $this->BookInfo->findById($data['PurchaseRequest']['book_info_id']);
		// viewに編集だと伝える
		$this->set('isEdit', true);
		$this->set('isPurchaseRequest', true);

		$this->set('data', $data);

		$this->render('/Book/edit');
	}

	public function add(){
		$userId = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$this->PurchaseRequest->edit($this->request->data, null, $userId);
		}
		// viewに追加だと伝える
		$this->set('isEdit', false);
		$this->set('isPurchaseRequest', true);
		$this->render('/Book/edit');
	}
}