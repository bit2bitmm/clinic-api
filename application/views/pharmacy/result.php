<?php
if($drugs)
{
  echo "<div class='table-responsive'><table class='table table-bordered table-striped'><thead><tr>
           <th>ID</th>
           <th>Name</th>
           <th>Expiry Date</th>
           <th>Available Quantity</th>
           <th>Price</th>
           <th>QTY</th>
           <th></th>
       </tr></thead><tbody>";
  foreach($drugs as $_drug)
  {
    $actions=anchor('#','Assign');
    echo '<tr id="'.$_drug->id.'" title="'.$_drug->description.'">'.
      '<td>'.html_escape($_drug->id).'</td>'.
      '<td>'.html_escape($_drug->medicine_name).'</td>'.
      '<td>'.html_escape($_drug->expire_date).'</td>'.
      '<td>'.html_escape($_drug->remain_quantity).'</td>'.
      '<input type="hidden" id="remain_quantity" value="'.html_escape($_drug->remain_quantity).'">'.
      '<td>'.html_escape($_drug->selling_price).'</td>'.
      '<td><input type="number" name="no_of_item" value="1"/></td>'.
      '<td class="hidden-print">'.$actions.'</td>'.
    '</tr>';
  }

  ?>
  </tbody></table>
  <script>
    $(document).ready(function(){
      $('#drugResult a').on('click',function(e){
        e.preventDefault();
        var tr = $(this).parent().parent();
        var noItem = parseInt($("input[name='no_of_item']").val());
        var reQty  = parseInt($("#remain_quantity").val());
        $('#drug_id').val(tr.find('td:first').text());
        $('#no_of_item').val(tr.find('input[name="no_of_item"]').val());
        $('#total_cost').val(tr.find('td:nth(4)').text()*tr.find('input[name="no_of_item"]').val());

        if(noItem > reQty){
          
          alert("Not Available in Stock");
        }else{
        
        $.post($('#addDrugForm').attr('action'),$('#addDrugForm').serialize(),function(data){
          if(data!=''){
            var trWithId = $('#drugGroup tbody tr>td[class="id"]').parent();
            if(trWithId.last().html()){
                $('#drugGroup tbody tr>td[class="id"]:last').parent().after(data);
                var data=$('#drugGroup tbody tr>td[class="id"]:last').parent(); 
                data.find('td:first').html((trWithId.last().find('td:first').text()*1)+1);                
            }else{
                $('#drugGroup tbody').html(data);
                var data=$('#drugGroup tbody tr>td[class="id"]:last').parent();
                data.find('td:first').html(1);
                
            }
            $('#drugGroup tr > td> a').on('click',drugItemsAction);

          }
        });
      };
      });  
    });
  </script>
  </div><?php
}else{
  echo '<div class="alert alert-danger text-center"><h1>Medicine Not Found</h1></div>';
}
?>