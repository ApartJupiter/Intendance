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
	<form action="" id="manage-task">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name="project_id" value="<?php echo isset($_GET['pid']) ? $_GET['pid'] : '' ?>">
		<div class="form-group">
			<label for="">Task</label>
			<input type="text" class="form-control form-control-sm" name="task" value="<?php echo isset($task) ? $task : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="" cols="30" rows="10" class="form-control" required>
				<?php echo isset($description) ? $description : '' ?>
			</textarea>
		</div>
		<div class="form-group">
			<label for="">Status</label>
			<select name="status" id="status" class="custom-select custom-select-sm" required>
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Pending</option>
				<option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>On-Progress</option>
				<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>Done</option>
			</select>
		</div>
		<div class="form-group">
			<label for="">Rate</label>
			<input type="number" class="form-control form-control-sm" disabled="disabled" id="it_rating" name="it_rating" value="<?php echo isset($it_rating) ? $it_rating : '' ?>" required>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		var status = document.getElementById('status').selectedOptions[0].value;
		var rate = document.getElementById('it_rating');
		if(status=="3"){
			rate.removeAttribute('disabled');
		}
	})
    $('#manage-task').submit(function(e){
    	e.preventDefault()
    	$.ajax({
    		url:'ajax.php?action=save_task',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},10)
				}
			}
    	})
    })
</script>