<?php

App::uses('AppController', 'Controller');

class HomeController extends AppController {
	public function beforeFilter() {
		$this->Auth->allow();
	}
	public function index()
	{
		// $this->layout = "sample";
		// var_dump($this->layout);

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