jQuery(document).ready( function($){ 

  
 $("#login-form").submit( function(e) { loginProcess(e);  });
 $("#storeProduct").submit( function(e) { storeProduct(e);  }); 
 $("#payNow").submit( function(e) { payNow(e);  }); 
 $("#edit").change( function(e) { getHallRecord(e);  });  
 $("#seatTable").change( function(e) { getseatTable(e);  HallList(e);  }); 
 //alert('hi'); alert('hi'); 
 
  /**
       *
       *@param {String} uniform resource identifier
       *@returns nothing
       *
       */ 
       var uri = $("#url").val(); 
      //  alert(uri);
       //  swal(uri);
       
       
  // fetch_user_data(); 
	//  fetch_product_list();
  //  viewproduct();
	 /**
	  *@function destroyPopUp()
	  *@description destroys pop up content and closes it
	  *
	  */  
 
 function showMod(){
   $('.beedy-kaydee-popup').css('left', $(window).width() / 2 - ($('.beedy-kaydee-popup').width() / 2));
	 $('.beedy-kaydee-popup').show();
 
 }
	 function destroyPopUp(){
			$('.beedy-kaydee-popup-content').empty();  
				$('.beedy-kaydee-popup').hide();
	 }
	  
  
//   $(document).on('click', '.addNewEvent', function(){
   
//    $.ajax({
//     url:uri + 'event/create/',
//     	 success:function(data)
// 			{
 
//   								 $('.beedy-kaydee-popup-content').html(data);
//            showMod();
           
//    }
//     });
   
//    });
  
//   function storeProduct(evt){
// var _this = $(evt.target);
// evt.preventDefault();
// var formdata = $(_this).serialize(); 
   
//    $.ajax({
//        url:uri + 'inventory/store/',
//        type: "POST",
//     	data: formdata,
//       success:function(data)
// 			{
//     //alert(data);
  
//     if(data == 1){
//      alert("product added successfully");
//            destroyPopUp();
//            fetch_product_list();
//     }
//     if(data == 2){
//      alert("This product name already exist under the given category!!... Please try another name");
        
//     }
//     else{
//     alert("Error adding new product"); 
//     }
    
//    }
       
//    });
//   }
	 
   
	 
//  function fetch_product_list(){
//  $.ajax({
//     url:uri + 'inventory/productList/',
//     	 success:function(data)
// 			{
//     //alert(data);
//   $('#productTable tbody').html(data);
           
//    }
//     }); 
	 
//  }
//   $(document).on('click', '.productPagin', function(){
	 
// 		var page = $(this).attr('id');
//         $.ajax({
//     url:uri + 'product/productList/',
//     type: 'POST',
//     data:{page:page}, 
// 			 success:function(data)
// 			{  
			 
// 			  //alert(data);
//   $('#productTable tbody').html(data);
				 
			 
// 				}
// 		});
// 	});
   
    
//        $( document ).on( "click", ".delproduct", function(  ) {
//          var evt_id = $(this).attr("id");
       
//       var url = uri + 'product/delete/';  
//        if(confirm("Are you sure you want to delete this product?"))
//        {
//        $.ajax({
//        url: url,
//        method: "POST",
//        data:{evt_id:evt_id},
//        success: function(data){  
//        $('#alert_message_mod').html('<div class="alert alert-success" role="alert">' + data + '</div>');
    
//         $("."+evt_id).hide();
       
//        } 
       
//        });
//        } else 
//        return false;
       
//        } ); 
   
 
//   $(document).on('click', '.createFund', function(){
   
//    $.ajax({
//     url:uri + 'product/createFund/',
//     	 success:function(data)
// 			{
 
//   								 $('.beedy-kaydee-popup-content').html(data);
//            showMod();
           
//    }
//     });
   
//    });
	 //report based on staff performance
 

$(document).on('change', '#eftype', function(){
 
	var etype  = $(this).val();
 if(etype == " "){
  alert("product type can not be empty");
 }
 else{
  
 $.ajax({
	url:uri + 'product/allproduct/',
	type: 'POST',
	data: {type:etype},
	success: function( result ){
  //alert(result);
	  $("#allproductList").html(result);
  
 }
 
 });
 }
	
	  
	
	});
	 
  function viewproduct(){ 
 
 $.ajax({
	url:uri + 'product/fundProgress/', 
	success: function( result){
  //alert(result);
	   
 	 $('#progressTable tbody').html(result);
   
  
 }
 
  
	
	});
 
  }
	 
   
 
	 
  
	//cancelCartMeal
		   /**
	    *@function hide alert box
	    *@returns void
	    */
	   function hideAlertBox(id){
		  setInterval( function(){
       $("#"+id).html('');
       }, 7000);
       
	   }
    
 /**
       *@function isFieldEmp
       *@param {String} caller (id or class)
       *@description checks if a field is empty ? true : false
       */
       function isFieldEmp(caller) {
       if (caller.text() == '') {
       caller.css('border', '1px solid red');
       return false;
       } else
       caller.css('border', '');
       
       return true;
       }
       
    
	    
function loginProcess(evt){ 
var _this = $(evt.target);
evt.preventDefault();  
var formdata = $(_this).serialize();
$(_this).find(':input').attr('disabled',true);
$(_this).find(':button').attr('disabled',false);
$(_this).find(':button').html('Loading..');
  $.ajax({
	url:uri + 'login/authenticate/',
	type: 'POST',
  data: formdata,
  // dataType: JSON,
	success: function( result ){ 
    console.log(result.status); 
    console.log(result.msg); 
    if(result.status == 'green') 
    {
			$("#message").removeClass('hide').addClass(' alert-success').html('<p>Logging in......</p>');
	 location.href=uri + 'home/dashboard/';
			 
		 }
       else if(result.status == 'yellow')
        {
					$("#message").removeClass('hide').addClass(' alert-danger').html(result.errorList);
          $(_this).find(':input').attr('disabled',false);
          $(_this).find(':button').attr('disabled',false);
          $(_this).find(':button').html('<i class="icon-signin icon-large"></i>Login');
	 
		 }
     else
     {
			$("#message").removeClass('hide').addClass(' alert-danger').html(result.errorList);
			$(_this).find(':input').attr('disabled',false);
			$(_this).find(':button').attr('disabled',false);
			$(_this).find(':button').html('<i class="icon-signin icon-large"></i>Login');
		}
	}
});
 
return this;
} 
      
       
       $( document ).on( "blur", ".modifyUser", function() { 
       var acc_id = $(this).data("id");
       var column_name = $(this).data("column");
       var value = $(this).text();
       
       var url = uri + 'user/edit/';  
       $.ajax({
       url: url,
       method: "POST",
       data:{acc_id:acc_id, column_name:column_name, value:value},
       success: function(data){  
       $('#alert_message_mod').html('<div class="alert alert-success" role="alert">' + data + '</div>');
       $("#userTable").DataTable().destroy(); 
       fetch_user_data();
       
       } 
       
       });
       
       } ); 
       
          
       
       $( document ).on( "click", ".delUser", function(  ) { 
       var acc_id = $(this).attr("id"); 
       var url = uri + 'user/delete/';  
       if(confirm("Are you sure you want to delete this user?"))
       {
       $.ajax({
       url: url,
       method: "POST",
       data:{acc_id:acc_id},
       success: function(data){  
       $('#alert_message_mod').html('<div class="alert alert-success" role="alert">' + data + '</div>');
       $("#userTable").DataTable().destroy(); 
       fetch_user_data();
       
       } 
       
       });
       } else 
       return false;
       
       } ); 
   
   

$(document).on('change', '#reftype', function(){
 
	var etype  = $(this).val();
 if(etype == " "){
  alert("product type can not be empty");
 }
 else{
  
 $.ajax({
	url:uri + 'report/allproduct/',
	type: 'POST',
	data: {type:etype},
	success: function( result ){
  //alert(result);
	  $("#allproductList").html(result);
  
 }
 
 });
 }
	
	  
	
	});
	 
  
$(document).on('change', '#revt_id', function(){
 
	var evt_id  = $(this).val();
 if(evt_id == " "){
  alert("product  can not be empty");
 }
 else{
  
 $.ajax({
	url:uri + 'report/fetchReport/',
	type: 'POST',
	data: {evt_id:evt_id},
	success: function( result ){
  $("#reportable tbody").html(result);
  
 }
 
 });
 }
	
	  
	
	});
	 
  
  
  //ends

 });
