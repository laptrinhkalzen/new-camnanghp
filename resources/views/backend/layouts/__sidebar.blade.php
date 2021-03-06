<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div style="text-align: center;" class="card-body">
                <div class="">
                        <a href="/"><img src="{!!Auth::user()->avatar!!}" width="90" height="90" class="rounded-circle" alt=""></a>
                    </div>
                <div class="media">
                    

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{!!Auth::user()->full_name!!}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i> &nbsp;Kalzen media
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">CHỨC NĂNG CHÍNH</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="{{route('admin.index')}}" class="nav-link active">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="{{route('admin.config.index')}}" class="nav-link">
                        <i class="icon-cog"></i> 
                        <span>Cấu hình website</span>
                    </a>
                </li>
                <!-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-user-tie"></i> <span>Người dùng</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">

                        <li class="nav-item">
                            <a href="{{route('admin.user.index')}}" class="nav-link">
                                <span>Thành viên hệ thống</span>         
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.role.index')}}" class="nav-link">
                                <span>Quyền</span>         
                            </a>
                        </li>
                    </ul>
                </li> -->
                
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-newspaper2"></i> <span>Tin tức</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('admin.news_category.index')}}" class="nav-link">Danh mục</a></li>
                        <li class="nav-item"><a href="{{route('admin.news.index')}}" class="nav-link">Bài viết</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-newspaper2"></i> <span>Toplist</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('admin.toplist_category.index')}}" class="nav-link">Danh mục</a></li>
                        <li class="nav-item"><a href="{{route('admin.toplist.index')}}" class="nav-link">Bài viết</a></li>
                        <li class="nav-item"><a href="" class="nav-link">Đánh giá</a></li>
                    </ul>
                </li>
                
                <!-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Sản phẩm</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Sản phẩm">
                        <li class="nav-item"><a href="{{route('admin.news_category.index')}}" class="nav-link">Danh mục</a></li>
                        <li class="nav-item"><a href="{{route('admin.product.index')}}" class="nav-link">Sản phẩm</a></li>
                        <li class="nav-item"><a href="{{route('admin.attribute.index')}}" class="nav-link">Thuộc tính</a></li>
                    </ul>
                </li> -->
                <!-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Giao diện</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('admin.slide.index')}}" class="nav-link">Slide</a></li>
                        <li class="nav-item"><a href="{{route('admin.menu.index')}}" class="nav-link">Menu</a></li>
                    </ul>
                </li> -->
                <li class="nav-item">
                    <a href="{{route('admin.member.index')}}" class="nav-link"><i class="icon-users"></i> <span>Quản trị thành viên</span></a>
                    <!-- <ul class="nav nav-group-sub" data-submenu-title="Khách hàng">
                        <li class="nav-item"><a href="{{route('admin.contact.index')}}" class="nav-link">Liên hệ</a></li>
                        <li class="nav-item"><a href="{{route('admin.member.index')}}" class="nav-link">Thành viên</a></li>
                    </ul> -->
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>