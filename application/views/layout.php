<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('include/header');  ; ?>
</head>
<body>
	<div class="main-container">
		<?php $this->load->view('views/'.$view);  ; ?>
	</div>

	<div class="footer">
		<?php $this->load->view('include/footer');  ; ?>
	</div>
</body>
</html>
