<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<title>高雄旅遊通</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="./style.css"/>
	<link rel="stylesheet" href="./css/leaflet.css"/>
	<link rel="stylesheet" href="./css/leaflet.awesome-markers.css" />
	<link rel="stylesheet" href="./css/leaflet-routing-machine.css" />
	<link rel="stylesheet" href="./css/leaflet.markercluster.css" />
	<link rel="stylesheet" href="./css/rating.css"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="./leaflet.js"></script>
	<script src="./leaflet.awesome-markers.js"></script>
	<script src="./leaflet-routing-machine.min.js"></script>
	<script src="./leaflet.markercluster.min.js"></script>
	<script src="./js/jquery.rating.js"></script>
	<script src="./js/all.js"></script>
</head>
<body>
	<div class="wrapper">
		<header>
			<div id="logo">高雄旅遊通</div>
			<nav>
				<ul>
					<li><div class="fa fa-heart" id="like">
						<ul>
							<li>123</li>
							<li>456</li>
							<li>789</li>
						</ul>
					</div></li>
					<li><div class="fa fa-map" id="route">
						<ul>
							<li>123</li>
							<li>456</li>
							<li>789</li>
						</ul>
					</div></li>
					<li><div class="fa fa-facebook-official" id="facebook"></div></li>
				</ul>
			</nav>
		</header>
		<section class="search">
			<input type="text" id="search" placeholder="搜尋" /><input type="submit" id="search_go" value="GO"/>
		</section>
		<section class="options">
			<div class="opt_left">
				<div class="button" id="showList">清單顯示</div>
				<div class="button" id="findAttraction">找餐飲</div>
			</div>
			<div class="clear"></div>
			<div id="currentLocation"></div>
		</section>
		<section class="content" id="map">
		</section>
		<section class="content" id="list">
		</section>
		<div id="btnNavigate"><i class="fa fa-location-arrow"></i></div>
		<div id="btnSaveRoute">儲存路線</div>

	</div>
</body>
</html>