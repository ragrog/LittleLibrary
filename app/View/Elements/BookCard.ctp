		<div class="col s12 m4">
			<div class="card medium">
				<div class="card-image waves-effect waves-block waves-light">
					<img class="activator" src="/img/book_thumbnail/<?php echo $data['BookInfo']['thumbnail_name']?>">
				</div>
				<div class="card-content">
					<span class="card-title activator grey-text text-darken-4">
					<?php 
						$strLen = mb_strlen($data['BookInfo']['title']);
						$title = $data['BookInfo']['title'];
						if ($strLen > 15) {
							$title = mb_substr($title, 0, 15) . "...";
						} else if($strLen < 5) {
							$title . '</br>';
						}
							echo $title;
					?>
						<i class="material-icons right">more_vert</i>
					</span>
					<p><a href="/Book/view/<?php echo $data['BookInfo']['id']?>">詳細へ</a></p>
				</div>
				<div class="card-reveal">
					<span class="card-title grey-text text-darken-4"><?php echo $data['BookInfo']['title']?><i class="material-icons right">close</i></span>
					<p>Here is some more information about this product that is only revealed once clicked on.</p>
				</div>
			</div>
		</div>