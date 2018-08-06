<script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



<script>
  function readURL(input) {
		if (input.files && input.files[0]) {
							
			if(input.files[0].size>20000000)
			{
				alert('File too big!');
				return FALSE;
			}
			var reader = new FileReader();
									
			reader.onload = function(e) {
				$("#image_preview").attr('src', e.target.result);
				$("#preview").show();
				$("#chooseLabel").html('Choose other picture');	
				var image = new Image();
				image.src=reader.result;
				image.onload = function () {
					if(image.width>1920 || image.height>1080)
						{
							alert('Image dimensions too big. Maximum 1920x1080 allowed');
							return false;
						}
				}
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#fileupload").change(function() {
		var file = this['files'][0];
		var fileType = file["type"];
		var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
		
		if ($.inArray(fileType, ValidImageTypes) < 0) {
			 alert('Invalid file type. Only jpg, png, gif are supported.');
			 return false;
		}
		
		readURL(this);
	});

	
	function updateCounters() {
		  $.ajax({
			url: "http://etho.pl/softbit/index.php/Api/counters",
			dataType : 'json',
			success: function(data){
			   $('#posts_cnt').html(data['posts_cnt']); 
			   $('#views_cnt').html(data['views_cnt']); 
			}
		});
	}


	$(document).ready(function(){
			setInterval(updateCounters, 15000); 
	});
</script>