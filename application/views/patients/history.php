<?php
//if(@$complaints){
  //foreach ($complaints as $complaint) {
    echo "<div id='history".$history->id."' class='new well well-md'>";
      echo "<div class='historyBody'><span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('hid'=>$history->id,'pi'=>$history->patient_id,'action'=>'delete'))."</i></span>".$history->history.'</div>';
      echo "<div class='pull-right'>".$history->created_date."</div>";
    echo "</div>";
  //}
//}
?>

<script type="text/javascript">

	$(document).ready(function(){

	 $("#historyGroup span > i >  a").on('click',historyAction);
         
      function historyAction(e)
      {
        e.preventDefault();
        var csrfVal=$('form input[name="csrf_test_name"]').val();
        var hid    =$(this).attr('hid');
        var pi     =$(this).attr('pi');
        if($(this).attr('action')=='delete'){
      
            $.post('<?php echo site_url("historys/delete")."/";?>'+hid,'csrf_test_name='+csrfVal+'&history_id='+hid+'&patient_id='+pi,function(data){
            if(data=='ok'){
              $('#history'+hid).fadeOut();
            }else if(data=='mismatch'){
              alert('Delete data mismatch');
            }else if(data=='invalid'){
              alert('Invalid data');
            }
          });
        }
      }
	});
	
</script>