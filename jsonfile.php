<?php 

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    include 'db_connect.php';

    $geolocation = "";
    $record = "";
    $slct_advs = "SELECT * FROM advertisements";
    $slct_qry = mysqli_query($cnct,$slct_advs);
    if(!$slct_qry )
    {
        die('Could not get data: ' . mysql_error());
    }

    while($row = mysqli_fetch_assoc($slct_qry)){
    	if($record != ""){ $record .= ',';}
    	$record .= '{"Name":"'.$row["name"].'",';
    	$record .= '"Type":"'.$row["type"].'",';
    	$record .= '"Description":"'.$row["description"].'",';
    	$record .= '"Address":"'.$row["address"].'"}';

    }
    $record = '{"datas":['.$record.']}';
    mysqli_close($cnct);
    echo $record;
    
   //$str = '{"datas":[{"name":"Andualem fereja"},{"name":"mekdes fereja"}]}';
    //echo $str;
?> 
