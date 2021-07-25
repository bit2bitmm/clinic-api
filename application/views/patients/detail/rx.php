<div class="tab-pane" id="rx" style="padding-top: 10px;">
    <script>
    $(document).ready(function(){
      //script of assign drug click
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
        var tc=$(this).attr('tc')*1;
      if($(this).attr('action')=='delete'){
          $.post('<?php echo site_url("pharmacy/deletedpi")."/";?>'+dpi,'csrf_test_name='+csrfVal+'&drug_patient_id='+dpi+'&drug_id='+di+'&quantity='+qu+'&patient_id='+pi,function(response){
            var data = $.trim(response);
            if(data=='ok'){
              $('#dpidetail'+dpi).fadeOut();
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
              $('#ppidetail'+ppi).fadeOut();
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


     echo '<tr id="dpidetail'.$pat->med_patient_id.'"><td class="id">'.++$i.'</td>'.
            '<td>'.$status.''.$this->model_pharmacy->medicine_name.'</td>'.
            '<td>'.$this->model_pharmacy->expire_date.'</td>'.
            '<td>'.$this->model_pharmacy->selling_price.'</td>'.
            '<td><span class="label label-info">'.$pat->quantity.'</td>'.
            '<td>'.$pat->total_cost.'</td>'.
            '<td>'.date('d/m/Y',$pat->assign_date).'</td>';
             echo '<td class="actions">'.anchor('#', 'Delete ',array('dpi'=>$pat->med_patient_id,'di'=>$pat->med_id,'qu'=>$pat->quantity,'pi'=>$pat->patient_id,'action'=>'delete',/*'onclick'=>'drugItemsAction',*/'tc'=>$pat->total_cost)).'</td>';
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

     echo '<tr id="ppidetail'.$pat->pres_patient_id.'"><td class="id">'.++$i.'</td>'.
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
