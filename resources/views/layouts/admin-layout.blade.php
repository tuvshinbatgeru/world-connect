<!doctype html>
<html>
<head>
    @include('includes.resource')
    @include('includes.admin-header')
</head>
<body>
	<div class="wrapper">
	    <div class="sidebar" data-color="purple" data-image="/images/sidebar-5.jpg">
	    	<div class="sidebar-wrapper">
	            <div class="logo">
	                <a href="http://worldconnect.mn" class="simple-text">
	                    World Connect	
	                </a>
	            </div>

	            <ul class="nav">
            		<li class="{{$currentView == 'dashboard-view' ? 'active' : ''}}">
	                    <a href="/admin/dashboard">
	                        <i class="pe-7s-graph"></i>
	                        <p>Хяналт</p>
	                    </a>
	                </li>
	                <li class="{{$currentView == 'country-view' ? 'active' : ''}}">
	                    <a href="/admin/country">
	                        <i class="pe-7s-graph"></i>
	                        <p>Улс</p>
	                    </a>
	                </li>
	                <li class="{{$currentView == 'school-view' ? 'active' : ''}}">
	                    <a href="/admin/school">
	                        <i class="pe-7s-graph"></i>
	                        <p>Сургууль</p>
	                    </a>
	                </li>
	                <li class="{{$currentView == 'news-view' ? 'active' : ''}}"> 
	                    <a href="/admin/news">
	                        <i class="pe-7s-graph"></i>
	                        <p>Мэдээлэл</p>
	                    </a>
	                </li>
	                <li class="{{$currentView == 'alb-view' ? 'active' : ''}}">
	                    <a href="/admin/album">
	                        <i class="pe-7s-graph"></i>
	                        <p>Зургийн цомог</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel" style="position: relative;">
	        <nav class="navbar navbar-default navbar-fixed">
	            <div class="container-fluid">
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle" data-toggle="collapse">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                    <a class="navbar-brand" href="#">Админ</a>
	                </div>
	                <div class="collapse navbar-collapse">
	                    <ul class="nav navbar-nav navbar-left">
	                        <li>
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                                <i class="fa fa-dashboard"></i>
	                            </a>
	                        </li>
	                    </ul>

	                    <ul class="nav navbar-nav navbar-right">
	                        <li>
	                           <a href="">
	                               Account
	                            </a>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </nav>

	        <div class="content" style="">
	            <div class="container-fluid">
	                <div class="row">
	                	<component is="{{$currentView}}" 
					               inline-template>
					  		@yield('content')
						</component>	
	                </div>
	            </div>
	        </div>

	        <footer class="footer">
	            <div class="container-fluid">
	                <nav class="pull-left">
	                    <ul>
	                        <li>
	                            <a href="#">
	                                Home
	                            </a>
	                        </li>

	                    </ul>
	                </nav>
	                <p class="copyright pull-right">
	                    &copy; 2016 <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
	                </p>
	            </div>
	        </footer>

	    </div>
	</div>
	<core-notify v-ref:notify>
	</core-notify>
	@include('includes.admin-script')
</body>
</html>
