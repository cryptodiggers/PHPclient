<?php
class cdp_client{
	private $apikey;
	private $HTTPClient;
	private $error;
	
	function __construct($apikey,$proxy_server=null,$proxy_port=null){
		$this->apikey=$apikey;
		$this->HTTPClient=new HTTPClient($proxy_server,$proxy_port);
		$this->error="";
	}
	
	public function GetError(){
		return $this->error;
	}
	
	public function GetNewAddress($order_id,$amount,$currency,$currency_crypto,$wait,$timeout=15){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=new_address&timeout=".$timeout."&order_id=".$order_id."&amount=".$amount."&currency=".$currency."&currency_crypto=".$currency_crypto."&wait=".$wait;
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				if($result["address"][0]["Msg"]=="OK"){
					return $result["address"][0];
				}
				else{
					$this->error=$result["address"][0]["Msg"];
					return false;
				}
			}
			else{
				$this->error=$result["error_msg"];
				return false;
			}
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetTransaction($address,$currency_crypto){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=get_tran&address=".$address."&currency_crypto=".$currency_crypto;
		$result=$this->HTTPClient->getApi($target);
		print_r($result);
		if($result){
			if($result["error"]==0){
				if($result["processed"]=="1"){
					return $result["transaction"];
				}
				else{
					$this->error="Transaction not yet processed.";
					return false;
				}
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetTransactions(){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=get_tran_all";
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				if($result["processed"]=="1"){
					return $result["transaction"];
				}
				else{
					$this->error="No transactions processed.";
					return false;
				}
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetUserAddress(){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=get_user_address";
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				return $result;
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetNetworkHashrate($currency_crypto){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=get_network_hashrate&currency_crypto=".$currency_crypto;
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				return $result;
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetDifficulty($currency_crypto){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=get_difficulty&currency_crypto=".$currency_crypto;
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				return $result;
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetCurrentBlock($currency_crypto){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=get_current_block&currency_crypto=".$currency_crypto;
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				return $result;
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetTransactionByOrderID($order_id,$currency_crypto){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=get_tran_order_id&order_id=".$order_id."&currency_crypto=".$currency_crypto;
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				return $result;
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetExchRate($currency,$currency_crypto){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=get_exch_rate&currency=".$currency."&currency_crypto=".$currency_crypto;
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				return $result;
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	public function GetQRCode($currency,$address,$amount,$label=null,$message=null){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=qrcode&currency=".$currency."&address=".$address."&amount=".$amount.(($label==null || $label=="")?"":"&label=".$label).(($message==null || $message=="")?"":"&message=".$message);
		return $this->HTTPClient->GetURL().$target;
	}
	
	public function GetIframePageLink($iframe_id,$amount){
		$target="?iframe=".$iframe_id."&a=eshop_payment_v2&amount=".$amount;
		return $this->HTTPClient->GetURL().$target;
	}
	
	public function GetIframeStatus($iframe_id){
	$this->error="";
		$target="?apikey=".$this->apikey."&a=get_iframe_status&iframe=".$iframe_id;
		$result=$this->HTTPClient->getApi($target);
		if($result){
			if($result["error"]==0){
				return $result;
			}
			$this->error=$result["error_msg"];
			return false;
		}
		else{
			$this->error="Communication error. Please contact your administrator. HTTP error: ".$this->HTTPClient->GetError();
			return false;
		}
	}
	
	/*public function GetPaymentIframe($orderid,$amount,$currency=1,$cryptocurrency="worldcoin"){
		$this->error="";
		$target="?apikey=".$this->apikey."&a=eshop_payment&timeout=15&order_id=".$orderid."&amount=".$amount."&currency=".$currency."&cryptocurrency".$cryptocurrency;
		return $this->HTTPClient->GetURL().$target;
	}*/
	
}
class HTTPClient{
	private $url_page="https://www.cryptodiggers.eu/api/api.php";
	//private $url_page="http://www.cryptodiggerstest.eu/api/api.php";
	private $error="";
	private $proxy_server;
	private	$proxy_port;
	private $proxy_use=false;
	
	function __construct($proxy_server,$proxy_port){
		$this->proxy_server=$proxy_server;
		$this->proxy_port=$proxy_port;
		if($proxy_server!=null && $proxy_port!=null){
			$this->proxy_use=true;
		}
	}
	
	public function GetURL(){
		return $this->url_page;
	}
	
	public function GetError(){
		return $this->error;
	}
	
	public function getApi($target,$nossl=false, $post=NULL, $auth=NULL ) {
		$this->error=false;
		static $ch = null;
		static $ch = null;
		$url=$this->url_page.$target;
		if (is_null($ch)) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_SSLVERSION, 6);
			//curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'TLSv1_2');
			
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			if($this->proxy_use){
				curl_setopt($ch, CURLOPT_PROXY, $this->proxy_server);
				curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxy_port);
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; PHP client; '.php_uname('s').'; PHP/'.phpversion().')');
		}

		if(is_array($post)){
			curl_setopt($ch, CURLOPT_HTTPGET, 0); 
			curl_setopt($ch, CURLOPT_POST, 1);
			$postdata = http_build_query($post, '', '&');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		}

		curl_setopt($ch, CURLOPT_URL, $url);
		
		if($nossl){
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		}

		$res = curl_exec($ch);
		
		if(curl_errno($ch)==0){
			if(curl_getinfo($ch, CURLINFO_HTTP_CODE)!=200){
				$this->error="HTTP error: ".curl_getinfo($ch, CURLINFO_HTTP_CODE);
				return false;
			}
		}

		if ($res === false) {
			$this->error=curl_error($ch);
			return false;
		}

		if (!$res) {
			$this->error=curl_error($ch);
			return false;
		}

		return json_decode($res,true);
	}
}
 

?>
