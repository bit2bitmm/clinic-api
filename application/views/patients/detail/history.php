<div class="tab-pane" id="history" style="padding-top: 10px;">

	 <script>
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
              var qty = Number($("#history_count").text())-1;
              $("#history_count").text(qty);
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

  <div class="">

   <?php

  echo "<div id='historyGroup'>";
  foreach($history as $his) {

      echo "<div id='history".$his->id."' class='well well-md'>"; 
          echo "<div class='historyBody'><span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('hid'=>$his->id,'pi'=>$his->patient_id,'action'=>'delete'))."</i></span>".$his->history.'</div>';
          echo "<div class='pull-right'>".$his->created_date."</div>";//<span class='close'>&times;</span>
        echo "</div>";
  }
   echo "</div>";
		?>
		</div>

</div>



