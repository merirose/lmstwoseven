<?php 
session_start(); 
if(!isset($_SESSION["username"])){
	header("location: login.php");
}

include "../connection.php";

?>
<?php
include "header.php";

?>
	<div class="row" style="padding-left: 0px;padding-right: 0px;">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px;padding-right: 0px;">
				<?php include "left_menu.php";?>
			</div>

			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				

			</div>



	</div>


<?php include "footer.php"; ?>


<!-- <script>
	$(document).ready(function(){
	  $("#btn_username").click(function(e){
	 	if($('#username').val()==''){
	 		$('#username').css("border-color", "#DA190B");
	 		$('#username').css("background", "#F2DEDE");
	 		e.preventDefault();
	 	}
	 	else{
	 		$('form_username').unbind('submit').submit();
	 	}
	  });

	  $("#btn_password").click(function(e){
	 	if($('#password').val()==''){
	 		$('#password').css("border-color", "#DA190B");
	 		$('#password').css("background", "#F2DEDE");
	 		e.preventDefault();
	 	}
	 	else{
	 		$('form_password').unbind('submit').submit();
	 	}
	  });

	});
</script> -->
</body>
</html>