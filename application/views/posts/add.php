<h1><?php echo $title ?></h1>
<?php echo validation_errors(); ?>
<?php echo form_open(current_url()); ?>
<div class="mb-3">
	<label for="exampleFormControlInput1" class="form-label">Tieu de</label>
	<input type="text" name="tieude" class="form-control" id="exampleFormControlInput1">
</div>
<div class="mb-3">
	<label for="exampleFormControlTextarea1" class="form-label">Noi dung</label>
	<textarea name="noidung" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
</div>
<div class="mb-3">
	<button type="submit" class="btn btn-primary mb-3">Them</button>
</div>
<?php echo form_close(); ?>
