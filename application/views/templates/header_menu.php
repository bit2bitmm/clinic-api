<style>
  #noti_Button,#ofs_noti_Button {

    font-size: 25px;
    margin: 12px 20px 0 10px;
    cursor: pointer;
    color: white;

  }

  #noti_Counter,#ofs_noti_Counter {
    display: block;
    position: absolute;
    background: #E1141E;
    color: #FFF;
    font-size: 12px;
    font-weight: normal;
    padding: 1px 3px;
    margin: 7px 0 0 25px;
    border-radius: 2px;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    z-index: 1;
  }


  #noti_Container {
    position: relative;
    height: 100%;
  }

  /* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
  #notifications {
    display: none;
    width: 430px;
    position: absolute;
    top: 45px;
    padding: 5px;
    right: 0;
    background: #fff;
    border: solid 1px rgba(100, 100, 100, .20);
    -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .20);
    z-index: 5;
  }

  /* AN ARROW LIKE STRUCTURE JUST OVER THE NOTIFICATIONS WINDOW */
  #notifications:before {
    content: '';
    display: block;
    width: 0;
    height: 0;
    color: transparent;
    border: 10px solid #CCC;
    border-color: transparent transparent #FFF;
    margin-top: -20px;
    margin-left: 380px;
  }

  /* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
  #ofs_notifications {
    display: none;
    width: 430px;
    position: absolute;
    top: 45px;
    padding: 5px;
    right: 25px;
    background: #fff;
    border: solid 1px rgba(100, 100, 100, .20);
    -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .20);
    z-index: 5;
  }

  /* AN ARROW LIKE STRUCTURE JUST OVER THE NOTIFICATIONS WINDOW */
  #ofs_notifications:before {
    content: '';
    display: block;
    width: 0;
    height: 0;
    color: transparent;
    border: 10px solid #CCC;
    border-color: transparent transparent #FFF;
    margin-top: -20px;
    margin-left: 380px;
  }

  .ex-alert{

    color:#FF0000;
  }

  h3 {
    display: block;
    color: #333;
    background: #FFF;
    font-weight: bold;
    font-size: 17px;
    padding: 8px;
    margin: 0;
    border-bottom: solid 1px rgba(100, 100, 100, .30);
  }
  .bg-warning{

    background: #fffa01;
    border-radius: 3px;
    padding :3px;
  }

  a.notihr{

    text-decoration: none;
    color: #000;
    font: 15px solid;
  }
  a.notihr:hover{
    background: black;
  } 

  #search{

    padding: 6px;
    margin-top: 8px;
    font-size: 17px;
    border: none;
  }
  .navbar-left button {
    float: right;
    padding: 6px 10px;
    margin-top: 8px;
    margin-right: 16px;
    background: #ddd;
    font-size: 17px;
    border: none;
    cursor: pointer;
  }
  .shortcut{

    display: inline-grid;
    margin: 4px;
  }
  
  .shortcut a:hover{
      
      color: red;
  }

  @media only screen and (max-width: 768px) {
  
   .navbar-left button {
    float: none;
    padding: 6px 10px;
    margin-top: 8px;
    margin-right: 16px;
    background: #ddd;
    font-size: 17px;
    border: none;
    cursor: pointer;
  }

  #nav_bar{
       display: flex;
  }

}

</style>

<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><i class="fa fa-home"></i></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>HSOL</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" id="nav_bar">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu"  role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
     <?php if(in_array('createPatient', $user_permission) && in_array('updatePatient', $user_permission) &&in_array('viewPatient', $user_permission) && in_array('deletePatient', $user_permission)): ?>
   <div class="navbar-left">
     <input type="text" placeholder="Search.." name="search" id="search">
      <button type="submit" id="searchbtn"><i class="fa fa-search"></i></button>
   </div>
      <?php endif ;?>

   <div class="shortcut">
       <?php if(in_array('createPatient', $user_permission)) :?>
          <a href="<?php echo base_url()?>patients/create"><span class="badge badge-success">Add New Patient</span></a>
        <?php endif ;?>
        <?php if(in_array('createPharmacy', $user_permission)) :?>
          <a href="<?php echo base_url()?>pharmacy/create"><span class="badge badge-success">Add New Medicine</span>
          </a>
        <?php endif ;?>
   </div>


   <div id="noti_Container" class="navbar-right" style="padding-right: 5px;" >

    <div id="ofs_noti_Counter"></div>
    <!--SHOW NOTIFICATIONS COUNT.-->
    <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
    <div id="ofs_noti_Button"><span class="glyphicon glyphicon-exclamation-sign"></span></div>
    <!--THE NOTIFICAIONS DROPDOWN BOX.-->
    <div id="ofs_notifications">
      <h3>Out of Stock Notifications (<?php echo $totalofspnoti; ?>)</h3>
      <div style="height:300px;padding: 5px;margin: auto;overflow-x:auto; overflow-y: auto;">

          <?php if($ofsproduct == null){

          echo "<p>No notifications yet..</p>";
        } ?> 

        <?php foreach($ofsproduct as $row): ?>

          <?php if($row['remain_quantity'] <= 0) { ?>
            
           
            <a class="notihr"  href="<?php echo base_url()?>pharmacy/update/<?php echo $row['id']?>"> 
              <p><span class="bg-warning"><?php echo $row['medicine_name']?></span> is out of stock <span class="bg-danger"><?php echo $row['remain_quantity'];?></span> </p>
            </a>
            <hr>
          <?php }else{?>
           
            <a class="notihr"  href="<?php echo base_url()?>pharmacy/update/<?php echo $row['id']?>" > 
              <p><span class="bg-warning"><?php echo $row['medicine_name']?></span> remains only <span class="bg-warning"><?php echo $row['remain_quantity'];?></span> items in stock</p>
            </a>
            <hr>
          <?php } ?>


        <?php endforeach; ?>
      </div>
      <div class="seeAll"><a href="#"></a></div>
    </div>
  </div>
  <div id="noti_Container" class="navbar-right" style="padding-left: 5px;">
    <div id="noti_Counter"></div>
    <!--SHOW NOTIFICATIONS COUNT.-->
    <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
    <div id="noti_Button"><span class="glyphicon glyphicon-bell"></span></div>
    <!--THE NOTIFICAIONS DROPDOWN BOX.-->
    <div id="notifications">
      <h3>Expiry Notifications (<?php echo $totalexpnoti; ?>) </h3>
      <div style="height:300px;padding: 5px;margin: auto;overflow-x:auto; overflow-y: auto;">


        <?php if($expiryproduct == null){

          echo "<p>No notifications yet..</p>";
        } ?> 

        <?php 
        $date = date('Y-m-d');
        foreach($expiryproduct as $row):
          ?>
          <?php

          if($date >= $row['expire_date']){?>
           <a class="notihr"  href="<?php echo base_url()?>pharmacy/update/<?php echo $row['id'] ?>">
            <p class="ex-alert"> <span class="bg-warning"><?php echo $row['medicine_name']?></span> has expired on <span class="bg-danger"><?php echo $row['expire_date'];?></span></p>
          </a>
          <hr>
        <?php }else{ ?>
         <a class="notihr"  href="<?php echo base_url()?>pharmacy/update/<?php echo $row['id']?>"> 
          <p> <span class="bg-warning"><?php echo $row['medicine_name']?></span> is going to expire on   <span class="bg-warning"><?php echo $row['expire_date'];?></span><br>
          
          </p>
        </a>
        <hr>
      <?php } ?>
    <?php endforeach; ?>
  </div>
  <div class="seeAll"><a href="#"></a></div>
</div>

</div>
</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<script>
  $('#noti_Counter')
  .css({
    opacity: 0
  })
  .text('<?php 
    
    if($totalexpnoti !=0){

      echo $totalexpnoti;
    }else{

      echo '0';

    }

        ?>') // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
  .css({
    top: '-10px'
  })
  .animate({
    top: '-2px',
    opacity: 1
  }, 500);
  $('#noti_Button').click(function() {
    $('#ofs_notifications').hide();
    // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
    $('#notifications').fadeToggle('fast', 'linear', function(e) {
      if ($('#notifications').is(':hidden')) {
        $('#noti_Button').css('background-color', '#2E467C');

      }
      // CHANGE BACKGROUND COLOR OF THE BUTTON.

    });

    $('#noti_Counter').fadeOut('slow'); // HIDE THE COUNTER.

    return false;
  });
  

  // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
  $(document).click(function() {
    $('#notifications').hide();

  });

  $('#notifications').click(function() {});
</script>
<script>
  $('#ofs_noti_Counter')
  .css({
    opacity: 0
  })
  .text('<?php 

    if($totalofspnoti !=0){

      echo $totalofspnoti;
    }else{     

     echo '0';

   }
   
        ?>') // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
  .css({
    top: '-10px'
  })
  .animate({
    top: '-2px',
    opacity: 1
  }, 500);

  $('#ofs_noti_Button').click(function() {
    $('#notifications').hide();
    // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
    $('#ofs_notifications').fadeToggle('fast', 'linear', function(e) {
      if ($('#ofs_notifications').is(':hidden')) {
        $('#ofs_noti_Button').css('background-color', '#2E467C');
      }
    });

    $('#ofs_noti_Counter').fadeOut('slow'); // HIDE THE COUNTER.

    return false;
  });
  
  // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
  $(document).click(function() {
    $('#ofs_notifications').hide();

  });
  $('#ofs_notifications').click(function() {});

  $(window).scroll(function () { 

    if ($(window).scrollTop() > 150) {
      $('#nav_bar').addClass('navbar-fixed-top');
    }

    if ($(window).scrollTop() < 53) {
      $('#nav_bar').removeClass('navbar-fixed-top');
    }
  });

  var bondObjs = {};
  var bondNames = [];

  $("#search").typeahead({
    source: function (name,result){
      
      $.ajax({

        url: '<?php echo base_url();?>patients/searchPatient',
        data: {add:name.add},
        dataType: "json",

        success : function(data){ 

          var resp = $.map(data,function(obj){

            return obj.name+'  -  '+obj.year;
          })

          result(resp);
      }

    });

    },

    minLength: 1

  }).on('keypress',function(e){

    if(e.which == 13) {

       sessionStorage.setItem("init","init");
       
       var val = $('#search').val();

       var q   = val.toLowerCase();

       window.location.href = "<?php echo base_url()?>patients/searchResult/"+q;

    }


  });

  $("#searchbtn").click(function(){

      sessionStorage.setItem("init","init");

      var val = $('#search').val();

       var q   = val.toLowerCase();

       window.location.href = "<?php echo base_url()?>patients/searchResult/"+q;
  })

  function changeCollapse(){
    var width = $(document).width();
    // alert("Hello World");
    if (width > 900) {
      $('body').removeClass('sidebar-collapse');
  }else{
     $('body').addClass('sidebar-collapse');
  }

}
  $(window).resize(function(){
    changeCollapse();
  });
  $(document).ready(function(){
    changeCollapse();
  });



</script>