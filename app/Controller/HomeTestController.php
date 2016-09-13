<?php

App::uses('AppController', 'Controller');

class HomeTestController extends AppController {
	// 使うコンポーネント
	// public $components = array('hoge', 'foo');
	// 使うモデル
	// public $uses = array('hogeModel', 'fooModel');
	public $uses = array('Base', 'LearningFlow');
	// indexだと、HomeTestController/でアクセスしたときにデフォルトで選択
	public function index()
	{
		$this->LearningFlow->save();
		// postかどうかチェック postをputにかえてもイイヨ
		if ($this->request->is('post')) {
			/*
			// ViewからのPOST・PUT
			$this->request->data['hoge'];
			// query
			$this->request->query['foo'];
			*/
			$saveData = $this->request->data;
			if ($this->Base->save($saveData)) {
				echo '保存に成功しました';
			} else {
				echo '保存に失敗しました';
			}
			var_dump($this->request->data);
			die();
		}

		$foo = 128;
		$dbData = $this->Base->find('all');
		// これでViewで、$hogeで値がとれる
		$this->set('hoge', $foo);
		$this->set('dbData', $dbData);


	}
	public function edit($id = null){
		// Controller アクションへのリダイレクト
		return $this->redirect(
			array('controller' => 'orders', 'action' => 'thanks')
		);
		

	}

	public function add(){
		// actionへのデータ
		$this->redirect(array('action' => 'edit', $id));
	}
}