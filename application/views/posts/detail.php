<?php if ($this->session->userdata('logged_in')): ?>
	<a href="<?php echo base_url() . 'posts/edit/' . $id ?>" class="btn btn-warning">Sửa bài viết</a>
	<a href="<?php echo base_url() . 'posts/delete/' . $id ?>" class="btn btn-danger" onclick="if (! confirm('Xoa?')) { return false; }">Xoa</a>
	<hr>
<?php endif ?>
<h1><?php echo $title ?></h1>
<p><a href="<?php echo base_url() . 'posts/epub/' . $id ?>">Tải về epub</a> <a href="<?php echo base_url() . 'posts/epub/' . $id ?>">Tải về txt</a></p>
<?php if (!empty($posts)): ?>
	<?php foreach ($posts as $key => $post): ?>
		<div class="list-group mb-1">
			<a href="<?php echo base_url() ?>posts/chap/<?php echo $id ?>?c=<?php echo ($key+1) ?>" class="list-group-item list-group-item-action"><?php echo $post ?></a>
		</div>
	<?php endforeach ?>
	
<?php endif ?>
