<?php $this->setSiteTitle('Software Subscribers List'); ?>
 <?php $this->start('body') ?>
 
 
<div id="app" class="grid"> 
<div   class="column"> 
  
  <h1>Subscribers List</h1>
  <table  class="table  hoverable">
 <thead>
   <tr>
    
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone Num</th>
    <th>address</th> 
    <th>Action</th>
  
  </tr>

 </thead>
<tbody>
<?php  

//dnd($this->data);
 foreach ($this->subscribers as $subscriber) {
  # code...
 ?>


<tr>
<td><?php echo $subscriber->id; ?></td>
<td><?php echo $subscriber->org_name; ?></td> 
<td><?php echo $subscriber->org_email; ?></td> 
<td><?php echo $subscriber->org_num; ?></td> 
<td><?php echo $subscriber->org_address; ?></td> 
<td><a id="<?php echo $subscriber->id; ?>" href="#">Edit</a></td>


</tr>

 <?php

 }

   
?>
 
<a href="<?=base_url ?>food/create">Create</a>

    </tbody>
  </table>
 
 

</div>
</div>
              <?php 
             // echo Pagination::cc();
              pageLink();

               $this->end() ?>
  