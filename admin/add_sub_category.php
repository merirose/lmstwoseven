<?php 
session_start(); 
if(!isset($_SESSION["username"])){
	header("location: login.php");
}

include "../connection.php";
$msg="";
$sub_category_id="";
$sub_category_name="";
$sub_category_order="";
$category_id="";
if(isset($_GET["edit_id"])){

	$qe = mysqli_query($con, "select * from table_sub_category where sub_category_id='".mres($con,$_GET["edit_id"])."'");
	while($row=mysqli_fetch_array($qe)){
		$sub_category_id=$row["sub_category_id"];
		$sub_category_name=$row["sub_category_name"];
		$sub_category_order=$row["sub_category_order"];
		$category_id=$row["category_id"];
	}
}


if(isset($_POST["btn_save"])){
	$text_sub_category_name=mres($con,$_POST["text_sub_category_name"]);
	$text_sub_category_order=mres($con,$_POST["text_sub_category_order"]);
	$category_id=mres($con,$_POST["category_id"]);
$qry=mysqli_query($con, "insert into table_sub_category values('','".$text_sub_category_name."','".$text_sub_category_order."','".$category_id."')");
if($qry){
	$msg='
		<div id="login-alert" class="alert alert-success col-sm-12">Success! Data is inserted</div>
	';
}
else {
	$msg='
		<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Cannot insert data to Database</div>
	';
}
}

if(isset($_POST["btn_edit"])){
$sub_category_id=mres($con,$_POST["text_sub_category_id"]);
$sub_category_name=mres($con,$_POST["text_sub_category_name"]);
$sub_category_order=mres($con,$_POST["text_sub_category_order"]);
$category_id=mres($con,$_POST["category_id"]);
$qry=mysqli_query($con,"update table_sub_category set sub_category_name='".$sub_category_name."', sub_category_order='".$sub_category_order."',category_id='".$category_id."' where sub_category_id='".$sub_category_id."'");

if($qry){
	header("location: manage_sub_category.php");
	$msg='
		<div id="login-alert" class="alert alert-success col-sm-12">Success! Data is edited</div>
	';
}
else {
	$msg='
		<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Cannot edit data to Database</div>
	';
}
}

?>
<?php
include "header.php";

?>
	<div class="row" style="padding-left: 0px;padding-right: 0px;">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px;padding-right: 0px;">
				<?php include "left_menu.php";?>
			</div>

			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Add New Sub Category</div>
					</div>
						<div class="panel-body">
							<?php echo $msg;?>
							<form id="form_sub_category" class="form-horizontal" role="form" method="post" action='<?php echo $_SERVER["PHP_SELF"];?>'>
							<input type="hidden" name="text_sub_category_id" value="<?php echo $sub_category_id;?>">
							<div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">Sub Category Name</span>
                                    <input type="text" class="form-control" name="text_sub_category_name" id="text_sub_category_name" value="<?php echo $sub_category_name;?>">                                    
                            </div>
							<div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">Sub Category Order</span>
                                    <input type="text" class="form-control" name="text_sub_category_order" id="text_sub_category_order" value="<?php echo $sub_category_order;?>">
                                </div>

                                <div style="margin-bottom: 25px;" class="input-group">
                                	<span class="input-group-addon">Category</span>
                                	<select name="category_id" class="form-control" id="category_id">
                                		<option value=''>-- Choose a Category --</option>
                                	<?php
                                	$qtc=mysqli_query($con,"select * from table_category order by category_order desc");
                                	while ($row=mysqli_fetch_array($qtc)) {
                                		if($row["category_id"]==$category_id)
                                		echo '<option value="'.$row["category_id"].'" selected>'.$row["category_name"].'</option>';
                                		else
                                		echo '<option value="'.$row["category_id"].'">'.$row["category_name"].'</option>';
                                	}

                                	?>
                                	</select></div>


                                <div style="margin-top:10px" class="form-group">
                                	<div class="col-sm-12 controls">
                                		<?php if(!isset($_GET["edit_id"])){
                                			echo '<input type="submit" id="btn_save" name="btn_save" class="btn btn-info btn-block btn-large" value="Save"></a>';

                                		}

 										else {
                                			echo '<input type="submit" id="btn_edit" name="btn_edit" class="btn btn-info btn-block btn-large" value="Edit"></a>';

 										}
 										?>
                                    </div>
                                </div>
						</form>

						</div>
			</div>



	</div>

</div>
<script>
	$(document).ready(function(){
			$('input[class="form-control"]').focus(function(){
			$(this).removeAttr('style');
			});

	  $("#btn_save,#btn_edit").click(function(e){
	 	if($('#text_sub_category_name').val()==''){
	 		$('#text_sub_category_name').css("border-color", "#DA190B");
	 		$('#text_sub_category_name').css("background", "#F2DEDE");
	 		e.preventDefault();
	 	}
	 	if($('#text_sub_category_order').val()==''){
	 		$('#text_sub_category_order').css("border-color", "#DA190B");
	 		$('#text_sub_category_order').css("background", "#F2DEDE");
	 		e.preventDefault();
	 	}
	 	if($('#category_id').val()==''){
	 		$('#category_id').css("border-color", "#DA190B");
	 		$('#category_id').css("background", "#F2DEDE");
	 		e.preventDefault();
	 	}
	 	else{
	 		$('form_add_sub_category').unbind('submit').submit();
	 	}
	  });
	});
</script>
<?php include "footer.php"; ?>