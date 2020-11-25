<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.threatcrowd.org/searchApi/v2/domain/report/?domain=$domSc");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36");
$data = json_decode(curl_exec($ch));
curl_close($ch);

if($data->response_code == 1){
	for($r = 0 ; $r <= count($data->subdomains)-1 ; $r++){
		if(preg_match("/".strtolower($domSc)."/",$parse->FDNS_A[$k])){
			if(!in_array($data->subdomains[$r],$allDom)){
				$allDom[] = $data->subdomains[$r];
			}
		}
	}
}