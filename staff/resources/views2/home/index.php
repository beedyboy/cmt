<?php $this->setSiteTitle('Software Home'); ?>
 <?php $this->start('body') ?>

<link rel="stylesheet" href="<?=base_url.'public/css/paper-dashboard.css'; ?>">
 <h1 class="center-text">  <?php 	 
echo $this->Beedy->getCompany();

?> 
</h1>
<hr />

                <div class="grid mobile  m-t-2">
    <!--row begins-->
                    
					<div class="column column-3 m-r-1">
                        <div class="card">
                            <div class="content">
                                <div class="grid">
                                    <div class="column column-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="column column-7">
                                        <div class="numbers">
                                            <p><strong>Users</strong></p>
                                            
                                        </div>
                                    </div>
                                </div>
                                 <?php if(actionAcl('User', 'r')):  ?>
                                <a href="<?=base_url.'user'?>">
                                    <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-arrow-right"></i>View
                                    </div>
                                </div>
                            </a>
                             <?php endif;  ?>
                            </div>
                        </div>
                    </div>


<div class="column column-3">
                        <div class="card">
                            <div class="content">
                                <div class="grid">
                                    <div class="column column-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-flag-alt"></i>
                                        </div>
                                    </div>
                                    <div class="column column-7">
                                        <div class="numbers">
                                            <p><strong>Category</strong></p>
                                            <?=$this->Beedy->totalCategory(); ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php if(actionAcl('Category', 'r')):  ?>
                                <a href="<?=base_url.'category'?>">
                                    <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-arrow-right"></i>View
                                    </div>
                                </div>
                            </a>
                             <?php endif; ?>
                            </div>
                        </div>
                    </div>
<div class="column column-3">
                        <div class="card">
                            <div class="content">
                                <div class="grid">
                                    <div class="column column-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-flag-alt"></i>
                                        </div>
                                    </div>
                                    <div class="column column-7">
                                        <div class="numbers">
                                            <p><strong>Events</strong></p>
                                            <?=$this->Beedy->totalEvent(); ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php if(actionAcl('Event', 'r')):  ?>
                                <a href="<?=base_url.'event'?>">
                                    <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-arrow-right"></i>View
                                    </div>
                                </div>
                            </a>
                             <?php endif;  ?>
                            </div>
                        </div>
                    </div>
<div class="column column-3">
                        <div class="card">
                            <div class="content">
                                <div class="grid">
                                    <div class="column column-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-flag-alt"></i>
                                        </div>
                                    </div>
                                    <div class="column column-7">
                                        <div class="numbers">
                                            <p><strong>Roles</strong></p>
                                            <?=$this->Beedy->totalRole(); ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php if(actionAcl('Role', 'r')):  ?>
                                <a href="<?=base_url.'role'?>">
                                    <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-arrow-right"></i>View
                                    </div>
                                </div>
                            </a>
                             <?php endif;  ?>
                            </div>
                        </div>
                    </div>

</div>


<div class="row mobile  m-t-2">

<div class="column column-6">
<h3>Recent Events [Last five(5)]</h3> 
<ul>   
<?php 
foreach ($this->data as $Event) 
{
   echo "<li><a href='".base_url.'event/show/'.$Event->id."' class='btn '>$Event->evt_desc</a></li>";
}

?>
</ul>
</div>

<div class="column column-6">
   


<form action="" class="form"> 
<div class="form-group">
<label> Search By Category</label> 
<select name="name" id="reportCat" class="form-control">

<option value="">--Select One--</option>
<?php
$Category = new Category('categories');
foreach ($this->event as $value)
 {
 ?>

<option value="<?=$value->cat_id?>"><?=$Category->findById($value->cat_id)->cat_name?></option>

 <?php
}

?>

</select>

 </div> 

</form>

</div>


</div>
    <?php $this->end() ?>