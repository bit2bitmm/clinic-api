<style type="text/css">

  .autocomplete-items {
  position: relative;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 6px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
  
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Patient
      <small>Info</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('/');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('patients/');?>">Patients</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>
       
        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

      <div class="panel-group" id="pInfo">
        <div class="panel panel-default">
          <div class="panel-heading">
              <h5>Edit Patient Infomation</h5>
          </div>
           <div id="pInfoBody" class="panel-collapse collapse in">
            <form role="form" action="<?php base_url('patients/create') ?>" method="post" >
      <div class="panel-body">
        <div class='col col-xs-6'>
          <label>Name: </label><input type="text" name="name" class="form-control" id="name" value="<?php echo $patient_data['name'];?>"> <br/>
            <label>Age: </label><br>
          <select id="dobyear"><option selected><?php echo $patient_data['year']?></option></select>
          <select id="dobmonth"><option selected><?php echo $patient_data['month']?></option></select>
          <select id="dobday"><option selected><?php echo $patient_data['day']?></option></select><br><br>
       <span id="year"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <span id="month"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <span id="day"></span>
       <input type="hidden" name="year" class="form-control" id="tx_year" value="<?php echo $patient_data['year']?>" autocomplete="off">
       <input type="hidden" name="month" class="form-control" id="tx_month" value="<?php echo $patient_data['month']?>" autocomplete="off">
       <input type="hidden" name="day" class="form-control" id="tx_day" value="<?php echo $patient_data['day']?>" autocomplete="off">
        </div>
        <div class="col col-xs-6">
          <label>Gender:</label><br>
           <label class="radio-inline">
                      <input type="radio" name="gender" id="male" value="1" <?php if($patient_data['gender'] == 1) {
                        echo "checked";
                      } ?>>
                      Male
                    </label>
                <label class="radio-inline">
                      <input type="radio" name="gender" id="female" value="0" <?php if($patient_data['gender'] == 0) {
                        echo "checked";
                      } ?>>
                      Female
                    </label><br><br>
          <label>Address:</label>
         <div class="autocomplete" style="width:300px;">
          <input type="text" name="address" class='form-control input-lg' value="<?php echo $patient_data['address']?>" id="address" >
        </div><br>
          <div class="pull-right">
          <a href="<?php echo base_url('patients/index')?>" class="btn btn-warning">Back</a>
          <input type="submit" value="save" id="save" class="btn btn-primary">
        </div>
        </div>
      </div>
    </form>
         </div>
        </div>
      </div>

      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

  $(document).ready(function(){

     $("#address").typeahead({
        source: function (address,result){
          
          $.ajax({

          url: '<?php echo base_url();?>patients/searchAddress',
          data: {add:address.add},
          dataType: "json",

          success : function(data){

            var resp = $.map(data,function(obj){

                return obj.address;
            })

            result(resp);

            }

           });
        }, 

        minLength: 1
    });

    $("#year").text($("#tx_year").val()+" yr");
    $("#month").text($("#tx_month").val()+" mon");
    $("#day").text($("#tx_day").val()+" d");
      
    $.dobPicker({
          daySelector: '#dobday', /* Required */
          monthSelector: '#dobmonth', /* Required */
          yearSelector: '#dobyear', /* Required */

    });

     $("#dobyear").change(function(){

     $("#year").text($("#dobyear").val()+" yr");

     $("#tx_year").val($("#dobyear").val());


    });

    $('#dobmonth').change(function(){

     $("#month").text($("#dobmonth").val()+" mon");
     $("#tx_month").val($("#dobmonth").val());

    });

    $('#dobday').change(function(){

     $("#day").text($("#dobday").val()+" d");
     $("#tx_day").val($("#dobday").val());

    });


  
  
var doCap = false;

$('#name').keydown(function(e) {
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

$('#name').keypress(function(e){
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

});


</script>