<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-teal">
		<div class="card-header">
		<?php if($_SESSION['login_type'] != 3): ?>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat" href="./index.php?page=new_project"><i class="fa fa-plus"></i> Add New project</a>
			</div>
			<?php endif; ?>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">Sr. No.</th>
						<th>Project</th>
						<th>Task</th>
						<th>Project Started</th>
						<th>Project Due Date</th>
						<th>Project Status</th>
						<th>Task Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = "";
					if($_SESSION['login_type'] == 2){
						$where = " where p.manager_id = '{$_SESSION['login_id']}' ";
					}elseif($_SESSION['login_type'] == 3){
						$where = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
					}
					
					$stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
					$qry = $conn->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM it_data t inner join tp_data p on p.id = t.project_id $where order by p.name asc");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
						$tprog = $conn->query("SELECT * FROM it_data where project_id = {$row['pid']}")->num_rows;
		                $cprog = $conn->query("SELECT * FROM it_data where project_id = {$row['pid']} and status = 3")->num_rows;
						$prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
		                $prog = $prog > 0 ?  number_format($prog,2) : $prog;
		                $prod = $conn->query("SELECT * FROM usr_activity where project_id = {$row['pid']}")->num_rows;
		                if($row['pstatus'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
		                if($prod  > 0  || $cprog > 0)
		                  $row['pstatus'] = 2;
		                else
		                  $row['pstatus'] = 1;
		                elseif($row['pstatus'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
		                $row['pstatus'] = 4;
		                endif;


					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td>
							<p><b><?php echo ucwords($row['pname']) ?></b></p>
						</td>
						<td>
							<p><b><?php echo ucwords($row['task']) ?></b></p>
							<p class="truncate"><?php echo strip_tags($desc) ?></p>
						</td>
						<td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b></td>
						<td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td>
						<td class="text-center">
							<?php
							  if($stat[$row['pstatus']] =='Pending'){
							  	echo "<span class='badge badge-secondary'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='Started'){
							  	echo "<span class='badge badge-teal'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='On-Progress'){
							  	echo "<span class='badge badge-info'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='On-Hold'){
							  	echo "<span class='badge badge-warning'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='Over Due'){
							  	echo "<span class='badge badge-danger'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='Done'){
							  	echo "<span class='badge badge-success'>{$stat[$row['pstatus']]}</span>";
							  }
							?>
						</td>
						<td>
                        	<?php 
                        	if($row['status'] == 1){
						  		echo "<span class='badge badge-secondary'>Pending</span>";
                        	}elseif($row['status'] == 2){
						  		echo "<span class='badge badge-teal'>On-Progress</span>";
                        	}elseif($row['status'] == 3){
						  		echo "<span class='badge badge-success'>Done</span>";
                        	}
                        	?>
                        </td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info" data-toggle="dropdown" aria-expanded="true">
							<i class="bi bi-caret-down-fill"></i>
		                    </button>
			                    <div class="dropdown-menu" style="">
			                      <a class="dropdown-item new_productivity" data-pid = '<?php echo $row['pid'] ?>' data-tid = '<?php echo $row['id'] ?>'  data-task = '<?php echo ucwords($row['task']) ?>'  href="javascript:void(0)">Add Activity</a>
								</div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important
	}
</style>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.new_productivity').click(function(){
		uni_modal("<i class='fa fa-plus'></i> New Progress for: "+$(this).attr('data-task'),"manage_progress.php?pid="+$(this).attr('data-pid')+"&tid="+$(this).attr('data-tid'),'large')
	})
	})
	function delete_project($id){

		$.ajax({
			url:'ajax.php?action=delete_project',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},10)

				}
			}
		})
	}
</script>