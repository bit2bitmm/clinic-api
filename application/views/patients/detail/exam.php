<div class="tab-pane" id="exam" style="padding-top: 10px;">

  <style type="text/css">
    tbody td{

      font:17px solid ;
    }
    .bp_input{

        width: 65px;
        height: 35px;
    }

    #collapseExam input[type="text"] {

      width: 65px;
      height: 35px;
    }

  </style>

  <script>
    $(document).ready(function(){
      //script of this section
      $('input[id=save]').click(function(){
        
          $.post($('#examBox').attr('action'),$('#examBox').serialize(),
            function(data){
              $('#examGroup').prepend(data);
              $('#exam').val('');
            });
          return false; 
        
      });

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
              var qty = Number($("#examination_count").text())-1;
              $("#examination_count").text(qty);
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

      <?php 

       echo "<div id='examGroup'>";
       $i=1;
  foreach($examination as $exam) {

      $pr = ($exam->pr != 0) ? $exam->pr."  <sub><small>bpm</small></sub>" : '';
      $spo2 = ($exam->spo2 != 0) ? $exam->spo2." <small>%</small>":'';
         $rbs  = ($exam->rbs != 0) ? $exam->rbs." <small>mg/dl</small>":'';
      $weight = ($exam->weight != 0) ? $exam->weight." <sub><small>lbs</small></sub>    |  <span id='kg".$i."'></span>":'';
      $height = ($exam->height != '') ? $exam->height." <sub><small>ft</small></sub>     |  <span id='cm".$i."'></span>":'';
      $bmi = ($exam->bmi != 0) ? $exam->bmi : '';

      echo "<div id='exam".$exam->id."' class='well well-md'>";
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
           ".anchor('#', 'Del ',array('eid'=>$exam->id,'pi'=>$exam->patient_id,'action'=>'delete'))."</i></span></th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      echo "<tr>";
      echo "<td>".$exam->s_bp." /  ".$exam->d_bp." <sub><small>mmHg</small></sub></td>";
      echo "<td>".$pr."</td>";
      echo "<td>".$exam->temp." &#8457;";
      echo "<td>".$spo2."</td>";
      echo "<td>".$rbs."</td>";
      // echo "<td>".$exam->rbs."</td>";
   echo "<td>".$weight."</td>";
    echo "<td>".$height."</td>";
      echo "<td>".$bmi."</td>";
      echo "<td>";
      echo "</tr>";
      echo "</tbody>";
      echo "</table>";

            echo "</div>";
      echo "<div class='pull-right'>Create Date:".$exam->created_date."</div>";
    echo "</div>";
   echo "<input type='hidden' value=".$exam->weight." id='lb".$i."'>"; 
   echo "<input type='hidden' value=".$exam->height." id='ft".$i."'>";
   $i++;
  }
   echo "</div>";
  
       ?>

  </div>
<script type="text/javascript">

$(document).ready(function() {

  var count_table_tbody_tr = $("#exam_table tbody tr").length;

  for(var row_id=1;row_id<=count_table_tbody_tr;row_id++){

    var lb  = $("#lb"+row_id).val();
    var ft  = $("#ft"+row_id).val();


     var kg = parseFloat(lb*0.45).toFixed(1);
     $("#kg"+row_id).html(kg+" <sub><small>kg</small></sub>");

     var cm = parseFloat(ft*30.48).toFixed(0);
     $("#cm"+row_id).html(cm+" <sub><small>cm</small></sub>");

   }


    $("#wconvert").click(function(e) {
        
     $("#weight").val(parseFloat($("#weight").val() / 0.45).toFixed(0));

     e.preventDefault();

     $("#wconvert").attr("disabled",true);

     return true;
         
    });

});
</script>