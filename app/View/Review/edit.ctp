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
			$('#test5').on('input', function(){
				var range_num = $(this).val();
				console.log($(this).val());
				$('.js_Star').remove();
				for (var i=0; i<range_num; i++) {
					$('.js_StarField').append(
						'<i class="material-icons js_Star">star</i>'
					);
				}
			});
		});
	</script>
</head>
<body>
	<pre>
	<?php var_dump($data); ?>
	</pre>
	<form class="col s12" method="post" id="review">
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
		<div class="row">
			<div class="input-field col s6">
				<p class="range-field">
				<input type="range" id="test5" min="0" max="5" name="data[Review][evaluation]" value="<?php echo ($isEdit) ? $data['Review']['evaluation'] : '';?>"/>
				</p>
				<div class="js_StarField">
					<i class="material-icons js_Star">star</i>
				</div>
			</div>
		</div>
	</form>
	<button class="btn waves-effect waves-light" type="submit" form='review'>Submit
		<i class="material-icons right">send</i>
	</button>
</body>
</html>