<h1 class="text-center"><?php echo $title; ?></h1>
<?php echo validation_errors(); ?>
<?php echo form_open(current_url()); ?>
<div class="form-group mb-3">
	<input type="text" name="username" class="form-control" placeholder="Enter username">
</div>
<div class="form-group mb-3">
	<input type="password" name="password" class="form-control" placeholder="Enter Password">
</div>
<button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
<?php echo form_close(); ?>