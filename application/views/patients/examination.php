<?php
//if(@$complaints){
  //foreach ($complaints as $complaint) {
      $pr = ($examination->pr != 0) ? $examination->pr."  <sub><small>bpm</small></sub>" : '';
      $spo2 = ($examination->spo2 != 0) ? $examination->spo2." <small>%</small>":'';
      $rbs  = ($examination->rbs != 0) ? $examination->rbs." <small>mg/dl</small>":'';
      $weight = ($examination->weight != 0) ? $examination->weight." <sub><small>lbs</small></sub>    |  <span id='kg'></span>":'';
      $height = ($examination->height != '') ? $examination->height." <sub><small>ft</small></sub>     |  <span id='cm'></span>":'';
      $bmi = ($examination->bmi != 0) ? $examination->bmi : '';

      echo "<div id='exam".$examination->id."' class='new well well-md'>";
      echo "<div class='examBody'>";
      echo "<table class='table table-striped' id='exam_table'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th>BP</th>";
      echo "<th>PR</th>";
      echo "<th>Temp</th>";
      echo "<th>SPO<sub>2</sub></th>";
      echo "<th>RBS</th>";
      echo "<th>Body.Wt</th>";
      echo "<th>Body.Ht</th>";
      echo "<th>BMI</th>";
      echo "<th><span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('eid'=>$examination->id,'pi'=>$examination->patient_id,'action'=>'delete'))."</i></span></th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      echo "<tr>";
      echo "<td>".$examination->s_bp." /  ".$examination->d_bp." <sub><small>mmHg</small></sub></td>";
      echo "<td>".$pr."</td>";
      echo "<td>".$examination->temp." &#8457;";
      echo "<td>".$spo2."</td>";
      echo "<td>".$rbs."</td>";
   echo "<td>".$weight."</td>";
    echo "<td>".$height."</td>";
      echo "<td>".$bmi."</td>";
      echo "</tr>";
      echo "</tbody>";
      echo "</table>";

            echo "</div>";
      echo "<div class='pull-right'>".$examination->created_date."</div>";
    echo "</div>";
   echo "<input type='hidden' value=".$examination->weight." id='lb'>"; 
   echo "<input type='hidden' value=".$examination->height." id='ft'>";
  //}
//}
?>
<script type="text/javascript">
  $(document).ready(function(){

      $("#examGroup span >i >a").on('click',examinationAction);
         
      function examinationAction(e)
      {
        e.preventDefault();
        var csrfVal=$('form input[name="csrf_test_name"]').val();
        var eid    =$(this).attr('eid');
        var pi     =$(this).attr('pi');
        if($(this).attr('action')=='delete'){
      
            $.post('<?php echo site_url("examinations/delete")."/";?>'+eid,'csrf_test_name='+csrfVal+'&examination_id='+eid+'&patient_id='+pi,function(data){
            if(data=='ok'){
              $('#exam'+eid).fadeOut();
            }else if(data=='mismatch'){
              alert('Delete data mismatch');
            }else if(data=='invalid'){
              alert('Invalid data');
            }
          });
        }
      }
    
    var lb  = $("#lb").val();
    var ft  = $("#ft").val();

     // var faren = parseFloat((cel*1.8)+32).toFixed(0); 
     // $("#feren").html(faren+" &#8457;");

     var kg = parseFloat(lb*0.45).toFixed(1);
     $("#kg").html(kg+" <sub><small>kg</small></sub>");

     var cm = parseFloat(ft*30.48).toFixed(0);
     $("#cm").html(cm+" <sub><small>cm</small></sub>");

  });

</script>