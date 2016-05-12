<?php

/*
ダウンロード拡張子をZipにするにはRewriteでゴニョる必要がる。
sample
RewriteRule (.*).zip /zip.php?name=$1 [L]
*/
//zipファイルを一度ファイルとして保存する必要は、どうしてもありそうだ。

class ZipStructure{

	public function __construct() {
	}



	public function run($name,$dirArray){
		$zipName = $name.".zip";

		$zip = new ZipArchive;
		if ($zip->open($zipName, ZipArchive::CREATE) === true) {
			foreach($dirArray as $dir){
				$zip->addEmptyDir($dir);
			}
			$zip->close();
			$this->httpZipOutput($zipName);
			unlink($zipName);
		}


	}



	private function httpZipOutput($zipName){
		if(! $zipName){
			header('HTTP', true, 500);
			return false;
		}else{
			header('Content-Type: application/zip');
			readfile($zipName);
			return true;
		}
	}


}


$zipd = new ZipStructure;
$name = $_GET['name'];
$dirArray = [  
		'a',
		'a/b',
		'c',
		'd/e/f', // 中間パスを明示的に掘らなくても、勝手に掘ってくれた。
		];

$zipd->run($name,$dirArray);


