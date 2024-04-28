<nav class="main-header navbar navbar-expand navbar-teal">
  <h2 class="pl-4 pt-1 ">Intendance</h2>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class=""  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
              <span>
                <div class="d-flex badge-pill">
                  <span class="text-dark mt-3 mr-2 text-center"><h2 class="float-left mr-2"><i class="bi bi-person-circle text-dark"></i></h2></span>
                </div>
              </span>
            </a>
            <form action="" id="login-for1">
       <?php 
       date_default_timezone_set("Asia/Calcutta");
       $name1=($_SESSION['login_name']);
       $o="out";
       ?>
       <input type="hidden" name="date" id="date1" value="">
       <input type="hidden" name="time" id="time1" value="">
       <input type="hidden" name="name" id="name" value="<?php echo $name1;?>">
       <input type="hidden" name="in/out" value="<?php echo $o;?>">
       <input class="d-none" type="submit" name="submit1" id="submit1">
      </form>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
              <a class="dropdown-item" href="javascript:void(0)" id="manage_account"><i class="fa fa-cog"></i> Manage Account</a>
              <a class="dropdown-item" id="logout" href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a>
            </div> 
      </li>
    </ul>
  </nav>
  <script>
     $('#manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
      })
      $(document).ready(function (){
        jQuery('#logout').on('click',function(e){
          $('#date1').val(new Date().toLocaleDateString().slice(0,10));
          $('#time1').val(new Date().toLocaleTimeString().slice(0,11));
          $('#submit1').on('click',function (e){
            e.preventDefault();
		jQuery.ajax({
			url:'https://script.google.com/macros/s/AKfycbz5HCOiL-4PbWS-nTiPK6xFfv4l3PUU2hMebBfmKWO70as7LwMfPAbNeEVYFtW6nl3pTQ/exec',
			type:'POST',
			data:jQuery('#login-for1').serialize(),
			success:function(result){
        location.href="ajax.php?action=logout";
			}
		})
	  })
    $("#submit1").trigger("click");   
          });
        })
  </script>
