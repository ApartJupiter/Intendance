<script src="assets/plugins/bootstrap/js/bootstrap4-toggle.min.js"></script>
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<script src="assets/js/jquery.datetimepicker.full.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap-switch.min.js"></script>
<script>
	$(document).ready(function(){
	  $('.select2').select2({
	    placeholder:"Please select here",
	    width: "100%"
	  });
  })
	 
	  window.uni_modal = function($title = '' , $url='',$size=""){
	      $.ajax({
	          url:$url,
	          error:err=>{
	              console.log()
	              alert("An error occured")
	          },
	          success:function(resp){
	              if(resp){
	                  $('#uni_modal .modal-title').html($title)
	                  $('#uni_modal .modal-body').html(resp)
	                  if($size != ''){
	                      $('#uni_modal .modal-dialog').addClass($size)
	                  }else{
	                      $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
	                  }
	                  $('#uni_modal').modal({
	                    show:true,
	                    backdrop:'static',
	                    keyboard:false,
	                    focus:true
	                  })
	              }
	          }
	      })
	  }
	  window._conf = function($msg='',$func='',$params = []){
	     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
	     $('#confirm_modal .modal-body').html($msg)
	     $('#confirm_modal').modal('show')
	  }
	

 $(".switch-toggle").bootstrapToggle();
$('.number').on('input keyup keypress',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9]/, '');
        val = val.replace(/,/g, '');
        val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
        $(this).val(val)
    })

</script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/adminlte.js"></script>
<script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/js/buttons.colVis.min.js"></script>