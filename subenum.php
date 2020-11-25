<?php

/*

github.com/n45ht
github.com/n45htofficial

*/

error_reporting(0);

class subEnum{
	private $allDom;
	private $domSc;
	private function valDomName($domFil){
		return(preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domFil)&& preg_match("/^.{1,253}$/", $domFil)&& preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domFil));
	}
	public function doEnum(){
		global $argv;
		if(!isset($argv[1])){
			print "Usage: {$argv[0]} domain.com\n";
		}else{
			$domSc = $argv[1];
			$allDom[] = $domSc;
			if($this->valDomName($domSc)){
				////////////////bufferover
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
				////////////////bufferover
				////////////////threatcrowd
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
				////////////////threatcrowd
				for($t=0 ; $t<=count($allDom)-1; $t++){
					print $allDom[$t]."\n";
				}
			}
			//ell
		}

	}
}

$subEnum = new subEnum();
$subEnum->doEnum();