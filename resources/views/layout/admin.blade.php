<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/plugins/colorpicker/colorpicker.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/custom-plugins/wizard/wizard.css')}}" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/bootstrap/css/bootstrap.min.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/css/fonts/ptsans/stylesheet.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/css/fonts/icomoon/style.css')}}" media="screen">

<link rel="stylesheet" type="text/css" href="{{asset('/admincj/css/mws-style.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/css/icons/icol16.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/css/icons/icol32.css')}}" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/css/demo.css')}}" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/jui/css/jquery.ui.all.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/jui/jquery-ui.custom.css')}}" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/css/mws-theme.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/admincj/css/themer.css')}}" media="screen">
<link rel="stylesheet" href="{{asset('/admincj/css/main.css')}}">

<title>@yield('title')</title>

</head>

<body>
	<!-- Header -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
                <span style="color:white;font-size:20px;font-family:microsoft yahei">Ours Logo</span>
			</div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
        	
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
                
                <?php $user = \App\User::find(session('uid')); ?>

            	<!-- User Photo -->
            	<div id="mws-user-photo">
                	Hello
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello
                    </div>
                    <ul>
                        <li><a href="#">修改密码</a></li>
                        <li><a href="/logout">注销</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
    	<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
        	<!-- Searchbox -->
        	<div id="mws-searchbox" class="mws-inset">
            	<form action="typography.html">
                	<input type="text" class="mws-search-input" placeholder="Search...">
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li>
                        <a href="#"><i class="icon-user"></i>用户管理</a>
                        <ul class="closed">
                            <li><a href="{{url('/users/create')}}">用户添加</a></li>
                            <li><a href="{{url('/users')}}">用户列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 分类管理</a>
                        <ul class="closed">
                            <li><a href="{{url('/cates/create')}}">分类添加</a></li>
                            <li><a href="{{url('/cates')}}">分类列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 标签管理</a>
                        <ul class="closed">
                            <li><a href="{{url('/tags/create')}}">标签添加</a></li>
                            <li><a href="{{url('/tags')}}">标签列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 文章管理</a>
                        <ul class="closed">
                            <li><a href="{{url('/articles/create')}}">文章添加</a></li>
                            <li><a href="{{url('/articles')}}">文章列表</a></li>
                        </ul>
                    </li>
                </ul>
            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">
                <!-- 操作实现提醒 -->
                @if(session('info'))
                <div class="mws-form-message info">
                    {{session('info')}}
                </div>
                @endif
                <!-- 自定义区域 -->
                @section('content')
                @show
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
            	Copyright saigz 2018. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="{{asset('/admincj/js/libs/jquery-1.8.3.min.js')}}"></script>
    <script src="{{asset('/admincj/js/libs/jquery.mousewheel.min.js')}}"></script>
    <script src="{{asset('/admincj/js/libs/jquery.placeholder.min.js')}}"></script>
    <script src="{{asset('/admincj/custom-plugins/fileinput.js')}}"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="{{asset('/admincj/jui/js/jquery-ui-1.9.2.min.js')}}"></script>
    <script src="{{asset('/admincj/jui/jquery-ui.custom.min.js')}}"></script>
    <script src="{{asset('/admincj/jui/js/jquery.ui.touch-punch.js')}}"></script>

    <!-- Plugin Scripts -->
    <script src="{{asset('/admincj/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="{{asset('/admincj/plugins/flot/jquery.flot.min.js')}}"></script>
    <script src="{{asset('/admincj/plugins/flot/plugins/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('/admincj/plugins/flot/plugins/jquery.flot.pie.min.js')}}"></script>
    <script src="{{asset('/admincj/plugins/flot/plugins/jquery.flot.stack.min.js')}}"></script>
    <script src="{{asset('/admincj/plugins/flot/plugins/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('/admincj/plugins/colorpicker/colorpicker-min.js')}}"></script>
    <script src="{{asset('/admincj/plugins/validate/jquery.validate-min.js')}}"></script>
    <script src="{{asset('/admincj/custom-plugins/wizard/wizard.min.js')}}"></script>

    <!-- Core Script -->
    <script src="{{asset('/admincj/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/admincj/js/core/mws.js')}}"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="{{asset('/admincj/js/core/themer.js')}}"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="{{asset('/admincj/js/demo/demo.dashboard.js')}}"></script>

</body>
</html>