<!-- Content Wrapper. Contains page content --> 
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if($is_admin == false):  ?>

        <div class="row">

        <?php if(in_array('createPharmacy', $user_permission) || in_array('updatePharmacy',$user_permission) || in_array('viewPharmacy', $user_permission) || in_array('deletePharmacy', $user_permission)): ?>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h2><?php echo $total_medicines;?></h2>

                <p>Total Medicines</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url('pharmacy/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif ;?>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h2><?php echo $total_todaypatients?></h2>

                <p>Total Visits Today</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" data-toggle = "modal" data-target="#showModal" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <?php if(in_array('viewReports', $user_permission)): ?>
<!-- remove brand modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="showModal">
          <div class="modal-dialog" role="document">
           <div class="modal-content">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Patient List</h4>
           </div>

          <form role="form" action="" method="post" id="viewForm">
           <div class="modal-body">
            <p><?php 

             foreach($patient as $pat){

              $time = strtotime($pat['date_time']);

              echo  "<mark style='background:#16a895'>".$pat['name']."</mark>  visited at  <mark color='yellow'>".date('h : i : s',$time)."</mark><hr>";
             }

               ?>

               <?php if($patient == null) {

                  echo "No data!!";

                }

                ?>
              
            </p>
            </div>
          <div class="modal-footer">
            <a href="<?php echo base_url()?>reports/totalVisits/<?php echo mdate('%Y-%m-%d');?>" class="btn btn-default">See All</a>
          </div>
       </form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>
          </div>
          <!-- ./col -->
        
          <!-- ./col -->
         
          <!-- ./col -->
        </div>
        <!-- /.row -->
      <?php endif; ?>
      <?php if(in_array('viewReports', $user_permission) ): ?>
 <div class="row">
     <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 title="panel-title"><i class="fa fa-pie-chart"></i> Pie Chart <small>(Diagnosis Data)</small></h4>
        </div>
        <div class="panel-body">
              <div id="pie-chart">
              <?php if($pie_chart_data == null) {
                    
                     echo "No Data yet..";
                  
                    }?>
           </div>

            <!--  <?php
                // $url = $_SERVER['REQUEST_URI'];
                // echo $url;
                // // $parts = explode('?=', $url);
                 // $parts = "http://localhost/ritaclinic/reports/yearlyVisits";
                 // $page = $parts;
                 // echo '<iframe align="center" width="100%" height="100%" src="'.$page.'" frameborder="yes" scrolling="yes" name="myIframe" id="myIframe"> </iframe>';

             ?>
               <a href="<?php echo base_url();?>reports/yearlyVisits"><img src="<?php echo base_url();?>assets/images/Capture3.PNG" alt="AnuualReport" style="width:350px;height:400px;"></a>
 -->
        </div>
      </div>
     </div>
   <div class="col-md-6">
     <div class="panel panel-default">
        <div class="panel-heading">
          <h4 title="panel-title"><i class="fa fa-bar-chart"></i> Visits In Past Seven Days </h4>
        </div>
        <div class="panel-body">
            
          <div id="line-chart">
              <?php
          if(empty($chart_data)) {
                    
           echo "No Data yet..";
                  
           }?>
          </div>
        </div>
      </div>
   </div>
 </div>
<?php endif;?>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
  $(function(){
    
  console.log(<?php echo json_encode($pie_chart_data); ?>);

  Morris.Donut({
  element: 'pie-chart',
  data: <?php echo json_encode($pie_chart_data); ?>,
  xkey: 'label',
  ykeys: ['value'],
  labels: 'label',
 });

    //<!-- Line Chart -->
      var serries = JSON.parse(`<?php echo $chart_data; ?>`);
          console.log(serries);
          var data = serries,
            config = {
              data: data,
              xkey: 'y',
              ykeys: ['a'],
              labels: ['Visitors'],
              fillOpacity: 0.6,
              hideHover: 'auto',
              behaveLikeLine: true,
              resize: true,
              pointFillColors:['#ffffff'],
              pointStrokeColors: ['black'],
              lineColors:['gray','red']
          };
         
         config.element = 'line-chart';
        var morrisBar = Morris.Bar(config);


  });
</script>
