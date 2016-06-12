<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<title>高雄旅遊通</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
	<link href="./style.css" rel="stylesheet" />
	<link href="./leaflet.css" rel="stylesheet" />
	<script src="./leaflet.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="./js/all.js"></script>
</head>
<body>
	<div class="wrapper">
		<header>
			<div id="logo">高雄旅遊通</div>
			<nav>
				<ul>
					<li><div class="nav" id="like">Like</div></li>
					<li><div class="nav" id="route">Route</div></li>
					<li><div class="nav" id="facebook">Facebook</div></li>
				</ul>
			</nav>
		</header>
		<section class="search">
			<input type="text" id="search" placeholder="搜尋" /><input type="submit" id="search_go" value="GO"/>
			<div class="hot_search">熱門關鍵字 xxx xxx xxx xxx </div>
		</section>
		<section class="options">
			<div class="opt_left">
				<div class="button" id="showList">清單顯示</div>
				<div class="button" id="findAttraction">找景點</div>
			</div>
			<div class="opt_right">
				<div class="button" id="sortByPopularity">依人氣排列</div>
			</div>
			<div class="clear"></div>
			<div id="currentLocation"></div>
		</section>
		<section class="content" id="map">
		
		</section>
	</div>
</body>
</html>