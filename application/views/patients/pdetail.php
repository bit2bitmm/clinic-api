<style type="text/css">
  
  span a{

    color:#fff;
  }

</style>
<div class="content-wrapper">
	<!-- (Content Heder) -->
	<!-- <section class="content-header">

  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Patients</li>
  </ol>


</section> -->

<!-- Main content -->
<section class="content" style="padding-top: 1px;">
  <!-- Small boxes (Stat box) -->
  <div class="row">
   <div class="panel-group" id="pInfo">
    <div class="panel panel-default">
      <div id="pInfoBody" class="panel-collapse collapse in">
        <div class="panel-body">
          <div class="col col-xs-6">
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

          <span class="badge badge-success">Registered On:  <?php echo $patient_data['created_date'];?></span>
          
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
</div>
<ul class="nav nav-tabs" id="panelTab">
  <li><a href="#complaint" data-toggle="tab">Complaint <?php echo ($complaint_count != 0) ? '<span class="badge badge-light" id="complaint_count">'.$complaint_count.'</span>' : ''; ?></a></li>
  <li><a href="#exam" data-toggle="tab">Examination <?php echo ($examination_count != 0) ? '<span class="badge badge-light" id="examination_count">'.$examination_count.'</span>' : ''; ?></a></li>
  <li><a href="#history" data-toggle="tab">History <?php echo ($history_count != 0) ? '<span class="badge badge-light" id="history_count">'.$history_count.'</span>' : ''; ?></a></li>
  <li><a href="#diagnosis" data-toggle="tab">Diagnosis <?php echo ($diagnosis_count != 0) ? '<span class="badge badge-light" id="diagnosis_count">'.$diagnosis_count.'</span>' : ''; ?></a></li>
  <li><a href="#investigation" data-toggle="tab">Investigation <?php echo ($investigation_count != 0) ? '<span class="badge badge-light" id="investigation_count">'.$investigation_count.'</span>' : ''; ?></a></li>
  <li><a href="#rx" data-toggle="tab"><img src="<?php echo base_url();?>/assets/images/rx_logo.png" width="20px" height="20px"></a></li> 
</ul>

<section class='content'>

 <div class="tab-content">



  <?php
  include_once __DIR__ . '/detail/investigation.php';
  include_once __DIR__ . '/detail/diagnosis.php';
  include_once __DIR__ . '/detail/history.php';
  include_once __DIR__ . '/detail/complaint.php';
  include_once __DIR__ . '/detail/rx.php';   
  include_once __DIR__ . '/detail/exam.php';

  ?>
</div>
</section>
	  <script>

     $(document).ready(function(){

         $('#panelTab a:first').tab('show')
      
        })
			
	  </script>	
</div>
</section>
</div>
