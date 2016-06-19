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

	$('#like').click(function() {
		console.log(123);
		displayFavorite();
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
	$('#search').on('input', function(){
		$('.card').show();
	})
	$('body').delegate('.card', 'click', function(){
		openCard($(this));
	})

	$('body').delegate('.card_love', 'click', function(e){
		e.stopPropagation();
		var $this=$(this);
		var target_name=$this.prev().html();
		if ($this.children('i').attr('class') === 'fa fa-heart-o') {
			$.post('./api/addFavorite.php', {target: target_name}, function(data) {
				$this.children('i').attr('class','fa fa-heart');
			});
		}else{
			$.post('./api/deleteFavorite.php', {target: target_name}, function(data) {
				$this.children('i').attr('class','fa fa-heart-o');
			});
		}
	})


});

function openCard(card){
	var pic = card.find('.card_pic');
	if(pic.is(":visible")){
		card.find('.card_pic').hide('fast');
		card.find('.card_desc').hide('fast');
	}else{
		card.find('.card_picture').attr('src', card.find('.card_picture').attr('data-src'));
		card.find('.card_pic').show('fast');
		card.find('.card_desc').show('fast');
	}
}

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
//var popupRestaurant = [];
var markerAttraction = [];
//var popupAttraction = [];

var markerClustersRestaurant = L.markerClusterGroup({iconCreateFunction: function(cluster) {return new L.DivIcon({ html: '<b>' + cluster.getChildCount() + '</b>' });}});
var markerClustersAttraction = L.markerClusterGroup({iconCreateFunction: function(cluster) {return new L.DivIcon({ html: '<b>' + cluster.getChildCount() + '</b>' });}});

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
	/*for(var i=0;i<markerAttraction.length;i++){
		map.removeLayer(markerAttraction[i]);
	}
	for(var i=0;i<markerRestaurant.length;i++){
		map.removeLayer(markerRestaurant[i]);
	}*/
	$('#list').html('');

	$.getJSON( "./api/getAttraction.php", function( data ) {
	//$.getJSON("https://data.kaohsiung.gov.tw/Opendata/DownLoad.aspx?Type=2&CaseNo1=AV&CaseNo2=2&FileType=1&Lang=C&FolderType", function(data){
		dataAttraction = data;
		var i=0;
		markerAttraction = [];
		for(i=0;i<data.length;i++){

			var latitude = parseFloat(data[i].Py);
			var longitude = parseFloat(data[i].Px);

<<<<<<< HEAD
			//markerAttraction.push(L.marker([latitude, longitude]).addTo(map));
			//popupAttraction.push(markerAttraction[i].bindPopup(data[i].Name))


=======
>>>>>>> b98d2fd2e37ddc99e1e9a52da37aba2e58b29a0c
			var m = L.marker([latitude, longitude]).bindPopup(data[i].Name);
			markerAttraction.push(m);
			markerClustersAttraction.addLayer(m);

			$('#list').append(' \
			<div class="card"> \
				<div class="card_title">' + data[i].Name + '</div> \
				<div class="card_love"><i class="fa fa-heart-o"></i></div> \
				<div class="card_map"><i class="fa fa-map-pin""></i></div> \
				<div class="card_pic"><img class="card_picture" data-src="' + data[i].Picture1.replace("http", "https") + '" alt="" /></div> \
				<div class="card_desc"> \
					<div class="card_tel"><i class="fa fa-phone"></i> ' + data[i].Tel.replace('886-', '0') + '</div> \
					<div class="card_addr"><i class="fa fa-map-marker"></i> ' + data[i].Add + '</div> \
					<div class="card_opentime"><i class="fa fa-clock-o"></i> ' + data[i].Opentime + '</div> \
					<div class="card_description">' + data[i].Description + '</div> \
				</div> \
				<div class="clear"></div> \
			</div>');
		}
		getFavorite();
		map.addLayer(markerClustersAttraction);
	});
}

function loadRestaurant(){
	var redMarker = L.AwesomeMarkers.icon({
		icon: 'coffee', prefix: 'fa', markerColor: '#ff9800', iconColor: '#f28f82'
	});
	/*for(var i=0;i<markerAttraction.length;i++){
		map.removeLayer(markerAttraction[i]);
	}
	for(var i=0;i<markerRestaurant.length;i++){
		map.removeLayer(markerRestaurant[i]);
	}*/
	$('#list').html('');

	$.getJSON( "./api/getRestaurant.php", function( data ) {
	//$.getJSON("https://data.kaohsiung.gov.tw/Opendata/DownLoad.aspx?Type=2&CaseNo1=AV&CaseNo2=1&FileType=1&Lang=C&FolderType=", function(data){
		dataRestaurant = data;
		var i=0;
		markerRestaurant = [];
		for(i=0;i<data.length;i++){

			var latitude = parseFloat(data[i].Py);
			var longitude = parseFloat(data[i].Px);
<<<<<<< HEAD
			//markerRestaurant.push(L.marker([latitude, longitude], {icon: redMarker}).addTo(map));
			//popupRestaurant.push(markerRestaurant[i].bindPopup(data[i].Name))


=======

>>>>>>> b98d2fd2e37ddc99e1e9a52da37aba2e58b29a0c
			var m = L.marker([latitude, longitude], {icon: redMarker}).bindPopup(data[i].Name);
			markerRestaurant.push(m);
			markerClustersRestaurant.addLayer(m);

			$('#list').append(' \
			<div class="card"> \
				<div class="card_title">' + data[i].Name + '</div> \
				<div class="card_love"><i class="fa fa-heart-o"></i></div> \
				<div class="card_map"><i class="fa fa-map-pin""></i></div> \
				<div class="card_pic"><img class="card_picture" data-src="' + data[i].Picture1.replace("http", "https") + '" alt="" /></div> \
				<div class="card_desc"> \
					<div class="card_tel"><i class="fa fa-phone"></i> ' + data[i].Tel.replace('886-', '0') + '</div> \
					<div class="card_addr"><i class="fa fa-map-marker"></i> ' + data[i].Add + '</div> \
					<div class="card_opentime"><i class="fa fa-clock-o"></i> ' + data[i].Opentime + '</div> \
					<div class="card_description">' + data[i].Description + '</div> \
				</div> \
				<div class="clear"></div> \
			</div>');
		}
		getFavorite();
		map.addLayer(markerClustersRestaurant);
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
				lat = dataAttraction[i].Py;
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
			$('.card').filter(function(){
				return $(this).find('.card_title').text() == keyword;
			}).show().siblings().hide();
		}
	}
}

function route(via){

	for(var i=0;i<via.length;i++){
			via[i] = L.latLng(via[i]);
	}

	L.Routing.control({
			waypoints: via,
			routeWhileDragging: true
		}).addTo(map);
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
		appId	  : '766234450180135',
		cookie	 : true,
		xfbml	  : true,
		version	: 'v2.5'
	});
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});

};

function getFavorite () {
	$.getJSON('./api/getFavorite.php',function(data){
		var fav_data=data;
		$('.card_title').each(function(index, el) {
			var $this=$(this);
			var $name=$this.html();
			for(var i=0;i<fav_data.length;i++){
				if ($name===fav_data[i]) {
					$this.next().children('i').attr('class','fa fa-heart');
				}
			}
		});
	})
}

function displayFavorite(){
	if ($('#showList').text()==='清單顯示') $('#showList').click();
	
	if($('#list').find('.fa-heart-o').is(':visible')){
		$('#like').css('background', '#8B0000');
		$('.card').filter(function(){
			return $(this).find('.fa-heart-o').length>0;
		}).hide();
	}else{
		$('#like').css('background', '#C75C5C');
		$('.card').show();
	}
}

function statusChangeCallback(response) {
	if (response.status === 'connected') {
		isFacebookLogin = true;
		FB.api('/me', function(response) {
			$.post('./api/addUserInfo.php', response);
			FB.api('/me/picture?width=50&height=50', function(response){
				$('#facebook').parent().html('<img src="' + response.data.url + '" />');
			})
		});
	} else if (response.status === 'not_authorized') {

	} else {


	}
}