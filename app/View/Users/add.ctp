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
	<h2>SubTitle</h2>
		<div class="row">
			<form class="col s12" method="post" name="User" id='user'>
			<div class="row">
				<div class="input-field col s6">
					<input  id="user_name" type="text" class="validate" name="data[User][username]">
					<label for="user_name">USER NAME</label>
					<ul>
						<?php if (isset($validation['username'])) :
								foreach ($validation['username'] as $error) : ?>
								<li> <?php echo $error?> </li>
						<?php	endforeach; 
						endif; ?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="user_password" type="password" class="validate" name="data[User][password]">
					<label for="user_password">PASSWORD</label>
					<ul>
							<?php if (isset($validation['password'])) :
									foreach ($validation['password'] as $error) : ?>
									<li> <?php echo $error?> </li>
							<?php	endforeach; 
							endif; ?>
					</ul>
				</div>
			</div>
			<div class="input-field col s6">
				<select name="data[User][role]">
					<option value="member" selected>member</option>
					<option value="admin">admin</option>
				</select>
				<label>ROLE</label>
				<ul>
					<?php if (isset($validation['role'])) :
							foreach ($validation['role'] as $error) : ?>
							<li> <?php echo $error?> </li>
					<?php	endforeach; 
					endif; ?>
				</ul>
			</div>
			</form>
			<button class="btn waves-effect waves-light" type="submit" name="User" form='user'>Submit
				<i class="material-icons right">send</i>
			</button>
		</div>
</body>
</html>