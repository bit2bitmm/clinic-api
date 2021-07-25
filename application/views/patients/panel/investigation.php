
<div class="" id="investigation" style="padding-top: 10px;">

	 <script>
    $(document).ready(function(){

      //script of this section
      // $('#saveinvestigation').click(function(){
        
      //     $.post($('#investigationBox').attr('action'),$('#investigationBox').serialize(),
      //       function(data){
      //         $('#investigationGroup').prepend(data);
      //         $('#investigation').val('');
      //       });
      //     return false;
        
      // });

      $("#investigationGroup span > i >  a").on('click',investigationAction);
         
      function investigationAction(e)
      {
        e.preventDefault();
        var csrfVal=$('form input[name="csrf_test_name"]').val();
        var iid    =$(this).attr('iid');
        var pi     =$(this).attr('pi');
        if($(this).attr('action')=='delete'){
      
            $.post('<?php echo site_url("investigations/delete")."/";?>'+iid,'csrf_test_name='+csrfVal+'&investigation_id='+iid+'&patient_id='+pi,function(data){
            if(data=='ok'){
              $('#investigation'+iid).fadeOut();
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
  <a data-toggle="collapse" href="#collapseInves" 
      aria-expanded="false" aria-controls="collapseExample" id="collapseInv">
       
    <i class="fa fa-plus btn btn-primary"> <small class="label label-default">Investigation</small></i>
    <i class="fa fa-minus btn btn-primary"> <small class="label label-default">Investigation</small></i>
    </a>
  </div>
  
	<?php if($patient_data['id'] == TRUE){

   echo "<div class='collapse' id='collapseInves'>";
   echo "<div class='row'>";
   echo "<div class='col-sm-6'>";
     echo form_open('investigations/create/'.$patient_data['id'],array('id'=>'investigationBox'));
	   echo form_hidden('patient_id',$patient_data['id']);
     echo form_textarea(array(
        'name' => 'investigation',
        'id' => 'investigationeditor',
        'class' => 'autoExpand',
        'rows' => '3',
        'data-min-rows' => '3',
        'placeholder' => 'Write your investigation about this patient...',
        'required' => 'required'
    ));
      // echo form_submit('Save','Save','class="btn btn-primary ml-3" id="saveinvestigation"');
      echo form_close();
      echo "<p></p>"; 
      echo "</div>";

  }
  echo "<div class='col-sm-6'>";
  echo "<div id='investigationGroup'>";
  foreach($investigation as $inves) {

      echo "<div id='investigation".$inves->id."' class='well well-md'>"; 
          echo "<div class='investigationBody'><span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('iid'=>$inves->id,'pi'=>$inves->patient_id,'action'=>'delete'))."</i></span>".$inves->investigation.'</div>';
          echo "<div class='pull-right'>".$inves->created_date."</div>";//<span class='close'>&times;</span>
        echo "</div>";
  }
   echo "</div>";
   echo "</div>";
   echo "</div>";
   echo "</div>";
		?>
		</div>

</div>

<script type="text/javascript">

  // $(document)
  //   .one('focus#investigationeditor', 'textarea#investigationeditor', function(){
  //       var savedValue = this.value;
  //       this.value = '';
  //       this.baseScrollHeight = this.scrollHeight;
  //       this.value = savedValue;
  //   })
  //   .on('input#investigationeditor', 'textarea#investigationeditor', function(){
  //       var minRows = this.getAttribute('data-min-rows')|0, rows;
  //       this.rows = minRows;
  //       rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
  //       this.rows = minRows + rows;
  //   });
  
</script>