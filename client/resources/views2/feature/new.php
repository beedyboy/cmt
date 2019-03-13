 
<div class="grid mobile">   

<div class="column column-1-3 offset-1-3 "  id="app">
  
 
<h1 v-html="title">  </h1>
         <hr />
           
       
<form action='.api/feature' class="modal-content animate form " @submit.prevent="addSubscriber" id="myform">

<label>Feature Name:</label>
 <input type="text" name="name" class="form-control" v-model="name">
 

<label>Description:</label>
 <textarea name="description" id="description" v-model="description" cols="30" rows="10"></textarea>

<button class="btn btn-success">Register</button>

</form>

</div>
</div>
 

    