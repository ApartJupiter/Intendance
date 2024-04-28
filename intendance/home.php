<?php include('db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
  <?php 
    $where = "";
    if($_SESSION['login_type'] == 2){
      $where = " where manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
     $where2 = "";
    if($_SESSION['login_type'] == 2){
      $where2 = " where p.manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
    ?>
       <div class="card-body">
              Welcome <?php echo $_SESSION['login_name'] ?>!
            </div>        
            
      <form action="" id="login-for">
      <?php 
      $name=($_SESSION['login_name']);
      date_default_timezone_set("Asia/Calcutta");
      $_SESSION['i']="In";
      ?>
      <input type="hidden" name="date" id="date" value="">
      <input type="hidden" name="time" id="time" value="">
       <input type="hidden" name="name" id="name" value="<?php echo $name;?>">
       <input type="hidden" name="in/out" value="<?php echo $_SESSION['i'];?>">
       <input class="d-none" type="submit" name="submit" id="submit">
     </form>
      <div class="row">
        <div class="col-lg-12">
        <div class="card card-outline card-teal">
          <div class="card-header">
            <b>Project Progress</b>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover">
                <colgroup>
                  <col width="15%">
                  <col width="30%">
                  <col width="35%">
                  <col width="15%">
                  <col width="15%">
                </colgroup>
                <thead>
                  <th>Sr. No.</th>
                  <th>Project</th>
                  <th>Progress</th>
                  <th>Status</th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
                $where = "";
                if($_SESSION['login_type'] == 2){
                  $where = " where manager_id = '{$_SESSION['login_id']}' and status!=5";
                }elseif($_SESSION['login_type'] == 3){
                  $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
                }elseif($_SESSION['login_type'] == 1){
                  $where = "where status != 5";
                }

                $qry = $conn->query("SELECT * FROM tp_data $where order by name asc");
                while($row= $qry->fetch_assoc()):
                  $prog= 0;
                $tprog = $conn->query("SELECT * FROM it_data where project_id = {$row['id']}")->num_rows;
                $cprog = $conn->query("SELECT * FROM it_data where project_id = {$row['id']} and status = 3")->num_rows;
                $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
                $prog = $prog > 0 ?  number_format($prog,2) : $prog;
                $prod = $conn->query("SELECT * FROM usr_activity where project_id = {$row['id']}")->num_rows;
                if($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
                if($prod  > 0  || $cprog > 0)
                  $row['status'] = 2;
                else
                  $row['status'] = 1;
                elseif($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
                $row['status'] = 4;
                endif;
                  ?>
                  <tr>
                      <td>
                         <?php echo $i++ ?>
                      </td>
                      <td>
                          <a>
                              <?php echo ucwords($row['name']) ?>
                          </a>
                          <br>
                          <small>
                              Due: <?php echo date("Y-m-d",strtotime($row['end_date'])) ?>
                          </small>
                      </td>
                      <td class="project_progress">
                          <small>
                              <?php echo $prog ?>% Complete
                          </small>
                      </td>
                      <td class="project-state">
                          <?php
                            if($stat[$row['status']] =='Pending'){
                              echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Started'){
                              echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='On-Progress'){
                              echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='On-Hold'){
                              echo "<span class='badge badge-warning'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Over Due'){
                              echo "<span class='badge badge-danger'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Done'){
                              echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
                            }
                          ?>
                      </td>
                      <td>
                        <a class="btn btn-outline-primary btn-sm" href="./index.php?page=view_project&id=<?php echo $row['id'] ?>">
                              View
                        </a>
                      </td>
                  </tr>
                <?php endwhile; ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
      </div>
      <script>
       $(document).ready(function (){
         jQuery('#submit').on('click',function(e){
		e.preventDefault();
		jQuery.ajax({
			url:'https://script.google.com/macros/s/AKfycbz5HCOiL-4PbWS-nTiPK6xFfv4l3PUU2hMebBfmKWO70as7LwMfPAbNeEVYFtW6nl3pTQ/exec',
      //https://docs.google.com/spreadsheets/d/1DxnKy9JPEt2nefF5wxgFwSroHUCS5FEeOHHHEBQr1ic/edit#gid=526408321
      //Paste the above link to the browser for login and logout activity.
			type:'POST',
			data:jQuery('#login-for').serialize(),
			success:function(result){
				$('#login-for').reset();
			}
	  });  
  }); 
  if(sessionStorage.getItem("resp1")=="0"){
    sessionStorage.setItem("resp1","1");
    $('#date').val(new Date().toLocaleDateString().slice(0,10));
          $('#time').val(new Date().toLocaleTimeString().slice(0,11));
        $("#submit").trigger("click");
  }
})     
</script>