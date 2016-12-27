<?php
// creates the JSON file - /config.php?v=3-NM20xCua42u2
$val=$_GET['v'];
$noOfDevices=substr($val,0,strpos($val,'-'));
$d = array();
$get=strpos($val,'-')+1;
for($i=0;$i<$noOfDevices;$i++,$get+=4){
	//get the 4th character which denotes all pins status in hex; convert it to 4 digit binary 
	$pin=sprintf("%04s",base_convert(substr($val,$get+3,1),16,2));
	//place it on an array
	$d[$i] = array('id' => substr($val,$get,3)."-Room".($i+1) ,'pin16' => $pin[0]."-Button1" ,'pin05' => $pin[1]."-Button2" ,'pin04' => $pin[2]."-Button3" ,'pin00' => $pin[3]."-Button4");
	//$d[$i] = array('id' => substr($val,$get,3)."-Room".($i+1) ,'pin16' => substr($val,$get+3,1)."-Button1" ,'pin05' => substr($val,$get+4,1)."-Button2" ,'pin04' => substr($val,$get+5,1)."-Button3" ,'pin00' => substr($val,$get+6,1)."-Button4");
}
//encode and save in json format
$json = json_encode(array('status' =>$d), JSON_PRETTY_PRINT);
file_put_contents('sample.json', $json);
?>
