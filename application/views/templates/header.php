<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title><?php echo $title ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<a href="<?php echo base_url() ?>" class="fs-1">Truyen sac</a>
			<!-- tim kiem -->
			<form action="<?php echo base_url('posts/search') ?>" method="get">
				<div class="input-group mb-3">
					<input type="text" name="tukhoa" class="form-control" placeholder="Nhập tên truyện..." aria-label="Recipient's username" aria-describedby="button-addon2" />
					<button type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2">Tìm kiếm</button>
				</div>
			</form>

<?php if ($this->session->userdata('logged_in')): ?>
	<a href="<?php echo base_url('users/logout') ?>">Dang xuat</a> | 
	<a href="<?php echo base_url('posts/add') ?>">Them</a> | 
	<a href="<?php echo base_url('posts/delete_file') ?>">Xoa epubs</a>
	<hr>
<?php endif ?>
<?php if($this->session->flashdata('success')): ?>
<!-- thông báo thành công -->
<p class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></p>
<?php endif; ?>
<?php if($this->session->flashdata('warning')): ?>
<!-- thông báo lỗi -->
<p class="alert alert-warning"><?php echo $this->session->flashdata('warning'); ?></p>
<?php endif; ?>
