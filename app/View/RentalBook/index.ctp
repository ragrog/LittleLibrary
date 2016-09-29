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
				var url = '/api_isbn/' + $('#isbn').val() + '.json';
					var jqXHR = $.ajax({
						type: 'GET',
						url: url,
						dataType: 'json'
					});
					return jqXHR;
				}
					var getHtml = ajaxGetHtml();
					getHtml.done(function(response) {
						console.log(response);
						$('#title').text(response.result.title);
						$('#author').text(response.result.author);
						$('#publisher').text(response.result.publisher);
						$('#publication_date').text(response.result.publication_date);
						$('#count').text(response.result.count);
						$('#isbn').text(response.result.isbn);
						$('#send_button').attr('href', '/RentalBook/rentalBook/' + response.result.id);

						Materialize.updateTextFields();
					});
					getHtml.fail(function() {
						alert("本の検索に失敗しました");
					});
			
			});
			$('#isbn').on('keydown',function(e) {
					if(e.keyCode === 13) {
						$('#search_button').trigger("click");
					}
				});
		});
	</script>
</head>
<body>
	<p> 下の入力フォームにISBNを入力してください。</p>

	<!-- ISBN -->
	<div class="row">
		<div class="input-field col s3">
			<input  id="isbn" type="text" class="validate" >
			<label for="isbn">ISBN</label>
		</div>
		<div class="input-field col s3">
			<a class="waves-effect waves-light btn" id="search_button"><i class="material-icons left">search</i>検索</a>
		</div>
	</div>
		<h2 id="author"></h2>
		<h2 id="publisher"></h2>
		<h2 id="publication_date"></h2>
		<h2 id="count"></h2>
		<h2 id="isbn"></h2>
		<!-- 送信ボタン -->
		<a class="waves-effect waves-light btn" id="send_button"><i class="material-icons left">send</i>button</a>
</body>
</html>