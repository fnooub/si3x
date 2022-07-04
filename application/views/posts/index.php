<?php if (!empty($posts)): ?>
	<?php foreach ($posts as $post): ?>
		<div class="list-group mb-1">
			<a href="<?php echo base_url() . 'posts/detail/' . $post['id'] ?>" class="list-group-item list-group-item-action"><?php echo $post['tieude'] ?></a>
		</div>
	<?php endforeach ?>
	
<?php endif ?>
<!-- pagination -->
<?php if (isset($pagination)): ?>
	<?php echo $pagination ?>
<?php endif ?>