
<div class="" id="history" style="padding-top: 10px;">

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

  <div>
  <a data-toggle="collapse" href="#collapseHistory" 
      aria-expanded="false" aria-controls="collapseExample" id="collapseHis">
       
        <i class="fa fa-plus btn btn-primary"> <small class="label label-default">History</small></i>
        <i class="fa fa-minus btn btn-primary"> <small class="label label-default">History</small></i>
    </a>
  </div>

	<?php if($patient_data['id'] == TRUE){
   echo "<div class='collapse' id='collapseHistory'>";
   echo "<div class='row'>";
   echo "<div class='col-sm-6'>";
       echo form_open('historys/create/'.$patient_data['id'],array('id'=>'historyBox'));
	     echo form_hidden('patient_id',$patient_data['id']);
       echo form_textarea(array(
        'name' => 'history',
        'id' => 'historyeditor',
        'class' => 'autoExpand',
        'rows' => '3',
        'data-min-rows' => '3',
        'placeholder' => 'Write your history about this patient...',
        'required' => 'required'
    ));
       // echo form_submit('Save','Save','class="btn btn-primary ml-3" id="savehistory"');
       echo form_close();
       echo "<p></p>"; 
    echo "</div>";

  }
  echo "<div class='col-sm-6'>";
  echo "<div id='historyGroup'>";
  foreach($history as $his) {

      echo "<div id='history".$his->id."' class='well well-md'>"; 
          echo "<div class='historyBody'><span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('hid'=>$his->id,'pi'=>$his->patient_id,'action'=>'delete'))."</i></span>".$his->history.'</div>';
          echo "<div class='pull-right'>".$his->created_date."</div>";//<span class='close'>&times;</span>
        echo "</div>";
  }
   echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
		?>

</div>
