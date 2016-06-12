<?php
define('DB_NAME','khtour');
define('DB_USER','root');
define('DB_PASSWD','123456');
define('DB_HOST','localhost');
define('DB_TYPE','mysql');
date_default_timezone_set("Asia/Taipei");
$now=date('Y-m-d');
$dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWD);
$url = "http://data.kaohsiung.gov.tw/Opendata/DownLoad.aspx?Type=2&CaseNo1=AV&CaseNo2=2&FileType=1&Lang=C&FolderType";

$data = file_get_contents($url); // 取得json字串
$data = json_decode($data, true); // 將json字串轉成陣列
echo count($data);
echo "<br>";
$i=1;
$sth = $dbh->prepare("INSERT INTO restaurant(`res_id`,`res_name`,`res_description`,`res_add`,`res_zipcode`,`res_opentime`,`res_website`,`res_picture`,`res_picturediscrip`,`res_px`,`res_py`,`res_class`,`res_changetime`) VALUES(:id, :name, :description, :add, :zipcode, :opentime, :website,:picture, :picturediscrip, :px, :py, :class, :changetime)");
foreach ($data as $value) {
	$sth->bindParam(':id',$value['Id'],PDO::PARAM_STR);
	$sth->bindParam(':name',$value['Name'],PDO::PARAM_STR);
	$sth->bindParam(':description',$value['Description'],PDO::PARAM_STR);
	$sth->bindParam(':add',$value['Add'],PDO::PARAM_STR);
	$sth->bindParam(':zipcode',$value['Zipcode'],PDO::PARAM_STR);
	$sth->bindParam(':opentime',$value['Opentime'],PDO::PARAM_STR);
	$sth->bindParam(':website',$value['Website'],PDO::PARAM_STR);
	$sth->bindParam(':picture',$value['Picture1'],PDO::PARAM_STR);
	$sth->bindParam(':picturediscrip',$value['Picdescribe1'],PDO::PARAM_STR);
	$sth->bindParam(':px',$value['Px'],PDO::PARAM_STR);
	$sth->bindParam(':py',$value['Py'],PDO::PARAM_STR);
	$sth->bindParam(':class',$value['Class'],PDO::PARAM_STR);
	$sth->bindParam(':changetime',$value['Changetime'],PDO::PARAM_STR);
	$sth->execute();
	if ($sth->errorCode())
	{
		if ($sth->errorInfo()[0]!='') {
			print_r($sth->errorInfo());
		}
	}
	echo $i."<br>";
	$i++;
}

$url = "http://data.kaohsiung.gov.tw/Opendata/DownLoad.aspx?Type=2&CaseNo1=AV&CaseNo2=1&FileType=1&Lang=C&FolderType=";

$data = file_get_contents($url); // 取得json字串
$data = json_decode($data, true); // 將json字串轉成陣列
echo count($data);
echo "<br>";
$sth = $dbh->prepare("INSERT INTO attraction(`att_id`,`att_name`,`att_zone`,`att_toldescribe`,`att_tel`,`att_add`,`att_travellinginfo`,`att_opentime`,`att_picture1`,`att_picdescribe1`,`att_gov`,`att_px`,`att_py`,`att_class1`,`att_class2`,`att_level`,`att_website`,`att_parkinginfo_px`,`att_parkinginfo_py`,`att_ticketinfo`,`att_remarks`,`att_changetime`) VALUES(:id, :name, :zone, :toldescribe, :tel, :add, :travellinginfo,:opentime, :picture1, :picdescribe1, :gov, :px, :py,:class1,:class2,:level,:website,:parkinginfo_px,:parkinginfo_py,:ticketinfo,:remarks,:changetime)");
$i=1;
foreach ($data as $value) {
	$sth->bindParam(':id',$value['Id'],PDO::PARAM_STR);
	$sth->bindParam(':name',$value['Name'],PDO::PARAM_STR);
	$sth->bindParam(':zone',$value['Zone'],PDO::PARAM_STR);
	$sth->bindParam(':toldescribe',$value['Toldescribe'],PDO::PARAM_STR);
	$sth->bindParam(':tel',$value['Tel'],PDO::PARAM_STR);
	$sth->bindParam(':add',$value['Add'],PDO::PARAM_STR);
	$sth->bindParam(':travellinginfo',$value['Travellinginfo'],PDO::PARAM_STR);
	$sth->bindParam(':opentime',$value['Opentime'],PDO::PARAM_STR);
	$sth->bindParam(':picture1',$value['Picture1'],PDO::PARAM_STR);
	$sth->bindParam(':picdescribe1',$value['Picdescribe1'],PDO::PARAM_STR);
	$sth->bindParam(':gov',$value['Gov'],PDO::PARAM_STR);
	$sth->bindParam(':px',$value['Px'],PDO::PARAM_STR);
	$sth->bindParam(':py',$value['Py'],PDO::PARAM_STR);
	$sth->bindParam(':class1',$value['Class1'],PDO::PARAM_STR);
	$sth->bindParam(':class2',$value['Class2'],PDO::PARAM_STR);
	$sth->bindParam(':level',$value['Level'],PDO::PARAM_STR);
	$sth->bindParam(':website',$value['Website'],PDO::PARAM_STR);
	$sth->bindParam(':parkinginfo_px',$value['Parkinginfo_px'],PDO::PARAM_STR);
	$sth->bindParam(':parkinginfo_py',$value['Parkinginfo_py'],PDO::PARAM_STR);
	$sth->bindParam('ticketinfo',$value['Ticketinfo'],PDO::PARAM_STR);
	$sth->bindParam(':remarks',$value['Remarks'],PDO::PARAM_STR);
	$sth->bindParam(':changetime',$value['Changetime'],PDO::PARAM_STR);
	$sth->execute();
	echo $i."<br>";
	$i++;
	if ($sth->errorCode())
	{
		if ($sth->errorInfo()[0]!='') {
			print_r($sth->errorInfo());
		}
	}
}

 ?>
