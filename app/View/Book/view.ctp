<!DOCTYPE html>
<html>
<head>

	<title>
		<?php echo $data['BookInfo']['title']; ?>
	</title>
	<script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" >
		$(document).ready(function() {
			$('.materialboxed').materialbox();
			$('#delete').on('click', function() {
				if(!confirm('本当に削除しますか?')) {
					return false;
				} else {
					location.href = "/Book/delete/<?php echo $data['BookInfo']['id'];?>";
				}
			});
		});
	</script>
</head>
<body>
	<h1><?php echo $data['BookInfo']['title'];?></h1>
	<img class="materialboxed" width="200" src="/img/book_thumbnail/<?php echo $data['BookInfo']['thumbnail_name']?>">
		<h2><?php echo $data['BookInfo']['author'];?></h2>
		<h2><?php echo $data['BookInfo']['publisher'];?></h2>
		<h2><?php echo $data['BookInfo']['publication_date'];?></h2>
		<h2><?php echo $data['BookInfo']['count'];?></h2>
		<h2><?php echo $data['BookInfo']['isbn'];?></h2>
	<div class="row">
		<?php if ($userRentalStatus === 'NOW_RENTAL') : ?>
			<a class="waves-effect waves-light btn" href="/Book/returnBook/<?php echo $data['BookInfo']['id'];?>"><i class="material-icons left">library_books</i>返す</a>
		<?php elseif ($userRentalStatus === 'CAN_RENTAL') :?>
			<a class="waves-effect waves-light btn" href="/Book/rentalBook/<?php echo $data['BookInfo']['id'];?>"><i class="material-icons left">library_books</i>借りる</a>
		<?php endif;?>
		<a class="waves-effect waves-light btn"><i class="material-icons left">comment</i>レビューを書く</a>
	</div>
	<div class="row">
		<?php if ($data['role'] === 'admin') : ?>
			<a class="waves-effect waves-light btn" href="/Book/edit/<?php echo $data['BookInfo']['id'];?>"><i class="material-icons left">mode_edit</i>編集</a>
			<a class="waves-effect waves-light btn" id="delete"><i class="material-icons left">delete</i>削除</a>
		<?php endif;?>
	</div>
</body>
</html>