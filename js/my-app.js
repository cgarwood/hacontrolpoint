// Initialize Framework
var myApp = new Framework7();
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    dynamicNavbar: true,
    domCache: true
});

// Initialize Home Assistant API
var HomeAssistantApi = new HomeAssistantApi(window.ha_url, function (entity) {

    // Update entity with this ID
    $$('[data-entity="' + entity.entity_id + '"]').html(entity.state);

});

// Wait for DOM
$$(document).on('DOMContentLoaded', function () {

    // Load entities
    HomeAssistantApi.getEntities();

    // Setup Event Stream Listener
    HomeAssistantApi.setEventStreamListener();

    // Update the clock every second
    updateClock();
    setInterval('updateClock()', 1000);

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
    $$('.title-clock .time').html(hours + ':' + minutes + ampm);
    $$('.title-clock .date').html(day + ' ' + month + ' ' + year);
}

// Allow switching between pages
$$(".footer-navigation a").click(function (e) {
    $$(".footer-navigation a").removeClass('active');
    $$(this).addClass('active');
});