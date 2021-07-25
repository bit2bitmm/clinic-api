<style type="text/css">

ul.checkbox li input{ 
  margin-right: .25em; 
  line-height: 1.5em;
} 

ul.checkbox li { 
  border: 1px transparent solid; 
  display:inline-block;
  width:12em;
  padding:10px;
} 

ul.checkbox li label { 
  margin-left:_; 
} 

#diag {
    width: 250px;
    height: 27px;
    padding-right: 50px;
    border-radius: 5px;
}

#newdiag {
    margin-left: -50px;
    height: 27px;
    width: 50px;
    background: blue;
    color: white;
    border: 0;
    -webkit-appearance: none;
    border-radius: 5px;
}
</style>
<div class="tab-pane" id="diagnosis" style="padding-top: 10px;">

	 <script>
    $(document).ready(function(){
      //script of this section
      $('#newdiag').click(function(){
      	
          $.post($('#diagboxlist').attr('action'),$('#diagboxlist').serialize(),
            function(data){

            	$("#diag").val('');
            	$("#diag").trigger("keyup");

            	$('#myUL').append(data);

            });
          return false;
        
      });


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
              var qty = Number($("#diagnosis_count").text())-1;
              $("#diagnosis_count").text(qty);
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
<!-- Default checked -->

<?php 

    echo "<div id='diagnosisGroup'>";
  foreach($diagnosis_patient as $diag_pat) {

      echo "<div id='diagnosis".$diag_pat->id."' class='well well-md'>"; 
          echo "<div class='diagBody'><span class='badge badge-warning pull-right'><i class='fa fa-trash'>
           ".anchor('#', 'Del ',array('did'=>$diag_pat->id,'pi'=>$diag_pat->patient_id,'action'=>'delete'))."</i></span>".$diag_pat->diagnosis.'</div>';
          echo "<div class='pull-right'>".$diag_pat->created_date."</div>";//<span class='close'>&times;</span>
        echo "</div>";
  }
   echo "</div>";

?>

</div>

<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("diag");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("label")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>