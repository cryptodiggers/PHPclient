# PHPclient
PHP client for CryptoDiggers REST API - digital currency payment gateway ( https://www.cryptodiggers.eu/api/ )

include_once 'cdp_client.class.php';
$cdp=new cdp_client(API_KEY');
echo "Test PHP Class<br>";
/******************************
* Get new address and check if transaction is processed
* ***************************/
echo "---------------------<br>";
echo "GetNewAddress<br>";
echo "---------------------<br>";
$data=$cdp->GetNewAddress('000000125',0.01,1,7,0,10);
if($data===false){
echo "Error:".$cdp->GetError()."<br>";
}
else{
echo "Data:<br>";
print_r($data);
}
echo "<br>---------------------<br>";
echo "GetTransaction<br>";
echo "---------------------<br>";
$data1=$cdp->GetTransaction($data['address_value_out'],7);
if($data1===false){
echo "Error:".$cdp->GetError()."<br>";
}
else{
echo "Data:<br>";
print_r($data1);
}
/*******************************
* Get all transactions
*******************************/
echo "<br>---------------------<br>";
echo "GetTransaction<br>";
echo "---------------------<br>";
$data1=$cdp->GetTransactions();
if($data1===false){
echo "Error:".$cdp->GetError()."<br>";
}
else{
echo "Data:<br>";
print_r($data1);
}
echo "<br>---------------------<br>";
/*******************************
* Get user wallet addresses
*******************************/
echo "<br>---------------------<br>";
echo "GetUserAddress<br>";
echo "---------------------<br>";
$data2=$cdp->GetUserAddress();
if($data2===false){
echo "Error:".$cdp->GetError()."<br>";
}
else{
echo "Data:<br>";
print_r($data2);
}
echo "<br>---------------------<br>";
/*******************************
* GetTransactionByOrderID
*******************************/
echo "<br>---------------------<br>";
echo "GetTransactionByOrderID<br>";
echo "---------------------<br>";
$data6=$cdp->GetTransactionByOrderID('100000014',7);
if($data6===false){
echo "Error:".$cdp->GetError()."<br>";
}
else{
echo "Data:<br>";
print_r($data6);
}
echo "<br>---------------------<br>";
/*******************************
* GetExchRate
*******************************/
echo "<br>---------------------<br>";
echo "GetExchRate<br>";
echo "---------------------<br>";
$data7=$cdp->GetExchRate(1,7);
if($data7===false){
echo "Error:".$cdp->GetError()."<br>";
}
else{
echo "Data:<br>";
print_r($data7);
}
echo "<br>---------------------<br>";
/*******************************
* GetIframePageLink
*******************************/
echo "<br>---------------------<br>";
echo "GetIframePageLink<br>";
echo "---------------------<br>";
$data9=$cdp->GetIframePageLink('1afa2ddc-2370-11e6-83da-00155d00c800',0.01);
if($data9===false){
echo "Error:".$cdp->GetError()."<br>";
}
else{
echo "Data:<br>";
echo "<iframe src=".$data9."></iframe>";
}
echo "<br>---------------------<br>";
/*******************************
* GetIframeStatus
*******************************/
echo "<br>---------------------<br>";
echo "GetIframeStatus<br>";
echo "---------------------<br>";
$data10=$cdp->GetIframeStatus('1afa2ddc-2370-11e6-83da-00155d00c800');
if($data10===false){
echo "Error:".$cdp->GetError()."<br>";
}
else{
echo "Data:<br>";
print_r($data10);
}
echo "<br>---------------------<br>";
