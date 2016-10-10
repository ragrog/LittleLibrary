<?php 
$this->assign('title', 'タイトルです');
?>
<?php 
$this->start('script');
?>
   $(document).ready(function(){
      $('.parallax').parallax();
    });
<?php 
$this->end();
?>

<!-- first parallax -->
<div class="parallax-container">
	<div class="parallax"><img src="/img/bookshelf.jpg"></div>
</div>

<!-- content -->
<div class="section white">
	<div class="container">
	<h2 class="header">Little Library</h2>
	<p class="grey-text text-darken-3 lighten-3">
		このサービスは会社や研究室にある多くの本を管理するために作りました。<br>
		本を読んで、本を紹介して、本を追加していく。<br>
		みんなで育てていく、そんな小さな図書館を作るサービスです。<br>
	</p>

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
			'action' => '本を買って貰う',
			'link' => '/PurchaseRequest'
			));
		?>
		<?php echo $this->element('HomeCard', array(
			'symbol'=>'comment',
			'action' => 'レビュー',
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
</div>
<!-- Second Parallax-->
<div class="parallax-container">
	<div class="parallax"><img src="/img/bookshelf.jpg"></div>
</div>