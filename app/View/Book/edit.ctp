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
			$('#search_button').on('click', function(){

				function ajaxGetHtml() {
				var url = '/apiisbn/index/?isbn=' + $('#isbn').val();
					var jqXHR = $.ajax({
						type: 'GET',
						url: url,
						dataType: 'json'
					});
					return jqXHR;
				}
					var getHtml = ajaxGetHtml();
					getHtml.done(function(response) {
						$('#title').val(response.result.title);
						$('#author').val(response.result.author);
						$('#publisher').val(response.result.publisher);
						Materialize.updateTextFields();
					});
					getHtml.fail(function() {
						alert("通信に失敗しました");
					});
			
			});

			 $('#image').on('change', function(e) {
					var file = e.target.files[0],
						reader = new FileReader(),
						$preview = $(".preview");
						t = this;

					// 画像ファイル以外の場合は何もしない
					if(file.type.indexOf("image") < 0){
					return false;
					}

					// ファイル読み込みが完了した際のイベント登録
					reader.onload = (function(file) {
					return function(e) {
						//既存のプレビューを削除
						$preview.empty();
						// .prevewの領域の中にロードした画像を表示するimageタグを追加
						$preview.append($('<img>').attr({
								src: e.target.result,
								width: "150px",
								class: "preview",
								title: file.name
							}));
					};
					})(file);

					reader.readAsDataURL(file);
				});
		});
	</script>
</head>
<body>
	<h2><?php echo  ((isset($isPurchaseRequest) && $isPurchaseRequest === true) ? '購入申請を' : '本を')
						. ($isEdit ? "編集" : "追加") ;?></h2>
			<form class="col s12" method="post" name="book" id='book' enctype="multipart/form-data">
				<!-- タイトル -->
				<div class="row">
					<div class="input-field col s6">
						<input  id="title" type="text" class="validate" name="data[BookInfo][title]" value="<?php echo $isEdit ? $data['BookInfo']['title'] : ""?>">
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
				<!-- 著者 -->
				<div class="row">
					<div class="input-field col s6">
						<input  id="author" type="text" class="validate" name="data[BookInfo][author]" value="<?php echo $isEdit ? $data['BookInfo']['author'] : ""?>">
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
				<!-- 出版社 -->
				<div class="row">
					<div class="input-field col s6">
						<input  id="publisher" type="text" class="validate" name="data[BookInfo][publisher]" value="<?php echo $isEdit ? $data['BookInfo']['publisher'] : ""?>">
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
				<!-- 出版日 -->
				<div class="row">
					<div class="input-field col s6">
						<input  id="publication_date" type="text" class="validate" name="data[BookInfo][publication_date]" value="<?php echo $isEdit ? $data['BookInfo']['publication_date'] : ""?>">
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
				<!-- ISBN -->
				<div class="row">
					<div class="input-field col s3">
						<input  id="isbn" type="text" class="validate" name="data[BookInfo][isbn]" value="<?php echo $isEdit ? $data['BookInfo']['isbn'] : ""?>">
						<label for="isbn">ISBN</label>
						<ul>
							<?php if (isset($validation['isbn'])) :
									foreach ($validation['isbn'] as $error) : ?>
									<li> <?php echo $error?> </li>
							<?php	endforeach; 
							endif; ?>
						</ul>
					</div>
					<div class="input-field col s3">
						<a class="waves-effect waves-light btn" id="search_button"><i class="material-icons left">search</i>button</a>
					</div>
				</div>
				<!-- 冊数 -->
				<div class="row">
					<div class="input-field col s6">
						<input  id="count" type="text" class="validate" name="data[BookInfo][count]" value="<?php echo $isEdit ? $data['BookInfo']['count'] : "1"?>">
						<label for="count">冊数</label>
						<ul>
							<?php if (isset($validation['count'])) :
									foreach ($validation['count'] as $error) : ?>
									<li> <?php echo $error?> </li>
							<?php	endforeach; 
							endif; ?>
						</ul>
					</div>
				</div>
				<!-- サムネイル -->
				<div class="row">
					<div class="file-field input-field">
						<div class="btn">
							<span>サムネイル</span>
							<input id="image" type="file" name="data[BookInfo][image]">
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
					<div class="preview" >
					<?php if ($isEdit) : ?>
					<img src="/img/book_thumbnail/<?php echo $data['BookInfo']['thumbnail_name']?>" width="150px" class="preview">
					<?php endif;?>
					</div>
				</div>
				<?php if (isset($isPurchaseRequest) && $isPurchaseRequest === true) : ?>
					<!-- 購入申請時のコメント -->
					<div class="row">
						<div class="input-field col s6">
							<i class="material-icons prefix">mode_edit</i>
							<textarea id="icon_prefix2" class="materialize-textarea" name="data[Review][sentence]"><?php echo ($isEdit) ? $data['Review']['sentence'] : '';?></textarea>
							<label for="icon_prefix2">Review</label>
						</div>
						<ul>
							<?php if (isset($validation['isbn'])) :
								foreach ($validation['isbn'] as $error) : ?>
									<li> <?php echo $error?> </li>
								<?php	endforeach; 
								endif; ?>
						</ul>
					</div>
				<?php endif;?>
			</form>
			<!-- 送信ボタン -->
			<button class="btn waves-effect waves-light" type="submit" form='book'>Submit
				<i class="material-icons right">send</i>
			</button>
</body>
</html>