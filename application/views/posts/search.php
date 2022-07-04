<h1><?php echo $title ?></h1>
<?php if (!empty($posts)): ?>
	<?php foreach ($posts as $post): ?>
		<div class="list-group mb-1">
			<a href="<?php echo base_url() . 'posts/detail/' . $post['id'] ?>" class="list-group-item list-group-item-action"><?php echo $post['tieude'] ?></a>
		</div>
	<?php endforeach ?>
	
<?php endif ?>
