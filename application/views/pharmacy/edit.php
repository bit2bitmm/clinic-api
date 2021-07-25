<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('/');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo base_url('/pharmacy');?>">Pharmacy</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <section class="content">
    <div class="container">
      
     <div class="row">
  <div class="col col-md-8 well well-sm">
      <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismisss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
    <?php echo form_open('pharmacy/update/'.$product->id,array("id"=>"addDrugForm", "role"=>"form",)); ?>
    <fieldset>
      <legend>- Product Info </legend>
      <div>
        <?php echo ( !empty($error) ? $error : '' ); ?>
       

        <div class="form-group">
          <div class="col-md-6">
          <label>Medicine Name</label>
            <input type="text" name='medicine_name' id='medicine_name' value="<?php echo set_value('medicine_name',$product->medicine_name)?>" class='form-control'  title='' required/> 
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2">
          <label>Quantity</label>
            <input type="number" name='quantity' id='quantity' value="<?php echo set_value('quantity' , $product->quantity);?>" class='form-control'  title='quantity' readonly/>
            <input type="hidden"  id='hidquantity' value="<?php echo set_value('quantity' , $product->quantity);?>" class='form-control'  title='quantity' readonly/>
          </div>
          <div class="col-md-2">
          <label>Load/Unload</label>
          <input type="text" id="addedqty" class="form-control">
          
        </div>
          <div class="col-md-6">
          <label>Type</label>
           <?php echo form_dropdown('sell_type',$unit,set_value('sell_type',$product->sell_type)," class='form-control' title='Unit' required");?>        
          </div>
        </div>


        <div class="form-group">
      <div class="col-md-6">
        <label>Used Quantity</label>
        <input type="number" name='used_quantity' id='used_quantity' value="<?php echo set_value('used_quantity' , $product->used_quantity);?>" class='form-control' placeholder='Used Quantity' title='' required readonly/>
      </div>
    </div>
        <div class="form-group">
          <div class="col-md-6">
            <label>Tabs per Type Quantity</label>
            <input type="number" name='tab_quantity' id='tab_quantity' value="<?php echo set_value('tab_quantity',$product->tab_quantity);?>" class='form-control'  autocomplete="off" title='' readonly/>
          </div>
          <div class="col-md-3">
        <label>Remain Quantity</label>
        <input type="number" name='remain_quantity' id='remain_quantity' value="<?php echo set_value('remain_quantity', $product->remain_quantity);?>" class='form-control' placeholder='Remain Quantity' title='' required readonly/>
        <label><?php echo set_value('sell_type', $product->sell_type);?></label>
      </div>
      <?php if($product->tab_quantity!= 0){ ?>
    <div class="col-md-3">
      <label>&nbsp;</label>
      <input type="number" id='remain_tabs' value="<?php echo set_value('remain_tabs', $product->remain_tab_quantity%$product->tab_quantity);?>" class='form-control' placeholder='Remain Quantity' title='' required readonly/>
      <input type="hidden" name= 'remain_tab_quantity' id= 'remain_tab_quantity'  value="<?php echo set_value('remain_tab_quantity', $product->remain_tab_quantity);?>" >
      <input type="hidden"  id= 'r_tab_quantity'  value="<?php echo set_value('r_tab_quantity', $product->remain_tab_quantity);?>" >
      <input type="hidden" name= 'tab_quantity' id= 'tab_quantity'  value="<?php echo set_value('tab_quantity', $product->tab_quantity);?>" >
      <label>Tabs</label>
    </div>
         <?php } ?>
                      <div class="col-md-6">
            <label>Registered Date</label>
            <input type="date" name='register_date' id='register_date' value="<?php echo set_value('register_date',$product->register_date);?>" class='form-control'  autocomplete="off" title='Registered Date' />
          </div>
          <div class="col-md-6">
          <label>Expire Date</label>
            <input type="date" name='expire_date' id='expire_date' value="<?php echo set_value('expire_date',$product->expire_date);?>" class='form-control'  title='Expire Date' autocomplete="off" required/> 
          </div>
        </div>
      </div>


        </fieldset>

      <div class=clearfix></div>

      <fieldset>
        <legend>- Price Info </legend>
        <div class="form-group">
          <div class="col-md-6">
          <label>Actual Price</label>
            <input type="number" name="actual_price" id='actual_price' value="<?php echo set_value('actual_price', $product->actual_price);?>" class="form-control"  title = 'Actual Price'  required/>
          </div>
          <div class="col-md-6">
           <label>Selling Price</label>
            <input type="number" name="selling_price" id='selling_price' value="<?php echo set_value('selling_price',  $product->selling_price);?>" class="form-control"  title = 'Selling Price'  required/>
          </div>
          <div class="col-md-6">
            <label>Profit</label>
            <input type="text" name="profit_price" id='profit_price' value="<?php echo set_value('profit_price',  $product->profit_price);?>" class="form-control"  title='Profit' readonly required/>
          </div>
          <div class="col-sm-6">
           <label>Status</label>
            <select type="text" class="form-control" id="status" name="status" required>

              <?php

                       if($product->status == 1)
                       {
                         echo '
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>';
                       }else{

                         echo '
                        <option value="1">Active</option>
                        <option value="0" selected>Inactive</option>';
                       }
              ?>

            </select>
          </div>
            <div class="col-md-12">
            <label>Price per tab</label>
            <input type="number" name="tab_price" id="tab_price" value="<?php echo set_value('tab_price',  $product->tab_price);?>" class="form-control" readonly>
          </div>
       </div>
      </fieldset>
      <div class=clearfix></div>

      <fieldset>
        <legend>- Description </legend>

        <div>
          <div class="form-group">
            <div class="col-md-12"><textarea name="description" id="description" class="form-control" placeholder="Description" rows="6"><?php echo $this->input->post('description');?><?php echo set_value('description', $product->description);?></textarea>
              <input type="hidden" name="is_deleted" value="0">
              <input type="datetime-local" name="created_date" id="created_date" hidden>
              <input type="datetime-local" name="modified_date" id="modified_date" hidden>
            </div>
          </div>
        </div>
      </fieldset><br>
      <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Update' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('pharmacy/index','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>
      <?php echo form_close()?>      
      </div>
  </div>
 </div>
  </section>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $("#addedqty").on('keyup',function(){
       
      var quantity = parseInt($("#hidquantity").val());
      var addedqty = parseInt($("#addedqty").val());
      var usedqty  = parseInt($("#used_quantity").val());
      var loadedqty = quantity+addedqty;
      $("#quantity").val(parseInt(loadedqty)) ;
      $("#remain_quantity").val(loadedqty-usedqty);
    var remain_tab_qty = parseInt($("#r_tab_quantity").val());
    var tab_qty = parseInt($("#tab_quantity").val());
    var loaded_r_qty = remain_tab_qty +(addedqty*tab_qty);
    $("#remain_tab_quantity").val(loaded_r_qty);

      if($("#addedqty").val().length == 0){
        $("#quantity").val($("#hidquantity").val());
        $("#remain_quantity").val(quantity-usedqty);
      $("#remain_tab_quantity").val(r_tab_quantity);
      }


    });

    // $("#unload").click(function(){

    //   var quantity = parseInt($("#quantity").val());
    //   var addedqty = parseInt($("#addedqty").val());
    //   var usedqty  = parseInt($("#used_quantity").val());
    //    var loadedqty = quantity-addedqty;
    //    $("#quantity").val(loadedqty);
    //    $("#remain_quantity").val(loadedqty-usedqty);




    // })
    
    $("#mainMedNav").addClass('active');
    $("#addMedNav").addClass('active');

     
    $(document).on('keyup','#actual_price,#selling_price',function(){
        var act_price = $("#actual_price").val();
        var sell_price = $("#selling_price").val();
    var tab_per_qty =  $("#tab_quantity").val()
        var pro_price = parseInt(sell_price-act_price);
        var percentage = Math.round((parseInt(pro_price)/parseInt(act_price))*100);
        var output = pro_price.toString().concat("(")+percentage.toString().concat("%)");
        $("#profit_price").val(output);
    if(sell_price > 0 && tab_per_qty > 0){
      $("#tab_price").val(sell_price/tab_per_qty);
    }
      });

  })

  $('legend').on('click',function(){
      $(this).parent().find('div:first').toggle();
      var fL = $(this).text().substr(0,1);
      var text = $(this).text().substr(1);
      if(fL=='-')
          $(this).text('+'+text);
      else if(fL=='+')
          $(this).text('-'+text);

  });
</script>