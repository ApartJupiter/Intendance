<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$type_arr = array('',"Admin","Project Manager","Employee");
	$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<div class="card card-widget widget-user">
      <div class="widget-user-header bg-light">
        <h3 class="text-dark">Name: <?php echo ucwords($name) ?></h3>
		<h5 class="text-dark">E-Mail: <?php echo $email ?></h5>
      </div>
	  <div class="mt-2">
	  <dl class="text-center bg-light">
        		<dt>Role</dt>
        		<dd><?php echo $type_arr[$type] ?></dd>
        	</dl>
	  </div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>