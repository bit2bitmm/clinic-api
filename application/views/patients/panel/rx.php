<div class="" id="rx" style="padding-top: 10px;">
    <script>
    $(document).ready(function(){
      //script of assign drug click
      $('#addDrug').click(function(){
        $.ajax($('#addDrug').attr('href')).done(function(data){
          $('#tmpDiv').html(data);
        });
        return false;
      });

      $('#addPres').click(function(){
         $.ajax($('#addPres').attr('href')).done(function(data){
             $('#tmpDiv').html(data);
         });
         return false;
      });
      //script of payment click
      $('#drugGroup tr > td> a').on('click',drugItemsAction);
      $('#presGroup tr > td> a').on('click',presItemsAction);
    });
  </script>
  <script>
    function drugItemsAction(e){
        e.preventDefault();
        var csrfVal=$('form input[name="csrf_test_name"]').val();
        var dpi=$(this).attr('dpi');
        var di=$(this).attr('di');
        var pi=$(this).attr('pi');
        var qu=$(this).attr('qu');
		var tp = $(this).attr('tp');
        var tc=$(this).attr('tc')*1;
      if($(this).attr('action')=='delete'){
		  $.post('<?php echo site_url("pharmacy/deletedpi")."/";?>'+dpi,'csrf_test_name='+csrfVal+'&drug_patient_id='+dpi+'&drug_id='+di+'&quantity='+qu+'&type='+tp+'&patient_id='+pi,function(response){
            var data = $.trim(response);
            if(data=='ok'){
              $('#dpi'+dpi).fadeOut();
              $('#dpipanel'+dpi).fadeOut();
            }else if(data=='mismatch'){
              alert('Delete data mismatch');
            }else if(data=='invalid'){
              alert('Invalid data');
            }
          });
        }
      }

      function presItemsAction(e){
        e.preventDefault();
        var csrfVal=$('form input[name="csrf_test_name"]').val();
        var ppi=$(this).attr('ppi');
        var pn=$(this).attr('pn');
        var pi=$(this).attr('pi');
        var qu=$(this).attr('qu');
      if($(this).attr('action')=='delete'){
          $.post('<?php echo site_url("pharmacy/deleteppi")."/";?>'+ppi,'csrf_test_name='+csrfVal+'&pres_patient_id='+ppi+'&pres_name='+pn+'&quantity='+qu+'&patient_id='+pi,function(response){
            var data = $.trim(response);
            if(data=='ok'){
              $('#ppi'+ppi).fadeOut();
              $('#ppipanel'+ppi).fadeOut();
            }else if(data=='mismatch'){
              alert('Delete data mismatch');
            }else if(data=='invalid'){
              alert('Invalid data');
            }
          });
        }
      }
  </script>

 <?php 
    
    if(in_array('createPatient', $user_permission)){

     echo anchor('pharmacy/search/'.$patient_data['id'],'<i class="fa fa-medkit"></i> Assign Medicines',array('id'=>'addDrug','class'=>'btn btn-success','data-toggle="tooltip" title="Assign medicines from pharmacy "'))." ";
     echo anchor('pharmacy/prescription/'.$patient_data['id'],'<i class="fa fa-pencil"></i> Prescription',array('id'=>'addPres','class'=>'btn btn-info'))." "; 
     echo "<div class='hidden'>".form_open('pharmacy/assign',array('id'=>'addDrugForm'));
     echo form_input('patient_id',$patient_data['id'],'id="patient_id"');
     echo form_input('med_id','','id="drug_id"'); 
     echo form_input('quantity','','id="no_of_item"');
     echo form_input('total_cost','','id="total_cost"');
     echo form_close().'</div>';

    }

?>
  <div id='drugError'></div>
	<div id='drugGroup' class="responsive-table">
    <?php if($med_patient){ ?>
    <table class="table table-bordered table-striped">
    <thead>
      <tr>
          <th>#</th>
          <th>Name</th>
          <th>Expiry date</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Total Cost</th>
          <th>Date</th> 
          <th></th>
      </tr>
    </thead>
    <tbody>
   
   <?php
  
    $i=0;
   foreach($med_patient as $pat){
   
     $this->model_pharmacy->load($pat->med_id);

    $status = ($pat->highlighted == 1) ? '<span class="fa fa-star" style="color:orange;"></span>' : '';
	   $type = $pat->type;
	   $price = 0;
	   if($type == "Tabs" && $this->model_pharmacy->tab_quantity > 0){
		   $price = $this->model_pharmacy->tab_price;
	   }
	  else{
		  $price = $this->model_pharmacy->selling_price;
	  }
	   
     echo '<tr id="dpi'.$pat->med_patient_id.'"><td class="id">'.++$i.'</td>'.
            '<td>'.$status.''.$this->model_pharmacy->medicine_name.'</td>'.
            '<td>'.$this->model_pharmacy->expire_date.'</td>'.
		 '<td>'.$price.'</td>'.
		 '<td><span class="label label-info">'.$pat->quantity.'</span> '.$pat->type.'</td>'.
            '<td>'.$pat->total_cost.'</td>'.
            '<td>'.date('d/m/Y',$pat->assign_date).'</td>';
	   echo '<td class="actions">'.anchor('#', 'Delete ',array('dpi'=>$pat->med_patient_id,'di'=>$pat->med_id,'qu'=>$pat->quantity,'tp' =>$pat->type  ,
															   'pi'=>$pat->patient_id,'action'=>'delete',/*'onclick'=>'drugItemsAction',*/'tc'=>$pat->total_cost)).'</td>';
    echo '</tr>';  
   }
  }
    ?>
   </tbody>
  </table>
 </div>

 <div id='presGroup' class="responsive-table"> 
 <?php if($pres_patient){ ?>
    <table class="table table-bordered table-striped">
    <thead>
      <tr>
          <th>#</th>
          <th>Name</th>
          <th>Qty</th>
          <th>Date</th> 
          <th></th>
      </tr>
    </thead>
    <tbody>
       <?php
    $i=0;
   foreach($pres_patient as $pat){
   
    $status = ($pat->highlighted == 1) ? '<span class="fa fa-star" style="color:orange;"></span>' : '';

     echo '<tr id="ppi'.$pat->pres_patient_id.'"><td class="id">'.++$i.'</td>'.
            '<td>'.$status.''.$pat->pres_name.'</td>'.
            '<td><span class="label label-info">'.$pat->quantity.'</span></td>'.
            '<td>'.date('d/m/Y',$pat->assign_date).'</td>';
             echo '<td class="actions">'.anchor('#', 'Delete ',array('ppi'=>$pat->pres_patient_id,'pn'=>$pat->pres_name,'qu'=>$pat->quantity,'pi'=>$pat->patient_id,'action'=>'delete')).'</td>';
    echo '</tr>';  
   }
  }
    ?>
    </tbody>
  </table>

  <?php if(!$med_patient && !$pres_patient){ ?>
    <br>
    <div class="badge badge-warning">
      <h4> No medicines have been assigned yet ....</h4>
    </div>

  <?php }?>
</div>
</div>
