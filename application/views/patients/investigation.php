<?php
//if(@$complaints){
  //foreach ($complaints as $complaint) {
   echo "<div id='investigation".$investigation->id."' class='new well well-md'>"; 
          echo "<div class='investigationBody'><span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('iid'=>$investigation->id,'pi'=>$investigation->patient_id,'action'=>'delete'))."</i></span>".$investigation->investigation.'</div>';
          echo "<div class='pull-right'>".$investigation->created_date."</div>";//<span class='close'>&times;</span>
        echo "</div>";
  //}
//}
?>

<script type="text/javascript">
	$(document).ready(function(){

		 $("#investigationGroup span > i >  a").on('click',investigationAction);
         
      function investigationAction(e)
      {
        e.preventDefault();
        var csrfVal=$('form input[name="csrf_test_name"]').val();
        var iid    =$(this).attr('iid');
        var pi     =$(this).attr('pi');
        if($(this).attr('action')=='delete'){
      
            $.post('<?php echo site_url("investigations/delete")."/";?>'+iid,'csrf_test_name='+csrfVal+'&investigation_id='+iid+'&patient_id='+pi,function(data){
            if(data=='ok'){
              $('#investigation'+iid).fadeOut();
            }else if(data=='mismatch'){
              alert('Delete data mismatch');
            }else if(data=='invalid'){
              alert('Invalid data');
            }
          });
        }
      }
	})
</script>