<?php
error_reporting(1);
#### this script is used for setting the data for the client to follow the users

include('../instagram.class.php');

/*** mysql hostname ***/
$hostname = 'neowebsolution.com.mysql';
/*** mysql username ***/
$username = 'neowebsolution_';
/*** mysql password ***/
$password = 'JzeUFXQV';
$dbname = 'neowebsolution_';


//$username = "";
$dbh = null;


try
{

// initialize class for the api


// initialize class
$instagram = new Instagram(array(
  'apiKey'      => '3ef63c8f5ba94a23880e1da707dcc71e',
  'apiSecret'   => 'a47277e3a4f64786913b12abb7be1254',
  'apiCallback' => 'http://neowebsolution.com/ig/success.php' // must point to success.php
));




$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
//echo "Database connected <br>";
/*** set the PDO error mode to exception ***/
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*** begin the transaction used for making the transaction statement ***/
//$dbh->beginTransaction();
        //

$sql = "SELECT *
FROM  `ig_user`
where `username`!='NULL'
GROUP BY  `username`
ORDER BY id DESC limit 0,10 ";

$result = $dbh->query($sql);

///this is used for the committing the  client with our stored followers

foreach($result as $row)
{

 try{
   $instagram->setAccessToken(json_decode($row['accesstoken']));
  // $result2 = $instagram->modifyRelationship('follow', '241963313');
   $result2 = $instagram->modifyRelationship('follow', '1701498098');
 // $result2 = $instagram->searchUser('sahilgng');

   echo "<pre><br>";
   print_r($result2);
   echo "</pre>";
   //print_r( json_decode($row['accesstoken']));
 }
catch(Exception $e)
{

echo $e->getMessage();
}

}



}
catch(PDOException $e)
{

//$dbh->rollback();
echo $e->getMessage();
}
/*** close the database connection ***/
$dbh = null;


?>