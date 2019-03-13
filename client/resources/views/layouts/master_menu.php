<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

	<!-- Sidebar Menu -->
	<ul class="sidebar-menu">
		<li class="header">MENU</li>
		<!-- Optionally, you can add icons to the links -->
		<li class="active"><a href="<?=base_url?>"><i class="fa fa-cart-plus"></i> <span>Cart</span></a></li>
		<li><a href="<?=base_url?>service"><i class="fa fa-wrench"></i> <span>Services</span></a></li>
		<li><a href="<?=base_url?>db"><i class="fa fa-book"></i> <span>Stock Book</span></a></li>
		<li><a href="<?=base_url?>ac"><i class="fa fa-inr"></i> <span>Accounts</span></a></li>
		<li><a href="<?=base_url?>backup"><i class="fa fa-hdd-o"></i> <span>Backup</span></a></li>

		<li class="header">DASHBOARD</li>
		<!-- Optionally, you can add icons to the links -->
		<li><a href="<?=base_url?>admin?stockinfo"><i class="fa fa-info"></i> <span>Stock Info</span></a></li>
		<li><a href="<?=base_url?>admin?salesinfo"><i class="fa fa-area-chart"></i> <span>Sales Info</span></a></li>
		<li><a href="<?=base_url?>admin?binfo"><i class="fa fa-briefcase"></i> <span>Business Info</span></a></li>

		<li class="header">ADMIN TOOLS</li>
		<li><a href="<?=base_url?>admin?stockmd"><i class="fa fa-database"></i> <span>Stock Management</span></a></li>
		<li><a href="<?=base_url?>admin?salehistory"><i class="fa fa-history"></i> <span>Sales History</span></a></li>
		
	</ul>
	<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>


<?php

//$menu = Router::getMenu('menu_acl.json');

// /dnd($menu);


 ?>  
		 <aside>
		<div class="dashLogo">
			<a href="<?=base_url?>#" class="">	<img src="<?=base_url;?>public/images/logo.jpg" alt="logo" ></a>
		</div>
			
			 


 	 	<ul>
				 
				
         	<li>
         	<a href="<?=base_url?><?=base_url?>"><i class="fas fa-home  fa-fw"></i> Dashboard</a>
 <hr class="navbar-divider">
         	</li>
					
         <li>
         <a href="<?=base_url?><?=base_url?>admin"><i class="fas fa-users  fa-fw"></i> Admininistrator</a>
 <hr class="navbar-divider">
         </li>
					
         <li class="">
          <a href="<?=base_url?>#" class="accordion"><i class="fas fa-list-alt fa-fw"></i> Category</a>
           <div class="panel">
 		  <a href="<?=base_url?>#" class="addNewCategory"><i class="fas fa-plus fa-fw"></i>Create</a> 
  
 	 <a href="<?=base_url?><?=base_url?>category"><i class="fa fa-fw fa-th-list"></i>List</a> 
 	  		
 		</div> 
 <hr class="navbar-divider">
          </li>
					
         <li>
         <a href="<?=base_url?><?=base_url?>inventory"><i class="fas fa-warehouse fa-fw"></i> Inventory</a>
 <hr class="navbar-divider">
         </li> 
					
         <li>
         <a href="<?=base_url?>#" class="accordion"><i class="fas fa-shopping-basket  fa-fw"></i> Orders</a>
  <div class="panel">
 		 
 	 <a href="<?=base_url?><?=base_url?>category/index"><i class="fa fa-fw fa-exclamation-triangle"></i>Pending</a> 
 	  		 <a href="<?=base_url?>#" class="addNewCategory"><i class="fas fa-truck fa-fw"></i>Delivered</a> 
  
 		</div> 
 		<hr class="navbar-divider">
         </li> 
					
         <li>
         <a href="<?=base_url?><?=base_url?>settings"><i class="fa fa-fw fa-cog"></i> Settings</a>
 <hr class="navbar-divider">
         </li> 
					
         <li> 
         
			          <a class="is-active" href="<?=base_url?><?=base_url?>logout">
			            <i class="fa fa-fw fa-sign-out-alt"></i> Log Out
			          </a>
			          </li>
				</ul>
		 </aside> 