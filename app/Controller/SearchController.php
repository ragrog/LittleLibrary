<?php

App::uses('AppController', 'Controller');

class SearchController extends AppController {
	// 使うコンポーネント
	// public $components = array('hoge', 'foo');
	// 使うモデル
	// public $uses = array('hogeModel', 'fooModel');
	public $uses = array('Base');
	// indexだと、HomeTestController/でアクセスしたときにデフォルトで選択
	public function index()
	{
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