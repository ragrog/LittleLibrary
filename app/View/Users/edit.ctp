<?php var_dump($this->data);?>
<ul>
	<li>ユーザー名 <?php echo $this->data['User']['username'];?></li>
	<li>登録日 <?php echo date('Y/m/d', strtotime($this->data['User']['created']));?></li>
	<li>権限 <?php echo ($this->data['User']['role'] === 'admin') ? '管理者' : 'メンバー';?></li>
	<input type="submit" formmethod="post" formaction="http://192.168.40.10/users/delete/3">
	</button>
</ul>