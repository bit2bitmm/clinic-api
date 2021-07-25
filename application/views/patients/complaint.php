<?php
    echo "<div id='comment".$complaint->id."' class='new well well-md'>";
      echo "<div class='commentBody'>
           <span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('cid'=>$complaint->id,'pi'=>$complaint->patient_id,'action'=>'delete'))."</i></span>".$complaint->complaint.'</div>';
      echo "<div class='pull-right'>".$complaint->created_date."</div>";
    echo "</div>";

?>

  <script type="text/javascript">

  	$(document).ready(function(){

  	  $("#commentGroup span > i >  a").on('click',complaintAction);

  		 function complaintAction(e)
      {
        e.preventDefault();
        var csrfVal=$('form input[name="csrf_test_name"]').val();
        var cid    =$(this).attr('cid');
        var pi     =$(this).attr('pi');
        if($(this).attr('action')=='delete'){
      
            $.post('<?php echo site_url("complaints/delete")."/";?>'+cid,'csrf_test_name='+csrfVal+'&complaint_id='+cid+'&patient_id='+pi,function(data){
            if(data=='ok'){
              $('#comment'+cid).fadeOut();
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