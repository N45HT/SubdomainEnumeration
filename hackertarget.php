<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.hackertarget.com/hostsearch/?q=$domSc");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36");
$data = curl_exec($ch);
curl_close($ch);

if($data != "error check your search parameter"){
	$exp = explode("\n",$data);
	for($i = 0 ; $i <= count($exp)-1 ; $i++){
		$exp2 = explode(",",$exp[$i]);
		if(preg_match("/".strtolower($domSc)."/",$parse->FDNS_A[$k])){
			if(!in_array($exp2[0],$allDom)){
				$allDom[] = $exp2[0];
			}
		}
	}
}