// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true,
	domCache: true
});

// Callbacks to run specific code for specific pages, for example for About page:
myApp.onPageInit('about', function (page) {
    // run createContentPage func after link was clicked
    $$('.create-page').on('click', function () {
        createContentPage();
    });
});

// Generate dynamic page
var dynamicPageIndex = 0;
function createContentPage() {
	mainView.router.loadContent(
        '<!-- Top Navbar-->' +
        '<div class="navbar">' +
        '  <div class="navbar-inner">' +
        '    <div class="left"><a href="#" class="back link"><i class="icon icon-back"></i><span>Back</span></a></div>' +
        '    <div class="center sliding">Dynamic Page ' + (++dynamicPageIndex) + '</div>' +
        '  </div>' +
        '</div>' +
        '<div class="pages">' +
        '  <!-- Page, data-page contains page name-->' +
        '  <div data-page="dynamic-pages" class="page">' +
        '    <!-- Scrollable page content-->' +
        '    <div class="page-content">' +
        '      <div class="content-block">' +
        '        <div class="content-block-inner">' +
        '          <p>Here is a dynamic page created on ' + new Date() + ' !</p>' +
        '          <p>Go <a href="#" class="back">back</a> or go to <a href="services.html">Services</a>.</p>' +
        '        </div>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>'
    );
	return;
}
$(document).ready(function() {
	getEntities();
	updateClock();
	//inactivityTime();
	setInterval('updateClock()', 200);
	setInterval('getEntities()', 30000);
});

function updateClock() {
	var now = new Date();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds();
	var ampm = 'am';
	
	var months = ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
	var day = now.getDate();
	var month = months[now.getMonth()];
	var year = now.getFullYear();
	
	// Format hours, minutes and seconds
	if (hours < 10) {
		hours = "0" + hours;
	}
	if (minutes < 10) {
		minutes = "0" + minutes;
	}
	if (seconds < 10) {
		seconds = "0" + seconds;
	}
	if (hours == 12) {
		ampm = 'pm';
	}
	if (hours > 12) {
		hours = hours - 12;
		ampm = 'pm';
	}
	$('.title-clock .time').html(hours + ':' + minutes + ampm);
	$('.title-clock .date').html(day + ' ' + month + ' ' + year);
}

var haentities = [];
var gotData = false;

function getEntities() {
	$.getJSON(window.ha_url + '/api/states', {}, function(data) {
		//Process the data
		window.haentities = data;
		window.gotData = true;
		
		$("ul#entitylist").html('');
		for (var i=0; i<data.length; i++) {
			console.log(data[i]);
			$("ul#entitylist").append('<li><b>'+data[i]['entity_id']+ '</b><br>' + data[i]['state'] + '</li>');
		}
		
		//update the UI
		updateUI();
	});

}

function updateUI() {
	if (gotData == true) {
		var indoor_temperature = window.haentities.filter(function(o) { return o.entity_id === 'sensor.nest_indoor_temperature'; });
		var outdoor_temperature = window.haentities.filter(function(o) { return o.entity_id === 'sensor.hallway_temperature'; });
		
		indoor_temperature = indoor_temperature[0];
		outdoor_temperature = outdoor_temperature[0];
		$('[data-entity="sensor.nest_indoor_temperature"]').html(Math.round(indoor_temperature['state']));
		$('[data-entity="sensor.hallway_temperature"]').html(Math.round(outdoor_temperature['state']));
	}
}

$(".footer-navigation a").click(function(e) {
	$(".footer-navigation a").removeClass('active');
	$(this).addClass('active');
});