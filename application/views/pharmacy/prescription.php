  <div class="modal fade bs-modal-lg" id="modalPrescription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Add Prescription</h4>
        </div>
        <div class="modal-body">
         <div class="box">
      <?php echo form_open('pharmacy/assignPres',array("id"=>"addPresForm", "role"=>"form",)); ?> 
      <div class="box-body">
                 <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Medicine</th>
                      <th>Qty</th>
                      <th>Highlight</th>
                      <th><button type="button" id="add_row" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">  
                      <td>1</td>
                       <td>
                         <input type="text" name="product[]" id="product1" onkeyup="getProductData(1)"  class="form-control">
                        </td>
                        <td>
                          <!--  <small>Morning</small>
                           <input type="text" id="mor1" onkeyup="getTotal(1)"  name="morning[]" style="width: 40px;" >
                            <small>Afternoon</small>
                           <input type="text" id="aft1" onkeyup="getTotal(1)"  name="afternoon[]" style="width: 40px;">
                            <small>Evening</small>
                           <input type="text" id="eve1" onkeyup="getTotal(1)"  name="evening[]" style="width: 40px;"> -->
                           <input type="text" name="quantity[]" onkeyup="getTotal(1)" id='qty1' style="width: 50px;">
                           <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
                        </td>
                         <td>
                           <input type="hidden" name="highlight[]" id="high1" value="0" style="width: 50px;">
                           <input type="checkbox" id="check1" onclick="highlight(1)"> 
                         </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="glyphicon glyphicon-remove"></i></button></td>
                     </tr>
                   </tbody>
                </table>
             <div class="box-footer pull-right">
                 <button type="submit" class="btn btn-primary">Assign</button>
              </div>
        </div>  
      <?php form_close();?>
     </div>
        </div>
       
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('#modalPrescription').modal('show');

            $("#add_row").unbind('click').bind('click', function() {

             var count_table_tbody_tr = $("#product_info_table tbody tr").length;

             var row_id = count_table_tbody_tr + 1;

             var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+row_id+'</td>'+
                   '<td>'+ 
                        '<input type="text" name="product[]" id="product1" onkeyup="getProductData('+row_id+')"  class="form-control">'+
                    '</td>'+ 
                    '<td>'+
                         '<input type="text" name="quantity[]" onkeyup="getTotal('+row_id+')"  id="qty'+row_id+'" style="width: 50px;">'+
                   '</td>'+
                    '<td>'+
                         '<input type="hidden" name="highlight[]" id="high'+row_id+'" value="0" style="width: 50px;">'+
                         '<input type="checkbox" id="check'+row_id+'" onclick="highlight('+row_id+')">'+
                    '</td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="glyphicon glyphicon-remove"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }
            });

            return false;

    });

          function removeRow(tr_id)
             {
             $("#product_info_table tbody tr#row_"+tr_id).remove();
              // subAmount();
            } 


          function getProductData(row_id)
          {

           // $("#mor"+row_id).val(1);
           // $("#aft"+row_id).val(1);
           // $("#eve"+row_id).val(1);

           // var totalqty = Number($("#mor"+row_id).val())+Number($("#aft"+row_id).val())+Number($("#eve"+row_id).val())

           $("#qty"+row_id).val(1);

          }

          function getTotal(row = null) {

         if(row) {
         // var totalqty = Number($("#mor"+row).val()) + Number($("#aft"+row).val()) + Number($("#eve"+row).val())
    
         $("#qty"+row).val();

         } else {
         alert('no row !! please refresh the page');
         }

       }

         function highlight(row = null)
         {

           if($('#check'+row).is(':checked'))
          { 
                $("#high"+row).val('1');  
          }

         if($('#check'+row).is(':not(:checked)'))
         { 
            $("#high"+row).val('0');
         }
        }
  </script>
