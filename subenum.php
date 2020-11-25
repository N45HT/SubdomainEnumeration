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
				include "bufferover.php";
				include "threadcrowd.php";
				for($t=0 ; $t<=count($allDom)-1; $t++){
					print $allDom[$t]."\n";
				}
			}
		}
	}
}

$subEnum = new subEnum();
$subEnum->doEnum();