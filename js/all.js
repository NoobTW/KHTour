$(function(){
	$('.content').height($(window).height() - $('.wrapper').height() + $('.content').height());
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(handleGetCurrentPosition, onError);
	}
	
	$('#showList').click(function(event) {
		if ($(this).html()==='清單顯示') {
			$(this).html('地圖顯示');
		}else{
			$(this).html('清單顯示');
		}
	});

	$('#findAttraction').click(function(event) {
		if ($(this).html()==='找景點') {
			$(this).html('找餐飲');
		}else{
			$(this).html('找景點');
		}
	});
});

var mapScale = 11;
var deviceWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
var isGeoLocation = false;
var mapScale = 11;
if(deviceWidth > 768){
	mapScale = 11;
}else if(deviceWidth > 399){
	mapScale = 10;
}else{
	mapScale = 9;
}

function handleGetCurrentPosition(location){
	var city = "";
	var country = "";
	$.getJSON('https://maps.google.com/maps/api/geocode/json?latlng='+location.coords.latitude+','+location.coords.longitude+'&language=zh-TW&sensor=true', function(data){

		$('#currentLocation').text('目前位置：' + data.results[0].formatted_address);
	})

	getMap(location.coords.latitude, location.coords.longitude);
}

function onError(){
	var map = L.map('map').setView([22630459,120300994], mapScale);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: '<a href="http://openstreetmap.org">OpenStreetMap</a> | <a href="http://mapbox.com">Mapbox</a> | KHTour',
		maxZoom: 18,
		id: 'noobtw.popp1a5n',
		accessToken: 'pk.eyJ1Ijoibm9vYnR3IiwiYSI6ImNpZ2pnbG0weTAwNDF1cmtybDdrcTlrZ2cifQ.Nngw5M7DBbJau65SRuUa7g'
	}).addTo(map);
}


function getMap(latitude, longitude){
	if(navigator.geolocation) mapScale += 3;
	var map = L.map('map').setView([latitude, longitude], mapScale);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: '<a href="http://openstreetmap.org">OpenStreetMap</a> | <a href="http://mapbox.com">Mapbox</a> | KHTour',
		maxZoom: 18,
		id: 'noobtw.popp1a5n',
		accessToken: 'pk.eyJ1Ijoibm9vYnR3IiwiYSI6ImNpZ2pnbG0weTAwNDF1cmtybDdrcTlrZ2cifQ.Nngw5M7DBbJau65SRuUa7g'
	}).addTo(map);
}

