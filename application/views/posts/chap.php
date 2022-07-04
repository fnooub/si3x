<h1><a href="<?php echo base_url() . 'posts/detail/' . $id ?>"><?php echo $title ?></a></h1>
<?php if (!empty($post)): ?>
<h2><?php echo $post['td'] ?></h2>
<div class="py-2"><?php echo $post['nd'] ?></div>
<?php endif ?>
<?php if (isset($tt)): ?>
	<?php echo $tt ?>
<?php endif ?>
<?php if (isset($ts)): ?>
	<?php echo $ts ?>
<?php endif ?>
