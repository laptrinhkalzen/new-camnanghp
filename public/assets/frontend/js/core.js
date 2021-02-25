//Format number
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") //regax
}

//Thêm vào giỏ hàng
$('a[data-action ="add-to-cart"]').click(function(){
     var product_id=$(this).data('product_id');
     var quantity=$('#quantity').val();
     $.ajax({
            url:'/api/add-to-cart',
            method:'POST',
            data:{product_id : product_id,quantity:quantity},
            success:function(resp){
               if(resp.success == true){
                 $('.itm-cont').html(resp.count);
                 $('#total').html(resp.total +' đ');
                 swal('Thêm giỏ hàng thành công');
               }else{
                 swal('Thêm giỏ hàng không thành công');
               }
            }
        });
 })

//Cập nhật giỏ hàng
$('.each_quantity').on('change',function(){
    var coupon_code=$('#coupon').val();
    var id_option=$(this).data('id_option');
    var quantity=$(this).val();
    var key=$(this).data('key');
    $.ajax({
    url: '/api/update-cart',
    method: 'POST',
    data: {id_option: id_option,quantity:quantity,key:key},
    success: function (resp) {
    if (resp.success == true) {
        //$(".shopping-item").load(" .shopping-item > *");
        $('#sub_total').html(formatNumber(resp.total)+" đ");
        $("#final_total").html(formatNumber(resp.total)+" đ");
        $('.total-amount').html(formatNumber(resp.total)+' đ');
        $('.count-sp').html(resp.count + ' Sản phẩm');
        $('.total-count').html(resp.count);
        $('.amount_x_'+key).val(resp.each_count);
    }
    }
    });

//Xoá giỏ hàng
 $('.delete_cart').on('click',function(){
         var id_option=$(this).data('id_option');

          $.ajax({ 
            url: '/api/delete-cart',
            method: 'POST',
            data: {id_option: id_option},
            success: function (resp) {
                if (resp.success == true) {
                    if(resp.count >0){
                       //$(".shopping-item").load(" .shopping-item > *");
                       $('.each_cart_' + id_option).fadeOut();
                       $('#sub_total').html(formatNumber(resp.total)+' đ');
                       $('.total-amount').html(formatNumber(resp.total)+' đ');
                       $('.count-sp').html(resp.count + ' Sản phẩm');
                       $('.total-count').html(resp.count);
                   }
                else{   
                       location.reload();
                       // $('.shopping-item').html('Không có sản phẩm nào trong giỏ hàng');
                       // $('.total-count').html(resp.count);
                }   
                       
                }
            }
        });
     
    });

//Áp dung mã giảm giá
    $('#apply_coupon').click(function(){
        var coupon_code=$('#coupon').val();
        $.ajax({
        url:'{{route("api.apply_coupon")}}',
        data:{coupon_code:coupon_code,_token:$('#token').val()},
        method: 'POST',
        success:function(res){
        if(res.statusCode==200){
        var discount=0;
        var sub_total=parseFloat($("#sub_total").text().replace(/[^0-9]/gi, ''));
        //alert(sub_total);
        if(res.condition <= sub_total){
        if(res.type_coupon==1){    
           discount= sub_total - (sub_total / 100 * res.value);
        }
        if(res.type_coupon==2){
           discount= sub_total-res.value;
        }
        $("#final_total").html(formatNumber(discount)+" đ");
        $('#coupon-success').show();
        $('#coupon-fail').hide();
        }
        else{
             swal("Đơn hàng phải từ "+res.condition+" để áp dụng mã giảm giá này!");
             $('#coupon-success').hide();
             $('#coupon-fail').hide();
        }
    
        }
        else{
        $('#coupon-success').hide();
        $('#coupon-fail').show();
        }
        }
        });
        });
        });    

//Lọc sp
  $('.attribute_filter,#order_by').on('change',function(){
            //var current_url = window.location.href;
            //alert(current_url);
            var attr=[];
            var order_by=$('#order_by :selected').val();
            var cat_id={{$category_id}};    
            attr =  $("input[name='attr']:checked").map(function(){  //Lấy mảng tất cả attr 
                return $(this).val();
                }).get();
            $.ajax({
                url:'{{route("api.filter_product")}}',
                method:'POST',
                data:{attr:attr,order_by:order_by,cat_id:cat_id,_token: $('#token').val()},
                success:function(resp){
                    if(resp!=1){
                        $('.show_filter').html(resp);
                        $(window).scrollTop(0);                //Mỗi lần filter đẩy lên đầu trang
                        //var pageUrl = '?attributes=' + attr;
                        //window.history.pushState('', '', pageUrl);
                    }
                    else{
                        location.reload();
                    }
               }
            });
        });


//Auto complete 
  $('input[name="search"]').keyup(function(){  //Load dữ liệu khi nhập từ khoá
        var query=$(this).val();
        if(query!=''){
            $.ajax({
                method:'GET',
                url:'{{route("api.auto_complete")}}',
                
                data:{query:query},
                success:function(res){
                    $('div[class$=search_result]').fadeIn();
                    $('div[class$=search_result]').html(res);   
                }
            });
        }
        else{
            $('div[class$=search_result]').fadeOut();
        }
        });

        $(document).on('click','li',function(){   //Đẩy từ khoá lên ô tìm kiếm
            $('input[name="search').val($(this).text());
             $('div[class$=search_result]').fadeOut();
        });          

//Gửi email ajax
        $('#sendmail').click(function(e){
            var email = $('#email1').val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(email=='') {
            alert('Hãy nhập email của bạn');
            }
            else{
            if(regex.test(email)==false){
            alert('Vui lòng kiếm tra lại email của bạn');
            }
            else{
            $.ajax({
            url:'{{route("api.get_email1")}}',
            method:'POST',
            data:{email: email},
            success:function(data){
            $("#email1").val("");
            $(".success").show();
            }
            });
            }
            }
        });