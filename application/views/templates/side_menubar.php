<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>


        <?php if($user_permission): ?>
          <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li class="treeview" id="mainUserNav">
            <a href="#">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
              <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if(in_array('createUser', $user_permission)): ?>
              <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
              <?php endif; ?>

              <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
            <?php endif; ?>
            </ul>
          </li>

     <?php endif; ?>


           <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="mainGroupNav">
              <a href="#">
				<i class="fa fa-users"></i>
                <span>Groups</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Add Group</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Manage Groups</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


       <?php if(in_array('createPatient', $user_permission) || in_array('updatePatient', $user_permission) || in_array('viewPatient', $user_permission) || in_array('deletePatient', $user_permission)): ?>
            <li id="storeNav">
              <a href="<?php echo base_url('patients/') ?>">
                <i class="fa fa-wheelchair-alt"></i> <span>Patient&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-success" id="patientqty"><?php echo $patient_count;?></span></span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createPharmacy', $user_permission) || in_array('updatePharmacy',$user_permission) || in_array('viewPharmacy', $user_permission) || in_array('deletePharmacy', $user_permission)): ?>
              <li class="treeview" id="mainMedNav">
              <a href="#">
        <i class="fa fa-product-hunt"></i>
                <span>Pharmacy</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createPharmacy', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('pharmacy/create') ?>"><i class="fa fa-circle-o"></i> New Medicine</a></li>
                <?php endif; ?>
                <?php if(in_array('updatePharmacy', $user_permission) || in_array('viewPharmacy', $user_permission) || in_array('deletePharmacy', $user_permission)): ?>
         <li id="managePhaNav"><a href="<?php echo base_url('pharmacy/') ?>"><i class="fa fa-circle-o"></i> Manage Pharmacy</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

           <?php if(in_array('viewReports', $user_permission) ): ?>
              <li class="treeview" id="mainGroupNav">
              <a href="#">
        <i class="fa fa-file"></i>
                <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('viewReports', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('reports/totalVisits') ?>"><i class="fa fa-circle-o"></i> Today (Weekly Report)</a></li>
                <?php endif; ?>
                <?php if(in_array('viewReports', $user_permission) || in_array('viewPatient', $user_permission) || in_array('deletePatient', $user_permission)): ?>
         <li id="managePhaNav"><a href="<?php echo base_url('reports/yearlyVisits') ?>"><i class="fa fa-circle-o"></i>Annual Report</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

           <?php if(in_array('viewProfile', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Profile</span></a></li>
        <?php endif; ?>
        <?php if(in_array('updateSetting', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
        <?php endif; ?>

        
       <?php endif; ?>

        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>

    </section>
</aside>