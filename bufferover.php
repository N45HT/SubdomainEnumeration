<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://dns.bufferover.run/dns?q=.$domSc");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36");
$data = curl_exec($ch);
curl_close($ch);
				
$parse = json_decode($data);
if($parse->FDNS_A == null && $parse->RDNS == null){
	
}elseif($parse->FDNS_A != null && $parse->RDNS == null){
	for($k = 0; $k <= count($parse->FDNS_A)-1 ; $k++){
		if(preg_match("/,/",$parse->FDNS_A[$k])){
			$ex = explode(",",$parse->FDNS_A[$k]);
			for($y = 0; $y <= count($ex)-1 ; $y++){
				if(preg_match("/".strtolower($domSc)."/",$ex[$y])){
					if(!in_array($ex[$y],$allDom)){
						$allDom[] = $ex[$y];
					}
				}
			}
		}else{
			if(preg_match("/".strtolower($domSc)."/",$parse->FDNS_A[$k])){
				if(!in_array($parse->FDNS_A[$k],$allDom)){
					$allDom[] = $parse->FDNS_A[$k];
				}
			}
		}
	}
}elseif($parse->FDNS_A == null && $parse->RDNS != null){
	for($j = 0; $j <= count($parse->RDNS)-1 ; $j++){
		if(preg_match("/,/",$parse->RDNS[$j])){
			$exy = explode(",",$parse->RDNS[$j]);
			for($q = 0; $q <= count($exy)-1 ; $q++){
				if(preg_match("/".strtolower($domSc)."/",$exy[$q])){
					if(!in_array($exy[$q],$allDom)){
						$allDom[] = $exy[$q];
					}
				}
			}
		}else{
			if(preg_match("/".strtolower($domSc)."/",$parse->RDNS[$j])){
				if(!in_array($parse->RDNS[$j],$allDom)){
					$allDom[] = $parse->RDNS[$j];
				}
			}
		}
	}
}else{
	for($k = 0; $k <= count($parse->FDNS_A)-1 ; $k++){
		if(preg_match("/,/",$parse->FDNS_A[$k])){
			$ex = explode(",",$parse->FDNS_A[$k]);
			for($y = 0; $y <= count($ex)-1 ; $y++){
				if(preg_match("/".strtolower($domSc)."/",$ex[$y])){
					if(!in_array($ex[$y],$allDom)){
						$allDom[] = $ex[$y];
					}
				}
			}
		}else{
			if(preg_match("/".strtolower($domSc)."/",$parse->FDNS_A[$k])){
				if(!in_array($parse->FDNS_A[$k],$allDom)){
					$allDom[] = $parse->FDNS_A[$k];
				}
			}
		}
	}
	for($j = 0; $j <= count($parse->RDNS)-1 ; $j++){
		if(preg_match("/,/",$parse->RDNS[$j])){
			$exy = explode(",",$parse->RDNS[$j]);
			for($q = 0; $q <= count($exy)-1 ; $q++){
				if(preg_match("/".strtolower($domSc)."/",$exy[$q])){
					if(!in_array($exy[$q],$allDom)){
						$allDom[] = $exy[$q];
					}
				}
			}
		}else{
			if(preg_match("/".strtolower($domSc)."/",$parse->RDNS[$j])){
				if(!in_array($parse->RDNS[$j],$allDom)){
					$allDom[] = $parse->RDNS[$j];
				}
			}
		}
	}
}