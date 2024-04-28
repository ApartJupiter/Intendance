<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<div class="col-lg-12">
	<div class="card card-outline card-teal">
		<div class="card-body">
			<form action="" id="manage-project">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Name</label>
					<input type="text" class="form-control form-control-sm" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
				</div>
			</div>
          	<div class="col-md-6">
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" id="status" class="custom-select custom-select-sm" required>
						<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
						<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>On-Hold</option>
						<option value="5" <?php echo isset($status) && $status == 5 ? 'selected' : '' ?>>Done</option>
					</select>
				</div>
			</div>
		</div>
		<?php $date=date('Y-m-d'); 
		?>
		<div class="row">
			<div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Start Date</label>
              <input type="date" min="<?php echo $date ?>" class="form-control form-control-sm" autocomplete="off" id="start_date" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : '' ?>" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">End Date</label>
              <input type="date" min="<?php echo $date ?>" class="form-control form-control-sm" autocomplete="off" id="end_date" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : '' ?>" required>
            </div>
          </div>
		</div>
        <div class="row">
        	<?php if($_SESSION['login_type'] == 1 ): ?>
           <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Project Manager</label>
              <select class="form-control form-control-sm select2" name="manager_id" required>
              	<option></option>
              	<?php 
              	$managers = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 2 order by concat(firstname,' ',lastname) asc ");
              	while($row= $managers->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($manager_id) && $manager_id == $row['id'] ? "selected" : '' ?> required><?php echo ucwords($row['name']) ?></option>
              	<?php endwhile; ?>
              </select>
            </div>
          </div>
      <?php else: ?>
      	<input type="hidden" name="manager_id" value="<?php echo $_SESSION['login_id'] ?>">
      <?php endif; ?>
	  <div class="col">
			<div class="form-group">
			<label for="" class="control-label">Project Rating</label>
			<input class="form-control form-control-sm" type="number" placeholder="" disabled="disabled" name="tp_rating" id="tp_rating" value="<?php echo isset($tp_rating) ? $tp_rating : '' ?>">
			</div>
			</div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="control-label">Project Team Members</label>
              <select class="form-control form-control-sm select2" multiple="multiple" name="user_ids[]" required>
              	<option></option>
              	<?php 
              	$employees = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 3 order by concat(firstname,' ',lastname) asc ");
              	while($row= $employees->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id']?>"<?php echo isset($user_ids) && in_array($row['id'],explode(',',$user_ids)) ? "selected" :''?> required><?php echo ucwords($row['name']) ?></option>  
              	<?php endwhile; ?>
              </select>
            </div>
          </div>
        </div>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="" class="control-label">Description</label>
					<textarea name="description" id="txtarea" cols="30" rows="10" class="form-control" required>
						<?php echo isset($description) ? $description : '' ?>
					</textarea>
				</div>
			</div>
		</div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-info mx-2" form="manage-project">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=project_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var status = document.getElementById('status').selectedOptions[0].value;
		var rate = document.getElementById('tp_rating');
		if(status=="5"){
			rate.removeAttribute('disabled');
		}
	})
	$("#end_date").change(function(){
		var start_date = document.getElementById("start_date").value;
		var end_date = document.getElementById("end_date").value;
		if((Date.parse(start_date) >= Date.parse(end_date))){
			alert("End date should not be greater than start date");
			document.getElementById("end_date").value="";
		}
	})
	$('#manage-project').submit(function(e){
		e.preventDefault()
		$.ajax({
			url:'ajax.php?action=save_project',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert('Data successfully saved',"success");
						location.href = 'index.php?page=project_list'			
				}
			}
		})
	})
</script>