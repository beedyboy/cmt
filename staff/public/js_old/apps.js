jQuery(document).ready( function($){ 


// alert(33);

	 /* *
	 @function destroyPopUp()
	  *@description destroys pop up content and closes it
	  *
	  */  
   var uri = $("#base_url").val();
 
 fetch_Admin_list();
 fetch_category_list();
 fetch_product_list();
 
 /*
 fetch_payment_list();
 fetch_feature_list();*/

 function showMod(){
   $('.beedy-kaydee-popup').css('left', $(window).width() / 2 - ($('.beedy-kaydee-popup').width() / 2));
	 $('.beedy-kaydee-popup').show();
 
 }
	 function destroyPopUp(){
			$('.popup-content').empty();  
				$('.beedy-kaydee-popup').hide();
	 }
	  
 
       /**
      *@function hide alert box
      *@returns void
       */
     function hideAlertBox(id, t){
       if(t === "C")
       {
         setInterval( function(){ 
       $("."+id).html('');
       }, 10000);
         
       }
       else
       {
         setInterval( function(){
       $("#"+id).html(''); 
       }, 10000);
       }
     }

/**
 * [hideorShowMore description]
 * @param  {String}  id   [description]
 * @param  {Boolean} bool [description]
 * @return {[type]}       [description]
 */
function hideorShowMore(id='', bool = false)
{

  if(bool == true)
  {
     $("#"+id).css("display", "inline-block");
 $(".split-dropdown").css("display", "inline-block");
  }
  else
  {
    $("#"+id).css("display", "none");
   $(".split-dropdown").css("display", "none");
  }

}
 /*???????????????????????????????ADD OR SHOW FORM ?????????????????????????????????????????*/      
  
  $(document).on('click', '.addNewCategory', function(){
 
   $.ajax({
    url: uri+'category/create', 
       success:function(data)
      {
    
   $('.headerTitle').html("New Category");
   $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });
 
/**
 * Roles
 * @param            
 */
  $(document).on('click', '.addNewproduct', function(){
 
   $.ajax({
    url: uri+'inventory/create', 
       success:function(data)
      {
    
   $('.headerTitle').html("Create New product");
   $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });
 

  $(document).on('click', '.createFund', function(){ 
 var id = $(this).attr("id");
   $.ajax({
    url: uri+'payment/createFund/'+id, 
       success:function(data)
      {
    
   $('.headerTitle').html("Create Fund");
   $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });
 

  $(document).on('click', '.addNewAdmin', function(){  
   $.ajax({
    url: uri+'admin/create', 
       success:function(data)
      {
    
   $('.headerTitle').html("Create Admin");
   $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });
 
  $(document).on('click', '.addAccRecovery', function(){ 
   $.ajax({
    url: uri+'admin/recovery', 
       success:function(data)
      {    
       $('.headerTitle').html("Account Recovery");
       $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });
 
  $(document).on('click', '.updatePassword', function(){ 
   $.ajax({
    url: uri+'admin/accPassword', 
       success:function(data)
      {    
       $('.headerTitle').html("Change Password");
       $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });
 

  


/*?????????????????????????????????????????????????????????????????????????????????????*/


/*???????????????????????????READ OR GET LIST OF ITEMS ????????????????????????????????*/

   
 function fetch_feature_list(){
 $.ajax({
    url:uri + 'feature/list/',
       success:function(data)
      {
    //alert(data);
  $('#featureTable tbody').html(data);
           
   }
    }); 
   
 } 
 function fetch_category_list(){
 $.ajax({
    url:uri + 'category/list/',
       success:function(data)
      {
    //alert(data);
  $('#catTable tbody').html(data);
           
   }
    }); 
   
 } 
 /**
  * [fetch_role_list description]
  * @return {[type]} [Admins role list]
  */
 function fetch_product_list(){
 $.ajax({
    url:uri + 'inventory/list/',
       success:function(data)
      { 
  $('#productTable tbody').html(data);
           
   }
    }); 
   
 }

 function fetch_Admin_list()
 {
   $.ajax({
    url:uri + 'admin/list/',
       success:function(data)
      { 
        $('#adminTable tbody').html(data);
           
     }
    }); 
   
 }
 function fetch_payment_list(){
  var evt_id = $("#evt_id").val();
 $.ajax({
    url:uri + 'payment/list/'+evt_id,
       success:function(data)
      {  
        fetch_payment_summary();
    $('#payTable tbody').html(data);
           
   }
    }); 
   
 }
 function fetch_payment_summary(){
  var evt_id = $("#evt_id").val();
 $.ajax({
    url:uri + 'payment/summary/'+evt_id,
       success:function(data)
      {  
  $('#paySummary').html(data);
           
   }
    }); 
   
 }
/*??????????????????????????????PRINT ???????????????????????????????????*/




  $(document).on('click', '.csvAllAdmin', function(){  
   
   var selected  = new Array();
   // var formdata = $('input[name="AdminCheck"]:checked').serialize();
   var formdata = $('.AdminCheckCase:checked').serialize();
   // $('input[name="AdminCheck"]:checked').each(function()
   // {
   //      selected.push(this.value);
   // })

   // var formdata = selected.serialize();

  $.ajax({
      url:uri + 'admin/csv2', 
      type: "POST",
      data: formdata,
      // dataType: 'json',
      success: function(data){

         alert(data);
      }

    });
   // alert("Number of selected Admin: "+ selected.length+ "\n"+ "And, they are: "+ selected);
    
   
  });

 

  $(document).on('click', '.csvAlSelectedlAdmin', function(){  
     var formdata = $('.AdminCheckCase:checked').serialize(); 
  $.ajax({
      url:uri + 'admin/csvSelected', 
      type: "POST",
      data: formdata, 
      dataType: 'json'
    }).done(function(data)
    {
     
       var $a = $("<a>");
          $a.attr("href", data.file);
          $("body").append($a);
          $a.attr("download", data.name);
          $a[0].click();
          $a.remove();
       
    })
   
  });


function processSuccess(data)
{ 
  if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      fetch_Admin_list(); 
                     }
                     
                     else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                   
                    }
                     hideAlertBox("alert_message_mod", "C");
}


function Clickheretoprint(data)
{ 
   var printContents = $('body').clone().find('script').remove().end().html();

   //get  all link
   var allLinks = $('head').clone().find('script').remove().end().html();

   var popupWin = window.open('', '_blank');

   popupWin.document.open();


   var keepColors = '<style>body {-webkit-print-color-adjust: exact !important; }</style>';

   popupWin.document.write('<html><head>' + keepColors + allLinks + '</head><body onload="window.print()">' + data  + '</body></html>');

   popupWin.document.close();
   
}

  $(document).on('click', '.printAllAdmin', function(){   
  $.ajax({
      url:uri + 'admin/printAll', 
      type: "POST", 
    }).done(function(data)
    {
     
       Clickheretoprint(data)
       
    })
   
  });

  $(document).on('click', '.printAlSelectedlAdmin', function(){  
     var formdata = $('.AdminCheckCase:checked').serialize(); 
   $.ajax({
      url:uri + 'admin/printSelected', 
      type: "POST",
      data: formdata, 
    }).done(function(data)
    {
     
       Clickheretoprint(data)
       
    })
   
  });
 

 

/**
 * reporting module function 
 * @param    id 
 * @return new printer's window
 */
  $(document).on('click', '.printAllPayment', function(){  
  var id = $(this).attr("id"); 
  $.ajax({
      url:uri + 'report/printAll/'+id, 
      type: "POST", 
    }).done(function(data)
    {
     
       Clickheretoprint(data)
       
    })
   
  });

  $(document).on('click', '.printAlSelectedlReport', function(){  
     var formdata = $('.reportCheckCase:checked').serialize(); 
   $.ajax({
      url:uri + 'report/printSelected', 
      type: "POST",
      data: formdata, 
    }).done(function(data)
    {
     
       Clickheretoprint(data)
       
    })
   
  });


  $(document).on('click', '.csvAlSelectedlReport', function(){  
     var formdata = $('.reportCheckCase:checked').serialize(); 
  $.ajax({
      url:uri + 'report/csvSelected', 
      type: "POST",
      data: formdata, 
      dataType: 'json'
    }).done(function(data)
    {
     
       var $a = $("<a>");
          $a.attr("href", data.file);
          $("body").append($a);
          $a.attr("download", data.name);
          $a[0].click();
          $a.remove();
       
    })
   
  });

 
 


/*?????????????????????????????? ???????????????????????????????????*/




/*??????????????????????????????SAVE OR ADD NEW RECORD ???????????????????????????????????*/
/**
 * [storeCategory]
 * @param  {[type]} ){    
 * @param  {[type]} success:function(data)       
 * @return {[type]}                           
 */
  $(document).on('submit','.storeCategory', function(evt){
     
evt.preventDefault();
var formdata = $(this).serialize();  
        $.ajax({
            url:uri + 'category/store',
            type: "POST", 
             dataType: "json", 
             data:formdata,  
             success:function(data){

                          // alert(data);
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      fetch_category_list();
                      destroyPopUp();
                     }
                     
                     else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                   
                    }
                     hideAlertBox("alert_message_mod", "C");
       
             }


          }); 
       
      });


 

$(document).on('submit','.storeAdmin', function(evt)
{
 
  evt.preventDefault();
  var formdata = $(this).serialize();  
           $.ajax({
            url:uri + 'admin/store',
            type: "POST", 
             dataType: "json", 
             data:formdata,  
             success:function(data)
             {
 
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      fetch_Admin_list();
                      destroyPopUp();
                     }
                     
                     else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                   
                    }
              hideAlertBox("alert_message_mod", "C");
             }


          }); 
});
 
$(document).on('submit','.storeProduct', function(evt)
{
 
  evt.preventDefault();
  var formdata = $(this).serialize();  
  /*formdata.append('file', $('#photo')[0].files[0]);
  alert(formdata);*/
           $.ajax({
            url:uri + 'inventory/store',
            type: "POST", 
            dataType: "json",   
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
             success:function(data)
             {
              
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      fetch_product_list();
                      destroyPopUp();
                     }
                     
                     else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                   
                    }
              hideAlertBox("alert_message_mod", "C");
             }


          }); 
});
 

$(document).on('submit','.storeRecovery', function(evt)
{ 
  evt.preventDefault();
  var formdata = $(this).serialize();  
           $.ajax({
            url:uri + 'admin/saveRecovery',
            type: "POST", 
             dataType: "json", 
             data:formdata,  
             success:function(data)
             {
 
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      $('.notice').hide();    
                        destroyPopUp();
                     }
                     
                     else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                      destroyPopUp();
                   
                    }
              hideAlertBox("alert_message_mod", "C");
             }


          }); 
});


$(document).on('submit','.storeUpdatePassword', function(evt)
{ 
  evt.preventDefault();
  var formdata = $(this).serialize();  
           $.ajax({
            url:uri + 'admin/updatePassword',
            type: "POST", 
             dataType: "json", 
             data:formdata,  
             success:function(data)
             {
 
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      $('.notice').hide();    
                        destroyPopUp();
                     }
                     
                     else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                      destroyPopUp();
                   
                    }
              hideAlertBox("alert_message_mod", "C");
             }


          }); 
});



/*?????????????????????????????????????PAGINATION????????????????????????????????????????????????*/


  $(document).on('click','.CategoryListPagin', function(){
       var page = $(this).attr('id'); 
        $.ajax({
      url:uri + 'category/list/page/'+page,
    type: 'POST',
   
       success:function(data)
      {
    // alert(data);
  $('#catTable tbody').html(data);
           
   }
    }); 
       
      });


  $(document).on('click','.productListPagin', function(){
       var page = $(this).attr('id'); 
        $.ajax({
      url:uri + 'product/list/page/'+page,
    type: 'POST',
   
       success:function(data)
      {
    // alert(data);
  $('#evtTable tbody').html(data);
           
   }
    }); 
       
      });


  $(document).on('click','.PaymentListPagin', function(){

       var evt_id = $("#evt_id").val();
       var page = $(this).attr('id');  
        $.ajax({
      url: uri + 'payment/list/'+evt_id+'/page/'+page,
    type: 'POST',
   
       success:function(data)
      {
    // alert(data);
  $('#payTable tbody').html(data);
           
   }
    }); 
       
      });


  $(document).on('click','.AdminListPagin', function(){
 
       var page = $(this).attr('id');  
        $.ajax({
      url: uri + 'admin/list/page/'+page,
    type: 'POST',
   
       success:function(data)
      {
    // alert(data);
  $('#adminTable tbody').html(data);
           
   }
    }); 
       
      });



     /*?????????????????????????????????????????????????????????????????????????????????????*/



     /*?????????????????????????????MODIFICATION LOG????????????????????????????????????????*/  
  
  $(document).on('click', '.modCategory', function(){
 var id = $(this).attr("id");
   $.ajax({
    url: uri+'category/edit/'+id, 
       success:function(data)
      { 
   $('.headerTitle').html("Modify");
   $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });
  
$(document).on('click', '.modproduct', function(){
 var id = $(this).attr("id");
 var part = $(this).attr("part");
   $.ajax({
    url: uri+'inventory/edit/'+id+'/'+part, 
       success:function(data)
      { 
   $('.headerTitle').html("Modify product");
   $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });


$(document).on('click', '.modPayment', function(){
 var id = $(this).attr("id"); 
   $.ajax({
    url: uri+'payment/edit/'+id, 
       success:function(data)
      { 
   $('.headerTitle').html("Modify Payment");
   $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });

$(document).on('click', '.modAdmin', function(){
 var id = $(this).attr("id"); 
   $.ajax({
    url: uri+'Admin/edit/'+id, 
       success:function(data)
      { 
   $('.headerTitle').html("Modify Admin");
   $('.popup-content').html(data);
           showMod();
           
   }
    });
   
   });

$(document).on('change', '#reportCat', function(){
 var id = $(this).val(); 
 if(id == '') 
 {
  alert("Please select a category");
  return false;
 }
   $.ajax({
    url: uri+'report/fetchproduct/'+id, 
       success:function(data)
      {  
          $('#allproductList').html(data); 
           
      }
    });
   
   });

$(document).on('change', '#getReportFromEvt', function(){
 var id = $(this).val(); 
 if(id == '') 
 {
  alert("Please select an product");
  return false;
 }
   $.ajax({
    url: uri+'report/getReportFromEvt/'+id, 
       success:function(data)
      {  
          $('.reporting').html(data); 
           
      }
    });
   
   });

     /*?????????????????????????????????????????????????????????????????????????????????????*/
     /*????????????????????????????UPDATE MODIFIED FIELDS???????????????????????????????????*/
 
/**
 * [update category]
 * @param  {[type]} evt){    
 * @return {[json result]}        [error or success message]
 */
  $(document).on('submit','.updateCategory', function(evt){ 
evt.preventDefault();
var formdata = $(this).serialize();  
        $.ajax({
            url:uri + 'category/update',
            type: "POST", 
             dataType: "json", 
             data:formdata,  
             success:function(data){
 
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      fetch_category_list();
                      destroyPopUp();
                     }
                     
                     else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                   
                    }
                     hideAlertBox("alert_message_mod", "C");
       
             }


          }); 
       
      }); 

  $(document).on('submit','.updateproduct', function(evt){ 
evt.preventDefault(); 
var formdata = $(this).serialize();   
        $.ajax({
            url:uri + 'inventory/update',
            type: "POST", 
             dataType: "json", 
             data:formdata,  
             success:function(data){
 
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      fetch_product_list();
                      destroyPopUp();
                     }
                     
                     else if(data.status == "redirect")
                    {
                 
                      location.href=""+data.msg;
                    
                    }
                    
                    else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                     
                      destroyPopUp();
                   
                    }
                     hideAlertBox("alert_message_mod", "C");
       
             }


          }); 
       
      });


  $(document).on('submit','.updatePayment', function(evt){ 
evt.preventDefault(); 
var formdata = $(this).serialize();   
        $.ajax({
            url:uri + 'payment/update',
            type: "POST", 
             dataType: "json", 
             data:formdata,  
             success:function(data){
 
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      fetch_payment_list();
                      destroyPopUp();
                     }                     
                    else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                     
                      destroyPopUp();
                   
                    }
                     hideAlertBox("alert_message_mod", "C");
       
             }


          }); 
       
      });

  $(document).on('submit','.updateAdmin', function(evt){ 
evt.preventDefault(); 
var formdata = $(this).serialize();   
        $.ajax({
            url:uri + 'admin/update',
            type: "POST", 
             dataType: "json", 
             data:formdata,  
             success:function(data){
 
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                      fetch_Admin_list();
                      destroyPopUp();
                     }                     
                    else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                     
                      destroyPopUp();
                   
                    }
                     hideAlertBox("alert_message_mod", "C");
       
             }


          }); 
       
      });
  $(document).on('submit','.updateSettings', function(evt){ 
evt.preventDefault();
      var swi = '';         
if($("#myonoffswitch").prop("checked"))
{
  swi ="Maintenance";
}
else{
    swi ="Active";
}
 
  var formdata = $(this).serialize()+ "&usermode=" + swi;  
  
        $.ajax({
            url:uri + 'settings/update',
            type: "POST", 
             data:formdata,  
             dataType: "json", 
             success:function(data){ 
             
                     if(data.status =='success')
                     {
                      $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data.msg + '</div>');    
                       
                     }                     
                    else if(data.status == "error")
                    {
                      $('.alert_message_mod').html('<div class="alert alert-danger"role="alert">' + data.msg + '</div>');
                    
                    }
                    
                    else
                    {
                      
                   
                    }
                     hideAlertBox("alert_message_mod", "C");
       
             }


          }); 
       
      });

/*?????????????????????????????????????????????????????????????????????????????????????*/

/*?????????????????????????????????DELETE ITEMS ????????????????????????????????????????????*/
//delete category
 $(document).on( "click", ".delCategory", function()
 {
     var id = $(this).attr("id"); 
       var url = uri + 'category/destroy/'+id;  
       if(confirm("Are you sure you want to delete this category?"))
       {
        
        $.ajax({
       url: url,
       type: "POST", 
       success: function(data){  
       $('.alert_message_mod').html('<div class="alert alert-success" role="alert">' + data + '</div>');
         fetch_category_list();
         hideAlertBox("alert_message_mod", "C");
       
       }  
       
       });
       } 
       else
       {
        return false;
       } 

 });
 
    
 





//category side

$( document ).on( "click", "#categoryAll", function( e ) {  
  $('.catCase').prop('checked', this.checked);
  } );
   

$( document ).on( "click", ".catCase", function( e ) {  
        if($(".catCase").length == $(".catCase:checked").length) {
     // swal('equal');
            $("#categoryAll").prop("checked", "checked");
        } else {
            $("#categoryAll").removeAttr("checked");
        }

    });


//product

$( document ).on( "click", "#productAll", function( e ) {  
  $('.productCase').prop('checked', this.checked);
  } );
   

$( document ).on( "click", ".productCase", function( e ) { 
        if($(".productCase").length == $(".productCase:checked").length) {
     // swal('equal');
            $("#productAll").prop("checked", "checked");
        } else {
            $("#productAll").removeAttr("checked");
        }

    });


//Payment
$( document ).on( "click", "#paymentAll", function( e ) {  
  $('.paymentCase').prop('checked', this.checked);
  } );
   

$( document ).on( "click", ".paymentCase", function( e ) { 
        if($(".paymentCase").length == $(".paymentCase:checked").length) {
     // swal('equal');
            $("#paymentAll").prop("checked", "checked");
        } else {
            $("#paymentAll").removeAttr("checked");
        }

    });


 


//Admin
$( document ).on( "click", "#AdminAll", function( e ) {  
  $('.AdminCase').prop('checked', this.checked);
  } );
   

$( document ).on( "click", ".AdminCase", function( e ) { 
        if($(".AdminCase").length == $(".AdminCase:checked").length) {
     // swal('equal');
            $("#AdminAll").prop("checked", "checked");
        } else {
            $("#AdminAll").removeAttr("checked");
        }

    });




//role
$( document ).on( "click", "#roleAll", function( e ) {  
  $('.roleCase').prop('checked', this.checked);
  } );
   

$( document ).on( "click", ".roleCase", function( e ) { 
        if($(".roleCase").length == $(".roleCase:checked").length) {
     // swal('equal');
            $("#roleAll").prop("checked", "checked");
        } else {
            $("#roleAll").removeAttr("checked");
        }

    });



//role
$( document ).on( "click", "#otherAll", function( e ) {  
  $('.otherCase').prop('checked', this.checked);
  } );
   

$( document ).on( "click", ".otherCase", function( e ) { 
        if($(".otherCase").length == $(".otherCase:checked").length) {
     // swal('equal');
            $("#otherAll").prop("checked", "checked");
        } else {
            $("#otherAll").removeAttr("checked");
        }

    });









//select Admins
$( document ).on( "click", "#AdminCheckAll", function( e ) {  
  $('.AdminCheckCase').prop('checked', this.checked); 

if($("#AdminCheckAll").prop("checked"))
{
  hideorShowMore('AdminMore', true);
}
else
{
   hideorShowMore('AdminMore');
}
 

  } );
   

$( document ).on( "click", ".AdminCheckCase", function( e ) { 
        if($(".AdminCheckCase").length == $(".AdminCheckCase:checked").length) 
        {  
            $("#AdminCheckAll").prop("checked", "checked");

              hideorShowMore('AdminMore', true);
        }
         else
          { 
             if($(".AdminCheckCase:checked").length < 1) 
            {  
              hideorShowMore('AdminMore');
          }
          else
          {

            hideorShowMore('AdminMore', true);
          }
             
            $("#AdminCheckAll").prop("checked", false); 
          }

    });
 

 



//select Admins
$( document ).on( "click", "#reportCheckAll", function( e ) {  
  $('.reportCheckCase').prop('checked', this.checked); 

if($("#reportCheckAll").prop("checked"))
{
  hideorShowMore('reportMore', true);
}
else
{
   hideorShowMore('reportMore');
}
 

  } );
   

$( document ).on( "click", ".reportCheckCase", function( e ) { 
        if($(".reportCheckCase").length == $(".reportCheckCase:checked").length) 
        {  
            $("#reportCheckAll").prop("checked", "checked");

              hideorShowMore('reportMore', true);
        }
         else
          { 
             if($(".reportCheckCase:checked").length < 1) 
            {  
              hideorShowMore('reportMore');
          }
          else
          {

            hideorShowMore('reportMore', true);
          }
             
            $("#reportCheckAll").prop("checked", false); 
          }

    });






 






  //ends here

})