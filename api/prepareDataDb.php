<?php
require('connect.php');
$url = "http://data.kaohsiung.gov.tw/Opendata/DownLoad.aspx?Type=2&CaseNo1=AV&CaseNo2=2&FileType=1&Lang=C&FolderType";

$data = file_get_contents($url); // 取得json字串
$data = json_decode($data, true); // 將json字串轉成陣列
echo count($data);
echo "<br>";
$i=1;
$sth = $dbh->prepare("INSERT INTO object(`obj_Id`,`obj_Name`,`obj_Description`,`obj_Add`,`obj_Zipcode`, `obj_Tel`,`obj_Opentime`,`obj_Website`,`obj_Picture1`,`obj_Picdescribe1`,`obj_Px`,`obj_Py`,`obj_Class`,`obj_Changetime`, `obj_Type`) VALUES(:id, :name, :description, :add, :zipcode, :tel, :opentime, :website,:picture1, :Picdescribe1, :px, :py, :class, :changetime, 1)");
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
$sth = $dbh->prepare("INSERT INTO object(`obj_Id`,`obj_Name`,`obj_Zone`,`obj_Toldescribe`, `obj_Description`,`obj_Tel`,`obj_Add`,`obj_Travellinginfo`,`obj_Opentime`,`obj_Picture1`,`obj_Picdescribe1`,`obj_Gov`,`obj_Px`,`obj_Py`,`obj_Class1`,`obj_Class2`,`obj_Level`,`obj_Website`,`obj_Parkinginfo_px`,`obj_Parkinginfo_py`,`obj_Ticketinfo`,`obj_Remarks`,`obj_Changetime`, `obj_Type`) VALUES(:id, :name, :zone, :toldescribe, :description, :tel, :add, :travellinginfo,:opentime, :picture1, :picdescribe1, :gov, :px, :py,:class1,:class2,:level,:website,:parkinginfo_px,:parkinginfo_py,:ticketinfo,:remarks,:changetime, 0)");
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
