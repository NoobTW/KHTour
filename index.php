<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<title>高雄旅遊通</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
	<script src="https://use.fontawesome.com/a02b878fec.js"></script>
	<link rel="stylesheet" href="./font-awsome/font-awesome.min.css">
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
					<li><div class="fa fa-heart" aria-hidden="true" id="like">
						<ul>
							<li>123</li>
							<li>456</li>
							<li>789</li>
						</ul>
					</div></li>
					<li>
					<div class="fa fa-map" aria-hidden="true" id="route">
						<ul>
							<li>123</li>
							<li>456</li>
							<li>789</li>
						</ul>
					</div>
					</li>
					<li><div class="fa fa-facebook-official fa-lg" aria-hidden="true" id="facebook"></div></li>
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
				<div class="button" id="sortByPopularity">
				<select name="" id="">
					<option value="">依人氣排列</option>
					<option value="">依評分排列</option>
					<option value="">依遠近</option>
				</select>

				</div>
			</div>
			<div class="clear"></div>
			<div id="currentLocation"></div>
		</section>
		<section class="content" id="map">

		</section>
	</div>
</body>
</html>