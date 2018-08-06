  <div class="container border">
	  <div class="row" align="center">
		<div class="col-sm-3">
			Posts: #<span id="posts_cnt"><?php echo $posts_cnt; ?></span>
		</div>
		<div class="col-sm-6">
			<a download href="<?php echo base_url(); ?>index.php/Welcome/zip"><button type="button" class="btn btn-success">Export</button></a>
		</div>
		<div class="col-sm-3">
			Views: #<span id="views_cnt"><?php echo $views_cnt; ?></span>
		</div>
	  </div>
  </div>	


  <div class="container border">
  
  <?php if(isset($error)) : ?>
		<div class="alert alert-primary" role="alert">
			<?php echo $error; ?>
		</div>
  <?php endif; ?>
  
    <?php if(isset($info)) : ?>
		<div class="alert alert-secondary" role="alert">
			<?php echo $info; ?>
		</div>
  <?php endif; ?>

  
  <form id="uploadform" method="POST" enctype="multipart/form-data">
	<div class="row" align="center">
		<div class="col-sm-12">
			<div class="form-group">
				<input class="form-control" type="text" name="title" placeholder="Enter picture title here..."  >
			</div>
		</div>	
	</div>
	<div class="row" align="center">
		<div class="col-sm-12">
			<div class="form-group">
				<div class="custom-file">
				  <input type="file" id="fileupload" name="userfile" accept="image/gif, image/jpeg" class="custom-file-input" >
				  <label class="custom-file-label" for="customFile" id="chooseLabel" >Choose picture</label>
				</div>
			</div>
		</div>	
	</div>		
	<div class="row" align="center" id="preview" style="display:none">
		<div class="col-sm-12">
			<div class="container border">
				<img id="image_preview" style="width:100%;max-width:400px;" >
				<hr>
				<input type="submit" name="submit" class="btn btn-primary" value="Upload picture"></input>
			</div>
		</div>
	</div>
  </form>
  </div>	
  
  
  <?php foreach($pictures as $p) : ?>
  <div class="container border">
	<div class="row" align="center">
		<div class="col-sm-12"><h4><?php echo $p->title; ?></h4></div>
	</div>
	<div class="row" align="center">
		<div class="col-sm-12"><img src="./uploads/<?php echo $p->filename; ?>" style="max-width:100%"></div>
	</div>
  </div>
  <?php endforeach; ?>