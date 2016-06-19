<?php
require('connect.php');
$url = "http://data.kaohsiung.gov.tw/Opendata/DownLoad.aspx?Type=2&CaseNo1=AV&CaseNo2=2&FileType=1&Lang=C&FolderType";

$data = file_get_contents($url); // 取得json字串
$data = json_decode($data, true); // 將json字串轉成陣列
echo count($data);
echo "<br>";
$i=1;
$sth = $dbh->prepare("INSERT INTO restaurant(`res_Id`,`res_Name`,`res_Description`,`res_Add`,`res_Zipcode`, `res_Tel`,`res_Opentime`,`res_Website`,`res_Picture1`,`res_Picdescribe1`,`res_Px`,`res_Py`,`res_Class`,`res_Changetime`) VALUES(:id, :name, :description, :add, :zipcode, :tel, :opentime, :website,:picture1, :Picdescribe1, :px, :py, :class, :changetime)");
foreach ($data as $value) {
	$sth->bindParam(':id',$value['Id'],PDO::PARAM_STR);
	$sth->bindParam(':name',$value['Name'],PDO::PARAM_STR);
	$sth->bindParam(':description',$value['Description'],PDO::PARAM_STR);
	$sth->bindParam(':add',$value['Add'],PDO::PARAM_STR);
	$sth->bindParam(':zipcode',$value['Zipcode'],PDO::PARAM_STR);
	$sth->bindParam(':tel',$value['Tel'],PDO::PARAM_STR);
	$sth->bindParam(':opentime',$value['Opentime'],PDO::PARAM_STR);
	$sth->bindParam(':website',$value['Website'],PDO::PARAM_STR);
	$sth->bindParam(':picture1',$value['Picture1'],PDO::PARAM_STR);
	$sth->bindParam(':Picdescribe1',$value['Picdescribe1'],PDO::PARAM_STR);
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
$sth = $dbh->prepare("INSERT INTO attraction(`att_Id`,`att_Name`,`att_Zone`,`att_Toldescribe`, `att_Description`,`att_Tel`,`att_Add`,`att_Travellinginfo`,`att_Opentime`,`att_Picture1`,`att_Picdescribe1`,`att_Gov`,`att_Px`,`att_Py`,`att_Class1`,`att_Class2`,`att_Level`,`att_Website`,`att_Parkinginfo_px`,`att_Parkinginfo_py`,`att_Ticketinfo`,`att_Remarks`,`att_Changetime`) VALUES(:id, :name, :zone, :toldescribe, :description, :tel, :add, :travellinginfo,:opentime, :picture1, :picdescribe1, :gov, :px, :py,:class1,:class2,:level,:website,:parkinginfo_px,:parkinginfo_py,:ticketinfo,:remarks,:changetime)");
$i=1;
foreach ($data as $value) {
	$sth->bindParam(':id',$value['Id'],PDO::PARAM_STR);
	$sth->bindParam(':name',$value['Name'],PDO::PARAM_STR);
	$sth->bindParam(':zone',$value['Zone'],PDO::PARAM_STR);
	$sth->bindParam(':toldescribe',$value['Toldescribe'],PDO::PARAM_STR);
	$sth->bindParam(':description',$value['Description'],PDO::PARAM_STR);
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
