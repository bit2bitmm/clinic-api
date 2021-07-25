<?php
//if(@$complaints){
  //foreach ($complaints as $complaint) {
    echo "<div id='diagnosis".$diagnosis->id."' class='new well well-md'>";
      echo "<div class='diagBody'><span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('did'=>$diagnosis->id,'pi'=>$diagnosis->patient_id,'action'=>'delete'))."</i></span>".$diagnosis->diagnosis.'</div>';
      echo "<div class='pull-right'>".$diagnosis->created_date."</div>";
    echo "</div>";
  //}
//}
?>

<script type="text/javascript">
	
	  $(document).ready(function(){

	  	$("#diagnosisGroup span > i >  a").on('click',diagnosisAction);
         
      function diagnosisAction(e)
      {
        e.preventDefault();
        var csrfVal=$('form input[name="csrf_test_name"]').val();
        var did    =$(this).attr('did');
        var pi     =$(this).attr('pi');
        if($(this).attr('action')=='delete'){
      
            $.post('<?php echo site_url("diagnosis/delete")."/";?>'+did,'csrf_test_name='+csrfVal+'&diagnosis_id='+did+'&patient_id='+pi,function(data){
            if(data=='ok'){
              $('#diagnosis'+did).fadeOut();
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