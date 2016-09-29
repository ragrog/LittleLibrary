<!DOCTYPE html>
<html>
<head>

	<title>
	Little Library
	</title>
	<script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<h1>Little Library</h1>
	<div class="row">
		<?php echo $this->element('HomeCard', array(
			'symbol'=>'library_books',
			'action' => '本を借りる',
			'link' => '/RentalBook'
			));
		?>
		<?php echo $this->element('HomeCard', array(
			'symbol'=>'clear_all',
			'action' => '本を返す',
			'link' => '/ReturnBook'
			));
		?>
		<?php echo $this->element('HomeCard', array(
			'symbol'=>'search',
			'action' => '本を探す',
			'link' => '/Book'
			));
		?>
	</div>
		<div class="row">
		<?php echo $this->element('HomeCard', array(
			'symbol'=>'shopping_cart',
			'action' => '購入申請',
			'link' => '/PurchaseRequest'
			));
		?>
		<?php echo $this->element('HomeCard', array(
			'symbol'=>'contacts',
			'action' => 'レビュー 一覧',
			'link' => '/Review'	
			));
		?>
		<?php echo $this->element('HomeCard', array(
			'symbol'=>'perm_identity',
			'action' => 'マイページ',
			'link' => '/MyPage'
			));
		?>
	</div>
	</div>
</body>
</html>