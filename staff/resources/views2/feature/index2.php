<?php $this->setSiteTitle('Software Features'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 
<div id="app" class="columns">
<h1 v-html="title">  </h1>
         <hr />
           <?php  
$file = 'app/apis/feature_api.php';

 //include $file;

           //dnd($this->Feature); ?>
         <Button class="btn btn-success  "  data-toggle="tooltip"   @click="showAddModal = true" title="Add New Event" style="height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Feature</button>
     <div id="alert_message_mod"></div>
        <div class="alert alert-danger text-center" v-if="errorMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
                <span class="glyphicon glyphicon-alert"></span> {{ errorMessage }}
            </div>
            
            <div class="alert alert-success text-center" v-if="successMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
                <span class="glyphicon glyphicon-ok"></span> {{ successMessage }}
            </div>
             <table  class="table  hoverable" id=" " data-responsive="table">
                 <thead>
                     <tr>
                         <th># </th>
                         <th>Feature Name </th>
                         <th>Description </th>    
                          <th>Action </th>
                     
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                  

<tr v-for="list in features">

<td> {{ list.id }} </td>

<td> {{ list.name }} </td>

<td> {{ list.description }} </td>



<td><a class="button is-outlined is-small m-r-5" :href="'list/'+ list.id  ">Edit</a> </td>


<!--<a :href="'/job/' + r.id">-->
</tr>
 

                 </tbody>
                 </table>
      <!-- Add Modal -->
<div class="myModal" v-if="showAddModal">
 
    <div class="modalContainer">
        <div class="modalHeader">
            <span class="headerTitle">Add New Feature</span>
            <button class="closeBtn pull-right" @click="showAddModal = false">&times;</button>
        </div>
        <div class="modalBody">
        <form>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" v-model="newFeature.name">
            </div>

            <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" v-model="newFeature.description"> </textarea>  
            </div>
            </form>

        </div>
        <hr>
        <div class="modalFooter">
            <div class="footerBtn pull-right">
                <button class="btn btn-default" @click="showAddModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-primary" @click="saveMember();"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
            </div>
        </div>
    </div>
</div>

</div>
              <?php $this->end() ?>


 <?php $this->start('scripts') ?>
           

<script>
    
var app = new Vue({
    el: '#app',
    data:{
        title: 'Feature Management',
        showAddModal: false,
        errorMessage: "",
        successMessage: "",
        features: [],
        newFeature: {name: '', description: ''}
    },

    mounted: function(){
      this.getAllFeatures();
    },  
    methods:{
        getAllFeatures: function(){
            axios.get('feature/list')
                .then(function(response){
                  
                    console.log(response);
                     app.features = response.data.Feature;
                });
        } ,

        saveMember: function(){
            //console.log(app.newFeature);
            var memForm = app.toFormData(app.newFeature);
            axios.post('feature/store', memForm)
                .then(function(response){
                    //console.log(response);
                    app.newFeature = {name: '', description:''};
                    if(response.data.error){
                        app.errorMessage = response.data.message;
                       
                    }
                    else{
                        app.successMessage = response.data.message
                        app.getAllFeatures();
                        app.showAddModal = false;
                    }
                });
        },

        toFormData: function(obj){
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },

        clearMessage: function(){
            app.errorMessage = '';
            app.successMessage = '';
        }

    }

});

</script>



      <?php $this->end() ?>
