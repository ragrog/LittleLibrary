<?php

App::uses('AppController', 'Controller');

class ApiIsbnController extends AppController {
	public $components = array('RequestHandler');
	public function index()
	{
		$this->viewClass = 'Json';
		$isError = false;
		// isbnisbnがisbnだった場合は$isbnに代入、エラーだった場合あbadrequest
		if (isset($this->request->query['isbn']) 
		&& preg_match('/(^\d{10}$)|(^\d{13}$)/', $this->request->query['isbn']) === 1) {
			$isbn = $this->request->query['isbn'];
		} else {
			$result['message'] = "ISBNは10桁又は13桁の数字のみが有効です";
			// エラー処理
			$isError = true;
		}
		if (!$isError) {
			// ISBNを用いて、国会図書館APIから書籍情報を取得する
			$ch = curl_init();
			$uri = 'http://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=isbn%3D%22'. $isbn .'%22';
			$options = array(
				CURLOPT_URL => $uri,
				CURLOPT_HEADER => false,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_TIMEOUT => 60, 
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_POSTFIELDS => null, // URLエンコードして application/x-www-form-urlencoded でエンコード。URLエンコードしないとmultipart/form-dataになる
			);
			curl_setopt_array($ch, $options);
			$response =curl_exec($ch) ;// 第2引数をtrueにすると連想配列で返ってくる
			curl_close($ch);
			var_dump($response);
			// レスポンスが空のとき、エラーとする
			if (preg_match('/REPOSITORY_NO/', $response) === 1) {
				// エラー
				$isError = true;
				$result['message'] = "該当する書籍は存在しません";
			} else {
				$result = [];
				$result['title'] = $this->__getElement($response, 'title');
				$result['creator'] = $this->__getElement($response, 'creator');
				$result['publisher'] = $this->__getElement($response, 'publisher');
			}
		}
		if ($isError === true) {
			$result['title'] = "";
			$result['creator'] = "";
			$result['publisher'] = "";
			$this->response->statusCode(400);
		} 


		$this->set(array(
			'result' => $result,
			'_serialize' => array('result')
		));
		//return $response;
	}
	/*
	public function edit($id = null){
		// Controller アクションへのリダイレクト
		return $this->redirect(
			array('controller' => 'orders', 'action' => 'thanks')
		);
		

	}
	*/

	// 渡したtextの中から指定した属性の要素を取得。失敗したらnullを返す
	private function __getElement($text, $attr) {
		$regex = '/&lt;dc:' . $attr . '&gt;(.*)&lt;\/dc:' . $attr . '&gt;/';
		preg_match($regex, $text, $result);
		return empty($result) ? null : $result[1];
	}
}