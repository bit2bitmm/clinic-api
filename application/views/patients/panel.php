<style type="text/css">
  
  span a{

    color:#fff;
  }
  input#save{
  
    position: fixed;
    bottom: 25px;
    right: 90px; 
    display: inline;
    z-index: 1;
    width: 60px;
  }

  #historyeditor,#investigationeditor,#editor {
    display: block;
    box-sizing: padding-box;
    overflow: hidden;
    width: 350px;
    font-size: 14px;
    border-radius: 6px;
    box-shadow: 2px 2px 8px rgba(black, .3);
    border: 0;

  }

  .new {

     border: solid #c25b11;

  }

  a#detail {
    padding: 9px 7px;
    text-align: center;
    text-decoration: none;
    letter-spacing: 0px;
    display: inline-block;
    background: #f75757;
    border-radius: 0px;
    color:#000;
    font-style: oblique;
  }

</style>
<div class="content-wrapper">
	<!-- (Content Heder) -->
  	<!-- <section class="content-header">
    <a href="<?php echo base_url();?>patients/" class="btn btn-warning"><i class="fa fa-arrow-left"></i></a>
  </section> -->

<!-- Main content -->
<section class="content" style="padding-top: 1px;border-radius: 0px;">
  <!-- Small boxes (Stat box) --> 
  <div class="row">
   <div class="panel-group" id="pInfo">
    <div class="panel panel-success">
      <div id="pInfoBody" class="panel-collapse collapse in">
        <div class="panel-body">
          <div class="col col-xs-5">
            <table>
              <tr>
                <th>Name</th>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $patient_data['name'];?></td>
                
              </tr>
              <?php

              $year = ($patient_data['year'] != 0) ? $patient_data['year']." yr      ":'';
              $month = ($patient_data['month'] != 0) ? $patient_data['month']." mon   ":'';
              $day  = ($patient_data['day'] != 0) ? $patient_data['day']." d     ":'';
             ?>
              <tr>
                <th>Age</th>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $year.$month.$day?></td>
                
              </tr>
            </table>


          </div>     
          <div class="col col-xs-4">
           <table>
            <tr>
              <th>Gender</th>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($patient_data['gender'] ==1)?'Male':'Female';?></td>
              
            </tr>
            <tr>
              <th>Address</th>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $patient_data['address'];?></td>
              
            </tr>
          </table>
          
        </div>

        <div class="col col-xs-2">
            <?php

            $status = '';

            foreach($pres_patient as $prespat){
                
              $status = ($prespat->highlighted == 1) ? '<span class="label label-info" data-toggle="tooltip" title="Highlighted Medicine" id="ppipanel'.$prespat->pres_patient_id.'">'.$prespat->pres_name.'</span> ' : '';

              echo $status;

            }

             ?>

            <?php

            foreach($med_patient as $medpat){

             $this->model_pharmacy->load($medpat->med_id);
                
              $status = ($medpat->highlighted == 1) ? '<span class="label label-info" data-toggle="tooltip" title="Highlighted Medicine" id="dpipanel'.$medpat->med_patient_id.'">'.$this->model_pharmacy->medicine_name.'</span> ' : '';

              echo $status;

              
            }

            
             ?>

        </div>

        
      </div>  
    </div>
  </div>  
  <div class="col col-xs-1 pull-right">
            <a href="<?php echo base_url()?>patients/detail/<?php echo $patient_data['id']?>" id="detail"><i class="fa fa-history">History</i></a>
  </div>
</div>

<?php
       echo form_open('patients/count/',array('id'=>'visitbox'));

       echo form_hidden('patient_id',$patient_data['id']);

       // echo form_submit('Save','Save','class="btn btn-primary ml-3" id="savehistory"');
       echo form_close();
?>
<input class="btn btn-primary pull-right ml-5" type="button" value="Save" id="save">

<section class='content'>

 <div class="tab-content">

  <?php
  
  include_once __DIR__ . '/panel/complaint.php';
  include_once __DIR__ . '/panel/history.php';
  include_once __DIR__ . '/panel/investigation.php';
  include_once __DIR__ . '/panel/exam.php';
  include_once __DIR__ . '/panel/diagnosis.php';
  include_once __DIR__ . '/panel/rx.php';   
  // include_once __DIR__ . '/panel/invoice.php';
  
  ?>
</div>
</section>
	  <script>

   $(document).ready(function(){

    $('#collapseCom,#collapseHis,#collapseInv,#collapseEx,#collapseDia').trigger('click');

        // $("#addDrug").attr("href", "javascript:void(0);");
        // $("#addPres").attr("href", "javascript:void(0);");

        $("#addDrug").click(function() {

           if(!countVisit.called){

             alert("Save the data first or you will lose it");

           }

        })

        $("#addPres").click(function() {

           if(!countVisit.called){

             alert("Save the data first or you will lose it");

           }

           
        })


    });

   $(function () {
  var $textareas = $('textarea');

  $textareas.on('input', autosize);

  function autosize() {
    var $this = $(this);

    $this
      .css({height: 'auto'})
      .css({height: $this.prop('scrollHeight')});
  }
});
   

        $("#save").on('click',function(){

           var checked =  $("input[name='diagnosis[]']").is(":checked");
            
            if(($("#editor").val()).length == 22 || ($("#editor").val()).length == 0) {
             
             //coming soon
               
            }else{
                saveComplaint();
                $("#editor").val('');
                

            }
          
            if(($("#historyeditor").val()).length == 0){

              //coming soon

            }else{
              saveHistory();
              $("#historyeditor").val('');

              
            }

            if(($("#investigationeditor").val()).length == 0){

              //coming soon
               

            }else{

              saveInvestigation();
              $("#investigationeditor").val('');


            }
              
             if(($("#s_bp").val()).length == 0 || ($("#d_bp").val()).length == 0){
                  
              //coming soon

             }else{

               saveExamination();
               $("input[type=text]").val('');
             }
             
             if(checked != false){

              //coming soon
              
              saveDiagnosis();
              $("input[type=checkbox]").prop('checked',false);

             }else{

             }

             countVisit();

             alert("Data has been saved. Continue to medicine assigning");

             // $("#addDrug").attr("href","<?php echo base_url('pharmacy/search/'.$patient_data['id']);?>");
             // $("#addPres").attr("href","<?php echo base_url('pharmacy/prescription/'.$patient_data['id']);?>");

        })

        function saveComplaint()
        {

          $.post($('#commentBox').attr('action'),$('#commentBox').serialize(),
            function(data){
              $('#commentGroup').prepend(data);
              $('#comment').val('');
            });
          return false;

        }

        function saveHistory()
        {

           $.post($('#historyBox').attr('action'),$('#historyBox').serialize(),
            function(data){
              $('#historyGroup').prepend(data);
              $('#history').val('');
            });
          return false;

        }
        function saveInvestigation()
        {

           $.post($('#investigationBox').attr('action'),$('#investigationBox').serialize(),
            function(data){
              $('#investigationGroup').prepend(data);
              $('#investigation').val('');
            });
          return false;

        }

        function saveExamination()
        {

          $.post($('#examBox').attr('action'),$('#examBox').serialize(),
            function(data){
              $('#examGroup').prepend(data);
              $('#exam').val('');
            });
          return false; 

        }

        function saveDiagnosis()
        {
            $.post($('#diagbox').attr('action'),$('#diagbox').serialize(),
         function(data){

            $('#diagnosisGroup').prepend(data);
            $('#diagnosis').val('');
         });
         return false;
        }

        function countVisit()
        {
          var value;

            $.post($('#visitbox').attr('action'),$('#visitbox').serialize(),
              function(data){

                

              });

            countVisit.called = true;

            
        }
	  </script>	
</div>
</section>
</div>
