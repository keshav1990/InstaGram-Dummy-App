<?php

///this is used for saving the user data into database to make the data active

/*** mysql hostname ***/
$hostname = 'neowebsolution.com.mysql';
/*** mysql username ***/
$username = 'neowebsolution_';
/*** mysql password ***/
$password = 'JzeUFXQV';
$dbname = 'neowebsolution_';


//$username = "";
$dbh = null;

try {
$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
//echo "Database connected <br>";
/*** set the PDO error mode to exception ***/
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*** begin the transaction used for making the transaction statement ***/
$dbh->beginTransaction();

$sql = "insert into ig_user set accesstoken=:accesstoken , username=:userid ,accesstoken_updated=NOW() ";
$stmt = $dbh->prepare($sql);

$access_token = json_encode($access_token);
$data_insert = array('accesstoken'=>$access_token, 'userid' => $username_insta_account);
$stmt->execute($data_insert);
 ///this is used for the comitting the transaction for the data tables
 //echo $dbh->lastInsertId();
$dbh->commit();



}
catch(PDOException $e)
{

$dbh->rollback();
echo $e->getMessage();
}
/*** close the database connection ***/
$dbh = null;
?>