<?php
/*
$url="https://www.nseindia.com/live_market/dynaContent/live_watch/stock_watch/niftyStockWatch.json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0');
$db = curl_exec($ch);
curl_close($ch);

//$db = file_get_contents($url);//, false, $context);
//echo $db;
$data = json_decode($db);
$json = array($data->latestData[0]->indexName."|".$data->latestData[0]->ltp."_". $data->latestData[0]->ch.">".$data->latestData[0]->per);

foreach ($data->data as $i => $stat) {
	//$n=$stat->symbol."|".$stat->ltP."_".$stat->ptsC.">".$stat->per;
	//echo $n;//."=".$stat->ltP."\n<br>";		
	//$json[$i+1]=array('n'=>$stat->symbol,'v'=>$stat->ltP,'c'=>$stat->ptsC,'p'=>$stat->per);
	$json[$i+1]=$stat->symbol."|".$stat->ltP."_".$stat->ptsC.">".$stat->per;
}
	header('Content-type:application/json;charset=utf-8');
echo json_encode($json);//, JSON_PRETTY_PRINT);
?>//*/

$db = file_get_contents("https://json.bselivefeeds.indiatimes.com/homepagedatanew.json");
//echo $db;

$d = (explode('marketlivedata([', $db));
$d= (explode('])', $d[1]));
$data = json_decode($d[0]);
//$data = substr($db,16,-4);
$n="USD/INR";

$json = array(
 "SENSEX|".$data->sensex->CurrentIndexValue."_". $data->sensex->NetChange.">".$data->sensex->PercentChange,
 "NIFTY|".$data->nifty->CurrentIndexValue."_". $data->nifty->NetChange.">".$data->nifty->PercentChange,
 "GOLD|".$data->gold->LastTradedPrice."_". $data->gold->NetChange.">".$data->gold->PercentChange,
 "SILVER|".$data->silver->LastTradedPrice."_". $data->silver->NetChange.">".$data->silver->PercentChange,
 "USD-INR|".$data->$n->bidprice."_". $data->$n->netChange.">".$data->$n->percentChange);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www1.nseindia.com/live_market/dynaContent/live_watch/stock_watch/niftyStockWatch.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0');
$db = curl_exec($ch);
curl_close($ch);
$data = json_decode($db);
//$json = array($data->latestData[0]->indexName."|".$data->latestData[0]->ltp."_". $data->latestData[0]->ch.">".$data->latestData[0]->per);

$c=sizeof($json);
foreach ($data->data as $i => $stat) {
	//$n=$stat->symbol."|".$stat->ltP."_".$stat->ptsC.">".$stat->per;
	//echo $n;//."=".$stat->ltP."\n<br>";		
	//$json[$i+1]=array('n'=>$stat->symbol,'v'=>$stat->ltP,'c'=>$stat->ptsC,'p'=>$stat->per);
	$json[$i+$c]=$stat->symbol."|".$stat->ltP."_".$stat->ptsC.">".$stat->per;
}
	header('Content-type:application/json;charset=utf-8');
echo json_encode($json);//, JSON_PRETTY_PRINT);

?>

​

