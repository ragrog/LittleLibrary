<?php

App::uses('AppController', 'Controller');

class ResultController extends AppController {
	// 使うコンポーネント
	// public $components = array('hoge', 'foo');
	// 使うモデル
	 public $uses = array('LearningPlan', 'LearningFlow');
	// indexだと、HomeTestController/でアクセスしたときにデフォルトで選択
	public function index($id)
	{
		$data = array();
		$data += $this->LearningPlan->find('first', array(
			'conditions' => array(
				'LearningPlan.id' => $id
			)
		));
		$data += $this->LearningFlow->find('all',array(
			'fields' => array(
				'lTech.tech_name',
				'lTech.sentence',
				'lTech.graphic_location'
			),
			'conditions' => array(
				'LearningFlow.learning_plan_id' => $id
			),
			'joins' => array(
				 array('table' => 'learning_techs',
					'alias' => 'lTech',
					'type' => 'LEFT',
					'conditions' => array(
						'LearningFlow.learning_tech_id = lTech.id',
					)
    			)
			)
		));
		$this->set('data',$data) ;
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