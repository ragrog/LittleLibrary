<?php 
$this->assign('title', 'Little Library - UserLogin -');
?>
<?php 
$this->start('script');
?>
	<script type="text/javascript" >
		$(document).ready(function() {
			Materialize.updateTextFields();
			$('select').material_select()
		});
	</script>
<?php 
$this->end();
?>

<h2>ユーザーログイン</h2>
	<div class="row">
		<form class="col s12" method="post" name="User" id='user'>
		<div class="row">
			<div class="input-field col s6">
				<input  id="user_name" type="text" class="validate" name="data[User][username]">
				<label for="user_name">USER NAME</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="user_password" type="password" class="validate" name="data[User][password]">
				<label for="user_password">PASSWORD</label>
			</div>
		</div>
		</form>
		<button class="btn waves-effect waves-light" type="submit" name="User" form='user'>Submit
			<i class="material-icons right">send</i>
		</button>
	</div>
