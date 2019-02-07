<?php
include "connection.php";
$id="";
if(isset($_GET["id"])){
	$id=mres($con,$_GET["id"]);
}
else {
	header("location:index.php");
}

?>
<?php
include "header.php";
?>

		<div class="row">
			<div class="col-lg-3 col-md-3" style="padding-left:0px">
				<ul class="nav nav-pills nav-stacked">
				  <li class="active"><a href="#">
				  <?php
				  $qc=mysqli_query($con,"select category_name from table_category where category_id='".$id."'");
				  $rc=mysqli_fetch_array($qc);
				  		echo $rc[0];
				  ?>
				  </a></li>
				  <?php
				  $ql=mysqli_query($con,"select * from table_sub_category where category_id='".$id."' order by sub_category_id asc");
				  while($rl=mysqli_fetch_array($ql)){
				  		echo '<li><a href="#">'.$rl["sub_category_name"].'</a></li>';

				  }
				  ?>

				</ul>

		</div>
		<div class="col-lg-9 col-md-9 col-sm-9">
			Lecture
		</div>
	</div>
	<?php include "footer.php";?>
	</div>
</body>
</html>