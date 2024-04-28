<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM it_data where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-rating">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name="project_id" value="<?php echo isset($_GET['pid']) ? $_GET['pid'] : '' ?>">
		<div class="form-group">
			<label for="">Rate</label>
			<input type="number" class="form-control form-control-sm" name="it_rating" value="<?php echo isset($it_rating) ? $it_rating : '' ?>" required>
		</div>
	</form>
</div>
<script>
    $('#manage-rating').submit(function(e){
    	e.preventDefault()
    	$.ajax({
    		url:'ajax.php?action=save_rating',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert('Data successfully saved',"success");
					setTimeout(function(){
						location.reload()
					},10)
				}
			}
    	})
    })
</script>