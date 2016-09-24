<!DOCTYPE html>
<html>
<head>

	<title>
	</title>
	<script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="/js/materialize.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" >
		$(document).ready(function() {
			Materialize.updateTextFields();
			$('select').material_select()
		});
	</script>
</head>
<body>
	<h1></h1>
	<h2>本を登録</h2>
		<div class="row">
			<form class="col s12" method="post" name="book" id='book' enctype="multipart/form-data">
				<div class="row">
					<div class="input-field col s6">
						<input  id="title" type="text" class="validate" name="data[BookInfo][title]">
						<label for="title">タイトル</label>
						<ul>
							<?php if (isset($validation['title'])) :
									foreach ($validation['title'] as $error) : ?>
									<li> <?php echo $error?> </li>
							<?php	endforeach; 
							endif; ?>
						</ul>
					</div>
				</div>
			<div class="row">
				<div class="input-field col s6">
					<input  id="author" type="text" class="validate" name="data[BookInfo][author]">
					<label for="author">著者</label>
					<ul>
						<?php if (isset($validation['author'])) :
								foreach ($validation['author'] as $error) : ?>
								<li> <?php echo $error?> </li>
						<?php	endforeach; 
						endif; ?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input  id="publisher" type="text" class="validate" name="data[BookInfo][publisher]">
					<label for="publisher">出版社</label>
					<ul>
						<?php if (isset($validation['publisher'])) :
								foreach ($validation['publisher'] as $error) : ?>
								<li> <?php echo $error?> </li>
						<?php	endforeach; 
						endif; ?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input  id="publication_date" type="text" class="validate" name="data[BookInfo][publication_date]">
					<label for="publication_date">出版年</label>
					<ul>
						<?php if (isset($validation['publication_date'])) :
								foreach ($validation['publication_date'] as $error) : ?>
								<li> <?php echo $error?> </li>
						<?php	endforeach; 
						endif; ?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input  id="isbn" type="text" class="validate" name="data[BookInfo][isbn]">
					<label for="isbn">ISBN</label>
					<ul>
						<?php if (isset($validation['isbn'])) :
								foreach ($validation['isbn'] as $error) : ?>
								<li> <?php echo $error?> </li>
						<?php	endforeach; 
						endif; ?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input  id="isbn" type="text" class="validate" name="data[BookInfo][count]">
					<label for="isbn">冊数</label>
					<ul>
						<?php if (isset($validation['count'])) :
								foreach ($validation['count'] as $error) : ?>
								<li> <?php echo $error?> </li>
						<?php	endforeach; 
						endif; ?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="file-field input-field">
					<div class="btn">
						<span>サムネイル</span>
						<input type="file" name="data[BookInfo][image]">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" name="">
					</div>
					<ul>
						<?php if (isset($validation['thumbnail_name'])) :
								foreach ($validation['thumbnail_name'] as $error) : ?>
								<li> <?php echo $error?> </li>
						<?php	endforeach; 
						endif; ?>
					</ul>
				</div>
			</div>
			</form>
			<button class="btn waves-effect waves-light" type="submit" form='book'>Submit
				<i class="material-icons right">send</i>
			</button>
		</div>
</body>
</html>