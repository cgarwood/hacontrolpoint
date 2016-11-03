<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Home Automation</title>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	
    <!-- Path to Framework7 Library CSS-->
    <link rel="stylesheet" href="css/framework7.ios.min.css">
    <link rel="stylesheet" href="css/framework7.ios.colors.min.css">
    <!-- Path to your custom app styles-->
    <link rel="stylesheet" href="css/my-app.css">
	<link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Open+Sans|Roboto" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
  </head>
  <body>
    <!-- Status bar overlay for fullscreen mode-->
    <div class="statusbar-overlay"></div>
    <!-- Panels overlay-->
    <div class="panel-overlay"></div>
    <!-- Left panel with reveal effect-->
    <div class="panel panel-left panel-reveal">
      <div class="content-block">
        <p>Left panel content goes here</p>
      </div>
    </div>
    <!-- Right panel with cover effect-->
    <div class="panel panel-right panel-cover">
      <div class="content-block">
		<ul id="entitylist">
		</ul>
      </div>
    </div>
    <!-- Views-->
    <div class="views">
      <!-- Your main view, should have "view-main" class-->
      <div class="view view-main">
        <!-- Top Navbar-->
        <div class="navbar title-bar">
          <div class="navbar-inner">
            <!-- We have home navbar without left link-->
			<div class="left title-clock"><time class="time">{{clock}}</time> <time class="date">{{date}}</time></div>
            <div class="left alert-bar open-popover" data-popover=".popover-alerts"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> You have 1 new alert</div>
            <div class="right">
              <!-- Right link contains only icon - additional "icon-only" class--><a href="#" class="link icon-only open-panel"> <i class="icon icon-bars"></i></a>
            </div>
          </div>
        </div>
		
		<div class="popover popover-alerts">
			<div class="popover-inner">
			  <div class="list-block">
				<ul>
					<li class="item-content">
						<div class="item-media"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
						<div class="item-title">Alert 1</div>		
					</li>
					<li class="item-content">
						<div class="item-media"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
						<div class="item-title">Alert 2</div>		
					</li>
				</ul>
			  </div>
			</div>
		</div>
		
        <!-- Pages, because we need fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through toolbar-through">
          <!-- Page, data-page contains page name-->
          <div data-page="index" class="page page-dashboard">
            <!-- Scrollable page content-->
            <div class="page-content">
              <div class="dashboard-hero">
				<div class="content-block">
					<div class="row">
						<div class="col-50">
							<div class="swiper-container" id="hero-swiper">
								<div class="swiper-wrapper">
									<div class="swiper-slide temperature">
										<hr>
										<h1>Indoor Temperature</h1>
										<i class="fa fa-thermometer-three-quarters"></i>
										<span class="temp" data-entity="sensor.nest_indoor_temperature"></span>&deg;F
									</div>
									<div class="swiper-slide temperature">
										<hr>
										<h1>Outside Temperature</h1>
										<i class="fa fa-sun-o" aria-hidden="true"></i>
										<span class="temp" data-entity="sensor.hallway_temperature"></span>&deg;F
									</div>
								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
						<div class="col-50">
						</div>
					</div>
				</div>

			  </div>
			  <div class="presence-detection">
				  <div class="content-block">
					<div class="swiper-container" id="presence-swiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<i class="fa fa-user" aria-hidden="true"></i>
								<span class="name">Mom</span>
								<span class="status">HOME</span>
								<span class="details"></span>
							</div>
							<div class="swiper-slide">
								<i class="fa fa-user" aria-hidden="true"></i>
								<span class="name">Dad</span>
								<span class="status">WORK</span>
								<span class="details">For 1 hour</span>
							</div>
							<div class="swiper-slide">
								<i class="fa fa-user" aria-hidden="true"></i>
								<span class="name">Kid</span>
								<span class="status">HOME</span>
								<span class="details"></span>
							</div>
						</div>
					</div>
				</div>
			  </div>
              <div class="content-block-title">Side panels</div>
              <div class="content-block">
                <div class="row">
                  <div class="col-50"><a href="#" data-panel="left" class="button open-panel">Left Panel</a></div>
                  <div class="col-50"><a href="#" data-panel="right" class="button open-panel">Right Panel</a></div>
                </div>
              </div>
            </div>
          </div>
		  <div data-page="lighting" class="page cached page-lighting">
			<div class="page-content">
				<div class="row">
					<div class="col-25 fixed-sidebar">
						<ul>
							<li>
								<a href="#" class="active">
									<div class="item-title">All Lights</div>
									<div class="item-content"><b>2</b> lights are on</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="item-title">Outdoor</div>
									<div class="item-content">All lights are off</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="item-title">Living Room</div>
									<div class="item-content"><b>2</b> lights are on</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="item-title">Kitchen</div>
									<div class="item-content">All lights are off</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="item-title">Bedrooms</div>
									<div class="item-content">All lights are off</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="item-title">Bathrooms</div>
									<div class="item-content">All lights are off</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="item-title">Misc</div>
									<div class="item-content">All lights are off</div>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-75" style="margin-left: calc((100% - 15px*3)/ 4);">
						<div class="content-block">
							<div class="light">
								<h1>Front Porch</h1>
								<input type="range" min="0" max="100" value="50" step="0.1">
							</div>
							<div class="light">
								<h1>Back Porch</h1>
								<input type="range" min="0" max="100" value="0" step="0.1">
							</div>
							<div class="light">
								<h1>Entryway</h1>
								<input type="range" min="0" max="100" value="100" step="0.1">
							</div>
							<div class="light">
								<h1>Living Room Main Lighting</h1>
								<input type="range" min="0" max="100" value="75" step="0.1">
							</div>
							<div class="light">
								<h1>Living Room Ambient Lighting</h1>
								<input type="range" min="0" max="100" value="100" step="0.1">
							</div>
						</div>
					</div>
				</div>
			</div>
		  </div>
		  <div data-page="climate" class="page cached page-climate">
			<div class="page-content">
				climate
			</div>
		  </div>
        </div>
        <!-- Bottom Toolbar-->
        <div class="toolbar tabbar tabbar-labels footer-navigation">
          <div class="toolbar-inner">
			<a href="#index" class="link active"><i class="icon fa fa-home" aria-hidden="true"></i><span class="tabbar-label">Dashboard</span></a>
			<a href="#lighting" class="link"><i class="icon fa fa-lightbulb-o" aria-hidden="true"></i><span class="tabbar-label">Lighting</span></a>
			<a href="#climate" class="link"><i class="icon fa fa-thermometer-three-quarters" aria-hidden="true"></i><span class="tabbar-label">Climate</span></a>
			<a href="#" class="link"><i class="icon fa fa-television" aria-hidden="true"></i><span class="tabbar-label">Appliances</span></a>
			<a href="#" class="link"><i class="icon fa fa-wifi" aria-hidden="true"></i><span class="tabbar-label">Communication</span></a>
			<a href="#" class="link"><i class="icon fa fa-lock" aria-hidden="true"></i><span class="tabbar-label">Security</span></a>
			<a href="#" class="link"><i class="icon fa fa-video-camera" aria-hidden="true"><span class="badge bg-red">5</span></i><span class="tabbar-label">CCTV</span></a>
			<a href="#" class="link"><i class="icon fa fa-cog" aria-hidden="true"></i><span class="tabbar-label">Settings</span></a>
		</div>
        </div>
      </div>
    </div>
	<!-- Path to Framework7 Library JS-->
    <script type="text/javascript" src="js/framework7.min.js"></script>
    <!-- Path to your app js-->
    <script type="text/javascript" src="js/my-app.js"></script>
	
	<script type="text/javascript">
		var heroSwiper1 = myApp.swiper('#hero-swiper', {
			speed: 400,
			spaceBetween: 100,
			pagination: '.swiper-pagination'
		});
		var presenceSwiper = myApp.swiper('#presence-swiper', {
			speed: 400,
			spaceBetween: 100,
			slidesPerView: 4,
		});
	</script>
  </body>
</html>