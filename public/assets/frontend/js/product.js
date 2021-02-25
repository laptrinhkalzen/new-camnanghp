$(document).ready(function() {
    $('.navigation a').click(function (){
        $('.navigation a').removeClass('active');
        $(this).addClass('active');
    });
});
jQuery(function(){
    $('#read-detail').click(function (){
        $('.product-detail').attr('style',  'max-height:2000px');
        $('.maskcontent').hide();
        $(this).hide();
        $('#collapse-detail').show();
    });
    $('#collapse-detail').click(function(){
        $('.product-detail').attr('style',  'max-height:250px');
        $('.maskcontent').show();
        $(this).hide();
        $('#read-detail').show();
    });


});
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

$(document).ready(function(){
    var menu_sidebar_btn = $('.hamburger.hamburger--spin');
    var menu_sidebar = $('.menu-sidebar');
    var menu_sidebar_overlay = $('.menu-sidebar-overlay');
    var menu_sidebar_close = $('.menu-sidebar-close');
    /*menu sidebar toggle*/
    menu_sidebar_btn.on('click', function () {
        $(this).toggleClass('active');
        menu_sidebar.toggleClass('menu-sidebar-open');
        menu_sidebar_overlay.toggleClass('menu-sidebar-overlay-active');

    });
    /*menu sidebar close*/
    menu_sidebar_close.on('click', function () {
        menu_sidebar_btn.removeClass('active');
        menu_sidebar.removeClass('menu-sidebar-open');
        menu_sidebar_overlay.removeClass('menu-sidebar-overlay-active');
    });

    menu_sidebar_overlay.on('click', function () {
        menu_sidebar_btn.removeClass('active');
        menu_sidebar.removeClass('menu-sidebar-open');
        menu_sidebar_overlay.removeClass('menu-sidebar-overlay-active');
    });
    $(".has-menu").on('click', function () {
        $(this).toggleClass('active');
        $(this).find('.menu-child').slideToggle();
    });

    $('#big').owlCarousel({
        slideSpeed: 2000,
        nav: true,
        autoplay: true,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
        ]
    });
    $('.sale-product').owlCarousel({
        dots: false,
        loop: true,
        dots: false,
        nav: false,
        responsive: {
            0: {
                items: 2
            },
            1200: {
                items: 6
            },
            1600: {
                items: 8
            }
    }
    });
});
$('body').delegate('#quantity','change',function(){
    if($(this).val() > 9){
       $('.dropdown-wrapper-2').html(`<input id="quantity" type="number" class="form-control" value='`+$(this).val()+`' style="width: 100%; height: 100%;">`);
    }else{
        $html='';
        for(i=1;i<10;i++){
            if($(this).val() == i){
                $html += '<option value="'+i+'" selected>Số lượng: '+i+'</option>';
            }else{
                $html += '<option value="'+i+'">Số lượng: '+i+'</option>';
            }
        }
       $('.dropdown-wrapper-2').html(`<span class="dropdown-icon"></span>
                            <select id="quantity" class="form-control" style="width: 100%; height: 100%;">
                                `+$html+`
                                <option value="10">10+</option>
                            </select>`); 
    }
});
$('.login').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade'
});
$('.register').magnificPopup({
    type: 'inline',
    midClick: true,
    mainClass: 'mfp-fade'
});
$('#frmRegister').submit(function (e) {
    e.preventDefault();
    var type = $('input[name="type"]:checked').val();
    $('.load').css('display', 'block');
    $('.register-btn').attr("disabled", "disabled");
    if (type == 1) {
        $.ajax({
            url: '/api/register-marketing',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.load').css('display', 'none');
                $('.register-btn').removeAttr("disabled", "");
                $('.login').magnificPopup('close');
                swal({
                    title: "Đăng ký tài khoản thành công. Bạn vui lòng vào gmail để xác thực tài khoản",
                    type: "success"
                });
                $('#frmRegister')[0].reset();
            }
        });
    } else if(type == 2) {
        $.ajax({
            url: '/api/register-construction',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.load').css('display', 'none');
                $('.register-btn').removeAttr("disabled", "");
                $('.login').magnificPopup('close');
                swal({
                    title: "Đăng ký tài khoản thành công. Bạn vui lòng vào gmail để xác thực tài khoản",
                    icon: "success"
                });
                $('#frmRegister')[0].reset();
            }
        });
    }else if(type == 3){
        $.ajax({
            url: '/api/register-member',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.load').css('display', 'none');
                $('.register-btn').removeAttr("disabled", "");
                $('.login').magnificPopup('close');
                swal({
                    title: "Đăng ký tài khoản thành công. Bạn vui lòng vào gmail để xác thực tài khoản",
                    icon: "success"
                });
                $('#frmRegister')[0].reset();
            }
        });
    }
});
$('#frmLogin').submit(function (e) {
    e.preventDefault();
    var type = $('input[name="type_login"]:checked').val();
    if ($('#username').val() == '') {
        var span = "Username không được để trống";
        $('#username').parent().find('.help-block').html(span);
        return;
    }
    if ($('#password').val().length < 6) {
        var span = "Nhập mật khẩu tối thiểu 6 kí tự";
        $('#password').parent().find('.help-block').html(span);
        return;
    }
    if (type == 1) {
        $.ajax({
            url: '/api/login-marketing',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.login').magnificPopup('close');
                if (resp.success == true) {
                    swal({
                        title: "Đăng nhập thành công",
                        type: 'success'
                    }, function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Đăng nhập không thành công",
                        type: 'error'
                    });
                }
            }
        });
    } else if(type == 2) {
        $.ajax({
            url: '/api/login-construction',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.login').magnificPopup('close');
                if (resp.success == true) {
                    swal({
                        title: "Đăng nhập thành công",
                        type: "success"
                    }, function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Đăng nhập không thành công",
                        type: "error"
                    });

                }
            }
        });
    }else if(type ==3){
        $.ajax({
            url: '/api/login-member',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.login').magnificPopup('close');
                if (resp.success == true) {
                    swal({
                        title: "Đăng nhập thành công",
                        type: "success"
                    }, function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Đăng nhập không thành công",
                        type: "error"
                    });

                }
            }
        });
    }
});

