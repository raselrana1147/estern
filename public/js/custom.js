$(function($){
	'use strict';

	  let base_url = $('#base-url').val();
	  /*=================Lode more catgeory====================*/

	  let pageNameCat=$('#see_by_category').attr('pageNameCat');
	  if (pageNameCat !='undefined' && pageNameCat =='1') {
	  	$(document).ready(function(){
         let categoryid=$('#see_by_category').attr('categoryid');
         let start=0;
         let limit=4;
         let action = true;
        function load_more_data_cat(start,limit){
          $.ajax({
              url: base_url+"category_loaddata",
              method:'POST',
              data:{start:start,limit:limit,categoryid:categoryid},
              success:function(data){
                $("#see_by_category").append(data);
                if (data =='') {
                    $('.load_no_more_cat').html('<span><strong>No more products to load</strong></span>').show();
                     $("#loadmore").hide();
                    action = false;
                }else{
                   $('.load_no_more_cat').html('').hide();
                     $("#loadmore").show();
                     action = true;
                }
              }
          });
        }
        if(action)
         {
            load_more_data_cat(start, limit);
            action = 'active';
         }
         $('body').on('click','#loadmore',function(){
         	 start = limit + start;
         	 load_more_data_cat(start, limit);
         })
           
      });
   
    }/*=======End load more========*/


     /*=================Lode more Brand====================*/
	  
	  let pageNameBrand=$('#see_by_brand').attr('pageNameBrand');
	  if (pageNameBrand !='undefined' && pageNameBrand =='2') {
	  	$(document).ready(function(){
         let brandid=$('#see_by_brand').attr('Brandid');
         let start=0;
         let limit=4;
         let action = true;
        function load_more_data_brand(start,limit){
          $.ajax({
              url: base_url+"brand_loaddata",
              method:'POST',
              data:{start:start,limit:limit,brandid:brandid},
              success:function(data){
                $("#see_by_brand").append(data);
                if (data =='') {
                    $('.load_no_more_brand').html('<span><strong>No more products to load</strong></span>').show();
                     $("#loadmore").hide();
                    action = false;
                }else{
                   $('.load_no_more_brand').html('').hide();
                     $("#loadmore").show();
                     action = true;
                }
              }
          });
        }
        if(action)
         {
            load_more_data_brand(start, limit);
            action = 'active';
         }
         $('body').on('click','#loadmore',function(){
         	 start = limit + start;
         	 load_more_data_brand(start, limit);
         })
           
      });
   
    }/*=======End load more========*/


         /*=================Lode more Brand====================*/
	  
	  let pageNameSubCat=$('#see_by_sub_cat').attr('pageNameSubCat');
	  if (pageNameSubCat !='undefined' && pageNameSubCat =='3') {
	  	$(document).ready(function(){
         let subCatid=$('#see_by_sub_cat').attr('SubCatid');
         let start=0;
         let limit=4;
         let action = true;
        function load_more_data_sub_cat(start,limit){
          $.ajax({
              url: base_url+"subcat_loaddata",
              method:'POST',
              data:{start:start,limit:limit,subcat_id:subCatid},
              success:function(data){
                $("#see_by_sub_cat").append(data);
                if (data =='') {
                    $('.load_no_more_sub_cat').html('<span><strong>No more products to load</strong></span>').show();
                     $("#loadmore").hide();
                    action = false;
                }else{
                   $('.load_no_more_sub_cat').html('').hide();
                     $("#loadmore").show();
                     action = true;
                }
              }
          });
        }
        if(action)
         {
            load_more_data_sub_cat(start, limit);
            action = 'active';
         }
         $('body').on('click','#loadmore',function(){
         	 start = limit + start;
         	 load_more_data_sub_cat(start, limit);
         })
           
      });
   
    }/*=======End load more========*/


              $('body').on('click','.delete_item_head',function(){
                var cart_id=$(this).attr('cart_id');
                    $.ajax({
                        url: $(this).attr('data-action'),
                        method: "POST",
                        data: {cart_id:cart_id},
                        success:function(response){
                            let data=JSON.parse(response);
                            toastr.success(data.msg);
                            loadcart();
                           
                            //$('.cart_row'+cart_id).hide();
                            $("#shoping_cart_header").load(" #shoping_cart_header > *");  
                        },
                        error:function(response){
                        }
                    });
                });

             function loadcart(){

             $.ajax({
                    url: $('#shoping_cart_details_herader').attr('data-action'),
                    method: "GET",
                    success:function (response) {
                        var data = JSON.parse(response);
                        $('#setTotalItem2').text(data.totalitem);
                        $('#setTotalAmount2').html(data.totalprice);
                        console.log(data.carts);
                        var setItem='';
                        data.carts.forEach(function(item,index){
                            setItem+='<li class="mini_cart_item"><a title="Remove this item" class="remove" href="#">×</a>'+'<a href=""><img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="" alt="">'+item.product_name+'</a><span class="quantity">'+item.quantity+' × <span class="amount">'+'৳'+item.product_price+'</span></span></li>'
                        });

                         $('#loadAllCartItme').html(setItem);
                         

                    }

              });
            }

            // reatime product search
      $('body').on('keyup','#search_product',function(){
                var search_value=$(this).val();
                if (search_value ==='') {
                     $('#set_search_product').hide();
                  }else{
                    $.ajax({
                    url: $('#search_reatime_product_url').attr('data-action'),
                    method: "POST",
                    data:{search_value:search_value},
                    success:function (response) {
                        var setItem="";
                        var data = JSON.parse(response);
                        if (data.products.length>0) {
                             data.products.forEach(function(item,index){
                               setItem+='<li class="get_product_name">'+item.name+'</li>';
                              });
                               $('#set_search_product').fadeIn('1000').html(setItem);
                          }else{
                              $('#set_search_product').fadeIn('1000').html('<li>'+data.msg+'</li>');
                          } 
                     }
                    });
                  }  

        });

      $('body').on('click','.get_product_name',function(){
          var product_name=$(this).text();
          $("#search_product").val(product_name);
          $('#set_search_product').fadeOut();

      });


	
});