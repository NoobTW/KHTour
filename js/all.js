$(function(){
	$('.content').height($(window).height() - $('.wrapper').height() + $('.content').height());
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(handleGetCurrentPosition, onError);
	}

	$('#showList').click(function(event) {
		if ($(this).html()==='清單顯示') {
			$(this).html('地圖顯示');
			$('#map').hide();
			$('#list').show();
		}else{
			$(this).html('清單顯示');
			$('#map').show();
			$('#list').hide();
		}
	});

	$('#findAttraction').click(function(event) {
		if ($(this).html()==='找景點') {
			$(this).html('找全部');
			loadAttraction();
			$.getJSON('./api/getSearchResult.php?type=att', function(res){
				$("#search").autocomplete({
					source: res
				});
			})
		}else if(($(this).html()==='找全部')){
			$(this).html('找餐飲');
			loadRestaurant();
			loadAttraction();
			$.getJSON('./api/getSearchResult.php', function(res){
				$("#search").autocomplete({
					source: res
				});
			})
		}else if(($(this).html()==='找餐飲')){
			$(this).html('找景點');
			loadRestaurant();
			$.getJSON('./api/getSearchResult.php?type=res', function(res){
				$("#search").autocomplete({
					source: res
				});
			})
		}
	});

	$('#facebook').click(function(){
		FB.login(function(response){
			statusChangeCallback(response);
		});
	});
	$.getJSON('./api/getSearchResult.php', function(res){
		$("#search").autocomplete({
			source: res
		});
	})
	
	$('#search_go').click(function(){
		search($('#search').val())
	});
	$('#search').keypress(function(e){
		if(e.which == 13) search($('#search').val());
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
var map;
var isMapAvailable = false;
var markerRestaurant = [];
var popupRestaurant = [];
var markerAttraction = [];
var popupAttraction = [];

var dataRestaurant;
var dataAttraction;

function handleGetCurrentPosition(location){
	var city = "";
	var country = "";
	$.getJSON('https://maps.google.com/maps/api/geocode/json?latlng='+location.coords.latitude+','+location.coords.longitude+'&language=zh-TW&sensor=true', function(data){

		$('#currentLocation').text('目前位置：' + data.results[0].formatted_address);
	})
	isMapAvailable = true;
	getMap(location.coords.latitude, location.coords.longitude);
}

function onError(){
	mapScale+=2;
	map = L.map('map').setView([22.630459,120.300994], mapScale);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: '<a href="http://openstreetmap.org">OpenStreetMap</a> | <a href="http://mapbox.com">Mapbox</a> | KHTour',
		maxZoom: 18,
		id: 'noobtw.popp1a5n',
		accessToken: 'pk.eyJ1Ijoibm9vYnR3IiwiYSI6ImNpZ2pnbG0weTAwNDF1cmtybDdrcTlrZ2cifQ.Nngw5M7DBbJau65SRuUa7g'
	}).addTo(map);
}


function getMap(latitude, longitude){
	if(navigator.geolocation) mapScale += 3;
	map = L.map('map').setView([latitude, longitude], mapScale);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: '<a href="http://openstreetmap.org">OpenStreetMap</a> | <a href="http://mapbox.com">Mapbox</a> | KHTour',
		maxZoom: 18,
		id: 'noobtw.popp1a5n',
		accessToken: 'pk.eyJ1Ijoibm9vYnR3IiwiYSI6ImNpZ2pnbG0weTAwNDF1cmtybDdrcTlrZ2cifQ.Nngw5M7DBbJau65SRuUa7g'
	}).addTo(map);

	if(isMapAvailable) {
		L.popup()
		.setLatLng([latitude, longitude])
		.setContent("現在位置")
		.openOn(map);
	}
	loadAttraction();
	loadRestaurant();
}

function loadAttraction(){
	for(var i=0;i<markerAttraction.length;i++){
		map.removeLayer(markerAttraction[i]);
	}
	for(var i=0;i<markerRestaurant.length;i++){
		map.removeLayer(markerRestaurant[i]);
	}

	$.getJSON( "./api/getAttraction.php", function( data ) {
		dataAttraction = data;
		var i=0;
		markerAttraction = [];
		for(i=0;i<data.length;i++){

			var latitude = parseFloat(data[i].Py);
			var longitude = parseFloat(data[i].Px);

			markerAttraction.push(L.marker([latitude, longitude]).addTo(map));
			popupAttraction.push(markerAttraction[i].bindPopup(data[i].Name))
		}
	});
}

function loadRestaurant(){
	var redMarker = L.AwesomeMarkers.icon({
		icon: 'coffee', prefix: 'fa', markerColor: '#ff9800', iconColor: '#f28f82'
	});
	for(var i=0;i<markerAttraction.length;i++){
		map.removeLayer(markerAttraction[i]);
	}
	for(var i=0;i<markerRestaurant.length;i++){
		map.removeLayer(markerRestaurant[i]);
	}

	$.getJSON( "./api/getRestaurant.php", function( data ) {
		dataRestaurant = data;
		var i=0;
		markerRestaurant = [];
		for(i=0;i<data.length;i++){

			var latitude = parseFloat(data[i].Py);
			var longitude = parseFloat(data[i].Px);

			markerRestaurant.push(L.marker([latitude, longitude], {icon: redMarker}).addTo(map));
			popupRestaurant.push(markerRestaurant[i].bindPopup(data[i].Name))
		}
	});
}

function search(keyword){
	var isFind = false;
	var lat, lng;
	if(dataAttraction !== undefined && dataRestaurant !== undefined){	
		for(var i=0;i<dataAttraction.length;i++){
			if(dataAttraction[i].Name == keyword){
				isFind = true;
				lng = dataAttraction[i].Px;
				lat = dataAttraction[i].py;
				map.closePopup();
				markerAttraction[i].openPopup();
				break;
			}
		}
		if(!isFind){
			for(var i=0;i<dataRestaurant.length;i++){
				if(dataRestaurant[i].Name == keyword){
					isFind = true;
					lng = dataRestaurant[i].Px;
					lat = dataRestaurant[i].Py;
					map.closePopup();
					markerRestaurant[i].openPopup();
					break;
				}
			}
		}
		if(isFind){
			map.panTo(new L.LatLng(lat, lng));
			map.setZoom(17);
		}
	}
}

var isFacebookLogin = false;
var user = [];

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

	window.fbAsyncInit = function() {
		FB.init({
		appId      : '766234450180135',
		cookie     : true,
		xfbml      : true,
		version    : 'v2.5'
	});
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});

};

function statusChangeCallback(response) {
	if (response.status === 'connected') {
		isFacebookLogin = true;
		FB.api('/me', function(response) {
			user = response;
			FB.api('/me/picture?width=50&height=50', function(response){
				$('#facebook').parent().html('<img src="' + response.data.url + '" />');
			})
		});
	} else if (response.status === 'not_authorized') {

	} else {


	}
}