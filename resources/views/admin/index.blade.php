@extends('layouts.admin-layout', ['currentView' => 'admin-view'])
@section('content')	
	<div class="wrapper">
	    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
	    	<div class="sidebar-wrapper">
	            <div class="logo">
	                <a href="http://worldconnect.mn" class="simple-text">
	                    World Connect	
	                </a>
	            </div>

	            <ul class="nav">
            		<li :class="isMenu('dashboard-view')">
	                    <a @click="setMenu('dashboard-view')">
	                        <i class="pe-7s-graph"></i>
	                        <p>Хяналт</p>
	                    </a>
	                </li>
	                <li :class="isMenu('country-view')">
	                    <a @click="setMenu('country-view')">
	                        <i class="pe-7s-graph"></i>
	                        <p>Улс</p>
	                    </a>
	                </li>
	                <li :class="isMenu('school')">
	                    <a @click="setMenu('school')">
	                        <i class="pe-7s-graph"></i>
	                        <p>Сургууль</p>
	                    </a>
	                </li>
	                <li :class="isMenu('news')"> 
	                    <a @click="setMenu('news')">
	                        <i class="pe-7s-graph"></i>
	                        <p>Мэдээлэл</p>
	                    </a>
	                </li>
	                <li :class="isMenu('album')">
	                    <a @click="setMenu('album')">
	                        <i class="pe-7s-graph"></i>
	                        <p>Зургийн цомог</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
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


	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                	<component :is="menu">
	                		
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
@stop