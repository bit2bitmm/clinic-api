<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
       <li><a href="<?php echo base_url('/');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo base_url('/pharmacy');?>">Pharmacy</a></li>
      <li class="active">Create</li>
    </ol>
  </section>

  <section class="content">
  <div class="container">

    <div class="row">
  <div class="col col-md-8 well well-sm">
      <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role"=alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismisss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
    <?php echo form_open('pharmacy/create',array("id"=>"addDrugForm", "role"=>"form",)); ?>       
     <fieldset>
      <legend>- Product Info </legend>
      <div>
        <?php echo ( !empty($error) ? $error : '' ); ?>
       
        <div class="form-group">
          <div class="col-md-12">
          <label>Medicine Name</label>
            <input type="text" name='medicine_name' id='medicine_name' value="<?php echo $this->input->post('medicine_name');?>" class='form-control'  title='' required/> 
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6">
          <label>Quantity</label>
            <input type="number" name='quantity' id='quantity' value="<?php echo $this->input->post('quantity');?>" class='form-control'  title='quantity' required/>
            <input type="hidden" name="used_quantity" id="used_quantity" value=0 />
            <input type="hidden" name="remain_quantity" id="remain_quantity"/>
			  <input type="hidden" name="remain_tab_quantity" id="remain_tab_quantity" value=0 />
          </div>
          <div class="col-md-6">
          <label>Type</label>
            <?php echo form_dropdown('sell_type',$unit,''," class='form-control' title='Unit' required");?>
          </div>
        </div>
		  <div class="form-group">
			  <div class="col-md-12">
          <span class="fa fa-question-circle fa-lg" data-toggle="tooltip" title="The amount of tabs available in the type you choose (example: 100tabs per bottle)"></span>
				  <label>Tabs per Type Quantity</label>
				  <input type="number" name='tab_quantity' id='tab_quantity' value="<?php echo $this->input->post('tab_quantity');?>" class='form-control'  title=''/> 
			  </div>
		  </div>      
        <div class="form-group">
          <div class="col-md-6">
            <label>Registered  Date</label>
            <input type="date" name='register_date' id='register_date' value="<?php echo date('Y-m-d'); ?>" class='form-control'  autocomplete="off" title='Registered Date' required/>
          </div>
          <div class="col-md-6">
          <label>Expire Date</label>
            <input type="date" name='expire_date' min="<?php echo date('Y-m-d'); ?>" id='expire_date' value="<?php echo $this->input->post('expire_date');?>" class='form-control'  title='Expire Date' autocomplete="off" required/> 
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
            <input type="number" name="actual_price" id='actual_price' value="<?php echo $this->input->post('actual_price');?>" class="form-control"  title = 'Actual Price'  required/>
          </div>
          <div class="col-md-6">
           <label>Selling Price</label>
            <input type="number" name="selling_price" id='selling_price' value="<?php echo $this->input->post('selling_price');?>" class="form-control"  title = 'Selling Price'  required/>
          </div>
          <div class="col-md-6">
            <label>Profit</label>
            <input type="text" name="profit_price" id='profit_price' value="<?php echo $this->input->post('profit_price');?>" class="form-control"  title='Profit' readonly required/>
          </div>
          <div class="col-sm-6">
            <label>Status</label>
            <select type="text" class="form-control" id="status" name="status" title="Select Availabilty" required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <div class="col-md-12">
            <label>Price per tab</label>
            <input type="number" name="tab_price" id="tab_price" class="form-control" readonly>
          </div>
          
       </div>
      </fieldset>
      <div class=clearfix></div>

      <fieldset>
        <legend>+ Description </legend>

        <div style="display: none;">
          <div class="form-group">
            <div class="col-md-12"><textarea name="description" id="description" class="form-control" placeholder="Description" rows="6"><?php echo $this->input->post('description');?></textarea>
              <input type="hidden" name="is_deleted" value="0">
            </div>
          </div>
        </div>
      </fieldset><br>
      <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Register' class="form-control btn btn-info" /></div>
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


    $.dobPicker({
          daySelector: '#dobday', /* Required */
          monthSelector: '#dobmonth', /* Required */
          yearSelector: '#dobyear', /* Required */

    });
    
    $("#mainMedNav").addClass('active');
    $("#addMedNav").addClass('active');

    $("#quantity").on('keyup',function(){
        var quantity = $("#quantity").val();
        $("#remain_quantity").val(quantity);

      });

	  $("#tab_quantity").on('keyup',function(){
		  var quantity = $("#quantity").val()*$("#tab_quantity").val();
		  $("#remain_tab_quantity").val(quantity);
	  });
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

  var doCap = false;

$('#medicine_name').keydown(function(e) {
    var input = $(this);
    var val = input.val();
    
    if(doCap){
        var lastVal = val.substr(val.length - 1);
        
        if(lastVal !== " "){
            input.val(val.substring(0, val.length - 1) + lastVal.toUpperCase());
            doCap = false;
        }
    }
});

$('#medicine_name').keypress(function(e){
    var input = $(this);
    var key = e.keyCode;
    var val = input.val();
    
    // Capitalize first character ever typed.
    if(val.length === 1){
        input.val(val.substr(0, 1).toUpperCase() + val.slice(1));
    }
    
    if(key === 32){
        
        // Prevent double spaces.
        if(val.substr(val.length - 1, 1) === " "){
            return false;
        }
        
        doCap = true;
    }
});

</script>