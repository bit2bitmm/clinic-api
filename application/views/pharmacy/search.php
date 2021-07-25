<div class="modal fade bs-modal-lg" id="modalDrugSearch"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Search Medicines</h4>
        </div>
          <div class="modal-body">
            <div class="row">
    
            <div class="box">
              <?php echo form_open('pharmacy/assign',array("id"=>"addDrugForm", "role"=>"form",)); ?> 
              <div class="box-body">
                 <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Medicine</th>
					            <th>A.Type</th>
                      <th>A.Qty</th>
                      <th>Qty</th>
                      <th>Expire Date</th>
                      <th>Highlight</th>
                      <th><button type="button" id="add_row" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">  
                      <td>1</td>
                       <td>
                        <select class="product" data-row-id="row_1" id="product_1" name="product[]" style="width:200px;"onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($product_list as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['medicine_name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                    <td>
                      <select class="type" id="Atype1" name= "type[]" style="height: 30px;" onchange="typeChanged(1)" data-toggle="tooltip" title="Choose the medicine type options to assign"> 
                      </select>
                    </td>
                       <td><input type="text" name="remain_qty[]" id="remain_qty1" readonly class="form-control"  style="width: 70px;"></td>
                        <td>
                          <!--  <small>Morning</small>
                           <input type="hidden" id="mor1" onkeyup="getTotal(1)"  name="morning[]" style="width: 40px;" >
                            <small>Afternoon</small>
                           <input type="hidden" id="aft1" onkeyup="getTotal(1)"  name="afternoon[]" style="width: 40px;">
                            <small>Evening</small>
                           <input type="hidden" id="eve1" onkeyup="getTotal(1)"  name="evening[]" style="width: 40px;"> -->
                           <input type="text" name="quantity[]" id='qty1' onkeyup = "getTotal(1)" style="width: 50px;">
                        </td>
                        <td>
                             <label id="expire1"></label>
                             <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
                        </td>
                         <td>    
                          <input type="hidden" name="price[]" id='price1' style="width: 50px;">
                          <input type="hidden" name="remianqty[]" id='remianqty1' style="width:50px;">
                          <input type="hidden" name="tabqty[]" id='tabqty1' style="width:50px;">
                          <input type="hidden" name="remaintabqty[]" id='remaintabqty1' style="width:50px;">
                          <input type="hidden" name="sellingprice[]" id='sellingprice1' style="width:50px;">
                          <input type="hidden" name="tabprice[]" id='tabprice1' style="width:50px;">
                          <input type="hidden" name="totalamt[]" id='totamt1' style="width:50px;">
      
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
      </div>
        </div>

  <script type="text/javascript">

    var base_url = "<?php echo base_url()?>";

    $(document).ready(function(){
     
      $(".product").select2();
      $('#modalDrugSearch').modal('show');

      $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      if(count_table_tbody_tr > 7){

          alert('Maximum rows 8');

      }else{

      var row_id = count_table_tbody_tr + 1;
      $.ajax({
          url:  base_url + 'pharmacy/getTableMedRow',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+row_id+'</td>'+
                   '<td>'+ 
                    '<select class="product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:200px;" onchange="getProductData('+row_id+')" required>'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.medicine_name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
					'<td>'+
						  ' <select class="type" id="Atype'+row_id+'" name= "type[]" style="height: 30px;" onchange="typeChanged('+row_id+')"> '+
						 
			  		'</select>'+
			  		'</td>'+
                   '<td><input type="text" name="remain_qty[]" id="remain_qty'+row_id+'" class="form-control" style="width: 70px;" required readonly></td>'+
                   '<td>'+
                         '<input type="text" name="quantity[]"  onkeyup="getTotal('+row_id+')" id="qty'+row_id+'" style="width: 50px;">'+
                   '</td>'+
                   '<td>'+
                         '<label id="expire'+row_id+'"><label>'+
                   '</td>'+
                    '<td>'+
                      '<input type="hidden" name="price[]" id="price'+row_id+'" style="width: 50px;">'+
					  '<input type="hidden" name="remianqty[]" id="remianqty'+row_id+'" style="width:50px;">'+
					  '<input type="hidden" name="tabqty[]" id="tabqty'+row_id+'" style="width:50px;">'+
					  '<input type="hidden" name="remaintabqty[]" id="remaintabqty'+row_id+'" style="width:50px;">'+	  
					  '<input type="hidden" name="sellingprice[]" id="sellingprice'+row_id+'" style="width:50px;">'+
					  '<input type="hidden" name="tabprice[]" id="tabprice'+row_id+'" style="width:50px;">'+  
                     '<input type="hidden" name="totalamt[]" id="totamt'+row_id+'" style="width:50px;">'+
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

              $(".product").select2();

          }
        });
      return false;

    }

       }); 
    });


      // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();   
    if(product_id == "") {
       
        alert('Sorry Error');

    } else {
      $.ajax({
        url: base_url + 'pharmacy/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
			
          // setting the rate value into the rate input field
        
			
			
			$("#sellingprice"+row_id).val(response.selling_price);
			$("#tabprice"+row_id).val(response.tab_price);
			
          $("#expire"+row_id).text(response.expire_date);
			$("#Atype"+row_id).empty();
			if(response.tab_quantity > 0){
				$("#price"+row_id).val(response.tab_price);
				$("#Atype"+row_id).append('<option value = "Tabs">Tabs</option><option value = "'+response.sell_type+'"> '+response.sell_type　+ ' </option>');
				$("#remain_qty"+row_id).val(response.remain_tab_quantity);
			}
			else{
				$("#price"+row_id).val(response.selling_price);
				$("#remain_qty"+row_id).val(response.remain_quantity);
				$("#Atype"+row_id).append('<option value = "'+response.sell_type+'"> '+response.sell_type　+ ' </option>');
			}
			
			$("#remianqty"+row_id).val(response.remain_quantity);
			$("#tabqty"+row_id).val(response.tab_quantity); 
			$("#remaintabqty"+row_id).val(response.remain_tab_quantity);

			
           $("#mor"+row_id).val(1);
           $("#aft"+row_id).val(1);
           $("#eve"+row_id).val(1);

           // var totalqty = Number($("#mor"+row_id).val())+Number($("#aft"+row_id).val())+Number($("#eve"+row_id).val())

           $("#qty"+row_id).val(1);

           var totalamt = Number($("#qty"+row_id).val()) * Number($("#price"+row_id).val());

           $("#totamt"+row_id).val(totalamt);


          // var tax = (Number(response.product_selling_price) /100) * $("#tax_"+row_id).val();
          // var total = Number(response.product_selling_price) * 1;
          // total = total+tax;
          // total = total.toFixed(2);
          // $("#amount_"+row_id).val(total);
          // $("#amount_value_"+row_id).val(total);
          
          // subAmount();  
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

	  
	  function typeChanged(row_no)
	  {
		  var selected = document.getElementById("Atype"+row_no).value;
		  var remainqty = document.getElementById("remianqty"+row_no).value;
		  var tabquantity = document.getElementById("tabqty"+row_no).value;
		  var remaintabquantity = document.getElementById("remaintabqty"+row_no).value;
		  var sellingprice = document.getElementById("sellingprice"+row_no).value;
		  var tabprice = document.getElementById("tabprice"+row_no).value;
		  if(selected == "Tabs"){
			  $("#price"+row_no).val(tabprice);
			  $("#remain_qty"+row_no).val(remaintabquantity);
		
		  }
		  else{
			  $("#price"+row_no).val(sellingprice);
			  $("#remain_qty"+row_no).val(remainqty); 
		  }
		  getTotal(row_no);
	  }
   function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    // subAmount();
  }

   function getTotal(row = null) {
    if(row) {
  // var totalqty = Number($("#mor"+row).val()) + Number($("#aft"+row).val()) + Number($("#eve"+row).val())
    
      $("#qty"+row).val();

      var totalamt = Number($("#qty"+row).val()) * Number($("#price"+row).val());
      $("#totamt"+row).val(totalamt);
      
      // subAmount();

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