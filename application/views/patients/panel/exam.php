<div class="" id="exam" style="padding-top: 10px;">

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
    });
  </script>
  <div>
  <a data-toggle="collapse" href="#collapseExam" 
      aria-expanded="false" aria-controls="collapseExample" id="collapseEx">
       
        <i class="fa fa-plus btn btn-primary"> <small class="label label-default">Examination</small></i>
        <i class="fa fa-minus btn btn-primary"> <small class="label label-default">Examination</small></i>
    </a>
  </div><br>
  <div class="collapse" id="collapseExam">
       <div class="row">

		<?php if($patient_data['id'] == TRUE){

			echo form_open('examinations/create/'.$patient_data['id'],array('id'=>'examBox'));
			echo form_hidden('patient_id',$patient_data['id']);
	     ?>
	     	<div class="col-xs-2">
	     		<label>BP:</label><br>
	     		<?php echo form_input('s_bp','','class="bp_input" id="s_bp" placeholder="Sys.Bp" autofocus');?>/
	     		<?php echo form_input('d_bp','','class="bp_input" id="d_bp" placeholder="Dia. Bp"');?><br><br>
	     		  	</div>
	     	<div class="col-xs-1">
	     	   <label>PR:</label>
	     	   <?php echo form_input('pr','','class="form-control" id="pr" placeholder="PR"')?>
	        </div>	
	        <div class="col-xs-2">
	     	   <label>TEMP (&#8457;):</label>
	     	   <?php echo form_input('temp','98','class="form-control" id="temp" placeholder="Temperature"')?><br>
	        </div>
	        <div class="col-xs-1">
	     	   <label>SPO<sub>2</sub>:</label>
	     	   <?php echo form_input('spo2','','class="form-control" id="spo2" placeholder=""')?>
	        </div>	
          <div class="col-xs-1">
            <label>RBS:</label>
            <?php echo form_input('rbs','','class="form-control" id="rbs" placeholder=""')?>
          </div>
	         <div class="col-xs-2">
	     	   <label>WEIGHT (lbs):</label>
	     	   <?php echo form_input('weight','','class="form-control" id="weight" placeholder="lbs"')?><br>
	     	  
	     	   <input type="button" name="" class="btn btn-warning btn-sm" id="wconvert" value="Convert">  <small>(from kg)</small>
	        </div>
	         <div class="col-xs-2">
	     	   <label>HEIGHT (ft):</label>
	     	   <?php echo form_input('height','','class="form-control" id="height" placeholder="ft"')?><br>
	   	   <input type="button" name="" class="btn btn-warning btn-sm" id="hconvert" value="Convert">  <small>(from cm)</small>
	        </div>
          <div class="col-xs-1">
              <label>BMI:</label>
           <?php echo form_input('bmi','','class="form-control" id="bmi" placeholder="BMI"')?><input type="button" name="" class="btn btn-default btn-sm" id="calbmi" value="Calculate">
     
          </div>
	    </div><br>
      <?php  echo form_close(); } ?>


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
      echo "<div class='pull-right'>".$exam->created_date."</div>";
      echo "</div>";
      echo "<input type='hidden' value=".$exam->weight." id='lb".$i."'>"; 
      echo "<input type='hidden' value=".$exam->height." id='ft".$i."'>";
      $i++;
  }
   echo "</div>";
  
	     ?>

  </div>
</div>
<script type="text/javascript">

$(document).ready(function() {

  var count_table_tbody_tr = $("#exam_table tbody tr").length;

  for(var row_id=1;row_id<=count_table_tbody_tr;row_id++){

    var lb  = $("#lb"+row_id).val();
    var ft  = $("#ft"+row_id).val();

     // var faren = parseFloat((cel*1.8)+32).toFixed(0); 
     // $("#feren"+row_id).html(faren+" &#8457;");

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

    // $("#tconvert").click(function() {

    //  var temp = $("#temp").val();

    //  $("#temp").val(parseFloat((temp-32) * 5/9).toFixed(0));
    // })

    $("#hconvert").click(function(e){

      var n = $("#height").val();
      var realFeet = ((n*0.393700) / 12);
      var feet = Math.floor(realFeet);
      var inches = Math.round((realFeet - feet) * 12);
     $("#height").val(feet+'.'+inches);

     e.preventDefault();

     $("#hconvert").attr("disabled",true);

     return true;

  });


    var height = document.querySelector("#height");
    var weight = document.querySelector("#weight");
    var submit = document.querySelector("#calbmi");
    var bmi    = document.querySelector("#bmi");

    submit.addEventListener("click",function(){

        runit();

    });


   function runit()
   {

      var ht = Number(height.value);
      var wt = Number(weight.value);

      var actht = ht * 12;

      bmi.textContent = Math.round(wt / actht / actht * 703 * 10) / 10;
      $("#bmi").val(bmi.textContent);

   }

});

</script>