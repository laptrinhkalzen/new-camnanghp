<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">

        <span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

        <ul class="navbar-nav">
            
            <!-- <li class="dropdown">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle legitRipple" data-toggle="dropdown">
                        <i class="icon-bell2"></i>
                        <span class="visible-xs-inline-block position-right"></span>
                        <span class="status-mark border-pink-300"></span>
                    </a>
                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            Hoạt động   
                         </div>     
                      </div>
                 </li>  --> 
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img style="object-fit: cover" src="{{\Auth::user()->avatar}}" class="rounded-circle mr-2" height="34" width="34" alt="">
                    <span>{{\Auth::user()->full_name}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.user.index_profile', ['id' => \Auth::user()->id])}}" class="dropdown-item"><i class="icon-user-plus"></i> Thông tin tài khoản</a>
                    <a href="javascript:void(0)" data-action="logout" class="dropdown-item"><i class="icon-switch2"></i> Đăng xuất</a>
                </div>
            </li>
                        
                               
        </ul>
    </div>
</div>
<!-- /main navbar -->
<script type="text/javascript">
    $(document).ready(function(){ 
    created(){
    Echo.join(`chat`)
    .here((users) => {
        //
    })
    .joining((user) => {
        console.log(user.name);
    })
    .leaving((user) => {
        console.log(user.name);
    });
    };
    });
</script>